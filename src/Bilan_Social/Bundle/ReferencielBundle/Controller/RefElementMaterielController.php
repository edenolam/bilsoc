<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefElementMateriel;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefElementMaterielType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refacteviolencephysique controller.
 *
 */
class RefElementMaterielController extends Controller {

    /**
     * Lists all refElementMateriel entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refElementMateriels = $em->getRepository('ReferencielBundle:RefElementMateriel')->findAll();

        return $this->render('@Referenciel/refelementmateriel/index.html.twig', array(
                    'refElementMateriels' => $refElementMateriels,
        ));
    }

    /**
     * Creates a new refElementMateriel entity.
     *
     */
    public function newAction(Request $request) {
        $refElementMateriel = new RefElementMateriel();
        $form = $this->createForm(RefElementMaterielType::class, $refElementMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refElementMateriel->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refElementMateriel);
            $em->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refelementmateriel_show', array('idElementmat' => $refElementMateriel->getIdElementmat()));
        }

        return $this->render('@Referenciel/refelementmateriel/new.html.twig', array(
                    'refElementMateriel' => $refElementMateriel,
                    'form'               => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refElementMateriel entity.
     *
     */
    public function showAction(RefElementMateriel $refElementMateriel) {
        $deleteForm = $this->createDeleteForm($refElementMateriel);

        return $this->render('@Referenciel/refelementmateriel/show.html.twig', array(
                    'refElementMateriel' => $refElementMateriel,
                    'delete_form'        => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refElementMateriel entity.
     *
     */
    public function editAction(Request $request, RefElementMateriel $refElementMateriel) {
        $deleteForm = $this->createDeleteForm($refElementMateriel);
        $editForm = $this->createForm(RefElementMaterielType::class, $refElementMateriel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refElementMateriel->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refelementmateriel_edit', array('idElementmat' => $refElementMateriel->getIdElementmat()));
        }

        return $this->render('@Referenciel/refelementmateriel/edit.html.twig', array(
                    'refElementMateriel' => $refElementMateriel,
                    'edit_form'          => $editForm->createView(),
                    'delete_form'        => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refElementMateriel entity.
     *
     */
    public function deleteAction(Request $request, RefElementMateriel $refElementMateriel) {


        $form = $this->createDeleteForm($refElementMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refElementMateriel->setBlVali(1);
            $em->flush($refElementMateriel);

            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refelementmateriel_index');
    }

    /**
     * Creates a form to delete a refElementMateriel entity.
     *
     * @param RefElementMateriel $refElementMateriel The refElementMateriel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefElementMateriel $refElementMateriel) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refelementmateriel_delete', array('idElementmat' => $refElementMateriel->getIdElementmat())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename'    => "refElementMateriel",
            'requete_sql' => "SELECT `CD_ELEMENT_MATERIEL` as 'Code' ,`LB_ELEMENT_MATERIEL` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_element_materiel`",
            'champ'       => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
