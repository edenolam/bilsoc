<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMetier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refmetier controller.
 *
 */
class RefMetierController extends Controller
{
    /**
     * Lists all refMetier entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refMetiers = $em->getRepository('ReferencielBundle:RefMetier')->findAll();

        return $this->render('@Referenciel/refmetier/index.html.twig', array(
            'refMetiers' => $refMetiers,
        ));
    }

    /**
     * Creates a new refMetier entity.
     *
     */
    public function newAction(Request $request)
    {
        $refMetier = new Refmetier();
        $form = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefMetierType', $refMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refMetier);
            $em->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );
            return $this->redirectToRoute('refmetier_show', array('idMetier' => $refMetier->getIdmetier()));
        }

        return $this->render('@Referenciel/refmetier/new.html.twig', array(
            'refMetier' => $refMetier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refMetier entity.
     *
     */
    public function showAction(RefMetier $refMetier)
    {
        $deleteForm = $this->createDeleteForm($refMetier);

        return $this->render('@Referenciel/refmetier/show.html.twig', array(
            'refMetier' => $refMetier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refMetier entity.
     *
     */
    public function editAction(Request $request, RefMetier $refMetier)
    {
        $deleteForm = $this->createDeleteForm($refMetier);
        $editForm = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefMetierType', $refMetier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
            return $this->redirectToRoute('refmetier_edit', array('idMetier' => $refMetier->getIdmetier()));
        }

        return $this->render('@Referenciel/refmetier/edit.html.twig', array(
            'refMetier' => $refMetier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refMetier entity.
     *
     */
    public function deleteAction(Request $request, RefMetier $refMetier)
    {
        $form = $this->createDeleteForm($refMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refMetier);
            $em->flush();
        }

        return $this->redirectToRoute('refmetier_index');
    }

    /**
     * Creates a form to delete a refMetier entity.
     *
     * @param RefMetier $refMetier The refMetier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefMetier $refMetier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refmetier_delete', array('idMetier' => $refMetier->getIdmetier())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function generateCsvAction() {

        $service = $this->container->get('referenciel.ReferencielExporter');
        $information = array(
            'filename' => "refmetier",
            'requete_sql' => "SELECT refMetier.CD_METIER as 'Code Métier' ,
            refMetier.LB_METIER as 'Libellé',
            refMetier.LB_AUTRES_APPELLATIONS_COLLECTIVITES as 'Autre appelation collectivité',
            refMetier.CD_N4DS as 'Code N4ds', 
            (CASE WHEN  refMetier.BL_METIER_PRINCIPAL  <> 0 THEN 'Oui' ELSE 'Non' END) as 'Métier principal',  
            (CASE WHEN  refMetier.BL_CONSOLIDE  <> 0 THEN 'Oui' ELSE 'Non' END) as 'Consolidé',  
            (CASE WHEN refMetier.BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé', 
            refFamille.LB_FAMILLE_METIER  as 'Famille métier'
            FROM ref_metier refMetier
            
            JOIN ref_famille_metier refFamille 
            ON refMetier.ID_FAMILLE_METIER = refFamille.ID_FAMILLE_METIER",

            'champ' => array('Code Métier', 'Libellé', 'Autre appelation collectivité', 'Code N4ds', 'Métier principal', 'Consolidé',  'Archivé','Famille métier'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }
}
