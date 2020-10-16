<?php

namespace Bilan_Social\Bundle\FaqBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Faq/Default/index.html.twig');
    }
}
