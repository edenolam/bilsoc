<?php

namespace Bilan_Social\Bundle\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Contact/Default/index.html.twig');
    }
}
