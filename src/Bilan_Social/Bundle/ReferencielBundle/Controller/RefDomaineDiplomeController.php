<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineDiplome;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefDomaineDiplomeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refdomainediplome controller.
 *
 */
class RefDomaineDiplomeController extends Controller
{
    /**
     * Lists all refDomaineDiplome entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refDomaineDiplomes = $em->getRepository('ReferencielBundle:RefDomaineDiplome')->findAll();

        return $this->render('@Referenciel/refdomainediplome/index.html.twig', array(
            'refDomaineDiplomes' => $refDomaineDiplomes,
        ));
    }

    /**
     * Creates a new refDomaineDiplome entity.
     *
     */
    public function newAction(Request $request)
    {
        $refDomaineDiplome = new Refdomainediplome();
        $form = $this->createForm(RefDomaineDiplomeType::class, $refDomaineDiplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refDomaineDiplome);
            $em->flush();

            return $this->redirectToRoute('refdomainediplome_show', array('idDomaineDiplome' => $refDomaineDiplome->getIddomainediplome()));
        }

        return $this->render('@Referenciel/refdomainediplome/new.html.twig', array(
            'refDomaineDiplome' => $refDomaineDiplome,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refDomaineDiplome entity.
     *
     */
    public function showAction(RefDomaineDiplome $refDomaineDiplome)
    {
        $deleteForm = $this->createDeleteForm($refDomaineDiplome);

        return $this->render('@Referenciel/refdomainediplome/show.html.twig', array(
            'refDomaineDiplome' => $refDomaineDiplome,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refDomaineDiplome entity.
     *
     */
    public function editAction(Request $request, RefDomaineDiplome $refDomaineDiplome)
    {
        $deleteForm = $this->createDeleteForm($refDomaineDiplome);
        $editForm = $this->createForm(RefDomaineDiplomeType::class, $refDomaineDiplome);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('refdomainediplome_edit', array('idDomaineDiplome' => $refDomaineDiplome->getIddomainediplome()));
        }

        return $this->render('@Referenciel/refdomainediplome/edit.html.twig', array(
            'refDomaineDiplome' => $refDomaineDiplome,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refDomaineDiplome entity.
     *
     */
    public function deleteAction(Request $request, RefDomaineDiplome $refDomaineDiplome)
    {
        $form = $this->createDeleteForm($refDomaineDiplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refDomaineDiplome);
            $em->flush();
        }

        return $this->redirectToRoute('refdomainediplome_index');
    }

    /**
     * Creates a form to delete a refDomaineDiplome entity.
     *
     * @param RefDomaineDiplome $refDomaineDiplome The refDomaineDiplome entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefDomaineDiplome $refDomaineDiplome)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refdomainediplome_delete', array('idDomaineDiplome' => $refDomaineDiplome->getIddomainediplome())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename'    => "refActionPrevention",
            'requete_sql' => "SELECT `CD_DOMAINE_DIPLOME` as 'Code' ,`LB_DOMAINE_DIPLOME` as 'Libellé', (CASE WHEN BL_VALIDE <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_action_prevention`",
            'champ'       => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }
}
