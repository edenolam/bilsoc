<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefAvancementPromotionConcours;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefAvancementPromotionConcoursType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refavancementpromotionconcour controller.
 *
 */
class RefAvancementPromotionConcoursController extends Controller {

    /**
     * Lists all refAvancementPromotionConcour entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refAvancementPromotionConcours = $em->getRepository('ReferencielBundle:RefAvancementPromotionConcours')->findAll();

        return $this->render('@Referenciel/refavancementpromotionconcours/index.html.twig', array(
                    'refAvancementPromotionConcours' => $refAvancementPromotionConcours,
        ));
    }

    /**
     * Creates a new refAvancementPromotionConcour entity.
     *
     */
    public function newAction(Request $request) {
        $refAvancementPromotionConcours = new RefAvancementPromotionConcours();
        $form = $this->createForm(RefAvancementPromotionConcoursType::class, $refAvancementPromotionConcours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refAvancementPromotionConcours->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refAvancementPromotionConcours);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refavancementpromotionconcours_show', array('idAvanpromconc' => $refAvancementPromotionConcours->getIdavanpromconc()));
        }

        return $this->render('@Referenciel/refavancementpromotionconcours/new.html.twig', array(
                    'refAvancementPromotionConcour' => $refAvancementPromotionConcours,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refAvancementPromotionConcour entity.
     *
     */
    public function showAction(RefAvancementPromotionConcours $refAvancementPromotionConcour) {
        $deleteForm = $this->createDeleteForm($refAvancementPromotionConcour);

        return $this->render('@Referenciel/refavancementpromotionconcours/show.html.twig', array(
                    'refAvancementPromotionConcour' => $refAvancementPromotionConcour,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refAvancementPromotionConcour entity.
     *
     */
    public function editAction(Request $request, RefAvancementPromotionConcours $refAvancementPromotionConcour) {
        $deleteForm = $this->createDeleteForm($refAvancementPromotionConcour);
        $editForm = $this->createForm(RefAvancementPromotionConcoursType::class, $refAvancementPromotionConcour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refAvancementPromotionConcour->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
            return $this->redirectToRoute('refavancementpromotionconcours_edit', array('idAvanpromconc' => $refAvancementPromotionConcour->getIdavanpromconc()));
        }

        return $this->render('@Referenciel/refavancementpromotionconcours/edit.html.twig', array(
                    'refAvancementPromotionConcour' => $refAvancementPromotionConcour,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refAvancementPromotionConcour entity.
     *
     */
    public function deleteAction(Request $request, RefAvancementPromotionConcours $refAvancementPromotionConcour) {
        $form = $this->createDeleteForm($refAvancementPromotionConcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
//            $em->remove($refAvancementPromotionConcour);
            $refAvancementPromotionConcour->setBlVali(1);
            $em->flush($refAvancementPromotionConcour);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refavancementpromotionconcours_index');
    }

    /**
     * Creates a form to delete a refAvancementPromotionConcour entity.
     *
     * @param RefAvancementPromotionConcours $refAvancementPromotionConcour The refAvancementPromotionConcour entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefAvancementPromotionConcours $refAvancementPromotionConcour) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refavancementpromotionconcours_delete', array('idAvanpromconc' => $refAvancementPromotionConcour->getIdavanpromconc())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refAvancementPromotionConcour",
            'requete_sql' => "SELECT `CD_AVANPROMCONC` as 'Code' ,`LB_AVANPROMCONC` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_avancement_promotion_concours`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
