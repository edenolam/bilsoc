<?php

namespace Bilan_Social\Bundle\CoreBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class MaintenanceListener
{
    private $isLocked;
    private $twig;

    public function __construct($isLocked, \Twig_Environment $twig)
    {
        $this->isLocked = $isLocked;
        $this->twig = $twig;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if ( ! $this->isLocked) {
            return;
        }

        $page = $this->twig->render('::maintenance.html.twig');

        $event->setResponse(
          new Response(
            $page,
            Response::HTTP_SERVICE_UNAVAILABLE
          )
        );
        $event->stopPropagation();
    }
}
