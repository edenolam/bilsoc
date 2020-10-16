<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use DateTime;
use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Doctrine\Common\Collections\ArrayCollection;
use Bilan_Social\Bundle\ConsoBundle\Controller\BilanSocialConsolideController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctAccidentTravailType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctRealisationFormationSanteTravailType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctPrevisionFormationSanteTravailType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctAutresMesuresType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctPredictionsAutresMesuresType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctNbMaladieProType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctNbAccidentTravailType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctNatureLesionType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctSiegeLesionType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctElementMaterielType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctMaladieProCaracProType;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideRassctBscRassctInformationCollectiviteType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class BilanSocialConsolideRassctController extends BilanSocialConsolideController {

    public function EditBilanSocialConsolideRassctAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();

        $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);
        $enqueteCollActive = $this->getMonEnqueteCollectiviteActive();

        $em = $this->getDoctrine()->getManager();
        $indBscRassctAccidentTravails = $em->getRepository('ConsoBundle:BscRassctAccidentTravail')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscRassctMaladieProCaracPros = $em->getRepository('ConsoBundle:BscRassctMaladieProCaracPro')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscRassctNbMaladiePros = $em->getRepository('ConsoBundle:BscRassctNbMaladiePro')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscRassctNbAccidentTravails = $em->getRepository('ConsoBundle:BscRassctNbAccidentTravail')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscRassctNatureLesions = $em->getRepository('ConsoBundle:BscRassctNatureLesion')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscRassctSiegeLesions = $em->getRepository('ConsoBundle:BscRassctSiegeLesion')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $indBscRassctElementMateriels = $em->getRepository('ConsoBundle:BscRassctElementMateriel')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());

        //indBscRassctAccidentTravails
        $totalRAccident1 = 0;
        $totalRAccident2 = 0;
        foreach ($indBscRassctAccidentTravails as $indBscRassctAccidentTravail) {
               $totalRAccident1 += $indBscRassctAccidentTravail->getRAccident1(0);
               $totalRAccident2 += $indBscRassctAccidentTravail->getRAccident2(0);
        }
        $totalBscRassctAccidentTravail = $totalRAccident1 + $totalRAccident2;

        //$indBscRassctMaladieProCaracPro
        $totalRMp1 = 0;
        $totalRMp2 = 0;
        foreach ($indBscRassctMaladieProCaracPros as $indBscRassctMaladieProCaracPro) {
               $totalRMp1 += $indBscRassctMaladieProCaracPro->getRMp1(0);
               $totalRMp2 += $indBscRassctMaladieProCaracPro->getRMp1(0);
        }
        $totalBscRassctMaladieProCaracPro = $totalRMp1 + $totalRMp2;

        //$indBscRassctNbMaladiePros
        $totalRNbMpReconnues = 0;
        $totalRNbJourArret = 0;
        foreach ($indBscRassctNbMaladiePros as $indBscRassctNbMaladiePro) {
               $totalRNbMpReconnues += $indBscRassctNbMaladiePro->getRNbMpReconnues(0);
               $totalRNbJourArret += $indBscRassctNbMaladiePro->getRNbJourArret(0);
        }
        $totalBscRassctNbMaladiePro = $totalRNbMpReconnues + $totalRNbJourArret;

        //$indBscRassctNbAccidentTravail
        $totalRNbAccidentsSurvenus = 0;
        $totalRNbJourArretAccidents = 0;
        foreach ($indBscRassctNbAccidentTravails as $indBscRassctNbAccidentTravail) {
               $totalRNbAccidentsSurvenus += $indBscRassctNbAccidentTravail->getRNbAccidentsSurvenus(0);
               $totalRNbJourArretAccidents += $indBscRassctNbAccidentTravail->getRNbJourArretAccidents(0);
        }
        $totalBscRassctNbAccidentTravail = $totalRNbAccidentsSurvenus + $totalRNbJourArretAccidents;

        //$indBscRassctNatureLesion
        $totalRNbAccidentAvecArret = 0;
        $totalRNbAccidentSansArret = 0;
        $totalRNbJourArret = 0;
        foreach ($indBscRassctNatureLesions as $indBscRassctNatureLesion) {
               $totalRNbAccidentAvecArret += $indBscRassctNatureLesion->getRNbAccidentAvecArret(0);
               $totalRNbAccidentSansArret += $indBscRassctNatureLesion->getRNbAccidentSansArret(0);
               $totalRNbJourArret += $indBscRassctNatureLesion->getRNbJourArret(0);
        }
        $totalBscRassctNatureLesion = $totalRNbAccidentAvecArret + $totalRNbAccidentSansArret + $totalRNbJourArret;

        //$indBscRassctSiegeLesion
        $totalindBscRassctSiegeLesionRNbAccident = 0;
        $totalindBscRassctSiegeLesionRNbJourArret = 0;
        foreach ($indBscRassctSiegeLesions as $indBscRassctSiegeLesion) {
               $totalindBscRassctSiegeLesionRNbAccident += $indBscRassctSiegeLesion->getRNbAccident(0);
               $totalindBscRassctSiegeLesionRNbJourArret += $indBscRassctSiegeLesion->getRNbJourArret(0);
        }
        $totalBscRassctSiegeLesion = $totalindBscRassctSiegeLesionRNbAccident + $totalindBscRassctSiegeLesionRNbJourArret;

        //$indBscRassctElementMateriel
        $totalindBscRassctElementMaterielRNbAccident = 0;
        $totalindBscRassctElementMaterielRNbJourArret = 0;
        foreach ($indBscRassctElementMateriels as $indBscRassctElementMateriel) {
               $totalindBscRassctElementMaterielRNbAccident += $indBscRassctElementMateriel->getRNbAccident(0);
               $totalindBscRassctElementMaterielRNbJourArret += $indBscRassctElementMateriel->getRNbJourArret(0);
        }
        $totalBscRassctElementMateriel = $totalindBscRassctElementMaterielRNbAccident + $totalindBscRassctElementMaterielRNbJourArret;

        return $this->render('@Conso/BilanSocialConsolide/editRassct.html.twig', array(
                    'questionCollectiviteConsolide' => $questionnaire,
                    'consolide'                     => $bilanSocialConsolide,
                    'incoherenceList'               => ($bilanSocialConsolide == null ? null : $bilanSocialConsolide->getIncoherenceLogs()),
                    'nombreQuestion'                => $nombreQuestion,
                    'enqueteCollActive'             => $enqueteCollActive,
                    'canwrite' => $this->isUserCanWrite(),
                    'collectivite' => $this->getMaCollectivite(),
                    'totalBscRassctAccidentTravail'      => $totalBscRassctAccidentTravail,
                    'totalBscRassctMaladieProCaracPro'   => $totalBscRassctMaladieProCaracPro,
                    'totalBscRassctNbMaladiePro'         => $totalBscRassctNbMaladiePro,
                    'totalBscRassctNbAccidentTravail'    => $totalBscRassctNbAccidentTravail,
                    'totalBscRassctNatureLesion'         => $totalBscRassctNatureLesion,
                    'totalBscRassctSiegeLesion'          => $totalBscRassctSiegeLesion,
                    'totalBscRassctElementMateriel'      => $totalBscRassctElementMateriel
        ));
    }

    public function GetResponseRassct($code, $bilanSocialConsolide) {

        $json = $this->getNumberQuestion($bilanSocialConsolide);
        // nbForm = 8
        $json['data'] = $code;

        return new JsonResponse($json);
    }

    public function EditBilanSocialConsolideRassctBscRassctAccidentTravailAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $ref = ["Nombre d'accidents sans arrêt",
            "Nombre d'accidents avec arrêt entre 1 et 3 jours",
            "Nombre d'accidents avec arrêt entre 4 et 21 jours",
            "Nombre d'accidents avec arrêt entre 22 et 89 jours",
            "Nombre d'accidents avec arrêt de 90 jours ou plus"];

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;


                $bilanSocialConsolide->initIndicateurX($cdUtil, "BscRassctAccidentTravail", $ref);

        }
        else {
            if ($bilanSocialConsolide->getBscRassctAccidentTravails() != null && $bilanSocialConsolide->getBscRassctAccidentTravails()->count() > 0) {
                //error_log('test', 0);
            }
            else {
                $bilanSocialConsolide->initIndicateurX($cdUtil, "BscRassctAccidentTravail", $ref);
            }
        }

        $formRassctBscRassctAccidentTravail = $this->createForm(BilanSocialConsolideRassctBscRassctAccidentTravailType::class, $bilanSocialConsolide);
        $formRassctBscRassctAccidentTravail->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRassctBscRassctAccidentTravail->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formRassctBscRassctAccidentTravail->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit

            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                /*$bscRassct = $bilanSocialConsolide->getBscRassctAccidentTravails();
                $bscRassct->setBilanSocialConsolide($bilanSocialConsolide);*/

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    /*$bscRassct->setBilanSocialConsolide($bilanSocialConsolide);*/
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    /*$this->getEntityManager()->persist($bscRassct);*/
                }

                $bilanSocialConsolide->setRassctAccidentTravailNullToZero();

                $bilanSocialConsolide->setMoyenneRassctAccidentTravail(100);
                $bilanSocialConsolide->setBlIncoRassctAccidentTravail(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            }  catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscRassctAccidentTravail.html.twig', array(
                    'formRassctBscRassctAccidentTravail' => $formRassctBscRassctAccidentTravail->createView(),
                    'incoherenceList'               => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }
    public function EditBilanSocialConsolideRassctBscRassctInformationCollectiviteAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formRassctQuestionsCollectivites = $this->createForm(BilanSocialConsolideRassctBscRassctInformationCollectiviteType::class, $bilanSocialConsolide);
        $formRassctQuestionsCollectivites->handleRequest($request);


        $now = new DateTime('NOW');
        if ($formRassctQuestionsCollectivites->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formRassctQuestionsCollectivites->isValid()) {
                echo "Form invalide";
                exit;
            }

            $bscRassct = $bilanSocialConsolide->getBscRassctInformationCollectivite();
            $bscRassct->setBilanSocialConsolide($bilanSocialConsolide);
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
                    $this->getEntityManager()->persist($bscRassct);
                }

                $bilanSocialConsolide->setMoyenneRassctInformationCollectivite(100);
                $bilanSocialConsolide->setBlIncoRassctInformationCollectivite(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscInformationCollectivite.html.twig', array(
            'formRassctQuestionsCollectivites' => $formRassctQuestionsCollectivites->createView(),
            'incoherenceList'               => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRassctBscRassctRealisationFormationSanteTravailAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $originalRassctRealisationFormationSanteTravails = new ArrayCollection();

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;

            foreach ($bilanSocialConsolide->getBscRassctRealisationFormationSanteTravails() as $tag) {
                $originalRassctRealisationFormationSanteTravails->add($tag);
            }
        }
        else {
            if ($bilanSocialConsolide->getBscRassctRealisationFormationSanteTravails() != null && $bilanSocialConsolide->getBscRassctRealisationFormationSanteTravails()->count() > 0) {
                //error_log('test', 0);
                foreach ($bilanSocialConsolide->getBscRassctRealisationFormationSanteTravails() as $tag) {
                    $originalRassctRealisationFormationSanteTravails->add($tag);
                }
            }
            else {
                foreach ($bilanSocialConsolide->getBscRassctRealisationFormationSanteTravails() as $tag) {
                    $originalRassctRealisationFormationSanteTravails->add($tag);
                }
            }
        }

        $formRassctBscRassctRealisationFormationSanteTravails = $this->createForm(BilanSocialConsolideRassctBscRassctRealisationFormationSanteTravailType::class, $bilanSocialConsolide);
        $formRassctBscRassctRealisationFormationSanteTravails->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRassctBscRassctRealisationFormationSanteTravails->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formRassctBscRassctRealisationFormationSanteTravails->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit

            foreach ($originalRassctRealisationFormationSanteTravails as $Real) {

                if (false === $bilanSocialConsolide->getBscRassctRealisationFormationSanteTravails()->contains($Real)) {
                    $em->remove($Real);
                }
            }



            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                foreach ($bilanSocialConsolide->getBscRassctRealisationFormationSanteTravails() as $key => $Real) {
                    $Real->setBilanSocialConsolide($bilanSocialConsolide);
                    $Real->setDtCrea(new DateTime('NOW'));
                    $Real->setCdUtilcrea($cdUtil);
                }

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    $formRassctBscRassctRealisationFormationSanteTravails->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($formRassctBscRassctRealisationFormationSanteTravails);
                }

                $bilanSocialConsolide->setRassctDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setMoyenneRassctRealisationFormationSanteTravail(100);
                $bilanSocialConsolide->setBlIncoRassctRealisationFormationSanteTravail(4);

                $bilanSocialConsolide->setRassctRealisationFormationSanteTravailNullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            }  catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscRassctRealisationFormationSanteTravail.html.twig', array(
                    'formRassctBscRassctRealisationFormationSanteTravail' => $formRassctBscRassctRealisationFormationSanteTravails->createView(),
                    'incoherenceList'                                      => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'                        => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRassctBscRassctPrevisionFormationSanteTravailAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $originalRassctPrevisionFormationSanteTravails = new ArrayCollection();

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;

            foreach ($bilanSocialConsolide->getBscRassctPrevisionFormationSanteTravails() as $tag) {
                $originalRassctPrevisionFormationSanteTravails->add($tag);
            }
        }
        else {
            if ($bilanSocialConsolide->getBscRassctPrevisionFormationSanteTravails() != null && $bilanSocialConsolide->getBscRassctPrevisionFormationSanteTravails()->count() > 0) {
                //error_log('test', 0);
                foreach ($bilanSocialConsolide->getBscRassctPrevisionFormationSanteTravails() as $tag) {
                    $originalRassctPrevisionFormationSanteTravails->add($tag);
                }
            }
            else {
                foreach ($bilanSocialConsolide->getBscRassctPrevisionFormationSanteTravails() as $tag) {
                    $originalRassctPrevisionFormationSanteTravails->add($tag);
                }
            }
        }

        $formRassctBscRassctPrevisionFormationSanteTravails = $this->createForm(BilanSocialConsolideRassctBscRassctPrevisionFormationSanteTravailType::class, $bilanSocialConsolide);
        $formRassctBscRassctPrevisionFormationSanteTravails->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRassctBscRassctPrevisionFormationSanteTravails->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formRassctBscRassctPrevisionFormationSanteTravails->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit

            foreach ($originalRassctPrevisionFormationSanteTravails as $Prev) {

                if (false === $bilanSocialConsolide->getBscRassctPrevisionFormationSanteTravails()->contains($Prev)) {
                    $em->remove($Prev);
                }
            }



            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                foreach ($bilanSocialConsolide->getBscRassctPrevisionFormationSanteTravails() as $key => $Prev) {
                    $Prev->setBilanSocialConsolide($bilanSocialConsolide);
                    $Prev->setDtCrea(new DateTime('NOW'));
                    $Prev->setCdUtilcrea($cdUtil);
                }

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    $formRassctBscRassctPrevisionFormationSanteTravails->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($formRassctBscRassctPrevisionFormationSanteTravails);
                }

                $bilanSocialConsolide->setRassctDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setMoyenneRassctPrevisionFormationSanteTravail(100);
                $bilanSocialConsolide->setBlIncoRassctPrevisionFormationSanteTravail(4);
                $bilanSocialConsolide->setBlUpdated(true);

                $bilanSocialConsolide->setRassctPrevisionFormationSanteTravailNullToZero();
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscRassctPrevisionFormationSanteTravail.html.twig', array(
                    'formRassctBscRassctPrevisionFormationSanteTravail' => $formRassctBscRassctPrevisionFormationSanteTravails->createView(),
                    'incoherenceList'                                    => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'                      => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRassctBscRassctAutresMesuresAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $originalRassctAutresMesures = new ArrayCollection();

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;

            foreach ($bilanSocialConsolide->getBscRassctAutresMesures() as $tag) {
                $originalRassctAutresMesures->add($tag);
            }

        }
        else {
            if ($bilanSocialConsolide->getBscRassctAutresMesures() != null && $bilanSocialConsolide->getBscRassctAutresMesures()->count() > 0) {
                //error_log('test', 0);
                foreach ($bilanSocialConsolide->getBscRassctAutresMesures() as $tag) {
                    $originalRassctAutresMesures->add($tag);
                }
            }
            else {
                foreach ($bilanSocialConsolide->getBscRassctAutresMesures() as $tag) {
                    $originalRassctAutresMesures->add($tag);
                }
            }
        }

        $formRassctBscRassctAutresMesures = $this->createForm(BilanSocialConsolideRassctBscRassctAutresMesuresType::class, $bilanSocialConsolide);
        $formRassctBscRassctAutresMesures->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRassctBscRassctAutresMesures->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formRassctBscRassctAutresMesures->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit

            foreach ($originalRassctAutresMesures as $originalRassctAutreMesure) {

                if (false === $bilanSocialConsolide->getBscRassctAutresMesures()->contains($originalRassctAutreMesure)) {
                    $em->remove($originalRassctAutreMesure);
                }
            }



            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                foreach ($bilanSocialConsolide->getBscRassctAutresMesures() as $key => $AutreMesure) {
                    $AutreMesure->setBilanSocialConsolide($bilanSocialConsolide);
                    $AutreMesure->setDtCrea(new DateTime('NOW'));
                    $AutreMesure->setCdUtilcrea($cdUtil);
                }

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    $formRassctBscRassctAutresMesures->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($formRassctBscRassctAutresMesures);
                }

                $bilanSocialConsolide->setRassctDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setMoyenneRassctAutresMesures(100);
                $bilanSocialConsolide->setBlIncoRassctAutresMesures(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscRassctAutresMesures.html.twig', array(
                    'formRassctBscRassctAutresMesures' => $formRassctBscRassctAutresMesures->createView(),
                    'incoherenceList'                  => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'    => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRassctBscRassctMaladieProCaracProsAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $maladiePro = $this->getEntityManager()->getRepository('ReferencielBundle:RefMaladieProfessionnelle')->findBy(array('blVali' => false));

        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $bsConsoIndPreparator->initIndicateurByName("BscRassctMaladieProCaracPro");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscRassctMaladieProCaracPro");

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;//true;

        $formRassctBscRassctMaladieProCaracPro = $this->createForm(BilanSocialConsolideRassctBscRassctMaladieProCaracProType::class, $bilanSocialConsolide);
        $formRassctBscRassctMaladieProCaracPro->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRassctBscRassctMaladieProCaracPro->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formRassctBscRassctMaladieProCaracPro->isValid()) {
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
                    $bscRassctMaladieProCaracPro->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($bscRassctMaladieProCaracPro);
                }

                $bilanSocialConsolide->setMoyenneRassctMaladieProCaracPro(100);
                $bilanSocialConsolide->setBlIncoRassctMaladieProCaracPro(4);
                $bilanSocialConsolide->setRassctNbMaladieProsNullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscRassctMaladieProCaracPro.html.twig', array(
                    'formRassctBscRassctMaladieProCaracPro' => $formRassctBscRassctMaladieProCaracPro->createView(),
                    'incoherenceList'                       => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'         => $questionnaire
        ));
    }
    public function EditBilanSocialConsolideRassctBscRassctPredictionsAutresMesuresAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $originalRassctPredictionsAutresMesures = new ArrayCollection();

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;

            foreach ($bilanSocialConsolide->getBscRassctPredictionsAutresMesures() as $tag) {
                $originalRassctPredictionsAutresMesures->add($tag);
            }
        }
        else {
            if ($bilanSocialConsolide->getBscRassctPredictionsAutresMesures() != null && $bilanSocialConsolide->getBscRassctPredictionsAutresMesures()->count() > 0) {
                //error_log('test', 0);
                foreach ($bilanSocialConsolide->getBscRassctPredictionsAutresMesures() as $tag) {
                    $originalRassctPredictionsAutresMesures->add($tag);
                }
            }
            else {
                foreach ($bilanSocialConsolide->getBscRassctPredictionsAutresMesures() as $tag) {
                    $originalRassctPredictionsAutresMesures->add($tag);
                }
            }
        }

        $formRassctBscRassctPredictionsAutresMesures = $this->createForm(BilanSocialConsolideRassctBscRassctPredictionsAutresMesuresType::class, $bilanSocialConsolide);
        $formRassctBscRassctPredictionsAutresMesures->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRassctBscRassctPredictionsAutresMesures->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formRassctBscRassctPredictionsAutresMesures->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit

            foreach ($originalRassctPredictionsAutresMesures as $originalRassctAutreMesure) {

                if (false === $bilanSocialConsolide->getBscRassctPredictionsAutresMesures()->contains($originalRassctAutreMesure)) {
                    $em->remove($originalRassctAutreMesure);
                }
            }



            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                foreach ($bilanSocialConsolide->getBscRassctPredictionsAutresMesures() as $key => $AutreMesure) {
                    $AutreMesure->setBilanSocialConsolide($bilanSocialConsolide);
                    $AutreMesure->setDtCrea(new DateTime('NOW'));
                    $AutreMesure->setCdUtilcrea($cdUtil);
                }

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    $formRassctBscRassctPredictionsAutresMesures->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($formRassctBscRassctPredictionsAutresMesures);
                }

                $bilanSocialConsolide->setRassctDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setMoyenneRassctPredictionsAutresMesures(100);
                $bilanSocialConsolide->setBlIncoRassctPredictionsAutresMesures(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscRassctPredictionsAutresMesures.html.twig', array(
                    'formRassctBscRassctPredictionsAutresMesures' => $formRassctBscRassctPredictionsAutresMesures->createView(),
                    'incoherenceList'                             => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'               => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRassctBscRassctNbMaladieProsAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $typeActi = $this->getEntityManager()->getRepository('ReferencielBundle:RefTypeActivite')->findBy(array('blVali' => false));

        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $bsConsoIndPreparator->initIndicateurByName("BscRassctNbMaladiePro");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscRassctNbMaladiePro");

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;//true;

        $formRassctBscRassctNbMaladiePro = $this->createForm(BilanSocialConsolideRassctBscRassctNbMaladieProType::class, $bilanSocialConsolide);
        $formRassctBscRassctNbMaladiePro->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRassctBscRassctNbMaladiePro->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formRassctBscRassctNbMaladiePro->isValid()) {
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
                    $bscRassctNbMaladiePro->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($bscRassctNbMaladiePro);
                }

                $bilanSocialConsolide->setMoyenneRassctNbMaladiePro(100);
                $bilanSocialConsolide->setBlIncoRassctNbMaladiePro(4);
                $bilanSocialConsolide->setRassctNbMaladiePros2NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);


                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscRassctNbMaladiePro.html.twig', array(
                    'formRassctBscRassctNbMaladiePro' => $formRassctBscRassctNbMaladiePro->createView(),
                    'incoherenceList'                 => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'   => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRassctBscRassctNbAccidentTravailsAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $typeActi = $this->getEntityManager()->getRepository('ReferencielBundle:RefTypeActivite')->findBy(array('blVali' => false));

        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $bsConsoIndPreparator->initIndicateurByName("BscRassctNbAccidentTravail");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscRassctNbAccidentTravail");

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;//true;

        $formRassctBscRassctNbAccidentTravail = $this->createForm(BilanSocialConsolideRassctBscRassctNbAccidentTravailType::class, $bilanSocialConsolide);
        $formRassctBscRassctNbAccidentTravail->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRassctBscRassctNbAccidentTravail->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formRassctBscRassctNbAccidentTravail->isValid()) {
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
                    $bscRassctNbAccidentTravail->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($bscRassctNbAccidentTravail);
                }

                $bilanSocialConsolide->setMoyenneRassctNbAccidentTravail(100);
                $bilanSocialConsolide->setBlIncoRassctNbAccidentTravail(4);
                $bilanSocialConsolide->setRassctNbAccidentTravail();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscRassctNbAccidentTravail.html.twig', array(
                    'formRassctBscRassctNbAccidentTravail' => $formRassctBscRassctNbAccidentTravail->createView(),
                    'incoherenceList'                      => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'        => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRassctBscRassctNatureLesionsAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $natureLieson = $this->getEntityManager()->getRepository('ReferencielBundle:RefNatureLesion')->findBy(array('blVali' => false));

        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $bsConsoIndPreparator->initIndicateurByName("BscRassctNatureLesion");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscRassctNatureLesion");

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;//true;

        $formRassctBscRassctNatureLesion = $this->createForm(BilanSocialConsolideRassctBscRassctNatureLesionType::class, $bilanSocialConsolide);
        $formRassctBscRassctNatureLesion->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRassctBscRassctNatureLesion->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formRassctBscRassctNatureLesion->isValid()) {
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
                    $bscRassctNatureLesion->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($bscRassctNatureLesion);
                }

                $bilanSocialConsolide->setMoyenneRassctNatureLesion(100);
                $bilanSocialConsolide->setBlIncoRassctNatureLesion(4);
                $bilanSocialConsolide->setRassctNatureLesion();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscRassctNatureLesion.html.twig', array(
                    'formRassctBscRassctNatureLesion' => $formRassctBscRassctNatureLesion->createView(),
                    'incoherenceList'                 => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'   => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRassctBscRassctSiegeLesionsAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $natureLieson = $this->getEntityManager()->getRepository('ReferencielBundle:RefSiegeLesion')->findBy(array('blVali' => false));

        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $bsConsoIndPreparator->initIndicateurByName("BscRassctSiegeLesion");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscRassctSiegeLesion");

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;// true;

        $formRassctBscRassctSiegeLesion = $this->createForm(BilanSocialConsolideRassctBscRassctSiegeLesionType::class, $bilanSocialConsolide);
        $formRassctBscRassctSiegeLesion->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRassctBscRassctSiegeLesion->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formRassctBscRassctSiegeLesion->isValid()) {
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
                    $bscRassctSiegeLesion->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($bscRassctSiegeLesion);
                }

                $bilanSocialConsolide->setMoyenneRassctSiegeLesion(100);
                $bilanSocialConsolide->setBlIncoRassctSiegeLesion(4);
                $bilanSocialConsolide->setRassctSiegeLesions();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscRassctSiegeLesion.html.twig', array(
                    'formRassctBscRassctSiegeLesion' => $formRassctBscRassctSiegeLesion->createView(),
                    'incoherenceList'                => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'  => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideRassctBscRassctElementMaterielsAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();
        $natureLieson = $this->getEntityManager()->getRepository('ReferencielBundle:RefElementMateriel')->findBy(array('blVali' => false));

        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $bsConsoIndPreparator->initIndicateurByName("BscRassctElementMateriel");
        $bsConsoIndPreparator->moveIndTempToRealByName("BscRassctElementMateriel");

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;//true;

        $formRassctBscRassctElementMateriel = $this->createForm(BilanSocialConsolideRassctBscRassctElementMaterielType::class, $bilanSocialConsolide);
        $formRassctBscRassctElementMateriel->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formRassctBscRassctElementMateriel->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formRassctBscRassctElementMateriel->isValid()) {
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
                    $bscRassctElementMateriel->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($bscRassctElementMateriel);
                }

                $bilanSocialConsolide->setMoyenneRassctElementMateriel(100);
                $bilanSocialConsolide->setBlIncoRassctElementMateriel(4);
                $bilanSocialConsolide->setRassctElementMateriels();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseRassct("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseRassct("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseRassct("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editRassctBscRassctElementMateriel.html.twig', array(
                    'formRassctBscRassctElementMateriel' => $formRassctBscRassctElementMateriel->createView(),
                    'incoherenceList'                    => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide'      => $questionnaire
        ));
    }



}
