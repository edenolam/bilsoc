<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefContrainteTravail;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefContrainteTravailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refcontraintetravail controller.
 *
 */
class RefContrainteTravailController extends Controller {

    /**
     * Lists all refContrainteTravail entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refContrainteTravails = $em->getRepository('ReferencielBundle:RefContrainteTravail')->findAll();

        return $this->render('@Referenciel/refcontraintetravail/index.html.twig', array(
                    'refContrainteTravails' => $refContrainteTravails,
        ));
    }

    /**
     * Creates a new refContrainteTravail entity.
     *
     */
    public function newAction(Request $request) {
        $refContrainteTravail = new Refcontraintetravail();
        $form = $this->createForm(RefContrainteTravailType::class, $refContrainteTravail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refContrainteTravail->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refContrainteTravail);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refcontraintetravail_show', array('idConttrav' => $refContrainteTravail->getIdconttrav()));
        }

        return $this->render('@Referenciel/refcontraintetravail/new.html.twig', array(
                    'refContrainteTravail' => $refContrainteTravail,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refContrainteTravail entity.
     *
     */
    public function showAction(RefContrainteTravail $refContrainteTravail) {
        $deleteForm = $this->createDeleteForm($refContrainteTravail);

        return $this->render('@Referenciel/refcontraintetravail/show.html.twig', array(
                    'refContrainteTravail' => $refContrainteTravail,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refContrainteTravail entity.
     *
     */
    public function editAction(Request $request, RefContrainteTravail $refContrainteTravail) {
        $deleteForm = $this->createDeleteForm($refContrainteTravail);
        $editForm = $this->createForm(RefContrainteTravailType::class, $refContrainteTravail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refContrainteTravail->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
            return $this->redirectToRoute('refcontraintetravail_edit', array('idConttrav' => $refContrainteTravail->getIdconttrav()));
        }

        return $this->render('@Referenciel/refcontraintetravail/edit.html.twig', array(
                    'refContrainteTravail' => $refContrainteTravail,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refContrainteTravail entity.
     *
     */
    public function deleteAction(Request $request, RefContrainteTravail $refContrainteTravail) {
        $form = $this->createDeleteForm($refContrainteTravail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refContrainteTravail->setBlVali(1);
            $em->flush($refContrainteTravail);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refcontraintetravail_index');
    }

    /**
     * Creates a form to delete a refContrainteTravail entity.
     *
     * @param RefContrainteTravail $refContrainteTravail The refContrainteTravail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefContrainteTravail $refContrainteTravail) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refcontraintetravail_delete', array('idConttrav' => $refContrainteTravail->getIdconttrav())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refContrainteTravail",
            'requete_sql' => "SELECT `CD_CONTTRAV` as 'Code' ,`LB_CONTTRAV` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_contrainte_travail`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
