<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsNonComplet;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefTempsNonCompletType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reftempsnoncomplet controller.
 *
 */
class RefTempsNonCompletController extends Controller {

    /**
     * Lists all refTempsNonComplet entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refTempsNonComplets = $em->getRepository('ReferencielBundle:RefTempsNonComplet')->findAll();

        return $this->render('@Referenciel/reftempsnoncomplet/index.html.twig', array(
                    'refTempsNonComplets' => $refTempsNonComplets,
        ));
    }

    /**
     * Creates a new refTempsNonComplet entity.
     *
     */
    public function newAction(Request $request) {
        $refTempsNonComplet = new Reftempsnoncomplet();
        $form = $this->createForm(RefTempsNonCompletType::class, $refTempsNonComplet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refTempsNonComplet->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refTempsNonComplet);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('reftempsnoncomplet_show', array('idTempnoncomp' => $refTempsNonComplet->getIdtempnoncomp()));
        }

        return $this->render('@Referenciel/reftempsnoncomplet/new.html.twig', array(
                    'refTempsNonComplet' => $refTempsNonComplet,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refTempsNonComplet entity.
     *
     */
    public function showAction(RefTempsNonComplet $refTempsNonComplet) {
        $deleteForm = $this->createDeleteForm($refTempsNonComplet);

        return $this->render('@Referenciel/reftempsnoncomplet/show.html.twig', array(
                    'refTempsNonComplet' => $refTempsNonComplet,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refTempsNonComplet entity.
     *
     */
    public function editAction(Request $request, RefTempsNonComplet $refTempsNonComplet) {
        $deleteForm = $this->createDeleteForm($refTempsNonComplet);
        $editForm = $this->createForm(RefTempsNonCompletType::class, $refTempsNonComplet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refTempsNonComplet->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('reftempsnoncomplet_edit', array('idTempnoncomp' => $refTempsNonComplet->getIdtempnoncomp()));
        }

        return $this->render('@Referenciel/reftempsnoncomplet/edit.html.twig', array(
                    'refTempsNonComplet' => $refTempsNonComplet,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refTempsNonComplet entity.
     *
     */
    public function deleteAction(Request $request, RefTempsNonComplet $refTempsNonComplet) {
        $form = $this->createDeleteForm($refTempsNonComplet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refTempsNonComplet->setBlVali(1);
            $em->flush($refTempsNonComplet);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('reftempsnoncomplet_index');
    }

    /**
     * Creates a form to delete a refTempsNonComplet entity.
     *
     * @param RefTempsNonComplet $refTempsNonComplet The refTempsNonComplet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefTempsNonComplet $refTempsNonComplet) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reftempsnoncomplet_delete', array('idTempnoncomp' => $refTempsNonComplet->getIdtempnoncomp())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refTempsNonComplet",
            'requete_sql' => "SELECT `CD_TEMPNONCOMP` as 'Code' ,`LB_TEMPNONCOMP` as 'Libellé', `NB_MIN_BORNMIN` as 'Borne Min', `NB_MIN_BORNMAX` as 'Borne Max', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_temps_non_complet`",
            'champ' => array('Code', 'Libellé', 'Borne Min', 'Borne Max', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
