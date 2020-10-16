<?php

namespace Bilan_Social\Bundle\CoreBundle\Controller;

use Bilan_Social\Bundle\CoreBundle\Entity\Social;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Bilan_Social\Bundle\CoreBundle\Form\SocialType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Bilan_Social\Bundle\CoreBundle\Entity\IncoherenceLog;

/**
 * Social controller.
 *
 */
class SocialController extends Controller {

    public function indexAction(Request $request) {
        if(null != $request->get('from'))
            $from = $request->get('from');
        return $this->selectStep($request,$from);
    }

    /**
     * Show Incoherence in Form
     *
     */
    public function showIncoherenceInFormAction() {
        $incoherenceRepository = $this->getDoctrine()->getRepository('CoreBundle:IncoherenceLog');
        $incoherences = $incoherenceRepository->findByUser($this->getUser());

        return $this->render('@Core/Social/incoherence.html.twig', array(
                    'incoherences' => $incoherences,
        ));
    }

    /**
     * Find current User or impersonate user
     *
     * @return User
     */
    protected function getUserOrImpersonateUser() {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_CDG')) {
            $session = $this->get('session');
            $userId = $session->get('user_id');
            $userRepository = $this->getDoctrine()->getRepository('UserBundle:User');
            $user = $userRepository->find($userId);
            $session->set('user_siret', $user->getUsername());
        } else {
            $user = $this->getUser();
        }

        return $user;
    }

    /**
     * Select form
     *
     * @param Request $request
     * @return mixed
     */
    protected function selectStep(Request $request,$from = null) {

        $formFlow = $this->container->getParameter('form_flow');
        $step = $request->get('step');
        $step ? $step : $step = '1';

        if (!array_key_exists($step, $formFlow)) {
            return $this->redirectToRoute('homepage');
        }

        $user = $this->getUserOrImpersonateUser();
        $em = $this->getDoctrine()->getManager();

        $entityString = $formFlow[$step]['entity'];
        $formType = $formFlow[$step]['formType'];
        $view = $formFlow[$step]['view'];
        $entity = $em->getRepository($entityString)->findOneByUser($user);

        if (!$entity) {
            $entity = new $entityString();
            $entity->setUser($user);
        }

        $form = $this->createForm($formType, $entity, array(
            'action' => $this->generateUrl('social_index', array('step' => $step)),
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        $validator = $this->get('validator');
        $listErrors = $validator->validate($entity);

        if ($request->headers->get('isSendByFocus')) {
            $error = '';
            foreach ($listErrors as $listError) {
                $error .= $listError->getMessage();
            }
            return new Response($error);
        }

        // Reset error for current form
        $incoherenceLogRepository = $em->getRepository('CoreBundle:IncoherenceLog');
        $incoherenceLogRepository->removeOlderIncoherence($user, $formType);

        if (count($listErrors) > 0) {
            foreach ($listErrors as $listError) {
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setUser($user);
                $incoherenceLog->setMessage($listError->getMessage());
                $incoherenceLog->setForm($formType);
                $incoherenceLog->setField($listError->getPropertyPath());

                $em->persist($incoherenceLog);
            }
            $em->flush();
        }

        if ($form->isSubmitted()) {
            $em->persist($entity);
            $em->flush();

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse('Success');
            }

            return $this->redirectToRoute('social_index', array(
                        'step' => $step + 1,
            ));
        }
        
        if(null != $from && 'cdg-apa' == $from){
            return $this->redirectToRoute('bilansocialagent_index');
        }
        
        if(null != $from && 'cdg-cons' == $from){
            return $this->redirectToRoute('bilan_conso_edit');
        }

        return $this->render($view, array(
                    'form' => $form->createView(),
        ));
    }

}
