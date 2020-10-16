<?php

namespace Bilan_Social\Bundle\ModelMailBundle\Controller;

use Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMail;
use Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailCdg;
use Bilan_Social\Bundle\ModelMailBundle\Form\ModelMailCdgType;
use Bilan_Social\Bundle\ModelMailBundle\Form\ModelMailShowCdgType;
use Bilan_Social\Bundle\ModelMailBundle\Form\ModelMailType;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * ModelMail controller.
 *
 */
class ModelMailController extends AbstractBsController
{
    /**
     * Lists all ModelMail entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        if ($this->getUser()->hasRole('ROLE_ADMIN')){
                $ModelMails = $em->getRepository('ModelMailBundle:ModelMail')->findAll();

                return $this->render('@ModelMail/ModelMail/index.html.twig', array(
                    'modelmails' => $ModelMails,
        ));
        }
        if ($this->getUser()->hasRole('ROLE_CDG')){
                $ModelMails = $em->getRepository('ModelMailBundle:ModelMail')->findBy(array('blVali' => 1));

                $cdg = $em->getRepository('CollectiviteBundle:Cdg')->findCDGByUtilisateur($this->getUser());
                $ModelMailsPerso = $em->getRepository('ModelMailBundle:ModelMailCdg')->findByIdCdg($cdg);

                return $this->render('@ModelMail/ModelMail/index_cdg.html.twig', array(
                 'modelmails' => $ModelMails,
                 'modelmailsperso' => $ModelMailsPerso,
        ));
        }
    }

    /**
     * Creates a new ModelMail entity.
     *
     */
    public function newAction(Request $request)
    {
        $ModelMail = new ModelMail();
        $form = $this->createForm(ModelMailType::class, $ModelMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($ModelMail);
            $em->flush();

            return $this->redirectToRoute('modelmail_show', array('id' => $ModelMail->getId()));
        }

        return $this->render('@ModelMail/ModelMail/new.html.twig', array(
            'modelmails' => $ModelMail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ModelMail entity.
     *
     */
    public function showAction(ModelMail $ModelMail)
    {
        $deleteForm = $this->createDeleteForm($ModelMail);

         if ($this->getUser()->hasRole('ROLE_CDG')){
            return $this->render('@ModelMail/ModelMail/showcdg.html.twig', array(
                'modelmail' => $ModelMail,
            ));
         }
         if ($this->getUser()->hasRole('ROLE_ADMIN')){
            return $this->render('@ModelMail/ModelMail/show.html.twig', array(
                'modelmail' => $ModelMail,
                'delete_form' => $deleteForm->createView(),
            ));
         }
    }

    /**
     * Displays a form to edit an existing ModelMail entity.
     *
     */
    public function editAction(Request $request, ModelMail $ModelMail)
    {
        $deleteForm = $this->createDeleteForm($ModelMail);
        $editForm = $this->createForm(ModelMailType::class, $ModelMail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('modelmail_edit', array('id' => $ModelMail->getId()));
        }

        return $this->render('@ModelMail/ModelMail/edit.html.twig', array(
            'modelmail' => $ModelMail,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ModelMail entity.
     *
     */
    public function deleteAction(Request $request, ModelMail $ModelMail)
    {
        $form = $this->createDeleteForm($ModelMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ModelMail);
            $em->flush();
        }

        return $this->redirectToRoute('modelmail_index');
    }

    /**
     * Creates a form to delete a ModelMail entity.
     *
     * @param ModelMail $ModelMail The ModelMail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ModelMail $ModelMail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modelmail_delete', array('id' => $ModelMail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Creates a form to delete a ModelMail entity.
     *
     * @param ModelMailCdg $ModelMail The ModelMail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteFormCdg(ModelMailCdg $ModelMail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modelmail_delete_cdg', array('id' => $ModelMail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /* Gestion des actions liés a un CDG */

       /**
     * Creates a new ModelMail entity.
     *
     */
    public function newCdgAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $cdg = $em->getRepository('CollectiviteBundle:Cdg')->findCDGByUtilisateur($this->getUser());

        $ModelMail = new ModelMailCdg();
        $form = $this->createForm(ModelMailCdgType::class, $ModelMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ModelMail->setIdCdg($cdg);
            $em->persist($ModelMail);
            $em->flush();

            return $this->redirectToRoute('modelmail_index');
        }

        return $this->render('@ModelMail/ModelMail/new_cdg.html.twig', array(
            'modelmails' => $ModelMail,
            'form' => $form->createView(),
        ));
    }

      /**
     * Displays a form to edit an existing ModelMail entity for a cdg.
     *
     */
    public function editCdgAction(Request $request, ModelMailCdg $ModelMail)
    {
        if($this->checkIsUserOwnerOf($ModelMail)){
            $deleteForm = $this->createDeleteFormCdg($ModelMail);
            $editForm = $this->createForm(ModelMailCdgType::class, $ModelMail);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {


                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('modelmail_index');
            }

            return $this->render('@ModelMail/ModelMail/edit.html.twig', array(
                'modelmail' => $ModelMail,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }else{
            return $this->redirectToRoute('modelmail_index');
        }
    }

    /**
     * Finds and displays a ModelMail entity.
     *
     */
    public function showModalAction(Request $request, ModelMailCdg $ModelMail)
    {
        if($this->checkIsUserOwnerOf($ModelMail)){
            $showForm = $this->createForm(ModelMailShowCdgType::class, $ModelMail);
            $showForm->handleRequest($request);


            return $this->render('@ModelMail/ModelMail/Modal.html.twig', array(
                'modelmail' => $ModelMail,
                'show_form' => $showForm->createView(),
            ));
        }else{
            return $this->redirectToRoute('modelmail_index');
        }
    }

    public function duplicateAction(Request $request, $id = null){
        $em = $this->getDoctrine()->getManager();
        $cdg = $em->getRepository('CollectiviteBundle:Cdg')->findCDGByUtilisateur($this->getUser());
        $ModelMailadmin = $em->getRepository('ModelMailBundle:ModelMail')->findOneById($id);

        $modelMailPerso = new ModelMailCdg();

        $modelMailPerso->setBody($ModelMailadmin->getBody());
        $modelMailPerso->setIdCdg($cdg);
        $modelMailPerso->setObject($ModelMailadmin->getObjet());

        $editForm = $this->createForm(ModelMailCdgType::class, $modelMailPerso);
        $editForm->handleRequest($request);

       
        $em->persist($modelMailPerso);
        $em->flush();

        return $this->redirectToRoute('modelmail_index');

      }



     /**
     * Deletes a ModelMail entity.
     *
     */
    public function deleteCdgAction(Request $request, ModelMailCdg $ModelMail)
    {
        if($this->checkIsUserOwnerOf($ModelMail)){
            $form = $this->createDeleteFormCdg($ModelMail);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($ModelMail);
                $em->flush();
            }
        }
        return $this->redirectToRoute('modelmail_index');
    }


}
