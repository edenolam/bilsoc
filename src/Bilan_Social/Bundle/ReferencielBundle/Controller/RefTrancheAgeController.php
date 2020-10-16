<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTrancheAge;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefTrancheAgeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reftrancheage controller.
 *
 */
class RefTrancheAgeController extends Controller {

    /**
     * Lists all refTrancheAge entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refTrancheAges = $em->getRepository('ReferencielBundle:RefTrancheAge')->findAll();

        return $this->render('@Referenciel/reftrancheage/index.html.twig', array(
                    'refTrancheAges' => $refTrancheAges,
        ));
    }

    /**
     * Creates a new refTrancheAge entity.
     *
     */
    public function newAction(Request $request) {
        $refTrancheAge = new Reftrancheage();
        $form = $this->createForm(RefTrancheAgeType::class, $refTrancheAge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refTrancheAge->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refTrancheAge);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('reftrancheage_show', array('idTranage' => $refTrancheAge->getIdtranage()));
        }

        return $this->render('@Referenciel/reftrancheage/new.html.twig', array(
                    'refTrancheAge' => $refTrancheAge,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refTrancheAge entity.
     *
     */
    public function showAction(RefTrancheAge $refTrancheAge) {
        $deleteForm = $this->createDeleteForm($refTrancheAge);

        return $this->render('@Referenciel/reftrancheage/show.html.twig', array(
                    'refTrancheAge' => $refTrancheAge,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refTrancheAge entity.
     *
     */
    public function editAction(Request $request, RefTrancheAge $refTrancheAge) {
        $deleteForm = $this->createDeleteForm($refTrancheAge);
        $editForm = $this->createForm(RefTrancheAgeType::class, $refTrancheAge);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refTrancheAge->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('reftrancheage_edit', array('idTranage' => $refTrancheAge->getIdtranage()));
        }

        return $this->render('@Referenciel/reftrancheage/edit.html.twig', array(
                    'refTrancheAge' => $refTrancheAge,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refTrancheAge entity.
     *
     */
    public function deleteAction(Request $request, RefTrancheAge $refTrancheAge) {
        $form = $this->createDeleteForm($refTrancheAge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refTrancheAge->setBlVali(1);
            $em->flush($refTrancheAge);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('reftrancheage_index');
    }

    /**
     * Creates a form to delete a refTrancheAge entity.
     *
     * @param RefTrancheAge $refTrancheAge The refTrancheAge entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefTrancheAge $refTrancheAge) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reftrancheage_delete', array('idTranage' => $refTrancheAge->getIdtranage())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refTrancheAg",
            'requete_sql' => "SELECT `CD_TRANAGE` as 'Code' ,`LB_TRANAGE` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_tranche_age`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
