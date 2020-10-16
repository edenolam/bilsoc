<?php

namespace Bilan_Social\Bundle\FaqBundle\Controller;

use Bilan_Social\Bundle\FaqBundle\Entity\Question;
use Bilan_Social\Bundle\FaqBundle\Form\QuestionNewCdgType;
use Bilan_Social\Bundle\FaqBundle\Form\QuestionNewType;
use Bilan_Social\Bundle\FaqBundle\Form\ReponseType;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;

/**
 * Question controller.
 *
 */
class QuestionController extends AbstractBSController
{
    /**
     * Lists all question entities.
     * Cette action est destiné uniquement au CDG.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $questions_lecture = $em->getRepository('FaqBundle:Question')->GetQuestionsLecture($this->getUser()->getIdUtil());
        $questions_ecriture = $em->getRepository('FaqBundle:Question')->GetQuestionsEcriture($this->getUser()->getIdUtil());
      
        $nbQuestions = $em->getRepository('FaqBundle:Question')->getNbQuestion($this->getUser()->getIdUtil());
        return $this->render('@Faq/questionCollectivite/index.html.twig', array(
            'questions_lecture' => $questions_lecture,
            'questions_ecriture' => $questions_ecriture,
            'nbQuesion' => $nbQuestions,
        ));
    }

    /**
     * Dans le cas d'une collectivité qui pose une question, celle ci est envoyé a son CDG.
     *
     * Un Email est envoyé pour prévenir d'une nouvelle question.
     *
     */
    public function newQuestionByCollectiviteAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $contactService = $this->get('Bilan_Social.ContactBundle.Services.Contact');
        
        $cdg = $this->getUser()->getCollectivite()->getCdgDepartement()->getCdg()->getCdgUtilisateurs();
        $cdgContactPrincipal = $em->getRepository('CollectiviteBundle:Cdg')->GetContactPrincipal($cdg);
        $getCdg = $em->getRepository('CollectiviteBundle:Cdg')->findCdgByCollectivite($user);
        if($cdgContactPrincipal !== null){
            $email = $cdgContactPrincipal->getLbMail();
        }else{
            $admin = $em->getRepository('UserBundle:User')->findByRoles('ROLE_ADMIN');
            $email = $admin[0]->getEmail();
        }
        $question = new Question();
        $form = $this->createForm(QuestionNewType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactService->sendEmailInterneAppli('NEWQUESTIONCOLLECTIVITE', $email, null, $getCdg);

            if ($user->hasRole('ROLE_COLLECTIVITY')){
                     $question->setIdColl($user->getCollectivite());
                     $question->setCreatedAt(new \DateTime());
            }
            $em->persist($question);
            $em->flush();
            
            $this->addFlash('notice', 'Votre question a été envoyée avec succès.');
            return $this->redirectToRoute('question_new_collectivite');
        }

        return $this->render('@Faq/questionCollectivite/new.html.twig', array(
            'question' => $question,
            'form' => $form->createView(),
        ));
    }

     /**
     * Creates a new question entity.
     * Dans le cas d'un cdg qui pose une question, celle ci est envoyé par mail a son contact.
     * Dans le cas ou il n'a pas de contact, ou bien que son contact n'a pas d'adresse email associé, alors le mail est envoyé a l'administrateur.
     *
     */
    public function newQuestionByCdgAction(Request $request)
    {
        $contactService = $this->get('Bilan_Social.ContactBundle.Services.Contact');
        $em = $this->getDoctrine()->getManager();
        $cdgUtilisateurs = $this->getUser()->getUtilisateurCdgs();
        $tabCdgs = array();
        foreach($cdgUtilisateurs as $uCdg){
            array_push($tabCdgs, $uCdg->getCdg()->getIdCdg());
        }
        $departementIds = $em->getRepository('CollectiviteBundle:CdgDepartement')->getOriginDepartementsByCdgUtilisateur($this->getUser()->getIdUtil());
        $CdgReferent  =   $em->getRepository('CollectiviteBundle:Cdg')->GetReferentFormulaireCdg($tabCdgs, $departementIds);

        $question = new Question();
        $form = $this->createForm(QuestionNewCdgType::class, $question, array(
            'CdgReferent' => $CdgReferent,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = array();
            $Referent = array();
            if(isset($form['listeCDG'])){
                $Referent = $form['listeCDG']->getData();
                foreach($Referent->getContacts() as $key => $value){
                    array_push($contact, $value->getlbMail());
                }
                if(empty($contact)){
                    $admin = $em->getRepository('UserBundle:User')->findByRoles('ROLE_ADMIN');
                    $email = $admin[0]->getEmail();
                    array_push($contact, $email);
                    if($email!=null){
                        $this->addFlash('notice', $this->get('translator')->trans('cdgnomail.contact.flash'));
                    }
                }
            }else{
                $admin = $em->getRepository('UserBundle:User')->findByRoles('ROLE_ADMIN');
                $email = $admin[0]->getEmail();
                array_push($contact, $email);
            }
            $AllData = array();
            if(!empty($form->getData())){
                $AllData['question'] = $question->getQuestion();
                $AllData['sujet'] = $question->getSujet();
            }
            try {
                $contactService->sendEmailQuestionCdg('NEWQUESTIONCDG', $contact, $AllData);
            }catch(\Exception $e){
                $this->addFlash('error', $this->get('translator')->trans('faq.send.error'));
                if($e instanceof \Swift_RfcComplianceException){
                    if(empty($contact) || $contact[0]==null){
                        if(count($Referent)==0){
                            $this->addFlash('error', $this->get('translator')->trans('adminnomail.contact.flash'));
                        }else{
                            $this->addFlash('error', $this->get('translator')->trans('nocontact.contact.flash'));
                        }
                    }else{
                        $this->addFlash('error', $this->get('translator')->trans('mailnorfc.contact.flash'));
                    }
                }
            }
        }

        return $this->render('@Faq/questionParMail/formulaire.html.twig', array(
            'question' => $question,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a question entity.
     *
     */
    public function showAction(Question $question)
    {
        if($this->checkIsUserOwnerOf($question)){
            $deleteForm = $this->createDeleteForm($question);

            return $this->render('@Faq/questionCollectivite/show.html.twig', array(
                'question' => $question,
                'delete_form' => $deleteForm->createView(),
            ));
        }else{
            return $this->redirectToRoute('question_index');
        }
    }

    /**
     * Displays a form to edit an existing question entity.
     *
     */
    public function editAction(Request $request, Question $question)
    {
        if($this->checkIsUserOwnerOf($question)){
            $deleteForm = $this->createDeleteForm($question);
            $editForm = $this->createForm('Bilan_Social\Bundle\FaqBundle\Form\QuestionType', $question);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('question_edit', array('id' => $question->getId()));
            }

            return $this->render('@Faq/question/edit.html.twig', array(
                'question' => $question,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }else{
            return $this->redirectToRoute('question_index');
        }
    }

    /**
     * Deletes a question entity.
     *
     */
    public function deleteAction(Request $request, Question $question)
    {            
        $em = $this->getDoctrine()->getManager();
        $em->remove($question);
        $em->flush(); 
        $flash = $this->get('translator')->trans('delete.question.flash');
        $return = new JsonResponse([
                    'message'   => $flash,
                    ]);   
        return $return;        
    }

    /**
     * Creates a form to delete a question entity.
     *
     * @param Question $question The question entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Question $question)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('question_delete', array('id' => $question->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function ContactAction(Request $request){
        $question = new Question();
        $form = $this->createForm('Bilan_Social\Bundle\FaqBundle\Form\QuestionType', $question);
        $form->handleRequest($request);
        //$contactService->sendEmail($request);

        return $this->render('@Contact/contact/contact.html.twig', array(
            'question' => $question,
            'form' => $form->createView(),
        ));
        //return $this->redirectToRoute('faq_index_client');
    }

    public function ReponduAction(Request $request, Question $question)
    {
        $em = $this->getDoctrine()->getManager();
        $question->setBlCloturer(NULL);
        $em->flush();
        
        return $this->redirectToRoute('question_repondre_cdg', array('id' => $question->getId()));
    }
    
    /**
     * Displays a form to edit an existing question entity.
     *  Cette action est destiné au CDG qui réponde via leur interface de gestion des qestions.
     */
    public function RepondreAction(Request $request, Question $question)
    {
        $em = $this->getDoctrine()->getManager();
        $question->setQuestionRead(true);
        $em->flush();
        $contactService = $this->get('Bilan_Social.ContactBundle.Services.Contact');

        $editForm = $this->createForm(ReponseType::class, $question);
        $editForm->handleRequest($request);

        $cdg = $em->getRepository('CollectiviteBundle:Cdg')->findOneCdgByUtilisateur($this->getUser());
        $droit = $em->getRepository('CollectiviteBundle:Collectivite')->getDroitsSurCollectivite($question->getIdColl(), $cdg->getIdCdg());
        $access_write = false;

        if($droit['fgDroits'] == 127){
            $access_write = true;
        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ($editForm->getClickedButton()->getName() == 'send_without_response') {
                $resultat = 'done';
                $question->setBlCloturer(true);
                $question->setReponse("Réponse fournie");
                $question->setUpdatedAt(new \DateTime());
                $em->persist($question);
                $em->flush();
            }
            elseif ($editForm->getClickedButton()->getName() == 'send') {
                $contact = $em->getRepository('CollectiviteBundle:Collectivite')->GetContactPrincipal($question->getIdColl());

                $AllData = [];
                if (!empty($editForm['reponse']->getData())) {
                    $AllData['reponse'] = $editForm['reponse']->getData();
                    $AllData['question'] = $question->getQuestion();
                    $AllData['sujet'] = $question->getSujet();
                    $AllData['dateReponse'] = $question->getUpdatedAt();
                } else {
                    $this->addFlash('error', 'Vous devez écrire une réponse afin d\'envoyer l\'email');
                    return $this->redirectToRoute('question_repondre_cdg', array('id' => $question->getId()));
                }
                
                $envoiMail = $contactService->sendEmailReponse('NEWREPONSE', $contact, $AllData);
                
                if ($envoiMail == true) {
                    $resultat = 'done';
                    $question->setBlCloturer(true);
                    $question->setUpdatedAt(new \DateTime());
                    $em->persist($question);
                    $em->flush();
                }
            } else {
                $resultat = "erreur";
            }

            return $this->redirectToRoute('question_index');
        }


        return $this->render('@Faq/questionCollectivite/repondre.html.twig', array(
            'question' => $question,
            'edit_form' => $editForm->createView(),
            'access_write' => $access_write
        ));
    }

}
