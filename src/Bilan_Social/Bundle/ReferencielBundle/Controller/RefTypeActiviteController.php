<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeActivite;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefTypeActiviteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reftypeactivite controller.
 *
 */
class RefTypeActiviteController extends Controller {

    /**
     * Lists all refTypeActivite entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refTypeActivites = $em->getRepository('ReferencielBundle:RefTypeActivite')->findAll();

        return $this->render('@Referenciel/reftypeactivite/index.html.twig', array(
                    'refTypeActivites' => $refTypeActivites,
        ));
    }

    /**
     * Creates a new refTypeActivite entity.
     *
     */
    public function newAction(Request $request) {
        $refTypeActivite = new Reftypeactivite();
        $form = $this->createForm(RefTypeActiviteType::class, $refTypeActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refTypeActivite);
            $em->flush();

            return $this->redirectToRoute('reftypeactivite_show', array('idTypeActi' => $refTypeActivite->getIdTypeActi()));
        }

        return $this->render('@Referenciel/reftypeactivite/new.html.twig', array(
                    'refTypeActivite' => $refTypeActivite,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refTypeActivite entity.
     *
     */
    public function showAction(RefTypeActivite $refTypeActivite) {
        $deleteForm = $this->createDeleteForm($refTypeActivite);

        return $this->render('@Referenciel/reftypeactivite/show.html.twig', array(
                    'refTypeActivite' => $refTypeActivite,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refTypeActivite entity.
     *
     */
    public function editAction(Request $request, RefTypeActivite $refTypeActivite) {
        $deleteForm = $this->createDeleteForm($refTypeActivite);
        $editForm = $this->createForm(RefTypeActiviteType::class, $refTypeActivite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reftypeactivite_edit', array('idTypeActi' => $refTypeActivite->getIdTypeActi()));
        }

        return $this->render('@Referenciel/reftypeactivite/edit.html.twig', array(
                    'refTypeActivite' => $refTypeActivite,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refTypeActivite entity.
     *
     */
    public function deleteAction(Request $request, RefTypeActivite $refTypeActivite) {
        $form = $this->createDeleteForm($refTypeActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refTypeActivite->setBlVali(1);
            $em->flush($refTypeActivite);
            $em->flush();
        }

        return $this->redirectToRoute('reftypeactivite_index');
    }

    /**
     * Creates a form to delete a refTypeActivite entity.
     *
     * @param RefTypeActivite $refTypeActivite The refTypeActivite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefTypeActivite $refTypeActivite) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reftypeactivite_delete', array('idTypeActi' => $refTypeActivite->getIdTypeActi())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refTypeActivite",
            'requete_sql' => "SELECT `CD_TYPEACTI` as 'Code' ,`LB_TYPEACTI` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_type_activite`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
