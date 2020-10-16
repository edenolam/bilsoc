<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refspecialite controller.
 *
 */
class RefSpecialiteController extends Controller
{
    /**
     * Lists all refSpecialite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refSpecialites = $em->getRepository('ReferencielBundle:RefSpecialite')->findAll();

        return $this->render('@Referenciel/refspecialite/index.html.twig', array(
            'refSpecialites' => $refSpecialites,
        ));
    }

    /**
     * Creates a new refSpecialite entity.
     *
     */
    public function newAction(Request $request)
    {
        $refSpecialite = new Refspecialite();
        $form = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefSpecialiteType', $refSpecialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refSpecialite);
            $em->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );
            return $this->redirectToRoute('refspecialite_show', array('idSpecialite' => $refSpecialite->getIdspecialite()));
        }

        return $this->render('@Referenciel/refspecialite/new.html.twig', array(
            'refSpecialite' => $refSpecialite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refSpecialite entity.
     *
     */
    public function showAction(RefSpecialite $refSpecialite)
    {
        $deleteForm = $this->createDeleteForm($refSpecialite);

        return $this->render('@Referenciel/refspecialite/show.html.twig', array(
            'refSpecialite' => $refSpecialite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refSpecialite entity.
     *
     */
    public function editAction(Request $request, RefSpecialite $refSpecialite)
    {
        $deleteForm = $this->createDeleteForm($refSpecialite);
        $editForm = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefSpecialiteType', $refSpecialite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
            return $this->redirectToRoute('refspecialite_edit', array('idSpecialite' => $refSpecialite->getIdspecialite()));
        }

        return $this->render('@Referenciel/refspecialite/edit.html.twig', array(
            'refSpecialite' => $refSpecialite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refSpecialite entity.
     *
     */
    public function deleteAction(Request $request, RefSpecialite $refSpecialite)
    {
        $form = $this->createDeleteForm($refSpecialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refSpecialite);
            $em->flush();
        }

        return $this->redirectToRoute('refspecialite_index');
    }

    /**
     * Creates a form to delete a refSpecialite entity.
     *
     * @param RefSpecialite $refSpecialite The refSpecialite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefSpecialite $refSpecialite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refspecialite_delete', array('idSpecialite' => $refSpecialite->getIdspecialite())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function generateCsvAction() {

        $service = $this->container->get('referenciel.ReferencielExporter');
        $information = array(
            'filename' => "refspecialite",
            'requete_sql' => "SELECT specialite.CD_SPECIALITE as 'Code' ,
            specialite.LB_SPECIALITE as 'Libellé',
            (CASE WHEN  specialite.BL_VALI  <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé',
            domaine.LB_DOMAINE_SPECIALITE  as 'Domaine spécialité'
            FROM ref_specialite specialite
            
            JOIN ref_domaine_specialite domaine 
            ON specialite.ID_DOMAINE_SPECIALITE = domaine.ID_DOMAINE_SPECIALITE",

            'champ' => array('Code', 'Libellé', 'Archivé','Domaine spécialité'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }
}
