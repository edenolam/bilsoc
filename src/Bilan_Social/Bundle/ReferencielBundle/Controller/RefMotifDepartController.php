<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefMotifDepartType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refmotifdepart controller.
 *
 */
class RefMotifDepartController extends Controller {

    /**
     * Lists all refMotifDepart entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refMotifDeparts = $em->getRepository('ReferencielBundle:RefMotifDepart')->findAll();

        return $this->render('@Referenciel/refmotifdepart/index.html.twig', array(
                    'refMotifDeparts' => $refMotifDeparts,
        ));
    }

    /**
     * Creates a new refMotifDepart entity.
     *
     */
    public function newAction(Request $request) {
        $refMotifDepart = new Refmotifdepart();
        $form = $this->createForm(RefMotifDepartType::class, $refMotifDepart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refMotifDepart->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refMotifDepart);
            $em->flush();

            $this->addFlash('action', $this->get('translator')->trans('ajout.referentiel.flash'));
            return $this->redirectToRoute('refmotifdepart_show', array('idMotidepa' => $refMotifDepart->getIdmotidepa()));
        }

        return $this->render('@Referenciel/refmotifdepart/new.html.twig', array(
                    'refMotifDepart' => $refMotifDepart,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refMotifDepart entity.
     *
     */
    public function showAction(RefMotifDepart $refMotifDepart) {
        $deleteForm = $this->createDeleteForm($refMotifDepart);

        return $this->render('@Referenciel/refmotifdepart/show.html.twig', array(
                    'refMotifDepart' => $refMotifDepart,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refMotifDepart entity.
     *
     */
    public function editAction(Request $request, RefMotifDepart $refMotifDepart) {
        $deleteForm = $this->createDeleteForm($refMotifDepart);
        $editForm = $this->createForm(RefMotifDepartType::class, $refMotifDepart);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refMotifDepart->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('action', $this->get('translator')->trans('modification.referentiel.flash'));
            return $this->redirectToRoute('refmotifdepart_edit', array('idMotidepa' => $refMotifDepart->getIdmotidepa()));
        }

        return $this->render('@Referenciel/refmotifdepart/edit.html.twig', array(
                    'refMotifDepart' => $refMotifDepart,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refMotifDepart entity.
     *
     */
    public function deleteAction(Request $request, RefMotifDepart $refMotifDepart) {
        $form = $this->createDeleteForm($refMotifDepart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refMotifDepart->setBlVali(1);
            $em->flush($refMotifDepart);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refmotifdepart_index');
    }

    /**
     * Creates a form to delete a refMotifDepart entity.
     *
     * @param RefMotifDepart $refMotifDepart The refMotifDepart entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefMotifDepart $refMotifDepart) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refmotifdepart_delete', array('idMotidepa' => $refMotifDepart->getIdmotidepa())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refMotifDepart",
            'requete_sql' => "SELECT md.CD_MOTIDEPA as 'Code' , md.LB_MOTIDEPA as 'Libellé', (CASE WHEN md.BL_DEPADEFI <> 0 THEN 'Non' ELSE 'Oui' END) as 'Départ définitif', (CASE WHEN md.BL_DEPATEMP <> 0 THEN 'Non' ELSE 'Oui' END) as 'Départ Temporaire', GROUP_CONCAT( s.LB_STAT SEPARATOR '-' ) as 'Statut', (CASE WHEN md.BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé'  FROM `ref_motif_depart` md left JOIN statut_motif_depart smd ON smd.motif_depart_id = md.ID_MOTIDEPA LEFT JOIN ref_statut s ON s.ID_STAT = smd.status_id GROUP BY md.CD_MOTIDEPA",
            'champ' => array('Code', 'Libellé', 'Départ définitif', 'Départ Temporaire', 'Statut', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
