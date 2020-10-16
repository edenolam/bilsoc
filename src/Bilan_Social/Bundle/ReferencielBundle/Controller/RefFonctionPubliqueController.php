<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFonctionPublique;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefFonctionPubliqueType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reffonctionpublique controller.
 *
 */
class RefFonctionPubliqueController extends Controller {

    /**
     * Lists all refFonctionPublique entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refFonctionPubliques = $em->getRepository('ReferencielBundle:RefFonctionPublique')->findAll();

        return $this->render('@Referenciel/reffonctionpublique/index.html.twig', array(
                    'refFonctionPubliques' => $refFonctionPubliques,
        ));
    }

    /**
     * Creates a new refFonctionPublique entity.
     *
     */
    public function newAction(Request $request) {
        $refFonctionPublique = new Reffonctionpublique();
        $form = $this->createForm(RefFonctionPubliqueType::class, $refFonctionPublique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refFonctionPublique->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refFonctionPublique);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('reffonctionpublique_show', array('idFoncpubl' => $refFonctionPublique->getIdfoncpubl()));
        }

        return $this->render('@Referenciel/reffonctionpublique/new.html.twig', array(
                    'refFonctionPublique' => $refFonctionPublique,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refFonctionPublique entity.
     *
     */
    public function showAction(RefFonctionPublique $refFonctionPublique) {
        $deleteForm = $this->createDeleteForm($refFonctionPublique);

        return $this->render('@Referenciel/reffonctionpublique/show.html.twig', array(
                    'refFonctionPublique' => $refFonctionPublique,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refFonctionPublique entity.
     *
     */
    public function editAction(Request $request, RefFonctionPublique $refFonctionPublique) {
        $deleteForm = $this->createDeleteForm($refFonctionPublique);
        $editForm = $this->createForm(RefFonctionPubliqueType::class, $refFonctionPublique);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refFonctionPublique->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );
            return $this->redirectToRoute('reffonctionpublique_edit', array('idFoncpubl' => $refFonctionPublique->getIdfoncpubl()));
        }

        return $this->render('@Referenciel/reffonctionpublique/edit.html.twig', array(
                    'refFonctionPublique' => $refFonctionPublique,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refFonctionPublique entity.
     *
     */
    public function deleteAction(Request $request, RefFonctionPublique $refFonctionPublique) {
        $form = $this->createDeleteForm($refFonctionPublique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refFonctionPublique->setBlVali(1);
            $em->flush($refFonctionPublique);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }
        return $this->redirectToRoute('reffonctionpublique_index');
    }

    /**
     * Creates a form to delete a refFonctionPublique entity.
     *
     * @param RefFonctionPublique $refFonctionPublique The refFonctionPublique entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefFonctionPublique $refFonctionPublique) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reffonctionpublique_delete', array('idFoncpubl' => $refFonctionPublique->getIdfoncpubl())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refFonctionPublique",
            'requete_sql' => "SELECT `CD_FONCPUBL` as 'Code' ,`LB_FONCPUBL` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_fonction_publique`",
            'champ' => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
