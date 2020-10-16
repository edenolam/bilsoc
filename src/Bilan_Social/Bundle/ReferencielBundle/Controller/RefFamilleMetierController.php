<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reffamillemetier controller.
 *
 */
class RefFamilleMetierController extends Controller
{
    /**
     * Lists all refFamilleMetier entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refFamilleMetiers = $em->getRepository('ReferencielBundle:RefFamilleMetier')->findAll();

        return $this->render('@Referenciel/reffamillemetier/index.html.twig', array(
            'refFamilleMetiers' => $refFamilleMetiers,
        ));
    }

    /**
     * Creates a new refFamilleMetier entity.
     *
     */
    public function newAction(Request $request)
    {
        $refFamilleMetier = new Reffamillemetier();
        $form = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefFamilleMetierType', $refFamilleMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refFamilleMetier);
            $em->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('reffamillemetier_show', array('idFamilleMetier' => $refFamilleMetier->getIdfamillemetier()));
        }

        return $this->render('@Referenciel/reffamillemetier/new.html.twig', array(
            'refFamilleMetier' => $refFamilleMetier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refFamilleMetier entity.
     *
     */
    public function showAction(RefFamilleMetier $refFamilleMetier)
    {
        $deleteForm = $this->createDeleteForm($refFamilleMetier);

        return $this->render('@Referenciel/reffamillemetier/show.html.twig', array(
            'refFamilleMetier' => $refFamilleMetier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refFamilleMetier entity.
     *
     */
    public function editAction(Request $request, RefFamilleMetier $refFamilleMetier)
    {
        $deleteForm = $this->createDeleteForm($refFamilleMetier);
        $editForm = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefFamilleMetierType', $refFamilleMetier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('reffamillemetier_edit', array('idFamilleMetier' => $refFamilleMetier->getIdfamillemetier()));
        }

        return $this->render('@Referenciel/reffamillemetier/edit.html.twig', array(
            'refFamilleMetier' => $refFamilleMetier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refFamilleMetier entity.
     *
     */
    public function deleteAction(Request $request, RefFamilleMetier $refFamilleMetier)
    {
        $form = $this->createDeleteForm($refFamilleMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refFamilleMetier);
            $em->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
        }

        return $this->redirectToRoute('reffamillemetier_index');
    }

    /**
     * Creates a form to delete a refFamilleMetier entity.
     *
     * @param RefFamilleMetier $refFamilleMetier The refFamilleMetier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefFamilleMetier $refFamilleMetier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reffamillemetier_delete', array('idFamilleMetier' => $refFamilleMetier->getIdfamillemetier())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function generateCsvAction()
    {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refFamilleMetier",
            'requete_sql' => "SELECT refFamilleMetier.CD_FAMILLE_METIER as 'Code',
             refFamilleMetier.LB_FAMILLE_METIER as 'Libellé',
             (CASE WHEN refFamilleMetier.BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé',
             domaine_profesionnel.LB_DOMAINE_PROFESSIONNEL as 'Domaine professionnel' 
             FROM `ref_famille_metier` refFamilleMetier JOIN ref_domaine_professionnel domaine_profesionnel 
             ON refFamilleMetier.ID_DOMAINE_PROFESSIONNEL = domaine_profesionnel.ID_DOMAINE_PROFESSIONNEL ",
                        'champ' => array('Code', 'Libellé', 'Archivé', 'Domaine professionnel'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }
}
