<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStageTitularisation;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefStageTitularisationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refstagetitularisation controller.
 *
 */
class RefStageTitularisationController extends Controller {

    /**
     * Lists all refStageTitularisation entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refStageTitularisations = $em->getRepository('ReferencielBundle:RefStageTitularisation')->findAll();

        return $this->render('@Referenciel/refstagetitularisation/index.html.twig', array(
                    'refStageTitularisations' => $refStageTitularisations,
        ));
    }

    /**
     * Creates a new refStageTitularisation entity.
     *
     */
    public function newAction(Request $request) {
        $refStageTitularisation = new Refstagetitularisation();
        $form = $this->createForm(RefStageTitularisationType::class, $refStageTitularisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refStageTitularisation->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refStageTitularisation);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('refstagetitularisation_show', array('idStagtitu' => $refStageTitularisation->getIdstagtitu()));
        }

        return $this->render('@Referenciel/refstagetitularisation/new.html.twig', array(
                    'refStageTitularisation' => $refStageTitularisation,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refStageTitularisation entity.
     *
     */
    public function showAction(RefStageTitularisation $refStageTitularisation) {
        $deleteForm = $this->createDeleteForm($refStageTitularisation);

        return $this->render('@Referenciel/refstagetitularisation/show.html.twig', array(
                    'refStageTitularisation' => $refStageTitularisation,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refStageTitularisation entity.
     *
     */
    public function editAction(Request $request, RefStageTitularisation $refStageTitularisation) {
        $deleteForm = $this->createDeleteForm($refStageTitularisation);
        $editForm = $this->createForm(RefStageTitularisationType::class, $refStageTitularisation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refStageTitularisation->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('refstagetitularisation_edit', array('idStagtitu' => $refStageTitularisation->getIdstagtitu()));
        }

        return $this->render('@Referenciel/refstagetitularisation/edit.html.twig', array(
                    'refStageTitularisation' => $refStageTitularisation,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refStageTitularisation entity.
     *
     */
    public function deleteAction(Request $request, RefStageTitularisation $refStageTitularisation) {
        $form = $this->createDeleteForm($refStageTitularisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refStageTitularisation->setBlVali(1);
            $em->flush($refStageTitularisation);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refstagetitularisation_index');
    }

    /**
     * Creates a form to delete a refStageTitularisation entity.
     *
     * @param RefStageTitularisation $refStageTitularisation The refStageTitularisation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefStageTitularisation $refStageTitularisation) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refstagetitularisation_delete', array('idStagtitu' => $refStageTitularisation->getIdstagtitu())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refStageTitularisation",
            'requete_sql' => "SELECT `CD_STAGTITU` as 'Code' ,`LB_STAGTITU` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_stage_titularisation`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
