<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefActeViolencePhysique;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefActeViolencePhysiqueType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refacteviolencephysique controller.
 *
 */
class RefActeViolencePhysiqueController extends Controller {

    /**
     * Lists all refActeViolencePhysique entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refActeViolencePhysiques = $em->getRepository('ReferencielBundle:RefActeViolencePhysique')->findAll();

        return $this->render('@Referenciel/refacteviolencephysique/index.html.twig', array(
                    'refActeViolencePhysiques' => $refActeViolencePhysiques,
        ));
    }

    /**
     * Creates a new refActeViolencePhysique entity.
     *
     */
    public function newAction(Request $request) {
        $refActeViolencePhysique = new Refacteviolencephysique();
        $form = $this->createForm(RefActeViolencePhysiqueType::class, $refActeViolencePhysique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refActeViolencePhysique->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refActeViolencePhysique);
            $em->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refacteviolencephysique_show', array('idActeviolphys' => $refActeViolencePhysique->getIdacteviolphys()));
        }

        return $this->render('@Referenciel/refacteviolencephysique/new.html.twig', array(
                    'refActeViolencePhysique' => $refActeViolencePhysique,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refActeViolencePhysique entity.
     *
     */
    public function showAction(RefActeViolencePhysique $refActeViolencePhysique) {
        $deleteForm = $this->createDeleteForm($refActeViolencePhysique);

        return $this->render('@Referenciel/refacteviolencephysique/show.html.twig', array(
                    'refActeViolencePhysique' => $refActeViolencePhysique,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refActeViolencePhysique entity.
     *
     */
    public function editAction(Request $request, RefActeViolencePhysique $refActeViolencePhysique) {
        $deleteForm = $this->createDeleteForm($refActeViolencePhysique);
        $editForm = $this->createForm(RefActeViolencePhysiqueType::class, $refActeViolencePhysique);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refActeViolencePhysique->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refacteviolencephysique_edit', array('idActeviolphys' => $refActeViolencePhysique->getIdacteviolphys()));
        }

        return $this->render('@Referenciel/refacteviolencephysique/edit.html.twig', array(
                    'refActeViolencePhysique' => $refActeViolencePhysique,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refActeViolencePhysique entity.
     *
     */
    public function deleteAction(Request $request, RefActeViolencePhysique $refActeViolencePhysique) {


        $form = $this->createDeleteForm($refActeViolencePhysique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refActeViolencePhysique->setBlVali(1);
            $em->flush($refActeViolencePhysique);

            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refacteviolencephysique_index');
    }

    /**
     * Creates a form to delete a refActeViolencePhysique entity.
     *
     * @param RefActeViolencePhysique $refActeViolencePhysique The refActeViolencePhysique entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefActeViolencePhysique $refActeViolencePhysique) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refacteviolencephysique_delete', array('idActeviolphys' => $refActeViolencePhysique->getIdacteviolphys())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refActeViolencePhysique",
            'requete_sql' => "SELECT `CD_ACTVIOLPHYS` as 'Code' ,`LB_ACTVIOLPHYS` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_acte_violence_physique`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
