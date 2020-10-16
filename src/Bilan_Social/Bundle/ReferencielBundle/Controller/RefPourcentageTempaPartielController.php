<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefPourcentageTempaPartiel;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefPourcentageTempaPartielType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refpourcentagetempapartiel controller.
 *
 */
class RefPourcentageTempaPartielController extends Controller {

    /**
     * Lists all refPourcentageTempaPartiel entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refPourcentageTempaPartiels = $em->getRepository('ReferencielBundle:RefPourcentageTempaPartiel')->findAll();

        return $this->render('@Referenciel/refpourcentagetempapartiel/index.html.twig', array(
                    'refPourcentageTempaPartiels' => $refPourcentageTempaPartiels,
        ));
    }

    /**
     * Creates a new refPourcentageTempaPartiel entity.
     *
     */
    public function newAction(Request $request) {
        $refPourcentageTempaPartiel = new Refpourcentagetempapartiel();
        $form = $this->createForm(RefPourcentageTempaPartielType::class, $refPourcentageTempaPartiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refPourcentageTempaPartiel->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refPourcentageTempaPartiel);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('refpourcentagetempapartiel_show', array('idPourtemppart' => $refPourcentageTempaPartiel->getIdpourtemppart()));
        }

        return $this->render('@Referenciel/refpourcentagetempapartiel/new.html.twig', array(
                    'refPourcentageTempaPartiel' => $refPourcentageTempaPartiel,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refPourcentageTempaPartiel entity.
     *
     */
    public function showAction(RefPourcentageTempaPartiel $refPourcentageTempaPartiel) {
        $deleteForm = $this->createDeleteForm($refPourcentageTempaPartiel);

        return $this->render('@Referenciel/refpourcentagetempapartiel/show.html.twig', array(
                    'refPourcentageTempaPartiel' => $refPourcentageTempaPartiel,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refPourcentageTempaPartiel entity.
     *
     */
    public function editAction(Request $request, RefPourcentageTempaPartiel $refPourcentageTempaPartiel) {
        $deleteForm = $this->createDeleteForm($refPourcentageTempaPartiel);
        $editForm = $this->createForm(RefPourcentageTempaPartielType::class, $refPourcentageTempaPartiel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refPourcentageTempaPartiel->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('refpourcentagetempapartiel_edit', array('idPourtemppart' => $refPourcentageTempaPartiel->getIdpourtemppart()));
        }

        return $this->render('@Referenciel/refpourcentagetempapartiel/edit.html.twig', array(
                    'refPourcentageTempaPartiel' => $refPourcentageTempaPartiel,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refPourcentageTempaPartiel entity.
     *
     */
    public function deleteAction(Request $request, RefPourcentageTempaPartiel $refPourcentageTempaPartiel) {
        $form = $this->createDeleteForm($refPourcentageTempaPartiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refPourcentageTempaPartiel->setBlVali(1);
            $em->flush($refPourcentageTempaPartiel);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refpourcentagetempapartiel_index');
    }

    /**
     * Creates a form to delete a refPourcentageTempaPartiel entity.
     *
     * @param RefPourcentageTempaPartiel $refPourcentageTempaPartiel The refPourcentageTempaPartiel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefPourcentageTempaPartiel $refPourcentageTempaPartiel) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refpourcentagetempapartiel_delete', array('idPourtemppart' => $refPourcentageTempaPartiel->getIdpourtemppart())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refPourcentageTempaPartiel",
            'requete_sql' => "SELECT `CD_POURTEMPPART` as 'Code' ,`LB_POURTEMPPART` as 'Libellé', `PC_BORNMIN` as 'Borne Min', `PC_BORNMAX` as 'Borne Max', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_pourcentage_tempa_partiel`",
            'champ' => array('Code', 'Libellé', 'Borne Min', 'Borne Max', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
