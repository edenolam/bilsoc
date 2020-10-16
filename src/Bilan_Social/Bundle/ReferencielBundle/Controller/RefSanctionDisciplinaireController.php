<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSanctionDisciplinaire;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefSanctionDisciplinaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * RefSanctionDisciplinaire controller.
 *
 */
class RefSanctionDisciplinaireController extends Controller {

    /**
     * Lists all RefSanctionDisciplinaire entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refSanctionDisciplinaires = $em->getRepository('ReferencielBundle:RefSanctionDisciplinaire')->findAll();

        return $this->render('@Referenciel/refsanctiondisciplinaire/index.html.twig', array(
                    'refSanctionDisciplinaires' => $refSanctionDisciplinaires,
        ));
    }

    /**
     * Creates a new RefSanctionDisciplinaire entity.
     *
     */
    public function newAction(Request $request) {
        $refSanctionDisciplinaire = new RefSanctionDisciplinaire();
        $form = $this->createForm(RefSanctionDisciplinaireType::class, $refSanctionDisciplinaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refSanctionDisciplinaire->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refSanctionDisciplinaire);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refsanctiondisciplinaire_show', array('idSancdisc' => $refSanctionDisciplinaire->getIdSancdisc()));
        }

        return $this->render('@Referenciel/refsanctiondisciplinaire/new.html.twig', array(
                    'refSanctionDisciplinaire' => $refSanctionDisciplinaire,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RefSanctionDisciplinaire entity.
     *
     */
    public function showAction(RefSanctionDisciplinaire $refSanctionDisciplinaire) {
        $deleteForm = $this->createDeleteForm($refSanctionDisciplinaire);

        return $this->render('@Referenciel/refsanctiondisciplinaire/show.html.twig', array(
                    'refSanctionDisciplinaire' => $refSanctionDisciplinaire,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RefSanctionDisciplinaire entity.
     *
     */
    public function editAction(Request $request, RefSanctionDisciplinaire $refSanctionDisciplinaire) {
        $deleteForm = $this->createDeleteForm($refSanctionDisciplinaire);
        $editForm = $this->createForm(RefSanctionDisciplinaireType::class, $refSanctionDisciplinaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refSanctionDisciplinaire->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refsanctiondisciplinaire_edit', array('idSancdisc' => $refSanctionDisciplinaire->getIdSancdisc()));
        }

        return $this->render('@Referenciel/refsanctiondisciplinaire/edit.html.twig', array(
                    'refSanctionDisciplinaire' => $refSanctionDisciplinaire,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RefSanctionDisciplinaire entity.
     *
     */
    public function deleteAction(Request $request, RefSanctionDisciplinaire $refSanctionDisciplinaire) {
        $form = $this->createDeleteForm($refSanctionDisciplinaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refSanctionDisciplinaire->setBlVali(1);
            $em->flush($refSanctionDisciplinaire);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refsanctiondisciplinaire_index');
    }

    /**
     * Creates a form to delete a RefSanctionDisciplinaire entity.
     *
     * @param RefSanctionDisciplinaire RefSanctionDisciplinaire The RefSanctionDisciplinaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefSanctionDisciplinaire $refSanctionDisciplinaire) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refsanctiondisciplinaire_delete', array('idSancdisc' => $refSanctionDisciplinaire->getIdSancdisc())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refSanctionDisciplinaire",
            'requete_sql' => "SELECT CD_SANCDISC as 'Code' ,LB_SANCDISC as 'Libellé', "
            . "(CASE WHEN BL_BL_714_G1 <> 0 THEN 'Non' ELSE 'Oui' END) as 'Sanction groupe 1',  "
            . "(CASE WHEN BL_BL_714_G2 <> 0 THEN 'Non' ELSE 'Oui' END) as 'Sanction groupe 2',  "
            . "(CASE WHEN BL_BL_714_G3 <> 0 THEN 'Non' ELSE 'Oui' END) as 'Sanction groupe 3',  "
            . "(CASE WHEN BL_BL_714_G4 <> 0 THEN 'Non' ELSE 'Oui' END) as 'Sanction groupe 4',  "
            . "(CASE WHEN BL_BL_714_G5 <> 0 THEN 'Non' ELSE 'Oui' END) as 'Sanction stagiaire',  "
            . "(CASE WHEN BL_BL_714_G6 <> 0 THEN 'Non' ELSE 'Oui' END) as 'Sanction agent contractuel',  "
            . "(CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé'  "
            . "FROM `ref_sanction_disciplinaire` ",
            'champ' => array('Code', 'Libellé',
                'Sanction groupe 1',
                'Sanction groupe 2',
                'Sanction groupe 3',
                'Sanction groupe 4',
                'Sanction stagiaire',
                'Sanction agent contractuel',
                'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
