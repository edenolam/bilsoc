<?php

namespace Bilan_Social\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Bilan_Social\Bundle\UserBundle\Form\UserType;
use Bilan_Social\Bundle\UserBundle\Entity\UserDraft;
use Bilan_Social\Bundle\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AccountController extends Controller {

    /**
     * Displays a form to edit current user entity.
     *
     */
    public function editAction(Request $request) {
        $user = $this->getUser();

        if ($user->getBlComptemp()) {
            return $this->render('@Core/account/edit.html.twig', array(
                        'change_request' => true
            ));
        }

        $editForm = $this->createForm(UserType::class, $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_account', array('id' => $user->getIdUtil()));
        }

        return $this->render('@Core/account/edit.html.twig', array(
                    'change_request' => false,
                    'edit_form' => $editForm->createView()
        ));
    }

    /**
     *
     * @Security("has_role('ROLE_CDG') && user.getCanValidUserAccount()")
     *
     */
    public function showDraftAction() {
        $repository = $this->getDoctrine()->getRepository('UserBundle:UserDraft');
        $userDrafts = $repository->findAll();

        return $this->render('@Core/account/draft.html.twig', array(
                    'userDrafts' => $userDrafts
        ));
    }

    /**
     * @param UserDraft $userDraft
     * @Security("has_role('ROLE_CDG') && user.getCanValidUserAccount()")
     * @Method({"GET"})
     */
    public function acceptChangeAction(UserDraft $userDraft) {
        $this->get('bs.user.manager')->acceptChange($userDraft);
        return $this->redirectToRoute('user_account_draft');
    }

    /**
     *
     * @param UserDraft $userDraft
     * @Security("has_role('ROLE_CDG') && user.getCanValidUserAccount()")
     */
    public function rejectChangeAction(UserDraft $userDraft) {
        $this->get('bs.user.manager')->rejectChange($userDraft);
        return $this->redirectToRoute('user_account_draft');
    }

}
