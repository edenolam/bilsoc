<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitude;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefInaptitudeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refinaptitude controller.
 *
 */
class RefInaptitudeController extends Controller {

    /**
     * Lists all refInaptitude entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $refInaptitudes = $em->getRepository('ReferencielBundle:RefInaptitude')->findAll();

        return $this->render('@Referenciel/refinaptitude/index.html.twig', array(
                    'refInaptitudes' => $refInaptitudes,
        ));
    }

    /**
     * Creates a new refInaptitude entity.
     *
     */
    public function newAction(Request $request) {
        $refInaptitude = new Refinaptitude();
        $form = $this->createForm(RefInaptitudeType::class, $refInaptitude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refInaptitude->setCdUtilcrea($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($refInaptitude);
            $em->flush();
            $this->addFlash(
                    'action', $this->get('translator')->trans('ajout.referentiel.flash')
            );


            return $this->redirectToRoute('refinaptitude_show', array('idInap' => $refInaptitude->getIdinap()));
        }

        return $this->render('@Referenciel/refinaptitude/new.html.twig', array(
                    'refInaptitude' => $refInaptitude,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refInaptitude entity.
     *
     */
    public function showAction(RefInaptitude $refInaptitude) {
        $deleteForm = $this->createDeleteForm($refInaptitude);

        return $this->render('@Referenciel/refinaptitude/show.html.twig', array(
                    'refInaptitude' => $refInaptitude,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refInaptitude entity.
     *
     */
    public function editAction(Request $request, RefInaptitude $refInaptitude) {
        $deleteForm = $this->createDeleteForm($refInaptitude);
        $editForm = $this->createForm(RefInaptitudeType::class, $refInaptitude);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $refInaptitude->setCdUtilmodi($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                    'action', $this->get('translator')->trans('modification.referentiel.flash')
            );

            return $this->redirectToRoute('refinaptitude_edit', array('idInap' => $refInaptitude->getIdinap()));
        }

        return $this->render('@Referenciel/refinaptitude/edit.html.twig', array(
                    'refInaptitude' => $refInaptitude,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refInaptitude entity.
     *
     */
    public function deleteAction(Request $request, RefInaptitude $refInaptitude) {
        $form = $this->createDeleteForm($refInaptitude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refInaptitude->setBlVali(1);
            $em->flush($refInaptitude);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refinaptitude_index');
    }

    /**
     * Creates a form to delete a refInaptitude entity.
     *
     * @param RefInaptitude $refInaptitude The refInaptitude entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefInaptitude $refInaptitude) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('refinaptitude_delete', array('idInap' => $refInaptitude->getIdinap())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename' => "refInaptitude",
            'requete_sql' => "SELECT CD_INAP as 'Code' ,LB_INAP as 'Libellé', (CASE WHEN BL_DEMA <> 0 THEN 'Non' ELSE 'Oui' END) as 'Demande',  (CASE WHEN BL_DECI <> 0 THEN 'Non' ELSE 'Oui' END) as 'Décision',(CASE WHEN BL_VISUAGEN <> 0 THEN 'Non' ELSE 'Oui' END) as 'Agent', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé'  FROM `ref_inaptitude` ",
            'champ' => array('Code', 'Libellé', 'Demande', 'Décision', 'Agent', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }

}
