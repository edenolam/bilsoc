<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFormation;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefFormationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refformation controller.
 *
 */
class RefFormationController extends Controller {

    /**
     * Lists all refFormation entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refFormations = $em->getRepository('ReferencielBundle:RefFormation')->findAll();

        return $this->render('@Referenciel/refformation/index.html.twig', array(
                    'refFormations' => $refFormations,
        ));
    }

    /**
     * Creates a new refFormation entity.
     *
     */
    public function newAction(Request $request) {
        $refFormation = new Refformation();
        $form = $this->createForm(RefFormationType::class, $refFormation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refFormation->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refFormation);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refformation_show', array('idForm' => $refFormation->getIdform()));
        }

        return $this->render('@Referenciel/refformation/new.html.twig', array(
                    'refFormation' => $refFormation,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refFormation entity.
     *
     */
    public function showAction(RefFormation $refFormation) {
        $deleteForm = $this->createDeleteForm($refFormation);

        return $this->render('@Referenciel/refformation/show.html.twig', array(
                    'refFormation' => $refFormation,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refFormation entity.
     *
     */
    public function editAction(Request $request, RefFormation $refFormation) {
        $deleteForm = $this->createDeleteForm($refFormation);
        $editForm = $this->createForm(RefFormationType::class, $refFormation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refFormation->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refformation_edit', array('idForm' => $refFormation->getIdform()));
        }

        return $this->render('@Referenciel/refformation/edit.html.twig', array(
                    'refFormation' => $refFormation,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refFormation entity.
     *
     */
    public function deleteAction(Request $request, RefFormation $refFormation) {
        $form = $this->createDeleteForm($refFormation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refFormation->setBlVali(1);
            $em->flush($refFormation);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refformation_index');
    }

    /**
     * Creates a form to delete a refFormation entity.
     *
     * @param RefFormation $refFormation The refFormation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefFormation $refFormation) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refformation_delete', array('idForm' => $refFormation->getIdform())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refFormation",
            'requete_sql' => "SELECT `CD_FORM` as 'Code' ,`LB_FORM` as 'Libellé', `BL_PREV` as 'Prévention', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_formation`",
            'champ' => array('Code', 'Libellé', 'Prévention', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
