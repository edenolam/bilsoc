<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;


use DateTime;
use Bilan_Social\Bundle\ConsoBundle\Controller\BilanSocialConsolideController;
use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideFormationInd5111Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideFormationInd5112Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideFormationInd5113Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideFormationInd512Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideFormationInd513Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideFormationInd514Type;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class BilanSocialConsolideFormationController extends BilanSocialConsolideController {


    public function GetResponseFormation($code, $bilanSocialConsolide, $afficheAlerte) {

            // '6' nb form
            $json = $this->getNumberQuestion($bilanSocialConsolide);
            $json['data'] = $code;

            return new JsonResponse($json);
        }



    public function EditBilanSocialConsolideFormationAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();

        $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);

        $em = $this->getDoctrine()->getManager();
        $ind5111s = $em->getRepository('ConsoBundle:Ind5111')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind5112s = $em->getRepository('ConsoBundle:Ind5112')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind5113s = $em->getRepository('ConsoBundle:Ind5113')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind5121s = $em->getRepository('ConsoBundle:Ind5121')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind5122s = $em->getRepository('ConsoBundle:Ind5122')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind513s = $em->getRepository('ConsoBundle:Ind513')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());

        //ind5111
        $totalInd5111R51111 = 0;
        $totalInd5111R51112 = 0;
        $totalInd5111R51113 = 0;
        $totalInd5111R51114 = 0;
        foreach ($ind5111s as $ind5111) {
               $totalInd5111R51111 += $ind5111->getR51111(0);
               $totalInd5111R51112 += $ind5111->getR51112(0);
               $totalInd5111R51113 += $ind5111->getR51113(0);
               $totalInd5111R51114 += $ind5111->getR51114(0);
        }
        $totalInd5111 = $totalInd5111R51111 + $totalInd5111R51112 + $totalInd5111R51113 + $totalInd5111R51114;

        //ind5112
        $totalInd5112R51121 = 0;
        $totalInd5112R51122 = 0;
        $totalInd5112R51123 = 0;
        $totalInd5112R51124 = 0;
        $totalInd5112R51125 = 0;
        $totalInd5112R51126 = 0;
        $totalInd5112R51127 = 0;
        $totalInd5112R51128 = 0;
        foreach ($ind5112s as $ind5112) {
               $totalInd5112R51121 += $ind5112->getR51121(0);
               $totalInd5112R51122 += $ind5112->getR51122(0);
               $totalInd5112R51123 += $ind5112->getR51123(0);
               $totalInd5112R51124 += $ind5112->getR51124(0);
               $totalInd5112R51125 += $ind5112->getR51125(0);
               $totalInd5112R51126 += $ind5112->getR51126(0);
               $totalInd5112R51127 += $ind5112->getR51127(0);
               $totalInd5112R51128 += $ind5112->getR51128(0);
        }
        $totalInd5112 = $totalInd5112R51121 + $totalInd5112R51122 + $totalInd5112R51123 + $totalInd5112R51124 + $totalInd5112R51125 + $totalInd5112R51126 + $totalInd5112R51127 + $totalInd5112R51128;

         //ind5113
        $totalInd5113R51131 = 0;
        $totalInd5113R51132 = 0;
        $totalInd5113R51133 = 0;
        $totalInd5113R51134 = 0;
        $totalInd5113R51135 = 0;
        $totalInd5113R51136 = 0;
        $totalInd5113R51137 = 0;
        $totalInd5113R51138 = 0;
        foreach ($ind5113s as $ind5113) {
               $totalInd5113R51131 += $ind5113->getR51131(0);
               $totalInd5113R51132 += $ind5113->getR51132(0);
               $totalInd5113R51133 += $ind5113->getR51133(0);
               $totalInd5113R51134 += $ind5113->getR51134(0);
               $totalInd5113R51135 += $ind5113->getR51135(0);
               $totalInd5113R51136 += $ind5113->getR51136(0);
               $totalInd5113R51137 += $ind5113->getR51137(0);
               $totalInd5113R51138 += $ind5113->getR51138(0);
        }
        $totalInd5113 = $totalInd5113R51131 + $totalInd5113R51132 + $totalInd5113R51133 + $totalInd5113R51134 + $totalInd5113R51135 + $totalInd5113R51136 + $totalInd5113R51137 + $totalInd5113R51138;

         //ind512
        $totalInd5121R51211 = 0;
        $totalInd5121R51212 = 0;
        $totalInd5121R51213 = 0;
        $totalInd5121R51214 = 0;
        $totalInd5121R51215 = 0;
        $totalInd5121R51216 = 0;
        $totalInd5121R51217 = 0;
        $totalInd5121R51218 = 0;
        foreach ($ind5121s as $ind5121) {
               $totalInd5121R51211 += $ind5121->getR51211(0);
               $totalInd5121R51212 += $ind5121->getR51212(0);
               $totalInd5121R51213 += $ind5121->getR51213(0);
               $totalInd5121R51214 += $ind5121->getR51214(0);
               $totalInd5121R51215 += $ind5121->getR51215(0);
               $totalInd5121R51216 += $ind5121->getR51216(0);
               $totalInd5121R51217 += $ind5121->getR51217(0);
               $totalInd5121R51218 += $ind5121->getR51218(0);
        }
        $totalInd5121 = $totalInd5121R51211 + $totalInd5121R51212 + $totalInd5121R51213 + $totalInd5121R51214 + $totalInd5121R51215 + $totalInd5121R51216 + $totalInd5121R51217 + $totalInd5121R51218;

        $totalInd5122R51221 = 0;
        $totalInd5122R51222 = 0;
        foreach ($ind5122s as $ind5122) {
               $totalInd5122R51221 += $ind5122->getR51221(0);
               $totalInd5122R51222 += $ind5122->getR51222(0);
        }
        $totalInd5122 = $totalInd5122R51221 + $totalInd5122R51222;

        $totalInd512 = $totalInd5121 + $totalInd5122;

         //ind513
        $totalInd513R5131 = 0;
        $totalInd513R5132 = 0;
        $totalInd513R5133 = 0;
        $totalInd513R5134 = 0;
        foreach ($ind513s as $ind513) {
               $totalInd513R5131 += $ind513->getR5131(0);
               $totalInd513R5132 += $ind513->getR5132(0);
               $totalInd513R5133 += $ind513->getR5133(0);
               $totalInd513R5134 += $ind513->getR5134(0);
        }
        $totalInd513 = $totalInd513R5131 + $totalInd513R5132 + $totalInd513R5133 + $totalInd513R5134; 

        //ind514
        $totalInd514R5141 = $bilanSocialConsolide->getR5141();
        $totalInd514R5142 = $bilanSocialConsolide->getR5142();
        $totalInd514R5143 = $bilanSocialConsolide->getR5143();
        $totalInd514R5144 = $bilanSocialConsolide->getR5144();
        $totalInd514 = $totalInd514R5141 + $totalInd514R5142 + $totalInd514R5143 + $totalInd514R5144;       

        return $this->render('@Conso/BilanSocialConsolide/editFormation.html.twig', array(
                    'questionCollectiviteConsolide' => $questionnaire,
                    'consolide' => $bilanSocialConsolide,
                    'incoherenceList' => ($bilanSocialConsolide == null ? null : $bilanSocialConsolide->getIncoherenceLogs()),
                    'nombreQuestion' => $nombreQuestion,
                    'canwrite' => $this->isUserCanWrite(),
                    'collectivite' => $this->getMaCollectivite(),
                    'totalInd5111' => $totalInd5111,
                    'totalInd5112' => $totalInd5112,
                    'totalInd5113' => $totalInd5113,
                    'totalInd512' => $totalInd512,
                    'totalInd513' => $totalInd513,
                    'totalInd514' => $totalInd514,
        ));
    }

    public function EditBilanSocialConsolideFormationInd5111Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $bsConsoIndPreparator->initIndicateurByName("Ind5111");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind5111");

        $bilanSocialConsolideClone = clone $bilanSocialConsolide;
        $bsConsoIndPreparator->setBs($bilanSocialConsolideClone);
        $bsConsoIndPreparator->initIndicateurByName("Ind5111");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind5111",null,array('force'=>true));
        
        $nmSire = $this->getMaCollectivite()->getNmSire();
        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind5111", $bilanSocialConsolideClone);

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $nbFonctH = 0;
        $nbFonctF = 0;
        $nbContractH = 0;
        $nbContractF = 0;

        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
            $nbFonctH += $ind111->getR1115(0);
            $nbFonctF += $ind111->getR1116(0);
        }

        foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
            $nbContractH += $ind121->getR12114(0) + $ind121->getR12115(0);
            $nbContractF += $ind121->getR12116(0) + $ind121->getR12117(0);
        }


        $formFormation5111 = $this->createForm(BilanSocialConsolideFormationInd5111Type::class, $bilanSocialConsolide);
        $formFormation5111->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formFormation5111->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formFormation5111->isValid()) {
		echo "Form invalide";
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
                $bilanSocialConsolide->setFormationDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd5111NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseFormation("1", $bilanSocialConsolide, 0);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseFormation("-3", $bilanSocialConsolide, 0);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseFormation("-1", $bilanSocialConsolide, 0);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editFormationInd5111.html.twig', array(
                    'formFormation5111' => $formFormation5111->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'nbFonctH' => $nbFonctH,
                    'nbFonctF' => $nbFonctF,
                    'nbContractH' => $nbContractH,
                    'nbContractF' => $nbContractF,
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent'          => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideFormationInd5112Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $bsConsoIndPreparator->initIndicateurByName("Ind5112");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind5112");

        $bilanSocialConsolideClone = clone $bilanSocialConsolide;
        $bsConsoIndPreparator->setBs($bilanSocialConsolideClone);
        $bsConsoIndPreparator->initIndicateurByName("Ind5112");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind5112",null,array('force'=>true));
        
        $nmSire = $this->getMaCollectivite()->getNmSire();
        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind5112", $bilanSocialConsolideClone);
        if(!empty($ancien_ind)){
            usort($ancien_ind['indicateur'], function ($a, $b) {
                return $a['ID_CATE'] <=> $b['ID_CATE'];
            });
        }

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $nbFonctH = 0;
        $nbFonctF = 0;
        $nbContractH = 0;
        $nbContractF = 0;

        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
            $nbFonctH += $ind111->getR1115(0);
            $nbFonctF += $ind111->getR1116(0);
        }

        foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
            $nbContractH += $ind121->getR12114(0) + $ind121->getR12115(0);
            $nbContractF += $ind121->getR12116(0) + $ind121->getR12117(0);
        }


        $formFormation5112 = $this->createForm(BilanSocialConsolideFormationInd5112Type::class, $bilanSocialConsolide);
        $formFormation5112->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formFormation5112->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formFormation5112->isValid()) {
		echo "Form invalide";
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
                $bilanSocialConsolide->setFormationDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd5112NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseFormation("1", $bilanSocialConsolide, 0);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseFormation("-3", $bilanSocialConsolide, 0);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseFormation("-1", $bilanSocialConsolide, 0);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editFormationInd5112.html.twig', array(
                    'formFormation5112' => $formFormation5112->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'nbFonctH' => $nbFonctH,
                    'nbFonctF' => $nbFonctF,
                    'nbContractH' => $nbContractH,
                    'nbContractF' => $nbContractF,
                    'questionCollectiviteConsolide' => $questionnaire,
                    "indicateur_precedent"          => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideFormationInd5113Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $bsConsoIndPreparator->initIndicateurByName("Ind5113");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind5113");

        $bilanSocialConsolideClone = clone $bilanSocialConsolide;
        $bsConsoIndPreparator->setBs($bilanSocialConsolideClone);
        $bsConsoIndPreparator->initIndicateurByName("Ind5113");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind5113",null,array('force'=>true));
        
        $nmSire = $this->getMaCollectivite()->getNmSire();
        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind5113", $bilanSocialConsolideClone);

        if(!empty($ancien_ind)){
            usort($ancien_ind['indicateur'], function ($a, $b) {
                return $a['ID_CATE'] <=> $b['ID_CATE'];
            });
        }

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $nbFonctH = 0;
        $nbFonctF = 0;
        $nbContractH = 0;
        $nbContractF = 0;

        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
            $nbFonctH += $ind111->getR1115(0);
            $nbFonctF += $ind111->getR1116(0);
        }

        foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
            $nbContractH += $ind121->getR12114(0) + $ind121->getR12115(0);
            $nbContractF += $ind121->getR12116(0) + $ind121->getR12117(0);
        }


        $formFormation5113 = $this->createForm(BilanSocialConsolideFormationInd5113Type::class, $bilanSocialConsolide);
        $formFormation5113->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formFormation5113->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formFormation5113->isValid()) {
		echo "Form invalide";
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
                $bilanSocialConsolide->setFormationDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd5113NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseFormation("1", $bilanSocialConsolide, 0);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseFormation("-3", $bilanSocialConsolide, 0);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseFormation("-1", $bilanSocialConsolide, 0);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editFormationInd5113.html.twig', array(
                    'formFormation5113' => $formFormation5113->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'nbFonctH' => $nbFonctH,
                    'nbFonctF' => $nbFonctF,
                    'nbContractH' => $nbContractH,
                    'nbContractF' => $nbContractF,
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent' => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideFormationInd512Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $bsConsoIndPreparator->initIndicateurByName("Ind5121");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind5121");
        $bsConsoIndPreparator->initIndicateurByName("Ind5122");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind5122");

        $bilanSocialConsolideClone = clone $bilanSocialConsolide;
        $bsConsoIndPreparator->setBs($bilanSocialConsolideClone);
        $bsConsoIndPreparator->initIndicateurByName("Ind5121");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind5121",null,array('force'=>true));
        $bsConsoIndPreparator->initIndicateurByName("Ind5122");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind5122",null,array('force'=>true));
        
        $nmSire = $this->getMaCollectivite()->getNmSire();
        $ancien_ind = [];
        $ancien_ind['ind_5121'] = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind5121", $bilanSocialConsolideClone);
        $ancien_ind['ind_5122'] = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind5122", $bilanSocialConsolideClone);
        if($ancien_ind['ind_5121']==null || $ancien_ind['ind_5122']==null){
            $ancien_id = null;
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $nbH = 0;
        $nbF = 0;

        foreach ($bilanSocialConsolide->getInd1311s() as $ind1311) {
            $nbH += $ind1311->getR13111(0);
            $nbF += $ind1311->getR13112(0);
        }

        $formFormation512 = $this->createForm(BilanSocialConsolideFormationInd512Type::class, $bilanSocialConsolide);
        $formFormation512->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formFormation512->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formFormation512->isValid()) {
		echo "Form invalide";
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
                $bilanSocialConsolide->setFormationDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd512NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseFormation("1", $bilanSocialConsolide, 0);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseFormation("-3", $bilanSocialConsolide, 0);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseFormation("-1", $bilanSocialConsolide, 0);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editFormationInd512.html.twig', array(
                    'formFormation512' => $formFormation512->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'nbH' => $nbH,
                    'nbF' => $nbF,
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent'          => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideFormationInd513Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $tabOneLine = array();
        $tabOneLine[0] = 1;

        $bsConsoIndPreparator->initIndicateurByName("Ind513");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind513");

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $total111_121_131 = 0;
        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
            $total111_121_131 += $ind111->getR1115(0) + $ind111->getR1116(0);
        }
        foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
            $total111_121_131 += $ind121->getR12117(0) + $ind121->getR12116(0) + $ind121->getR12115(0) + $ind121->getR12114(0);
        }
        foreach ($bilanSocialConsolide->getInd1311s() as $ind1311) {
            $total111_121_131 += $ind1311->getR13111(0) + $ind1311->getR13112(0);
        }

        $total111_121_131_10pc = $total111_121_131 * 10 / 100;

        $formFormation513 = $this->createForm(BilanSocialConsolideFormationInd513Type::class, $bilanSocialConsolide);
        $formFormation513->handleRequest($request);

        $total513 = 0;
        foreach ($bilanSocialConsolide->getInd513s() as $ind513) {
            $total513 += $ind513->getR5131(0) + $ind513->getR5132(0) + $ind513->getR5133(0) + $ind513->getR5134(0);
        }

        $afficheAlerte = 0;
        if($total513 > $total111_121_131_10pc) $afficheAlerte = 1;

        $now = new DateTime('NOW');
        if ($formFormation513->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formFormation513->isValid()) {
		echo "Form invalide";
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
                $bilanSocialConsolide->setFormationDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setMoyenneInd513(100);
                $bilanSocialConsolide->setBlIncoInd513(4);
                $bilanSocialConsolide->setInd513NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseFormation("1", $bilanSocialConsolide, $afficheAlerte);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), $afficheAlerte);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseFormation("-3", $bilanSocialConsolide, $afficheAlerte);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseFormation("-1", $bilanSocialConsolide, $afficheAlerte);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editFormationInd513.html.twig', array(
                    'formFormation513' => $formFormation513->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'total111_121_131' => $total111_121_131,
                    'afficheAlerte' => $afficheAlerte,
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideFormationInd514Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formFormation514 = $this->createForm(BilanSocialConsolideFormationInd514Type::class, $bilanSocialConsolide);
        $formFormation514->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formFormation514->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formFormation514->isValid()) {
		echo "Form invalide";
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
                $bilanSocialConsolide->setFormationDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd514NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseFormation("1", $bilanSocialConsolide, 0);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseFormation("-3", $bilanSocialConsolide, 0);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseFormation("-1", $bilanSocialConsolide, 0);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editFormationInd514.html.twig', array(
                    'formFormation514' => $formFormation514->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }
}
