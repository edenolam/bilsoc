<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefPositionStatutaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refpositionstatutaire controller.
 *
 */
class RefPositionStatutaireController extends Controller {

    /**
     * Lists all refPositionStatutaire entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refPositionStatutaires = $em->getRepository('ReferencielBundle:RefPositionStatutaire')->findAll();

        return $this->render('@Referenciel/refpositionstatutaire/index.html.twig', array(
                    'refPositionStatutaires' => $refPositionStatutaires,
        ));
    }

    /**
     * Creates a new refPositionStatutaire entity.
     *
     */
    public function newAction(Request $request) {
        $refPositionStatutaire = new Refpositionstatutaire();
        $form = $this->createForm(RefPositionStatutaireType::class, $refPositionStatutaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refPositionStatutaire->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refPositionStatutaire);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('refpositionstatutaire_show', array('idPosistat' => $refPositionStatutaire->getIdposistat()));
        }

        return $this->render('@Referenciel/refpositionstatutaire/new.html.twig', array(
                    'refPositionStatutaire' => $refPositionStatutaire,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refPositionStatutaire entity.
     *
     */
    public function showAction(RefPositionStatutaire $refPositionStatutaire) {
        $deleteForm = $this->createDeleteForm($refPositionStatutaire);

        return $this->render('@Referenciel/refpositionstatutaire/show.html.twig', array(
                    'refPositionStatutaire' => $refPositionStatutaire,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refPositionStatutaire entity.
     *
     */
    public function editAction(Request $request, RefPositionStatutaire $refPositionStatutaire) {
        $deleteForm = $this->createDeleteForm($refPositionStatutaire);
        $editForm = $this->createForm(RefPositionStatutaireType::class, $refPositionStatutaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refPositionStatutaire->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('refpositionstatutaire_edit', array('idPosistat' => $refPositionStatutaire->getIdposistat()));
        }

        return $this->render('@Referenciel/refpositionstatutaire/edit.html.twig', array(
                    'refPositionStatutaire' => $refPositionStatutaire,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refPositionStatutaire entity.
     *
     */
    public function deleteAction(Request $request, RefPositionStatutaire $refPositionStatutaire) {
        $form = $this->createDeleteForm($refPositionStatutaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refPositionStatutaire->setBlVali(1);
            $em->flush($refPositionStatutaire);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refpositionstatutaire_index');
    }

    /**
     * Creates a form to delete a refPositionStatutaire entity.
     *
     * @param RefPositionStatutaire $refPositionStatutaire The refPositionStatutaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefPositionStatutaire $refPositionStatutaire) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refpositionstatutaire_delete', array('idPosistat' => $refPositionStatutaire->getIdposistat())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refPositionStatutaire",
            'requete_sql' => ""
            . "SELECT rps.CD_POSISTAT as 'Code' ,"
            . " rps.LB_POSISTAT as 'Libellé',"
            . " rps.LB_COMPL as 'libellé complémentaire',"
            . " rps.LB_COMM as 'Commentaire',"
            . " (CASE WHEN rps.BL_IND142 <> 0 THEN 'Non' ELSE 'Oui' END) as 'Indicateur 142',"
            . "(CASE WHEN rps.BL_IND143 <> 0 THEN 'Non' ELSE 'Oui' END) as 'Indicateur 143',"
            . " (CASE WHEN rps.BL_IND144 <> 0 THEN 'Non' ELSE 'Oui' END) as 'Indicateur 144',"
            . " (CASE WHEN rps.BL_CDG <> 0 THEN 'Non' ELSE 'Oui' END) as 'Réservé CDG',"
            . " (CASE WHEN rps.BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé',"
            . " GROUP_CONCAT( s.LB_STAT SEPARATOR '-' ) as 'Statut'"
            . " FROM `ref_position_statutaire` rps "
            . "left JOIN statut_positionstatutaire sp "
            . "ON sp.positionstatutaire_id = rps.ID_POSISTAT "
            . "LEFT JOIN ref_statut s "
            . "ON sp.statut_id = s.ID_STAT "
            . "GROUP BY rps.CD_POSISTAT",
            'champ' => array('Code', 'Libellé', 'libellé complémentaire', 'Commentaire', 'Indicateur 142', 'Indicateur 143', 'Indicateur 144', 'Réservé CDG', 'Archivé', 'Statut'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
