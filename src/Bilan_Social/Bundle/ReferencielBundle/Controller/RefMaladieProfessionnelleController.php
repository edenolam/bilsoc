<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMaladieProfessionnelle;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefMaladieProfessionnelleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refacteviolencephysique controller.
 *
 */
class RefMaladieProfessionnelleController extends Controller {

    /**
     * Lists all refMaladieProfessionnelle entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refMaladieProfessionnelles = $em->getRepository('ReferencielBundle:RefMaladieProfessionnelle')->findAll();

        return $this->render('@Referenciel/refmaladieprofessionnelle/index.html.twig', array(
                    'refMaladieProfessionnelles' => $refMaladieProfessionnelles,
        ));
    }

    /**
     * Creates a new refMaladieProfessionnelle entity.
     *
     */
    public function newAction(Request $request) {
        $refMaladieProfessionnelle = new RefMaladieProfessionnelle();
        $form = $this->createForm(RefMaladieProfessionnelleType::class, $refMaladieProfessionnelle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refMaladieProfessionnelle->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refMaladieProfessionnelle);
            $em->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refmaladieprofessionnelle_show', array('idMaladiepro' => $refMaladieProfessionnelle->getIdMaladiepro()));
        }

        return $this->render('@Referenciel/refmaladieprofessionnelle/new.html.twig', array(
                    'refMaladieProfessionnelle' => $refMaladieProfessionnelle,
                    'form'                      => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refMaladieProfessionnelle entity.
     *
     */
    public function showAction(RefMaladieProfessionnelle $refMaladieProfessionnelle) {
        $deleteForm = $this->createDeleteForm($refMaladieProfessionnelle);

        return $this->render('@Referenciel/refmaladieprofessionnelle/show.html.twig', array(
                    'refMaladieProfessionnelle' => $refMaladieProfessionnelle,
                    'delete_form'               => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refMaladieProfessionnelle entity.
     *
     */
    public function editAction(Request $request, RefMaladieProfessionnelle $refMaladieProfessionnelle) {
        $deleteForm = $this->createDeleteForm($refMaladieProfessionnelle);
        $editForm = $this->createForm(RefMaladieProfessionnelleType::class, $refMaladieProfessionnelle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refMaladieProfessionnelle->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refmaladieprofessionnelle_edit', array('idMaladiepro' => $refMaladieProfessionnelle->getIdMaladiepro()));
        }

        return $this->render('@Referenciel/refmaladieprofessionnelle/edit.html.twig', array(
                    'refMaladieProfessionnelle' => $refMaladieProfessionnelle,
                    'edit_form'                 => $editForm->createView(),
                    'delete_form'               => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refMaladieProfessionnelle entity.
     *
     */
    public function deleteAction(Request $request, RefMaladieProfessionnelle $refMaladieProfessionnelle) {


        $form = $this->createDeleteForm($refMaladieProfessionnelle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refMaladieProfessionnelle->setBlVali(1);
            $em->flush($refMaladieProfessionnelle);

            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refmaladieprofessionnelle_index');
    }

    /**
     * Creates a form to delete a refMaladieProfessionnelle entity.
     *
     * @param RefMaladieProfessionnelle $refMaladieProfessionnelle The refMaladieProfessionnelle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefMaladieProfessionnelle $refMaladieProfessionnelle) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refmaladieprofessionnelle_delete', array('idMaladiepro' => $refMaladieProfessionnelle->getIdMaladiepro())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename'    => "refMaladieProfessionnelle",
            'requete_sql' => "SELECT `CD_MALADIE_PROFESSIONNELLE` as 'Code' ,`LB_MALADIE_PROFESSIONNELLE` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_maladie_professionnelle`",
            'champ'       => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
