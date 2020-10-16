<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use DateTime;
use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Doctrine\Common\Collections\ArrayCollection;
use Bilan_Social\Bundle\ConsoBundle\Controller\BilanSocialConsolideController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideDgclType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Bilan_Social\Bundle\ConsoBundle\Form\BscDgclJoursCarenceType;


class BilanSocialConsolideDgclController extends BilanSocialConsolideController {

    public function EditBilanSocialConsolideDgclAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();

        $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);

        $em = $this->getDoctrine()->getManager();
        $indBscDgclJoursCarenceTitulaires  = $em->getRepository('ConsoBundle:BscDgclJoursCarenceTitulaire')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());

        //indBscDgclJoursCarenceTitulaire
        $totalindBscDgclJoursCarenceTitulaireNbJoursCarencePrelevesH = 0;
        $totalindBscDgclJoursCarenceTitulaireNbJoursCarencePrelevesF = 0;
        $totalindBscDgclJoursCarenceTitulaireNbSommeDelaiCarenceH = 0;
        $totalindBscDgclJoursCarenceTitulaireNbSommeDelaiCarenceF = 0;
        $totalindBscDgclJoursCarenceTitulaireNbTotalAgentRemuneresH = 0;
        $totalindBscDgclJoursCarenceTitulaireNbTotalAgentRemuneresF = 0;
        $totalindBscDgclJoursCarenceTitulaireNbTotalAgentJoursCarenceH = 0;
        $totalindBscDgclJoursCarenceTitulaireNbTotalAgentJoursCarenceF = 0;
        $totalindBscDgclJoursCarenceTitulaireNbArretMaladiesH = 0;
        $totalindBscDgclJoursCarenceTitulaireNbArretMaladiesF = 0;
        foreach ($indBscDgclJoursCarenceTitulaires as $indBscDgclJoursCarenceTitulaire) {
               $totalindBscDgclJoursCarenceTitulaireNbJoursCarencePrelevesH += $indBscDgclJoursCarenceTitulaire->getNbJoursCarencePrelevesH(0);
               $totalindBscDgclJoursCarenceTitulaireNbJoursCarencePrelevesF += $indBscDgclJoursCarenceTitulaire->getNbJoursCarencePrelevesF(0);
               $totalindBscDgclJoursCarenceTitulaireNbSommeDelaiCarenceH += $indBscDgclJoursCarenceTitulaire->getNbSommeDelaiCarenceH(0);
               $totalindBscDgclJoursCarenceTitulaireNbSommeDelaiCarenceF += $indBscDgclJoursCarenceTitulaire->getNbSommeDelaiCarenceF(0);
               $totalindBscDgclJoursCarenceTitulaireNbTotalAgentRemuneresH += $indBscDgclJoursCarenceTitulaire->getNbTotalAgentRemuneresH(0);
               $totalindBscDgclJoursCarenceTitulaireNbTotalAgentRemuneresF += $indBscDgclJoursCarenceTitulaire->getNbTotalAgentRemuneresF(0);
               $totalindBscDgclJoursCarenceTitulaireNbTotalAgentJoursCarenceH += $indBscDgclJoursCarenceTitulaire->getNbTotalAgentJoursCarenceH(0);
               $totalindBscDgclJoursCarenceTitulaireNbTotalAgentJoursCarenceF += $indBscDgclJoursCarenceTitulaire->getNbTotalAgentJoursCarenceF(0);      
               $totalindBscDgclJoursCarenceTitulaireNbArretMaladiesH += $indBscDgclJoursCarenceTitulaire->getNbArretMaladiesH(0);      
               $totalindBscDgclJoursCarenceTitulaireNbArretMaladiesF += $indBscDgclJoursCarenceTitulaire->getNbArretMaladiesF(0);      
        }
        $totalBscDgclJoursCarenceTitulaire = $totalindBscDgclJoursCarenceTitulaireNbJoursCarencePrelevesH + $totalindBscDgclJoursCarenceTitulaireNbJoursCarencePrelevesF + $totalindBscDgclJoursCarenceTitulaireNbSommeDelaiCarenceH + $totalindBscDgclJoursCarenceTitulaireNbSommeDelaiCarenceF + $totalindBscDgclJoursCarenceTitulaireNbTotalAgentRemuneresH + $totalindBscDgclJoursCarenceTitulaireNbTotalAgentRemuneresF + $totalindBscDgclJoursCarenceTitulaireNbTotalAgentJoursCarenceH + $totalindBscDgclJoursCarenceTitulaireNbTotalAgentJoursCarenceF + $totalindBscDgclJoursCarenceTitulaireNbArretMaladiesH + $totalindBscDgclJoursCarenceTitulaireNbArretMaladiesF;

        return $this->render('@Conso/BilanSocialConsolide/editDgcl.html.twig', array(
            'questionCollectiviteConsolide' => $questionnaire,
            'consolide'                     => $bilanSocialConsolide,
            'incoherenceList'               => ($bilanSocialConsolide == null ? null : $bilanSocialConsolide->getIncoherenceLogs()),
            'nombreQuestion' => $nombreQuestion,
            'canwrite' => $this->isUserCanWrite(),
            'collectivite' => $this->getMaCollectivite(),
            'totalBscDgclJoursCarenceTitulaire' => $totalBscDgclJoursCarenceTitulaire
        ));
    }

    public function EditBilanSocialConsolideDgclJoursCarenceAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }
        $bsConsoIndPreparator->initIndicateurByName("BscDgclJoursCarenceTitulaire");
        $bsConsoIndPreparator->moveIndToTemplateByName("BscDgclJoursCarenceTitulaire");
        $bsConsoIndPreparator->initIndicateurByName("BscDgclJoursCarenceContractuel");
        $bsConsoIndPreparator->moveIndToTemplateByName("BscDgclJoursCarenceContractuel");

        $formDgcl = $this->createForm(BscDgclJoursCarenceType::class, $bilanSocialConsolide);
        $formDgcl->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formDgcl->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formDgcl->isValid()) {
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

                $bilanSocialConsolide->setMoyenneDgclJoursCarence(100);
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

        return $this->render('@Conso/BilanSocialConsolide/editDgclJoursCarence.html.twig', array(
                    'forms' => $formDgcl->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'collectivite' => $this->getMaCollectivite()
        ));
    }
}
