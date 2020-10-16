<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStructureOrigine;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefStructureOrigineType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refstructureorigine controller.
 *
 */
class RefStructureOrigineController extends Controller {

    /**
     * Lists all refStructureOrigine entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refStructureOrigines = $em->getRepository('ReferencielBundle:RefStructureOrigine')->findAll();

        return $this->render('@Referenciel/refstructureorigine/index.html.twig', array(
                    'refStructureOrigines' => $refStructureOrigines,
        ));
    }

    /**
     * Creates a new refStructureOrigine entity.
     *
     */
    public function newAction(Request $request) {
        $refStructureOrigine = new Refstructureorigine();
        $form = $this->createForm(RefStructureOrigineType::class, $refStructureOrigine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refStructureOrigine->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refStructureOrigine);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('refstructureorigine_show', array('idStruorig' => $refStructureOrigine->getIdstruorig()));
        }

        return $this->render('@Referenciel/refstructureorigine/new.html.twig', array(
                    'refStructureOrigine' => $refStructureOrigine,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refStructureOrigine entity.
     *
     */
    public function showAction(RefStructureOrigine $refStructureOrigine) {
        $deleteForm = $this->createDeleteForm($refStructureOrigine);

        return $this->render('@Referenciel/refstructureorigine/show.html.twig', array(
                    'refStructureOrigine' => $refStructureOrigine,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refStructureOrigine entity.
     *
     */
    public function editAction(Request $request, RefStructureOrigine $refStructureOrigine) {
        $deleteForm = $this->createDeleteForm($refStructureOrigine);
        $editForm = $this->createForm(RefStructureOrigineType::class, $refStructureOrigine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refStructureOrigine->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('refstructureorigine_edit', array('idStruorig' => $refStructureOrigine->getIdstruorig()));
        }

        return $this->render('@Referenciel/refstructureorigine/edit.html.twig', array(
                    'refStructureOrigine' => $refStructureOrigine,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refStructureOrigine entity.
     *
     */
    public function deleteAction(Request $request, RefStructureOrigine $refStructureOrigine) {
        $form = $this->createDeleteForm($refStructureOrigine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refStructureOrigine->setBlVali(1);
            $em->flush($refStructureOrigine);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refstructureorigine_index');
    }

    /**
     * Creates a form to delete a refStructureOrigine entity.
     *
     * @param RefStructureOrigine $refStructureOrigine The refStructureOrigine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefStructureOrigine $refStructureOrigine) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refstructureorigine_delete', array('idStruorig' => $refStructureOrigine->getIdstruorig())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refStructureOrigine",
            'requete_sql' => "SELECT `CD_STRUORIG` as 'Code' ,`LB_STRUORIG` as 'Libellé' FROM `ref_structure_origine`",
            'champ' => array('Code', 'Libellé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
