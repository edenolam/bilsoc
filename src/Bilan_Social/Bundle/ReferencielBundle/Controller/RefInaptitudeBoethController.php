<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitudeBoeth;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefInaptitudeBoethType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refinaptitudeboeth controller.
 *
 */
class RefInaptitudeBoethController extends Controller
{
    /**
     * Lists all refInaptitudeBoeth entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refInaptitudeBoeths = $em->getRepository('ReferencielBundle:RefInaptitudeBoeth')->findAll();

        return $this->render('@Referenciel/refinaptitudeboeth/index.html.twig', array(
            'refInaptitudeBoeths' => $refInaptitudeBoeths,
        ));
    }

    /**
     * Creates a new refInaptitudeBoeth entity.
     *
     */
    public function newAction(Request $request)
    {
        $refInaptitudeBoeth = new Refinaptitudeboeth();
        $form = $this->createForm(RefInaptitudeBoethType::class, $refInaptitudeBoeth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refInaptitudeBoeth);
            $em->flush();

            return $this->redirectToRoute('refinaptitudeboeth_show', array('idInaptitudeboeth' => $refInaptitudeBoeth->getIdinaptitudeboeth()));
        }

        return $this->render('@Referenciel/refinaptitudeboeth/new.html.twig', array(
            'refInaptitudeBoeth' => $refInaptitudeBoeth,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refInaptitudeBoeth entity.
     *
     */
    public function showAction(RefInaptitudeBoeth $refInaptitudeBoeth)
    {
        $deleteForm = $this->createDeleteForm($refInaptitudeBoeth);

        return $this->render('@Referenciel/refinaptitudeboeth/show.html.twig', array(
            'refInaptitudeBoeth' => $refInaptitudeBoeth,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refInaptitudeBoeth entity.
     *
     */
    public function editAction(Request $request, RefInaptitudeBoeth $refInaptitudeBoeth)
    {
        $deleteForm = $this->createDeleteForm($refInaptitudeBoeth);
        $editForm = $this->createForm(RefInaptitudeBoethType::class, $refInaptitudeBoeth);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('refinaptitudeboeth_edit', array('idInaptitudeboeth' => $refInaptitudeBoeth->getIdinaptitudeboeth()));
        }

        return $this->render('@Referenciel/refinaptitudeboeth/edit.html.twig', array(
            'refInaptitudeBoeth' => $refInaptitudeBoeth,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refInaptitudeBoeth entity.
     *
     */
    public function deleteAction(Request $request, RefInaptitudeBoeth $refInaptitudeBoeth)
    {
        $form = $this->createDeleteForm($refInaptitudeBoeth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refInaptitudeBoeth->setBlVali(1);
            $em->flush($refInaptitudeBoeth);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refinaptitudeboeth_index');
    }

    /**
     * Creates a form to delete a refInaptitudeBoeth entity.
     *
     * @param RefInaptitudeBoeth $refInaptitudeBoeth The refInaptitudeBoeth entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefInaptitudeBoeth $refInaptitudeBoeth)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refinaptitudeboeth_delete', array('idInaptitudeboeth' => $refInaptitudeBoeth->getIdinaptitudeboeth())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
