<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifAbsence;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefMotifAbsenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refmotifabsence controller.
 *
 */
class RefMotifAbsenceController extends Controller {

    /**
     * Lists all refMotifAbsence entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refMotifAbsences = $em->getRepository('ReferencielBundle:RefMotifAbsence')->findAll();

        return $this->render('@Referenciel/refmotifabsence/index.html.twig', array(
                    'refMotifAbsences' => $refMotifAbsences,
        ));
    }

    /**
     * Creates a new refMotifAbsence entity.
     *
     */
    public function newAction(Request $request) {
        $refMotifAbsence = new Refmotifabsence();
        $form = $this->createForm(RefMotifAbsenceType::class, $refMotifAbsence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refMotifAbsence->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refMotifAbsence);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refmotifabsence_show', array('idMotiabse' => $refMotifAbsence->getIdmotiabse()));
        }

        return $this->render('@Referenciel/refmotifabsence/new.html.twig', array(
                    'refMotifAbsence' => $refMotifAbsence,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refMotifAbsence entity.
     *
     */
    public function showAction(RefMotifAbsence $refMotifAbsence) {
        $deleteForm = $this->createDeleteForm($refMotifAbsence);

        return $this->render('@Referenciel/refmotifabsence/show.html.twig', array(
                    'refMotifAbsence' => $refMotifAbsence,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refMotifAbsence entity.
     *
     */
    public function editAction(Request $request, RefMotifAbsence $refMotifAbsence) {
        $deleteForm = $this->createDeleteForm($refMotifAbsence);
        $editForm = $this->createForm(RefMotifAbsenceType::class, $refMotifAbsence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refMotifAbsence->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refmotifabsence_edit', array('idMotiabse' => $refMotifAbsence->getIdmotiabse()));
        }

        return $this->render('@Referenciel/refmotifabsence/edit.html.twig', array(
                    'refMotifAbsence' => $refMotifAbsence,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refMotifAbsence entity.
     *
     */
    public function deleteAction(Request $request, RefMotifAbsence $refMotifAbsence) {
        $form = $this->createDeleteForm($refMotifAbsence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refMotifAbsence->setBlVali(1);
            $em->flush($refMotifAbsence);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refmotifabsence_index');
    }

    /**
     * Creates a form to delete a refMotifAbsence entity.
     *
     * @param RefMotifAbsence $refMotifAbsence The refMotifAbsence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefMotifAbsence $refMotifAbsence) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refmotifabsence_delete', array('idMotiabse' => $refMotifAbsence->getIdmotiabse())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refMotifAbsence",
            'requete_sql' => "SELECT CD_MOTIABSE as 'Code' ,LB_MOTIABSE as 'Libellé', (CASE WHEN BL_ABSECOMP <> 0 THEN 'Non' ELSE 'Oui' END) as 'Absence compensatoire',  (CASE WHEN BL_ABSEMEDI <> 0 THEN 'Non' ELSE 'Oui' END) as 'Absence médicale',(CASE WHEN BL_ABSEAUTRRAIS <> 0 THEN 'Non' ELSE 'Oui' END) as 'Autre raison', (CASE WHEN BL_ABSAGE <> 0 THEN 'Non' ELSE 'Oui' END) as 'Absence Age',(CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé'  FROM `ref_motif_absence` ",
            'champ' => array('Code', 'Libellé', 'Absence compensatoire', 'Absence médicale', 'Autre raison', 'Absence Age', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
