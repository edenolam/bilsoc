<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefMotifArriveeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refmotifarrivee controller.
 *
 */
class RefMotifArriveeController extends Controller {

    /**
     * Lists all refMotifArrivee entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refMotifArrivees = $em->getRepository('ReferencielBundle:RefMotifArrivee')->findAll();

        return $this->render('@Referenciel/refmotifarrivee/index.html.twig', array(
                    'refMotifArrivees' => $refMotifArrivees,
        ));
    }

    /**
     * Creates a new refMotifArrivee entity.
     *
     */
    public function newAction(Request $request) {
        $refMotifArrivee = new Refmotifarrivee();
        $form = $this->createForm(RefMotifArriveeType::class, $refMotifArrivee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refMotifArrivee->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refMotifArrivee);
            $em->flush();

            return $this->redirectToRoute('refmotifarrivee_show', array('idMotiarri' => $refMotifArrivee->getIdmotiarri()));
        }

        return $this->render('@Referenciel/refmotifarrivee/new.html.twig', array(
                    'refMotifArrivee' => $refMotifArrivee,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refMotifArrivee entity.
     *
     */
    public function showAction(RefMotifArrivee $refMotifArrivee) {
        $deleteForm = $this->createDeleteForm($refMotifArrivee);

        return $this->render('@Referenciel/refmotifarrivee/show.html.twig', array(
                    'refMotifArrivee' => $refMotifArrivee,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refMotifArrivee entity.
     *
     */
    public function editAction(Request $request, RefMotifArrivee $refMotifArrivee) {
        $deleteForm = $this->createDeleteForm($refMotifArrivee);
        $editForm = $this->createForm(RefMotifArriveeType::class, $refMotifArrivee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refMotifArrivee->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('refmotifarrivee_edit', array('idMotiarri' => $refMotifArrivee->getIdmotiarri()));
        }

        return $this->render('@Referenciel/refmotifarrivee/edit.html.twig', array(
                    'refMotifArrivee' => $refMotifArrivee,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refMotifArrivee entity.
     *
     */
    public function deleteAction(Request $request, RefMotifArrivee $refMotifArrivee) {
        $form = $this->createDeleteForm($refMotifArrivee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refMotifArrivee->setBlVali(1);
            $em->flush($refMotifArrivee);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refmotifarrivee_index');
    }

    /**
     * Creates a form to delete a refMotifArrivee entity.
     *
     * @param RefMotifArrivee $refMotifArrivee The refMotifArrivee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefMotifArrivee $refMotifArrivee) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refmotifarrivee_delete', array('idMotiarri' => $refMotifArrivee->getIdmotiarri())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refMotifArrivee",
            'requete_sql' => "SELECT ma.CD_MOTIARRI as 'Code' , ma.LB_MOTIARRI as 'Libellé', GROUP_CONCAT( s.LB_STAT SEPARATOR '-' ) as 'Statut', (CASE WHEN ma.BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé'  FROM `ref_motif_arrivee` ma left JOIN statut_motif_arrivee sma ON sma.motif_arrivee_id = ma.ID_MOTIARRI LEFT JOIN ref_statut s ON s.ID_STAT = sma.status_id GROUP BY ma.CD_MOTIARRI",
            'champ' => array('Code', 'Libellé', 'Statut', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
