<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefActionPrevention;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefActionPreventionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refacteviolencephysique controller.
 *
 */
class RefActionPreventionController extends Controller {

    /**
     * Lists all refActionPrevention entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refActionsPreventions = $em->getRepository('ReferencielBundle:RefActionPrevention')->findAll();

        return $this->render('@Referenciel/refactionprevention/index.html.twig', array(
                    'refActionsPreventions' => $refActionsPreventions,
        ));
    }

    /**
     * Creates a new refActionPrevention entity.
     *
     */
    public function newAction(Request $request) {
        $refActionPrevention = new RefActionPrevention();
        $form = $this->createForm(RefActionPreventionType::class, $refActionPrevention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refActionPrevention->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refActionPrevention);
            $em->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refactionprevention_show', array('idActionprev' => $refActionPrevention->getIdActionPrev()));
        }

        return $this->render('@Referenciel/refactionprevention/new.html.twig', array(
                    'refActionPrevention' => $refActionPrevention,
                    'form'                => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refActionPrevention entity.
     *
     */
    public function showAction(RefActionPrevention $refActionPrevention) {
        $deleteForm = $this->createDeleteForm($refActionPrevention);

        return $this->render('@Referenciel/refactionprevention/show.html.twig', array(
                    'refActionPrevention' => $refActionPrevention,
                    'delete_form'         => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refActionPrevention entity.
     *
     */
    public function editAction(Request $request, RefActionPrevention $refActionPrevention) {
        $deleteForm = $this->createDeleteForm($refActionPrevention);
        $editForm = $this->createForm(RefActionPreventionType::class, $refActionPrevention);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refActionPrevention->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refactionprevention_edit', array('idActionprev' => $refActionPrevention->getIdActionPrev()));
        }

        return $this->render('@Referenciel/refactionprevention/edit.html.twig', array(
                    'refActionPrevention' => $refActionPrevention,
                    'edit_form'           => $editForm->createView(),
                    'delete_form'         => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refActionPrevention entity.
     *
     */
    public function deleteAction(Request $request, RefActionPrevention $refActionPrevention) {


        $form = $this->createDeleteForm($refActionPrevention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refActionPrevention->setBlVali(1);
            $em->flush($refActionPrevention);

            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refactionprevention_index');
    }

    /**
     * Creates a form to delete a refActionPrevention entity.
     *
     * @param RefActionPrevention $refActionPrevention The refActionPrevention entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefActionPrevention $refActionPrevention) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refactionprevention_delete', array('idActionprev' => $refActionPrevention->getIdActionprev())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename'    => "refActionPrevention",
            'requete_sql' => "SELECT `CD_ACTIONPREV` as 'Code' ,`LB_ACTIONPREV` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_action_prevention`",
            'champ'       => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
