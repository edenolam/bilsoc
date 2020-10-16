<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeSurclassDemo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reftypesurclassdemo controller.
 *
 */
class RefTypeSurclassDemoController extends Controller
{
    /**
     * Lists all refTypeSurclassDemo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refTypeSurclassDemos = $em->getRepository('ReferencielBundle:RefTypeSurclassDemo')->findAll();

        return $this->render('@Referenciel/reftypesurclassdemo/index.html.twig', array(
            'refTypeSurclassDemos' => $refTypeSurclassDemos,
        ));
    }

    /**
     * Creates a new refTypeSurclassDemo entity.
     *
     */
    public function newAction(Request $request)
    {
        $refTypeSurclassDemo = new Reftypesurclassdemo();
        $form = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefTypeSurclassDemoType', $refTypeSurclassDemo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refTypeSurclassDemo);
            $em->flush();

            return $this->redirectToRoute('reftypesurclassdemo_show', array('idTypeSurclassDemo' => $refTypeSurclassDemo->getIdtypesurclassdemo()));
        }

        return $this->render('@Referenciel/reftypesurclassdemo/new.html.twig', array(
            'refTypeSurclassDemo' => $refTypeSurclassDemo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refTypeSurclassDemo entity.
     *
     */
    public function showAction(RefTypeSurclassDemo $refTypeSurclassDemo)
    {
        $deleteForm = $this->createDeleteForm($refTypeSurclassDemo);

        return $this->render('@Referenciel/reftypesurclassdemo/show.html.twig', array(
            'refTypeSurclassDemo' => $refTypeSurclassDemo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refTypeSurclassDemo entity.
     *
     */
    public function editAction(Request $request, RefTypeSurclassDemo $refTypeSurclassDemo)
    {
        $deleteForm = $this->createDeleteForm($refTypeSurclassDemo);
        $editForm = $this->createForm('Bilan_Social\Bundle\ReferencielBundle\Form\RefTypeSurclassDemoType', $refTypeSurclassDemo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reftypesurclassdemo_edit', array('idTypeSurclassDemo' => $refTypeSurclassDemo->getIdtypesurclassdemo()));
        }

        return $this->render('@Referenciel/reftypesurclassdemo/edit.html.twig', array(
            'refTypeSurclassDemo' => $refTypeSurclassDemo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refTypeSurclassDemo entity.
     *
     */
    public function deleteAction(Request $request, RefTypeSurclassDemo $refTypeSurclassDemo)
    {
        $form = $this->createDeleteForm($refTypeSurclassDemo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refTypeSurclassDemo);
            $em->flush();
        }

        return $this->redirectToRoute('reftypesurclassdemo_index');
    }

    /**
     * Creates a form to delete a refTypeSurclassDemo entity.
     *
     * @param RefTypeSurclassDemo $refTypeSurclassDemo The refTypeSurclassDemo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefTypeSurclassDemo $refTypeSurclassDemo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reftypesurclassdemo_delete', array('idTypeSurclassDemo' => $refTypeSurclassDemo->getIdtypesurclassdemo())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
