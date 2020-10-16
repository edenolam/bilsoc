<?php

namespace Bilan_Social\Bundle\ActualiteBundle\Controller;

use Bilan_Social\Bundle\ActualiteBundle\Entity\Actualite;
use Bilan_Social\Bundle\ActualiteBundle\Form\ActualiteAdminType;
use Bilan_Social\Bundle\ActualiteBundle\Form\ActualiteType;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Actualite controller.
 *
 * It's only for USER CDG
 *
 */
class ActualiteController extends AbstractBSController
{
    /**
     * Lists all actualite entities.
     *
     */
    public function indexAction()
    {
        if ($this->isUserAdmin()) {
            $actualites = $this->getEntityManager()->getRepository(Actualite::class)->findActualiteByAdmin();
        } else if ($this->isUserCDG()) {
            $actualites = $this->getEntityManager()->getRepository(Actualite::class)->findActualiteByCDG($this->getUser());
        }
        foreach ($actualites as $key => $actualite) {
            if ($actualite->getFileKeyDoc()) {
                $actualite->setDocument(1);
            }
        }

        return $this->render('@Actualite/Actualite/index.html.twig', array(
            'actualites' => $actualites,
        ));
    }

    /**
     * Creates a new actualite entity.
     */
    public function newAction(Request $request)
    {
        $actualite = new Actualite();
        $chemin = 'ACTUALITE';
        $cdgs = null;
        if ($this->isUserAdmin()) {
            $form = $this->createForm(ActualiteAdminType::class, $actualite, array('user' => $this->getUser(), 'new' => true));
        } else if ($this->isUserCDG()) {
            $form = $this->createForm(ActualiteType::class, $actualite, array('user' => $this->getUser(), 'new' => true));
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $request->files->get('bilan_social_bundle_actualitebundle_actualite')['image']['image'];
            $document = $request->files->get('bilan_social_bundle_actualitebundle_actualite')['document']['file'];

            /* La date de debut est obligatoire on met juste l'heure à 0 pour que l'actualité commence en début de journée par défaut. */
            $nouvelleDateDedebut = date_time_set($form['DtDebut']->getData(), '0', '0', '0');
            $actualite->setDtDebut($nouvelleDateDedebut);
            if($this->isUserAdmin()){
                $cdgs = $form['cdgs']->getData();
            }
            
            
            $dtFin = $form['DtFin']->getData();
            /* la date de fin peu etre null, si elle est pas null alors on force l'heure en fin de journée par défaut */
            if ($dtFin !== null) {
                $NouvelleDateDeFin = date_time_set($dtFin, '23', '59', '59');
                $actualite->setDtFin($NouvelleDateDeFin);
            }

            if (isset($file)) {

                $fileManager = $this->getBSFileManager();
                $response_upload = $fileManager->uploadFileInPublicFolder($chemin, $fileManager->prepareFileToAdd($file, false), $cdgs);

                if ($response_upload['isOk']) {
                    $actualite->setFileKeyImg($response_upload['fichier']->getFileKey());
                } else {
                    $this->addFlash('error', $response_upload['errMsg']);
                    return $this->render('@Actualite/Actualite/new.html.twig',
                        array(
                            'actualite' => $actualite,
                            'form' => $form->createView(),
                        ));
                }
            }

            if (isset($document)) {

                $fileManager = $this->getBSFileManager();
                $response_upload = $fileManager->uploadFileInPublicFolder($chemin, $fileManager->prepareFileToAdd($document));

                if ($response_upload['isOk']) {
                    $actualite->setFileKeyDoc($response_upload['fichier']->getFileKey());
                } else {
                    $this->addFlash('error', $response_upload['errMsg']);
                    return $this->render('@Actualite/Actualite/new.html.twig',
                        array(
                            'actualite' => $actualite,
                            'form' => $form->createView(),
                        ));
                }
            }

            // Rattachement de l'actualité aux départements du CDG
            foreach ($actualite->getCdgDepartements() as $key => $cdg) {
                $cdg->addActualite($actualite);
            }

            // Enregistrement base
            $em = $this->getEntityManager();
            try {
                $em->persist($actualite);
                $em->flush();
                $this->addFlash('notice', 'L\'actualité a été créée avec succès.');
            } catch (ORMException $e) {
                $this->addFlash('error', "Une erreur est survenue durant l'enregistrement des modifications. " . $e->getMessage());
            }
            return $this->redirectToRoute('actualite_index', array('id' => $actualite->getId()));
        }
        return $this->render('@Actualite/Actualite/new.html.twig', array(
            'actualite' => $actualite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a actualite entity.
     */
    private function _showAction(Actualite $actualite, $showReturnButton)
    {
        if ($this->checkIsUserOwnerOf($actualite, null, self::SHOW_ACCESS_TYPE)) {
            $deleteForm = $this->createDeleteForm($actualite);

            return $this->render('@Actualite/Actualite/apercu.html.twig',
                array(
                    'actualite' => $actualite,
                    'imagePublicUrl' => $this->getBSFileManager()->getPublicFileUrl($actualite->getFileKeyImg()),
                    'docPublicUrl' => ($actualite->getFileKeyDoc()) ? $this->getBSFileManager()->getPublicFileUrl($actualite->getFileKeyDoc()) : null,
                    'delete_form' => $deleteForm->createView(),
                    'showReturnButton' => $showReturnButton,
                ));
        }
        else {
            if ($this->isUserCollectivite()) {
                return $this->redirectToRoute('homepage');
            }
            else {
                return $this->redirectToRoute('actualite_index');
            }
        }
    }

    public function showAction(Actualite $actualite)
    {
        return $this->_showAction($actualite, false);
    }

    /**
     * Finds and displays a actualite entity.
     *
     */
    public function showadmincdgAction(Actualite $actualite)
    {
        return $this->_showAction($actualite, true);
    }

    /**
     * Displays a form to edit an existing actualite entity.
     *
     */
    public function editAction(Request $request, Actualite $actualite)
    {
        if($this->checkIsUserOwnerOf($actualite)){ 
            $chemin = 'ACTUALITE';
            $originalFormCdg = new ArrayCollection();
            // Mémorisation des fichiers liés courant
            $previousImageKey = $actualite->getFileKeyImg();
            $previousDocKey = $actualite->getFileKeyDoc();

            foreach ($actualite->getCdgDepartements() as $tag) {
                $originalFormCdg->add($tag);
            }

            $deleteForm = $this->createDeleteForm($actualite);

            if ($this->isUserAdmin()) {
                $editForm = $this->createForm(ActualiteAdminType::class, $actualite, array('user' => $this->getUser(), 'new' => false));
            } else if ($this->isUserCDG()) {
                $editForm = $this->createForm(ActualiteType::class, $actualite, array('user' => $this->getUser(), 'new' => false));
            }
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {

                $isImageChanged = false;
                $isDocChanged = false;

                $file = $request->files->get('bilan_social_bundle_actualitebundle_actualite')['image']['image'];
                if (isset($file)) {

                    $fileManager = $this->getBSFileManager();
                    $response_upload = $fileManager->uploadFileInPublicFolder($chemin, $fileManager->prepareFileToAdd($file, false));

                    if ($response_upload['isOk']) {
                        $actualite->setFileKeyImg($response_upload['fichier']->getFileKey());
                        $isImageChanged = ($previousImageKey != null);
                    } else {
                        $this->addFlash('error', $response_upload['errMsg']);
                        return $this->render('@Actualite/Actualite/edit.html.twig',
                            array(
                                'actualite' => $actualite,
                                'edit_form' => $editForm->createView(),
                                'delete_form' => $deleteForm->createView(),
                                'image' => $actualite->getFileKeyImg(),
                                'document' => $actualite->getFileKeyDoc(),
                                'imagePublicUrl' => $this->getBSFileManager()->getPublicFileUrl($previousImageKey),
                                'docPublicUrl' => ($previousDocKey) ? $this->getBSFileManager()->getPublicFileUrl($previousDocKey) : null,
                            ));
                    }
                }

                $document = $request->files->get('bilan_social_bundle_actualitebundle_actualite')['document']['file'];
                if (isset($document)) {

                    $fileManager = $this->getBSFileManager();
                    $response_upload = $fileManager->uploadFileInPublicFolder($chemin, $fileManager->prepareFileToAdd($document));

                    if ($response_upload['isOk']) {
                        $actualite->setFileKeyDoc($response_upload['fichier']->getFileKey());
                        $isDocChanged = ($previousDocKey != null);
                    } else {
                        $this->addFlash('error', $response_upload['errMsg']);
                        return $this->render('@Actualite/Actualite/edit.html.twig',
                            array(
                                'actualite' => $actualite,
                                'edit_form' => $editForm->createView(),
                                'delete_form' => $deleteForm->createView(),
                                'image' => $actualite->getFileKeyImg(),
                                'document' => $actualite->getFileKeyDoc(),
                                'imagePublicUrl' => $this->getBSFileManager()->getPublicFileUrl($previousImageKey),
                                'docPublicUrl' => ($previousDocKey) ? $this->getBSFileManager()->getPublicFileUrl($previousDocKey) : null,
                            ));
                    }
                }

                $nouvelleDateDedebut = date_time_set($editForm['DtDebut']->getData(), '0', '0', '0');
                $actualite->setDtDebut($nouvelleDateDedebut);

                $dtFin = $editForm['DtFin']->getData();
                /* la date de fin peu etre null, si elle est pas null alors on force l'heure en fin de journée par défaut */
                if ($dtFin !== null) {
                    $NouvelleDateDeFin = date_time_set($dtFin, '23', '59', '59');
                    $actualite->setDtFin($NouvelleDateDeFin);
                }

                foreach ($originalFormCdg as $cdg) {
                    if (false === $actualite->getCdgDepartements()->contains($cdg)) {
                        $actualite->removeCdgDepartements($cdg);
                    }
                }
                foreach ($actualite->getCdgDepartements() as $key => $cdg) {
                    $cdg->removeActualite($actualite);
                }

                // Enregistrement base
                $em = $this->getEntityManager();
                try {
                    // Enregistrement modification apportées à l'actualité
                    $em->persist($actualite);
                    $em->flush();

                    // TODO Suppression des anciennes ressources
                    if ($isImageChanged || $isDocChanged) {
                        $fileManager = $this->getBSFileManager();
                        if ($isImageChanged) $fileManager->deleteFile($previousImageKey);
                        if ($isDocChanged) $fileManager->deleteFile($previousDocKey);
                    }
                    
                    $this->addFlash('notice', 'L\'actualité a été mise à jour avec succès.');
                }
                catch (ORMException $e) {
                    $this->addFlash('error', "Une erreur est survenue durant l'enregistrement des modifications. " . $e->getMessage());
                }
                return $this->redirectToRoute('actualite_index', array('id' => $actualite->getId()));
            }

            return $this->render('@Actualite/Actualite/edit.html.twig',
                array(
                    'actualite' => $actualite,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'image' => $actualite->getFileKeyImg(),
                    'document' => $actualite->getFileKeyDoc(),
                    'imagePublicUrl' => $this->getBSFileManager()->getPublicFileUrl($actualite->getFileKeyImg()),
                    'docPublicUrl' => ($actualite->getFileKeyDoc()) ? $this->getBSFileManager()->getPublicFileUrl($actualite->getFileKeyDoc()) : null,
                ));
        }else{
            return $this->redirectToRoute('actualite_index');
        }
    }

    /**
     * Deletes a actualite entity.
     *
     */
    public function deleteAction(Request $request, Actualite $actualite)
    {
        if($this->checkIsUserOwnerOf($actualite)){ 
            $form = $this->createDeleteForm($actualite);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                // Enregistrement base
                $em = $this->getEntityManager();
                try {
                    $em->remove($actualite);
                    $em->flush();
                    $this->addFlash('notice', "L'actualité a été supprimée avec succès.");
                } catch (ORMException $e) {
                    $this->addFlash('error', "Une erreur est survenue durant l'enregistrement des modifications. " . $e->getMessage());
                }
            }
            return $this->redirectToRoute('actualite_index');
        }else{
            return $this->redirectToRoute('actualite_index');
        }
    }

    /**
     * Creates a form to delete a actualite entity.
     * @param Actualite $actualite The actualite entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Actualite $actualite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('actualite_delete', array('id' => $actualite->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function downloadDocumentAction(Actualite $actualite)
    {
        $documentPath = $actualite->getPathDocument();
        $documentName = $actualite->getNameDocument();

        return $this->get('file_manager.file_manager')->downloadFile($documentPath, $documentName);
    }
}
