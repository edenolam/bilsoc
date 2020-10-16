<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefOrganismeFormation;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefOrganismeFormationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reforganismeformation controller.
 *
 */
class RefOrganismeFormationController extends Controller {

    /**
     * Lists all refOrganismeFormation entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refOrganismeFormations = $em->getRepository('ReferencielBundle:RefOrganismeFormation')->findAll();

        return $this->render('@Referenciel/reforganismeformation/index.html.twig', array(
                    'refOrganismeFormations' => $refOrganismeFormations,
        ));
    }

    /**
     * Creates a new refOrganismeFormation entity.
     *
     */
    public function newAction(Request $request) {
        $refOrganismeFormation = new Reforganismeformation();
        $form = $this->createForm(RefOrganismeFormationType::class, $refOrganismeFormation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refOrganismeFormation->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refOrganismeFormation);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('reforganismeformation_show', array('idOrgaform' => $refOrganismeFormation->getIdorgaform()));
        }

        return $this->render('@Referenciel/reforganismeformation/new.html.twig', array(
                    'refOrganismeFormation' => $refOrganismeFormation,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refOrganismeFormation entity.
     *
     */
    public function showAction(RefOrganismeFormation $refOrganismeFormation) {
        $deleteForm = $this->createDeleteForm($refOrganismeFormation);

        return $this->render('@Referenciel/reforganismeformation/show.html.twig', array(
                    'refOrganismeFormation' => $refOrganismeFormation,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refOrganismeFormation entity.
     *
     */
    public function editAction(Request $request, RefOrganismeFormation $refOrganismeFormation) {
        $deleteForm = $this->createDeleteForm($refOrganismeFormation);
        $editForm = $this->createForm(RefOrganismeFormationType::class, $refOrganismeFormation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refOrganismeFormation->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('reforganismeformation_edit', array('idOrgaform' => $refOrganismeFormation->getIdorgaform()));
        }

        return $this->render('@Referenciel/reforganismeformation/edit.html.twig', array(
                    'refOrganismeFormation' => $refOrganismeFormation,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refOrganismeFormation entity.
     *
     */
    public function deleteAction(Request $request, RefOrganismeFormation $refOrganismeFormation) {
        $form = $this->createDeleteForm($refOrganismeFormation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refOrganismeFormation->setBlVali(1);
            $em->flush($refOrganismeFormation);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('reforganismeformation_index');
    }

    /**
     * Creates a form to delete a refOrganismeFormation entity.
     *
     * @param RefOrganismeFormation $refOrganismeFormation The refOrganismeFormation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefOrganismeFormation $refOrganismeFormation) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reforganismeformation_delete', array('idOrgaform' => $refOrganismeFormation->getIdorgaform())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refOrganismeFormation",
            'requete_sql' => "SELECT `CD_ORGAFORM` as 'Code' ,`LB_ORGAFORM` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_organisme_formation`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
