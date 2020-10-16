<?php

namespace Bilan_Social\Bundle\FaqBundle\Controller;

use Bilan_Social\Bundle\FaqBundle\Entity\faq;
use Bilan_Social\Bundle\FaqBundle\Form\faqType;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Bilan_Social\Bundle\FaqBundle\Form\importExcelFaqType;
use Symfony\Component\HttpFoundation\Request;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

/**
 * Faq controller.
 *
 */
class faqController extends AbstractBSController
{
    /**
     * Lists all faq entities for admin.
     *
     */
    public function indexAction($faqs = null, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $importForm = $this->createForm(importExcelFaqType::class);
        $importForm->handleRequest($request);

        if ($importForm->isSubmitted() && $importForm->isValid()) {
            $document = $request->files->get('bilan_social_bundle_faqbundle_import_excel_faq')['document']['file'];
            if (isset($document)) {
                if ($document->guessExtension() !== 'xlsx') {
                    $this->addFlash('error', 'L\'extension du fichier doit être "xlsx" (Excel)');
                    return $this->redirectToRoute('faq_index_administration');
                }

                $insert = 'INSERT INTO faq (question, reponse, profil, categorie) ';
                $values = 'VALUES ';

                $conn = $this->getEntityManager()->getConnection();
                $reader = ReaderFactory::create(Type::XLSX);
                $reader->open($document);
                $conn->beginTransaction();

                foreach ($reader->getSheetIterator() as $key => $sheet) {
                    foreach ($sheet->getRowIterator() as $key1 => $row) {
                        if ($key1 > 1) {

                            if ($key1 == 2) {
                                $values .= '("' . addslashes($row[0]) . '", "' . addslashes($row[1]) . '", "' . $row[2] . '", "' . $row[3] . '") ';
                            }
                            else {
                                $values .= ', ("' . addslashes($row[0]) . '", "' . addslashes($row[1]) . '", "' . $row[2] . '", "' . $row[3] . '") ';
                            }
                        }
                    }
                }

                $query = $insert . $values;

                try {
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                }
                catch (Exception $ex) {
                    $conn->rollBack();
                    $this->addFlash('error', "Une erreur est survenue durant l'envoi du fichier. " . $ex->getMessage());
                }

                $conn->commit();
                $this->addFlash('notice', "Import réalisé avec succès.");
                $reader->close();

                return $this->redirectToRoute('faq_index_administration');
            }
        }

        if($faqs == null){
              $faqs = $em->getRepository('FaqBundle:faq')->findAll();
        }
        $categories = $em->getRepository('FaqBundle:faq')->findCategoriesFaq();
        $tab = [];
        $tab['collectivite'] = null;
        $tab['cdg'] = null;
        $tab['all'] = null;

        foreach ($faqs as $key => $value){
              if($value->getProfil() == 0 ){

                  foreach($categories as $index => $categorie){
                        if($value->getCategorie() == $categorie){
                        $tab['collectivite'][$categorie][$key] = $value;
                        }
                    }
                }
              if($value->getProfil() == 1 ){
                  foreach($categories as $index => $categorie){
                        if($value->getCategorie() == $categorie){
                        $tab['cdg'][$categorie][$key] = $value;
                        }
                    }
                }
              if($value->getProfil() == 2 ){
                  foreach($categories as $index => $categorie){
                        if($value->getCategorie() == $categorie){
                        $tab['all'][$categorie][$key] = $value;
                        }
                    }
                }

        }


        return $this->render('@Faq/faq/index.html.twig', array(
            'tableau'    => $tab,
            'importForm' => $importForm->createView()
        ));


    }
    /**
     * Lists all faq entities for collectivite or CDG
     *
     */
    public function indexCDGorCollectiviteAction($faqs = null, $noResult = null, Request $request = null) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if ($noResult == 0) {
            if ($user->hasRole('ROLE_ADMIN')) {
                $faqs = $em->getRepository('FaqBundle:faq')->findAll();
            }
            if ($user->hasRole('ROLE_CDG')) {
                $faqs = $em->getRepository('FaqBundle:faq')->findFaqByCollectiviteorCdg(1);
            }
            if ($user->hasRole('ROLE_COLLECTIVITY')) {
                $faqs = $em->getRepository('FaqBundle:faq')->findFaqByCollectiviteorCdg(0);
            }
            if ($user->hasRole('ROLE_INFOCENTRE')) {
                $faqs = $em->getRepository('FaqBundle:faq')->findAll();
            }
        }
        else if ($noResult == 2) {
            $faqs = [];
            $this->addFlash(
                    'error', "Aucun résultat pour cette recherche"
            );
        }

        $categories = $em->getRepository('FaqBundle:faq')->findCategoriesFaq();
        $tab = [];
        foreach ($faqs as $key => $value) {
            foreach ($categories as $index => $categorie) {
                if ($value->getCategorie() == $categorie) {
                    $tab[$categorie][$key] = $value;
                }
            }
        }


        return $this->render('@Faq/faq/indexfaq.html.twig', array(
           'tableau' => $tab,
            'noResult' => $noResult
        ));
    }



    /**
     * Creates a new faq entity.
     *
     */
    public function newAction(Request $request)
    {
        $faq = new Faq();
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('FaqBundle:faq')->findCategoriesFaq();

        $form = $this->createForm(faqType::class, $faq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($faq);
            $em->flush();
            $this->addFlash('notice', $this->get('translator')->trans('create.faq.flash'));
            return $this->redirectToRoute('faq_index_administration', array('id' => $faq->getId()));
        }

        return $this->render('@Faq/faq/new.html.twig', array(
            'faq' => $faq,
            'form' => $form->createView(),
            'categories' => $categories,
        ));
    }

    /**
     * Finds and displays a faq entity.
     *
     */
    public function showAction(faq $faq)
    {
        $deleteForm = $this->createDeleteForm($faq);

        return $this->render('@Faq/faq/show.html.twig', array(
            'faq' => $faq,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing faq entity.
     *
     */
    public function editAction(Request $request, faq $faq)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('FaqBundle:faq')->findCategoriesFaq();
        $deleteForm = $this->createDeleteForm($faq);
        $editForm = $this->createForm(faqType::class, $faq);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('notice', $this->get('translator')->trans('edit.faq.flash'));
            return $this->redirectToRoute('faq_edit', array('id' => $faq->getId()));
        }

        return $this->render('@Faq/faq/edit.html.twig', array(
            'faq' => $faq,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'categories' => $categories,
        ));
    }

    /**
     * Deletes a faq entity.
     *
     */
    public function deleteAction(Request $request, faq $faq)
    {
        $form = $this->createDeleteForm($faq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($faq);
            $em->flush();
            $this->addFlash('notice', $this->get('translator')->trans('delete.faq.flash'));
        }

        return $this->redirectToRoute('faq_index_administration');
    }

    /**
     * Creates a form to delete a faq entity.
     *
     * @param faq $faq The faq entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(faq $faq)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('faq_delete', array('id' => $faq->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }



    public function SearchAction(Request $request){
//        $filtre = $request->get('filter');
//        $value = $request->get('value');
        $em = $this->getDoctrine()->getManager();
        $filtre = $request->request->get('filter');
        $value = $request->request->get('value');

        $user = $this->getUser();
        $this->saveAndUnlockSession($request);
        $tab = ['filtre' => $filtre, 'value' => $value ];

        if ($user->hasRole('ROLE_CDG') || $user->hasRole('ROLE_INFOCENTRE')){
                   $profil = 1;
        }
        if ($user->hasRole('ROLE_COLLECTIVITY')){
                   $profil = 0;
        }
        if ($user->hasRole('ROLE_ADMIN')){
                   $profil = 3;
        }

        $noResult = 0;

        $faqs = $em->getRepository('FaqBundle:faq')->searchFAQByFilter($profil, $tab);
        if (empty($faqs)) {
            $noResult = 2;
        }
        else {
            $noResult = 1;
        }
        /* Dans le cas de l'administrateur le rediriger vers son action*/
         if ($user->hasRole('ROLE_ADMIN')){
                   return $this->indexAction($faqs, $request);
        }
      return $this->indexCDGorCollectiviteAction($faqs, $noResult);
    }

    public function exportExcelFaqAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $allFaq = $em->getRepository('FaqBundle:faq')->findAll();

        return $this->render('FaqBundle:faq:export.xlsx.twig', array(
                    'allFaq' => $allFaq
        ));
    }

}
