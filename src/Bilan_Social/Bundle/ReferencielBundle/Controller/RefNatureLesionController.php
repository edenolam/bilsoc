<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureLesion;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefNatureLesionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refacteviolencephysique controller.
 *
 */
class RefNatureLesionController extends Controller {

    /**
     * Lists all refNatureLesion entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refNatureLesions = $em->getRepository('ReferencielBundle:RefNatureLesion')->findAll();

        return $this->render('@Referenciel/refnaturelesion/index.html.twig', array(
                    'refNatureLesions' => $refNatureLesions,
        ));
    }

    /**
     * Creates a new refNatureLesion entity.
     *
     */
    public function newAction(Request $request) {
        $refNatureLesion = new RefNatureLesion();
        $form = $this->createForm(RefNatureLesionType::class, $refNatureLesion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refNatureLesion->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refNatureLesion);
            $em->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refnaturelesion_show', array('idNaturelesi' => $refNatureLesion->getIdNaturelesi()));
        }

        return $this->render('@Referenciel/refnaturelesion/new.html.twig', array(
                    'refNatureLesion' => $refNatureLesion,
                    'form'            => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refNatureLesion entity.
     *
     */
    public function showAction(RefNatureLesion $refNatureLesion) {
        $deleteForm = $this->createDeleteForm($refNatureLesion);

        return $this->render('@Referenciel/refnaturelesion/show.html.twig', array(
                    'refNatureLesion' => $refNatureLesion,
                    'delete_form'     => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refNatureLesion entity.
     *
     */
    public function editAction(Request $request, RefNatureLesion $refNatureLesion) {
        $deleteForm = $this->createDeleteForm($refNatureLesion);
        $editForm = $this->createForm(RefNatureLesionType::class, $refNatureLesion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refNatureLesion->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refnaturelesion_edit', array('idNaturelesi' => $refNatureLesion->getIdNaturelesi()));
        }

        return $this->render('@Referenciel/refnaturelesion/edit.html.twig', array(
                    'refNatureLesion' => $refNatureLesion,
                    'edit_form'       => $editForm->createView(),
                    'delete_form'     => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refNatureLesion entity.
     *
     */
    public function deleteAction(Request $request, RefNatureLesion $refNatureLesion) {


        $form = $this->createDeleteForm($refNatureLesion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refNatureLesion->setBlVali(1);
            $em->flush($refNatureLesion);

            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refnaturelesion_index');
    }

    /**
     * Creates a form to delete a refNatureLesion entity.
     *
     * @param RefNatureLesion $refNatureLesion The refNatureLesion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefNatureLesion $refNatureLesion) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refnaturelesion_delete', array('idNaturelesi' => $refNatureLesion->getIdNaturelesi())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename'    => "refNatureLesion",
            'requete_sql' => "SELECT `CD_NATURE_LESION` as 'Code' ,`LB_NATURE_LESION` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_nature_lesion`",
            'champ'       => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
