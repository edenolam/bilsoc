<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefMesureBoethType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refacteviolencephysique controller.
 *
 */
class RefMesureBoethController extends Controller {

    /**
     * Lists all refMesureBoeth entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refMesureBoeths = $em->getRepository('ReferencielBundle:RefMesureBoeth')->findAll();

        return $this->render('@Referenciel/refmesureboeth/index.html.twig', array(
                    'refMesureBoeths' => $refMesureBoeths,
        ));
    }

    /**
     * Creates a new refMesureBoeth entity.
     *
     */
    public function newAction(Request $request) {
        $refMesureBoeth = new RefMesureBoeth();
        $form = $this->createForm(RefMesureBoethType::class, $refMesureBoeth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refMesureBoeth->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refMesureBoeth);
            $em->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refmesureboeth_show', array('idMesureboeth' => $refMesureBoeth->getIdMesureboeth()));
        }

        return $this->render('@Referenciel/refmesureboeth/new.html.twig', array(
                    'refMesureBoeth' => $refMesureBoeth,
                    'form'           => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refMesureBoeth entity.
     *
     */
    public function showAction(RefMesureBoeth $refMesureBoeth) {
        $deleteForm = $this->createDeleteForm($refMesureBoeth);

        return $this->render('@Referenciel/refmesureboeth/show.html.twig', array(
                    'refMesureBoeth' => $refMesureBoeth,
                    'delete_form'    => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refMesureBoeth entity.
     *
     */
    public function editAction(Request $request, RefMesureBoeth $refMesureBoeth) {
        $deleteForm = $this->createDeleteForm($refMesureBoeth);
        $editForm = $this->createForm(RefMesureBoethType::class, $refMesureBoeth);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refMesureBoeth->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refmesureboeth_edit', array('idMesureboeth' => $refMesureBoeth->getIdMesureboeth()));
        }

        return $this->render('@Referenciel/refmesureboeth/edit.html.twig', array(
                    'refMesureBoeth' => $refMesureBoeth,
                    'edit_form'      => $editForm->createView(),
                    'delete_form'    => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refMesureBoeth entity.
     *
     */
    public function deleteAction(Request $request, RefMesureBoeth $refMesureBoeth) {


        $form = $this->createDeleteForm($refMesureBoeth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refMesureBoeth->setBlVali(1);
            $em->flush($refMesureBoeth);

            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refmesureboeth_index');
    }

    /**
     * Creates a form to delete a refMesureBoeth entity.
     *
     * @param RefMesureBoeth $refMesureBoeth The refMesureBoeth entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefMesureBoeth $refMesureBoeth) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refmesureboeth_delete', array('idMesureboeth' => $refMesureBoeth->getIdMesureboeth())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename'    => "refMesureBoeth",
            'requete_sql' => "SELECT `CD_MESURE_BOETH` as 'Code' ,`LB_MESURE_BOETH` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_mesure_boeth`",
            'champ'       => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
