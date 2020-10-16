<?php

namespace Bilan_Social\Bundle\ModeleMailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@ModeleMail/Default/index.html.twig');
    }
}
