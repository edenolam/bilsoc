<?php

namespace Bilan_Social\Bundle\UserBundle\Listener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;

class LogoutListener implements LogoutHandlerInterface {
    
    public function __construct(){
    }
    
    public function logout(Request $Request, Response $Response, TokenInterface $Token) {
        #$Response->headers->set('Cache-Control', 'no-cache, max-age=0, must-revalidate, no-store');
    }
}