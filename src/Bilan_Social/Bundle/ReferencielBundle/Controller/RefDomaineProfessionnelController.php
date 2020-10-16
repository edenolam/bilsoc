<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineProfessionnel;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefDomaineProfessionnelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refdomaineprofessionnel controller.
 *
 */
class RefDomaineProfessionnelController extends Controller
{
    /**
     * Lists all refDomaineProfessionnel entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refDomaineProfessionnels = $em->getRepository('ReferencielBundle:RefDomaineProfessionnel')->findAll();

        return $this->render('@Referenciel/refdomaineprofessionnel/index.html.twig', array(
            'refDomaineProfessionnels' => $refDomaineProfessionnels,
        ));
    }

    /**
     * Creates a new refDomaineProfessionnel entity.
     *
     */
    public function newAction(Request $request)
    {
        $refDomaineProfessionnel = new Refdomaineprofessionnel();
        $form = $this->createForm(RefDomaineProfessionnelType::class, $refDomaineProfessionnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refDomaineProfessionnel);
            $em->flush();

            return $this->redirectToRoute('refdomaineprofessionnel_show', array('idDomaineProfessionnel' => $refDomaineProfessionnel->getIddomaineprofessionnel()));
        }

        return $this->render('@Referenciel/refdomaineprofessionnel/new.html.twig', array(
            'refDomaineProfessionnel' => $refDomaineProfessionnel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refDomaineProfessionnel entity.
     *
     */
    public function showAction(RefDomaineProfessionnel $refDomaineProfessionnel)
    {
        $deleteForm = $this->createDeleteForm($refDomaineProfessionnel);

        return $this->render('@Referenciel/refdomaineprofessionnel/show.html.twig', array(
            'refDomaineProfessionnel' => $refDomaineProfessionnel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refDomaineProfessionnel entity.
     *
     */
    public function editAction(Request $request, RefDomaineProfessionnel $refDomaineProfessionnel)
    {
        $deleteForm = $this->createDeleteForm($refDomaineProfessionnel);
        $editForm = $this->createForm(RefDomaineProfessionnelType::class, $refDomaineProfessionnel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('refdomaineprofessionnel_edit', array('idDomaineProfessionnel' => $refDomaineProfessionnel->getIddomaineprofessionnel()));
        }

        return $this->render('@Referenciel/refdomaineprofessionnel/edit.html.twig', array(
            'refDomaineProfessionnel' => $refDomaineProfessionnel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refDomaineProfessionnel entity.
     *
     */
    public function deleteAction(Request $request, RefDomaineProfessionnel $refDomaineProfessionnel)
    {
        $form = $this->createDeleteForm($refDomaineProfessionnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refDomaineProfessionnel);
            $em->flush();
        }

        return $this->redirectToRoute('refdomaineprofessionnel_index');
    }

    /**
     * Creates a form to delete a refDomaineProfessionnel entity.
     *
     * @param RefDomaineProfessionnel $refDomaineProfessionnel The refDomaineProfessionnel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefDomaineProfessionnel $refDomaineProfessionnel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refdomaineprofessionnel_delete', array('idDomaineProfessionnel' => $refDomaineProfessionnel->getIddomaineprofessionnel())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename'    => "refDomaineProfessionnel",
            'requete_sql' => "SELECT `CD_DOMAINE_PROFESSIONNEL` as 'Code' ,`LB_DOMAINE_PROFESSIONNEL` as 'Libellé', (CASE WHEN BL_VALIDE <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_domaine_professionnel`",
            'champ'       => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }
}
