<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineSpecialite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refdomainespecialite controller.
 *
 */
class RefDomaineSpecialiteController extends Controller
{
    /**
     * Lists all refDomaineSpecialite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refDomaineSpecialites = $em->getRepository('ReferencielBundle:RefDomaineSpecialite')->findAll();

        return $this->render('@Referenciel/refdomainespecialite/index.html.twig', array(
            'refDomaineSpecialites' => $refDomaineSpecialites,
        ));
    }

    /**
     * Creates a new refDomaineSpecialite entity.
     *
     */
    public function newAction(Request $request)
    {
        $refDomaineSpecialite = new Refdomainespecialite();
        $form = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefDomaineSpecialiteType', $refDomaineSpecialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refDomaineSpecialite);
            $em->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
            return $this->redirectToRoute('refdomainespecialite_show', array('idDomaineSpecialite' => $refDomaineSpecialite->getIddomainespecialite()));
        }

        return $this->render('@Referenciel/refdomainespecialite/new.html.twig', array(
            'refDomaineSpecialite' => $refDomaineSpecialite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refDomaineSpecialite entity.
     *
     */
    public function showAction(RefDomaineSpecialite $refDomaineSpecialite)
    {
        $deleteForm = $this->createDeleteForm($refDomaineSpecialite);

        return $this->render('@Referenciel/refdomainespecialite/show.html.twig', array(
            'refDomaineSpecialite' => $refDomaineSpecialite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refDomaineSpecialite entity.
     *
     */
    public function editAction(Request $request, RefDomaineSpecialite $refDomaineSpecialite)
    {
        $deleteForm = $this->createDeleteForm($refDomaineSpecialite);
        $editForm = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefDomaineSpecialiteType', $refDomaineSpecialite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
            return $this->redirectToRoute('refdomainespecialite_edit', array('idDomaineSpecialite' => $refDomaineSpecialite->getIddomainespecialite()));
        }

        return $this->render('@Referenciel/refdomainespecialite/edit.html.twig', array(
            'refDomaineSpecialite' => $refDomaineSpecialite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refDomaineSpecialite entity.
     *
     */
    public function deleteAction(Request $request, RefDomaineSpecialite $refDomaineSpecialite)
    {
        $form = $this->createDeleteForm($refDomaineSpecialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refDomaineSpecialite);
            $em->flush();
            $this->addFlash(
                'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
        }
        return $this->redirectToRoute('refdomainespecialite_index');
    }

    /**
     * Creates a form to delete a refDomaineSpecialite entity.
     *
     * @param RefDomaineSpecialite $refDomaineSpecialite The refDomaineSpecialite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefDomaineSpecialite $refDomaineSpecialite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refdomainespecialite_delete', array('idDomaineSpecialite' => $refDomaineSpecialite->getIddomainespecialite())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function generateCsvAction() {

        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refDomaineSpecialite",
            'requete_sql' => "SELECT `CD_DOMAINE_SPECIALITE` as 'Code' ,`LB_DOMAINE_SPECIALITE` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_domaine_specialite`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }
}
