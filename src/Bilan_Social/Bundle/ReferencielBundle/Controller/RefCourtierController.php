<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCourtier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefCourtierType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refcourtier controller.
 *
 */
class RefCourtierController extends Controller
{
    /**
     * Lists all refCourtier entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refCourtiers = $em->getRepository('ReferencielBundle:RefCourtier')->findAll();

        return $this->render('@Referenciel/refcourtier/index.html.twig', array(
            'refCourtiers' => $refCourtiers,
        ));
    }

    /**
     * Creates a new refCourtier entity.
     *
     */
    public function newAction(Request $request)
    {
        $refCourtier = new RefCourtier();
        $form = $this->createForm(RefCourtierType::class, $refCourtier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refCourtier);
            $em->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refcourtier_show', array('id' => $refCourtier->getId()));
        }

        return $this->render('@Referenciel/refcourtier/new.html.twig', array(
            'refCourtier' => $refCourtier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refCourtier entity.
     *
     */
    public function showAction(RefCourtier $refCourtier)
    {
        $deleteForm = $this->createDeleteForm($refCourtier);

        return $this->render('@Referenciel/refcourtier/show.html.twig', array(
            'refCourtier' => $refCourtier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refCourtier entity.
     *
     */
    public function editAction(Request $request, RefCourtier $refCourtier)
    {
        $deleteForm = $this->createDeleteForm($refCourtier);
        $editForm = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefCourtierType', $refCourtier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
            return $this->redirectToRoute('refcourtier_edit', array('id' => $refCourtier->getId()));
        }

        return $this->render('@Referenciel/refcourtier/edit.html.twig', array(
            'refCourtier' => $refCourtier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refCourtier entity.
     *
     */
    public function deleteAction(Request $request, RefCourtier $refCourtier)
    {
        $form = $this->createDeleteForm($refCourtier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refCourtier);
            $em->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refcourtier_index');
    }

    /**
     * Creates a form to delete a refCourtier entity.
     *
     * @param RefCourtier $refCourtier The refCourtier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefCourtier $refCourtier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refcourtier_delete', array('id' => $refCourtier->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function generateCsvAction() {

        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refcourtier",
            'requete_sql' => "SELECT `code` as 'Code' ,`libelle` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_courtier`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }
}
