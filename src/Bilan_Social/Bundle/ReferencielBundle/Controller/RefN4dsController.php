<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefN4ds;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefN4dsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refacteviolencephysique controller.
 *
 */
class RefN4dsController extends Controller {

    /**
     * Lists all refN4ds entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refN4dss = $em->getRepository('ReferencielBundle:RefN4ds')->findAll();

        return $this->render('ReferencielBundle:refn4ds:index.html.twig', array(
                    'refN4dss' => $refN4dss,
        ));
    }

    /**
     * Creates a new refN4ds entity.
     *
     */
    public function newAction(Request $request) {
        $refN4ds = new RefN4ds();
        $form = $this->createForm(RefN4dsType::class, $refN4ds);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refN4ds->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refN4ds);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('refn4ds_show', array('idN4ds' => $refN4ds->getIdN4ds()));
        }

        return $this->render('ReferencielBundle:refn4ds:new.html.twig', array(
                    'refN4ds' => $refN4ds,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refN4ds entity.
     *
     */
    public function showAction(RefN4ds $refN4ds) {
        $deleteForm = $this->createDeleteForm($refN4ds);

        return $this->render('ReferencielBundle:refn4ds:show.html.twig', array(
                    'refN4ds' => $refN4ds,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refN4ds entity.
     *
     */
    public function editAction(Request $request, RefN4ds $refN4ds) {
        $deleteForm = $this->createDeleteForm($refN4ds);
        $editForm = $this->createForm(RefN4dsType::class, $refN4ds);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refN4ds->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('refn4ds_edit', array('idN4ds' => $refN4ds->getIdN4ds()));
        }

        return $this->render('ReferencielBundle:refn4ds:edit.html.twig', array(
                    'refN4ds' => $refN4ds,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refN4ds entity.
     *
     */
    public function deleteAction(Request $request, RefN4ds $refN4ds) {
        $form = $this->createDeleteForm($refN4ds);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refN4ds->setBlVali(1);
            $em->flush($refN4ds);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refn4ds_index');
    }

    /**
     * Creates a form to delete a refN4ds entity.
     *
     * @param RefN4ds $refN4ds The refN4ds entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefN4ds $refN4ds) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refn4ds_delete', array('idN4ds' => $refN4ds->getIdN4ds())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refN4ds",
            'requete_sql' => "SELECT `CD_VALEUR` as 'Code' ,`CD_N4DS` as 'Libellé', (CASE WHEN BL_OBLI <> 0 THEN 'Non' ELSE 'Oui' END) as 'obligatoire', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_n4ds`",
            'champ' => array('Code', 'Libellé', 'obligatoire', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
