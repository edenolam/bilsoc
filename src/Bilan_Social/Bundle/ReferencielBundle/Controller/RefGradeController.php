<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefGradeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refgrade controller.
 *
 */
class RefGradeController extends Controller {

    /**
     * Lists all refGrade entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refGrades = $em->getRepository('ReferencielBundle:RefGrade')->findAll();

        return $this->render('@Referenciel/refgrade/index.html.twig', array(
                    'refGrades' => $refGrades,
        ));
    }

    /**
     * Creates a new refGrade entity.
     *
     */
    public function newAction(Request $request) {
        $refGrade = new Refgrade();
        $form = $this->createForm(RefGradeType::class, $refGrade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refGrade->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refGrade);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );


            return $this->redirectToRoute('refgrade_show', array('idGrad' => $refGrade->getIdgrad()));
        }

        return $this->render('@Referenciel/refgrade/new.html.twig', array(
                    'refGrade' => $refGrade,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refGrade entity.
     *
     */
    public function showAction(RefGrade $refGrade) {
        $deleteForm = $this->createDeleteForm($refGrade);

        return $this->render('@Referenciel/refgrade/show.html.twig', array(
                    'refGrade' => $refGrade,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refGrade entity.
     *
     */
    public function editAction(Request $request, RefGrade $refGrade) {
        $deleteForm = $this->createDeleteForm($refGrade);
        $editForm = $this->createForm(RefGradeType::class, $refGrade);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refGrade->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
            return $this->redirectToRoute('refgrade_edit', array('idGrad' => $refGrade->getIdgrad()));
        }

        return $this->render('@Referenciel/refgrade/edit.html.twig', array(
                    'refGrade' => $refGrade,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refGrade entity.
     *
     */
    public function deleteAction(Request $request, RefGrade $refGrade) {
        $form = $this->createDeleteForm($refGrade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refGrade->setBlVali(1);
            $em->flush($refGrade);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refgrade_index');
    }

    /**
     * Creates a form to delete a refGrade entity.
     *
     * @param RefGrade $refGrade The refGrade entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefGrade $refGrade) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refgrade_delete', array('idGrad' => $refGrade->getIdgrad())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refGrade",
            'requete_sql' => "SELECT g.CD_GRAD as 'Code' ,g.LB_GRAD as 'Libellé',  (CASE WHEN g.BL_DETA <> 0 THEN 'Non' ELSE 'Oui' END)as 'Détachement', rce.LB_CADREMPL as 'Cadre Emploi', f.LB_FILI as 'Filière', rca.LB_CATE as 'Catégorie' ,(CASE WHEN g.BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé'  FROM `ref_grade` g JOIN ref_cadre_emploi rce ON rce.ID_CADREMPL = g.ID_CADREMPL JOIN ref_filiere f ON f.ID_FILI = rce.ID_FILI JOIN ref_categorie rca ON rca.ID_CATE = rce.ID_CATE WHERE 1",
            'champ' => array('Code', 'Libellé', 'Détachement', 'Cadre Emploi', 'Filière', 'Catégorie', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
