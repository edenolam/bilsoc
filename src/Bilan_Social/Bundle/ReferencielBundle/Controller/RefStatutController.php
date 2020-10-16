<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefStatutType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refstatut controller.
 *
 */
class RefStatutController extends Controller {

    /**
     * Lists all refStatut entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refStatuts = $em->getRepository('ReferencielBundle:RefStatut')->findAll();

        return $this->render('@Referenciel/refstatut/index.html.twig', array(
                    'refStatuts' => $refStatuts,
        ));
    }

    /**
     * Creates a new refStatut entity.
     *
     */
    public function newAction(Request $request) {
        $refStatut = new Refstatut();
        $form = $this->createForm(RefStatutType::class, $refStatut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refStatut->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refStatut);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('refstatut_show', array('idStat' => $refStatut->getIdstat()));
        }

        return $this->render('@Referenciel/refstatut/new.html.twig', array(
                    'refStatut' => $refStatut,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refStatut entity.
     *
     */
    public function showAction(RefStatut $refStatut) {
        $deleteForm = $this->createDeleteForm($refStatut);

        return $this->render('@Referenciel/refstatut/show.html.twig', array(
                    'refStatut' => $refStatut,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refStatut entity.
     *
     */
    public function editAction(Request $request, RefStatut $refStatut) {
        $deleteForm = $this->createDeleteForm($refStatut);
        $editForm = $this->createForm(RefStatutType::class, $refStatut);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refStatut->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('refstatut_edit', array('idStat' => $refStatut->getIdstat()));
        }

        return $this->render('@Referenciel/refstatut/edit.html.twig', array(
                    'refStatut' => $refStatut,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refStatut entity.
     *
     */
    public function deleteAction(Request $request, RefStatut $refStatut) {
        $form = $this->createDeleteForm($refStatut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refStatut->setBlVali(1);
            $em->flush($refStatut);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refstatut_index');
    }

    /**
     * Creates a form to delete a refStatut entity.
     *
     * @param RefStatut $refStatut The refStatut entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefStatut $refStatut) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refstatut_delete', array('idStat' => $refStatut->getIdstat())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refStatut",
            'requete_sql' => "SELECT `CD_STAT` as 'Code' ,`LB_STAT` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_statut`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
