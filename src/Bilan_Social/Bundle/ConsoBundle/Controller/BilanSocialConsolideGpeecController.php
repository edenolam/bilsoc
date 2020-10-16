<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use DateTime;
use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Doctrine\Common\Collections\ArrayCollection;
use Bilan_Social\Bundle\ConsoBundle\Controller\BilanSocialConsolideController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscGpeecNbAgentsTituEmpPermaParFoncEtAge;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscGpeecPlusNbAgentsParSpeEtAge;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscGpeecNiveauDiplome;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideGpeecBscGpeecNbAgentsTituEmpPermaParFoncEtAgeType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideGpeecBscGpeecPlusNbAgentsParSpeEtAgeType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideGpeecBscGpeecNiveauDiplomeType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\JsonResponse;


class BilanSocialConsolideGpeecController extends BilanSocialConsolideController {

    public function EditBilanSocialConsolideGpeecAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();

        $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);

        $em = $this->getDoctrine()->getManager();
        $indBscGpeecNbAgentsTituEmpPermaParFoncEtAges  = $em->getRepository('ConsoBundle:BscGpeecNbAgentsTituEmpPermaParFoncEtAge')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscGpeecNiveauDiplomes  = $em->getRepository('ConsoBundle:BscGpeecNiveauDiplome')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());

        //indBscGpeecNbAgentsTituEmpPermaParFoncEtAge
        $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb1 = 0;
        $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb2 = 0;
        $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb3 = 0;
        $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb4 = 0;
        $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb5 = 0;
        $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb6 = 0;
        $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb7 = 0;
        $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb8 = 0;
        $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb9 = 0;
        $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb10 = 0;
        foreach ($indBscGpeecNbAgentsTituEmpPermaParFoncEtAges as $indBscGpeecNbAgentsTituEmpPermaParFoncEtAge) {
               $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb1 += $indBscGpeecNbAgentsTituEmpPermaParFoncEtAge->getRNb1(0);
               $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb2 += $indBscGpeecNbAgentsTituEmpPermaParFoncEtAge->getRNb2(0);
               $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb3 += $indBscGpeecNbAgentsTituEmpPermaParFoncEtAge->getRNb3(0);
               $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb4 += $indBscGpeecNbAgentsTituEmpPermaParFoncEtAge->getRNb4(0);
               $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb5 += $indBscGpeecNbAgentsTituEmpPermaParFoncEtAge->getRNb5(0);
               $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb6 += $indBscGpeecNbAgentsTituEmpPermaParFoncEtAge->getRNb6(0);
               $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb7 += $indBscGpeecNbAgentsTituEmpPermaParFoncEtAge->getRNb7(0);
               $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb8 += $indBscGpeecNbAgentsTituEmpPermaParFoncEtAge->getRNb8(0);
               $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb9 += $indBscGpeecNbAgentsTituEmpPermaParFoncEtAge->getRNb9(0);
               $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb10 += $indBscGpeecNbAgentsTituEmpPermaParFoncEtAge->getRNb10(0);
        }
        $totalIndBscGpeecNbAgentsTituEmpPermaParFoncEtAge = $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb1 + $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb2 + $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb3 + $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb4 + $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb5 + $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb6 + $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb7 + $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb8 + $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb9 + $totalindBscGpeecNbAgentsTituEmpPermaParFoncEtAgeRNb10;

        //indBscGpeecNiveauDiplome
        $totalindBscGpeecNiveauDiplomeNbHommes = 0;
        $totalindBscGpeecNiveauDiplomeNbFemmes = 0;
        foreach ($indBscGpeecNiveauDiplomes as $indBscGpeecNiveauDiplome) {
               $totalindBscGpeecNiveauDiplomeNbHommes += $indBscGpeecNiveauDiplome->getNbHommes(0);
               $totalindBscGpeecNiveauDiplomeNbFemmes += $indBscGpeecNiveauDiplome->getNbFemmes(0);
        }
        $totalIndBscGpeecNiveauDiplome = $totalindBscGpeecNiveauDiplomeNbHommes + $totalindBscGpeecNiveauDiplomeNbFemmes;

        return $this->render('@Conso/BilanSocialConsolide/editGpeec.html.twig', array(
                    'questionCollectiviteConsolide' => $questionnaire,
                    'consolide'                     => $bilanSocialConsolide,
                    'incoherenceList'               => ($bilanSocialConsolide == null ? null : $bilanSocialConsolide->getIncoherenceLogs()),
                    'nombreQuestion' => $nombreQuestion,
                    'canwrite' => $this->isUserCanWrite(),
                    'collectivite' => $this->getMaCollectivite(),
                    'totalIndBscGpeecNbAgentsTituEmpPermaParFoncEtAge' => $totalIndBscGpeecNbAgentsTituEmpPermaParFoncEtAge,
                    'totalIndBscGpeecNiveauDiplome' => $totalIndBscGpeecNiveauDiplome
        ));
    }

    public function GetResponseGpeec($code, $bilanSocialConsolide) {
        $json = $this->getNumberQuestion($bilanSocialConsolide);
        $json['data'] = $code;
        // nmForm = 9
        return new JsonResponse($json);
    }

    public function EditBilanSocialConsolideGpeecBscGpeecNbAgentsTituEmpPermaParFoncEtAgesAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $idFamilleMetier = $request->query->get("idFamilleMetier");

        //error_log('------------------------------------------------------------------', 0);
        //error_log('idfili ' . $idFamilleMetier , 0);
        $familleMetier = $this->getEntityManager()->getRepository('ReferencielBundle:RefFamilleMetier')->findByAllWithOrder();

        $bsConsoIndPreparator->initIndicateurByName("BscGpeecNbAgentsTituEmpPermaParFoncEtAge");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscGpeecNbAgentsTituEmpPermaParFoncEtAge",$idFamilleMetier);

        // Calcul Totaux hors filieres selectionné
        $totalBscGpeecNbAgentsTituEmpPermaParFoncEtAge = new BscGpeecNbAgentsTituEmpPermaParFoncEtAge(true);
        foreach ($bilanSocialConsolide->getBscGpeecNbAgentsTituEmpPermaParFoncEtAges() as $bscGpeecNbAgentsTituEmpPermaParFoncEtAge) {
            if ($idFamilleMetier == null || $idFamilleMetier != $bscGpeecNbAgentsTituEmpPermaParFoncEtAge->getRefMetier()->getRefFamilleMetier()->getIdFamilleMetier()) {
                $totalBscGpeecNbAgentsTituEmpPermaParFoncEtAge->cumulRNbx($bscGpeecNbAgentsTituEmpPermaParFoncEtAge);
            }
        }

        $arrayTotalFamilleMetier = array();
        foreach ($familleMetier as $famille) {
            $arrayTotalFamilleMetier[$famille->getIdFamilleMetier()] = null;
            foreach ($bilanSocialConsolide->getBscGpeecNbAgentsTituEmpPermaParFoncEtAges() as $key => $metier) {
                if ($metier->getRefMetier()->getRefFamilleMetier()->getIdFamilleMetier() == $famille->getIdFamilleMetier()) {
                    $totParFamille = $metier->getTotalParFamille();
                    $arrayTotalFamilleMetier[$famille->getIdFamilleMetier()] += $totParFamille;
                }
            }
        }

        //error_log('bscGpeecNbAgentsTituEmpPermaParFoncEtAge before createform ' . $bilanSocialConsolide->getBscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp()->count());
        // Set des elements du form
        $formGpeecNbAgentsTituEmpPermaParFoncEtAge = $this->createForm(BilanSocialConsolideGpeecBscGpeecNbAgentsTituEmpPermaParFoncEtAgeType::class, $bilanSocialConsolide);
        //error_log('bscGpeecNbAgentsTituEmpPermaParFoncEtAge before handlerequest ' . $bilanSocialConsolide->getBscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp()->count());
        $formGpeecNbAgentsTituEmpPermaParFoncEtAge->handleRequest($request);
        // error_log('bscGpeecNbAgentsTituEmpPermaParFoncEtAge  after handlerequest ' . $bilanSocialConsolide->getBscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp()->count());

        $now = new DateTime('NOW');
        if ($formGpeecNbAgentsTituEmpPermaParFoncEtAge->isSubmitted()) {



            $fgstat = $formGpeecNbAgentsTituEmpPermaParFoncEtAge['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formGpeecNbAgentsTituEmpPermaParFoncEtAge->isValid()) {
                echo "Form invalide";
                error_log($formGpeecNbAgentsTituEmpPermaParFoncEtAge->getErrors(), 0);
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setGpeecDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);

                }

                foreach ($bilanSocialConsolide->getBscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp() as $bscGpeecNbAgentsTituEmpPermaParFoncEtAge) {
                    if ($bscGpeecNbAgentsTituEmpPermaParFoncEtAge->getBscGpeecNbAgentsTituEmpPermaParFoncEtAge() == null || $bscGpeecNbAgentsTituEmpPermaParFoncEtAge->getBscGpeecNbAgentsTituEmpPermaParFoncEtAge() == 0) {
                        $bscGpeecNbAgentsTituEmpPermaParFoncEtAge->setDtCrea($now);
                        $bscGpeecNbAgentsTituEmpPermaParFoncEtAge->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($bscGpeecNbAgentsTituEmpPermaParFoncEtAge);
                        $bilanSocialConsolide->getBscGpeecNbAgentsTituEmpPermaParFoncEtAges()->add($bscGpeecNbAgentsTituEmpPermaParFoncEtAge);
                    }
                }

                //
                //error_log('before flush', 0);
                
                /*$enqueteCollectivite = $this->getMonEnqueteCollectiviteActive();*/
        
                /*if($enqueteCollectivite->getBlGpeecPlus() == true ) {*/
                    $bilanSocialConsolide->setMoyenneGpeecNbAgentsTituEmpPermaParFoncEtAge(100);
                    $bilanSocialConsolide->setBlIncoGpeecNbAgentsTituEmpPermaParFoncEtAge(4);
                    $bilanSocialConsolide->setGpeecNbAgentsTituEmpPermaParFoncEtAge();
                /*}*/
               
                $bilanSocialConsolide->setBlUpdated(true);

                //error_log('after flush', 0);

                $this->getEntityManager()->flush();

                $this->getEntityManager()->getConnection()->commit();


                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);


                return $this->GetResponseGpeec("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseGpeec("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseGpeec("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editGpeecBscGpeecNbAgentsTituEmpPermaParFoncEtAge.html.twig', array(
                    'formGpeecNbAgentsTituEmpPermaParFoncEtAge'     => $formGpeecNbAgentsTituEmpPermaParFoncEtAge->createView(),
                    'questionCollectiviteConsolide'                 => $questionnaire,
                    'incoherenceList'                               => $bilanSocialConsolide->getIncoherenceLogs(),
                    'familleMetier'                                 => $familleMetier,
                    'idFamilleMetier'                               => $idFamilleMetier,
                    'totalBscGpeecNbAgentsTituEmpPermaParFoncEtAge' => $totalBscGpeecNbAgentsTituEmpPermaParFoncEtAge,
                    'arrayTotalFamilleMetier'                       => $arrayTotalFamilleMetier
        ));
    }

    public function EditBilanSocialConsolideGpeecBscGpeecPlusNbAgentsParSpeEtAgesAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $idDomaineSpecialite = $request->query->get("idDomaineSpecialite");

        //error_log('------------------------------------------------------------------', 0);
        //error_log('idfili ' . $idDomaineSpecialite , 0);
        $domaineSpecialite = $this->getEntityManager()->getRepository('ReferencielBundle:RefDomaineSpecialite')->findByAllWithOrder();

        $bsConsoIndPreparator->initIndicateurByName("BscGpeecPlusNbAgentsParSpeEtAge");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscGpeecPlusNbAgentsParSpeEtAge",$idDomaineSpecialite);


        // Calcul Totaux hors filieres selectionné
        $totalBscGpeecPlusNbAgentsParSpeEtAge = new BscGpeecPlusNbAgentsParSpeEtAge(true);
        foreach ($bilanSocialConsolide->getBscGpeecPlusNbAgentsParSpeEtAges() as $bscGpeecPlusNbAgentsParSpeEtAge) {
            if ($idDomaineSpecialite == null || $idDomaineSpecialite != $bscGpeecPlusNbAgentsParSpeEtAge->getRefSpecialite()->getRefDomaineSpecialite()->getIdDomaineSpecialite()) {
                $totalBscGpeecPlusNbAgentsParSpeEtAge->cumulRNbx($bscGpeecPlusNbAgentsParSpeEtAge);
            }
        }

        $arrayTotalDomaineSpecialite = array();
        foreach ($domaineSpecialite as $domaine) {
            $arrayTotalDomaineSpecialite[$domaine->getIdDomaineSpecialite()] = null;
            foreach ($bilanSocialConsolide->getBscGpeecPlusNbAgentsParSpeEtAges() as $key => $specialite) {
                if ($specialite->getRefSpecialite()->getRefDomaineSpecialite()->getIdDomaineSpecialite() == $domaine->getIdDomaineSpecialite()) {
                    $totParDomaine = $specialite->getTotalParDomaine();
                    $arrayTotalDomaineSpecialite[$domaine->getIdDomaineSpecialite()] += $totParDomaine;
                }
            }
        }

        //error_log('bscGpeecPlusNbAgentsParSpeEtAge before createform ' . $bilanSocialConsolide->getBscGpeecPlusNbAgentsParSpeEtAgesTemp()->count());
        // Set des elements du form
        $formGpeecPlusNbAgentsParSpeEtAge = $this->createForm(BilanSocialConsolideGpeecBscGpeecPlusNbAgentsParSpeEtAgeType::class, $bilanSocialConsolide);
        //error_log('bscGpeecPlusNbAgentsParSpeEtAge before handlerequest ' . $bilanSocialConsolide->getBscGpeecPlusNbAgentsParSpeEtAgesTemp()->count());
        $formGpeecPlusNbAgentsParSpeEtAge->handleRequest($request);
        // error_log('bscGpeecPlusNbAgentsParSpeEtAge  after handlerequest ' . $bilanSocialConsolide->getBscGpeecPlusNbAgentsParSpeEtAgesTemp()->count());

        $now = new DateTime('NOW');
        if ($formGpeecPlusNbAgentsParSpeEtAge->isSubmitted()) {



            $fgstat = $formGpeecPlusNbAgentsParSpeEtAge['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formGpeecPlusNbAgentsParSpeEtAge->isValid()) {
                echo "Form invalide";
                error_log($formGpeecPlusNbAgentsParSpeEtAge->getErrors(), 0);
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setGpeecDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getBscGpeecPlusNbAgentsParSpeEtAgesTemp() as $bscGpeecPlusNbAgentsParSpeEtAge) {
                    if ($bscGpeecPlusNbAgentsParSpeEtAge->getBscGpeecPlusNbAgentsParSpeEtAge() == null || $bscGpeecPlusNbAgentsParSpeEtAge->getBscGpeecPlusNbAgentsParSpeEtAge() == 0) {
                        $bscGpeecPlusNbAgentsParSpeEtAge->setDtCrea($now);
                        $bscGpeecPlusNbAgentsParSpeEtAge->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($bscGpeecPlusNbAgentsParSpeEtAge);
                        $bilanSocialConsolide->getBscGpeecPlusNbAgentsParSpeEtAges()->add($bscGpeecPlusNbAgentsParSpeEtAge);
                    }
                }

                //
                //error_log('before flush', 0);
              $enqueteCollectivite = $this->getMonEnqueteCollectiviteActive();
        
                if($enqueteCollectivite->getBlGpeecPlus() == true ) {
                    $bilanSocialConsolide->setMoyenneGpeecPlusNbAgentsParSpeEtAge(100);
                    $bilanSocialConsolide->setBlIncoGpeecPlusNbAgentsParSpeEtAge(4);
                }


                //                error_log('after flush', 0);

                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->getEntityManager()->getConnection()->commit();


                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);


                return $this->GetResponseGpeec("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseGpeec("-3", $bilanSocialConsolide);
            }  catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseGpeec("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editGpeecBscGpeecPlusNbAgentsParSpeEtAge.html.twig', array(
                    'formGpeecPlusNbAgentsParSpeEtAge'     => $formGpeecPlusNbAgentsParSpeEtAge->createView(),
                    'questionCollectiviteConsolide'        => $questionnaire,
                    'incoherenceList'                      => $bilanSocialConsolide->getIncoherenceLogs(),
                    'domaineSpecialite'                    => $domaineSpecialite,
                    'idDomaineSpecialite'                  => $idDomaineSpecialite,
                    'totalBscGpeecPlusNbAgentsParSpeEtAge' => $totalBscGpeecPlusNbAgentsParSpeEtAge,
                    'arrayTotalDomaineSpecialite'          => $arrayTotalDomaineSpecialite
        ));
    }
    public function EditBilanSocialConsolideGpeecNiveauDiplomeAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $domaineDiplomes = $this->getEntityManager()->getRepository('ReferencielBundle:RefDomaineDiplome')->findByAllWithOrder();


        $bsConsoIndPreparator->initIndicateurByName("BscGpeecNiveauDiplome");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscGpeecNiveauDiplome");

        $formGpeecNiveauDiplome = $this->createForm(BilanSocialConsolideGpeecBscGpeecNiveauDiplomeType::class, $bilanSocialConsolide);

        $formGpeecNiveauDiplome->handleRequest($request);
        // error_log('bscGpeecNbAgentsTituEmpPermaParFoncEtAge  after handlerequest ' . $bilanSocialConsolide->getBscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp()->count());

        $now = new DateTime('NOW');
        if ($formGpeecNiveauDiplome->isSubmitted()) {


//
            if (!$formGpeecNiveauDiplome->isValid()) {
                echo "Form invalide";
                error_log($formGpeecNiveauDiplome->getErrors(), 0);
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setGpeecDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);

                }

                foreach ($bilanSocialConsolide->getBscGpeecNiveauDiplomes() as $BscGpeecNiveauDiplome) {
                    if ($BscGpeecNiveauDiplome->getBscGpeecNiveauDiplome() == null || $BscGpeecNiveauDiplome->getBscGpeecNiveauDiplome() == 0) {
                        $BscGpeecNiveauDiplome->setDtCrea($now);
                        $BscGpeecNiveauDiplome->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($BscGpeecNiveauDiplome);
                        $bilanSocialConsolide->getBscGpeecNiveauDiplomes()->add($BscGpeecNiveauDiplome);
                    }
                }

                //
                //error_log('before flush', 0);
                $bilanSocialConsolide->setMoyenneGpeecNiveauDiplome(100);
                $bilanSocialConsolide->setBlIncoGpeecNiveauDiplome(4);
                $bilanSocialConsolide->setBlUpdated(true);

                //error_log('after flush', 0);

                $this->getEntityManager()->flush();

                $this->getEntityManager()->getConnection()->commit();


                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);


                return $this->GetResponseGpeec("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseGpeec("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseGpeec("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editGpeecBscGpeecNiveauDiplome.html.twig', array(
                    'formGpeecNiveauDiplome'     => $formGpeecNiveauDiplome->createView(),
                    'questionCollectiviteConsolide'                 => $questionnaire,
                    'incoherenceList'                               => $bilanSocialConsolide->getIncoherenceLogs(),
                    'domaineDiplome'                                 => $domaineDiplomes,
        ));
    }

}
