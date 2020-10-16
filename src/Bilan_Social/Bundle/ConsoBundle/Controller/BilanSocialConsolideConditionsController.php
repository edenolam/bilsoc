<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind421;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind422;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind423;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind423Fili;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind424;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideConditionsInd411Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideConditionsInd413Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideConditionsInd414Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideConditionsInd421Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideConditionsInd422Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideConditionsInd423Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideConditionsInd424Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideConditionsInd425Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideConditionsInd431Type;
use DateTime;
use Bilan_Social\Bundle\ConsoBundle\Controller\BilanSocialConsolideController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class BilanSocialConsolideConditionsController extends BilanSocialConsolideController {

    public $idFiliAotm = 11;
    public $idFiliH = 12;
    public $idFiliHH = 14;

    public function GetResponseConditions($code, $bilanSocialConsolide) {
        $json = $this->getNumberQuestion($bilanSocialConsolide);
        $json['data'] = $code;
        // nmForm = 5
        return new JsonResponse($json);
    }

    public function EditBilanSocialConsolideConditionsAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();

        $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);
        $em = $this->getDoctrine()->getManager();
        $ind411s = $em->getRepository('ConsoBundle:Ind411')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind412s = $em->getRepository('ConsoBundle:Ind412')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind421s = $em->getRepository('ConsoBundle:Ind421')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind422s = $em->getRepository('ConsoBundle:Ind422')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind423s = $em->getRepository('ConsoBundle:Ind423')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind424s = $em->getRepository('ConsoBundle:Ind424')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind431s = $em->getRepository('ConsoBundle:Ind431')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());

        $totalInd411R4111 = 0;
        foreach ($ind411s as $ind411) {
               $totalInd411R4111 += $ind411->getR4111(0);
        }
        $totalInd412R4121 = 0;
        $totalInd412R4122 = 0;
        $totalInd412R4123 = 0;
        foreach ($ind412s as $ind412) {
               $totalInd412R4121 += $ind412->getR4121(0);
               $totalInd412R4122 += $ind412->getR4122(0);
               $totalInd412R4123 += $ind412->getR4123(0);
        }
        $totalInd411 = $totalInd411R4111 + $totalInd412R4121 + $totalInd412R4122 + $totalInd412R4123;

        //ind421
        $totalInd421R4211 = 0;
        $totalInd421R4212 = 0;
        $totalInd421R4213 = 0;
        $totalInd421R4214 = 0;
        $totalInd421R4215 = 0;
        $totalInd421R4216 = 0;
        $totalInd421R4217 = 0;
        $totalInd421R4218 = 0;
        $totalInd421R4219 = 0;
        $totalInd421R42110 = 0;
        $totalInd421R42111 = 0;
        $totalInd421R42112 = 0;
        foreach ($ind421s as $ind421) {
               $totalInd421R4211 += $ind421->getR4211(0);
               $totalInd421R4212 += $ind421->getR4212(0);
               $totalInd421R4213 += $ind421->getR4213(0);
               $totalInd421R4214 += $ind421->getR4214(0);
               $totalInd421R4215 += $ind421->getR4215(0);
               $totalInd421R4216 += $ind421->getR4216(0);
               $totalInd421R4217 += $ind421->getR4217(0);
               $totalInd421R4218 += $ind421->getR4218(0);
               $totalInd421R4219 += $ind421->getR4219(0);
               $totalInd421R42110 += $ind421->getR42110(0);
               $totalInd421R42111 += $ind421->getR42111(0);
               $totalInd421R42112 += $ind421->getR42112(0);
        }
        $totalInd421 = $totalInd421R4211 + $totalInd421R4212 + $totalInd421R4213 + $totalInd421R4214 + $totalInd421R4215 + $totalInd421R4216 + $totalInd421R4217 + $totalInd421R4218 + $totalInd421R4219 + $totalInd421R42110 + $totalInd421R42111 + $totalInd421R42112;

        //ind422
        $totalInd422R4221 = 0;
        $totalInd422R4222 = 0;
        $totalInd422R4223 = 0;
        $totalInd422R4224 = 0;
        $totalInd422R4225 = 0;
        $totalInd422R4226 = 0;
        $totalInd422R4227 = 0;
        $totalInd422R4228 = 0;
        foreach ($ind422s as $ind422) {
               $totalInd422R4221 += $ind422->getR4221(0);
               $totalInd422R4222 += $ind422->getR4222(0);
               $totalInd422R4223 += $ind422->getR4223(0);
               $totalInd422R4224 += $ind422->getR4224(0);
               $totalInd422R4225 += $ind422->getR4225(0);
               $totalInd422R4226 += $ind422->getR4226(0);
               $totalInd422R4227 += $ind422->getR4227(0);
               $totalInd422R4228 += $ind422->getR4228(0);
        }
        $totalInd422 = $totalInd422R4221 + $totalInd422R4222 + $totalInd422R4223 + $totalInd422R4224 + $totalInd422R4225 + $totalInd422R4226 + $totalInd422R4227 + $totalInd422R4228;

        //ind423
        $totalInd423R4231 = 0;
        foreach ($ind423s as $ind423) {
               $totalInd423R4231 += $ind423->getR4231(0);
        }
        $totalInd423 = $totalInd423R4231; 

        //ind424
        $totalInd424RTS4241 = 0;
        $totalInd424RTS4242 = 0;
        $totalInd424RTS4243 = 0;
        $totalInd424RTS4244 = 0;
        $totalInd424RTS4245 = 0;
        $totalInd424RTS4246 = 0;
        $totalInd424REMP4241 = 0;
        $totalInd424REMP4242 = 0;
        $totalInd424REMP4243 = 0;
        $totalInd424REMP4244 = 0;
        $totalInd424REMP4245 = 0;
        $totalInd424REMP4246 = 0;
        foreach ($ind424s as $ind424) {
               $totalInd424RTS4241 += $ind424->getRTS4241(0);
               $totalInd424RTS4242 += $ind424->getRTS4242(0);
               $totalInd424RTS4243 += $ind424->getRTS4243(0);
               $totalInd424RTS4244 += $ind424->getRTS4244(0);
               $totalInd424RTS4245 += $ind424->getRTS4245(0);
               $totalInd424RTS4246 += $ind424->getRTS4246(0);
               $totalInd424REMP4241 += $ind424->getREMP4241(0);
               $totalInd424REMP4242 += $ind424->getREMP4242(0);
               $totalInd424REMP4243 += $ind424->getREMP4243(0);
               $totalInd424REMP4244 += $ind424->getREMP4244(0);
               $totalInd424REMP4245 += $ind424->getREMP4245(0);
               $totalInd424REMP4246 += $ind424->getREMP4246(0);
        }
        $totalInd424 = $totalInd424RTS4241 + $totalInd424RTS4242 + $totalInd424RTS4243 + $totalInd424RTS4244 + $totalInd424RTS4245 + $totalInd424RTS4246 + $totalInd424REMP4241 + $totalInd424REMP4242 + $totalInd424REMP4243 + $totalInd424REMP4244 + $totalInd424REMP4245 + $totalInd424REMP4246;

        //ind425

//        $totalInd422Q422 = 0;
//        $totalInd422Q422 = $ind425->getQ425(0);
//
//        $totalInd425 = $totalInd422Q422;

        //ind425

        $totalInd422Q422 = $bilanSocialConsolide->getQ425();
        $totalInd425 = $totalInd422Q422;


        //ind431
        $totalInd431R43111 = 0;
        $totalInd431R43112 = 0;
        $totalInd431R43121 = 0;
        $totalInd431R43122 = 0;
        $totalInd431R43131 = 0;
        $totalInd431R43132 = 0;
        foreach ($ind431s as $ind431) {
               $totalInd431R43111 += $ind431->getR43111(0);
               $totalInd431R43112 += $ind431->getR43112(0);

               $totalInd431R43121 += $ind431->getR43121(0);
               $totalInd431R43122 += $ind431->getR43122(0);

               $totalInd431R43131 += $ind431->getR43131(0);
               $totalInd431R43132 += $ind431->getR43132(0);               
        }
        $totalInd4311 = $totalInd431R43111 + $totalInd431R43112;
        $totalInd4312 = $totalInd431R43121 + $totalInd431R43122;
        $totalInd4313 = $totalInd431R43131 + $totalInd431R43132;

        return $this->render('@Conso/BilanSocialConsolide/editConditions.html.twig', array(
                    'questionCollectiviteConsolide' => $questionnaire,
                    'consolide' => $bilanSocialConsolide,
                    'incoherenceList' => ($bilanSocialConsolide == null ? null : $bilanSocialConsolide->getIncoherenceLogs()),
                    'nombreQuestion' => $nombreQuestion,
                    'canwrite' => $this->isUserCanWrite(),
                    'collectivite' => $this->getMaCollectivite(),
                    'totalInd411' => $totalInd411,
                    'totalInd421' => $totalInd421,
                    'totalInd422' => $totalInd422,
                    'totalInd423' => $totalInd423,
                    'totalInd424' => $totalInd424,
                    'totalInd425' => $totalInd425,
                    'totalInd4311' => $totalInd4311,
                    'totalInd4312' => $totalInd4312,
                    'totalInd4313' => $totalInd4313,
                   

        ));
    }

    public function EditBilanSocialConsolideConditionsInd411Action(Request $request) {
        $typemissprev = $this->getEntityManager()->getRepository('ReferencielBundle:RefTypeMissionPrevention')->findBy(array('blVali' => false));
        $actionprev = $this->getEntityManager()->getRepository('ReferencielBundle:RefActionPrevention')->findBy(array('blVali' => false));

        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $bsConsoIndPreparator->initIndicateurByName("Ind411");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind411");
        $bsConsoIndPreparator->initIndicateurByName("Ind412");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind412");

        $formConditions411 = $this->createForm(BilanSocialConsolideConditionsInd411Type::class, $bilanSocialConsolide);
        $formConditions411->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formConditions411->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formConditions411->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setConditionsDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setInd411NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseConditions("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseConditions("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseConditions("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editConditionsInd411.html.twig', array(
                    'formConditions411' => $formConditions411->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideConditionsInd413Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formConditions413 = $this->createForm(BilanSocialConsolideConditionsInd413Type::class, $bilanSocialConsolide);
        $formConditions413->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formConditions413->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formConditions413->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setConditionsDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setBlUpdated(true);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseConditions("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseConditions("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseConditions("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editConditionsInd413.html.twig', array(
                    'formConditions413' => $formConditions413->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideConditionsInd414Action(Request $request) {

        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }
        $campagne = $this->getMaCampagne();
        $formConditions414 = $this->createForm(BilanSocialConsolideConditionsInd414Type::class, $bilanSocialConsolide, array('anneeCamp' => $campagne->getNmAnne()));
        $formConditions414->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formConditions414->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formConditions414->isValid()) {
                echo "Form invalide";
                exit;
            }
            if($formConditions414['q414']->getData() !== 1){
                $bilanSocialConsolide->setR4141(null);
                $bilanSocialConsolide->setR4142(null);
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setConditionsDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setBlUpdated(true);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseConditions("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseConditions("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseConditions("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editConditionsInd414.html.twig', array(
                    'formConditions414' => $formConditions414->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideConditionsInd421Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() == null;

        $idFili = $request->query->get("idFili");
        $q421Temp = "1";
        if($idFili=="0") {
            $q421Temp = "0";
        }
        $bsConsoIndPreparator->initIndicateurByName("Ind421");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind421",$idFili);
        $bsConsoIndPreparator->initIndicateurByName("Ind421AOTM");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind421AOTM");
        $bsConsoIndPreparator->initIndicateurByName("Ind421H");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind421H");
        //error_log('------------------------------------------------------------------', 0);
        //error_log('idfili ' . $idFili , 0);
        $filieres = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findByAllExceptAotmHorsFiliWithOrder();

        // Calcul Totaux hors filieres selectionné
        $totalInd421 = new Ind421(true);
        foreach ($bilanSocialConsolide->getInd421s() as $ind421) {
            if($ind421->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliAotm &&
                    $ind421->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliH && 
                    $ind421->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliHH ) {
                if ($idFili == null || $idFili != $ind421->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                    $totalInd421->cumulR421x($ind421);
                }
            }
        }

        $arrayTotalFiliere = array();
        foreach ($filieres as $filiere) {
            $arrayTotalFiliere[$filiere->getIdFili()] = null;
            foreach ($bilanSocialConsolide->getInd421s() as $key => $ind421) {
                if ($ind421->getRefCadreEmploi()->getRefFiliere()->getIdFili() == $filiere->getIdFili()) {
                    $totParFiliere = $ind421->getTotalParFiliere();
                    $arrayTotalFiliere[$filiere->getIdFili()] += $totParFiliere;
                }
            }
        }



        $total21XH_1 = 0; // F13 => F14
        $total21XF_1 = 0; // G13 => G14

        $total21XH_2 = 0; // F14 => F15
        $total21XF_2 = 0; // G14 => G15

        foreach ($bilanSocialConsolide->getInd2111s() as $ind2111) {
            // service
            if($ind2111->getRefMotifAbsence()->getCdMotiabse() == "ABS003") {
                $total21XH_1 += $ind2111->getR21113(0);
                $total21XF_1 += $ind2111->getR21114(0);
            }

            // atrajet
            if($ind2111->getRefMotifAbsence()->getCdMotiabse() == "ABS004") {
                $total21XH_2 += $ind2111->getR21113(0);
                $total21XF_2 += $ind2111->getR21114(0);
            }
        }

       // error_log('total21XH_1 = ' . $total21XH_1);

        foreach ($bilanSocialConsolide->getInd2121s() as $ind2121) {
            // service
            if($ind2121->getRefMotifAbsence()->getCdMotiabse() == "ABS003") {
                $total21XH_1 += $ind2121->getR21213(0);
                $total21XF_1 += $ind2121->getR21214(0);
            }

            // trajet
            if($ind2121->getRefMotifAbsence()->getCdMotiabse() == "ABS004") {
                $total21XH_2 += $ind2121->getR21213(0);
                $total21XF_2 += $ind2121->getR21214(0);
            }
        }

        //error_log('total21XH_1 = ' . $total21XH_1);

        foreach ($bilanSocialConsolide->getInd2131s() as $ind2131) {
            // service
            if($ind2131->getRefMotifAbsence()->getCdMotiabse() == "ABS003") {
                $total21XH_1 += $ind2131->getR21313(0);
                $total21XF_1 += $ind2131->getR21314(0);
            }

            // trajet
            if($ind2131->getRefMotifAbsence()->getCdMotiabse() == "ABS004") {
                $total21XH_2 += $ind2131->getR21313(0);
                $total21XF_2 += $ind2131->getR21314(0);
            }
        }



        //error_log('ind421 before createform ' . $bilanSocialConsolide->getInd421sTemp()->count());
        // Set des elements du form
        $formConditions421 = $this->createForm(BilanSocialConsolideConditionsInd421Type::class, $bilanSocialConsolide);
        //error_log('ind421 before handlerequest ' . $bilanSocialConsolide->getInd421sTemp()->count());
        $formConditions421->handleRequest($request);
        // error_log('ind421  after handlerequest ' . $bilanSocialConsolide->getInd421sTemp()->count());

        $now = new DateTime('NOW');
        if ($formConditions421->isSubmitted()) {
            $fgstat = $formConditions421['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formConditions421->isValid()) {
                echo "Form invalide";
                error_log($formConditions421->getErrors(), 0);
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setConditionsDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }


                foreach ($bilanSocialConsolide->getInd421sTemp() as $ind421) {
                    if ($ind421->getId421() == null || $ind421->getId421() == 0) {
                        $ind421->setDtCrea($now);
                        $ind421->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind421);
                        $bilanSocialConsolide->getInd421s()->add($ind421);
                    }
                }
                foreach ($bilanSocialConsolide->getInd421AotmsTemp() as $ind421) {
                    if ($ind421->getId421() == null || $ind421->getId421() == 0) {
                        $ind421->setDtCrea($now);
                        $ind421->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind421);
                        $bilanSocialConsolide->getInd421s()->add($ind421);
                    }
                }
                foreach ($bilanSocialConsolide->getInd421HsTemp() as $ind421) {
                    if ($ind421->getId421() == null || $ind421->getId421() == 0) {
                        $ind421->setDtCrea($now);
                        $ind421->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind421);
                        $bilanSocialConsolide->getInd421s()->add($ind421);
                    }
                }

                $bilanSocialConsolide->setInd421NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                if ($bilanSocialConsolide->getQ421() == null || $bilanSocialConsolide->getQ421() != 1) {
                    foreach ($bilanSocialConsolide->getInd421s() as $ind421) {
                        $ind421->initR421xToNull();
                    }
                }


                //error_log('before flush', 0);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

               // error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseConditions("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseConditions("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseConditions("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editConditionsInd421.html.twig', array(
                    'formConditions421' => $formConditions421->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'filieres' => $filieres,
                    'idFili' => $idFili,
                    'q421Temp' => $q421Temp,
                    'totalInd421'                   => $totalInd421,
                    'arrayTotalFiliere'             => $arrayTotalFiliere,
                    'total21XH_1' => $total21XH_1,
                    'total21XF_1' => $total21XF_1,
                    'total21XH_2' => $total21XH_2,
                    'total21XF_2' => $total21XF_2,

        ));
    }

    public function EditBilanSocialConsolideConditionsInd422Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $idFili = $request->query->get("idFili");
        $q422Temp = "1";
        if($idFili=="0") {
            $q422Temp = "0";
        }

        $bsConsoIndPreparator->initIndicateurByName("Ind422");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind422",$idFili);
        $bsConsoIndPreparator->initIndicateurByName("Ind422AOTM");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind422AOTM");
        $bsConsoIndPreparator->initIndicateurByName("Ind422H");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind422H");

        //error_log('------------------------------------------------------------------', 0);
        //error_log('idfili ' . $idFili , 0);
        $filieres = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findByAllExceptAotmHorsFiliWithOrder();

        // Calcul Totaux hors filieres selectionné
        $totalInd422 = new Ind422(true);
        foreach ($bilanSocialConsolide->getInd422s() as $ind422) {
            if($ind422->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliAotm && 
                    $ind422->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliH && 
                    $ind422->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliHH ) {
                if ($idFili == null || $idFili != $ind422->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                    $totalInd422->cumulR422x($ind422);
                }
            }
        }

        $arrayTotalFiliere = array();
        foreach ($filieres as $filiere) {
            $arrayTotalFiliere[$filiere->getIdFili()] = null;
            foreach ($bilanSocialConsolide->getInd422s() as $key => $ind422) {
                if ($ind422->getRefCadreEmploi()->getRefFiliere()->getIdFili() == $filiere->getIdFili()) {
                    $totParFiliere = $ind422->getTotalParFiliere();
                    $arrayTotalFiliere[$filiere->getIdFili()] += $totParFiliere;
                }
            }
        }



        $total21XH_1 = 0; // F17 => F18
        $total21XF_1 = 0; // G17 => G18

        foreach ($bilanSocialConsolide->getInd2111s() as $ind2111) {
            // MP
            if($ind2111->getRefMotifAbsence()->getCdMotiabse() == "ABS005") {
                $total21XH_1 += $ind2111->getR21113(0);
                $total21XF_1 += $ind2111->getR21114(0);
            }

        }

       // error_log('total21XH_1 = ' . $total21XH_1);

        foreach ($bilanSocialConsolide->getInd2121s() as $ind2121) {
            // MP
            if($ind2121->getRefMotifAbsence()->getCdMotiabse() == "ABS005") {
                $total21XH_1 += $ind2121->getR21213(0);
                $total21XF_1 += $ind2121->getR21214(0);
            }

        }

        //error_log('total21XH_1 = ' . $total21XH_1);

        foreach ($bilanSocialConsolide->getInd2131s() as $ind2131) {
            // MP
            if($ind2131->getRefMotifAbsence()->getCdMotiabse() == "ABS005") {
                $total21XH_1 += $ind2131->getR21313(0);
                $total21XF_1 += $ind2131->getR21314(0);
            }

        }

        //error_log('ind422 before createform ' . $bilanSocialConsolide->getInd422sTemp()->count());
        // Set des elements du form
        $formConditions422 = $this->createForm(BilanSocialConsolideConditionsInd422Type::class, $bilanSocialConsolide);
        //error_log('ind422 before handlerequest ' . $bilanSocialConsolide->getInd422sTemp()->count());
        $formConditions422->handleRequest($request);
        // error_log('ind422  after handlerequest ' . $bilanSocialConsolide->getInd422sTemp()->count());

        $now = new DateTime('NOW');
        if ($formConditions422->isSubmitted()) {
            $fgstat = $formConditions422['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formConditions422->isValid()) {
                echo "Form invalide";
                error_log($formConditions422->getErrors(), 0);
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setConditionsDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getInd422sTemp() as $ind422) {
                    if ($ind422->getId422() == null || $ind422->getId422() == 0) {
                        $ind422->setDtCrea($now);
                        $ind422->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind422);
                        $bilanSocialConsolide->getInd422s()->add($ind422);
                    }
                }
                foreach ($bilanSocialConsolide->getInd422AotmsTemp() as $ind422) {
                    if ($ind422->getId422() == null || $ind422->getId422() == 0) {
                        $ind422->setDtCrea($now);
                        $ind422->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind422);
                        $bilanSocialConsolide->getInd422s()->add($ind422);
                    }
                }
                foreach ($bilanSocialConsolide->getInd422HsTemp() as $ind422) {
                    if ($ind422->getId422() == null || $ind422->getId422() == 0) {
                        $ind422->setDtCrea($now);
                        $ind422->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind422);
                        $bilanSocialConsolide->getInd422s()->add($ind422);
                    }
                }

                if ($bilanSocialConsolide->getQ422() == null || $bilanSocialConsolide->getQ422() != 1) {
                    foreach ($bilanSocialConsolide->getInd422s() as $ind422) {
                        $ind422->initR422xToNull();
                    }
                }

                $bilanSocialConsolide->setInd422NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                //error_log('before flush', 0);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

               // error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseConditions("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseConditions("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseConditions("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editConditionsInd422.html.twig', array(
                    'formConditions422' => $formConditions422->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'filieres' => $filieres,
                    'idFili' => $idFili,
                    'q422Temp' => $q422Temp,
                    'totalInd422'                   => $totalInd422,
                    'arrayTotalFiliere'             => $arrayTotalFiliere,
                    'total21XH_1' => $total21XH_1,
                    'total21XF_1' => $total21XF_1,
        ));
    }

    public function EditBilanSocialConsolideConditionsInd423Action(Request $request) {
        $inap = $this->getEntityManager()->getRepository('ReferencielBundle:RefInaptitude')->findBy(array('blVali' => false));
        $inapDem = $this->getEntityManager()->getRepository('ReferencielBundle:RefInaptitude')->findBy(array('blVali' => false, 'blDema' => true));
        $inapNotDema = $this->getEntityManager()->getRepository('ReferencielBundle:RefInaptitude')->findBy(array('blVali' => false, 'blDema' => false, 'blFili' => false));
        $fili = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findByAllWithOrder();

        $nbDem = count($inapDem);
        $nbFili = count($fili);
        $nbNotDema = count($inapNotDema);
        $nbDeci = $nbNotDema;

        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $bsConsoIndPreparator->initIndicateurByName("Ind423");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind423");
        $bsConsoIndPreparator->initIndicateurByName("Ind423Fili");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind423Fili");

        $bilanSocialConsolideClone = clone $bilanSocialConsolide;
        $bsConsoIndPreparator->setBs($bilanSocialConsolideClone);
        $bsConsoIndPreparator->initIndicateurByName("Ind423");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind423",null,array('force'=>true));
        $bsConsoIndPreparator->initIndicateurByName("Ind423Fili");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind423Fili",null,array('force'=>true));
        
        $nmSire = $this->getMaCollectivite()->getNmSire();
        $ancien_ind = [];
        $ancien_ind['ind_423'] = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind423", $bilanSocialConsolideClone);
        $ancienNbDem = 0;
        $ancienNbDeci = 0;
        if(!empty($ancien_ind['ind_423']) && is_array($ancien_ind['ind_423']['indicateur'])){
            $ancien_ind['ind_423Fili'] = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind423Fili", $bilanSocialConsolideClone);

            foreach ($ancien_ind['ind_423']['indicateur'] as $key => $ind) {
                if ($ind['BL_VALI'] == 0 && $ind['BL_DEMA'] == 1) {
                    $ancienNbDem++;
                } else if ($ind['BL_VALI'] == 0 && $ind['BL_DECI'] == 1 && $ind['BL_FILI'] == 0) {
                    $ancienNbDeci++;
                } else if ($ind['BL_FILI'] == 1) {
                    unset($ancien_ind['ind_423']['indicateur'][$key] );
                }
            }

            usort($ancien_ind['ind_423']['indicateur'], function ($a, $b) {
                return $a['ID_INAP'] <=> $b['ID_INAP'];
            });
        }else{
            $ancien_ind = null;
        }

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;//true;

        $formConditions423 = $this->createForm(BilanSocialConsolideConditionsInd423Type::class, $bilanSocialConsolide);
        $formConditions423->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formConditions423->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formConditions423->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setConditionsDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }
                $bilanSocialConsolide->setMoyenneInd423(100);
                $bilanSocialConsolide->setBlIncoInd423(4);
                $bilanSocialConsolide->setInd423NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseConditions("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseConditions("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseConditions("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editConditionsInd423.html.twig', array(
            'formConditions423' => $formConditions423->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire,
            'nbDem'                         => $nbDem,
            'nbDeci'                        => $nbDeci,
            'nbFili' => $nbFili,
            'indicateur_precedent'          => $ancien_ind,
            'ancienNbDem'                   => $ancienNbDem,
            'ancienNbDeci'                  => $ancienNbDeci
        ));
    }

    public function EditBilanSocialConsolideConditionsInd424Action(Request $request) {
        $statut = $this->getEntityManager()->getRepository('ReferencielBundle:RefStatut')->findByAllWithOrder();

        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $bsConsoIndPreparator->initIndicateurByName("Ind424");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind424");

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formConditions424 = $this->createForm(BilanSocialConsolideConditionsInd424Type::class, $bilanSocialConsolide);
        $formConditions424->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formConditions424->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formConditions424->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setConditionsDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setInd424NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseConditions("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseConditions("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseConditions("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editConditionsInd424.html.twig', array(
                    'formConditions424' => $formConditions424->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }



    public function EditBilanSocialConsolideConditionsInd425Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
//        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formConditions425 = $this->createForm(BilanSocialConsolideConditionsInd425Type::class, $bilanSocialConsolide);
        $formConditions425->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formConditions425->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formConditions425->isValid()) {
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
                $bilanSocialConsolide->setMoyenneInd425(100);
                $bilanSocialConsolide->setBlIncoInd425(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();
//                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseConditions("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseConditions("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseConditions("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editConditionsInd425.html.twig', array(
            'formConditions425' => $formConditions425->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
//            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideConditionsInd431Action(Request $request) {
        $acteviolphys = $this->getEntityManager()->getRepository('ReferencielBundle:RefActeViolencePhysique')->findBy(array('blVali' => false));

        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $bsConsoIndPreparator->initIndicateurByName("Ind431");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind431");

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $campagne = $this->getMaCampagne();

        $formConditions431 = $this->createForm(BilanSocialConsolideConditionsInd431Type::class, $bilanSocialConsolide, array('anneeCamp' => $campagne->getNmAnne()));
        $formConditions431->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formConditions431->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formConditions431->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setConditionsDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }
                $bilanSocialConsolide->setInd431NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseConditions("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseConditions("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseConditions("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editConditionsInd431.html.twig', array(
                    'formConditions431' => $formConditions431->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }
}
