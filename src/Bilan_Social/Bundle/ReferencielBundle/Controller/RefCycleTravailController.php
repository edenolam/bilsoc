<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCycleTravail;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefCycleTravailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refcycletravail controller.
 *
 */
class RefCycleTravailController extends Controller {

    /**
     * Lists all refCycleTravail entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refCycleTravails = $em->getRepository('ReferencielBundle:RefCycleTravail')->findAll();

        return $this->render('@Referenciel/refcycletravail/index.html.twig', array(
                    'refCycleTravails' => $refCycleTravails,
        ));
    }

    /**
     * Creates a new refCycleTravail entity.
     *
     */
    public function newAction(Request $request) {
        $refCycleTravail = new Refcycletravail();
        $form = $this->createForm(RefCycleTravailType::class, $refCycleTravail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refCycleTravail->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refCycleTravail);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refcycletravail_show', array('idCycltrav' => $refCycleTravail->getIdcycltrav()));
        }

        return $this->render('@Referenciel/refcycletravail/new.html.twig', array(
                    'refCycleTravail' => $refCycleTravail,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refCycleTravail entity.
     *
     */
    public function showAction(RefCycleTravail $refCycleTravail) {
        $deleteForm = $this->createDeleteForm($refCycleTravail);

        return $this->render('@Referenciel/refcycletravail/show.html.twig', array(
                    'refCycleTravail' => $refCycleTravail,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refCycleTravail entity.
     *
     */
    public function editAction(Request $request, RefCycleTravail $refCycleTravail) {
        $deleteForm = $this->createDeleteForm($refCycleTravail);
        $editForm = $this->createForm(RefCycleTravailType::class, $refCycleTravail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refCycleTravail->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refcycletravail_edit', array('idCycltrav' => $refCycleTravail->getIdcycltrav()));
        }

        return $this->render('@Referenciel/refcycletravail/edit.html.twig', array(
                    'refCycleTravail' => $refCycleTravail,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refCycleTravail entity.
     *
     */
    public function deleteAction(Request $request, RefCycleTravail $refCycleTravail) {
        $form = $this->createDeleteForm($refCycleTravail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refCycleTravail->setBlVali(1);
            $em->flush($refCycleTravail);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refcycletravail_index');
    }

    /**
     * Creates a form to delete a refCycleTravail entity.
     *
     * @param RefCycleTravail $refCycleTravail The refCycleTravail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefCycleTravail $refCycleTravail) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refcycletravail_delete', array('idCycltrav' => $refCycleTravail->getIdcycltrav())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refCycleTravail",
            'requete_sql' => "SELECT `CD_CYCLTRAV` as 'Code' ,`LB_CYCLTRAV` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_cycle_travail`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
