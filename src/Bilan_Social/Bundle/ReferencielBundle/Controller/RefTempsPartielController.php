<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsPartiel;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefTempsPartielType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reftempspartiel controller.
 *
 */
class RefTempsPartielController extends Controller {

    /**
     * Lists all refTempsPartiel entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refTempsPartiels = $em->getRepository('ReferencielBundle:RefTempsPartiel')->findAll();

        return $this->render('@Referenciel/reftempspartiel/index.html.twig', array(
                    'refTempsPartiels' => $refTempsPartiels,
        ));
    }

    /**
     * Creates a new refTempsPartiel entity.
     *
     */
    public function newAction(Request $request) {
        $refTempsPartiel = new Reftempspartiel();
        $form = $this->createForm(RefTempsPartielType::class, $refTempsPartiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refTempsPartiel);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('reftempspartiel_show', array('idTemppart' => $refTempsPartiel->getIdtemppart()));
        }

        return $this->render('@Referenciel/reftempspartiel/new.html.twig', array(
                    'refTempsPartiel' => $refTempsPartiel,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refTempsPartiel entity.
     *
     */
    public function showAction(RefTempsPartiel $refTempsPartiel) {
        $deleteForm = $this->createDeleteForm($refTempsPartiel);

        return $this->render('@Referenciel/reftempspartiel/show.html.twig', array(
                    'refTempsPartiel' => $refTempsPartiel,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refTempsPartiel entity.
     *
     */
    public function editAction(Request $request, RefTempsPartiel $refTempsPartiel) {
        $deleteForm = $this->createDeleteForm($refTempsPartiel);
        $editForm = $this->createForm(RefTempsPartielType::class, $refTempsPartiel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('reftempspartiel_edit', array('idTemppart' => $refTempsPartiel->getIdtemppart()));
        }

        return $this->render('@Referenciel/reftempspartiel/edit.html.twig', array(
                    'refTempsPartiel' => $refTempsPartiel,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refTempsPartiel entity.
     *
     */
    public function deleteAction(Request $request, RefTempsPartiel $refTempsPartiel) {
        $form = $this->createDeleteForm($refTempsPartiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refTempsPartiel->setBlVali(1);
            $em->flush($refTempsPartiel);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('reftempspartiel_index');
    }

    /**
     * Creates a form to delete a refTempsPartiel entity.
     *
     * @param RefTempsPartiel $refTempsPartiel The refTempsPartiel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefTempsPartiel $refTempsPartiel) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reftempspartiel_delete', array('idTemppart' => $refTempsPartiel->getIdtemppart())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refTempsPartiel",
            'requete_sql' => "SELECT `CD_TEMPPART` as 'Code' ,`LB_TEMPPART` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_temps_partiel`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
