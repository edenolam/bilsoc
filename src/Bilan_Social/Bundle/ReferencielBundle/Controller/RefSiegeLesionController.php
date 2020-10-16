<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSiegeLesion;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefSiegeLesionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refsiegelesion controller.
 *
 */
class RefSiegeLesionController extends Controller
{
    /**
     * Lists all refSiegeLesion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refSiegeLesions = $em->getRepository('ReferencielBundle:RefSiegeLesion')->findAll();

        return $this->render('@Referenciel/refsiegelesion/index.html.twig', array(
            'refSiegeLesions' => $refSiegeLesions,
        ));
    }

    /**
     * Creates a new refSiegeLesion entity.
     *
     */
    public function newAction(Request $request)
    {
        $refSiegeLesion = new Refsiegelesion();
        $form = $this->createForm(RefSiegeLesionType::class, $refSiegeLesion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refSiegeLesion);
            $em->flush();

            return $this->redirectToRoute('refsiegelesion_show', array('idSiegelesi' => $refSiegeLesion->getIdsiegelesi()));
        }

        return $this->render('@Referenciel/refsiegelesion/new.html.twig', array(
            'refSiegeLesion' => $refSiegeLesion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refSiegeLesion entity.
     *
     */
    public function showAction(RefSiegeLesion $refSiegeLesion)
    {
        $deleteForm = $this->createDeleteForm($refSiegeLesion);

        return $this->render('@Referenciel/refsiegelesion/show.html.twig', array(
            'refSiegeLesion' => $refSiegeLesion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refSiegeLesion entity.
     *
     */
    public function editAction(Request $request, RefSiegeLesion $refSiegeLesion)
    {
        $deleteForm = $this->createDeleteForm($refSiegeLesion);
        $editForm = $this->createForm(RefSiegeLesionType::class, $refSiegeLesion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('refsiegelesion_edit', array('idSiegelesi' => $refSiegeLesion->getIdsiegelesi()));
        }

        return $this->render('@Referenciel/refsiegelesion/edit.html.twig', array(
            'refSiegeLesion' => $refSiegeLesion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refSiegeLesion entity.
     *
     */
    public function deleteAction(Request $request, RefSiegeLesion $refSiegeLesion)
    {
        $form = $this->createDeleteForm($refSiegeLesion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refSiegeLesion->setBlVali(1);
            $em->flush($refSiegeLesion);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }


        return $this->redirectToRoute('refsiegelesion_index');
    }

    /**
     * Creates a form to delete a refSiegeLesion entity.
     *
     * @param RefSiegeLesion $refSiegeLesion The refSiegeLesion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefSiegeLesion $refSiegeLesion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refsiegelesion_delete', array('idSiegelesi' => $refSiegeLesion->getIdsiegelesi())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    
    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename'    => "RefSiegeLesion",
            'requete_sql' => "SELECT `CD_SIEGE_LESION` as 'Code' ,`LB_SIEGE_LESION` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_siege_lesion`",
            'champ'       => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }
}
