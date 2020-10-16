<?php

namespace Bilan_Social\Bundle\ApaBundle\Controller;

use Bilan_Social\Bundle\ApaBundle\Entity\ActeViolencePhysique;
use Bilan_Social\Bundle\ApaBundle\Entity\ActionPrevention;
use Bilan_Social\Bundle\ApaBundle\Entity\ConflitTravail;
use Bilan_Social\Bundle\ApaBundle\Entity\Etpr114AnneePrecedente;
use Bilan_Social\Bundle\ApaBundle\Entity\Etpr124AnneePrecedente;
use Bilan_Social\Bundle\ApaBundle\Entity\Etpr131AnneePrecedente;
use Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_132;
use Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_157;
use Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_215;
use Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_216;
use Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent;
use Bilan_Social\Bundle\ApaBundle\Entity\Prevoyance;
use Bilan_Social\Bundle\ApaBundle\Entity\Sante;
use Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaire;
use Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaireStagiaire;
use Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaireContractuel;
use Bilan_Social\Bundle\ApaBundle\Entity\MotifSanctionDisciplinaire;
use Bilan_Social\Bundle\ApaBundle\Form\InformationColectiviteAgentType;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Informationcolectiviteagent controller.
 *
 */
class InformationColectiviteAgentController extends AbstractBSController {

    /**
     * Creates a new informationColectiviteAgent entity.
     *
     */
    public function newAction(Request $request) {
        
        $user = $this->getUser();
        $session = $this->get('session');
        if (null == $session->get('coll_id')) {
            $idCollectivity = $user->getCollectivite()->getIdColl();
        } else {
            $idCollectivity = $session->get('coll_id');
        }
        $em = $this->getDoctrine()->getManager();
        $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $enqueteCollectivite = $this->getMonEnqueteCollectiviteActive();
        
        $enquete = $this->getMonEnquete();

        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($idCollectivity);
        
        $informationColectiviteAgent = new Informationcolectiviteagent();
        $informationGenerales = $em->getRepository('ApaBundle:InformationGenerale')->findOneBy(array('collectivite' => $idCollectivity, 'enquete' => $enquete->getIdEnqu()));
        $sante = $em->getRepository('ApaBundle:Sante')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
        $refMotifGreve = $em->getRepository('ReferencielBundle:RefMotifGreve')->findBy(array('blVali' => false));
        $refFiliere = $em->getRepository('ReferencielBundle:RefFiliere')->findBy(array('blVali' => false,  ));
        $RefActeViolencePhysique = $em->getRepository('ReferencielBundle:RefActeViolencePhysique')->findBy(array('blVali' => false));
        $RefEmploiNonPermanent = $em->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findBy(array('blVali' => false));
        $RefCategorie = $em->getRepository('ReferencielBundle:RefCategorie')->findBy(array('blVali' => false));
        $RefActionPrevention = $em->getRepository('ReferencielBundle:RefActionPrevention')->findBy(array('blVali' => false));
        $RefSanctionDisciplinaireTitulaire = $em->getRepository('ReferencielBundle:RefSanctionDisciplinaire')->findByTitulaire();
        $RefSanctionDisciplinaireStagiaire = $em->getRepository('ReferencielBundle:RefSanctionDisciplinaire')->findByStagiaire();
        $RefSanctionDisciplinaireContractuel= $em->getRepository('ReferencielBundle:RefSanctionDisciplinaire')->findByContractuel();
        $RefMotifSanctionDisciplinaire = $em->getRepository('ReferencielBundle:RefMotifSanctionDisciplinaire')->findBy(array('blVali' => false));
        $actionPrevention = $em->getRepository('ApaBundle:ActionPrevention')->findBycollectivite($informationColectiviteAgent->getIdInfocollagen());
        $InfoColl132 = $em->getRepository('ApaBundle:InfoColl_132')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
        $InfoColl157 = $em->getRepository('ApaBundle:InfoColl_157')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
        $InfoColl215 = $em->getRepository('ApaBundle:InfoColl_215')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
        $InfoColl216 = $em->getRepository('ApaBundle:InfoColl_216')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
//        $Etpr114AnneePrecedente = $em->getRepository('ApaBundle:Etpr114AnneePrecedente')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
//        $Etpr124AnneePrecedente = $em->getRepository('ApaBundle:Etpr124AnneePrecedente')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
        $SanctionDisciplinairesTitulaire = $em->getRepository('ApaBundle:SanctionDisciplinaire')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
        $SanctionDisciplinairesStagiaire = $em->getRepository('ApaBundle:SanctionDisciplinaireStagiaire')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
        $SanctionDisciplinairesContractuel = $em->getRepository('ApaBundle:SanctionDisciplinaireContractuel')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
        $MotifSanctionDisciplinaires = $em->getRepository('ApaBundle:MotifSanctionDisciplinaire')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
        $prevoyances = $em->getRepository('ApaBundle:Prevoyance')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
        $acteViolencePhysiques = $em->getRepository('ApaBundle:ActeViolencePhysique')->findBycollectivite($informationColectiviteAgent->getIdInfocollagen());
        $Etpr131AnneePrecedente = $em->getRepository('ApaBundle:Etpr131AnneePrecedente')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
        $ConflitTravails = $em->getRepository('ApaBundle:ConflitTravail')->findBycollectivite($informationColectiviteAgent->getIdInfocollagen());

        // $listAllAgents = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllStatuts($enquete, $collectivite);
        // dump($listAllAgents); exit();

        if (count($ConflitTravails) === 0) {

            foreach ($refMotifGreve as $index => $MotifGreve) {
                $var_name = 'ConflitTravail' . $index;
                $$var_name = new ConflitTravail();
                $$var_name->setCollectivite($informationColectiviteAgent);
                $$var_name->setRefMotifGreve($MotifGreve);
                $informationColectiviteAgent->getConflitTravail()->add($$var_name);
            }
        }
        if (count($acteViolencePhysiques) === 0) {

            foreach ($RefActeViolencePhysique as $index => $ActeViolencePhysique) {
                $var_name = 'ActeViolencePhysique' . $index;
                $$var_name = new ActeViolencePhysique();
                $$var_name->setCollectivite($informationColectiviteAgent);
                $$var_name->setRefActeViolencePhysique($ActeViolencePhysique);
                $informationColectiviteAgent->getActeViolencePhysique()->add($$var_name);
            }
        }

        if (count($RefEmploiNonPermanent) === 0) {


            foreach ($RefEmploiNonPermanent as $index => $EmploiNonPermanent) {


                $var_name = 'EmploiNonPermanent' . $index;
                $$var_name = new Etpr131AnneePrecedente();
                $$var_name->setIdInfocollagen($informationColectiviteAgent);
                $$var_name->setRefEmploiNonPermanent($EmploiNonPermanent);
                $informationColectiviteAgent->getEtpr131AnneePrecedente()->add($$var_name);
            }
        }

        if (count($actionPrevention) === 0) {

            
            
            foreach ($RefActionPrevention as $index => $ActionPrevention) {

                $var_name = 'ActionPrevention' . $index;
                $$var_name = new ActionPrevention();
                $$var_name->setCollectivite($informationColectiviteAgent);
                $$var_name->setRefActionPreventions($ActionPrevention);
                $informationColectiviteAgent->getActionPrevention()->add($$var_name);
                
            }
          
        }
        if (count($InfoColl132) === 0) {
            foreach ($refFiliere as $key => $filiere){
                if(!in_array($filiere->getCdFili(), ['H','HH','AOTM']) ){
                    $Info_Coll_132 = new InfoColl_132();
                    $Info_Coll_132->setIdInfocollagen($informationColectiviteAgent);
                    $Info_Coll_132->setRefFiliere($filiere);
                    $Info_Coll_132->name = 'InfoColl132';
                    $informationColectiviteAgent->getInfoColl132()->add($Info_Coll_132);
                }

            }
        }

        if (count($InfoColl157) === 0) {
            foreach ($RefCategorie as $key => $categorie){
                if(in_array($categorie->getCdCate(),['A','B','C']) ){
                    $Info_Coll_157 = new InfoColl_157();
                    $Info_Coll_157->setIdInfocollagen($informationColectiviteAgent);
                    $Info_Coll_157->setRefCategorie($categorie);
                    $Info_Coll_157->name = 'InfoColl157';
                    $informationColectiviteAgent->getInfoColl157()->add($Info_Coll_157);
                }

            }
        }

        if (count($InfoColl215) === 0) {
            foreach ($RefCategorie as $key => $categorie){
                if(in_array($categorie->getCdCate(),['A','B','C']) ){
                    $Info_Coll_215 = new InfoColl_215();
                    $Info_Coll_215->setIdInfocollagen($informationColectiviteAgent);
                    $Info_Coll_215->setRefCategorie($categorie);
                    $Info_Coll_215->name = 'InfoColl215';
                    $informationColectiviteAgent->getInfoColl215()->add($Info_Coll_215);
                }

            }
        }
        
        if (count($InfoColl216) === 0) {
            foreach ($RefCategorie as $key => $categorie){
                if(in_array($categorie->getCdCate(),['A','B','C']) ){
                    $Info_Coll_216 = new InfoColl_216();
                    $Info_Coll_216->setIdInfocollagen($informationColectiviteAgent);
                    $Info_Coll_216->setRefCategorie($categorie);
                    $Info_Coll_216->name = 'InfoColl216';
                    $informationColectiviteAgent->getInfoColl216()->add($Info_Coll_216);
                }

            }
        }

//        if (count($Etpr114AnneePrecedente) === 0) {
//
//            foreach ($refFiliere as $index => $filiere) {
//                $var_name = 'Etpr_114_Annee_Precedente' . $index;
//                $$var_name = new Etpr114AnneePrecedente();
//                $$var_name->setIdInfocollagen($informationColectiviteAgent);
//                $$var_name->setRefFiliere($filiere);
//                $informationColectiviteAgent->getEtpr114AnneePrecedente()->add($$var_name);
//            }
//        }
        if (count($SanctionDisciplinairesTitulaire) === 0) {
            
            foreach ($RefSanctionDisciplinaireTitulaire as $index => $SanctionDisciplinaire) {
                $var_name = 'Sanction_Disciplinaire' . $index;
                $$var_name = new SanctionDisciplinaire();
                $$var_name->setIdInfocollagen($informationColectiviteAgent);
                $$var_name->setRefSanctionDisciplinaire($SanctionDisciplinaire);
                $informationColectiviteAgent->getAgentSanctionDisciplinaire()->add($$var_name);
            }
        }

        if (count($SanctionDisciplinairesStagiaire) === 0) {

            foreach ($RefSanctionDisciplinaireStagiaire as $index => $SanctionDisciplinaires) {
                $var_name = 'Sanction_Disciplinaire_Stagiaire' . $index;
                $$var_name = new SanctionDisciplinaireStagiaire();
                $$var_name->setIdInfocollagen($informationColectiviteAgent);
                $$var_name->setRefSanctionDisciplinaire($SanctionDisciplinaires);
                $informationColectiviteAgent->getAgentSanctionDisciplinaireStagiaire()->add($$var_name);
            }
        }

        if (count($SanctionDisciplinairesContractuel) === 0) {

            foreach ($RefSanctionDisciplinaireContractuel as $index => $SanctionDisciplinaires) {
                $var_name = 'Sanction_Disciplinaire_Contractuel' . $index;
                $$var_name = new SanctionDisciplinaireContractuel();
                $$var_name->setIdInfocollagen($informationColectiviteAgent);
                $$var_name->setRefSanctionDisciplinaire($SanctionDisciplinaires);
                $informationColectiviteAgent->getAgentSanctionDisciplinaireContractuel()->add($$var_name);
            }
        }

        if (count($MotifSanctionDisciplinaires) === 0) {
            
            foreach ($RefMotifSanctionDisciplinaire as $index => $MotifSanctionDisciplinaire) {
                $var_name = 'Motif_Sanction_Disciplinaire' . $index;
                $$var_name = new MotifSanctionDisciplinaire();
                $$var_name->setIdInfocollagen($informationColectiviteAgent);
                $$var_name->setRefMotifSanctionDisciplinaire($MotifSanctionDisciplinaire);
                $informationColectiviteAgent->getAgentMotifSanctionDisciplinaire()->add($$var_name);
            }
        }
//        if (count($Etpr124AnneePrecedente) === 0) {
//
//            foreach ($refFiliere as $index => $filiere) {
//                $var_name = 'Etpr_124_Annee_Precedente' . $index;
//                $$var_name = new Etpr124AnneePrecedente();
//                $$var_name->setIdInfocollagen($informationColectiviteAgent);
//                $$var_name->setRefFiliere($filiere);
//                $informationColectiviteAgent->getEtpr124AnneePrecedente()->add($$var_name);
//            }
//        }
        if (count($Etpr131AnneePrecedente) === 0) {

            foreach ($RefEmploiNonPermanent as $index => $EmploiNonPermanent) {
                $var_name = 'Etpr_131_Annee_Precedente' . $index;
                $$var_name = new Etpr131AnneePrecedente();
                $$var_name->setIdInfocollagen($informationColectiviteAgent);
                $$var_name->setRefEmploiNonPermanent($EmploiNonPermanent);
                $informationColectiviteAgent->getEtpr131AnneePrecedente()->add($$var_name);
            }
        }
        if (count($sante) === 0) {
            foreach ($RefCategorie as $index => $categorie) {
                $var_name = 'Sante' . $index;
                $$var_name = new Sante();
                $$var_name->setIdInfocollagen($informationColectiviteAgent);
                $$var_name->setRefCategorie($categorie);
                $informationColectiviteAgent->getSante()->add($$var_name);
            }
        }
        if (count($prevoyances) === 0) {
            foreach ($RefCategorie as $index => $categorie) {
                $var_name = 'Prevoyance' . $index;
                $$var_name = new Prevoyance();
                $$var_name->setIdInfocollagen($informationColectiviteAgent);
                $$var_name->setRefCategorie($categorie);
                $informationColectiviteAgent->getprevoyance()->add($$var_name);
            }
        }

        $campagne = $this->getMaCampagne();
        
        $informationColectiviteAgent->setCollectivite($collectivite);
        $informationColectiviteAgent->setEnquete($enquete);
        $form = $this->createForm(InformationColectiviteAgentType::class, $informationColectiviteAgent, array('enqueteCollectivite' => $enqueteCollectivite,'anneeCamp' => $campagne->getNmAnne()) );
        $form->handleRequest($request);
        
        $pcOnglets = $informationColectiviteAgent->getPcOnglets();
        $array_pc_bool = $this->getOngletsTabBool($pcOnglets);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $onglet_name = $form->getClickedButton()->getName();
            $pcOnglets = $this->updatePcOngletByName($onglet_name,$pcOnglets);
            $informationColectiviteAgent->setPcOnglets($pcOnglets);

            $InformationCollectivite = $em->getRepository('ApaBundle:InformationColectiviteAgent')->GetInformationCollectivite($idCollectivity, $enquete->getIdEnqu(), $campagne->getIdCamp());
            
           
             if(!empty($InformationCollectivite)){
                return $this->redirectToRoute('informationcolectiviteagent_edit',array('idInfocollagen' =>$InformationCollectivite->getIdInfocollagen()) );
            }else{
                $em->persist($informationColectiviteAgent);
                $em->flush();
                $this->addFlash(
                        'notice', $this->get('translator')->trans('new.informationcollectivite.flash')
                );
                return $this->redirectToRoute('informationcolectiviteagent_edit',array('idInfocollagen' =>$informationColectiviteAgent->getIdInfocollagen()) );
            }
        }
        $listeAgent = false;
        return $this->render('@Apa/informationcolectiviteagent/new.html.twig', array(
                    'informationColectiviteAgent' => $informationColectiviteAgent,
                    'form' => $form->createView(),
                    'informationGenerales' => $informationGenerales,
                    'campagne'                    => $campagne,
                    'enquetecoll'                 => $enqueteCollectivite,
                    'array_pc_bool'                 => $array_pc_bool,
                    'listeAgent'                  => $listeAgent,
                    'collectivite'                => $collectivite
        ));
    }

    /**
     * Finds and displays a informationColectiviteAgent entity.
     *
     */
    public function showAction(InformationColectiviteAgent $informationColectiviteAgent) {
        if($this->checkIsUserOwnerOf($informationColectiviteAgent)){
            $deleteForm = $this->createDeleteForm($informationColectiviteAgent);

            return $this->render('@Apa/informationcolectiviteagent/show.html.twig', array(
                        'informationColectiviteAgent' => $informationColectiviteAgent,
                        'delete_form' => $deleteForm->createView(),
            ));
        }else{
            return $this->redirectToRoute('bilansocialagent_index');
        }
    }

    /**
     * Displays a form to edit an existing informationColectiviteAgent entity.
     *
     */
    public function editAction(Request $request, InformationColectiviteAgent $informationColectiviteAgent) {
        if($this->checkIsUserOwnerOf($informationColectiviteAgent)){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $session = $this->get('session');
            if (null == $session->get('coll_id')) {
                $idCollectivity = $user->getCollectivite()->getIdColl();
            } else {
                $idCollectivity = $session->get('coll_id');
            }
            $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($idCollectivity);
            $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
            $enquete = $this->getMonEnquete();
            $enqueteCollectivite = $this->getMonEnqueteCollectiviteActive();
            
            $informationColectiviteAgent = $em->getRepository('ApaBundle:InformationColectiviteAgent')->findOneBy(array('collectivite' => $idCollectivity, 'enquete' => $enquete->getIdEnqu()));
            $informationGenerales = $em->getRepository('ApaBundle:InformationGenerale')->findOneBy(array('collectivite' => $idCollectivity, 'enquete' => $enquete->getIdEnqu()));
            $sante = $em->getRepository('ApaBundle:Sante')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
            $refMotifGreve = $em->getRepository('ReferencielBundle:RefMotifGreve')->findBy(array('blVali' => false));
            $refFiliere = $em->getRepository('ReferencielBundle:RefFiliere')->findBy(array('blVali' => false));
            $RefActeViolencePhysique = $em->getRepository('ReferencielBundle:RefActeViolencePhysique')->findBy(array('blVali' => false));
            $RefEmploiNonPermanent = $em->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findBy(array('blVali' => false));
            $RefActionPrevention = $em->getRepository('ReferencielBundle:RefActionPrevention')->findBy(array('blVali' => false));
            $RefCategorie = $em->getRepository('ReferencielBundle:RefCategorie')->findBy(array('blVali' => false));
            $RefMotifSanctionDisciplinaire = $em->getRepository('ReferencielBundle:RefMotifSanctionDisciplinaire')->findBy(array('blVali' => false));
            $RefSanctionDisciplinaireTitulaire = $em->getRepository('ReferencielBundle:RefSanctionDisciplinaire')->findByTitulaire();
            $RefSanctionDisciplinaireStagiaire = $em->getRepository('ReferencielBundle:RefSanctionDisciplinaire')->findByStagiaire();
            $RefSanctionDisciplinaireContractuel= $em->getRepository('ReferencielBundle:RefSanctionDisciplinaire')->findByContractuel();
            $actionPrevention = $em->getRepository('ApaBundle:ActionPrevention')->findBycollectivite($informationColectiviteAgent->getIdInfocollagen());
            $InfoColl132 = $em->getRepository('ApaBundle:InfoColl_132')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
            $InfoColl157 = $em->getRepository('ApaBundle:InfoColl_157')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
            $InfoColl215 = $em->getRepository('ApaBundle:InfoColl_215')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
            $InfoColl216 = $em->getRepository('ApaBundle:InfoColl_216')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
//            $Etpr114AnneePrecedente = $em->getRepository('ApaBundle:Etpr114AnneePrecedente')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
//            $Etpr124AnneePrecedente = $em->getRepository('ApaBundle:Etpr124AnneePrecedente')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
            $SanctionDisciplinairesTitulaire = $em->getRepository('ApaBundle:SanctionDisciplinaire')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
            $SanctionDisciplinairesStagiaire = $em->getRepository('ApaBundle:SanctionDisciplinaireStagiaire')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
            $SanctionDisciplinairesContractuel = $em->getRepository('ApaBundle:SanctionDisciplinaireContractuel')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
            $MotifSanctionDisciplinaires = $em->getRepository('ApaBundle:MotifSanctionDisciplinaire')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
            $prevoyances = $em->getRepository('ApaBundle:Prevoyance')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
            $acteViolencePhysiques = $em->getRepository('ApaBundle:ActeViolencePhysique')->findBycollectivite($informationColectiviteAgent->getIdInfocollagen());
            $Etpr131AnneePrecedente = $em->getRepository('ApaBundle:Etpr131AnneePrecedente')->findByIdInfocollagen($informationColectiviteAgent->getIdInfocollagen());
            $ConflitTravails = $em->getRepository('ApaBundle:ConflitTravail')->findBycollectivite($informationColectiviteAgent->getIdInfocollagen());

            if (count($actionPrevention) === 0) {
               
                foreach ($RefActionPrevention as $index => $ActionPrevention) {   

                    $var_name = 'ActionPrevention' . $index;
                    $$var_name = new ActionPrevention();
                    $$var_name->setCollectivite($informationColectiviteAgent);
                    $$var_name->setRefActionPreventions($ActionPrevention);
                    $informationColectiviteAgent->getActionPrevention()->add($$var_name);
                    
                }
            }
                      
            if (count($ConflitTravails) === 0) {

                foreach ($refMotifGreve as $index => $MotifGreve) {
                    $var_name = 'ConflitTravail' . $index;
                    $$var_name = new ConflitTravail();
                    $$var_name->setCollectivite($informationColectiviteAgent);
                    $$var_name->setRefMotifGreve($MotifGreve);
                    $informationColectiviteAgent->getConflitTravail()->add($$var_name);
                }
            }

            if (count($acteViolencePhysiques) === 0) {

                foreach ($RefActeViolencePhysique as $index => $ActeViolencePhysique) {
                    $var_name = 'ActeViolencePhysique' . $index;
                    $$var_name = new ActeViolencePhysique();
                    $$var_name->setCollectivite($informationColectiviteAgent);
                    $$var_name->setRefActeViolencePhysique($ActeViolencePhysique);
                    $informationColectiviteAgent->getActeViolencePhysique()->add($$var_name);
                }
            }

            if (count($RefEmploiNonPermanent) === 0) {

                foreach ($RefEmploiNonPermanent as $index => $EmploiNonPermanent) {

                    $var_name = 'EmploiNonPermanent' . $index;
                    $$var_name = new Etpr131AnneePrecedente();
                    $$var_name->setIdInfocollagen($informationColectiviteAgent);
                    $$var_name->setRefEmploiNonPermanent($EmploiNonPermanent);
                    $informationColectiviteAgent->getEtpr131AnneePrecedente()->add($$var_name);
                }
            }

            if (count($InfoColl132) === 0) {
                foreach ($refFiliere as $key => $filiere){
                    if(!in_array($filiere->getCdFili(), ['H','HH','AOTM']) ){
                        $Info_Coll_132 = new InfoColl_132();
                        $Info_Coll_132->setIdInfocollagen($informationColectiviteAgent);
                        $Info_Coll_132->setRefFiliere($filiere);
                        $Info_Coll_132->name = 'InfoColl132';
                        $informationColectiviteAgent->getInfoColl132()->add($Info_Coll_132);
                    }
                }
            }

            if (count($InfoColl157) === 0) {
                foreach ($RefCategorie as $key => $categorie){
                    if(in_array($categorie->getCdCate(),['A','B','C']) ){
                        $Info_Coll_157 = new InfoColl_157();
                        $Info_Coll_157->setIdInfocollagen($informationColectiviteAgent);
                        $Info_Coll_157->setRefCategorie($categorie);
                        $Info_Coll_157->name = 'InfoColl157';
                        $informationColectiviteAgent->getInfoColl157()->add($Info_Coll_157);
                    }

                }
            }
            
            if (count($InfoColl215) === 0) {
                foreach ($RefCategorie as $key => $categorie){
                    if(in_array($categorie->getCdCate(),['A','B','C']) ){
                        $Info_Coll_215 = new InfoColl_215();
                        $Info_Coll_215->setIdInfocollagen($informationColectiviteAgent);
                        $Info_Coll_215->setRefCategorie($categorie);
                        $Info_Coll_215->name = 'InfoColl215';
                        $informationColectiviteAgent->getInfoColl215()->add($Info_Coll_215);
                    }

                }
            }

              if (count($InfoColl216) === 0) {
                        foreach ($RefCategorie as $key => $categorie){
                            if(in_array($categorie->getCdCate(),['A','B','C']) ){
                                $Info_Coll_216 = new InfoColl_216();
                                $Info_Coll_216->setIdInfocollagen($informationColectiviteAgent);
                                $Info_Coll_216->setRefCategorie($categorie);
                                $Info_Coll_216->name = 'InfoColl216';
                                $informationColectiviteAgent->getInfoColl216()->add($Info_Coll_216);
                            }
        
                        }
                    }


//            if (count($Etpr114AnneePrecedente) === 0) {
//
//                foreach ($refFiliere as $index => $filiere) {
//                    $var_name = 'Etpr_114_Annee_Precedente' . $index;
//                    $$var_name = new Etpr114AnneePrecedente();
//                    $$var_name->setIdInfocollagen($informationColectiviteAgent);
//                    $$var_name->setRefFiliere($filiere);
//                    $informationColectiviteAgent->getEtpr114AnneePrecedente()->add($$var_name);
//                }
//            } else {
//                foreach ($refFiliere as $index => $filiere) {
//                    $Etpr114 = $em->getRepository('ApaBundle:Etpr114AnneePrecedente')->findOneBy(array('RefFiliere' => $filiere->getIdFili(), 'idInfocollagen' => $informationColectiviteAgent->getIdInfocollagen()));
//                    if (empty($Etpr114)) {
//                        $var_name = 'Etpr_114_Annee_Precedente' . $index;
//                        $$var_name = new Etpr114AnneePrecedente();
//                        $$var_name->setIdInfocollagen($informationColectiviteAgent);
//                        $$var_name->setRefFiliere($filiere);
//                        $informationColectiviteAgent->getEtpr114AnneePrecedente()->add($$var_name);
//                    }
//                }
//            }
            
//            if (count($Etpr124AnneePrecedente) === 0) {
//
//                foreach ($refFiliere as $index => $filiere) {
//                    $var_name = 'Etpr_124_Annee_Precedente' . $index;
//                    $$var_name = new Etpr124AnneePrecedente();
//                    $$var_name->setIdInfocollagen($informationColectiviteAgent);
//                    $$var_name->setRefFiliere($filiere);
//                    $informationColectiviteAgent->getEtpr124AnneePrecedente()->add($$var_name);
//                }
//            } else {
//                foreach ($refFiliere as $index => $filiere) {
//                    $Etpr124 = $em->getRepository('ApaBundle:Etpr124AnneePrecedente')->findOneBy(array('RefFiliere' => $filiere->getIdFili(), 'idInfocollagen' => $informationColectiviteAgent->getIdInfocollagen()));
//                    if (empty($Etpr124)) {
//                        $var_name = 'Etpr_124_Annee_Precedente' . $index;
//                        $$var_name = new Etpr124AnneePrecedente();
//                        $$var_name->setIdInfocollagen($informationColectiviteAgent);
//                        $$var_name->setRefFiliere($filiere);
//                        $informationColectiviteAgent->getEtpr124AnneePrecedente()->add($$var_name);
//                    }
//                }
//            }
            
            if (count($Etpr131AnneePrecedente) === 0) {

                foreach ($RefEmploiNonPermanent as $index => $EmploiNonPermanent) {
                    $var_name = 'Etpr_131_Annee_Precedente' . $index;
                    $$var_name = new Etpr131AnneePrecedente();
                    $$var_name->setIdInfocollagen($informationColectiviteAgent);
                    $$var_name->setRefEmploiNonPermanent($EmploiNonPermanent);
                    $informationColectiviteAgent->getEtpr131AnneePrecedente()->add($$var_name);
                }
            } else {
                foreach ($RefEmploiNonPermanent as $index => $EmploiNonPermanent) {
                    $Etpr131 = $em->getRepository('ApaBundle:Etpr131AnneePrecedente')->findOneBy(array('RefEmploiNonPermanent' => $EmploiNonPermanent, 'idInfocollagen' => $informationColectiviteAgent->getIdInfocollagen()));
                    if (empty($Etpr131)) {
                        $var_name = 'Etpr_131_Annee_Precedente' . $index;
                        $$var_name = new Etpr131AnneePrecedente();
                        $$var_name->setIdInfocollagen($informationColectiviteAgent);
                        $$var_name->setRefEmploiNonPermanent($EmploiNonPermanent);
                        $informationColectiviteAgent->getEtpr131AnneePrecedente()->add($$var_name);
                    }
                }
            }

            if (count($SanctionDisciplinairesTitulaire) === 0) {

                foreach ($RefSanctionDisciplinaireTitulaire as $index => $SanctionDisciplinaire) {
                    $var_name = 'Sanction_Disciplinaire' . $index;
                    $$var_name = new SanctionDisciplinaire();
                    $$var_name->setIdInfocollagen($informationColectiviteAgent);
                    $$var_name->setRefSanctionDisciplinaire($SanctionDisciplinaire);
                    $informationColectiviteAgent->getAgentSanctionDisciplinaire()->add($$var_name);
                }
            }

            if (count($SanctionDisciplinairesStagiaire) === 0) {

                foreach ($RefSanctionDisciplinaireStagiaire as $index => $SanctionDisciplinaires) {
                    $var_name = 'Sanction_Disciplinaire_Stagiaire' . $index;
                    $$var_name = new SanctionDisciplinaireStagiaire();
                    $$var_name->setIdInfocollagen($informationColectiviteAgent);
                    $$var_name->setRefSanctionDisciplinaire($SanctionDisciplinaires);
                    $informationColectiviteAgent->getAgentSanctionDisciplinaireStagiaire()->add($$var_name);
                }
            }

            if (count($SanctionDisciplinairesContractuel) === 0) {

                foreach ($RefSanctionDisciplinaireContractuel as $index => $SanctionDisciplinaires) {
                    $var_name = 'Sanction_Disciplinaire_Contractuel' . $index;
                    $$var_name = new SanctionDisciplinaireContractuel();
                    $$var_name->setIdInfocollagen($informationColectiviteAgent);
                    $$var_name->setRefSanctionDisciplinaire($SanctionDisciplinaires);
                    $informationColectiviteAgent->getAgentSanctionDisciplinaireContractuel()->add($$var_name);
                }
            }
            if (count($MotifSanctionDisciplinaires) === 0) {

                foreach ($RefMotifSanctionDisciplinaire as $index => $MotifSanctionDisciplinaire) {
                    $var_name = 'Motif_Sanction_Disciplinaire' . $index;
                    $$var_name = new MotifSanctionDisciplinaire();
                    $$var_name->setIdInfocollagen($informationColectiviteAgent);
                    $$var_name->setRefMotifSanctionDisciplinaire($MotifSanctionDisciplinaire);
                    $informationColectiviteAgent->getAgentMotifSanctionDisciplinaire()->add($$var_name);
                }
            }
            if (count($sante) === 0) {
                foreach ($RefCategorie as $index => $categorie) {
                    $var_name = 'Sante' . $index;
                    $$var_name = new Sante();
                    $$var_name->setIdInfocollagen($informationColectiviteAgent);
                    $$var_name->setRefCategorie($categorie);
                    $informationColectiviteAgent->getSante()->add($$var_name);
                }
            }
            if (count($prevoyances) === 0) {
                foreach ($RefCategorie as $index => $categorie) {
                    $var_name = 'Prevoyance' . $index;
                    $$var_name = new Prevoyance();
                    $$var_name->setIdInfocollagen($informationColectiviteAgent);
                    $$var_name->setRefCategorie($categorie);
                    $informationColectiviteAgent->getprevoyance()->add($$var_name);
                }
            }
            $editForm = $this->createForm(InformationColectiviteAgentType::class, $informationColectiviteAgent, array('enqueteCollectivite' => $enqueteCollectivite,'anneeCamp' => $campagne->getNmAnne()) );
            $deleteForm = $this->createDeleteForm($informationColectiviteAgent);

            $editForm->handleRequest($request);
            $pcOnglets = $informationColectiviteAgent->getPcOnglets();
            $array_pc_bool = $this->getOngletsTabBool($pcOnglets);
            $checked = $this->checkIfAllOngletsIsSave($array_pc_bool);
            
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
    
                // $listAllAgents = $em->getRepository('ApaBundle:BilanSocialAgent')->findBy(array('enquete' => $enquete, 'collectivite' => $collectivite));
                // dump($listAllAgents); exit();
             
                $onglet_name = $editForm->getClickedButton()->getName();
                $pcOnglets = $this->updatePcOngletByName($onglet_name,$pcOnglets);
                $informationColectiviteAgent->setPcOnglets($pcOnglets);
                $em->flush();
                $pcOnglets = $informationColectiviteAgent->getPcOnglets();
                $array_pc_bool = $this->getOngletsTabBool($pcOnglets);
                $checked = $this->checkIfAllOngletsIsSave($array_pc_bool);
                $this->addFlash(
                        'notice', $this->get('translator')->trans('edit.informationcollectivite.flash')
                );
                if($checked['checked']){
                    return $this->redirectToRoute('bilansocialagent_index');
                }else{
                    return $this->redirectToRoute('informationcolectiviteagent_edit', array('idInfocollagen' => $informationColectiviteAgent->getIdInfocollagen(), 'listeAgent' => $checked['checked']));
                }
                
            }
            //ind114
//            $totalR1141 = 0;
//            $totalR1142 = 0;
//            foreach ($Etpr114AnneePrecedente as $Etpr114) {
//                $totalR1141 += $Etpr114->getR1141(0);
//                $totalR1142 += $Etpr114->getR1142(0);
//            }
//            $totalInd114 = $totalR1141 + $totalR1142;

            //ind124
//            $totalR1241 = 0;
//            $totalR1242 = 0;
//            foreach ($Etpr124AnneePrecedente as $Etpr124) {
//                $totalR1241 += $Etpr124->getR1241(0);
//                $totalR1242 += $Etpr124->getR1242(0);
//            }
//            $totalInd124 = $totalR1241 + $totalR1242;

            //ind131
//            $totalR13121 = 0;
//            $totalR13122 = 0;
//            foreach ($Etpr131AnneePrecedente as $Etpr131) {
//                $totalR13121 += $Etpr131->getR13121(0);
//                $totalR13122 += $Etpr131->getR13122(0);
//            }
//            $totalInd131 = $totalR13121 + $totalR13122;

            //ind132
            $totalR1321 = 0;
            $totalR1322 = 0;
            $totalR1323 = 0;
            $totalR1324 = 0;
            foreach ($InfoColl132 as $Info132) {
                $totalR1321 += $Info132->getR1321(0);
                $totalR1322 += $Info132->getR1322(0);
                $totalR1323 += $Info132->getR1323(0);
                $totalR1324 += $Info132->getR1324(0);
            }
            $totalInd132 = $totalR1321 + $totalR1322 + $totalR1323 + $totalR1324;

            //ind157
            $totalR1571 = 0;
            $totalR1572 = 0;
            foreach ($InfoColl157 as $Info157) {
                $totalR1571 += $Info157->getR1571(0);
                $totalR1572 += $Info157->getR1572(0);
            }
            $totalInd157 = $totalR1571 + $totalR1572;

            //ind162
            $mtDepetota            = $informationColectiviteAgent->getMtDepetota();
            $mtDepeinsepershand    = $informationColectiviteAgent->getMtDepeinsepershand();
            $mtRealemplpershand    = $informationColectiviteAgent->getMtRealemplpershand();
            $mtDepeamentrav        = $informationColectiviteAgent->getMtDepeamentrav();
            $totalInd162           = $mtDepetota + $mtDepeinsepershand + $mtRealemplpershand + $mtDepeamentrav;
            //ind21
            $r2101                 = $informationColectiviteAgent->getR2101();
            $r2102                 = $informationColectiviteAgent->getR2102();
            $totalInd21            = $r2101 + $r2102;

            //ind215
            $totalR2151 = 0;
            $totalR2152 = 0;
            foreach ($InfoColl215 as $Info215) {
                $totalR2151 += $Info215->getR2151(0);
                $totalR2152 += $Info215->getR2152(0);
            }
            $totalInd215 = $totalR2151 + $totalR2152;

            //ind216
            $totalR2161 = 0;
            $totalR2162 = 0;
            foreach ($InfoColl216 as $Info216) {
                $totalR2161 += $Info216->getR2161(0);
                $totalR2162 += $Info216->getR2162(0);
            }
            $totalInd216 = $totalR2161 + $totalR2162;

            //ind341
            $titu341               = $informationColectiviteAgent->getTitu341();
            $stag341               = $informationColectiviteAgent->getStag341();
            $totalInd341           = $titu341 + $stag341;

            //ind342
            $contractuel342        = $informationColectiviteAgent->getContractuel342();
            $totalInd342           = $contractuel342;

            //ind345
            $mtDepefonccoll        = $informationColectiviteAgent->getMtDepefonccoll();
            $mtCharpers            = $informationColectiviteAgent->getMtCharpers();
            $totalInd345           = $mtDepefonccoll + $mtCharpers;
            //ind412
            $totalR5121            = 0;
            $totalR5122            = 0;
            $totalNbAgent          = 0;
            foreach ($actionPrevention as $actPrev) {
                $totalR5121       += $actPrev->getR5121();
                $totalR5122       += $actPrev->getR5122();
                $totalNbAgent     += $actPrev->getNbAgent();
            }
            $totalInd412 = $totalR5121 + $totalR5122 + $totalNbAgent;
            //ind413
            $totalInd413_h    = $informationColectiviteAgent->getNbVisimedisponprevH();
            $totalInd413_f    = $informationColectiviteAgent->getNbVisimedisponprevF();
            $totalInd413 = $totalInd413_h + $totalInd413_f;
            //ind514
            $mtCnfptcotiobl        = $informationColectiviteAgent->getMtCnfptcotiobl();
            $mtCnfptsupcotiobl     = $informationColectiviteAgent->getMtCnfptsupcotiobl();
            $mtAutrorga            = $informationColectiviteAgent->getMtAutrorga();
            $mtFraidepla           = $informationColectiviteAgent->getMtFraidepla();
            $totalInd514           = $mtCnfptcotiobl + $mtCnfptsupcotiobl + $mtAutrorga + $mtFraidepla;
            //ind611
            $nbReunct              = $informationColectiviteAgent->getNbReunct();
            $nbReuncommiadmi       = $informationColectiviteAgent->getNbReuncommiadmi();
            $nbReuncommiconsu       = $informationColectiviteAgent->getNbReuncommiconsu();
            $nbReunchsct           = $informationColectiviteAgent->getNbReunchsct();
            $nbReunctmissdevo      =  $informationColectiviteAgent->getNbReunctmissdevo();
            $nbJourActRep      =  $informationColectiviteAgent->getNbJourActRep();
            $nbJourActSec      =  $informationColectiviteAgent->getNbJourActSec();
            $totalInd611           = $nbReunct + $nbReuncommiadmi + $nbReuncommiconsu + $nbReunchsct + $nbReunctmissdevo + $nbJourActRep + $nbJourActSec;
            //ind612
            $nbJourautospeacco     = $informationColectiviteAgent->getNbJourautospeacco();
            $nbJourabse            = $informationColectiviteAgent->getNbJourabse();
            $nbHeurglob            = $informationColectiviteAgent->getNbHeurglob();
            $nbHeurdroisynd        = $informationColectiviteAgent->getNbHeurdroisynd();
            $nbHeurutil            = $informationColectiviteAgent->getNbHeurutil();
            $nbProtacco            = $informationColectiviteAgent->getNbProtacco();
            $totalInd612           = $nbJourautospeacco + $nbJourabse + $nbHeurglob + $nbHeurdroisynd + $nbHeurutil + $nbProtacco;
            //ind613
            $totalR7131            = 0;
            foreach ($ConflitTravails as $ConflitTrav) {
                $totalR7131       += $ConflitTrav->getR7131();
            }
            $totalInd613 = $totalR7131;
            //ind614
            $totalSanctionDisciplinaire      = 0;
            $totalMotifSanctionDisciplinaire = 0;
            foreach ($SanctionDisciplinairesTitulaire as $SanctionDiscip) {
                $totalSanctionDisciplinaire += $SanctionDiscip->getNbAgentsH();
                $totalSanctionDisciplinaire += $SanctionDiscip->getNbAgentsF();
//                dump($totalSanctionDisciplinaire);
//                exit();
            }
            foreach ($SanctionDisciplinairesStagiaire as $SanctionDiscip) {
                $totalSanctionDisciplinaire += $SanctionDiscip->getNbAgentsH();
                $totalSanctionDisciplinaire += $SanctionDiscip->getNbAgentsF();
            }
            foreach ($SanctionDisciplinairesContractuel as $SanctionDiscip) {
                $totalSanctionDisciplinaire += $SanctionDiscip->getNbAgentsH();
                $totalSanctionDisciplinaire += $SanctionDiscip->getNbAgentsF();
            }
            foreach ($MotifSanctionDisciplinaires as $MotifSanctionDiscip) {
                $totalMotifSanctionDisciplinaire += $MotifSanctionDiscip->getNbAgentsF();
                $totalMotifSanctionDisciplinaire += $MotifSanctionDiscip->getNbAgentsH();
            }
            $totalInd614 = $totalSanctionDisciplinaire + $totalMotifSanctionDisciplinaire;

            return $this->render('@Apa/informationcolectiviteagent/edit.html.twig', array(
                        'informationColectiviteAgent' => $informationColectiviteAgent,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
                        'informationGenerales' => $informationGenerales,
                        'campagne'                    => $campagne,
                        'enquetecoll'                 => $enqueteCollectivite,
                        'array_pc_bool'               => $array_pc_bool,
                        'listeAgent'                  => $checked['checked'],
                        'collectivite'                => $collectivite,
//                        'totalInd114'                 => $totalInd114,
//                        'totalInd124'                 => $totalInd124,
//                        'totalInd131'                 => $totalInd131,
                        'totalInd132'                 => $totalInd132,
                        'totalInd157'                 => $totalInd157,
                        'totalInd162'                 => $totalInd162,
                        'totalInd21'                  => $totalInd21,
                        'totalInd215'                 => $totalInd215,
                        'totalInd216'                 => $totalInd216,
                        'totalInd341'                 => $totalInd341,
                        'totalInd342'                 => $totalInd342,
                        'totalInd345'                 => $totalInd345,
                        'totalInd412'                 => $totalInd412,
                        'totalInd413'                 => $totalInd413,
                        'totalInd514'                 => $totalInd514,
                        'totalInd611'                 => $totalInd611,
                        'totalInd612'                 => $totalInd612,
                        'totalInd613'                 => $totalInd613,
                        'totalInd614'                 => $totalInd614
            ));
        }else{
            return $this->redirectToRoute('bilansocialagent_index');
        }
    }

    /**
     * Deletes a informationColectiviteAgent entity.
     *
     */
    public function deleteAction(Request $request, InformationColectiviteAgent $informationColectiviteAgent) {
        if($this->checkIsUserOwnerOf($informationColectiviteAgent)){
            $form = $this->createDeleteForm($informationColectiviteAgent);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($informationColectiviteAgent);
                $em->flush();
            }

            return $this->redirectToRoute('informationcolectiviteagent_index');
        }else{
            return $this->redirectToRoute('bilansocialagent_index');
        }
    }

    /**
     * Creates a form to delete a informationColectiviteAgent entity.
     *
     * @param InformationColectiviteAgent $informationColectiviteAgent The informationColectiviteAgent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InformationColectiviteAgent $informationColectiviteAgent) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('informationcolectiviteagent_delete', array('idInfocollagen' => $informationColectiviteAgent->getIdinfocollagen())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }
    
    public function renderPcToMenuAction($informationColectiviteAgent){
        
            $user = $this->getUser();
            $session = $this->get('session');
            if (null == $session->get('coll_id')) {
                $idCollectivity = $user->getCollectivite()->getIdColl();
            } else {
                $idCollectivity = $session->get('coll_id');
            }
            $em = $this->getDoctrine()->getManager();
            $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
            $enqueteCollectivite = $this->getMonEnqueteCollectiviteActive();
            $pcOnglets = $informationColectiviteAgent->getPcOnglets();
            $array_pc_bool = $this->getOngletsTabBool($pcOnglets);
            $array_info = $this->checkIfAllOngletsIsSave($array_pc_bool);
           
            $nombreOngletsTrue = $array_info['count'];
            $nombreOngletTotal = \count($array_pc_bool);
                
            if ($enqueteCollectivite->getBlBilasoci() == true) {
                if($enqueteCollectivite->getBlRast() == false){
                    $nombreOngletTotal -= 1;
                    if($array_pc_bool['ongletRassct'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                }
                if($enqueteCollectivite->getBlHand() == false){
                    $nombreOngletTotal -= 1;
                    if($array_pc_bool['ongletHand'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                }
                if($enqueteCollectivite->getCollectivite()->getBlAffiColl() == true && $enqueteCollectivite->getCollectivite()->getRefTypeCollectivite()->getLbTypeColl() !== 'CDG'){
                    $nombreOngletTotal -= 1;
                    if($array_pc_bool['onglet612'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                }
                if($enqueteCollectivite->getCollectivite()->getBlCtCdg() == true){
                    $nombreOngletTotal -= 1;
                    if($array_pc_bool['onglet611'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                }
            } else {
                $nombreOngletTotal -= 17;
                if ($array_pc_bool['onglet132'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet157'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet21'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet215'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet216'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet217'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet227'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet311'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet321'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet341'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet342'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet343'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet345'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet514'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet613'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet614'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($array_pc_bool['onglet71'] == true) {
                    $nombreOngletsTrue -= 1;
                }
                if ($enqueteCollectivite->getBlRast() == false) {
                    $nombreOngletTotal -= 10;
//                    if($array_pc_bool['onglet114'] == true){
//                        $nombreOngletsTrue -= 1;
//                    }
//                    if($array_pc_bool['onglet124'] == true){
//                        $nombreOngletsTrue -= 1;
//                    }
                    if($array_pc_bool['onglet225'] == true){
                        $nombreOngletsTrue -= 1;
                    }
//                    if($array_pc_bool['onglet344'] == true){
//                        $nombreOngletsTrue -= 1;
//                    }
                    if($array_pc_bool['onglet412'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                    if($array_pc_bool['onglet413'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                    if($array_pc_bool['onglet414'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                    if($array_pc_bool['onglet417'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                    if($array_pc_bool['onglet425'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                    if($array_pc_bool['onglet43'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                    if($array_pc_bool['onglet611'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                    if($array_pc_bool['onglet612'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                    if($array_pc_bool['ongletRassct'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                }else{
                    if($enqueteCollectivite->getCollectivite()->getBlCtCdg() == true){
                        $nombreOngletTotal -= 1;
                        if($array_pc_bool['onglet611'] == true){
                            $nombreOngletsTrue -= 1;
                        }
                    }
                    if($enqueteCollectivite->getCollectivite()->getBlAffiColl() == true && $enqueteCollectivite->getCollectivite()->getRefTypeCollectivite()->getLbTypeColl() !== 'CDG'){
                        $nombreOngletTotal -= 1;
                        if($array_pc_bool['onglet612'] == true){
                            $nombreOngletsTrue -= 1;
                        }
                    }

                }
                if ($enqueteCollectivite->getBlRast() == false && $enqueteCollectivite->getBlGepe() == false) {
//                    $nombreOngletTotal -= 1;
//                    if($array_pc_bool['onglet131'] == true){
//                        $nombreOngletsTrue -= 1;
//                    }
                }
                if ($enqueteCollectivite->getBlHand() == false) {
                    $nombreOngletTotal -= 2;
                    if($array_pc_bool['onglet162'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                    if($array_pc_bool['ongletHand'] == true){
                        $nombreOngletsTrue -= 1;
                    }
                }
            }

            $pcInfoColl = (($nombreOngletsTrue/$nombreOngletTotal) * 100);
                
                return $this->render(
                '@Apa/menu_information_collectivite.html.twig',
                array('pcInfoColl' => $pcInfoColl, 'InformationCollectiviteExist' => $informationColectiviteAgent)
        );
    }

}
