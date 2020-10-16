<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;


use DateTime;
use Bilan_Social\Bundle\ConsoBundle\Controller\BilanSocialConsolideController;
use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideDroitInd611Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideDroitInd612Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideDroitInd613Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideDroitInd614Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideDroitInd711Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideDroitInd712Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideDroitInd713Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideDroitInd714Type;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class BilanSocialConsolideDroitController extends BilanSocialConsolideController {


    public function GetResponseDroit($code, $bilanSocialConsolide) {
        $json = $this->getNumberQuestion($bilanSocialConsolide);
        $json['data'] = $code;
        // nmForm = 7
        return new JsonResponse($json);

    }


    public function EditBilanSocialConsolideDroitAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();

        $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);
        $enqueteCollActive = $this->getMonEnqueteCollectiviteActive();

        $em = $this->getDoctrine()->getManager();
        $ind613s = $em->getRepository('ConsoBundle:Ind613')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind6141s = $em->getRepository('ConsoBundle:Ind6141')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind6143s = $em->getRepository('ConsoBundle:Ind6143')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind6144s = $em->getRepository('ConsoBundle:Ind6144')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind6142s = $em->getRepository('ConsoBundle:Ind6142')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind7141s = $em->getRepository('ConsoBundle:Ind7141')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind7142s = $em->getRepository('ConsoBundle:Ind7142')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());

        //ind613
        $totalInd613R6132 = 0;
        foreach ($ind613s as $ind613) {
               $totalInd613R6132 += $ind613->getR6132(0);
        }
        $totalInd613 = $totalInd613R6132;

        //ind614
        $totalInd6141R61411 = 0;
        foreach ($ind6141s as $ind6141) {
               $totalInd6141R61411 += $ind6141->getR61411(0);
        }
        $totalInd6141R61412 = 0;
        foreach ($ind6141s as $ind6141) {
            $totalInd6141R61412 += $ind6141->getR61412(0);
        }
        $totalInd6142R61421 = 0;
        foreach ($ind6142s as $ind6142) {
               $totalInd6142R61421 += $ind6142->getR61421(0);
        }
        $totalInd6142R61422 = 0;
        foreach ($ind6142s as $ind6142) {
            $totalInd6142R61422 += $ind6142->getR61422(0);
        }
        $totalInd614 = $totalInd6141R61411 + $totalInd6141R61412 + $totalInd6142R61421 + $totalInd6142R61422;

        //ind714
        $totalInd7141R71411 = 0;
        $totalInd7141R71412 = 0;
        foreach ($ind7141s as $ind7141) {
               $totalInd7141R71411 += $ind7141->getR71411(0);
               $totalInd7141R71412 += $ind7141->getR71412(0);
        }
        $totalInd7142R71421 = 0;
        $totalInd7142R71422 = 0;
        foreach ($ind7142s as $ind7142) {
               $totalInd7142R71421 += $ind7142->getR71421(0);
               $totalInd7142R71422 += $ind7142->getR71422(0);
        }
        $totalInd714 = $totalInd7141R71411 + $totalInd7141R71412 + $totalInd7142R71421 + $totalInd7142R71422;

        return $this->render('@Conso/BilanSocialConsolide/editDroit.html.twig', array(
                    'questionCollectiviteConsolide' => $questionnaire,
                    'collectivite' => $this->getMaCollectivite(),
                    'consolide' => $bilanSocialConsolide,
                    'incoherenceList' => ($bilanSocialConsolide == null ? null : $bilanSocialConsolide->getIncoherenceLogs()),
                    'nombreQuestion'                => $nombreQuestion,
                    'enqueteCollActive'             => $enqueteCollActive,
                    'canwrite' => $this->isUserCanWrite(),
                    'collectivite' => $this->getMaCollectivite(),
                    'totalInd613' => $totalInd613,
                    'totalInd614' => $totalInd614,
                    'totalInd714' => $totalInd714
        ));
    }

    public function EditBilanSocialConsolideDroitInd611Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = true;
        $nmSire = $this->getMaCollectivite()->getNmSire();

        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind611", $bilanSocialConsolide);

        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formDroit611 = $this->createForm(BilanSocialConsolideDroitInd611Type::class, $bilanSocialConsolide);
        $formDroit611->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formDroit611->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formDroit611->isValid()) {
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
                $bilanSocialConsolide->setDroitDateAndUserModif($now, $cdUtil);

                if($bilanSocialConsolide->getQ6113() == null || $bilanSocialConsolide->getQ6113() == false) {
                    $bilanSocialConsolide->setR6113(null);
                }
                if($bilanSocialConsolide->getQ6114() == null || $bilanSocialConsolide->getQ6114() == false) {
                    $bilanSocialConsolide->setR6114(null);
                    $bilanSocialConsolide->setR6115(null);
                    $bilanSocialConsolide->setR6116(null);
                }

                $bilanSocialConsolide->setMoyenneInd611(100);
                $bilanSocialConsolide->setBlIncoInd611(4);
                $bilanSocialConsolide->setInd611NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseDroit("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseDroit("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseDroit("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editDroitInd611.html.twig', array(
                    'formDroit611' => $formDroit611->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'collectivite' => $this->getMaCollectivite(),
                    'indicateur_precedent' => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideDroitInd612Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formDroit612 = $this->createForm(BilanSocialConsolideDroitInd612Type::class, $bilanSocialConsolide);
        $formDroit612->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formDroit612->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formDroit612->isValid()) {
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
                $bilanSocialConsolide->setDroitDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd612NullToZero();
                $bilanSocialConsolide->setMoyenneInd612(100);
                $bilanSocialConsolide->setBlIncoInd612(4);
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseDroit("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseDroit("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseDroit("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editDroitInd612.html.twig', array(
                    'formDroit612' => $formDroit612->createView(),
                    'collectivite' => $this->getMaCollectivite(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideDroitInd613Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);

        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $campagne = $this->getMaCampagne();

        if ($questionnaire->GetQ1() == true || $questionnaire->GetQ3() == true || $questionnaire->GetQ5() == true){
            $bsConsoIndPreparator->initIndicateurByName("Ind613");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind613");
        }
        $nmSire = $this->getMaCollectivite()->getNmSire();

        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind613", $bilanSocialConsolide);

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formDroit613 = $this->createForm(BilanSocialConsolideDroitInd613Type::class, $bilanSocialConsolide, array('anneeCamp' => $campagne->getNmAnne()));
        $formDroit613->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formDroit613->isSubmitted()) {
            $fgstat = $formDroit613['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formDroit613->isValid()) {
                echo "Form invalide";
                error_log($formDroit613->getErrors(), 0);
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

                // Gestion du Ind613 remise à null si non à la question
                if ($bilanSocialConsolide->getQ613() == null || $bilanSocialConsolide->getQ613() != 1) {
                    foreach ($bilanSocialConsolide->getInd613s() as $ind613) {
                        $ind613->setR6132(null);
                    }
                }

                $bilanSocialConsolide->setDroitDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd613NullToZero();

                $bilanSocialConsolide->setMoyenneInd613(100);
                $bilanSocialConsolide->setBlIncoInd613(4);
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();
                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseDroit("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseDroit("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseDroit("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editDroitInd613.html.twig', array(
                    'formDroit613' => $formDroit613->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'indicateur_precedent' => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideDroitInd614Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ1() == true || $questionnaire->GetQ3() == true || $questionnaire->GetQ5() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind6141");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind6141");
            $bsConsoIndPreparator->initIndicateurByName("Ind6143");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind6143");
            $bsConsoIndPreparator->initIndicateurByName("Ind6144");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind6144");
            $bsConsoIndPreparator->initIndicateurByName("Ind6142");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind6142");
        }

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formDroit614 = $this->createForm(BilanSocialConsolideDroitInd614Type::class, $bilanSocialConsolide);
        $formDroit614->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formDroit614->isSubmitted()) {
            $fgstat = $formDroit614['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formDroit614->isValid()) {
                echo "Form invalide";
                error_log($formDroit614->getErrors(), 0);
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

                $bilanSocialConsolide->setDroitDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd614NullToZero();

                $bilanSocialConsolide->setMoyenneInd614(100);
                $bilanSocialConsolide->setBlIncoInd614(4);
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();
                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseDroit("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseDroit("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseDroit("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editDroitInd614.html.twig', array(
                    'formDroit614' => $formDroit614->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs()
        ));
    }

    public function EditBilanSocialConsolideDroitInd711Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $nmSire = $this->getMaCollectivite()->getNmSire();

        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind711", $bilanSocialConsolide);


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formDroit711 = $this->createForm(BilanSocialConsolideDroitInd711Type::class, $bilanSocialConsolide);
        $formDroit711->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formDroit711->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formDroit711->isValid()) {
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
                $bilanSocialConsolide->setDroitDateAndUserModif($now, $cdUtil);

                $bilanSocialConsolide->setMoyenneInd711(100);
                $bilanSocialConsolide->setBlIncoInd711(4);
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseDroit("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseDroit("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseDroit("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editDroitInd711.html.twig', array(
                    'formDroit711' => $formDroit711->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent' => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideDroitInd712Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $nmSire = $this->getMaCollectivite()->getNmSire();

        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind712", $bilanSocialConsolide);


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formDroit712 = $this->createForm(BilanSocialConsolideDroitInd712Type::class, $bilanSocialConsolide);
        $formDroit712->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formDroit712->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formDroit712->isValid()) {
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
                $bilanSocialConsolide->setDroitDateAndUserModif($now, $cdUtil);

                $bilanSocialConsolide->setMoyenneInd712(100);
                $bilanSocialConsolide->setBlIncoInd712(4);
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseDroit("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseDroit("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseDroit("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editDroitInd712.html.twig', array(
                    'formDroit712' => $formDroit712->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent' => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideDroitInd713Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $nmSire = $this->getMaCollectivite()->getNmSire();

        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind713", $bilanSocialConsolide);


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formDroit713 = $this->createForm(BilanSocialConsolideDroitInd713Type::class, $bilanSocialConsolide);
        $formDroit713->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formDroit713->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formDroit713->isValid()) {
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
                $bilanSocialConsolide->setDroitDateAndUserModif($now, $cdUtil);

                $bilanSocialConsolide->setMoyenneInd713(100);
                $bilanSocialConsolide->setBlIncoInd713(4);
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseDroit("1", $bilanSocialConsolide);
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseDroit("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseDroit("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editDroitInd713.html.twig', array(
                    'formDroit713' => $formDroit713->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent' => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideDroitInd714Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ1() == true || $questionnaire->GetQ3() == true ){
            $bsConsoIndPreparator->initIndicateurByName("Ind7141");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind7141");
            $bsConsoIndPreparator->initIndicateurByName("Ind7142");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind7142");
        }

        $exist = $bilanSocialConsolide->getIdBilasocicons() == null;

        $formDroit714 = $this->createForm(BilanSocialConsolideDroitInd714Type::class, $bilanSocialConsolide);
        $formDroit714->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formDroit714->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formDroit714->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setDroitDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                if($bilanSocialConsolide->getQS7141() != true && $bilanSocialConsolide->getQS7142() != true) {
                    foreach ($bilanSocialConsolide->getInd7141s() as $ind7141) {
                        $ind7141->setR71411(null);
                    }
                    foreach ($bilanSocialConsolide->getInd7142s() as $ind7142) {
                        $ind7142->setR71421(null);
                    }
                    $bilanSocialConsolide->setR71411HC(null);
                    $bilanSocialConsolide->setR71421HC(null);

                }

                if($bilanSocialConsolide->getQP7143() != true && $bilanSocialConsolide->getQP7144() != true) {
                    foreach ($bilanSocialConsolide->getInd7141s() as $ind7141) {
                        $ind7141->setR71412(null);
                    }
                    foreach ($bilanSocialConsolide->getInd7142s() as $ind7142) {
                        $ind7142->setR71422(null);
                    }
                    $bilanSocialConsolide->setR71412HC(null);
                    $bilanSocialConsolide->setR71422HC(null);
                }

               $bilanSocialConsolide->setInd714NullToZero();
               $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseDroit("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseDroit("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseDroit("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editDroitInd714.html.twig', array(
                    'formDroit714' => $formDroit714->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }


}
