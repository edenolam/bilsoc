<?php

namespace Bilan_Social\Bundle\ApaBundle\Controller;

use Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent;
use Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent;
use Bilan_Social\Bundle\ApaBundle\Form\BilanSocialAgentType;
use Bilan_Social\Bundle\ApaBundle\Form\ImportCourtierType;
use Bilan_Social\Bundle\ApaBundle\Form\QuestionsGeneralesType;
use Bilan_Social\Bundle\ApaBundle\RequestClass\TotoRequest;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCourtier;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefElementMateriel;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMaladieProfessionnelle;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifAbsence;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureLesion;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSiegeLesion;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeActivite;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Bilansocialagent controller.
 *
 */
class BilanSocialAgentController extends AbstractBSController
{

    /**
     * Check if an quesstionnaire informations generales  is already set, if not redirecting to the questionnaire page to create this.
     * if Questionnaire is already set, display list page.
     *
     */
    protected $currentForm;

    public function indexAction(Request $request)
    {
        $questionnaire_enregistre = 0;

        $user = $this->getUser();

        $session = $this->get('session');
        if (null == $session->get('coll_id')) {
            $idCollectivity = $user->getCollectivite()->getIdColl();
        } else {
            $idCollectivity = $session->get('coll_id');
        }

        $referer = $request->headers->get('referer');

        if ($this->generateUrl('informationgenerale_new', array(), UrlGeneratorInterface::ABSOLUTE_URL) === $referer) {
            $questionnaire_enregistre = 1;
        } else if ($this->generateUrl('informationcolectiviteagent_new', array(), UrlGeneratorInterface::ABSOLUTE_URL) === $referer) {
            $questionnaire_enregistre = 2;
        }


        $em = $this->getDoctrine()->getManager();
        $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();

        $enquete = $this->getMonEnquete();
        $idEnquete = $enquete->getIdEnqu();
        $initBilanSocial = $em->getRepository('BilanSocialBundle:InitBilanSocial')
                                ->findOneBy(array('collectivite' => $idCollectivity, 'enquete' => $idEnquete));
        if($initBilanSocial->getBlcons() == true ) {
            $this->addFlash(
                    'notice', "Consolidé déjà présent"
            );
            $redirectionConso = $this->redirectToRoute('bilan_social_homepage');
            return $redirectionConso;
        }

        $InformationGenerale = $em->getRepository('ApaBundle:InformationGenerale')->GetInformationGenerale($idCollectivity, $idEnquete, $campagne->getIdCamp());
        $pcOnglets = null;
        $array_pc_bool = null;
        $checked = false;
        $InformationCollectivite = $em->getRepository('ApaBundle:InformationColectiviteAgent')->GetInformationCollectivite($idCollectivity, $idEnquete, $campagne->getIdCamp());
        if($InformationCollectivite !== null){
            $pcOnglets = $InformationCollectivite->getPcOnglets();
            $array_pc_bool = $this->getOngletsTabBool($pcOnglets);
            $array_checked_count = $this->checkIfAllOngletsIsSave($array_pc_bool);
            $checked = $array_checked_count['checked'];
        }

        if (!empty($InformationGenerale)) {
            if ($this->generateUrl('informationgenerale_new', array(), UrlGeneratorInterface::ABSOLUTE_URL) === $referer || $this->generateUrl('informationcolectiviteagent_new', array(), UrlGeneratorInterface::ABSOLUTE_URL) === $referer) {
                $questionnaire_enregistre = 3;
                return $this->render('@Apa/Default/index.html.twig', array('questionnaire' => $questionnaire_enregistre, 'listeAgent' => $checked));
            } else {
                return $this->listAction($request);
            }
        }
        else {
            return $this->render('@Apa/Default/index.html.twig', array('questionnaire' => $questionnaire_enregistre, 'listeAgent' => $checked));
        }
    }

    /**
     * Creates a new bilanSocialAgent entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();

        $session = $this->get('session');
        if (null == $session->get('coll_id')) {
            $idCollectivity = $user->getCollectivite()->getIdColl();
        } else {
            $idCollectivity = $session->get('coll_id');
        }

        $em = $this->getDoctrine()->getManager();
        $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($idCollectivity);
        $enquete = $this->getMonEnquete();
        $enqueteCollectivite = $this->getMonEnqueteCollectiviteActive();
        $idEnquete = $enquete->getIdEnqu();
        $informationColectiviteAgent = $em->getRepository('ApaBundle:InformationColectiviteAgent')->GetInformationCollectivite($idCollectivity, $idEnquete, $campagne->getIdCamp());
        $informationGenerales = $em->getRepository('ApaBundle:InformationGenerale')->GetInformationGenerale($idCollectivity, $idEnquete, $campagne->getIdCamp());
        $domainePro = $em->getRepository('ReferencielBundle:RefDomaineProfessionnel')->findBy(array('blVali' => false));
        $familleMetier = $em->getRepository('ReferencielBundle:RefFamilleMetier')->findBy(array('blVali' => false));
        $domaineSpecialite = $em->getRepository('ReferencielBundle:RefDomaineSpecialite')->findBy(array('blVali' => false));

        $bilanSocialAgent = new BilanSocialAgent();

        $form = $this->createForm(BilanSocialAgentType::class,
            $bilanSocialAgent, array('enquete' => $enqueteCollectivite, 'action' => 'new', 'role' => $user->getRoles(), 'anneeCamp' => $campagne->getNmAnne(), 'collectivite' => $collectivite));

        $form->handleRequest($request);
        $nextIndex = 0;

        $currentMetier = "";
        if ($enqueteCollectivite->getBlGepe() == true) {
            if ($bilanSocialAgent->getGpeec()) {
                if ($bilanSocialAgent->getGpeec()->getRefMetier()) {
                    $currentMetier = $bilanSocialAgent->getGpeec()->getRefMetier()->getIdMetier();
                }
            }
        }

        $currentSpecialite = "";
        if ($enqueteCollectivite->getBlGpeecPlus() == true) {
            if ($bilanSocialAgent->getGpeecPlus()) {
                if ($bilanSocialAgent->getGpeecPlus()->getRefSpecialite()) {
                    $currentSpecialite = $bilanSocialAgent->getGpeecPlus()->getRefSpecialite()->getIdSpecialite();
                }
            }
        }

        if ($form->isSubmitted()) {


            if ($form->isValid()) {



                //$jsonConfig = $bilanSocialAgent->getJsonContent();
                //
                //$array_progressbar_values = $this->getProgressBarValue($jsonConfig,$bilanSocialAgent);



                if ($form['blPosiactinonremu']->getData() !== null) {
                    $valuePosiactiNonremu = $form['blPosiactinonremu']->getData();
                    $bilanSocialAgent->setBlPosiacti($valuePosiactiNonremu);

                }
                /* Si statut = contractuel sur emploi non permanent alors on lui set le cadre emploi et la filiere */
                $ref_status = $form['refStatut']->getData();
                $code_status = $ref_status!==null ? $ref_status->getIdStat() : null;
                if($code_status === 4){
                    $cadre_emploi_hors_filiere = $em->getRepository('ReferencielBundle:RefCadreEmploi')->findOneBy(array('blVali' => false, 'cdDGCL' => ' H'));
                    $filiere_hors_filiere = $em->getRepository('ReferencielBundle:RefFiliere')->findOneBy(array('blVali' => false, 'cdFili' => 'H'));
                    $bilanSocialAgent->setRefCadreEmploi($cadre_emploi_hors_filiere);
                    $bilanSocialAgent->setRefFiliere($filiere_hors_filiere);
                }
                foreach ($bilanSocialAgent->getEtprAgent() as $key => $etpr) {
                    $etpr->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getFormationAgents() as $key => $etpr) {

                    $etpr->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getHeuCompReaRemAgent() as $key => $etpr) {

                    $etpr->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getHeuSuppReaRemAgent() as $key => $etpr) {

                    $etpr->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getRemunerationGlobaleAgent() as $key => $remuneration) {

                    $remuneration->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getRemunerationAgent() as $key => $remuneration) {

                    $remuneration->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getAbsenceArretAgents() as $key => $absence) {

                    $absence->setBilanSocialAgent($bilanSocialAgent);
                }

                if ($enqueteCollectivite->getBlHand() == true) {
                    $handitorial = $bilanSocialAgent->getHanditorials();
                    $handitorial->setBilanSocialAgent($bilanSocialAgent);
                }

                if ($enqueteCollectivite->getBlGepe() == true) {
                    $gpeec = $bilanSocialAgent->getGpeec();
                    $gpeec->setBilanSocialAgent($bilanSocialAgent);
                    if ($bilanSocialAgent->getGpeec()->getRefMetier()) {
                        $currentMetier = $bilanSocialAgent->getGpeec()->getRefMetier()->getIdMetier();
                    }
                }

                if ($enqueteCollectivite->getBlGpeecPlus() == true) {
                    $gpeecPlus = $bilanSocialAgent->getGpeecPlus();
                    $gpeecPlus->setBilanSocialAgent($bilanSocialAgent);
                    if ($bilanSocialAgent->getGpeecPlus()->getRefSpecialite()) {
                        $currentSpecialite = $bilanSocialAgent->getGpeecPlus()->getRefSpecialite()->getIdSpecialite();
                    }
                }


                if ($form->get('enregistrer_new')->isClicked()) {
                    $bilanSocialAgent->setFgStat('1');
                }
                //elseif ($form->get('valider')->isClicked()) {
                //$bilanSocialAgent->setFgStat('1');
                //}

                $em = $this->getDoctrine()->getManager();

                $bilanSocialAgent->setCollectivite($collectivite);
                $bilanSocialAgent->setEnquete($enquete);

                $em->persist($bilanSocialAgent);


                $em->flush();

                $this->addFlash(

                    'notice', $this->get('translator')->trans('new.agent.flash')
                );

                if ($form->get('enregistrer_new')->isClicked()) {

                    $currentIndex = $request->get('currentstep');


                    $nextIndex = $currentIndex;

                    if ($enqueteCollectivite->getBlGepe() == true) {
                        if ($currentIndex == 5) {
                            $nextIndex = 0;
                        }
                    } else {
                        if ($currentIndex == 4) {
                            $nextIndex = 0;
                        }
                    }
                    $nb_agent_status = $em->getRepository('ApaBundle:BilanSocialAgent')->countNbAgentStatus($enquete->getidEnqu(), $idCollectivity, $this->getCodeAggregateStatus($code_status));
                    $this->setToSession('current_agent_index',$nb_agent_status-1);
                    return $this->redirectToRoute('bilansocialagent_edit', array(
                        'idBilasociagen' => $bilanSocialAgent->getIdBilasociagen(),
                        'request' => $request
                    ), 307);


                }
            //elseif ($form->get('valider')->isClicked()) {
            //return $this->redirectToRoute('bilansocialagent_list_agent');
            //}
            }



        }

        return $this->render('@Apa/bilansocialagent/new.html.twig', array(
            'informationColectiviteAgent' => $informationColectiviteAgent,
            'informationGenerales' => $informationGenerales,
            'bilanSocialAgent' => $bilanSocialAgent,
            'form' => $form->createView(),
            'stepIndex' => $nextIndex,
            'enquetecoll' => $enqueteCollectivite,
            'domainePro' => $domainePro,
            'familleMetier'               => $familleMetier,
            'currentMetier'               => $currentMetier,
            'currentSpecialite'           => $currentSpecialite,
            'domaineSpecialite'           => $domaineSpecialite,
            'anne_campagne'               => $campagne->getNmAnne(),
            'listeAgent' => true,
            'collectivite' => $collectivite
        ));
    }

    /**
     * Finds and displays a bilanSocialAgent entity.
     *
     */
    public function showAction(BilanSocialAgent $bilanSocialAgent)
    {
        if($this->checkIsUserOwnerOf($bilanSocialAgent)){
            $deleteForm = $this->createDeleteForm($bilanSocialAgent);

            return $this->render('@Apa/bilansocialagent/show.html.twig', array(
                'bilanSocialAgent' => $bilanSocialAgent,
                'delete_form' => $deleteForm->createView(),
            ));
        }else{
            return $this->redirectToRoute('bilansocialagent_index');
        }
    }
    /*
    *   fonctions autour de la navigation entre les agents sur la page d'édition
    */
    public function getCurrentStatusDisplay($request=null,$bsa=null){
        $code_status = $request!=null ? $request->get('code_status') : null;
        if($code_status==null){
            if($bsa!=null){
                $bsa_statut = $bsa->getRefStatut();
                $code_status = $bsa_statut != null ? $bsa_statut->getCdStat() : null;
            }
            $code_status = $code_status===null ? $this->getFromSession('current_agent_status') : $code_status;
        }
        $code_status = $this->setCurrentStatusDisplay($code_status);
        return $code_status;
    }
    public function setCurrentStatusDisplay($code_status){
        $code_status = $this->getCodeAggregateStatus($code_status);
        $this->setToSession('current_agent_status',$code_status);
        return $code_status;
    }
    public function getCodeAggregateStatus($code_status){
        switch ($code_status) {
            case 'TITU':
            case 'STAG':
            case 'FONCTIONNAIRE':
                $code_status = 'FONCTIONNAIRE';
                break;
            default:
                $code_status = $code_status;
                break;
        }
        return $code_status;
    }
    public function getCurrentIndexAgentDisplay($request,$default=0){
        $default = is_integer($default) && $default>=0 ? $default : 0;
        $row_index = $request->get('row_index');
        if($row_index==null){
            $row_index = $this->getFromSession('current_agent_index');
            $row_index = $row_index===null ? $default : $row_index;
        }
        $row_index = $row_index < 0 ? 0 : $row_index;
        $this->setCurrentIndexAgentDisplay($row_index);
        return $row_index;
    }
    public function setCurrentIndexAgentDisplay($index){
        $this->setToSession('current_agent_index',$index);
    }
    /**
     * Displays a form to edit an existing bilanSocialAgent entity.
     *
     */
    public function editAction(Request $request, BilanSocialAgent $bilanSocialAgent, $nextIndex = 0)
    {
        if($this->checkIsUserOwnerOf($bilanSocialAgent)){
            $user = $this->getUser();
            $row_index = $this->getCurrentIndexAgentDisplay($request);
            $code_status = $this->getCurrentStatusDisplay($request, $bilanSocialAgent);
            $session = $this->get('session');
            if (null == $session->get('coll_id')) {
                $idCollectivity = $user->getCollectivite()->getIdColl();
            } else {
                $idCollectivity = $session->get('coll_id');
            }

            $em = $this->getDoctrine()->getManager();

            $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($idCollectivity);
            $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
            $enquete = $this->getMonEnquete();
            $enqueteCollectivite = $this->getMonEnqueteCollectiviteActive();
            $metiers = $em->getRepository('ReferencielBundle:RefMetier')->getAllWithOrder();
            $specialites = $em->getRepository('ReferencielBundle:RefSpecialite')->getAllWithOrder();
            $domainePro = $em->getRepository('ReferencielBundle:RefDomaineProfessionnel')->findBy(array('blVali' => false));
            $familleMetier = $em->getRepository('ReferencielBundle:RefFamilleMetier')->findBy(array('blVali' => false));
            $domaineSpecialite = $em->getRepository('ReferencielBundle:RefDomaineSpecialite')->findBy(array('blVali' => false));
            $informationGenerales = $em->getRepository('ApaBundle:InformationGenerale')->findOneBy(array('collectivite' => $idCollectivity, 'enquete' => $enquete->getIdEnqu()));
            $informationColectiviteAgent = $em->getRepository('ApaBundle:InformationColectiviteAgent')->findOneBy(array('collectivite' => $idCollectivity, 'enquete' => $enquete->getIdEnqu()));
            $alertQ30 = $em->getRepository('ApaBundle:BilanQ30Alerte')->findBy(array('BilanSocialAgent' => $bilanSocialAgent));

            $originalAbsenceArretAgents = new ArrayCollection();
            //$originalRassctAbsence = new ArrayCollection();
            $originalTagsEtpr = new ArrayCollection();
            $originalHeuCompReaRemAgent = new ArrayCollection();
            $originalHeuSuppReaRemAgent = new ArrayCollection();
            $originalFormSuivi = new ArrayCollection();
            $originalRemunerationGlobaleAgent = new ArrayCollection();
            $originalRemunerationAgent = new ArrayCollection();



            foreach ($bilanSocialAgent->getAbsenceArretAgents() as $tag) {
                $originalAbsenceArretAgents->add($tag);
            }
            foreach ($bilanSocialAgent->getFormationAgents() as $tag) {
                $originalFormSuivi->add($tag);
            }
            foreach ($bilanSocialAgent->getEtprAgent() as $tag) {
                $originalTagsEtpr->add($tag);
            }
            foreach ($bilanSocialAgent->getHeuCompReaRemAgent() as $tag) {
                $originalHeuCompReaRemAgent->add($tag);
            }
            foreach ($bilanSocialAgent->getHeuSuppReaRemAgent() as $tag) {
                $originalHeuSuppReaRemAgent->add($tag);
            }
            foreach ($bilanSocialAgent->getRemunerationGlobaleAgent() as $tag) {
                $originalRemunerationGlobaleAgent->add($tag);
            }
            foreach ($bilanSocialAgent->getRemunerationAgent() as $tag) {
                            $originalRemunerationAgent->add($tag);
            }

            $Liste_metiers = array();
            foreach ($metiers as $tag) {
                array_push($Liste_metiers, $tag);
            }

            $Liste_specialites = array();
            foreach ($specialites as $tag) {
                array_push($Liste_specialites, $tag);
            }
            $currentLbMetier = null;
            $deleteForm = $this->createDeleteForm($bilanSocialAgent);
            $editForm = $this->createForm(BilanSocialAgentType::class, $bilanSocialAgent, array('enquete' => $enqueteCollectivite, 'action' => 'edit', 'role' => $user->getRoles(), 'anneeCamp' => $campagne->getNmAnne(), 'collectivite' => $collectivite));
            $editForm->handleRequest($request);

            $nextIndex = 0;

            $currentMetier = "";
            if ($enqueteCollectivite->getBlGepe() == true) {
                if ($bilanSocialAgent->getGpeec()) {
                    if ($bilanSocialAgent->getGpeec()->getRefMetier()) {
                        $currentMetier = $bilanSocialAgent->getGpeec()->getRefMetier()->getIdMetier();
                        $currentLbMetier = $bilanSocialAgent->getGpeec()->getRefMetier()->getLbMetier();
                    }
                }
            }

            $currentSpecialite = "";
            if ($enqueteCollectivite->getBlGpeecPlus() == true) {
                if ($bilanSocialAgent->getGpeecPlus()) {
                    if ($bilanSocialAgent->getGpeecPlus()->getRefSpecialite()) {
                        $currentSpecialite = $bilanSocialAgent->getGpeecPlus()->getRefSpecialite()->getIdSpecialite();
                    }
                }
            }

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                if ($editForm['blPosiactinonremu']->getData() !== null) {
                    $valuePosiactiNonremu = $editForm['blPosiactinonremu']->getData();
                    $bilanSocialAgent->setBlPosiacti($valuePosiactiNonremu);
                }
                $ref_status = $editForm['refStatut']->getData();
                if($ref_status != null && $ref_status->getIdStat() === 4){
                    $cadre_emploi_hors_filiere = $em->getRepository('ReferencielBundle:RefCadreEmploi')->findOneBy(array('blVali' => false, 'cdDGCL' => ' H'));
                    $filiere_hors_filiere = $em->getRepository('ReferencielBundle:RefFiliere')->findOneBy(array('blVali' => false, 'cdFili' => ' H'));

                    $bilanSocialAgent->setRefCadreEmploi($cadre_emploi_hors_filiere);
                    $bilanSocialAgent->setRefFiliere($filiere_hors_filiere);
                }
                if ($editForm->get('enregistrer')->isClicked()) {
                    $bilanSocialAgent->setFgStat('1');
                }
                //elseif ($editForm->get('valider')->isClicked()) {
                //$bilanSocialAgent->setFgStat('1');
                //}

                foreach ($originalAbsenceArretAgents as $absence) {

                    if (false === $bilanSocialAgent->getAbsenceArretAgents()->contains($absence)) {

                        $em->remove($absence);
                    }
                }
                foreach ($originalRemunerationGlobaleAgent as $remunerationGlobale) {

                    if (false === $bilanSocialAgent->getRemunerationGlobaleAgent()->contains($remunerationGlobale)) {

                        $em->remove($remunerationGlobale);
                    }
                }

                foreach ($originalRemunerationAgent as $remunerationAgent) {

                    if (false === $bilanSocialAgent->getRemunerationAgent()->contains($remunerationAgent)) {

                        $em->remove($remunerationAgent);
                    }
                }
                //foreach ($originalRassctAbsence as $absence){
                //if (false === $bilanSocialAgent->getAbsenceRasscts()->contains($absence)) {
                //$em->remove($absence);
                //}
                //}
                foreach ($originalTagsEtpr as $etpr) {

                    if (false === $bilanSocialAgent->getEtprAgent()->contains($etpr)) {

                        $em->remove($etpr);
                    }
                }
                foreach ($originalFormSuivi as $FormSuivi) {

                    if (false === $bilanSocialAgent->getFormationAgents()->contains($FormSuivi)) {

                        $em->remove($FormSuivi);
                    }
                }
                foreach ($originalHeuCompReaRemAgent as $HeuCompReaRemAgent) {

                    if (false === $bilanSocialAgent->getHeuCompReaRemAgent()->contains($HeuCompReaRemAgent)) {

                        $em->remove($HeuCompReaRemAgent);
                    }
                }
                foreach ($originalHeuSuppReaRemAgent as $HeuSuppReaRemAgent) {

                    if (false === $bilanSocialAgent->getHeuSuppReaRemAgent()->contains($HeuSuppReaRemAgent)) {

                        $em->remove($HeuSuppReaRemAgent);
                    }
                }
                foreach ($bilanSocialAgent->getEtprAgent() as $key => $etpr) {
                    $etpr->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getRemunerationGlobaleAgent() as $key => $remuneration) {
                    $remuneration->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getRemunerationAgent() as $key => $remuneration) {
                    $remuneration->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getFormationAgents() as $key => $FormSuivi) {
                    $FormSuivi->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getHeuCompReaRemAgent() as $key => $HeuCompReaRemAgent) {
                    $HeuCompReaRemAgent->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getHeuSuppReaRemAgent() as $key => $HeuSuppReaRemAgent) {
                    $HeuSuppReaRemAgent->setBilanSocialAgent($bilanSocialAgent);
                }
                foreach ($bilanSocialAgent->getAbsenceArretAgents() as $key => $absence) {
                    $absence->setBilanSocialAgent($bilanSocialAgent);
                }

                if ($enqueteCollectivite->getBlHand() == true) {
                    $handitorial = $bilanSocialAgent->getHanditorials();
                    $handitorial->setBilanSocialAgent($bilanSocialAgent);
                }

                $currentMetier = "";
                if ($enqueteCollectivite->getBlGepe() == true) {
                    $gpeec = $bilanSocialAgent->getGpeec();
                    $gpeec->setBilanSocialAgent($bilanSocialAgent);
                    if ($bilanSocialAgent->getGpeec()->getRefMetier()) {
                        $currentMetier = $bilanSocialAgent->getGpeec()->getRefMetier()->getIdMetier();
                        $currentLbMetier = $bilanSocialAgent->getGpeec()->getRefMetier()->getLbMetier();
                    }
                }

                $currentSpecialite = "";
                if ($enqueteCollectivite->getBlGpeecPlus() == true) {
                    $gpeecPlus = $bilanSocialAgent->getGpeecPlus();
                    $gpeecPlus->setBilanSocialAgent($bilanSocialAgent);
                    if ($bilanSocialAgent->getGpeecPlus()->getRefSpecialite()) {
                        $currentSpecialite = $bilanSocialAgent->getGpeecPlus()->getRefSpecialite()->getIdSpecialite();
                    }
                }

                /*if($collectivite->getBlCollDgcl()){*/
                    $dgcl = $bilanSocialAgent->getDgcl();
                    $dgcl->setBilanSocialAgent($bilanSocialAgent);
                /*}*/
                $em->persist($bilanSocialAgent);
                $em->flush();

                if ($editForm->get('enregistrer')->isClicked()) {
                    $this->addFlash(
                        'notice', $this->get('translator')->trans('edit.agent.flash')
                    );

                }
            //elseif ($editForm->get('valider')->isClicked()) {
            //$this->addFlash(
            //'notice', $this->get('translator')->trans('validate.agent.flash')
            //);
            //return $this->redirectToRoute('bilansocialagent_list_agent');
            //}
            }

            $currentIndex = $request->get('currentstep');
            $currentIndex = is_null($currentIndex) ? -1 : $currentIndex;
            $nextIndex = $currentIndex + 1;
            if ($enqueteCollectivite->getBlGepe() == true) {
                if ($currentIndex == 5) {
                    $nextIndex = 0;
                }
            } else {
                if ($currentIndex == 4) {
                    $nextIndex = 0;
                }
            }

            if ($session->has('current_step')) {
                $currentIndex = $this->getFromSession('current_step');
                $this->removeFromSession('current_step');
            }

            if ($enqueteCollectivite->getBlBilasoci() == false && $enqueteCollectivite->getBlDgcl() == true && $enqueteCollectivite->getBlRast() == false && $enqueteCollectivite->getBlGepe() == false && $enqueteCollectivite->getBlHand() == false) {
                if ($currentIndex == 0) {
                    $nextIndex = 2;
                }
            }
            if ($enqueteCollectivite->getBlRast() == true && $enqueteCollectivite->getBlGepe() == false && $enqueteCollectivite->getBlHand() == false && $enqueteCollectivite->getBlBilasoci() == false) {
                if ($currentIndex == 2) {
                    $nextIndex = 4;
                }
            }
            $nb_agent_status = $em->getRepository('ApaBundle:BilanSocialAgent')->countNbAgentStatus($enquete->getidEnqu(), $idCollectivity, $code_status);

            return $this->render('@Apa/bilansocialagent/edit.html.twig', array(
                'informationColectiviteAgent' => $informationColectiviteAgent,
                'informationGenerales' => $informationGenerales,
                'bilanSocialAgent' => $bilanSocialAgent,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
                'currentIndex' => $currentIndex,
                'stepIndex' => $nextIndex,
                'alertQ30' => $alertQ30,
                'enquetecoll' => $enqueteCollectivite,
                'listeMetiers'                => $Liste_metiers,
                'listeSpecialites'            => $Liste_specialites,
                'domainePro'                  => $domainePro,
                'familleMetier'               => $familleMetier,
                'domaineSpecialite'           => $domaineSpecialite,
                'currentMetier'               => $currentMetier,
                'currentSpecialite'           => $currentSpecialite,
                'anne_campagne'               => $campagne->getNmAnne(),
                'currentLbMetier'               => $currentLbMetier,
                'listeAgent' => true,
                'collectivite' => $collectivite,
                'current_agent_index' => $row_index,
                'nb_agent_status' => $nb_agent_status,
            ));
        }else{
            return $this->redirectToRoute('bilansocialagent_index');
        }
    }
    /**
     *  action du sivant/précédent sur la page d'edition
     */
    public function editNextPrevAction(Request $request){
        $user = $this->getUser();
        if (null == $this->getFromSession('coll_id')) {
            $idCollectivity = $user->getCollectivite()->getIdColl();
        } else {
            $idCollectivity = $this->getFromSession('coll_id');
        }
        $em = $this->getDoctrine()->getManager();
        $enquete = $this->getMonEnquete();
        $idEnquete = $enquete->getIdEnqu();
        $current_agent_status = $this->getFromSession('current_agent_status');
        $current_agent_index = $this->getCurrentIndexAgentDisplay($request);
        $index_modif = $request->get('index_modif');
        $agent_repo = $em->getRepository('ApaBundle:BilanSocialAgent');
        $agent = false;
        $this->setToSession('current_step', $request->get('current_step'));
        if($index_modif>0){
            $agent = $agent_repo->getNextAgent($idEnquete,$idCollectivity,$current_agent_status,$current_agent_index);
            if($agent!=false){
                $this->setToSession('current_agent_index',$current_agent_index+1);
            }
        }else if($index_modif<0){
            $agent = $agent_repo->getPrevAgent($idEnquete,$idCollectivity,$current_agent_status,$current_agent_index);
            if($agent!=false){
                $this->setToSession('current_agent_index',$current_agent_index-1);
            }
        }

        $id_agent = $agent->getIdBilasociagen();
        return $this->redirectToRoute('bilansocialagent_edit', ['idBilasociagen' => $id_agent]);
    }
    /**
     * Deletes a bilanSocialAgent entity.
     *
     */
    public function deleteAction(Request $request, BilanSocialAgent $bilanSocialAgent)
    {
        if($this->checkIsUserOwnerOf($bilanSocialAgent)){
            $originalAbsenceArretAgents = new ArrayCollection();
            $originalTagsEtpr = new ArrayCollection();
            $originalHeuCompReaRemAgent = new ArrayCollection();
            $originalHeuSuppReaRemAgent = new ArrayCollection();
            $originalFormSuivi = new ArrayCollection();
            $originalRemunerationGlobaleAgent = new ArrayCollection();
            $originalRemunerationAgent = new ArrayCollection();


            foreach ($bilanSocialAgent->getAbsenceArretAgents() as $tag) {
                $originalAbsenceArretAgents->add($tag);
            }
            foreach ($bilanSocialAgent->getRemunerationGlobaleAgent() as $tag) {
                $originalRemunerationGlobaleAgent->add($tag);
            }
            foreach ($bilanSocialAgent->getRemunerationAgent() as $tag) {
                $originalRemunerationAgent->add($tag);
            }
            foreach ($bilanSocialAgent->getEtprAgent() as $tag) {
                $originalTagsEtpr->add($tag);
            }
            foreach ($bilanSocialAgent->getHeuCompReaRemAgent() as $tag) {
                $originalHeuCompReaRemAgent->add($tag);
            }
            foreach ($bilanSocialAgent->getFormationAgents() as $tag) {
                $originalFormSuivi->add($tag);
            }


            foreach ($originalAbsenceArretAgents as $absence) {

                if (false === $bilanSocialAgent->getAbsenceArretAgents()->contains($absence)) {

                    $em->remove($absence);
                }
            }
            foreach ($originalRemunerationGlobaleAgent as $remuneration) {

                if (false === $bilanSocialAgent->getRemunerationGlobaleAgent()->contains($remuneration)) {

                    $em->remove($remuneration);
                }
            }
            foreach ($originalRemunerationAgent as $remuneration) {

                if (false === $bilanSocialAgent->getRemunerationAgent()->contains($remuneration)) {

                    $em->remove($remuneration);
                }
            }
            foreach ($originalTagsEtpr as $etpr) {

                if (false === $bilanSocialAgent->getEtprAgent()->contains($etpr)) {

                    $em->remove($etpr);
                }
            }
            foreach ($originalHeuCompReaRemAgent as $HeuCompReaRemAgent) {

                if (false === $bilanSocialAgent->getHeuCompReaRemAgent()->contains($HeuCompReaRemAgent)) {

                    $em->remove($HeuCompReaRemAgent);
                }
            }
            foreach ($originalHeuSuppReaRemAgent as $HeuSuppReaRemAgent) {

                if (false === $bilanSocialAgent->getHeuSuppReaRemAgent()->contains($HeuSuppReaRemAgent)) {

                    $em->remove($HeuSuppReaRemAgent);
                }
            }
            foreach ($originalFormSuivi as $FormSuivi) {

                if (false === $bilanSocialAgent->getFormationAgents()->contains($FormSuivi)) {

                    $em->remove($FormSuivi);
                }
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($bilanSocialAgent);
            $em->flush();

            $flashBag = $this->get('session')->getFlashBag();
            foreach ($flashBag->keys('notice') as $notice) {
                $flashBag->set($notice, array());
            }

            $flash = $this->get('translator')->trans('delete.agent.flash');

            $return = new JsonResponse([
                        'message'   => $flash,
                        ]);
            return $return;
        }else{
            return $this->redirectToRoute('bilansocialagent_index');
        }
    }

    public function deleteSeveralAction(Request $request)
    {
        $deleteIds = $request->get('deleteSeveral');
        $oneAgent  = $request->get('oneAgent');
        $nbAgents = count($deleteIds);
        try{
            foreach ($deleteIds as $deleteId) {
                $repository     = $this->getDoctrine()->getManager()->getRepository('ApaBundle:BilanSocialAgent');
                $deleteAgent    = $repository->find($deleteId);
                $response       = $this->forward('ApaBundle:BilanSocialAgent:delete', [
                    'request'           => $request,
                    'bilanSocialAgent'  => $deleteAgent,
                    'singleAgent'       => $oneAgent,
                     ]);
            }
            if ($nbAgents == 1) {
                $flash = $this->get('translator')->trans('delete.agent.flash');
            } else {
                $flash = $this->get('translator')->trans('delete.agents.flash');
            }

            $return = new JsonResponse([
                        'success'   => true,
                        'message'   => $flash,
                        ]);
            return $return;
        }catch (\Exception $e){
            $error = new JsonResponse([
                        'error'     => true,
                        'exception' => $e->getMessage(),
                        ]);
            return $error;
        }
    }

    /**
     * Creates a form to delete a bilanSocialAgent entity.
     *
     * @param BilanSocialAgent $bilanSocialAgent The bilanSocialAgent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BilanSocialAgent $bilanSocialAgent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bilansocialagent_delete', array('idBilasociagen' => $bilanSocialAgent->getIdbilasociagen())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function listAction(Request $request)
    {
        $this->removeFromSession('current_agent_index');
        $this->removeFromSession('current_agent_status');
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $session = $this->get('session');
        if (null == $session->get('coll_id')) {
            $idCollectivity = $user->getCollectivite()->getIdColl();
        } else {
            $idCollectivity = $session->get('coll_id');
        }

        $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();

        $enquete = $this->getMonEnquete();

        $idEnquete = $enquete->getIdEnqu();


        $initBilanSocial = $em->getRepository('BilanSocialBundle:InitBilanSocial')
                                ->findOneBy(array('collectivite' => $idCollectivity, 'enquete' => $idEnquete));
        if (empty($initBilanSocial)) {
            $this->addFlash(
                    'notice', "Pas de saisie agent par agent initialisée"
            );
            $redirectionConso = $this->redirectToRoute('bilan_social_homepage');
            return $redirectionConso;
        }
        else if (!empty($initBilanSocial) && $initBilanSocial->getBlApa() == 0 && $initBilanSocial->getInitSource() !== 'n4ds' && $initBilanSocial->getInitSource() !== 'basecarr' ) {
            $this->addFlash(
                    'notice', "Une saisie en consolidé existe déjà"
            );
            $redirectionConso = $this->redirectToRoute('bilan_social_homepage');
            return $redirectionConso;
        }


        $InformationGenerale = $em->getRepository('ApaBundle:InformationGenerale')->GetInformationGenerale($idCollectivity, $idEnquete, $campagne->getIdCamp());
        $InformationCollectivite = $em->getRepository('ApaBundle:InformationColectiviteAgent')->GetInformationCollectivite($idCollectivity, $idEnquete, $campagne->getIdCamp());

        $StatutAgents = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllStatuts($idEnquete, $idCollectivity);

        $listeFonctionnaires = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllAgents($idEnquete, $idCollectivity, 'FONCTIONNAIRE');
        $listeContPerm = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllAgents($idEnquete, $idCollectivity, 'CONTPERM');
        $listeContNonPerm = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllAgents($idEnquete, $idCollectivity, 'CONTNONPERM');
        $SansStatut = $em->getRepository('ApaBundle:BilanSocialAgent')->getNoStatut($idEnquete, $idCollectivity);

        $statuts = $em->getRepository('ReferencielBundle:RefStatut')->findAll();

        /*variable pour ne pas passer deux fois pour rien dans les fonctionnaires quand le statut est titulaire ou stagiaire */
        $dejaPasse = false;
        $tabDashBoard = array();
        foreach ($statuts as $key => $value) {
            $statut_finded = false;
            if (($value->getCdStat() === "TITU" || $value->getCdStat() === "STAG") && $dejaPasse === false) {
                $lbStat = 'Fonctionnaire';
                $nbAgent3112 = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgent3112($idEnquete, $idCollectivity, 'FONCTIONNAIRE');
                $nbAgentValide = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentValide($idEnquete, $idCollectivity, 'FONCTIONNAIRE');
                $nbAgentNonValide = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentNonVAlide($idEnquete, $idCollectivity, 'FONCTIONNAIRE');
                $nbAgentDepart = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentDepart($idEnquete, $idCollectivity, 'FONCTIONNAIRE');
                $nbAgentArrive = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentArrive($idEnquete, $idCollectivity, 'FONCTIONNAIRE');
                $dejaPasse = true;
                $statut_finded = true;
            } elseif ($value->getCdStat() === "CONTPERM") {
                $lbStat = 'Contractuel permanent';
                $nbAgent3112 = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgent3112($idEnquete, $idCollectivity, 'CONTPERM');
                $nbAgentValide = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentValide($idEnquete, $idCollectivity, 'CONTPERM');
                $nbAgentNonValide = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentNonVAlide($idEnquete, $idCollectivity, 'CONTPERM');
                $nbAgentDepart = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentDepart($idEnquete, $idCollectivity, 'CONTPERM');
                $nbAgentArrive = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentArrive($idEnquete, $idCollectivity, 'CONTPERM');
                $statut_finded = true;
            } elseif ($value->getCdStat() === "CONTNONPERM") {
                $lbStat = 'Contractuel non permanent';
                $nbAgent3112 = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgent3112($idEnquete, $idCollectivity, 'CONTNONPERM');
                $nbAgentValide = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentValide($idEnquete, $idCollectivity, 'CONTNONPERM');
                $nbAgentNonValide = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentNonVAlide($idEnquete, $idCollectivity, 'CONTNONPERM');
                $nbAgentDepart = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentDepart($idEnquete, $idCollectivity, 'CONTNONPERM');
                $nbAgentArrive = $em->getRepository('ApaBundle:BilanSocialAgent')->CountNbAgentArrive($idEnquete, $idCollectivity, 'CONTNONPERM');
                $statut_finded = true;
            }
            if ($statut_finded) {
                $tab = [$lbStat, $nbAgent3112, $nbAgentValide, $nbAgentNonValide, $nbAgentDepart, $nbAgentArrive];

                $tabDashBoard = $this->SetAttributeToDashBoard($tab, $tabDashBoard);
            }
        }
        /*$formImportCourtier = $this->createForm(ImportCourtierType::class, $courtier = []);*/
        $courtier = [];
        $formImportCourtier = $this->createForm(ImportCourtierType::class, $courtier);
        $formImportCourtier->handleRequest($request);
        if ($formImportCourtier->isSubmitted() && $formImportCourtier->isValid()) {
            $fileCourtier = $formImportCourtier['fileCourtier']->getData();
            $this->apaImportCourtierAction($fileCourtier, "txt");
        }
        return $this->render('@Apa/bilansocialagent/index.html.twig', array(
            'informationColectiviteAgent' => $InformationCollectivite,
            'informationGenerales' => $InformationGenerale,
            'sansStatut' => $SansStatut,
            'tabDashBoard' => $tabDashBoard,
            'anne_campagne' => $campagne->getNmAnne(),
            'listeFonctionnaires' => $listeFonctionnaires,
            'listeContPerm' => $listeContPerm,
            'listeContNonPerm' => $listeContNonPerm,
            'statutAgents' => $StatutAgents,
            'formImportCourtier' => $formImportCourtier->createView(),
        ));
    }

    public function apaImportCourtierAction($fileCourtier)
    {
        $collectivite = $this->getMaCollectivite();
        $enquete = $this->getMonEnquete();
        $em = $this->getDoctrine()->getManager();
        $extension = $fileCourtier->guessExtension();

        try {
            if ($extension == "txt") {
                $contents = file_get_contents($fileCourtier->getPathname());
                $data = parseCsvToArray($contents);
                $list_ref_motif_abcences = reverseArrayBy($em->getRepository(RefMotifAbsence::class)->findAll(), 'cdMotiabse');
                $list_ref_nature_lesion = reverseArrayBy($em->getRepository(RefNatureLesion::class)->findAll(), 'cdNaturelesi');
                $list_ref_siege_lesion = reverseArrayBy($em->getRepository(RefSiegeLesion::class)->findAll(), 'cdSiegelesi');
                $list_ref_element_materiel = reverseArrayBy($em->getRepository(RefElementMateriel::class)->findAll(), 'cdElementmat');
                $list_ref_maladie_pro = reverseArrayBy($em->getRepository(RefMaladieProfessionnelle::class)->findAll(), 'cdMaladiepro');
                $list_ref_type_activite_maladie_professionnel = reverseArrayBy($em->getRepository(RefTypeActivite::class)->findAll(), 'idTypeActiviteMaladiePro');
                $list_ref_type_activite_arret_travail = reverseArrayBy($em->getRepository(RefTypeActivite::class)->findAll(), 'idTypeActiviteArretTravail');
                $agent_csv_not_exist = array();
                foreach ($data as $key => $value) {
                    if ($key !== 0) {
                        $agent = $em->getRepository(BilanSocialAgent::class)->findOneBy(array(
                            'lbNom' => $value[0],
                            'lbPren' => $value[1],
                            'lbDatenais' => $value[2],
                            'enquete' => $enquete,
                            'collectivite' => $collectivite
                        ));
                        if (!empty($agent)) {
                            /* Mettre oui a la Q20.1 -> pour afficher le tableau absence */
                            $agent->setBlAgenabse(true);
                            $absence = new AbsenceArretAgent();

                            $absence->setNbArre($value[3]);

                            $absence->setNbJourabse($value[4]);

                            if (array_key_exists($value[5], $list_ref_motif_abcences)) {
                                $absence->setRefMotifAbsence($list_ref_motif_abcences[$value[5]]);
                            }
                            if (array_key_exists($value[6], $list_ref_nature_lesion)) {
                                $absence->setIdNatureLesion($list_ref_nature_lesion[$value[6]]);
                            }
                            if (array_key_exists($value[7], $list_ref_siege_lesion)) {
                                $absence->setIdSiegeLesion($list_ref_siege_lesion[$value[7]]);
                            }
                            if (array_key_exists($value[8], $list_ref_element_materiel)) {
                                $absence->setIdElementMateriel($list_ref_element_materiel[$value[8]]);
                            }
                            if (array_key_exists($value[9], $list_ref_maladie_pro)) {
                                $absence->setIdMaladieProfessionnelle($list_ref_maladie_pro[$value[9]]);
                            }
                            if (array_key_exists($value[10], $list_ref_type_activite_maladie_professionnel)) {
                                $absence->setIdTypeActiviteMaladiePro($list_ref_type_activite_maladie_professionnel[$value[10]]);
                            }
                            if (array_key_exists($value[11], $list_ref_type_activite_arret_travail)) {
                                $absence->setIdTypeActiviteArretTravail($list_ref_type_activite_arret_travail[$value[11]]);
                            }
                            $absence->setAccidentAvecArret($value[12]);

                            $absence->setAnneeEvenement($value[13]);

                            $absence->setBilanSocialAgent($agent);

                            $em->persist($absence);

                            $agent->addAbsenceArretAgent($absence);

                            $em->persist($agent);

                        } else {
                            $agent_csv_not_exist[] = "ligne " . $key . " : l'agent n'existe pas en base (" . $value[0] . ", " . $value[1] . ", " . $value[2] . ")";
                        }
                    }
                }
                try {
                    $em->flush();
                } catch (\Exception $e) {
                    $e->getMessage();
                }
            }
            else{
                $this->addFlash('error', "Veuillez importer un fichier csv");
            }
        } catch (\Exception $e) {
            dump($e->getMessage(), $e->getTraceAsString());
        }

        return $this->redirectToRoute('bilansocialagent_index');
    }

    public function apaImportCourtierModalAction()
    {
        $template = $this->renderView('@Apa/bilansocialagent/modalCourtier.html.twig', array());
        return new JsonResponse($template);
    }

    public function ajaxCadreemploiAction(Request $request)
    {
        $categorie = $request->get('id_category');
        $id_fili = $request->get('id_filiere');
        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $CadreEmploi = $em->getRepository('ReferencielBundle:RefCadreEmploi')->findAllCategorieOrFiliere(array('categorie' => $categorie, 'filiere' => $id_fili));

        $tabCadreEmploi = [];

        foreach ($CadreEmploi as $key => $value) {
            //array_push($tabCadreEmploi, $value);
            $tabCadreEmploi[$value->getIdCadrempl()] = $value->getLbCadrempl();
        }

        $resultat = json_encode($tabCadreEmploi);
        $response = new Response();
        $response->setContent($resultat);

        return $response;

    }

    public function ajaxGradeAction(Request $request)
    {
        $cadreemploi = $request->get('id_cadreEmploi');
        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $Grades = $em->getRepository('ReferencielBundle:RefGrade')->findAllGradeByCadreEmploi($cadreemploi);
        $tabGrade = [];

        foreach ($Grades as $key => $value) {
            $tabGrade[$value->getIdGrad()] = $value->getlbGrad();
        }

        $resultat = json_encode($tabGrade);
        $response = new Response();
        $response->setContent($resultat);

        return $response;
    }

    public function ajaxStageTituAction(Request $request)
    {
        $stagetitu = $request->get('id_stagetitu');

        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $blSauvdet = $em->getRepository('ReferencielBundle:RefStageTitularisation')->findByLoiSauvadet($stagetitu);

        $sauv = 0;
        if ($blSauvdet) {
            $sauv = 1;
        }

        $resultat = json_encode($sauv);
        $response = new Response();
        $response->setContent($resultat);

        return $response;
    }

    public function ajaxMotifArriveeAction(Request $request)
    {
        $status = $request->get('statut');
        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $MotifArrivee = $em->getRepository('ReferencielBundle:RefMotifArrivee')->findAllMotifArriveeByStatut($status);
        $tab_MotifArrivee = [];

        foreach ($MotifArrivee as $key => $value) {
            $tab_MotifArrivee[$value->getidMotiarri()] = $value->getlbMotiarri();
        }

        $resultat = json_encode($tab_MotifArrivee);
        $response = new Response();
        $response->setContent($resultat);

        return $response;
    }

    public function ajaxMotifDepartAction(Request $request)
    {
        $status = $request->get('statut');
        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $MotifDepart = $em->getRepository('ReferencielBundle:RefMotifDepart')->findAllMotifDepartByStatut($status);
        $tab_MotifDepart = [];

        foreach ($MotifDepart as $key => $value) {
            $tab_MotifDepart[$value->getidMotidepa()] = $value->getlbMotidepa();
        }
        $resultat = json_encode($tab_MotifDepart);
        $response = new Response();
        $response->setContent($resultat);

        return $response;
    }

    public function ajaxInaptitudeFiliereAction(Request $request)
    {
        $inaptitude = $request->get('inaptitude');
        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $inaptitudes = $em->getRepository('ReferencielBundle:RefInaptitude')->find($inaptitude);

        if ($inaptitudes->getBlFili()) {
            $valid = 1;
        } else {
            $valid = 0;
        };
        $response = new Response();
        $response->setContent($valid);

        return $response;
    }

    public function ajaxMotifDepartDecesAction(Request $request)
    {
        $depart = $request->get('idMotidepa');
        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $deces = $em->getRepository('ReferencielBundle:RefMotifDepart')->findMotifDepartByCodeDCD($depart);

        if ($deces) {
            $valid = 1;
        } else {
            $valid = 0;
        };
        $response = new Response();
        $response->setContent($valid);

        return $response;
    }

    public function ajaxMotifpositionAction(Request $request)
    {
        $statut = $request->get('statut');
        $position_id = $request->get('position');
        $user = $request->get('user');
        $this->saveAndUnlockSession($request);
        $em = $this->getDoctrine()->getManager();
        $position = $em->getRepository('ReferencielBundle:RefPositionStatutaire')->findByAllWithOrderAndStatut(array("statut" => $statut, "user" => $user));

        $html_groupe = "<option value=''> Selectionner une position statutaire particulière </option>";
        $current_groupe = "";
        foreach ($position as $key => $value) {
            $select_position = '';
            $lbPosition = $value->getLbPosistat() . ' ' . $value->getLbCompl();
            $idPosi = $value->getIdPosistat();
            if (!empty($position_id) && $position_id == $idPosi) {
                $select_position = ' selected="selected"';
            }
            if ($value->getRefGroupePositionStatutaire() != null) {
                $groupe = $value->getRefGroupePositionStatutaire();
                if (!empty($groupe)) {
                    if (!empty($current_groupe) && $current_groupe != $groupe->getIdGrouPosistat()) {
                        $html_groupe .= '</optgroup>';
                    }

                    if ($current_groupe != $groupe->getIdGrouPosistat()) {
                        $lb_groupe = $groupe->getLbGrouPosistat() . ' ' . $groupe->getLbGrouCompl();
                        $html_groupe .= '<optgroup label="' . $lb_groupe . '">';
                        $current_groupe = $groupe->getIdGrouPosistat();
                    }
                    $html_groupe .= '<option value="' . $idPosi . '" ' . $select_position . '>' . $lbPosition . '</option>';
                }
            } else {
                $html_groupe .= '</optgroup>';
                $html_groupe .= '<option value="' . $idPosi . '" ' . $select_position . '>' . $lbPosition . '</option>';
            }
            $select_position = '';
        }
        $resultat = json_encode($html_groupe);
        $response = new Response();
        $response->setContent($resultat);

        return $response;
    }

    public function delete_formAction($idBilasociagen)
    {
        if($this->checkIsUserOwnerOf($bilanSocialAgent)){
            $deleteForm = $this->createDeleteForm($idBilasociagen);
            return $this->render('@Apa/bilansocialagent/delete_form.html.twig', array(
                    'delete_form' => $deleteForm->createView(),
                )
            );
        }else{
            return $this->redirectToRoute('bilansocialagent_index');
        }
    }

    public function ajaxGetMetierAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $draw_number = $request->get('draw');
        $id_famille_metier = $request->get('idFamilleMetier');
        $this->saveAndUnlockSession($request);
        $metiers = $em->getRepository('ReferencielBundle:RefMetier')->getAllWithOrder($id_famille_metier);
        $nb_metier = count($metiers);
        $data = array();
        foreach ($metiers as $metier) {
            $metier_data = array(
                $metier->getLbMetier(),
                $metier->getLbAutAppColl(),
                $metier->getIdMetier()
            );
            $data[] = $metier_data;
        }
        $result = array(
            'draw' => $draw_number,
            'recordTotal' => $nb_metier,
            "recordFiltered" => $nb_metier,
            'data' => $data,
        );

        #var_dump($metiers[0]);
        return new Response(json_encode($result));
    }

    public function ajaxGetFamilleMetierAction(Request $request, $idDomainePro = null)
    {
        $idDomainePro = $request->get('idDomainePro');
        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $familleMetiers = $em->getRepository('ReferencielBundle:RefFamilleMetier')->getAllWithOrder($idDomainePro);

        $data = array();
        foreach ($familleMetiers as $familleMetier) {
            $famille_metier_data = array(
                'lbFamilleMetier' => $familleMetier->getLbFamilleMetier(),
                'idFamilleMetier' => $familleMetier->getIdFamilleMetier()
            );
            $data[] = $famille_metier_data;
        }

        return new JsonResponse($data);
    }

    public function ajaxGetSpecialiteAction(Request $request) {
        $draw_number = $request->get('draw');
        $id_domaine_specialite = $request->get('idDomaineSpecialite');
        $em = $this->getDoctrine()->getManager();
        $specialites = $em->getRepository('ReferencielBundle:RefSpecialite')->getAllWithOrder($id_domaine_specialite);
        $nb_specialite = count($specialites);
        $data = array();
        foreach ($specialites as $specialite) {
            $specialite_data = array(
                $specialite->getLbSpecialite(),
                $specialite->getIdSpecialite()
            );
            $data[] = $specialite_data;
        }
        $result = array(
            'draw'           => $draw_number,
            'recordTotal'    => $nb_specialite,
            "recordFiltered" => $nb_specialite,
            'data'           => $data,
        );

        #var_dump($metiers[0]);
        return new Response(json_encode($result));
    }

    public function ajaxGetDomaineSpecialiteAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $domaineSpecialites = $em->getRepository('ReferencielBundle:RefDomaineSpecialite')->findBy(array('blVali' => 0));

        $data = array();
        foreach ($domaineSpecialites as $domaineSpecialite) {
            $domaine_specialite_data = array(
                'lbDomaineSpecialite' => $domaineSpecialite->getLbDomaineSpecialite(),
                'idDomaineSpecialite' => $domaineSpecialite->getIdDomaineSpecialite()
            );
            $data[] = $domaine_specialite_data;
        }

        return new JsonResponse($data);
    }

    public function ajax_q11_1_q12_1Action(Request $request)
    {
        $value = $request->get('value');

        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        if ($value === '0') {
            $tempsPartiels = $em->getRepository('ReferencielBundle:RefTempsPartiel')->findByExcludePARTAUTO();
        } else {
            $tempsPartiels = $em->getRepository('ReferencielBundle:RefTempsPartiel')->findAll();
        }


        $data = array();
        foreach ($tempsPartiels as $tempsPartiel) {
            $tempsPartiel_data = array(
                'lbTemppart' => $tempsPartiel->getLbTemppart(),
                'idTemppart' => $tempsPartiel->getIdTemppart()
            );
            $data[] = $tempsPartiel_data;
        }

        return new JsonResponse($data);
    }

    private function SetAttributeToDashBoard(array $value, array $tab)
    {

        $informationDashBoard = [
            $value['0'],
            $value[1]['nbAgent3112'],
            $value[2]['nbAgentValide'],
            $value[3]['nbAgentNonValide'],
            $value['4']['nbAgentDepart'],
            $value['5']['nbAgentArrive'],
        ];


        array_push($tab, $informationDashBoard);

        return $tab;
    }

    public function AjaxFonctionnaireAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $session = $this->get('session');
        if (null == $session->get('coll_id')) {
            $idCollectivity = $this->getUser()->getCollectivite()->getIdColl();
        } else {
            $idCollectivity = $session->get('coll_id');
        }
        $this->saveAndUnlockSession($request);
        $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $enquete = $this->getMonEnquete();
        $idEnquete = $enquete->getIdEnqu();


        $listeFonctionnaires = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllAgents($idEnquete, $idCollectivity, 'FONCTIONNAIRE');

        // if ($this->getUser()->hasRole('ROLE_PREVIOUS_ADMIN') || $this->getUser()->hasRole('ROLE_CDG')) {
        if ($this->getUser()->hasRole('ROLE_CDG')) {
            foreach ($listeFonctionnaires as $key => &$value) {
                $value['lbNom'] = '******';
                $value['lbPren'] = '******';
                $value['lbDatenais'] = '******';
            }
        }

        $result = array(
            'data' => $listeFonctionnaires
        );
        //        $listeContPerm = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllAgents($idEnquete, $idCollectivity, 'CONTPERM');
        //        $listeContNonPerm = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllAgents($idEnquete, $idCollectivity, 'CONTNONPERM');
        //        $SansStatut = $em->getRepository('ApaBundle:BilanSocialAgent')->getNoStatut($idEnquete, $idCollectivity);

        return new JsonResponse($result);
    }

    public function AjaxEmploiPermanentAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $session = $this->get('session');
        if (null == $session->get('coll_id')) {
            $idCollectivity = $this->getUser()->getCollectivite()->getIdColl();
        } else {
            $idCollectivity = $session->get('coll_id');
        }
        $this->saveAndUnlockSession($request);
        $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $enquete = $this->getMonEnquete();

        $idEnquete = $enquete->getIdEnqu();


        $listeContPerm = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllAgents($idEnquete, $idCollectivity, 'CONTPERM');
        //dump($listeContPerm);
        //exit;
        // if ($this->getUser()->hasRole('ROLE_PREVIOUS_ADMIN') || $this->getUser()->hasRole('ROLE_CDG')) {
        if ($this->getUser()->hasRole('ROLE_CDG')) {
            foreach ($listeContPerm as $key => &$value) {
                $value['lbNom'] = '******';
                $value['lbPren'] = '******';
                $value['lbDatenais'] = '******';
            }
        }

        $result = array(
            'data' => $listeContPerm,
        );
        //
        //        $listeContNonPerm = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllAgents($idEnquete, $idCollectivity, 'CONTNONPERM');
        //        $SansStatut = $em->getRepository('ApaBundle:BilanSocialAgent')->getNoStatut($idEnquete, $idCollectivity);

        return new JsonResponse($result);
    }

    public function AjaxEmploiNonPermanentAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $session = $this->get('session');
        if (null == $session->get('coll_id')) {
            $idCollectivity = $this->getUser()->getCollectivite()->getIdColl();
        } else {
            $idCollectivity = $session->get('coll_id');
        }
        $this->saveAndUnlockSession($request);
        $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $enquete = $this->getMonEnquete();
        $idEnquete = $enquete->getIdEnqu();


        $listeContNonPerm = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllAgents($idEnquete, $idCollectivity, 'CONTNONPERM');

        // if ($this->getUser()->hasRole('ROLE_PREVIOUS_ADMIN') || $this->getUser()->hasRole('ROLE_CDG')) {
        if ($this->getUser()->hasRole('ROLE_CDG')) {
            foreach ($listeContNonPerm as $key => &$value) {
                $value['lbNom'] = '******';
                $value['lbPren'] = '******';
                $value['lbDatenais'] = '******';
            }
        }

        $result = array(
            'data' => $listeContNonPerm,
        );
        //
        //        $listeContNonPerm = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllAgents($idEnquete, $idCollectivity, 'CONTNONPERM');
        //        $SansStatut = $em->getRepository('ApaBundle:BilanSocialAgent')->getNoStatut($idEnquete, $idCollectivity);

        return new JsonResponse($result);
    }

    public function ajaxCadreemploiEtprAction(Request $request)
    {

        $codeFiliere = $request->get('codeFili');

        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $Filiere = $em->getRepository('ReferencielBundle:RefFiliere')->findOneByCdFili($codeFiliere);

        $CadreEmploi = $em->getRepository('ReferencielBundle:RefCadreEmploi')->findCadreEmploiByFiliere($Filiere->getIdFili());

        $tabCadreEmploi = [];

        foreach ($CadreEmploi as $key => $value) {

            $tabCadreEmploi[$value->getCdCadrempl()] = $value->getlbCadrempl();
        }

        return new JsonResponse($tabCadreEmploi);

    }

    public function ajaxCadreemploiheureSuppAction(Request $request)
    {

        $idFiliere = $request->get('idFili');

        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $Filiere = $em->getRepository('ReferencielBundle:RefFiliere')->findOneByIdFili($idFiliere);

        $CadreEmploi = $em->getRepository('ReferencielBundle:RefCadreEmploi')->findCadreEmploiByFiliere($Filiere->getIdFili());

        $tabCadreEmploi = [];

        foreach ($CadreEmploi as $key => $value) {

            $tabCadreEmploi[$value->getIdCadrempl()] = $value->getlbCadrempl();
        }

        return new JsonResponse($tabCadreEmploi);

    }

    public function ajaxQ41StatusMotifDepartAction(Request $request)
    {

        $statut = $request->get('statut');
        $valueCheckbox = $request->get('value_checkbox');


        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $motifDeparts = $em->getRepository('ReferencielBundle:RefMotifDepart')->findAllMotifDepartByStatutAndByTemp($statut, $valueCheckbox);

        $data = array();
        foreach ($motifDeparts as $motifDepart) {
            $motifDepart_data = array(
                'lbMotidepa' => $motifDepart->getLbMotidepa(),
                'idMotidepa' => $motifDepart->getIdMotidepa()
            );
            $data[] = $motifDepart_data;
        }

        return new JsonResponse($data);

    }

    public function ajaxMouvementInterneAnneeStatusAction(Request $request)
    {

        $statut = $request->get('statut');


        $em = $this->getDoctrine()->getManager();
        $this->saveAndUnlockSession($request);
        $mouvementInterneAnnees = $em->getRepository('ReferencielBundle:RefMouvinteanne')->findAllMouvementInterneAnneeByStatut($statut);

        $data = array();
        foreach ($mouvementInterneAnnees as $mouvementInterneAnnee) {
            $mouvementInterneAnnee_data = array(
                'lbMouvinteannee' => $mouvementInterneAnnee->getLbMouvInteAnne(),
                'idMouvinteannee' => $mouvementInterneAnnee->getIdMouvInteAnne()
            );
            $data[] = $mouvementInterneAnnee_data;
        }

        return new JsonResponse($data);

    }


    public function apaExportAction()
    {
        $session = $this->get('session');
        if (null == $session->get('coll_id')) {
            $idCollectivity = $this->getUser()->getCollectivite()->getIdColl();
        } else {
            $idCollectivity = $session->get('coll_id');
        }
        $enquete = $this->getMonEnquete();
        $idEnquete = $enquete->getIdEnqu();

        $query = "CALL getResultSetApaExport(:idColl, :idEnqu)";

        $em = $this->getDoctrine()->getManager();
        $result_proc_export_apa_coll = $em->getConnection()->prepare($query);
        $result_proc_export_apa_coll->bindParam(':idColl', $idCollectivity);
        $result_proc_export_apa_coll->bindParam(':idEnqu', $idEnquete);
        $result_proc_export_apa_coll->execute();

        $config_finder = $this->get('config_finder');
        $config_finder->setConfigBasePath(__DIR__.'/../Resources/config/data/');
        $config_finder->addConfigFile('apa_export','apa_export.json');
        $data_sources = $config_finder->getConfig('apa_export', "data");
        $data = array();

        // $array_bsas = $stmt->fetchAll(\PDO::FETCH_OBJ);
        // $stmt->getWrappedStatement()->nextRowset();

        // $array_etpr_agents = $stmt->fetchAll(\PDO::FETCH_OBJ);
        // $stmt->getWrappedStatement()->nextRowset();

        // $array_absences = $stmt->fetchAll(\PDO::FETCH_OBJ);
        // $stmt->getWrappedStatement()->nextRowset();

        // $array_formations = $stmt->fetchAll(\PDO::FETCH_OBJ);
        // $stmt->closeCursor();

        foreach ($data_sources as $data_key => $src) {
            if(is_array($src)){
                if(isset($src['from_result_set'])){
                    $result_set_name = $src['from_result_set'];
                    $data[$data_key] = $$result_set_name->fetchAll(\PDO::FETCH_OBJ);
                    $$result_set_name->getWrappedStatement()->nextRowset();
                    if(isset($src['group_by'])){
                        $group_by = $src['group_by'];
                        $grouped = array();
                        foreach ($data[$data_key] as $key => $row) {
                            $value_to_group_by = $row->$group_by;
                            if(!isset($grouped[$value_to_group_by])){
                                $grouped[$value_to_group_by] = array();
                            }
                            array_push($grouped[$value_to_group_by],$row);
                        }
                        $data[$data_key] = array_values($grouped);
                    }
                }
            }
        }
        /*$response = new Response();
        $handle = fopen('php://output', 'w+');
        ob_start();

        $eaArray = array();
        $absArray = array();
        $formArray = array();

        fwrite($handle, "ID_BILASOCIAGEN;".
                        "ID_ENQU;".
                        "LB_NOM;".
                        "LB_PREN;".
                        "LB_DATENAIS;".
                        "CD_SEXE;".
                        "BL_BOETH;".
                        "BL_AGENREMU3112;".
                        "BL_AGENREMUANNE;".
                        "BL_AGENARRIANNECOLL;".
                        "BL_EMPLFONC;".
                        "ID_GRADDETA;".
                        "DT_DETAEMPLFONC;".
                        "DT_ARRISTAT;".
                        "BL_ACQUSTATANNE;".
                        "BL_AGENTITUSTAGANNE;".
                        "BL_TITULOISAUVAANNE;".
                        "BL_RECRSANSCONCSELEPROF;".
                        "LB_DATEDEPACOLL;".
                        "CD_MOTIDECE;".
                        "BL_PROMAVANSTAGANNE;".
                        "BL_TEMPCOMP;".
                        "BL_TEMPPLEIN;".
                        "NB_DEMAPART;".
                        "NB_DEMAPARTACCE;".
                        "NB_PREMDEMASATI;".
                        "NB_MODIEMPLPERMTEMPCOMP;".
                        "NB_AGENEMPLTEMPCOMPNONRENOU;".
                        "MT_REMUANNUBRUT;".
                        "MT_TOTAREMUPRIMINDEM;".
                        "MT_TOTAREMUBRUTNBI;".
                        "MT_TOTAREMUBRUTHEURSUPP;".
                        "NB_HEURSUPP;".
                        "NB_HEURCOMPREALREMU;".
                        "BL_AGENABSE;".
                        "NB_ALLOTEMPINVTRAV;".
                        "NB_ALLOTEMPINVAPRO;".
                        "BL_CONGPATEACCUENFA;".
                        "NB_JOURCONGPATEACCUENFA;".
                        "BL_ENTRDEPACONG;".
                        "BL_ENTRRETOCONG;".
                        "BL_CET;".
                        "BL_CETOUVERT;".
                        "NB_JOURCUMU3112;".
                        "NB_JOURVERS3112;".
                        "NB_JOURDEPE3112;".
                        "NB_JOURINDE3112;".
                        "NB_JOURPRISRAFP3112;".
                        "BL_TELETRAV;".
                        "BL_AGENPREV;".
                        "BL_DEMAINAP;".
                        "ID_INAPDEMA;".
                        "BL_DECIINAP;".
                        "ID_INAPDECI;".
                        "BL_FORMSUIV;".
                        "BL_VAE;".
                        "ID_EBCF;".
                        "BL_BILACOMP;".
                        "NB_BILACOMP;".
                        "BL_CONGFORM;".
                        "BL_CDI;".
                        "FG_STAT;".
                        "created_at;".
                        "updated_at;".
                        "ID_POSISTAT;".
                        "ID_STAT;".
                        "ID_FONCPUBL;".
                        "ID_EMPLFONC;".
                        "ID_CATE;".
                        "ID_FILI;".
                        "ID_CADREMPL;".
                        "ID_GRAD;".
                        "ID_MOTIARRI;".
                        "ID_STAGTITU;".
                        "ID_MOTIDEPA;".
                        "ID_TEMPNONCOMP;".
                        "ID_TEMPPART;".
                        "ID_POURTEMPPART;".
                        "ID_CYCLTRAV;".
                        "ID_TYPEMISSPREV;".
                        "ID_EMPLNONPERM;".
                        "ID_STRUORIG;".
                        "ID_TYPECDD;".
                        "ID_CADREEMPORIG;".
                        "ID_MOTIENTRDEP;".
                        "ID_MOTIENTRRET;".
                        "LB_MOTIN4DS;".
                        "LB_MOTIARRIN4DS;".
                        "LB_MODAN4DS;".
                        "LB_STATJURIN4DS;".
                        "LB_INTICONTTRAVN4DS;".
                        "LB_POSISTATN4DS;".
                        "LB_POSISTATNONREMUN4DS;".
                        "LB_GRADEN4DS;".
                        "LB_GRADEORIGN4DS;".
                        "BL_STRUORIGPOSISTAT;".
                        "DT_CHANSTAT;".
                        "BL_POSIACTI;".
                        "BL_POSIACTINONREMU;".
                        "ID_POSISTATNONREMU;".
                        "ID_FILIEMPLFONC;".
                        "ID_FILIINAP;".
                        "LB_NATUREEMPLOIN4DS;".
                        "ID_ACTIONPREV;".
                        "BL_DEMAPART;".
                        "NB_ALLOTEMPINVAAUTRECAS;".
                        "ID_CADREMPLDETA;".
                        "ID_MOUVINTEANNE;".
                        "CD_PROFESSIONCATEGSOCIO;".
                        "PC_FILLGROUP_STATUT;".
                        "PC_FILLGROUP_REMUNERATION;".
                        "PC_FILLGROUP_ABSENCE;".
                        "PC_FILLGROUP_FORMATION;".
                        "PC_FILLGROUP_AUTRE;".
                        "PC_FILLGROUP_RASSCT;".
                        "PC_FILLGROUP_HANDITORIAL;".
                        "PC_FILLGROUP_GPEEC;".
                        "LB_ALERTE_NONPERM_N4DS;".
                        "PC_FILL_AGENT\n");

        fwrite($handle, "ID_ETPRAGENT;".
                        "ID_BILASOCIAGEN;".
                        "NB_HEUR;".
                        "NB_HEUR_ETPR;".
                        "ID_STAT;".
                        "ID_FILI;".
                        "ID_EMPLNONPERM;".
                        "ID_CADREMPL;".
                        "DT_OUT;".
                        "DT_IN;".
                        "created_at;".
                        "CD_UTILCREA;".
                        "updated_at;".
                        "CD_UTILMODI".
                        "\n");

        fwrite($handle, "ID_ABSEARREAGEN;".
                        "ID_BILASOCIAGEN;".
                        "NB_ARRE;".
                        "NB_JOURABSE;".
                        "ID_MOTIABSE;".
                        "LB_MOTIABSEN4DS;".
                        "id_nature_lesion;".
                        "id_siege_lesion;".
                        "id_element_materiel;".
                        "id_maladie_professionnelle;".
                        "id_type_activite_maladie_pro;".
                        "id_type_activite_arret_travail;".
                        "ACCIDENT_AVEC_ARRET;".
                        "ANNEE_EVENEMENT;".
                        "created_at;".
                        "CD_UTILCREA;".
                        "updated_at;".
                        "CD_UTILMODI".
                        "\n");

        fwrite($handle, "ID_FORMAGEN;".
                        "ID_BILASOCIAGEN;".
                        "NB_JOUR_FORM;".
                        "ID_ORGAFORM;".
                        "ID_FORM;".
                        "BL_CPF;".
                        "created_at;".
                        "CD_UTILCREA;".
                        "updated_at;".
                        "CD_UTILMODI".
                        "\n");

        foreach ($array_etpr_agents as $ea) {
            $key = $ea->ID_BILASOCIAGEN . "-";

            $current = $ea->ID_ETPRAGENT
                     . ";" . $ea->ID_BILASOCIAGEN . ";" . $ea->NB_HEUR
                     . ";" . $ea->NB_HEUR_ETPR
                     . ";" . $ea->ID_STAT
                     . ";" . $ea->ID_FILI
                     . ";" . $ea->ID_EMPLNONPERM
                     . ";" . $ea->ID_CADREMPL
                     . ";" . $ea->DT_OUT
                     . ";" . $ea->DT_IN
                     . ";" . $ea->created_at
                     . ";" . $ea->CD_UTILCREA
                     . ";" . $ea->updated_at
                     . ";" . $ea->CD_UTILMODI
                     . "\n";

            if (array_key_exists($key, $eaArray)) {
                $contenu =  $eaArray[$key];
                $eaArray[$key] = $contenu . $current;
            }
            else {
                $eaArray[$key] = $current;
            }
        }

        foreach ($array_absences as $abs) {
            $key = $abs->ID_BILASOCIAGEN . "-";

            $current = $abs->ID_ABSEARREAGEN
                    . ";" . $abs->ID_BILASOCIAGEN
                    . ";" . $abs->NB_ARRE
                    . ";" . $abs->NB_JOURABSE
                    . ";" . $abs->ID_MOTIABSE
                    . ";" . $abs->LB_MOTIABSEN4DS
                    . ";" . $abs->id_nature_lesion
                    . ";" . $abs->id_siege_lesion
                    . ";" . $abs->id_element_materiel
                    . ";" . $abs->id_maladie_professionnelle
                    . ";" . $abs->id_type_activite_maladie_pro
                    . ";" . $abs->id_type_activite_arret_travail
                    . ";" . $abs->ACCIDENT_AVEC_ARRET
                    . ";" . $abs->ANNEE_EVENEMENT
                    . ";" . $abs->created_at
                    . ";" . $abs->CD_UTILCREA
                    . ";" . $abs->updated_at
                    . ";" . $abs->CD_UTILMODI
                     . "\n";

            if (array_key_exists($key, $absArray)) {
                $contenu =  $absArray[$key];
                $absArray[$key] = $contenu . $current;
            }
            else {
                $absArray[$key] = $current;
            }
        }

        foreach ($array_formations as $form) {
            $key = $form->ID_BILASOCIAGEN . "-";

            $current = $form->ID_FORMAGEN
                     . ";" . $form->ID_BILASOCIAGEN
                     . ";" . $form->NB_JOUR_FORM
                     . ";" . $form->ID_ORGAFORM
                     . ";" . $form->ID_FORM
                     . ";" . $form->BL_CPF
                     . ";" . $form->created_at
                     . ";" . $form->CD_UTILCREA
                     . ";" . $form->updated_at
                     . ";" . $form->CD_UTILMODI
                     . "\n";

            if (array_key_exists($key, $formArray)) {
                $contenu =  $formArray[$key];
                $formArray[$key] = $contenu . $current;
            }
            else {
                $formArray[$key] = $current;
            }
        }

        foreach ($array_bsas as $bsa) {
            $line = $bsa->ID_BILASOCIAGEN . ";" . $bsa->ID_ENQU . ";" . $bsa->LB_NOM . ";" . $bsa->LB_PREN
                    . ";" . $bsa->LB_DATENAIS . ";" . $bsa->CD_SEXE . ";" . $bsa->BL_BOETH. ";" . $bsa->BL_AGENREMU3112
                    . ";" . $bsa->BL_AGENREMUANNE
                    . ";" . $bsa->BL_AGENARRIANNECOLL
                    . ";" . $bsa->BL_EMPLFONC
                    . ";" . $bsa->ID_GRADDETA
                    . ";" . $bsa->DT_DETAEMPLFONC
                    . ";" . $bsa->DT_ARRISTAT
                    . ";" . $bsa->BL_ACQUSTATANNE
                    . ";" . $bsa->BL_AGENTITUSTAGANNE
                    . ";" . $bsa->BL_TITULOISAUVAANNE
                    . ";" . $bsa->BL_RECRSANSCONCSELEPROF
                    . ";" . $bsa->LB_DATEDEPACOLL
                    . ";" . $bsa->CD_MOTIDECE
                    . ";" . $bsa->BL_PROMAVANSTAGANNE
                    . ";" . $bsa->BL_TEMPCOMP
                    . ";" . $bsa->BL_TEMPPLEIN
                    . ";" . $bsa->NB_DEMAPART
                    . ";" . $bsa->NB_DEMAPARTACCE
                    . ";" . $bsa->NB_PREMDEMASATI
                    . ";" . $bsa->NB_MODIEMPLPERMTEMPCOMP
                    . ";" . $bsa->NB_AGENEMPLTEMPCOMPNONRENOU
                    . ";" . $bsa->MT_REMUANNUBRUT
                    . ";" . $bsa->MT_TOTAREMUPRIMINDEM
                    . ";" . $bsa->MT_TOTAREMUBRUTNBI
                    . ";" . $bsa->MT_TOTAREMUBRUTHEURSUPP
                    . ";" . $bsa->NB_HEURSUPP
                    . ";" . $bsa->NB_HEURCOMPREALREMU
                    . ";" . $bsa->BL_AGENABSE
                    . ";" . $bsa->NB_ALLOTEMPINVTRAV
                    . ";" . $bsa->NB_ALLOTEMPINVAPRO
                    . ";" . $bsa->BL_CONGPATEACCUENFA
                    . ";" . $bsa->NB_JOURCONGPATEACCUENFA
                    . ";" . $bsa->BL_ENTRDEPACONG
                    . ";" . $bsa->BL_ENTRRETOCONG
                    . ";" . $bsa->BL_CET
                    . ";" . $bsa->BL_CETOUVERT
                    . ";" . $bsa->NB_JOURCUMU3112
                    . ";" . $bsa->NB_JOURVERS3112
                    . ";" . $bsa->NB_JOURDEPE3112
                    . ";" . $bsa->NB_JOURINDE3112
                    . ";" . $bsa->NB_JOURPRISRAFP3112
                    . ";" . $bsa->BL_TELETRAV
                    . ";" . $bsa->BL_AGENPREV
                    . ";" . $bsa->BL_DEMAINAP
                    . ";" . $bsa->ID_INAPDEMA
                    . ";" . $bsa->BL_DECIINAP
                    . ";" . $bsa->ID_INAPDECI
                    . ";" . $bsa->BL_FORMSUIV
                    . ";" . $bsa->BL_VAE
                    . ";" . $bsa->ID_EBCF
                    . ";" . $bsa->BL_BILACOMP
                    . ";" . $bsa->NB_BILACOMP
                    . ";" . $bsa->BL_CONGFORM
                    . ";" . $bsa->BL_CDI
                    . ";" . $bsa->FG_STAT
                    . ";" . $bsa->created_at
                    . ";" . $bsa->updated_at
                    . ";" . $bsa->ID_POSISTAT
                    . ";" . $bsa->ID_STAT
                    . ";" . $bsa->ID_FONCPUBL
                    . ";" . $bsa->ID_EMPLFONC
                    . ";" . $bsa->ID_CATE
                    . ";" . $bsa->ID_FILI
                    . ";" . $bsa->ID_CADREMPL
                    . ";" . $bsa->ID_GRAD
                    . ";" . $bsa->ID_MOTIARRI
                    . ";" . $bsa->ID_STAGTITU
                    . ";" . $bsa->ID_MOTIDEPA
                    . ";" . $bsa->ID_TEMPNONCOMP
                    . ";" . $bsa->ID_TEMPPART
                    . ";" . $bsa->ID_POURTEMPPART
                    . ";" . $bsa->ID_CYCLTRAV
                    . ";" . $bsa->ID_TYPEMISSPREV
                    . ";" . $bsa->ID_EMPLNONPERM
                    . ";" . $bsa->ID_STRUORIG
                    . ";" . $bsa->ID_TYPECDD
                    . ";" . $bsa->ID_CADREEMPORIG
                    . ";" . $bsa->ID_MOTIENTRDEP
                    . ";" . $bsa->ID_MOTIENTRRET
                    . ";" . $bsa->LB_MOTIN4DS
                    . ";" . $bsa->LB_MOTIARRIN4DS
                    . ";" . $bsa->LB_MODAN4DS
                    . ";" . $bsa->LB_STATJURIN4DS
                    . ";" . $bsa->LB_INTICONTTRAVN4DS
                    . ";" . $bsa->LB_POSISTATN4DS
                    . ";" . $bsa->LB_POSISTATNONREMUN4DS
                    . ";" . $bsa->LB_GRADEN4DS
                    . ";" . $bsa->LB_GRADEORIGN4DS
                    . ";" . $bsa->BL_STRUORIGPOSISTAT
                    . ";" . $bsa->DT_CHANSTAT
                    . ";" . $bsa->BL_POSIACTI
                    . ";" . $bsa->BL_POSIACTINONREMU
                    . ";" . $bsa->ID_POSISTATNONREMU
                    . ";" . $bsa->ID_FILIEMPLFONC
                    . ";" . $bsa->ID_FILIINAP
                    . ";" . $bsa->LB_NATUREEMPLOIN4DS
                    . ";" . $bsa->ID_ACTIONPREV
                    . ";" . $bsa->BL_DEMAPART
                    . ";" . $bsa->NB_ALLOTEMPINVAAUTRECAS
                    . ";" . $bsa->ID_CADREMPLDETA
                    . ";" . $bsa->ID_MOUVINTEANNE
                    . ";" . $bsa->CD_PROFESSIONCATEGSOCIO
                    . ";" . $bsa->PC_FILLGROUP_STATUT
                    . ";" . $bsa->PC_FILLGROUP_REMUNERATION
                    . ";" . $bsa->PC_FILLGROUP_ABSENCE
                    . ";" . $bsa->PC_FILLGROUP_FORMATION
                    . ";" . $bsa->PC_FILLGROUP_AUTRE
                    . ";" . $bsa->PC_FILLGROUP_RASSCT
                    . ";" . $bsa->PC_FILLGROUP_HANDITORIAL
                    . ";" . $bsa->PC_FILLGROUP_GPEEC
                    . ";" . $bsa->LB_ALERTE_NONPERM_N4DS
                    . ";" . $bsa->PC_FILL_AGENT
                   ;

            fwrite($handle, $line."\n");
            $key = $bsa->ID_BILASOCIAGEN . "-";

            if (array_key_exists($key, $eaArray)) {
                fwrite($handle, $eaArray[$key]);
            }

            if (array_key_exists($key, $absArray)) {
                fwrite($handle, $absArray[$key]);
            }

            if (array_key_exists($key, $formArray)) {
                fwrite($handle, $formArray[$key]);
            }
        }

        fwrite($handle, "test;fin\n");
        fclose($handle); // ferme le fichier
        
        $content = ob_get_clean();
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'Application/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename=texte.csv');
        $response->setContent($content);

        return $response;*/
        return $this->render('@Apa/export/apa_export_index.html.twig',array(
            'sheets'=>$config_finder->getConfig('apa_export', "sheets"),
            'data'=>$data
        ));
    }



//    protected function getProgressBarValue($jsonContent,$bilanSocialAgent){
//
////        dump($bilanSocialAgent);
////        dump($jsonContent);
//        foreach($jsonContent as $key => $key_tabs){
//            $current_value = 0;
//            if(isset($key_tabs['entity_field_key'])){
//                $entity_key = ucfirst($key_tabs['entity_field_key']);
//                $testFunction = "get".$entity_key;
//                $current_value = $bilanSocialAgent->$testFunction();
//            }
//            if(isset($key_tabs['conditions'])){
//                foreach($key_tabs['conditions'] as $key => $condition_tab){
//                    foreach($condition_tab as $key1 => $current_condition ){
//                        if(is_string($current_condition) && $current_condition !== 'DEFAULT' ){
//                          $condition =  'return ' . str_replace(":current_value", $current_value, $current_condition). ';';
//                          dump($condition);
//                            if(eval($condition)){
//                              dump('toto');
//                            }
//                        }
//
//                    }
////
//                }
//            }
////
////            dump($key_tabs);
////            dump($current_value);
//        }
//
//        exit();
//
//    }

}
