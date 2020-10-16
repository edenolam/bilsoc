<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeCollectivite;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefTypeCollectiviteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reftypecollectivite controller.
 *
 */
class RefTypeCollectiviteController extends Controller {

    /**
     * Lists all refTypeCollectivite entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refTypeCollectivites = $em->getRepository('ReferencielBundle:RefTypeCollectivite')->findAll();

        return $this->render('@Referenciel/reftypecollectivite/index.html.twig', array(
                    'refTypeCollectivites' => $refTypeCollectivites,
        ));
    }

    /**
     * Creates a new refTypeCollectivite entity.
     *
     */
    public function newAction(Request $request) {
        $refTypeCollectivite = new Reftypecollectivite();
        $form = $this->createForm(RefTypeCollectiviteType::class, $refTypeCollectivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refTypeCollectivite->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refTypeCollectivite);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('reftypecollectivite_show', array('idTypeColl' => $refTypeCollectivite->getIdtypecoll()));
        }

        return $this->render('@Referenciel/reftypecollectivite/new.html.twig', array(
                    'refTypeCollectivite' => $refTypeCollectivite,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refTypeCollectivite entity.
     *
     */
    public function showAction(RefTypeCollectivite $refTypeCollectivite) {
        $deleteForm = $this->createDeleteForm($refTypeCollectivite);

        return $this->render('@Referenciel/reftypecollectivite/show.html.twig', array(
                    'refTypeCollectivite' => $refTypeCollectivite,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refTypeCollectivite entity.
     *
     */
    public function editAction(Request $request, RefTypeCollectivite $refTypeCollectivite) {
        $deleteForm = $this->createDeleteForm($refTypeCollectivite);
        $editForm = $this->createForm(RefTypeCollectiviteType::class, $refTypeCollectivite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refTypeCollectivite->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('reftypecollectivite_edit', array('idTypeColl' => $refTypeCollectivite->getIdtypecoll()));
        }

        return $this->render('@Referenciel/reftypecollectivite/edit.html.twig', array(
                    'refTypeCollectivite' => $refTypeCollectivite,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refTypeCollectivite entity.
     *
     */
    public function deleteAction(Request $request, RefTypeCollectivite $refTypeCollectivite) {
        $form = $this->createDeleteForm($refTypeCollectivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refTypeCollectivite->setBlVali(1);
            $em->flush($refTypeCollectivite);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('reftypecollectivite_index');
    }

    /**
     * Creates a form to delete a refTypeCollectivite entity.
     *
     * @param RefTypeCollectivite $refTypeCollectivite The refTypeCollectivite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefTypeCollectivite $refTypeCollectivite) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reftypecollectivite_delete', array('idTypeColl' => $refTypeCollectivite->getIdtypecoll())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refTypeCollectivite",
            'requete_sql' => "SELECT `CD_TYPECOLL` as 'Code' ,`LB_TYPE_COLL` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_type_collectivite`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
