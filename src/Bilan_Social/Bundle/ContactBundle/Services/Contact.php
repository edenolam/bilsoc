<?php

namespace Bilan_Social\Bundle\ContactBundle\Services;

use Bilan_Social\Bundle\ContactBundle\Controller\DefaultController;
use Swift_Plugins_Loggers_ArrayLogger;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Service Contact
 *
 */
class Contact extends DefaultController
{

  protected $mailer;
  protected $em;
  protected $user;
  protected $container;
  protected $emailApplication;


    public function __construct($mailer, $em, $tokenStorage, $container)
    {
    $this->mailer = $mailer;
    $this->em = $em;
    if($tokenStorage->getToken() !== null){
        $this->user = $tokenStorage->getToken()->getUser();
    }
    $this->container = $container;
    $this->emailApplication = $this->container->getParameter('mailer_user');
    }


    /*
     * exemple d'utilisation de ce service
     *
     *  $Service_contact = $this->get('Bilan_Social.ContactBundle.Services.Contact');
     *
     *  $test = $Service_contact->sendEmail(null,'transmission-bilan-social');
     *
     * Todo: Ajouter l'utilisateur à qui ont veux envoyer le mail pour recuperer ses infos et pouvoir les ajouter dans le mail.
     *
     *      voir pour la gestion des contacts - en tant que cdg et en tant que collectivite -
     *
     *      Créer une fonction simple permmetant l'envoi d'email via un formulaire simple eg: objet body
     *
     */
     public function sendEmail($data = null)
    {


        if ($this->user->hasRole('ROLE_CDG')){
            $cdg = $this->getUser()->getCollectivite()->getCdgDepartement()->getCdg()->getCdgUtilisateurs();
            $contact = $this->em->getRepository('CollectiviteBundle:Cdg')->GetContactPrincipal($cdg->getIdCdg());

        }
        if ($this->user->hasRole('ROLE_COLLECTIVITY')){
            $cdg = $this->getUser()->getCollectivite()->getCdgDepartement()->getCdg()->getCdgUtilisateurs();
            $contact = $this->em->getRepository('CollectiviteBundle:Cdg')->GetContactPrincipal($cdg->getIdCdg());

        }

        if($data !== null ) {
            $BodyMail = $data->request->get('message');
            $objetMail = $data->request->get('subject');
        }
        if($contact !== null){

            $message = (new \Swift_Message())
            ->setSubject($objetMail)
            ->setFrom($this->emailApplication)
            ->setTo($contact->getLbMail())
            ->setBody($BodyMail, 'text/html');

            try {
                $this->mailer->send($message);
                $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash'));
                $debug = $this->container->getParameter('debug');
                if($debug){
                    $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash') . "a l'adresse suivante " . $contact->getLbMail());
                }else{
                    $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash'));
                }
            } catch (NoResultException $e) {

                $this->addFlash('notice', $this->get('translator')->trans('erreur.contact.flash'));
                 return false;
            }
        }else{
            $this->addFlash('notice', $this->get('translator')->trans('nocontact.contact.flash'));
        }



    }
     public function sendEmailInterneAppli($code = null, $contact = null, $demandeModification = null, $cdg = null, $userNotConnected = null, $options  = null) {
        $MailContact = array();
        if($userNotConnected !== null){
            $this->user = $userNotConnected;
        }
        if($contact == null){
            if ($this->user->hasRole('ROLE_COLLECTIVITY')){

                //error_log("send collectivte", 0);
                //$cdg = $this->getUser()->getCollectivite()->getCdgDepartement()->getCdg()->getCdgUtilisateurs();
                $cdg = $this->user->getCollectivite()->getCdgDepartement()->getCdg();
                $contact = $this->em->getRepository('CollectiviteBundle:Cdg')->GetContactPrincipal($cdg);



                if($contact == null){
                     //error_log("contact null " . "", 0);

                      $UserAdmin = $this->em->getRepository('UserBundle:User')->findByRoles('ROLE_ADMIN');
                    foreach ($UserAdmin as $key => $value) {
                        array_push($MailContact, $value->getEmail());
                    }
                }
                else {
                    //error_log("contact " . $contact->getLbMail(), 0);
                    array_push($MailContact, $contact->getLbMail());
                }
            }
            else if ($this->user->hasRole('ROLE_CDG')) {
                //error_log("send cdg", 0);
                $cdg = $this->em->getRepository('CollectiviteBundle:Cdg')->findOneCdgByUtilisateur($this->user);
                $contact = $this->em->getRepository('CollectiviteBundle:Cdg')->GetContactPrincipal($cdg);

                if ($contact == null) {
                    //error_log("contact null " . "", 0);
                    $UserAdmin = $this->em->getRepository('UserBundle:User')->findByRoles('ROLE_ADMIN');
                    foreach ($UserAdmin as $key => $value) {
                        array_push($MailContact, $value->getEmail());
                    }
                }
                else {
                    //error_log("contact " . $contact->getLbMail(), 0);
                    array_push($MailContact, $contact->getLbMail());
                }
            }
        }else{
            array_push($MailContact, $contact);
        }
        if($userNotConnected !== null){
            $cdg = $this->user->getCollectivite()->getCdgDepartement()->getCdg();
        }
        if ($code !== null) {
            $page = $this->em->getRepository('ModelMailBundle:ModelMailInterneAppliCdg')->findOneBy(array('codeApp' => $code, 'idCdg' => $cdg->getIdCdg()));
            if ($page == null) {
                $page = $this->em->getRepository('ModelMailBundle:ModelMailInterneAppli')->findOneByCodeApp($code);
            }



            $BodyMail = $this->ReplaceVariable($this->user, $page->getBody());
            $objetMail = $page->getObjet();
        }

        $mailLogger = new \Swift_Plugins_Loggers_ArrayLogger();
        $this->mailer->registerPlugin(new \Swift_Plugins_LoggerPlugin($mailLogger));
        $message = (new \Swift_Message())
            ->setSubject($objetMail)
            ->setFrom($this->emailApplication)
            ->setTo($MailContact)
            ->setBody($BodyMail, 'text/html');

        if ($this->mailer->send($message)) {

            

            $debug = $this->container->getParameter('debug');
            if ($debug) {
                if (count($MailContact) == 1) {
//                    $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash') . " a l'adresse suivante " . $MailContact[0]);
                }
                else {
                     $text = $this->get('translator')->trans('envoye.contact.flash') . " aux adresses suivantes " ;
                    foreach ($MailContact as $key => $value) {
                        $text .= $value . " - ";
//                        
                    }
//                    $this->addFlash('notice', $text);
                }
            }else{
                // $options['silence'] utilisé pour ne pas afficher le flash message, utilisé dans la modification de collectivité.
                if(!isset($options['silence'])){
//                    $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash'));
                }
            }
            return true;
        }

        $this->addFlash('notice', $this->get('translator')->trans('erreur.contact.flash'));
        return false;

    }

    private function ReplaceVariable($current_user, $bodyMail, $data = null){


        /* Renseigner ici les variables pour les ajouters au tableau ci dessous*/
        $name = $current_user->getUsername();
        $mail = $current_user->getEmail();
        $url_reinit = "";
        if(!empty($current_user->getConfirmCode())){
        $url_reinit = "<a href=".$this->generateUrl(
            'change_password',
            array('code'=> $current_user->getConfirmCode()),
            UrlGeneratorInterface::ABSOLUTE_URL
            ).">Modifier le mot de passe</a>";
        }
     
        $lbCollectivite = '';
        $lbCdg = '';
        if($current_user->hasRole('ROLE_COLLECTIVITY')){
            $lbCollectivite = $current_user->getCollectivite()->getLbColl();
        }
        if ($current_user->hasRole('ROLE_CDG')) {
            $cdg = $this->em->getRepository('CollectiviteBundle:Cdg')->findOneCdgByUtilisateur($current_user);
            $lbCdg = $cdg->getLbCdg();
        }

        /* $data est la recuperer des données envoyées via un formulaire  */

        if($data !== null){
            $sujet = $data['sujet'];
            $question = $data['question'];
            if(isset($data['reponse'])){
                $reponse = $data['reponse'];
            }else{
                $reponse = null;
            }
        }else{
            $sujet = null;
            $question = null;
            $reponse = null;
        }
        /* Le premier tableau prend les champs a remplacer */
        /* Le deuxieme tableau prend les valeurs de remplacement */
        /* La variable de fin est le corp du mail */
     $NouveauBody = str_replace(
                            array("__NAME__", "__MAIL__", "__SUJET__", "__QUESTION__", "__REPONSE__", "__NAMECOLLECTIVITE__", "__NAMECDG__", "__URLREINIT__"), array("$name", "$mail", "$sujet", "$question", "$reponse", "$lbCollectivite", "$lbCdg", "$url_reinit"), $bodyMail
        );

     return $NouveauBody;

    }
    public function sendEmailReponse($code = null, $contact = null, $data = null, $cdg = null) {
        if($cdg == null){
            $cdg = $this->em->getRepository('CollectiviteBundle:Cdg')->findOneCdgByUtilisateur($this->user);
        }
        if($code !== null){
            $page = $this->em->getRepository('ModelMailBundle:ModelMailInterneAppliCdg')->findOneBy(array('codeApp' => $code, 'idCdg' => $cdg->getIdCdg()));
            if ($page == null) {
                $page = $this->em->getRepository('ModelMailBundle:ModelMailInterneAppli')->findOneByCodeApp($code);
            }

            $BodyMail = $this->ReplaceVariable($this->user, $page->getBody(), $data);
            $objetMail = $page->getObjet();
        }
        if($contact !== null){
            if($contact->getLbMail() !== null ){
                $MailContact = $contact->getLbMail();
            }
        }

        $message = (new \Swift_Message())
            ->setSubject($objetMail)->setFrom($this->emailApplication)->setTo($MailContact)->setBody($BodyMail, 'text/html');
        if ($this->mailer->send($message)) {
            $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash'));
            $debug = $this->container->getParameter('debug');
            if($debug){
                  $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash') . "a l'adresse suivante " . $MailContact);
            }else{
                $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash'));
            }

            return true;
        }

        $this->addFlash('notice', $this->get('translator')->trans('erreur.contact.flash'));
        return false;

    }
    public function sendEmailQuestionCdg($code = null, $contact = null, $data = null)
    {
        if($code !== null){
            $page = $this->em->getRepository('ModelMailBundle:ModelMailInterneAppli')->findOneByCodeApp($code);
            $BodyMail = $this->ReplaceVariable($this->user, $page->getBody(), $data);
            $objetMail = $page->getObjet();
        }
        $MailContact = array();
        if(!in_array(null, $contact)){


            foreach($contact as $key => $value){
                array_push($MailContact, $value);
            }
        }else{
            $UserAdmin = $this->em->getRepository('UserBundle:User')->findByRoles('ROLE_ADMIN');
            foreach ($UserAdmin as $key => $value) {
                 array_push($MailContact, $value->getEmail());
            }
            $this->addFlash('notice', $this->get('translator')->trans('cdgnomail.contact.flash'));
        }
        $message = (new \Swift_Message())
                        ->setSubject($objetMail)->setFrom($this->emailApplication)->setTo($MailContact)->setBody($BodyMail, 'text/html');

        if ($this->mailer->send($message)) {
            $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash'));

            $debug = $this->container->getParameter('debug');
             if ($debug) {
//                 dump(count($MailContact));
                if (count($MailContact) == 1) {
                    $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash') . " a l'adresse suivante " . $MailContact[0]);
                }else {
                    $text = $this->get('translator')->trans('envoye.contact.flash') . " aux adresses suivantes " ;
                    foreach ($MailContact as $key => $value) {
                        $text .= $value . " - ";
//                        
                    }
                    $this->addFlash('notice', $text);
                }
            }else{
                $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash'));
            }
            return true;
        }

        $this->addFlash('notice', $this->get('translator')->trans('erreur.contact.flash'));
        return false;

    }

    public function valideOuRefusBilanSocial($collectivite, $code, $cdg = null) {
        
        if($cdg == null){
            $cdg = $this->em->getRepository('CollectiviteBundle:Cdg')->findOneCdgByUtilisateur($this->user);
        }
        
        $ContactParDefaut = $this->em->getRepository('CollectiviteBundle:CollectiviteContact')->findOneBy(array('collectivite' => $collectivite, 'blContactPrincipal' => 1 ));

        if($ContactParDefaut !== null){
            $Contact = $ContactParDefaut->getLbMail();
        }
        
        if ($code !== null) {
            $page = '';
            if ($cdg !== null) {
                $page = $this->em->getRepository('ModelMailBundle:ModelMailInterneAppliCdg')->findOneBy(array('codeApp' => $code, 'idCdg' => $cdg->getIdCdg()));
            }
            if ($page == null) {
                $page = $this->em->getRepository('ModelMailBundle:ModelMailInterneAppli')->findOneByCodeApp($code);
            }
            $BodyMail = $this->ReplaceVariable($this->user, $page->getBody());
            $objetMail = $page->getObjet();
        }


        $message = (new \Swift_Message())
            ->setSubject($objetMail)
            ->setFrom($this->emailApplication)
            ->setTo($Contact)
            ->setBody($BodyMail, 'text/html');
        ;

        if ($this->mailer->send($message)) {
            
            $debug = $this->container->getParameter('debug');
            if($debug){
                $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash') . "a l'adresse suivante " . $Contact);
            }else{
                $this->addFlash('notice', $this->get('translator')->trans('envoye.contact.flash'));
            }
            return true;

        }

        $this->addFlash('notice', $this->get('translator')->trans('erreur.contact.flash'));
        return false;


    }


}
