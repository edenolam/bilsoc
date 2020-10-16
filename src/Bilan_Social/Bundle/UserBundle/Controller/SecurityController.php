<?php

namespace Bilan_Social\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bilan_Social\Bundle\UserBundle\Form\PasswordResetType;
use Bilan_Social\Bundle\UserBundle\Form\ReinitAccountType;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\CollectiviteContact;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Bilan_Social\Bundle\BilanSocialBundle\Entity\HistoriqueBilanSocial;

class SecurityController extends AbstractBSController {

    /**
     * Login Action
     *
     * @param Request $request
     * @return Response
     */
    public function loginAction(Request $request) {


        $authenticationUtils = $this->get('security.authentication_utils');
        $service = $this->container->get('security.authentication.manager');
        $user = null;



        if ($authenticationUtils->getLastAuthenticationError()) {

            $username = $authenticationUtils->getLastUsername();
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('UserBundle:User')->findOneBy(array('username' => $username, 'isActive' => 1));


            if (!empty($user)) {
                if($user->hasRole('ROLE_COLLECTIVITY')){

                    $nbErreur = $user->getNmErreconn();

                    $NbEssai = 0;
                    $nbErreur += 1;
                    if ($nbErreur < 3) {
                        $NbEssai = 3 - $nbErreur;
                        if ($NbEssai !== 0) {
                            $this->addFlash('blocked', "Votre mot de passe est incorrect. Il vous reste " . $NbEssai . " essai avant que votre compte soit vérouillé.");
                        }
                    }

                    $FgBlocage = $user->getFgBlocage();

                    if ($nbErreur > $user->getNmErreconn() && $nbErreur >= 3) {

                        $user->setDtBlocage(new \DateTime());
                        $FgBlocage += 1;
                        $user->setFgBlocage($FgBlocage);


                        $TempsDeBlocage =  5;



                        if ($FgBlocage !== 0 && $FgBlocage !== Null) {


                            $DateBlocage = $user->getDtBlocage()->format('Y-m-d H:i:s');


                            $start_date = new \DateTime($DateBlocage);
                            $since_start = $start_date->diff(new \DateTime('NOW'));
                            $minutes = $since_start->days * 24 * 60;
                            $minutes += $since_start->h * 60;
                            $minutes += $since_start->i;
                            $TempsDattente = ( $TempsDeBlocage - $minutes );
                            $this->addFlash('blocked', 'Ce compte a été verrouillé pour des raisons de sécurité. Contactez votre centre de gestion.');
                            $Collectivite = $user->getCollectivite();

                            $contact = $Collectivite->getCdgDepartement()->getCdg()->getContacts();
                            foreach ($contact as $key => $value) {
                                $contactPrincipal = $value->getBlContactPrincipal();
                                if ($contactPrincipal == true) {
                                    $message = 'Nous vous invitons à contacter votre centre de gestion :';
                                    if ($value->getLbTele() != null) {
                                        $Tel = 'Par téléphone : ' . $value->getLbTele();
                                    }
                                    else {
                                        $Tel = 'Par téléphone : ' . $value->getLbPort();
                                    }
                                    $Mail = 'Ou par mail : ' . $value->getLbMail();

                                    $this->addFlash('blocked_info', $message);
                                    $this->addFlash('blocked_info', $Tel);
                                    $this->addFlash('blocked_info', $Mail);
                                }
                            }
                        }
                    }
                    $user->setNmErreconn($nbErreur);

                    $em->persist($user);
                    $em->flush($user);
                } else {
                    $this->addFlash('blocked', "Identifiant ou mot de passe invalide.");
                }
            } else {
                $this->addFlash('blocked', "Identifiant ou mot de passe invalide.");
            }
        }

        $csrfToken = $this->has('security.csrf.token_manager') ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue() : null;

        return $this->render('@User/Security/login.html.twig', array(
                    'last_username' => $authenticationUtils->getLastUsername(),
                    'error' => $authenticationUtils->getLastAuthenticationError(),
                    'csrf_token' => $csrfToken,
        ));
    }

    /**
     * Check Action
     *
     * @throws \RuntimeException
     */
    public function checkAction() {

        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    /**
     * Logout Action
     *
     * @throws \RuntimeException
     */
    public function logoutAction() {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

    public function resetPasswordAjaxAction(Request $request) {
        $identifiant = $request->get('identifiant');
        $cdg = 0;
        $messageCdg = '';
        $jsonCdgInfo = [];
        $cdgInfo = [];
        $name = '';
        $email = null;
        if ('' != $identifiant && null != $identifiant) {
            $em = $this->getDoctrine()->getManager();
            // todo : utilisateur actif
            // $user[0]->isEnabled();

            $user = $em->getRepository('UserBundle:User')->findOneByUsername($identifiant);
            if (!empty($user)) {
                $Collectivite = $user->getCollectivite();
                if(null != $Collectivite){
                    $name = $Collectivite->getLbColl().' - '.$user->getUsername();
                    $contact = $Collectivite->getCdgDepartement()->getCdg()->getContacts();
                    foreach ($contact as $key => $value) {

                        array_push($jsonCdgInfo, $cdgInfo[$key]['email'] = 'Email de contact centre de gestion = ' . $value->getLbMail());
                        array_push($jsonCdgInfo, $cdgInfo[$key]['nom'] = 'Nom du contact = ' . $value->getLbNom());
                        array_push($jsonCdgInfo, $cdgInfo[$key]['prenom'] = 'Prénom du contact = ' . $value->getLbPren());
                        array_push($jsonCdgInfo, $cdgInfo[$key]['port'] = 'Numéro de téléphone portable du contact = ' . $value->getLbPort());
                        array_push($jsonCdgInfo, $cdgInfo[$key]['fixe'] = 'Numéro de téléphone fixe du contact = ' . $value->getLbTele());
                    }
                    $results = $em->getRepository('CollectiviteBundle:MessagePassword')->findOneBy(array('cdg' => $Collectivite->getCdgDepartement()->getCdg()));
                    
                    if (null != $results) {
                        $messageCdg = $results->getCmMessPass();
                    }
                    else{
                        $admin = $em->getRepository('UserBundle:User')->findByRoles('ROLE_ADMIN');
                        $messageByAdmin = $em->getRepository('CollectiviteBundle:MessagePasswordByAdmin')->findOneByAdmin($admin);
                        $messageCdg = $messageByAdmin->getCmMessPass();
                    }
                }else{
                    $name = $user->getUsername();
                }

                $lbPassTemp = $user->getLbPassTemp();
                if ('' == $lbPassTemp && null == $lbPassTemp) {
                    if (null != $Collectivite) {
                        $contactPpal = $em->getRepository('CollectiviteBundle:Collectivite')->GetContactPrincipal($Collectivite->getIdColl());
                        if ($contactPpal != null) {
                            $email = $contactPpal->getLbMail();
                        }
                        if($email == null || $email == ''){
                            $email = $user->getEmail();
                        }
                    }
                    else {
                        if($user->getEmail() != null && $user->getEmail() != ''){
                            $email = $user->getEmail();
                        }
                    }

                    if ('' != $email && null != $email) {
                        $user->setConfirmCode(false);
                        $em->persist($user);
                        $em->flush();
                        
                        $contactService = $this->get('Bilan_Social.ContactBundle.Services.Contact');
                        
                        $envoiMail = $contactService->sendEmailInterneAppli('REINIT_MDP', $user->getEmail(), null, null, $user);
                        
                        if($envoiMail){
                            $jsonContent = 'email_sent';
                        }else{
                            $jsonContent = 'not_sent';
                        }
                    }
                    else {
                        $jsonContent = 'no_email';
                        $cdg = 1;
                    }
                } else {
                    $jsonContent = 'mdp_temp';
                    $cdg = 1;
                }
            } else {
                $jsonContent = 'no_user';
                $messageCdg = "<p>Un email avec le lien de r&eacute;initialisation vient d&#39;&ecirc;tre envoy&eacute;, veuillez consulter votre boite mail. Si vous n&#39;y avez pas acc&egrave;s, veuillez contacter votre Centre de gestion</p>";
            }
        } else {
            $jsonContent = 'no_id';
        }
        $response = new JsonResponse();
        $response->setData(array(
            'message' => $messageCdg,
            'data' => $jsonContent,
            'infocdg' => $jsonCdgInfo
        ));

        return $response;
    }

    public function changePasswordAction(Request $request, $code) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->findOneByConfirmCode($code);
        
        if (!empty($user) && $user->isEnabled()) {
            $form = $this->createForm(PasswordResetType::class, $user, array(
                'validation_groups' => array('Default', 'required-password'),
                'attr' => array('class' => 'form-reset')
            ));

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $encoder = $this->container->get('security.password_encoder');

                $data = $form->getData();
                $pass = $data->getPassword();

                $hashPasswordUser = $encoder->encodePassword($user, $pass);
                $user->setPassword($hashPasswordUser);
                $user->setConfirmCode(true);
                $user->setFgStat(0);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $this->addFlash('notice', "Votre mot de passe a été modifié vous pouvez maintenant vous connecter.");
                
                /* TODO */
                
                $url_login = $this->getParameter('cas_bs_login');
                
                return $this->redirect($url_login);
            }

            return $this->render('@User/Security/resetPassword.html.twig', array(
                        'form' => $form->createView(),
            ));
        }
        return $this->redirectToRoute('login');
    }
    public function firstChangePasswordAction() {
       return $this->render('@User/Security/username.html.twig');
    }
    
    public function reinitAccountAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $enquete = $this->getMonEnquete();
        $apa = $em->getRepository('ApaBundle:BilanSocialAgent')->findBy(array('enquete' => $enquete, 'collectivite' => $this->getMaCollectivite()));
        $user = $this->getUser();
        $form = $this->createForm(ReinitAccountType::class, $user, array(
            'validation_groups' => array('Default', 'required-password'),
            'attr' => array('class' => 'form-reset'),
            'allow_extra_fields' => true,
        ));
        
        $contactPpal = null;
        $collectivite = $user->getCollectivite();
        if (isset($collectivite)) {
            $contactPpal = $em->getRepository('CollectiviteBundle:CollectiviteContact')->findOneBy(array('collectivite' => $collectivite, 'blContactPrincipal' => 1));
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $encoder = $this->container->get('security.password_encoder');
            $data = $form->getData();
            $post = $_POST['reinit_account'];
            if(empty($contactPpal)){
                $contactPpal = new CollectiviteContact();
            }
            if(preg_match("/(0|\\+33|0033)[1-9][0-9]{8}/", $post['telephone']) !== 1 ){
                
                $this->addFlash('error', "Le numéro de téléphone n'est pas au bon format");
               
            }else{
                  $pass = $data->getPassword();
            $email = $data->getEmail();
            
            $hashPasswordUser = $encoder->encodePassword($user, $pass);
            $user->setPassword($hashPasswordUser);
            $user->setConfirmCode(true);
            $user->setEmail($email);
            $user->setFgStat(0);
            $user->setLbPassTemp(NULL);
            
            $contactPpal->setCollectivite($collectivite);
            $contactPpal->setLbNom($post['nom']);
            $contactPpal->setLbPren($post['prenom']);
            $contactPpal->setLbMail($email);
            $contactPpal->setLbFonc($post['fonction']);
            $contactPpal->setLbTele($post['telephone']);
            $contactPpal->setBlContactPrincipal(1);
            
            if($this->getMonBilanSocialConsolide(false) == null && $apa == null){
                $histBSNew = new HistoriqueBilanSocial();
                $histBSNew->setDepartement($collectivite->getDepartement());
                $histBSNew->setCollectivite($this->getMaCollectivite());
                $histBSNew->setEnquete($this->getMonEnquete($this->getMaCollectivite()));
                $histBSNew->setFgStat(7);
                $histBSNew->setDtChgt(new \DateTime());
                $histBSNew->setCdTypebilasoci(1);

                $this->getEntityManager()->persist($histBSNew);
            }
            
            
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($user);
            $em->persist($contactPpal);
            $em->flush();
            
            $this->addFlash('notice', $this->get('translator')->trans('success.reinitcoll.flash'));

            return $this->redirectToRoute('homepage');
            }
            
          
        }

        return $this->render('@User/Security/reinitAccount.html.twig', array(
                    'form' => $form->createView(),
                    'contactPrincipal' => $contactPpal
        ));
    }

}
