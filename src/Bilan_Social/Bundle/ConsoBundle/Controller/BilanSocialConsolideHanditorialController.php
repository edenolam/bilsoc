<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use DateTime;
use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Bilan_Social\Bundle\ConsoBundle\Controller\BilanSocialConsolideController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideHanditorialBscHanditorialQuestionsGeneralesType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideHanditorialBscHanditorialInaptitudeEtReclassementType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideHanditorialBscHanditorialQuestionsBoethsType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideHanditorialBscHanditorialCadreEmploisType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideHanditorialBscHanditorialMetiersType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideHanditorialBscHanditorialTempsCompletsType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideHanditorialBscHanditorialInaptEtReclaCadreEmploisType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideHanditorialBscHanditorialInaptEtReclaMetiersType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideHanditorialBscHanditorialInaptEtReclaTempsCompletsType;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialCadreEmplois;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialMetiers;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialTempsComplets;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialTempsPleins;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialInaptEtReclaCadreEmplois;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialInaptEtReclaMetiers;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialInaptEtReclaTempsComplets;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class BilanSocialConsolideHanditorialController extends BilanSocialConsolideController {

    public function EditBilanSocialConsolideHanditorialAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);
        $enqueteCollActive = $this->getMonEnqueteCollectiviteActive();

        $em = $this->getDoctrine()->getManager();
        $indBscHanditorialInaptitudeEtReclassements  = $em->getRepository('ConsoBundle:BscHanditorialInaptitudeEtReclassement')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscHanditorialInaptEtReclaCadreEmploiss  = $em->getRepository('ConsoBundle:BscHanditorialInaptEtReclaCadreEmplois')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscHanditorialInaptEtReclaMetierss       = $em->getRepository('ConsoBundle:BscHanditorialInaptEtReclaMetiers')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscHanditorialInaptEtReclaTempsCompletss = $em->getRepository('ConsoBundle:BscHanditorialInaptEtReclaTempsComplets')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscHanditorialQuestionsBoethss           = $em->getRepository('ConsoBundle:BscHanditorialQuestionsBoeths')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscHanditorialCadreEmploiss              = $em->getRepository('ConsoBundle:BscHanditorialCadreEmplois')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscHanditorialMetierss                   = $em->getRepository('ConsoBundle:BscHanditorialMetiers')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscHanditorialTempsCompletss             = $em->getRepository('ConsoBundle:BscHanditorialTempsComplets')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());

        //indBscHanditorialInaptitudeEtReclassement
        $totalQA511 = 0;
        $totalQA512 = 0;
        $totalQA513 = 0;
        $totalRA9 = 0;
        $totalRA91 = 0;
        $totalQA521 = 0;
        $totalRA101 = 0;
        $totalQA522 = 0;
        $totalQA523 = 0;
        $totalQA62 = 0;
        $totalQA72 = 0;
        $totalQA8 = 0;
        $totalQA82 = 0;
        foreach ($indBscHanditorialInaptitudeEtReclassements as $indBscHanditorialInaptitudeEtReclassement) {
               $totalQA511 += $indBscHanditorialInaptitudeEtReclassement->getQA511(0);
               $totalQA512 += $indBscHanditorialInaptitudeEtReclassement->getQA512(0);
               $totalQA513 += $indBscHanditorialInaptitudeEtReclassement->getQA513(0);
               $totalRA9 += $indBscHanditorialInaptitudeEtReclassement->getRA9(0);
               $totalRA91 += $indBscHanditorialInaptitudeEtReclassement->getRA91(0);
               $totalQA521 += $indBscHanditorialInaptitudeEtReclassement->getQA521(0);
               $totalRA101 += $indBscHanditorialInaptitudeEtReclassement->getRA101(0);
               $totalQA522 += $indBscHanditorialInaptitudeEtReclassement->getQA522(0);
               $totalQA523 += $indBscHanditorialInaptitudeEtReclassement->getQA523(0);
               $totalQA62 += $indBscHanditorialInaptitudeEtReclassement->getQA62(0);
               $totalQA72 += $indBscHanditorialInaptitudeEtReclassement->getQA72(0);
               $totalQA8 += $indBscHanditorialInaptitudeEtReclassement->getQA8(0);
               $totalQA82 += $indBscHanditorialInaptitudeEtReclassement->getQA82(0);
        }
        $totalBscHanditorialInaptitudeEtReclassement = $totalQA511 + $totalQA512 + $totalQA513 + $totalRA9 + $totalRA91 + $totalQA521 + $totalRA101 + $totalQA522 + $totalQA523 + $totalQA62 + $totalQA72 + $totalQA8 + $totalQA82;

        //indBscHanditorialInaptEtReclaCadreEmplois
        $totalindBscHanditorialInaptEtReclaCadreEmploisCadreEmploiH = 0;
        $totalindBscHanditorialInaptEtReclaCadreEmploisCadreEmploiF = 0;
        foreach ($indBscHanditorialInaptEtReclaCadreEmploiss as $indBscHanditorialInaptEtReclaCadreEmplois) {
               $totalindBscHanditorialInaptEtReclaCadreEmploisCadreEmploiH += $indBscHanditorialInaptEtReclaCadreEmplois->getCadreEmploiH(0);
               $totalindBscHanditorialInaptEtReclaCadreEmploisCadreEmploiF += $indBscHanditorialInaptEtReclaCadreEmplois->getCadreEmploiF(0);
        }
        $totalBscHanditorialInaptEtReclaCadreEmplois = $totalindBscHanditorialInaptEtReclaCadreEmploisCadreEmploiH + $totalindBscHanditorialInaptEtReclaCadreEmploisCadreEmploiF;

        //indBscHanditorialInaptEtReclaMetiers
        $totalindBscHanditorialInaptEtReclaMetiersMetierH = 0;
        $totalindBscHanditorialInaptEtReclaMetiersMetierF = 0;
        foreach ($indBscHanditorialInaptEtReclaMetierss as $indBscHanditorialInaptEtReclaMetiers) {
               $totalindBscHanditorialInaptEtReclaMetiersMetierH += $indBscHanditorialInaptEtReclaMetiers->getMetierH(0);
               $totalindBscHanditorialInaptEtReclaMetiersMetierF += $indBscHanditorialInaptEtReclaMetiers->getMetierF(0);
        }
        $totalBscHanditorialInaptEtReclaMetiers = $totalindBscHanditorialInaptEtReclaMetiersMetierH + $totalindBscHanditorialInaptEtReclaMetiersMetierF;

        //indBscHanditorialInaptEtReclaTempsComplets
        $totalindBscHanditorialInaptEtReclaTempsCompletsTempsCompletH = 0;
        $totalindBscHanditorialInaptEtReclaTempsCompletsTempsCompletF = 0;
        $totalindBscHanditorialInaptEtReclaTempsCompletsTempsNonCompletH = 0;
        $totalindBscHanditorialInaptEtReclaTempsCompletsTempsNonCompletF = 0;
        foreach ($indBscHanditorialInaptEtReclaTempsCompletss as $indBscHanditorialInaptEtReclaTempsComplets) {
               $totalindBscHanditorialInaptEtReclaTempsCompletsTempsCompletH += $indBscHanditorialInaptEtReclaTempsComplets->getTempsCompletH(0);
               $totalindBscHanditorialInaptEtReclaTempsCompletsTempsCompletF += $indBscHanditorialInaptEtReclaTempsComplets->getTempsCompletF(0);
               $totalindBscHanditorialInaptEtReclaTempsCompletsTempsNonCompletH += $indBscHanditorialInaptEtReclaTempsComplets->getTempsNonCompletH(0);
               $totalindBscHanditorialInaptEtReclaTempsCompletsTempsNonCompletF += $indBscHanditorialInaptEtReclaTempsComplets->getTempsNonCompletF(0);
        }
        $totalBscHanditorialInaptEtReclaTempsComplets = $totalindBscHanditorialInaptEtReclaTempsCompletsTempsCompletH + $totalindBscHanditorialInaptEtReclaTempsCompletsTempsCompletF + $totalindBscHanditorialInaptEtReclaTempsCompletsTempsNonCompletH + $totalindBscHanditorialInaptEtReclaTempsCompletsTempsNonCompletF;

        //indBscHanditorialQuestionsBoeths
        $totalindBscHanditorialQuestionsBoethsCadreEmploiH = 0;
        $totalindBscHanditorialQuestionsBoethsCadreEmploiF = 0;
        foreach ($indBscHanditorialQuestionsBoethss as $indBscHanditorialQuestionsBoeths) {
               $totalindBscHanditorialQuestionsBoethsCadreEmploiH += $indBscHanditorialQuestionsBoeths->getCategorieH(0);
               $totalindBscHanditorialQuestionsBoethsCadreEmploiF += $indBscHanditorialQuestionsBoeths->getCategorieF(0);
        }
        $totalBscHanditorialQuestionsBoeths = $totalindBscHanditorialQuestionsBoethsCadreEmploiH + $totalindBscHanditorialQuestionsBoethsCadreEmploiF;

        //indBscHanditorialCadreEmplois
        $totalindBscHanditorialCadreEmploisCadreEmploiH = 0;
        $totalindBscHanditorialCadreEmploisCadreEmploiF = 0;
        foreach ($indBscHanditorialCadreEmploiss as $indBscHanditorialCadreEmplois) {
               $totalindBscHanditorialCadreEmploisCadreEmploiH += $indBscHanditorialCadreEmplois->getCadreEmploiH(0);
               $totalindBscHanditorialCadreEmploisCadreEmploiF += $indBscHanditorialCadreEmplois->getCadreEmploiF(0);
        }
        $totalBscHanditorialCadreEmplois = $totalindBscHanditorialCadreEmploisCadreEmploiH + $totalindBscHanditorialCadreEmploisCadreEmploiF;

        //indBscHanditorialMetiers
        $totalindBscHanditorialMetiersMetierH = 0;
        $totalindBscHanditorialMetiersMetierF = 0;
        foreach ($indBscHanditorialMetierss as $indBscHanditorialMetiers) {
               $totalindBscHanditorialMetiersMetierH += $indBscHanditorialMetiers->getMetierH(0);
               $totalindBscHanditorialMetiersMetierF += $indBscHanditorialMetiers->getMetierF(0);
        }
        $totalBscHanditorialMetiers = $totalindBscHanditorialMetiersMetierH + $totalindBscHanditorialMetiersMetierF;

         //indBscHanditorialTempsComplets
        $totalindBscHanditorialTempsCompletsTempsCompletH = 0;
        $totalindBscHanditorialTempsCompletsTempsCompletF = 0;
        $totalindBscHanditorialTempsCompletsTempsNonCompletH = 0;
        $totalindBscHanditorialTempsCompletsTempsNonCompletF = 0;
        foreach ($indBscHanditorialTempsCompletss as $indBscHanditorialTempsComplets) {
               $totalindBscHanditorialTempsCompletsTempsCompletH += $indBscHanditorialTempsComplets->getTempsCompletH(0);
               $totalindBscHanditorialTempsCompletsTempsCompletF += $indBscHanditorialTempsComplets->getTempsCompletF(0);
               $totalindBscHanditorialTempsCompletsTempsNonCompletH += $indBscHanditorialTempsComplets->getTempsNonCompletH(0);
               $totalindBscHanditorialTempsCompletsTempsNonCompletF += $indBscHanditorialTempsComplets->getTempsNonCompletF(0);
        }
        $totalBscHanditorialTempsComplets = $totalindBscHanditorialTempsCompletsTempsCompletH + $totalindBscHanditorialTempsCompletsTempsCompletF + $totalindBscHanditorialTempsCompletsTempsNonCompletH + $totalindBscHanditorialTempsCompletsTempsNonCompletF;

        return $this->render('@Conso/BilanSocialConsolide/editHanditorial.html.twig', array(
                    'questionCollectiviteConsolide' => $questionnaire,
                    'consolide'                     => $bilanSocialConsolide,
                    'incoherenceList'               => ($bilanSocialConsolide == null ? null : $bilanSocialConsolide->getIncoherenceLogs()),
                    'nombreQuestion'                => $nombreQuestion,
                    'enqueteCollActive'             => $enqueteCollActive,
                    'canwrite' => $this->isUserCanWrite(),
                    'collectivite' => $this->getMaCollectivite(),
                    'totalBscHanditorialInaptitudeEtReclassement'  => $totalBscHanditorialInaptitudeEtReclassement,
                    'totalBscHanditorialInaptEtReclaCadreEmplois'  => $totalBscHanditorialInaptEtReclaCadreEmplois,
                    'totalBscHanditorialInaptEtReclaMetiers'       => $totalBscHanditorialInaptEtReclaMetiers,
                    'totalBscHanditorialInaptEtReclaTempsComplets' => $totalBscHanditorialInaptEtReclaTempsComplets,
                    'totalBscHanditorialQuestionsBoeths'           => $totalBscHanditorialQuestionsBoeths,
                    'totalBscHanditorialCadreEmplois'              => $totalBscHanditorialCadreEmplois,
                    'totalBscHanditorialMetiers'                   => $totalBscHanditorialMetiers,
                    'totalBscHanditorialTempsComplets'             => $totalBscHanditorialTempsComplets
        ));
    }

    public function GetResponseHanditorial($code, $bilanSocialConsolide) {
        $json = $this->getNumberQuestion($bilanSocialConsolide);
        $json['data'] = $code;
        // nmForm = 10
        return new JsonResponse($json);
    }

    public function EditBilanSocialConsolideHanditorialBscHanditorialQuestionsGeneralesAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formHanditorialQuestionsGenerales = $this->createForm(BilanSocialConsolideHanditorialBscHanditorialQuestionsGeneralesType::class, $bilanSocialConsolide);
        $formHanditorialQuestionsGenerales->handleRequest($request);


        $now = new DateTime('NOW');
        if ($formHanditorialQuestionsGenerales->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formHanditorialQuestionsGenerales->isValid()) {
                echo "Form invalide";
                exit;
            }

            $bscHandi = $bilanSocialConsolide->getBscHanditorialQuestionsGenerales();
            $bscHandi->setBilanSocialConsolide($bilanSocialConsolide);
            $bilanSocialConsolide->setHanditorialDateAndUserModif($now, $cdUtil);

            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                //$bilanSocialConsolide->setHanditorialDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bscHandi);
                }

                $bilanSocialConsolide->setMoyenneHanditorialQuestionsGenerales(100);
                $bilanSocialConsolide->setBlIncoHanditorialQuestionsGenerales(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseHanditorial("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editHanditorialBscHanditorialQuestionsGenerales.html.twig', array(
                    'formHanditorialQuestionsGenerales' => $formHanditorialQuestionsGenerales->createView(),
                    'incoherenceList'               => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideHanditorialBscHanditorialInaptitudeEtReclassementAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
    
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialAvisInaptitudes");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialAvisInaptitudes");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialMesureInaptitudes");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialMesureInaptitudes");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialAvisInaptitudesAvant");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialAvisInaptitudesAvant");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialMesureInaptitudesAvant");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialMesureInaptitudesAvant");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialAncienneteAgents");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialAncienneteAgents");

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }
        

        $formHanditorialInaptitudeEtReclassement = $this->createForm(BilanSocialConsolideHanditorialBscHanditorialInaptitudeEtReclassementType::class, $bilanSocialConsolide);
        $formHanditorialInaptitudeEtReclassement->handleRequest($request);


        $now = new DateTime('NOW');
        
        if ($formHanditorialInaptitudeEtReclassement->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formHanditorialInaptitudeEtReclassement->isValid()) {
                echo "Form invalide";
                exit;
            }

            $bscHandi = $bilanSocialConsolide->getBscHanditorialInaptitudeEtReclassement();
            $bscHandi->setBilanSocialConsolide($bilanSocialConsolide);
            $bilanSocialConsolide->setHanditorialDateAndUserModif($now, $cdUtil);

            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                //$bilanSocialConsolide->setHanditorialDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bscHandi);
                }

                $bilanSocialConsolide->setHanditorialInaptitudeEtReclassementNullToZero();
                $bilanSocialConsolide->setMoyenneHanditorialInaptitudeEtReclassement(100);
                $bilanSocialConsolide->setBlIncoHanditorialInaptitudeEtReclassement(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseHanditorial("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-1", $bilanSocialConsolide);
            }
        }
        
        return $this->render('@Conso/BilanSocialConsolide/editHanditorialBscHanditorialInaptitudeEtReclassement.html.twig', array(
                    'formHanditorialBscHanditorialInaptitudeEtReclassement' => $formHanditorialInaptitudeEtReclassement->createView(),
                    'incoherenceList'               => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideHanditorialBscHanditorialQuestionsBoethsAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $idFili = $request->query->get("idFili");
        $filieres = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findByAllWithOrder();
        $cadreEmploi = $this->getEntityManager()->getRepository('ReferencielBundle:RefCadreEmploi')->findByAllWithOrder();

        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialQuestionsBoethsCategorie");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialQuestionsBoethsCategorie");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialNatureHandicaps");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialNatureHandicaps");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialModeEntrees");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialModeEntrees");
       /* $bsConsoIndPreparator->initIndicateurByName("BscHanditorialStatutAgents");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialStatutAgents");*/
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialArticles");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialArticles");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialModeSortiesTitulaire");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialModeSortiesTitulaire");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialModeSortiesNonTitulaire");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialModeSortiesNonTitulaire");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialDerniersDiplomes");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialDerniersDiplomes");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialCadreEmplois");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialCadreEmplois",$idFili);

        
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $totalCadreEmploi = new BscHanditorialCadreEmplois(true);
        foreach ($bilanSocialConsolide->getBscHanditorialCadreEmplois() as $bscHanditorialCadreEmploi) {
            if ($idFili == null || $idFili != $bscHanditorialCadreEmploi->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                $totalCadreEmploi->cumulCadreEmploi($bscHanditorialCadreEmploi);
            }
        }

        $formHanditorialBscHanditorialQuestionsBoeths = $this->createForm(BilanSocialConsolideHanditorialBscHanditorialQuestionsBoethsType::class, $bilanSocialConsolide);
        $formHanditorialBscHanditorialQuestionsBoeths->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formHanditorialBscHanditorialQuestionsBoeths->isSubmitted()) {

            $fgstat = $formHanditorialBscHanditorialQuestionsBoeths['valide']->getData();


            // Traitement submit du form en AJAX
            if (!$formHanditorialBscHanditorialQuestionsBoeths->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit

            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    $bscHanditorialQuestionsBoeths->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($bscHanditorialQuestionsBoeths);
                }

                foreach ($bilanSocialConsolide->getBscHanditorialCadreEmploisTemp() as $bscHanditorialCadreEmploi) {
                    if ($bscHanditorialCadreEmploi->getBscHanditorialCadreEmplois() == null || $bscHanditorialCadreEmploi->getBscHanditorialCadreEmplois() == 0) {
                        $bscHanditorialCadreEmploi->setDtCrea($now);
                        $bscHanditorialCadreEmploi->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($bscHanditorialCadreEmploi);
                        $bilanSocialConsolide->getBscHanditorialCadreEmplois()->add($bscHanditorialCadreEmploi);
                    }
                }


                $bilanSocialConsolide->setHanditorialQuestionsBoethsNullToZero();
                $bilanSocialConsolide->setMoyenneHanditorialQuestionsBoeths(100);
                $bilanSocialConsolide->setBlIncoHanditorialQuestionsBoeths(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseHanditorial("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editHanditorialBscHanditorialQuestionsBoeths.html.twig', array(
                    'formHanditorialBscHanditorialQuestionsBoeths' => $formHanditorialBscHanditorialQuestionsBoeths->createView(),
                    'incoherenceList'                              => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'                => $questionnaire,
                    'filieres'                                     => $filieres,
                    'idFili'                                       => $idFili,
                    'totalCadreEmploi'                             => $totalCadreEmploi
        ));
    }

    public function EditBilanSocialConsolideHanditorialBscHanditorialCadreEmploisAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $idFili = $request->query->get("idFili");
        $filieres = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findByAllWithOrder();
        $cadreEmploi = $this->getEntityManager()->getRepository('ReferencielBundle:RefCadreEmploi')->findByAllWithOrder();

        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialCadreEmplois");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialCadreEmplois", $idFili);

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $totalCadreEmploi = new BscHanditorialCadreEmplois(true);
        foreach ($bilanSocialConsolide->getBscHanditorialCadreEmplois() as $bscHanditorialCadreEmploi) {
            if ($idFili == null || $idFili != $bscHanditorialCadreEmploi->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                $totalCadreEmploi->cumulCadreEmploi($bscHanditorialCadreEmploi);
            }
        }

        $arrayTotalFiliere = array();
        foreach ($filieres as $filiere) {
            $arrayTotalFiliere[$filiere->getIdFili()] = null;
            foreach ($bilanSocialConsolide->getBscHanditorialCadreEmplois() as $key => $handi) {
                if ($handi->getRefCadreEmploi()->getRefFiliere()->getIdFili() == $filiere->getIdFili()) {
                    $totParFiliere = $handi->getTotalParFiliere();
                    $arrayTotalFiliere[$filiere->getIdFili()] += $totParFiliere;
                }
            }
        }

        $formHanditorialBscHanditorialQuestionsBoeths = $this->createForm(BilanSocialConsolideHanditorialBscHanditorialCadreEmploisType::class, $bilanSocialConsolide);
        $formHanditorialBscHanditorialQuestionsBoeths->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formHanditorialBscHanditorialQuestionsBoeths->isSubmitted()) {

            $fgstat = $formHanditorialBscHanditorialQuestionsBoeths['valide']->getData();

            // Traitement submit du form en AJAX

            if (!$formHanditorialBscHanditorialQuestionsBoeths->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit

            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getBscHanditorialCadreEmploisTemp() as $bscHanditorialCadreEmploi) {
                    if ($bscHanditorialCadreEmploi->getBscHanditorialCadreEmplois() == null || $bscHanditorialCadreEmploi->getBscHanditorialCadreEmplois() == 0) {
                        $bscHanditorialCadreEmploi->setDtCrea($now);
                        $bscHanditorialCadreEmploi->setCdUtilcrea($cdUtil);
                        $bscHanditorialCadreEmploi->setBilanSocialConsolide($bilanSocialConsolide);
                        $this->getEntityManager()->persist($bscHanditorialCadreEmploi);
                        $bilanSocialConsolide->getBscHanditorialCadreEmplois()->add($bscHanditorialCadreEmploi);
                    }
                }

                $bilanSocialConsolide->setHanditorialCadreEmploisNullToZero() ;
                $bilanSocialConsolide->setMoyenneHanditorialCadreEmplois(100);
                $bilanSocialConsolide->setBlIncoHanditorialCadreEmplois(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseHanditorial("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editHanditorialBscHanditorialCadreEmploi.html.twig', array(
                    'formHanditorialBscHanditorialQuestionsBoeths' => $formHanditorialBscHanditorialQuestionsBoeths->createView(),
                    'incoherenceList'                              => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'                => $questionnaire,
                    'filieres'                                     => $filieres,
                    'idFili'                                       => $idFili,
                    'totalCadreEmploi'                             => $totalCadreEmploi,
                    'arrayTotalFiliere'                            => $arrayTotalFiliere
        ));
    }

    public function EditBilanSocialConsolideHanditorialBscHanditorialInaptEtReclaCadreEmploisAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $idFili = $request->query->get("idFili");
        $filieres = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findByAllWithOrder();
        $cadreEmploi = $this->getEntityManager()->getRepository('ReferencielBundle:RefCadreEmploi')->findByAllWithOrder();

        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialInaptEtReclaCadreEmplois");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialInaptEtReclaCadreEmplois", $idFili);

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $totalInaptEtReclaCadreEmploi = new BscHanditorialInaptEtReclaCadreEmplois(true);
        foreach ($bilanSocialConsolide->getBscHanditorialInaptEtReclaCadreEmplois() as $bscHanditorialInaptEtReclaCadreEmploi) {
            if ($idFili == null || $idFili != $bscHanditorialInaptEtReclaCadreEmploi->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                $totalInaptEtReclaCadreEmploi->cumulCadreEmploi($bscHanditorialInaptEtReclaCadreEmploi);
            }
        }

        $arrayTotalFiliere = array();
        foreach ($filieres as $filiere) {
            $arrayTotalFiliere[$filiere->getIdFili()] = null;
            foreach ($bilanSocialConsolide->getBscHanditorialInaptEtReclaCadreEmplois() as $key => $handi) {
                if ($handi->getRefCadreEmploi()->getRefFiliere()->getIdFili() == $filiere->getIdFili()) {
                    $totParFiliere = $handi->getTotalParFiliere();
                    $arrayTotalFiliere[$filiere->getIdFili()] += $totParFiliere;
                }
            }
        }

        $formHanditorialBscHanditorialInaptEtRecla = $this->createForm(BilanSocialConsolideHanditorialBscHanditorialInaptEtReclaCadreEmploisType::class, $bilanSocialConsolide);
        $formHanditorialBscHanditorialInaptEtRecla->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formHanditorialBscHanditorialInaptEtRecla->isSubmitted()) {

            $fgstat = $formHanditorialBscHanditorialInaptEtRecla['valide']->getData();

            // Traitement submit du form en AJAX

            if (!$formHanditorialBscHanditorialInaptEtRecla->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit

            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getBscHanditorialInaptEtReclaCadreEmploisTemp() as $bscHanditorialInaptEtReclaCadreEmploi) {
                    if ($bscHanditorialInaptEtReclaCadreEmploi->getBscHanditorialInaptEtReclaCadreEmplois() == null || $bscHanditorialInaptEtReclaCadreEmploi->getBscHanditorialInaptEtReclaCadreEmplois() == 0) {
                        $bscHanditorialInaptEtReclaCadreEmploi->setDtCrea($now);
                        $bscHanditorialInaptEtReclaCadreEmploi->setCdUtilcrea($cdUtil);
                        $bscHanditorialInaptEtReclaCadreEmploi->setBilanSocialConsolide($bilanSocialConsolide);
                        $this->getEntityManager()->persist($bscHanditorialInaptEtReclaCadreEmploi);
                        $bilanSocialConsolide->getBscHanditorialInaptEtReclaCadreEmplois()->add($bscHanditorialInaptEtReclaCadreEmploi);
                    }
                }

                $bilanSocialConsolide->setHanditorialInaptEtReclaCadreEmploisNullToZero() ;
                $bilanSocialConsolide->setMoyenneHanditorialInaptEtReclaCadreEmplois(100);
                $bilanSocialConsolide->setBlIncoHanditorialInaptEtReclaCadreEmplois(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseHanditorial("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editHanditorialBscHanditorialInaptEtReclaCadreEmploi.html.twig', array(
                    'formHanditorialBscHanditorialInaptEtRecla' => $formHanditorialBscHanditorialInaptEtRecla->createView(),
                    'incoherenceList'                              => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'                => $questionnaire,
                    'filieres'                                     => $filieres,
                    'idFili'                                       => $idFili,
                    'totalInaptEtReclaCadreEmploi'                 => $totalInaptEtReclaCadreEmploi,
                    'arrayTotalFiliere'                            => $arrayTotalFiliere
        ));
    }

    public function EditBilanSocialConsolideHanditorialBscHanditorialMetiersAction(Request $request) {
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

        if ($questionnaire->GetQ2() == true || $questionnaire->GetQ4() == true){
            $bsConsoIndPreparator->initIndicateurByName("BscHanditorialMetiers");
            $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialMetiers",$idFamilleMetier);
        }

        // Calcul Totaux hors filieres selectionné
        $totalBscHanditorialMetiers = new BscHanditorialMetiers(true);
        foreach ($bilanSocialConsolide->getBscHanditorialMetiers() as $bscHanditorialMetiers) {
            if ($idFamilleMetier == null || $idFamilleMetier != $bscHanditorialMetiers->getRefMetier()->getRefFamilleMetier()->getIdFamilleMetier()) {
                $totalBscHanditorialMetiers->cumulRNbx($bscHanditorialMetiers);
            }
        }

        $arrayTotalFamilleMetier = array();
        foreach ($familleMetier as $famille) {
            $arrayTotalFamilleMetier[$famille->getIdFamilleMetier()] = null;
            foreach ($bilanSocialConsolide->getBscHanditorialMetiers() as $key => $metier) {
                if ($metier->getRefMetier()->getRefFamilleMetier()->getIdFamilleMetier() == $famille->getIdFamilleMetier()) {
                    $totParFamille = $metier->getTotalParFamille();
                    $arrayTotalFamilleMetier[$famille->getIdFamilleMetier()] += $totParFamille;
                }
            }
        }

        //error_log('bscHanditorialMetiers before createform ' . $bilanSocialConsolide->getBscHanditorialMetiersTemp()->count());
        // Set des elements du form
        $formHanditorialMetiers = $this->createForm(BilanSocialConsolideHanditorialBscHanditorialMetiersType::class, $bilanSocialConsolide);
        //error_log('bscHanditorialMetiers before handlerequest ' . $bilanSocialConsolide->getBscHanditorialMetiersTemp()->count());
        $formHanditorialMetiers->handleRequest($request);
        // error_log('bscHanditorialMetiers  after handlerequest ' . $bilanSocialConsolide->getBscHanditorialMetiersTemp()->count());

        $now = new DateTime('NOW');
        if ($formHanditorialMetiers->isSubmitted()) {



            $fgstat = $formHanditorialMetiers['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formHanditorialMetiers->isValid()) {
                echo "Form invalide";
                error_log($formHanditorialMetiers->getErrors(), 0);
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }


                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getBscHanditorialMetiersTemp() as $bscHanditorialMetiers) {
                    if ($bscHanditorialMetiers->getBscHanditorialMetiers() == null || $bscHanditorialMetiers->getBscHanditorialMetiers() == 0) {
                        $bscHanditorialMetiers->setDtModi($now);
                        $bscHanditorialMetiers->setDtCrea($now);
                        $bscHanditorialMetiers->setCdUtilcrea($cdUtil);
                        $bscHanditorialMetiers->setBilanSocialConsolide($bilanSocialConsolide);
                        $this->getEntityManager()->persist($bscHanditorialMetiers);
                        $bilanSocialConsolide->getBscHanditorialMetiers()->add($bscHanditorialMetiers);
                    }
                }

                //
                //error_log('before flush', 0);

                //                error_log('after flush', 0);
                $bilanSocialConsolide->setHanditorialMetiersNullToZero();
                $bilanSocialConsolide->setMoyenneHanditorialMetiers(100);
                $bilanSocialConsolide->setBlIncoHanditorialMetiers(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->getEntityManager()->getConnection()->commit();


                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);


                return $this->GetResponseHanditorial("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editHanditorialBscHanditorialMetiers.html.twig', array(
                    'formHanditorialMetiers'        => $formHanditorialMetiers->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList'               => $bilanSocialConsolide->getIncoherenceLogs(),
                    'familleMetier'                 => $familleMetier,
                    'idFamilleMetier'               => $idFamilleMetier,
                    'totalBscHanditorialMetiers'    => $totalBscHanditorialMetiers,
                    'arrayTotalFamilleMetier'       => $arrayTotalFamilleMetier
        ));
    }

     public function EditBilanSocialConsolideHanditorialBscHanditorialInaptEtReclaMetiersAction(Request $request) {
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

        if ($questionnaire->GetQ2() == true || $questionnaire->GetQ4() == true){
            $bsConsoIndPreparator->initIndicateurByName("BscHanditorialInaptEtReclaMetiers");
            $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialInaptEtReclaMetiers",$idFamilleMetier);
        }

        // Calcul Totaux hors filieres selectionné
        $totalBscHanditorialInaptEtReclaMetiers = new BscHanditorialInaptEtReclaMetiers(true);
        foreach ($bilanSocialConsolide->getBscHanditorialInaptEtReclaMetiers() as $bscHanditorialInaptEtReclaMetiers) {
            if ($idFamilleMetier == null || $idFamilleMetier != $bscHanditorialInaptEtReclaMetiers->getRefMetier()->getRefFamilleMetier()->getIdFamilleMetier()) {
                $totalBscHanditorialInaptEtReclaMetiers->cumulRNbx($bscHanditorialInaptEtReclaMetiers);
            }
        }

        $arrayTotalFamilleMetier = array();
        foreach ($familleMetier as $famille) {
            $arrayTotalFamilleMetier[$famille->getIdFamilleMetier()] = null;
            foreach ($bilanSocialConsolide->getBscHanditorialInaptEtReclaMetiers() as $key => $metier) {
                if ($metier->getRefMetier()->getRefFamilleMetier()->getIdFamilleMetier() == $famille->getIdFamilleMetier()) {
                    $totParFamille = $metier->getTotalParFamille();
                    $arrayTotalFamilleMetier[$famille->getIdFamilleMetier()] += $totParFamille;
                }
            }
        }

        //error_log('bscHanditorialMetiers before createform ' . $bilanSocialConsolide->getBscHanditorialMetiersTemp()->count());
        // Set des elements du form
        $formHanditorialInaptEtReclaMetiers = $this->createForm(BilanSocialConsolideHanditorialBscHanditorialInaptEtReclaMetiersType::class, $bilanSocialConsolide);
        //error_log('bscHanditorialMetiers before handlerequest ' . $bilanSocialConsolide->getBscHanditorialMetiersTemp()->count());
        $formHanditorialInaptEtReclaMetiers->handleRequest($request);
        // error_log('bscHanditorialMetiers  after handlerequest ' . $bilanSocialConsolide->getBscHanditorialMetiersTemp()->count());

        $now = new DateTime('NOW');
        if ($formHanditorialInaptEtReclaMetiers->isSubmitted()) {



            $fgstat = $formHanditorialInaptEtReclaMetiers['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formHanditorialInaptEtReclaMetiers->isValid()) {
                echo "Form invalide";
                error_log($formHanditorialInaptEtReclaMetiers->getErrors(), 0);
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }


                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getBscHanditorialInaptEtReclaMetiersTemp() as $bscHanditorialInaptEtReclaMetiers) {
                    if ($bscHanditorialInaptEtReclaMetiers->getBscHanditorialInaptEtReclaMetiers() == null || $bscHanditorialInaptEtReclaMetiers->getBscHanditorialInaptEtReclaMetiers() == 0) {
                        $bscHanditorialInaptEtReclaMetiers->setDtModi($now);
                        $bscHanditorialInaptEtReclaMetiers->setDtCrea($now);
                        $bscHanditorialInaptEtReclaMetiers->setCdUtilcrea($cdUtil);
                        $bscHanditorialInaptEtReclaMetiers->setBilanSocialConsolide($bilanSocialConsolide);
                        $this->getEntityManager()->persist($bscHanditorialInaptEtReclaMetiers);
                        $bilanSocialConsolide->getBscHanditorialInaptEtReclaMetiers()->add($bscHanditorialInaptEtReclaMetiers);
                    }
                }

                //
                //error_log('before flush', 0);

                //                error_log('after flush', 0);
                $bilanSocialConsolide->setHanditorialInaptEtReclaMetiersNullToZero();
                $bilanSocialConsolide->setMoyenneHanditorialInaptEtReclaMetiers(100);
                $bilanSocialConsolide->setBlIncoHanditorialInaptEtReclaMetiers(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->getEntityManager()->getConnection()->commit();


                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);


                return $this->GetResponseHanditorial("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editHanditorialBscHanditorialInaptEtReclaMetiers.html.twig', array(
                    'formHanditorialInaptEtReclaMetiers'        => $formHanditorialInaptEtReclaMetiers->createView(),
                    'questionCollectiviteConsolide'             => $questionnaire,
                    'incoherenceList'                           => $bilanSocialConsolide->getIncoherenceLogs(),
                    'familleMetier'                             => $familleMetier,
                    'idFamilleMetier'                           => $idFamilleMetier,
                    'totalBscHanditorialInaptEtReclaMetiers'    => $totalBscHanditorialInaptEtReclaMetiers,
                    'arrayTotalFamilleMetier'                   => $arrayTotalFamilleMetier
        ));
    }

    public function EditBilanSocialConsolideHanditorialBscHanditorialTempsCompletsAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialTempsComplets");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialTempsComplets");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialTempsPleins");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialTempsPleins");

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formHanditorialBscHanditorialTempsComplets = $this->createForm(BilanSocialConsolideHanditorialBscHanditorialTempsCompletsType::class, $bilanSocialConsolide);
        $formHanditorialBscHanditorialTempsComplets->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formHanditorialBscHanditorialTempsComplets->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formHanditorialBscHanditorialTempsComplets->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit

            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    $bscHanditorialTempsComplets->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($bscHanditorialTempsComplets);
                }

                $bilanSocialConsolide->setMoyenneHanditorialTempsComplets(100);
                $bilanSocialConsolide->setBlIncoHanditorialTempsComplets(4);
                $bilanSocialConsolide->setHanditorialTpstravailNullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseHanditorial("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editHanditorialBscHanditorialTempsComplets.html.twig', array(
                    'formHanditorialBscHanditorialTempsComplets' => $formHanditorialBscHanditorialTempsComplets->createView(),
                    'incoherenceList'                            => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'              => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideHanditorialBscHanditorialInaptEtReclaTempsCompletsAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialInaptEtReclaTempsComplets");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialInaptEtReclaTempsComplets");
        $bsConsoIndPreparator->initIndicateurByName("BscHanditorialTempsPleins");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscHanditorialTempsPleins");
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;
        $formHanditorialBscHanditorialInaptEtReclaTempsComplets = $this->createForm(BilanSocialConsolideHanditorialBscHanditorialInaptEtReclaTempsCompletsType::class, $bilanSocialConsolide);
        $formHanditorialBscHanditorialInaptEtReclaTempsComplets->handleRequest($request);
        $now = new DateTime('NOW');
        if ($formHanditorialBscHanditorialInaptEtReclaTempsComplets->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formHanditorialBscHanditorialInaptEtReclaTempsComplets->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit

            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    $bscHanditorialInaptEtReclaTempsComplets->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($bscHanditorialInaptEtReclaTempsComplets);
                }

                $bilanSocialConsolide->setMoyenneHanditorialInaptEtReclaTempsComplets(100);
                $bilanSocialConsolide->setBlIncoHanditorialInaptEtReclaTempsComplets(4);
                $bilanSocialConsolide->setHanditorialInaptEtReclaTempsCompletsNullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseHanditorial("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseHanditorial("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editHanditorialBscHanditorialInaptEtReclaTempsComplets.html.twig', array(
                    'formHanditorialBscHanditorialInaptEtReclaTempsComplets' => $formHanditorialBscHanditorialInaptEtReclaTempsComplets->createView(),
                    'incoherenceList'                                        => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'                          => $questionnaire
        ));
    }

}
