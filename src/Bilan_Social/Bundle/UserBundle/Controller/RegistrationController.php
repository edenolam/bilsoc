<?php

namespace Bilan_Social\Bundle\UserBundle\Controller;

use Bilan_Social\Bundle\UserBundle\Entity\User;
use Bilan_Social\Bundle\UserBundle\Form\CdgType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller {

    /**
     *  User registration
     */
    public function registerAction(Request $request) {
        $current_user = $this->getUser();
        $user = new User();
        $form = $this->createForm(CdgType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            /* Set the current datetime */
            $user->setCreatedAt(new \DateTime());
            /* Set the current id user */
            $user->setCdUtilcrea($current_user->getIdUtil());

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('notice', 'L\'utilisateur a été créé!');

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
                        '@User/Security/register.html.twig', array('form' => $form->createView())
        );
    }

}
