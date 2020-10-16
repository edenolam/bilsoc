<?php

namespace Bilan_Social\Bundle\ModelMailBundle\Controller;

use Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailInterneAppli;
use Bilan_Social\Bundle\ModelMailBundle\Form\ModelMailInterneAppliEditType;
use Bilan_Social\Bundle\ModelMailBundle\Form\ModelMailInterneAppliType;
use Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailInterneAppliCdg;
use Bilan_Social\Bundle\ModelMailBundle\Form\ModelMailInterneAppliCdgType;
use Bilan_Social\Bundle\ModelMailBundle\Form\ModelMailInterneAppliShowCdgType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\Request;

/**
 * ModelMailInterneAppli controller.
 *
 */
class ModelMailInterneAppliController extends AbstractBsController {
    /**
     * Lists all ModelMailInterneAppli entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        if ($this->getUser()->hasRole('ROLE_ADMIN')) {
            $ModelMailInterneApplis = $em->getRepository('ModelMailBundle:ModelMailInterneAppli')->findAll();

            return $this->render('@ModelMail/ModelMailInterneAppli/index.html.twig', array(
                        'modelmailinterneapplis' => $ModelMailInterneApplis,
            ));
        }

        if ($this->getUser()->hasRole('ROLE_CDG')) {
            $ModelMailInterneApplis = $em->getRepository('ModelMailBundle:ModelMailInterneAppli')->findModelMailForCdg();

            $cdg = $em->getRepository('CollectiviteBundle:Cdg')->findCDGByUtilisateur($this->getUser());
            $ModelMailsPerso = $em->getRepository('ModelMailBundle:ModelMailInterneAppliCdg')->findByIdCdg($cdg);

            return $this->render('@ModelMail/ModelMailInterneAppli/index_cdg.html.twig', array(
                        'modelmails'      => $ModelMailInterneApplis,
                        'modelmailsperso' => $ModelMailsPerso,
            ));
        }
    }

    /**
     * Creates a new ModelMailInterneAppli entity.
     *
     */
    public function newAction(Request $request)
    {
        $ModelMailInterneAppli = new ModelMailInterneAppli();
        $form = $this->createForm(ModelMailInterneAppliType::class, $ModelMailInterneAppli);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ModelMailInterneAppli);
            $em->flush();

            return $this->redirectToRoute('modelmailinterneappli_show', array('id' => $ModelMailInterneAppli->getId()));
        }

        return $this->render('@ModelMail/ModelMailInterneAppli/new.html.twig', array(
            'modelmailinterneappli' => $ModelMailInterneAppli,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ModelMailInterneAppli entity.
     *
     */
    public function showAction(ModelMailInterneAppli $ModelMailInterneAppli)
    {
        $deleteForm = $this->createDeleteForm($ModelMailInterneAppli);
        if ($this->getUser()->hasRole('ROLE_CDG')) {
            return $this->render('@ModelMail/ModelMailInterneAppli/show_cdg.html.twig', array(
                        'modelmailinterneappli' => $ModelMailInterneAppli,
            ));
        }
        if ($this->getUser()->hasRole('ROLE_ADMIN')) {
            return $this->render('@ModelMail/ModelMailInterneAppli/show.html.twig', array(
                        'modelmailinterneappli' => $ModelMailInterneAppli,
                        'delete_form'           => $deleteForm->createView(),
            ));
        }
    }

    /**
     * Displays a form to edit an existing ModelMailInterneAppli entity.
     *
     */
    public function editAction(Request $request, ModelMailInterneAppli $ModelMailInterneAppli)
    {
        $deleteForm = $this->createDeleteForm($ModelMailInterneAppli);
        $editForm = $this->createForm(ModelMailInterneAppliEditType::class, $ModelMailInterneAppli);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('modelmailinterneappli_edit', array('id' => $ModelMailInterneAppli->getId()));
        }

        return $this->render('@ModelMail/ModelMailInterneAppli/edit.html.twig', array(
            'ModelMailInterneAppli' => $ModelMailInterneAppli,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ModelMailInterneAppli entity.
     *
     */
    public function deleteAction(Request $request, ModelMailInterneAppli $ModelMailInterneAppli)
    {
        $form = $this->createDeleteForm($ModelMailInterneAppli);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ModelMailInterneAppli);
            $em->flush();
        }

        return $this->redirectToRoute('ModelMailInterneAppli_index');
    }

    /**
     * Creates a form to delete a ModelMailInterneAppli entity.
     *
     * @param ModelMailInterneAppli $ModelMailInterneAppli The ModelMailInterneAppli entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ModelMailInterneAppli $ModelMailInterneAppli)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modelmailinterneappli_delete', array('id' => $ModelMailInterneAppli->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Finds and displays a ModelMail entity.
     *
     */
    public function showModalAction(Request $request, ModelMailInterneAppliCdg $ModelMailInterneAppli) {
        if ($this->checkIsUserOwnerOf($ModelMailInterneAppli)) {
            $showForm = $this->createForm(ModelMailInterneAppliShowCdgType::class, $ModelMailInterneAppli);
            $showForm->handleRequest($request);


            return $this->render('@ModelMail/ModelMailInterneAppli/Modal.html.twig', array(
                        'modelmail' => $ModelMailInterneAppli,
                        'show_form' => $showForm->createView(),
            ));
        }
        else {
            return $this->redirectToRoute('modelmail_index');
        }
    }

    /**
     * Displays a form to edit an existing ModelMail entity for a cdg.
     *
     */
    public function editCdgAction(Request $request, ModelMailInterneAppliCdg $ModelMailInterneAppliCdg) {
        if ($this->checkIsUserOwnerOf($ModelMailInterneAppliCdg)) {
            $deleteForm = $this->createDeleteFormCdg($ModelMailInterneAppliCdg);
            $editForm = $this->createForm(ModelMailInterneAppliCdgType::class, $ModelMailInterneAppliCdg);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {


                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('modelmailinterneappli_index');
            }

            return $this->render('@ModelMail/ModelMailInterneAppli/edit.html.twig', array(
                        'ModelMailInterneAppli' => $ModelMailInterneAppliCdg,
                    'edit_form'   => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
            ));
        }
        else {
            return $this->redirectToRoute('modelmailinterneappli_index');
        }
    }

    public function duplicateAction(Request $request, $id = null) {
        $em = $this->getDoctrine()->getManager();
        $cdg = $em->getRepository('CollectiviteBundle:Cdg')->findCDGByUtilisateur($this->getUser());
        $ModelMailInterneAdmin = $em->getRepository('ModelMailBundle:ModelMailInterneAppli')->findOneById($id);
        $codeExisting = $em->getRepository('ModelMailBundle:ModelMailInterneAppliCdg')->findOneByCodeApp($ModelMailInterneAdmin->getCodeApp());

        if ($codeExisting == null) {
            $modelMailInterneAppliPerso = new ModelMailInterneAppliCdg();

            $modelMailInterneAppliPerso->setBody($ModelMailInterneAdmin->getBody());
            $modelMailInterneAppliPerso->setCodeApp($ModelMailInterneAdmin->getCodeApp());
            $modelMailInterneAppliPerso->setIdCdg($cdg);
            $modelMailInterneAppliPerso->setObjet($ModelMailInterneAdmin->getObjet());

            $editForm = $this->createForm(ModelMailInterneAppliCdgType::class, $modelMailInterneAppliPerso);
            $editForm->handleRequest($request);

            $em->persist($modelMailInterneAppliPerso);
            $em->flush();
        }
        else {
            $this->addFlash('error', 'Ce modèle de mail a déjà été dupliqué.');
        }

        return $this->forward('ModelMailBundle:ModelMailInterneAppli:index');
    }

    /**
     * Deletes a ModelMail entity.
     *
     */
    public function deleteCdgAction(Request $request, ModelMailInterneAppliCdg $ModelMailInterneAppliCdg) {
        if ($this->checkIsUserOwnerOf($ModelMailInterneAppliCdg)) {
            $form = $this->createDeleteFormCdg($ModelMailInterneAppliCdg);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($ModelMailInterneAppliCdg);
                $em->flush();
            }
        }
        return $this->redirectToRoute('modelmailinterneappli_index');
    }

    /**
     * Creates a form to delete a ModelMail entity.
     *
     * @param ModelMailCdg $ModelMail The ModelMail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteFormCdg(ModelMailInterneAppliCdg $ModelMailInterneAppliCdg) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('modelmailinterneappli_delete_cdg', array('id' => $ModelMailInterneAppliCdg->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
