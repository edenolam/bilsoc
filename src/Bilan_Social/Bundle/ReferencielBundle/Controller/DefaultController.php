<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {


        return $this->render('@Referenciel/Default/index.html.twig');
    }

}
