<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefCategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refcategorie controller.
 *
 */
class RefCategorieController extends Controller {

    /**
     * Lists all refCategorie entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refCategories = $em->getRepository('ReferencielBundle:RefCategorie')->findAll();

        return $this->render('@Referenciel/refcategorie/index.html.twig', array(
                    'refCategories' => $refCategories,
        ));
    }

    /**
     * Creates a new refCategorie entity.
     *
     */
    public function newAction(Request $request) {
        $refCategorie = new Refcategorie();
        $form = $this->createForm(RefCategorieType::class, $refCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refCategorie->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refCategorie);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );


            return $this->redirectToRoute('refcategorie_show', array('idCate' => $refCategorie->getIdcate()));
        }

        return $this->render('@Referenciel/refcategorie/new.html.twig', array(
                    'refCategorie' => $refCategorie,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refCategorie entity.
     *
     */
    public function showAction(RefCategorie $refCategorie) {
        $deleteForm = $this->createDeleteForm($refCategorie);

        return $this->render('@Referenciel/refcategorie/show.html.twig', array(
                    'refCategorie' => $refCategorie,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refCategorie entity.
     *
     */
    public function editAction(Request $request, RefCategorie $refCategorie) {
        $deleteForm = $this->createDeleteForm($refCategorie);
        $editForm = $this->createForm(RefCategorieType::class, $refCategorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refCategorie->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refcategorie_edit', array('idCate' => $refCategorie->getIdcate()));
        }

        return $this->render('@Referenciel/refcategorie/edit.html.twig', array(
                    'refCategorie' => $refCategorie,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refCategorie entity.
     *
     */
    public function deleteAction(Request $request, RefCategorie $refCategorie) {
        $form = $this->createDeleteForm($refCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refCategorie->setBlVali(1);
            $em->flush($refCategorie);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refcategorie_index');
    }

    /**
     * Creates a form to delete a refCategorie entity.
     *
     * @param RefCategorie $refCategorie The refCategorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefCategorie $refCategorie) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refcategorie_delete', array('idCate' => $refCategorie->getIdcate())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refcategorie",
            'requete_sql' => "SELECT `CD_CATE` as 'Code' ,`LB_CATE` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_categorie`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
