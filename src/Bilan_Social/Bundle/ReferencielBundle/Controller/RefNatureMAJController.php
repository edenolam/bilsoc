<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureMAJ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refnaturemaj controller.
 *
 */
class RefNatureMAJController extends Controller
{
    /**
     * Lists all refNatureMAJ entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refNatureMAJs = $em->getRepository('ReferencielBundle:RefNatureMAJ')->findAll();

        return $this->render('@Referenciel/refnaturemaj/index.html.twig', array(
            'refNatureMAJs' => $refNatureMAJs,
        ));
    }

    /**
     * Creates a new refNatureMAJ entity.
     *
     */
    public function newAction(Request $request)
    {
        $refNatureMAJ = new Refnaturemaj();
        $form = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefNatureMAJType', $refNatureMAJ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refNatureMAJ);
            $em->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );
            return $this->redirectToRoute('refnaturemaj_show', array('idNatureMAJ' => $refNatureMAJ->getIdnaturemaj()));
        }

        return $this->render('@Referenciel/refnaturemaj/new.html.twig', array(
            'refNatureMAJ' => $refNatureMAJ,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refNatureMAJ entity.
     *
     */
    public function showAction(RefNatureMAJ $refNatureMAJ)
    {
        $deleteForm = $this->createDeleteForm($refNatureMAJ);

        return $this->render('@Referenciel/refnaturemaj/show.html.twig', array(
            'refNatureMAJ' => $refNatureMAJ,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refNatureMAJ entity.
     *
     */
    public function editAction(Request $request, RefNatureMAJ $refNatureMAJ)
    {
        $deleteForm = $this->createDeleteForm($refNatureMAJ);
        $editForm = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefNatureMAJType', $refNatureMAJ);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
            return $this->redirectToRoute('refnaturemaj_edit', array('idNatureMAJ' => $refNatureMAJ->getIdnaturemaj()));
        }

        return $this->render('@Referenciel/refnaturemaj/edit.html.twig', array(
            'refNatureMAJ' => $refNatureMAJ,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refNatureMAJ entity.
     *
     */
    public function deleteAction(Request $request, RefNatureMAJ $refNatureMAJ)
    {
        $form = $this->createDeleteForm($refNatureMAJ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refNatureMAJ);
            $em->flush();
        }

        return $this->redirectToRoute('refnaturemaj_index');
    }

    /**
     * Creates a form to delete a refNatureMAJ entity.
     *
     * @param RefNatureMAJ $refNatureMAJ The refNatureMAJ entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefNatureMAJ $refNatureMAJ)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refnaturemaj_delete', array('idNatureMAJ' => $refNatureMAJ->getIdnaturemaj())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function generateCsvAction() {

        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refNatureMAJ",
            'requete_sql' => "SELECT CD_STAT as 'Code' ,`LB_STAT` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_nature_maj`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }
}
