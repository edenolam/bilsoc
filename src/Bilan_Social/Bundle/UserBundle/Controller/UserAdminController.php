<?php

namespace Bilan_Social\Bundle\UserBundle\Controller;

use Bilan_Social\Bundle\CampagneBundle\Entity\Campagne;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bilan_Social\Bundle\UserBundle\Form\GestionFileExportDgclType;
use Bilan_Social\Bundle\UserBundle\Entity\User;
use Bilan_Social\Bundle\UserBundle\Form\RuleCdgType;
use Symfony\Component\HttpFoundation\Request;
use Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier;

class UserAdminController extends AbstractBSController {

    /**
     * List All CDG users
     *
     */
    public function listAction() {
        $users = $this->getUserManager()->findCDGUsers();

        return $this->render('@User/User/list.html.twig', array(
                    'users' => $users,
        ));
    }

    /**
     * Edit user
     *
     * @param User $user
     */
    public function editAction(Request $request, User $user) {
        $current_user = $this->getUser();

        $form = $this->createForm(RuleCdgType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUpdatedAt(new \DateTime);
            $user->setCdUtilmodi($current_user->getIdUtil());
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('@User/User/edit.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * Delete a user
     *
     * @param User $user
     */
    public function deleteUserAction(User $user) {
        $this->getUserManager()->deleteUser($user);

        return $this->redirectToRoute('admin_user_list');
    }

    /**
     * methode appellée par ajax au changement d'année
     */
    public function loadFileDgclByYearAction(Request $request, $annee){
        $em = $this->getEntityManager();

        $fichier_dgcl_last = $em->getRepository(Fichier::class)->findOneBy(array('logicalFolder' => 'MODEL_DGCL', 'targetYear' => $annee));
        $fichier_pdf_last = $em->getRepository(Fichier::class)->findOneBy(array('logicalFolder' => 'AIDE_PDF', 'targetYear' => $annee));

        $form = $this->createForm(GestionFileExportDgclType::class, [], array('year' => $annee));
        $form->handleRequest($request);

        return $this->render('@User/User/block_dgcl_file.html.twig', array(
            'fichier_dgcl' => $fichier_dgcl_last ? $this->getBSFileManager()->getPublicFileUrl($fichier_dgcl_last->getFileKey()) : null,
            'fichier_pdf' => $fichier_pdf_last ? $this->getBSFileManager()->getPublicFileUrl($fichier_pdf_last->getFileKey()) : null,
            'form' => $form->createView()
        ));
    }

    public function fileExportDgclAction(Request $request) {
        $em = $this->getEntityManager();

        $campagne = $em->getRepository(Campagne::class)->findAll();

        $chemin_dgcl = $this->getParameter('file_manager.default_upload_dir')['file_dgcl_upload'];
        $chemin_pdf = $this->getParameter('file_manager.default_upload_dir')['file_pdf_upload'];

        $form = $this->createForm(GestionFileExportDgclType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modele_dgcl = $request->files->get('gestion_file_export_dgcl')['modele_dgcl']['file'];
            $pdf_aide = $request->files->get('gestion_file_export_dgcl')['pdf_aide']['file'];

            $annee = $form['year']->getData();

            $fichier_dgcl_last = $em->getRepository(Fichier::class)->findOneBy(array('logicalFolder' => 'MODEL_DGCL', 'targetYear' => $annee));
            $fichier_pdf_last = $em->getRepository(Fichier::class)->findOneBy(array('logicalFolder' => 'AIDE_PDF', 'targetYear' => $annee));

            if (isset($modele_dgcl)) {
                if($modele_dgcl->getClientMimeType() !== 'application/vnd.ms-excel.sheet.macroEnabled.12' ){
                    $this->addFlash('error', "Le type de fichier pour l'export DGCL n'est pas au bon format");
                    return $this->redirectToRoute('admin_gestion_fichier_dgcl');
                }
                $fileManager = $this->getBSFileManager();

                if(!empty($fichier_dgcl_last)){
                    $fileManager->deleteFile($fichier_dgcl_last->getFileKey());
                }
               
                $options['DGCL'] = 'modele_DGCL_'.$annee.'.xlsm';
                $options['annee'] = $annee;
                $response_upload = $fileManager->uploadFileInPublicFolder($chemin_dgcl, $fileManager->prepareFileToAdd($modele_dgcl,true,null,$options));
                if ($response_upload['isOk'] === false) {
                    $this->addFlash('error', $response_upload['errMsg']);
                    return $this->redirectToRoute('admin_gestion_fichier_dgcl');
                }
            }
            if (isset($pdf_aide)) {

                if($pdf_aide->getClientMimeType() !== 'application/pdf' ){
                    $this->addFlash('error', "Le type de fichier d'aide n'est pas au bon format");
                    return $this->redirectToRoute('admin_gestion_fichier_dgcl');
                }
                $fileManager = $this->getBSFileManager();

                if(!empty($fichier_pdf_last)){
                    $fileManager->deleteFile($fichier_pdf_last->getFileKey());
                }
               
                $options['DGCL'] = 'recuperer_mon_bilan_social_et_mon_analyse.pdf';
                $response_upload = $fileManager->uploadFileInPublicFolder($chemin_pdf, $fileManager->prepareFileToAdd($pdf_aide,true,null,$options));
               
                if ($response_upload['isOk'] === false) {
                    $this->addFlash('error', $response_upload['errMsg']);
                    return $this->redirectToRoute('admin_gestion_fichier_dgcl');
                }
            }

            try {
                $this->addFlash('notice', 'Les fichiers ont été mis à jour avec succès.');
            }
            catch (ORMException $e) {
                $this->addFlash('error', "Une erreur est survenue durant l'enregistrement des modifications. " . $e->getMessage());
            }
            return $this->redirectToRoute('admin_gestion_fichier_dgcl');
        }

        return $this->render('@User/User/gestion_file_export_dgcl.html.twig', array(
            'campagnes' => $campagne
        ));
    }

    /**
     * Get User Manager
     *
     * @return UserManager
     */
    protected function getUserManager() {
        return $this->get('bs.user.manager');
    }

}
