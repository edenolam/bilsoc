<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefCadreEmploiType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refcadreemploi controller.
 *
 */
class RefCadreEmploiController extends Controller {

    /**
     * Lists all refCadreEmploi entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refCadreEmplois = $em->getRepository('ReferencielBundle:RefCadreEmploi')->findAll();

        return $this->render('@Referenciel/refcadreemploi/index.html.twig', array(
                    'refCadreEmplois' => $refCadreEmplois,
        ));
    }

    /**
     * Creates a new refCadreEmploi entity.
     *
     */
    public function newAction(Request $request) {
        $refCadreEmploi = new Refcadreemploi();
        $form = $this->createForm(RefCadreEmploiType::class, $refCadreEmploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refCadreEmploi->setCdUtilcrea($this->getUser());
            $em->persist($refCadreEmploi);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refcadreemploi_show', array('idCadrempl' => $refCadreEmploi->getIdcadrempl()));
        }

        return $this->render('@Referenciel/refcadreemploi/new.html.twig', array(
                    'refCadreEmploi' => $refCadreEmploi,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refCadreEmploi entity.
     *
     */
    public function showAction(RefCadreEmploi $refCadreEmploi) {
        $deleteForm = $this->createDeleteForm($refCadreEmploi);

        return $this->render('@Referenciel/refcadreemploi/show.html.twig', array(
                    'refCadreEmploi' => $refCadreEmploi,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refCadreEmploi entity.
     *
     */
    public function editAction(Request $request, RefCadreEmploi $refCadreEmploi) {
        $deleteForm = $this->createDeleteForm($refCadreEmploi);
        $editForm = $this->createForm(RefCadreEmploiType::class, $refCadreEmploi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refCadreEmploi->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refcadreemploi_edit', array('idCadrempl' => $refCadreEmploi->getIdcadrempl()));
        }

        return $this->render('@Referenciel/refcadreemploi/edit.html.twig', array(
                    'refCadreEmploi' => $refCadreEmploi,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refCadreEmploi entity.
     *
     */
    public function deleteAction(Request $request, RefCadreEmploi $refCadreEmploi) {
        $form = $this->createDeleteForm($refCadreEmploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refCadreEmploi->setBlVali(1);
            $em->flush($refCadreEmploi);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refcadreemploi_index');
    }

    /**
     * Creates a form to delete a refCadreEmploi entity.
     *
     * @param RefCadreEmploi $refCadreEmploi The refCadreEmploi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefCadreEmploi $refCadreEmploi) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refcadreemploi_delete', array('idCadrempl' => $refCadreEmploi->getIdcadrempl())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refCadreEmploi",
            'requete_sql' => "SELECT rce.CD_CADREMPL as 'Code', rce.LB_CADREMPL as 'Libellé', (CASE WHEN rce.BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé', (CASE WHEN rce.BL_CONS <> 0 THEN 'Non' ELSE 'Oui' END) as 'Consolide', f.LB_FILI as 'Filière', c.LB_CATE as 'Catégorie' FROM `ref_cadre_emploi` rce JOIN ref_filiere f ON rce.ID_FILI = f.ID_FILI JOIN ref_categorie c ON rce.ID_CATE = c.ID_CATE WHERE 1",
            'champ' => array('Code', 'Libellé', 'Archivé', 'Consolide', 'Filière', 'Catégorie'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
