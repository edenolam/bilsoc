<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind344;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRemunerationInd311Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRemunerationInd321Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRemunerationInd331Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRemunerationInd341Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRemunerationInd342Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRemunerationInd343Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRemunerationInd344Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRemunerationInd345Type;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\Exception;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class BilanSocialConsolideRemunerationController extends BilanSocialConsolideController {

    public $idFiliAotm = 11;
    public $idFiliHH = 14;

    public function GetResponseRemuneration($code, $bilanSocialConsolide) {
        $json = $this->getNumberQuestion($bilanSocialConsolide);
        $json['data'] = $code;
        // nmForm = 4
        return new JsonResponse($json);
    }

    public function EditBilanSocialConsolideRemunerationAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();

        $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);

        $em = $this->getDoctrine()->getManager();
        $ind311s = $em->getRepository('ConsoBundle:Ind311')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind321s = $em->getRepository('ConsoBundle:Ind321')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind331s = $em->getRepository('ConsoBundle:Ind331')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind344s = $em->getRepository('ConsoBundle:Ind344')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());

         //ind311
        $totalInd311R3111 = 0;
        $totalInd311R3112 = 0;
        $totalInd311R3113 = 0;
        $totalInd311R3114 = 0;
        $totalInd311R3115 = 0;
        $totalInd311R3116 = 0;
        $totalInd311R3117 = 0;
        $totalInd311R3118 = 0;
        $totalInd311R3119 = 0;
        $totalInd311R31110 = 0;
        foreach ($ind311s as $ind311) {
               $totalInd311R3111 += $ind311->getR3111(0);
               $totalInd311R3112 += $ind311->getR3112(0);
               $totalInd311R3113 += $ind311->getR3113(0);
               $totalInd311R3114 += $ind311->getR3114(0);
               $totalInd311R3115 += $ind311->getR3115(0);
               $totalInd311R3116 += $ind311->getR3116(0);
               $totalInd311R3117 += $ind311->getR3117(0);
               $totalInd311R3118 += $ind311->getR3118(0);
               $totalInd311R3119 += $ind311->getR3119(0);
               $totalInd311R31110 += $ind311->getR31110(0);
           }
        $totalInd311 = $totalInd311R3111 + $totalInd311R3112 + $totalInd311R3113 + $totalInd311R3114 + $totalInd311R3115 + $totalInd311R3116 + $totalInd311R3117 + $totalInd311R3118 + $totalInd311R3119 + $totalInd311R31110;

        //ind321
        $totalInd321R3211 = 0;
        $totalInd321R3212 = 0;
        $totalInd321R3213 = 0;
        $totalInd321R3214 = 0;
        $totalInd321R3215 = 0;
        $totalInd321R3216 = 0;
        foreach ($ind321s as $ind321) {
               $totalInd321R3211 += $ind321->getR3211(0);
               $totalInd321R3212 += $ind321->getR3212(0);
               $totalInd321R3213 += $ind321->getR3213(0);
               $totalInd321R3214 += $ind321->getR3214(0);
               $totalInd321R3215 += $ind321->getR3215(0);
               $totalInd321R3216 += $ind321->getR3216(0);
           }
        $totalInd321 = $totalInd321R3211 + $totalInd321R3212 + $totalInd321R3213 + $totalInd321R3214 + $totalInd321R3215 + $totalInd321R3216;

        //ind331
        $totalInd331R3311 = 0;
        $totalInd331R3312 = 0;
        foreach ($ind331s as $ind331) {
               $totalInd331R3311 += $ind331->getR3311(0);
               $totalInd331R3312 += $ind331->getR3312(0);
           }
        $totalInd331 = $totalInd331R3311 + $totalInd331R3312;

        //ind341
        $totalInd341R3411 = $bilanSocialConsolide->getR3411();
        $totalInd341R3412 = $bilanSocialConsolide->getR3412();
        $totalInd341 = $totalInd341R3411 + $totalInd341R3412;

        //ind342
        $totalInd342 = $bilanSocialConsolide->getR342();


        //ind344
        $totalInd344R3441 = 0;
        $totalInd344R3442 = 0;
        $totalInd344R3443 = 0;
        $totalInd344R3444 = 0;
        foreach ($ind344s as $ind344) {
               $totalInd344R3441 += $ind344->getR3441(0);
               $totalInd344R3442 += $ind344->getR3442(0);
               $totalInd344R3443 += $ind344->getR3443(0);
               $totalInd344R3444 += $ind344->getR3444(0);
           }
        $totalInd344 = $totalInd344R3441 + $totalInd344R3442 + $totalInd344R3443 + $totalInd344R3444;

        //ind345
        $totalInd345R3451 = $bilanSocialConsolide->getR3451();
        $totalInd345R3452 = $bilanSocialConsolide->getR3452();
        $totalInd345 = $totalInd345R3451 + $totalInd345R3452;

        return $this->render('@Conso/BilanSocialConsolide/editRemuneration.html.twig', array(
                    'questionCollectiviteConsolide' => $questionnaire,
                    'consolide' => $bilanSocialConsolide,
                    'incoherenceList' => ($bilanSocialConsolide == null ? null : $bilanSocialConsolide->getIncoherenceLogs()),
                    'nombreQuestion' => $nombreQuestion,
                    'canwrite' => $this->isUserCanWrite(),
                    'collectivite' => $this->getMaCollectivite(),
                    'totalInd311' => $totalInd311,
                    'totalInd321' => $totalInd321,
                    'totalInd331' => $totalInd331,
                    'totalInd341' => $totalInd341,
                    'totalInd342' => $totalInd342,
                    'totalInd344' => $totalInd344,
                    'totalInd345' => $totalInd345
        ));
    }

    public function EditBilanSocialConsolideRemunerationInd311Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ1() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind311");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind311");

            $bsConsoIndPreparator->initIndicateurByName("Ind311AOTM");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind311AOTM");
        }

        //$bilanSocialConsolideClone = clone $bilanSocialConsolide;
        //$bsConsoIndPreparator->setBs($bilanSocialConsolideClone);
        //$bsConsoIndPreparator->initIndicateurByName("Ind311");
        //$bsConsoIndPreparator->moveIndTempToRealByName("Ind311",null,array('force'=>true));
        
        //$nmSire = $this->getMaCollectivite()->getNmSire();
        //$ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind311", $bilanSocialConsolideClone);
        $ancien_ind = null;


        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formRemuneration311 = $this->createForm(BilanSocialConsolideRemunerationInd311Type::class, $bilanSocialConsolide);
        $formRemuneration311->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRemuneration311->isSubmitted()) {
            // Traitement submit du form en AJAX
            /*if (!$formRemuneration311->isValid()) {
                echo "Form invalide";
                exit;
            }*/

            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                foreach ($bilanSocialConsolide->getInd311sTemp() as $ind311) {
                    if ($ind311->getId311() == null || $ind311->getId311() == 0) {
                        $ind311->setDtCrea($now);
                        $ind311->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind311);
                        $bilanSocialConsolide->getInd311s()->add($ind311);
                    }
                }

                foreach ($bilanSocialConsolide->getInd311AotmsTemp() as $ind311) {
                    if ($ind311->getId311() == null || $ind311->getId311() == 0) {
                        $ind311->setDtCrea($now);
                        $ind311->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind311);
                        $bilanSocialConsolide->getInd311s()->add($ind311);
                    }
                }

                $bilanSocialConsolide->setRemunerationDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd311NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }
                $this->getEntityManager()->flush();
                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRemuneration("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRemunerationInd311.html.twig', array(
                    'formRemuneration311' => $formRemuneration311->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent'          => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideRemunerationInd321Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ3() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind321");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind321");

            $bsConsoIndPreparator->initIndicateurByName("Ind321AOTM");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind321AOTM");


        }

//        $bilanSocialConsolideClone = clone $bilanSocialConsolide;
//        $bsConsoIndPreparator->setBs($bilanSocialConsolideClone);
//        $bsConsoIndPreparator->initIndicateurByName("Ind321");
//        $bsConsoIndPreparator->moveIndTempToRealByName("Ind321",null,array('force'=>true));
        
        $nmSire = $this->getMaCollectivite()->getNmSire();
        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind321", $bilanSocialConsolide);

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formRemuneration321 = $this->createForm(BilanSocialConsolideRemunerationInd321Type::class, $bilanSocialConsolide);
        $formRemuneration321->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRemuneration321->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formRemuneration321->isValid()) {
		echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                foreach ($bilanSocialConsolide->getInd321sTemp() as $ind321) {
                    if ($ind321->getId321() == null || $ind321->getId321() == 0) {
                        $ind321->setDtCrea($now);
                        $ind321->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind321);
                        $bilanSocialConsolide->getInd321s()->add($ind321);
                    }
                }

                foreach ($bilanSocialConsolide->getInd321AotmsTemp() as $ind321) {
                    if ($ind321->getId321() == null || $ind321->getId321() == 0) {
                        $ind321->setDtCrea($now);
                        $ind321->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind321);
                        $bilanSocialConsolide->getInd321s()->add($ind321);
                    }
                }

                $bilanSocialConsolide->setRemunerationDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd321NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRemuneration("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRemunerationInd321.html.twig', array(
                    'formRemuneration321' => $formRemuneration321->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent'          => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideRemunerationInd331Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ5() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind331");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind331");
        }

        $bilanSocialConsolideClone = clone $bilanSocialConsolide;
        $bsConsoIndPreparator->setBs($bilanSocialConsolideClone);
        $bsConsoIndPreparator->initIndicateurByName("Ind331");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind331",null,array('force'=>true));
        
        $nmSire = $this->getMaCollectivite()->getNmSire();
        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind331", $bilanSocialConsolideClone);

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formRemuneration331 = $this->createForm(BilanSocialConsolideRemunerationInd331Type::class, $bilanSocialConsolide);
        $formRemuneration331->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRemuneration331->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formRemuneration331->isValid()) {
		echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setRemunerationDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setMoyenneInd331(100);
                $bilanSocialConsolide->setBlIncoInd331(4);
                $bilanSocialConsolide->setInd331NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRemuneration("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRemunerationInd331.html.twig', array(
                    'formRemuneration331' => $formRemuneration331->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent'          => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideRemunerationInd341Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formRemuneration341 = $this->createForm(BilanSocialConsolideRemunerationInd341Type::class, $bilanSocialConsolide);
        $formRemuneration341->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRemuneration341->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formRemuneration341->isValid()) {
		echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setRemunerationDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

               
                $bilanSocialConsolide->setInd341NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRemuneration("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRemunerationInd341.html.twig', array(
                    'formRemuneration341' => $formRemuneration341->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRemunerationInd342Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formRemuneration342 = $this->createForm(BilanSocialConsolideRemunerationInd342Type::class, $bilanSocialConsolide);
        $formRemuneration342->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRemuneration342->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formRemuneration342->isValid()) {
		echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setRemunerationDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setInd342NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRemuneration("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRemunerationInd342.html.twig', array(
                    'formRemuneration342' => $formRemuneration342->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRemunerationInd343Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formRemuneration343 = $this->createForm(BilanSocialConsolideRemunerationInd343Type::class, $bilanSocialConsolide);
        $formRemuneration343->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRemuneration343->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formRemuneration343->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setRemunerationDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setBlUpdated(true);


                $bilanSocialConsolide->setMoyenneInd343(100);
                $bilanSocialConsolide->setBlIncoInd343(4);

                $this->getEntityManager()->flush();


                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRemuneration("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRemunerationInd343.html.twig', array(
            'formRemuneration343' => $formRemuneration343->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRemunerationInd344Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $idFili = $request->query->get("idFili");
        $q344Temp = "1";
        if($idFili=="0") {
            $q344Temp = "0";
        }

        $bsConsoIndPreparator->initIndicateurByName("Ind344");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind344",$idFili);
        $bsConsoIndPreparator->initIndicateurByName("Ind344AOTM");
        $bsConsoIndPreparator->moveIndToTemplateByName("Ind344AOTM");
        //error_log('------------------------------------------------------------------', 0);
        //error_log('idfili ' . $idFili , 0);
        $filieres = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findByAllExceptAotmHorsFiliWithOrder();

        // Calcul Totaux hors filieres selectionné
        $totalInd344 = new Ind344(true);
        foreach ($bilanSocialConsolide->getInd344s() as $ind344) {
            if($ind344->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliAotm && $ind344->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliHH) {
                if ($idFili == null || $idFili != $ind344->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                    $totalInd344->cumulR344x($ind344);
                }
            }
        }

        $arrayTotalFiliere = array();
        foreach ($filieres as $filiere) {
            $arrayTotalFiliere[$filiere->getIdFili()] = null;
            foreach ($bilanSocialConsolide->getInd344s() as $key => $ind344) {
                if ($ind344->getRefCadreEmploi()->getRefFiliere()->getIdFili() == $filiere->getIdFili()) {
                    $totParFiliere = $ind344->getTotalParFiliere();
                    $arrayTotalFiliere[$filiere->getIdFili()] += $totParFiliere;
                }
            }
        }

        $formRemuneration344 = $this->createForm(BilanSocialConsolideRemunerationInd344Type::class, $bilanSocialConsolide);
        $formRemuneration344->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRemuneration344->isSubmitted()) {
            $fgstat = $formRemuneration344['valide']->getData();
            // Traitement Submit du
            // form en AJAX
            //error_log('submit', 0);
            if (!$formRemuneration344->isValid()) {
                echo "Form invalide";
                error_log($formRemuneration344->getErrors(), 0);
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

                foreach ($bilanSocialConsolide->getInd344sTemp() as $ind344) {
                    //error_log('id344 From temp ' . $ind344->getId344());
                    //error_log('R3441 From temp ' . $ind344->getR3441());
                    if ($ind344->getId344() == null || $ind344->getId344() == 0) {
                        $ind344->setDtCrea($now);
                        $ind344->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind344);
                        $bilanSocialConsolide->getInd344s()->add($ind344);
                    }
                }
                foreach ($bilanSocialConsolide->getInd344AotmsTemp() as $ind344) {
                    //error_log('id344 From temp ' . $ind344->getId344());
                    //error_log('R3441 From temp ' . $ind344->getR3441());
                    if ($ind344->getId344() == null || $ind344->getId344() == 0) {
                        $ind344->setDtCrea($now);
                        $ind344->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind344);
                        $bilanSocialConsolide->getInd344s()->add($ind344);
                    }
                }

                // Gestion du Ind344 remise à null si non à la question
                if ($bilanSocialConsolide->getQ344() == null || $bilanSocialConsolide->getQ344() != 1) {
                    foreach ($bilanSocialConsolide->getInd344s() as $ind344) {
                        $ind344->initR344xToNull();
                    }
                }


                $bilanSocialConsolide->setInd344NullToZero();
                $bilanSocialConsolide->setRemunerationDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setMoyenneInd344(100);
                $bilanSocialConsolide->setBlIncoInd344(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();
                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRemuneration("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editRemunerationInd344.html.twig', array(
                    'formRemuneration344' => $formRemuneration344->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'filieres' => $filieres,
                    'idFili' => $idFili,
                    'q344Temp' => $q344Temp,
                    'totalInd344'                   => $totalInd344,
                    'arrayTotalFiliere'             => $arrayTotalFiliere
        ));
    }

    public function EditBilanSocialConsolideRemunerationInd345Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $nmSire = $this->getMaCollectivite()->getNmSire();

        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind345", $bilanSocialConsolide);
        //$ancien_ind = null;

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formRemuneration345 = $this->createForm(BilanSocialConsolideRemunerationInd345Type::class, $bilanSocialConsolide);
        $formRemuneration345->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRemuneration345->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formRemuneration345->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }
                $bilanSocialConsolide->setRemunerationDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setInd345NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRemuneration("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRemuneration("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRemunerationInd345.html.twig', array(
                    'formRemuneration345' => $formRemuneration345->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent' => $ancien_ind
        ));
    }

}
