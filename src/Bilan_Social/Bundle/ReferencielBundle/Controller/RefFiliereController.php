<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefFiliereType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reffiliere controller.
 *
 */
class RefFiliereController extends Controller {

    /**
     * Lists all refFiliere entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refFilieres = $em->getRepository('ReferencielBundle:RefFiliere')->findAll();

        return $this->render('@Referenciel/reffiliere/index.html.twig', array(
                    'refFilieres' => $refFilieres,
        ));
    }

    /**
     * Creates a new refFiliere entity.
     *
     */
    public function newAction(Request $request) {
        $refFiliere = new Reffiliere();
        $form = $this->createForm(RefFiliereType::class, $refFiliere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refFiliere->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refFiliere);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('reffiliere_show', array('idFili' => $refFiliere->getIdfili()));
        }

        return $this->render('@Referenciel/reffiliere/new.html.twig', array(
                    'refFiliere' => $refFiliere,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refFiliere entity.
     *
     */
    public function showAction(RefFiliere $refFiliere) {
        $deleteForm = $this->createDeleteForm($refFiliere);

        return $this->render('@Referenciel/reffiliere/show.html.twig', array(
                    'refFiliere' => $refFiliere,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refFiliere entity.
     *
     */
    public function editAction(Request $request, RefFiliere $refFiliere) {
        $deleteForm = $this->createDeleteForm($refFiliere);
        $editForm = $this->createForm(RefFiliereType::class, $refFiliere);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refFiliere->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('reffiliere_edit', array('idFili' => $refFiliere->getIdfili()));
        }

        return $this->render('@Referenciel/reffiliere/edit.html.twig', array(
                    'refFiliere' => $refFiliere,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refFiliere entity.
     *
     */
    public function deleteAction(Request $request, RefFiliere $refFiliere) {
        $form = $this->createDeleteForm($refFiliere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refFiliere->setBlVali(1);
            $em->flush($refFiliere);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('reffiliere_index');
    }

    /**
     * Creates a form to delete a refFiliere entity.
     *
     * @param RefFiliere $refFiliere The refFiliere entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefFiliere $refFiliere) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reffiliere_delete', array('idFili' => $refFiliere->getIdfili())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refFiliere",
            'requete_sql' => "SELECT `CD_FILI` as 'Code' ,`LB_FILI` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_filiere`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
