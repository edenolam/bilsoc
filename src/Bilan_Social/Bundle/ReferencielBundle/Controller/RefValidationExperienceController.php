<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefValidationExperience;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefValidationExperienceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refvalidationexperience controller.
 *
 */
class RefValidationExperienceController extends Controller {

    /**
     * Lists all refValidationExperience entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refValidationExperiences = $em->getRepository('ReferencielBundle:RefValidationExperience')->findAll();

        return $this->render('@Referenciel/refvalidationexperience/index.html.twig', array(
                    'refValidationExperiences' => $refValidationExperiences,
        ));
    }

    /**
     * Creates a new refValidationExperience entity.
     *
     */
    public function newAction(Request $request) {
        $refValidationExperience = new Refvalidationexperience();
        $form = $this->createForm(RefValidationExperienceType::class, $refValidationExperience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refValidationExperience->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refValidationExperience);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('refvalidationexperience_show', array('idEbcf' => $refValidationExperience->getIdebcf()));
        }

        return $this->render('@Referenciel/refvalidationexperience/new.html.twig', array(
                    'refValidationExperience' => $refValidationExperience,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refValidationExperience entity.
     *
     */
    public function showAction(RefValidationExperience $refValidationExperience) {
        $deleteForm = $this->createDeleteForm($refValidationExperience);

        return $this->render('@Referenciel/refvalidationexperience/show.html.twig', array(
                    'refValidationExperience' => $refValidationExperience,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refValidationExperience entity.
     *
     */
    public function editAction(Request $request, RefValidationExperience $refValidationExperience) {
        $deleteForm = $this->createDeleteForm($refValidationExperience);
        $editForm = $this->createForm(RefValidationExperienceType::class, $refValidationExperience);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refValidationExperience->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('refvalidationexperience_edit', array('idEbcf' => $refValidationExperience->getIdebcf()));
        }

        return $this->render('@Referenciel/refvalidationexperience/edit.html.twig', array(
                    'refValidationExperience' => $refValidationExperience,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refValidationExperience entity.
     *
     */
    public function deleteAction(Request $request, RefValidationExperience $refValidationExperience) {
        $form = $this->createDeleteForm($refValidationExperience);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refValidationExperience->setBlVali(1);
            $em->flush($refValidationExperience);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refvalidationexperience_index');
    }

    /**
     * Creates a form to delete a refValidationExperience entity.
     *
     * @param RefValidationExperience $refValidationExperience The refValidationExperience entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefValidationExperience $refValidationExperience) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refvalidationexperience_delete', array('idEbcf' => $refValidationExperience->getIdebcf())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refValidationExperience",
            'requete_sql' => "SELECT `CD_EBCF` as 'Code' ,`LB_EBCF` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_validation_experience`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
