<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiFonctionnel;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefEmploiFonctionnelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refemploifonctionnel controller.
 *
 */
class RefEmploiFonctionnelController extends Controller {

    /**
     * Lists all refEmploiFonctionnel entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refEmploiFonctionnels = $em->getRepository('ReferencielBundle:RefEmploiFonctionnel')->findAll();

        return $this->render('@Referenciel/refemploifonctionnel/index.html.twig', array(
                    'refEmploiFonctionnels' => $refEmploiFonctionnels,
        ));
    }

    /**
     * Creates a new refEmploiFonctionnel entity.
     *
     */
    public function newAction(Request $request) {
        $refEmploiFonctionnel = new Refemploifonctionnel();
        $form = $this->createForm(RefEmploiFonctionnelType::class, $refEmploiFonctionnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refEmploiFonctionnel->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refEmploiFonctionnel);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );

            return $this->redirectToRoute('refemploifonctionnel_show', array('idEmplfonc' => $refEmploiFonctionnel->getIdemplfonc()));
        }

        return $this->render('@Referenciel/refemploifonctionnel/new.html.twig', array(
                    'refEmploiFonctionnel' => $refEmploiFonctionnel,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refEmploiFonctionnel entity.
     *
     */
    public function showAction(RefEmploiFonctionnel $refEmploiFonctionnel) {
        $deleteForm = $this->createDeleteForm($refEmploiFonctionnel);

        return $this->render('@Referenciel/refemploifonctionnel/show.html.twig', array(
                    'refEmploiFonctionnel' => $refEmploiFonctionnel,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refEmploiFonctionnel entity.
     *
     */
    public function editAction(Request $request, RefEmploiFonctionnel $refEmploiFonctionnel) {
        $deleteForm = $this->createDeleteForm($refEmploiFonctionnel);
        $editForm = $this->createForm(RefEmploiFonctionnelType::class, $refEmploiFonctionnel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refEmploiFonctionnel->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refemploifonctionnel_edit', array('idEmplfonc' => $refEmploiFonctionnel->getIdemplfonc()));
        }

        return $this->render('@Referenciel/refemploifonctionnel/edit.html.twig', array(
                    'refEmploiFonctionnel' => $refEmploiFonctionnel,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refEmploiFonctionnel entity.
     *
     */
    public function deleteAction(Request $request, RefEmploiFonctionnel $refEmploiFonctionnel) {
        $form = $this->createDeleteForm($refEmploiFonctionnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refEmploiFonctionnel->setBlVali(1);
            $em->flush($refEmploiFonctionnel);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refemploifonctionnel_index');
    }

    /**
     * Creates a form to delete a refEmploiFonctionnel entity.
     *
     * @param RefEmploiFonctionnel $refEmploiFonctionnel The refEmploiFonctionnel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefEmploiFonctionnel $refEmploiFonctionnel) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refemploifonctionnel_delete', array('idEmplfonc' => $refEmploiFonctionnel->getIdemplfonc())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refEmploiFonctionnel",
            'requete_sql' => "SELECT rce.CD_EMPLFONC as 'Code', rce.LB_EMPLFONC as 'Libellé', (CASE WHEN rce.BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé', f.LB_FILI as 'Filière' FROM `ref_emploi_fonctionnel` rce JOIN ref_filiere f ON rce.ID_FILI = f.ID_FILI WHERE 1",
            'champ' => array('Code', 'Libellé', 'Archivé', 'Filière'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
