<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeCdd;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefTypeCddType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reftypecdd controller.
 *
 */
class RefTypeCddController extends Controller {

    /**
     * Lists all refTypeCdd entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refTypeCdds = $em->getRepository('ReferencielBundle:RefTypeCdd')->findAll();

        return $this->render('@Referenciel/reftypecdd/index.html.twig', array(
                    'refTypeCdds' => $refTypeCdds,
        ));
    }

    /**
     * Creates a new refTypeCdd entity.
     *
     */
    public function newAction(Request $request) {
        $refTypeCdd = new Reftypecdd();
        $form = $this->createForm(RefTypeCddType::class, $refTypeCdd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refTypeCdd);
            $em->flush();

            return $this->redirectToRoute('reftypecdd_show', array('idTypeCdd' => $refTypeCdd->getIdtypecdd()));
        }

        return $this->render('@Referenciel/reftypecdd/new.html.twig', array(
                    'refTypeCdd' => $refTypeCdd,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refTypeCdd entity.
     *
     */
    public function showAction(RefTypeCdd $refTypeCdd) {
        $deleteForm = $this->createDeleteForm($refTypeCdd);

        return $this->render('@Referenciel/reftypecdd/show.html.twig', array(
                    'refTypeCdd' => $refTypeCdd,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refTypeCdd entity.
     *
     */
    public function editAction(Request $request, RefTypeCdd $refTypeCdd) {
        $deleteForm = $this->createDeleteForm($refTypeCdd);
        $editForm = $this->createForm(RefTypeCddType::class, $refTypeCdd);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reftypecdd_edit', array('idTypeCdd' => $refTypeCdd->getIdtypecdd()));
        }

        return $this->render('@Referenciel/reftypecdd/edit.html.twig', array(
                    'refTypeCdd' => $refTypeCdd,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refTypeCdd entity.
     *
     */
    public function deleteAction(Request $request, RefTypeCdd $refTypeCdd) {
        $form = $this->createDeleteForm($refTypeCdd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refTypeCdd->setBlVali(1);
            $em->flush($refTypeCdd);
            $em->flush();
        }

        return $this->redirectToRoute('reftypecdd_index');
    }

    /**
     * Creates a form to delete a refTypeCdd entity.
     *
     * @param RefTypeCdd $refTypeCdd The refTypeCdd entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefTypeCdd $refTypeCdd) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reftypecdd_delete', array('idTypeCdd' => $refTypeCdd->getIdtypecdd())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refTypeCdd",
            'requete_sql' => "SELECT `CD_TYPECDD` as 'Code' ,`LB_TYPECDD` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_type_cdd`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
