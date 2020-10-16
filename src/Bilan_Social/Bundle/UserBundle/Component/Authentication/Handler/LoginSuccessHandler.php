<?php

namespace Bilan_Social\Bundle\UserBundle\Component\Authentication\Handler;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\UserBundle\Entity\User;

/**
 * Description of LoginSuccessHandler
 *
 * @author mbusson
 */
class LoginSuccessHandler extends Controller implements AuthenticationSuccessHandlerInterface {

    protected $router;
    protected $em;
    protected $container;
    protected $session;

    public function __construct(Router $router, EntityManager $em, ContainerInterface $container, Session $session) {
        $this->router = $router;
        $this->em = $em;
        $this->container = $container;
        $this->session = $session;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        $em = $this->em;
        $container = $this->container;

        $username = $request->request->get('_username');

        $user = $em->getRepository('UserBundle:User')->findOneByUsername($username);



        if (!empty($user)) {
            if($user->hasRole('ROLE_COLLECTIVITY')){

                $FgBlocage = $user->getFgBlocage();

                $TempsDeBlocage = 5;



                if ($FgBlocage !== 0 && $FgBlocage !== Null) {


                    $DateBlocage = $user->getDtBlocage()->format('Y-m-d H:i:s');


                    $start_date = new \DateTime($DateBlocage);
                    $since_start = $start_date->diff(new \DateTime('NOW'));
                    $minutes = $since_start->days * 24 * 60;
                    $minutes += $since_start->h * 60;
                    $minutes += $since_start->i;
                    $TempsDattente = ($TempsDeBlocage - $minutes );

                    if ($minutes < $TempsDeBlocage) {
                        $Collectivite = $user->getCollectivite();

                        $contact = $Collectivite->getCdgDepartement()->getCdg()->getContacts();
                        $this->session->getFlashBag()->add('blocked', 'Ce compte a été verrouillé pour des raisons de sécurité. Contactez votre centre de gestion.');
                        foreach ($contact as $key => $value) {

                            $Mail = 'Email de contact centre de gestion = ' . $value->getLbMail();
                            $Nom = 'Nom du contact = ' . $value->getLbNom();
                            $Prénom = 'Prénom du contact = ' . $value->getLbPren();
                            $Port = 'Numéro de téléphone portable du contact = ' . $value->getLbPort();
                            $Fixe = 'Numéro de téléphone fixe du contact = ' . $value->getLbTele();

                            $this->session->getFlashBag()->add('blocked_info', $Nom);
                            $this->session->getFlashBag()->add('blocked_info', $Prénom);
                            $this->session->getFlashBag()->add('blocked_info', $Mail);
                            $this->session->getFlashBag()->add('blocked_info', $Port);
                            $this->session->getFlashBag()->add('blocked_info', $Fixe);
                        }


                        $response = new RedirectResponse($this->router->generate('login'));
                    } else {
                        $user->setFgBlocage(0);
                        $user->setNmErreConn(0);
                        $em->persist($user);
                        $em->flush();
                        $response = new RedirectResponse($this->router->generate('homepage'));
                    }
                } else if ($user->getFgStat() == 1) {
                    $message = "";
                    $dtLastconn = $user->getDtLastconn();
                    if (isset($dtLastconn) && !empty($dtLastconn)) {
                        $message = 'Veuillez reinitialiser votre mot de passe';
                    } else {
                        $message = 'Ceci est votre première connexion, veuillez reinitialiser votre mot de passe et renseigner votre adresse email';
                    }

                    $this->session->getFlashBag()->add('TempAccount', $message);

                    return $this->redirectToRoute('reinit_account', array('username' => $user));
                } else {
                    $user->setFgBlocage(0);
                    $user->setNmErreConn(0);
                    $em->persist($user);
                    $em->flush();
                    $response = new RedirectResponse($this->router->generate('homepage'));
                }
            }else{
                $response = new RedirectResponse($this->router->generate('homepage'));
            }
        }
        $response->setPrivate();
        $response->setMaxAge(0);
        $response->setSharedMaxAge(0);
        $response->headers->addCacheControlDirective('no-cache', true);
        $response->headers->addCacheControlDirective('max-age', 0);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        $response->headers->addCacheControlDirective('no-store', true);
        return $response;
    }

}
