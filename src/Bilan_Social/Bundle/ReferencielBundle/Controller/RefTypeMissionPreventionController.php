<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeMissionPrevention;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefTypeMissionPreventionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reftypemissionprevention controller.
 *
 */
class RefTypeMissionPreventionController extends Controller {

    /**
     * Lists all refTypeMissionPrevention entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refTypeMissionPreventions = $em->getRepository('ReferencielBundle:RefTypeMissionPrevention')->findAll();

        return $this->render('@Referenciel/reftypemissionprevention/index.html.twig', array(
                    'refTypeMissionPreventions' => $refTypeMissionPreventions,
        ));
    }

    /**
     * Creates a new refTypeMissionPrevention entity.
     *
     */
    public function newAction(Request $request) {
        $refTypeMissionPrevention = new Reftypemissionprevention();
        $form = $this->createForm(RefTypeMissionPreventionType::class, $refTypeMissionPrevention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refTypeMissionPrevention->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refTypeMissionPrevention);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('reftypemissionprevention_show', array('idTypemissprev' => $refTypeMissionPrevention->getIdtypemissprev()));
        }

        return $this->render('@Referenciel/reftypemissionprevention/new.html.twig', array(
                    'refTypeMissionPrevention' => $refTypeMissionPrevention,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refTypeMissionPrevention entity.
     *
     */
    public function showAction(RefTypeMissionPrevention $refTypeMissionPrevention) {
        $deleteForm = $this->createDeleteForm($refTypeMissionPrevention);

        return $this->render('@Referenciel/reftypemissionprevention/show.html.twig', array(
                    'refTypeMissionPrevention' => $refTypeMissionPrevention,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refTypeMissionPrevention entity.
     *
     */
    public function editAction(Request $request, RefTypeMissionPrevention $refTypeMissionPrevention) {
        $deleteForm = $this->createDeleteForm($refTypeMissionPrevention);
        $editForm = $this->createForm(RefTypeMissionPreventionType::class, $refTypeMissionPrevention);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refTypeMissionPrevention->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('reftypemissionprevention_edit', array('idTypemissprev' => $refTypeMissionPrevention->getIdtypemissprev()));
        }

        return $this->render('@Referenciel/reftypemissionprevention/edit.html.twig', array(
                    'refTypeMissionPrevention' => $refTypeMissionPrevention,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refTypeMissionPrevention entity.
     *
     */
    public function deleteAction(Request $request, RefTypeMissionPrevention $refTypeMissionPrevention) {
        $form = $this->createDeleteForm($refTypeMissionPrevention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refTypeMissionPrevention->setBlVali(1);
            $em->flush($refTypeMissionPrevention);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('reftypemissionprevention_index');
    }

    /**
     * Creates a form to delete a refTypeMissionPrevention entity.
     *
     * @param RefTypeMissionPrevention $refTypeMissionPrevention The refTypeMissionPrevention entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefTypeMissionPrevention $refTypeMissionPrevention) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reftypemissionprevention_delete', array('idTypemissprev' => $refTypeMissionPrevention->getIdtypemissprev())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refTypeMissionPrevention",
            'requete_sql' => "SELECT `CD_TYPEMISSPREV` as 'Code' ,`LB_TYPEMISSPREV` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_type_mission_prevention`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
