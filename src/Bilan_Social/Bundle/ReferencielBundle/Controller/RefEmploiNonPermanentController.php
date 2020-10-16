<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefEmploiNonPermanentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refemploinonpermanent controller.
 *
 */
class RefEmploiNonPermanentController extends Controller {

    /**
     * Lists all refEmploiNonPermanent entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refEmploiNonPermanents = $em->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findAll();

        return $this->render('@Referenciel/refemploinonpermanent/index.html.twig', array(
                    'refEmploiNonPermanents' => $refEmploiNonPermanents,
        ));
    }

    /**
     * Creates a new refEmploiNonPermanent entity.
     *
     */
    public function newAction(Request $request) {
        $refEmploiNonPermanent = new Refemploinonpermanent();
        $form = $this->createForm(RefEmploiNonPermanentType::class, $refEmploiNonPermanent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refEmploiNonPermanent->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refEmploiNonPermanent);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refemploinonpermanent_show', array('idEmplnonperm' => $refEmploiNonPermanent->getIdemplnonperm()));
        }

        return $this->render('@Referenciel/refemploinonpermanent/new.html.twig', array(
                    'refEmploiNonPermanent' => $refEmploiNonPermanent,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refEmploiNonPermanent entity.
     *
     */
    public function showAction(RefEmploiNonPermanent $refEmploiNonPermanent) {
        $deleteForm = $this->createDeleteForm($refEmploiNonPermanent);

        return $this->render('@Referenciel/refemploinonpermanent/show.html.twig', array(
                    'refEmploiNonPermanent' => $refEmploiNonPermanent,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refEmploiNonPermanent entity.
     *
     */
    public function editAction(Request $request, RefEmploiNonPermanent $refEmploiNonPermanent) {
        $deleteForm = $this->createDeleteForm($refEmploiNonPermanent);
        $editForm = $this->createForm(RefEmploiNonPermanentType::class, $refEmploiNonPermanent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refEmploiNonPermanent->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refemploinonpermanent_edit', array('idEmplnonperm' => $refEmploiNonPermanent->getIdemplnonperm()));
        }

        return $this->render('@Referenciel/refemploinonpermanent/edit.html.twig', array(
                    'refEmploiNonPermanent' => $refEmploiNonPermanent,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refEmploiNonPermanent entity.
     *
     */
    public function deleteAction(Request $request, RefEmploiNonPermanent $refEmploiNonPermanent) {
        $form = $this->createDeleteForm($refEmploiNonPermanent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refEmploiNonPermanent->setBlVali(1);
            $em->flush($refEmploiNonPermanent);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refemploinonpermanent_index');
    }

    /**
     * Creates a form to delete a refEmploiNonPermanent entity.
     *
     * @param RefEmploiNonPermanent $refEmploiNonPermanent The refEmploiNonPermanent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefEmploiNonPermanent $refEmploiNonPermanent) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refemploinonpermanent_delete', array('idEmplnonperm' => $refEmploiNonPermanent->getIdemplnonperm())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refEmploiNonPermanent",
            'requete_sql' => "SELECT `CD_EMPLNONPERM` as 'Code' ,`LB_EMPLNONPERM` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_emploi_non_permanent`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
