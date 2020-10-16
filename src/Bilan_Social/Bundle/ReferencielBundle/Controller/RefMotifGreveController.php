<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifGreve;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefMotifGreveType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refmotifgreve controller.
 *
 */
class RefMotifGreveController extends Controller {

    /**
     * Lists all refMotifGreve entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refMotifGreves = $em->getRepository('ReferencielBundle:RefMotifGreve')->findAll();

        return $this->render('@Referenciel/refmotifgreve/index.html.twig', array(
                    'refMotifGreves' => $refMotifGreves,
        ));
    }

    /**
     * Creates a new refMotifGreve entity.
     *
     */
    public function newAction(Request $request) {
        $refMotifGreve = new Refmotifgreve();
        $form = $this->createForm(RefMotifGreveType::class, $refMotifGreve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refMotifGreve->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refMotifGreve);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('refmotifgreve_show', array('idMotigrev' => $refMotifGreve->getIdmotigrev()));
        }

        return $this->render('@Referenciel/refmotifgreve/new.html.twig', array(
                    'refMotifGreve' => $refMotifGreve,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refMotifGreve entity.
     *
     */
    public function showAction(RefMotifGreve $refMotifGreve) {
        $deleteForm = $this->createDeleteForm($refMotifGreve);

        return $this->render('@Referenciel/refmotifgreve/show.html.twig', array(
                    'refMotifGreve' => $refMotifGreve,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refMotifGreve entity.
     *
     */
    public function editAction(Request $request, RefMotifGreve $refMotifGreve) {
        $deleteForm = $this->createDeleteForm($refMotifGreve);
        $editForm = $this->createForm(RefMotifGreveType::class, $refMotifGreve);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refMotifGreve->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('refmotifgreve_edit', array('idMotigrev' => $refMotifGreve->getIdmotigrev()));
        }

        return $this->render('@Referenciel/refmotifgreve/edit.html.twig', array(
                    'refMotifGreve' => $refMotifGreve,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refMotifGreve entity.
     *
     */
    public function deleteAction(Request $request, RefMotifGreve $refMotifGreve) {
        $form = $this->createDeleteForm($refMotifGreve);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refMotifGreve->setBlVali(1);
            $em->flush($refMotifGreve);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refmotifgreve_index');
    }

    /**
     * Creates a form to delete a refMotifGreve entity.
     *
     * @param RefMotifGreve $refMotifGreve The refMotifGreve entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefMotifGreve $refMotifGreve) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refmotifgreve_delete', array('idMotigrev' => $refMotifGreve->getIdmotigrev())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refMotifGreve",
            'requete_sql' => "SELECT `CD_MOTIGREV` as 'Code' ,`LB_MOTIGREV` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_motif_greve`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
