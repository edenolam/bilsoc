<?php

namespace Bilan_Social\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Bilan_Social\Bundle\UserBundle\Entity\User;
use Bilan_Social\Bundle\UserBundle\Repository\UserRepository;

/**
 * Collectivity controller.
 *
 */
class CollectivityController extends Controller {

    public function listAction() {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $collectivities = $em->getRepository('UserBundle:User')->getCollectivitiesByDepartment($user->getDepartment());


        return $this->render('@Core/collectivity/list.html.twig', array(
                    'collectivities' => $collectivities,
        ));
    }

    public function showCollectivityBilanAction($userId) {
        $session = $this->get('session');
        $session->set('user_id', $userId);

        return $this->redirectToRoute('social_index');
    }

    public function removeCollectivitySessionAction() {
        $session = $this->get('session');
        $session->remove('user_id');
        $session->remove('user_siret');

        return $this->redirectToRoute('collectivity_list');
    }

}
