<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefGroupePositionStatutaire;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefGroupePositionStatutaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refgroupepositionstatutaire controller.
 *
 */
class RefGroupePositionStatutaireController extends Controller {

    /**
     * Lists all refGroupePositionStatutaire entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refGroupePositionStatutaires = $em->getRepository('ReferencielBundle:RefGroupePositionStatutaire')->findAll();

        return $this->render('@Referenciel/refgroupepositionstatutaire/index.html.twig', array(
                    'refGroupePositionStatutaires' => $refGroupePositionStatutaires,
        ));
    }

    /**
     * Creates a new refGroupePositionStatutaire entity.
     *
     */
    public function newAction(Request $request) {
        $refGroupePositionStatutaire = new Refgroupepositionstatutaire();
        $form = $this->createForm(RefGroupePositionStatutaireType::class, $refGroupePositionStatutaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refGroupePositionStatutaire->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refGroupePositionStatutaire);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refgroupepositionstatutaire_show', array('idGrouPosistat' => $refGroupePositionStatutaire->getIdgrouposistat()));
        }

        return $this->render('@Referenciel/refgroupepositionstatutaire/new.html.twig', array(
                    'refGroupePositionStatutaire' => $refGroupePositionStatutaire,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refGroupePositionStatutaire entity.
     *
     */
    public function showAction(RefGroupePositionStatutaire $refGroupePositionStatutaire) {
        $deleteForm = $this->createDeleteForm($refGroupePositionStatutaire);

        return $this->render('@Referenciel/refgroupepositionstatutaire/show.html.twig', array(
                    'refGroupePositionStatutaire' => $refGroupePositionStatutaire,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refGroupePositionStatutaire entity.
     *
     */
    public function editAction(Request $request, RefGroupePositionStatutaire $refGroupePositionStatutaire) {
        $deleteForm = $this->createDeleteForm($refGroupePositionStatutaire);
        $editForm = $this->createForm(RefGroupePositionStatutaireType::class, $refGroupePositionStatutaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refGroupePositionStatutaire->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
            return $this->redirectToRoute('refgroupepositionstatutaire_edit', array('idGrouPosistat' => $refGroupePositionStatutaire->getIdgrouposistat()));
        }

        return $this->render('@Referenciel/refgroupepositionstatutaire/edit.html.twig', array(
                    'refGroupePositionStatutaire' => $refGroupePositionStatutaire,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refGroupePositionStatutaire entity.
     *
     */
    public function deleteAction(Request $request, RefGroupePositionStatutaire $refGroupePositionStatutaire) {
        $form = $this->createDeleteForm($refGroupePositionStatutaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refGroupePositionStatutaire->setBlVali(1);
            $em->flush($refGroupePositionStatutaire);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refgroupepositionstatutaire_index');
    }

    /**
     * Creates a form to delete a refGroupePositionStatutaire entity.
     *
     * @param RefGroupePositionStatutaire $refGroupePositionStatutaire The refGroupePositionStatutaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefGroupePositionStatutaire $refGroupePositionStatutaire) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refgroupepositionstatutaire_delete', array('idGrouPosistat' => $refGroupePositionStatutaire->getIdgrouposistat())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refGroupePositionStatutaire",
            'requete_sql' => "SELECT CD_GROUPOSISTAT as 'Code' ,LB_GROUPOSISTAT as 'Libellé', LB_GROUCOMPL as 'Complément',  LB_GROUCOMM as 'Commentaire', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé'  FROM `ref_groupe_position_statutaire` ",
            'champ' => array('Code', 'Libellé', 'Complément', 'Commentaire', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
