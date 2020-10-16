<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\UserBundle\Listener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Bilan_Social\Bundle\UserBundle\Entity\HistoriqueConnexion;

/**
 * Description of LoginListener
 *
 * @author mbusson
 */
class LoginListener {

    /** @var \Symfony\Component\Security\Core\Authorization\AuthorizationChecker */
    private $securityAuthorizationChecker;

    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    /**
     * Constructor
     *
     * @param AuthorizationChecker $securityAuthorizationChecker
     * @param Doctrine        $doctrine
     */
    public function __construct(AuthorizationChecker $securityAuthorizationChecker, Doctrine $doctrine) {
        $this->securityAuthorizationChecker = $securityAuthorizationChecker;
        $this->em = $doctrine->getManager();
    }

    /**
     * Do the magic.
     *
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) {

        /*if ($this->securityAuthorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {

            $user = $event->getAuthenticationToken()->getUser();
            $user_id = $user->getIdUtil();
            $new_Date = new \DateTime('now');
            $new_Date->format('Y-m-d H:i:s');

            $LastDtConnexion = $this->em->getRepository('UserBundle:HistoriqueConnexion')->findOneBy(array('idUtil' => $user_id), array('dtConn' => 'DESC'));

            if ($LastDtConnexion != null) {
                $user->setDtLastconn($LastDtConnexion->getDtConn());
            }

            $historique_conn_new = new HistoriqueConnexion();
            $historique_conn_new->setDtConn($new_Date);
            $historique_conn_new->setIdUtil($user_id);

            $this->em->persist($historique_conn_new);
            $this->em->persist($user);
            $this->em->flush();
        }

        if ($this->securityAuthorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            // user has logged in using remember_me cookie
        }

        // do some other magic here
        $user = $event->getAuthenticationToken()->getUser();
        */
        // ...
    }

}
