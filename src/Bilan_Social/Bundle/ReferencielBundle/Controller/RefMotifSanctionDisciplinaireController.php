<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifSanctionDisciplinaire;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefMotifSanctionDisciplinaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * RefMotifSanctionDisciplinaire controller.
 *
 */
class RefMotifSanctionDisciplinaireController extends Controller {

    /**
     * Lists all RefMotifSanctionDisciplinaire entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refMotifSanctionDisciplinaires = $em->getRepository('ReferencielBundle:RefMotifSanctionDisciplinaire')->findAll();

        return $this->render('@Referenciel/refmotifsanctiondisciplinaire/index.html.twig', array(
                    'refMotifSanctionDisciplinaires' => $refMotifSanctionDisciplinaires,
        ));
    }

    /**
     * Creates a new RefMotifSanctionDisciplinaire entity.
     *
     */
    public function newAction(Request $request) {
        $refMotifSanctionDisciplinaire = new RefMotifSanctionDisciplinaire();
        $form = $this->createForm(RefMotifSanctionDisciplinaireType::class, $refMotifSanctionDisciplinaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refMotifSanctionDisciplinaire->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refMotifSanctionDisciplinaire);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refmotifsanctiondisciplinaire_show', array('idMotiSancdisc' => $refMotifSanctionDisciplinaire->getIdMotiSancdisc()));
        }

        return $this->render('@Referenciel/refmotifsanctiondisciplinaire/new.html.twig', array(
                    'refMotifSanctionDisciplinaire' => $refMotifSanctionDisciplinaire,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RefMotifSanctionDisciplinaire entity.
     *
     */
    public function showAction(RefMotifSanctionDisciplinaire $refMotifSanctionDisciplinaire) {
        $deleteForm = $this->createDeleteForm($refMotifSanctionDisciplinaire);

        return $this->render('@Referenciel/refmotifsanctiondisciplinaire/show.html.twig', array(
                    'refMotifSanctionDisciplinaire' => $refMotifSanctionDisciplinaire,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RefMotifSanctionDisciplinaire entity.
     *
     */
    public function editAction(Request $request, RefMotifSanctionDisciplinaire $refMotifSanctionDisciplinaire) {
        $deleteForm = $this->createDeleteForm($refMotifSanctionDisciplinaire);
        $editForm = $this->createForm(RefMotifSanctionDisciplinaireType::class, $refMotifSanctionDisciplinaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refMotifSanctionDisciplinaire->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refmotifsanctiondisciplinaire_edit', array('idMotiSancdisc' => $refMotifSanctionDisciplinaire->getIdMotiSancdisc()));
        }

        return $this->render('@Referenciel/refmotifsanctiondisciplinaire/edit.html.twig', array(
                    'refMotifSanctionDisciplinaire' => $refMotifSanctionDisciplinaire,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RefMotifSanctionDisciplinaire entity.
     *
     */
    public function deleteAction(Request $request, RefMotifSanctionDisciplinaire $refMotifSanctionDisciplinaire) {
        $form = $this->createDeleteForm($refMotifSanctionDisciplinaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refMotifSanctionDisciplinaire->setBlVali(1);
            $em->flush($refMotifSanctionDisciplinaire);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refmotifsanctiondisciplinaire_index');
    }

    /**
     * Creates a form to delete a RefMotifSanctionDisciplinaire entity.
     *
     * @param RefSanctionDisciplinaire RefSanctionDisciplinaire The RefSanctionDisciplinaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefMotifSanctionDisciplinaire $refMotifSanctionDisciplinaire) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refmotifsanctiondisciplinaire_delete', array('idMotiSancdisc' => $refMotifSanctionDisciplinaire->getIdMotiSancdisc())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refMotifSanctionDisciplinaire",
            'requete_sql' => "SELECT CD_MOTISANCDISC as 'Code' ,LB_MOTISANCDISC as 'Libellé', "
            . "(CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé'  "
            . "FROM `ref_motif_sanction_disciplinaire` ",
            'champ' => array('Code', 'Libellé',
                'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
