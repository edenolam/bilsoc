<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifEntretien;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefMotifEntretienType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refmotifentretien controller.
 *
 */
class RefMotifEntretienController extends Controller {

    /**
     * Lists all refMotifEntretien entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refMotifEntretiens = $em->getRepository('ReferencielBundle:RefMotifEntretien')->findAll();

        return $this->render('@Referenciel/refmotifentretien/index.html.twig', array(
                    'refMotifEntretiens' => $refMotifEntretiens,
        ));
    }

    /**
     * Creates a new refMotifEntretien entity.
     *
     */
    public function newAction(Request $request) {
        $refMotifEntretien = new Refmotifentretien();
        $form = $this->createForm(RefMotifEntretienType::class, $refMotifEntretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refMotifEntretien->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refMotifEntretien);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('refmotifentretien_show', array('idMotientr' => $refMotifEntretien->getIdmotientr()));
        }

        return $this->render('@Referenciel/refmotifentretien/new.html.twig', array(
                    'refMotifEntretien' => $refMotifEntretien,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refMotifEntretien entity.
     *
     */
    public function showAction(RefMotifEntretien $refMotifEntretien) {
        $deleteForm = $this->createDeleteForm($refMotifEntretien);

        return $this->render('@Referenciel/refmotifentretien/show.html.twig', array(
                    'refMotifEntretien' => $refMotifEntretien,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refMotifEntretien entity.
     *
     */
    public function editAction(Request $request, RefMotifEntretien $refMotifEntretien) {
        $deleteForm = $this->createDeleteForm($refMotifEntretien);
        $editForm = $this->createForm(RefMotifEntretienType::class, $refMotifEntretien);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refMotifEntretien->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('refmotifentretien_edit', array('idMotientr' => $refMotifEntretien->getIdmotientr()));
        }

        return $this->render('@Referenciel/refmotifentretien/edit.html.twig', array(
                    'refMotifEntretien' => $refMotifEntretien,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refMotifEntretien entity.
     *
     */
    public function deleteAction(Request $request, RefMotifEntretien $refMotifEntretien) {
        $form = $this->createDeleteForm($refMotifEntretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refMotifEntretien->setBlVali(1);
            $em->flush($refMotifEntretien);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refmotifentretien_index');
    }

    /**
     * Creates a form to delete a refMotifEntretien entity.
     *
     * @param RefMotifEntretien $refMotifEntretien The refMotifEntretien entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefMotifEntretien $refMotifEntretien) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refmotifentretien_delete', array('idMotientr' => $refMotifEntretien->getIdmotientr())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refMotifEntretien",
            'requete_sql' => "SELECT `CD_MOTIENTR` as 'Code' ,`LB_MOTIENTR` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_motif_entretien`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
