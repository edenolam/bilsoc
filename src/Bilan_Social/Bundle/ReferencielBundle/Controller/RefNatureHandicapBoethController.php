<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureHandicapBoeth;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefNatureHandicapBoethType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refacteviolencephysique controller.
 *
 */
class RefNatureHandicapBoethController extends Controller {

    /**
     * Lists all refNatureHandicapBoeth entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refNatureHandicapBoeths = $em->getRepository('ReferencielBundle:RefNatureHandicapBoeth')->findAll();

        return $this->render('@Referenciel/refnaturehandicapboeth/index.html.twig', array(
                    'refNatureHandicapBoeths' => $refNatureHandicapBoeths,
        ));
    }

    /**
     * Creates a new refNatureHandicapBoeth entity.
     *
     */
    public function newAction(Request $request) {
        $refNatureHandicapBoeth = new RefNatureHandicapBoeth();
        $form = $this->createForm(RefNatureHandicapBoethType::class, $refNatureHandicapBoeth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refNatureHandicapBoeth->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refNatureHandicapBoeth);
            $em->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refnaturehandicapboeth_show', array('idNathandiboeth' => $refNatureHandicapBoeth->getIdNathandiboeth()));
        }

        return $this->render('@Referenciel/refnaturehandicapboeth/new.html.twig', array(
                    'refNatureHandicapBoeth' => $refNatureHandicapBoeth,
                    'form'                   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refNatureHandicapBoeth entity.
     *
     */
    public function showAction(RefNatureHandicapBoeth $refNatureHandicapBoeth) {
        $deleteForm = $this->createDeleteForm($refNatureHandicapBoeth);

        return $this->render('@Referenciel/refnaturehandicapboeth/show.html.twig', array(
                    'refNatureHandicapBoeth' => $refNatureHandicapBoeth,
                    'delete_form'            => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refNatureHandicapBoeth entity.
     *
     */
    public function editAction(Request $request, RefNatureHandicapBoeth $refNatureHandicapBoeth) {
        $deleteForm = $this->createDeleteForm($refNatureHandicapBoeth);
        $editForm = $this->createForm(RefNatureHandicapBoethType::class, $refNatureHandicapBoeth);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refNatureHandicapBoeth->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refnaturehandicapboeth_edit', array('idNathandiboeth' => $refNatureHandicapBoeth->getIdNathandiboeth()));
        }

        return $this->render('@Referenciel/refnaturehandicapboeth/edit.html.twig', array(
                    'refNatureHandicapBoeth' => $refNatureHandicapBoeth,
                    'edit_form'              => $editForm->createView(),
                    'delete_form'            => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refNatureHandicapBoeth entity.
     *
     */
    public function deleteAction(Request $request, RefNatureHandicapBoeth $refNatureHandicapBoeth) {


        $form = $this->createDeleteForm($refNatureHandicapBoeth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refNatureHandicapBoeth->setBlVali(1);
            $em->flush($refNatureHandicapBoeth);

            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refnaturehandicapboeth_index');
    }

    /**
     * Creates a form to delete a refNatureHandicapBoeth entity.
     *
     * @param RefNatureHandicapBoeth $refNatureHandicapBoeth The refNatureHandicapBoeth entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefNatureHandicapBoeth $refNatureHandicapBoeth) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refnaturehandicapboeth_delete', array('idNathandiboeth' => $refNatureHandicapBoeth->getIdNathandiboeth())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename'    => "refNatureHandicapBoeth",
            'requete_sql' => "SELECT `CD_NATURE_HANDICAP_BOETH` as 'Code' ,`LB_NATURE_HANDICAP_BOETH` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_nature_handicap_boeth`",
            'champ'       => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
