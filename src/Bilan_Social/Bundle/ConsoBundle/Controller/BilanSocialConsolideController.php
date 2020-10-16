<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\CoreBundle\Entity\IncoherenceLog;
use Bilan_Social\Bundle\BilanSocialBundle\Entity\HistoriqueBilanSocial;
use Bilan_Social\Bundle\BilanSocialBundle\Entity\InitBilanSocial;
use Doctrine\Common\Collections\ArrayCollection;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefActeViolencePhysique;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifAbsence;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefActionPrevention;
use \PDO;
use ZipArchive;
use Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier;
class BilanSocialConsolideController extends AbstractBSController {

    public function GetResponseConditions($code, $bilanSocialConsolide) {
        $json = $this->getNumberQuestion($bilanSocialConsolide);
        $json['data'] = $code;
        // nmForm = 5
        return new JsonResponse($json);
    }
    
    protected function GetQuestionnaireAction(int $idColl, int $idEnqu) {

        $questionCollectiviteConsolide = $this->getEntityManager()->getRepository('ConsoBundle:QuestionCollectiviteConsolide')
                ->findOneByActif($idColl, $idEnqu);

        if ($questionCollectiviteConsolide == null) {
            return null;
        }
        return $questionCollectiviteConsolide;
    }

    protected function GetMonQuestionnaireAction() {
       $questionnaire = $this->GetQuestionnaireAction($this->getMaCollectivite()->getIdColl(),$this->getMonEnquete()->getIdEnqu());
       return $questionnaire;
    }

    protected function UpdateIncoherenceEffectifLog($bilanSocialConsolide, $questionCollectiviteConsolide) {

        $anneeCamp = $this->getMaCampagne()->getNmAnne();

        /**
         * Incohérences 110
         */
        $blIncoInd110 = 0;
        if ($questionCollectiviteConsolide->getQ8() == true) {
            $total110 = 0;
            foreach ($bilanSocialConsolide->getInd1101s() as $ind1101) {
                $total110 += $ind1101->getR1101(0) + $ind1101->getR1102(0) +$ind1101->getR1103(0) +$ind1101->getR1104(0) +$ind1101->getR1105(0) +
                        $ind1101->getR1106(0) +$ind1101->getR1107(0) +$ind1101->getR1108(0) +$ind1101->getR1109(0) +$ind1101->getR1110(0);
            }
            foreach ($bilanSocialConsolide->getInd1102s() as $ind1101) {
                $total110 += $ind1101->getR1101(0) + $ind1101->getR1102(0) +$ind1101->getR1103(0) +$ind1101->getR1104(0) +$ind1101->getR1105(0) +
                        $ind1101->getR1106(0) +$ind1101->getR1107(0) +$ind1101->getR1108(0) +$ind1101->getR1109(0) +$ind1101->getR1110(0);
            }
            foreach ($bilanSocialConsolide->getInd1103s() as $ind1101) {
                $total110 += $ind1101->getR1101(0) + $ind1101->getR1102(0);
            }

            $total = 0;

            foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                $total += $ind111->getR1115(0) + $ind111->getR1116(0);
            }
            foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                $total += $ind121->getR1211(0) + $ind121->getR1212(0) + $ind121->getR1213(0) + $ind121->getR1214(0) +
                             $ind121->getR1215(0) + $ind121->getR1216(0) + $ind121->getR1217(0) + $ind121->getR1218(0) + $ind121->getR12118(0);
            }

            if ($total110 > $total) {
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("total111");
                $incoherenceLog->setTableNum("1.1.0");
                $incoherenceLog->setForm("1");
                $incoherenceLog->setIdToggle1("toggle110");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($this->get('translator')->trans('ind110.consolide.incoherencelog'));
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd110 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }


        }




        /**
         * Incohérences 111
         */
        $blIncoInd111 = 0;
        if ($questionCollectiviteConsolide->getQ2() == true) {
            foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                if (( ($ind111->getR1115() == null ? 0 : $ind111->getR1115()) + ($ind111->getR1116() == null ? 0 : $ind111->getR1116()) ) != ( ($ind111->getR1111() == null ? 0 : $ind111->getR1111()) + ($ind111->getR1112() == null ? 0 : $ind111->getR1112()) +
                        ($ind111->getR1113() == null ? 0 : $ind111->getR1113()) + ($ind111->getR1114() == null ? 0 : $ind111->getR1114()))) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("111trGrad_" . json_encode($ind111->getRefGrade()->getIdGrad()));
                    $incoherenceLog->setTableNum("1.1.1");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setIdToggle1("toggle111");
                    $incoherenceLog->setIdToggle2("toggle111_" . json_encode($ind111->getRefGrade()->getRefCadreEmploi()->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind111Grade.consolide.incoherencelog', array('lbgrade' => $ind111->getRefGrade()->getLbGrad())));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd111 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
        }

        /**
         * Incohérences 112
         */
        $blIncoInd112 = 0;
        if ($questionCollectiviteConsolide->getQ2() == true) {
            foreach ($bilanSocialConsolide->getInd112s() as $ind112) {
                $idCe = $ind112->getRefCadreEmploi()->getIdCadrempl();

                $totalCe = ($ind112->getR1121() == null ? 0 : $ind112->getR1121()) + ($ind112->getR1123() == null ? 0 : $ind112->getR1123()) +
                        ($ind112->getR1125() == null ? 0 : $ind112->getR1125()) + ($ind112->getR1127() == null ? 0 : $ind112->getR1127()) +
                        ($ind112->getR1122() == null ? 0 : $ind112->getR1122()) + ($ind112->getR1124() == null ? 0 : $ind112->getR1124()) +
                        ($ind112->getR1126() == null ? 0 : $ind112->getR1126()) + ($ind112->getR1128() == null ? 0 : $ind112->getR1128());

                $totalCe111 = 0;
                $totalCeH111 = 0;
                $totalCeF111 = 0;
                foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                    if ($idCe == $ind111->getRefGrade()->getRefCadreEmploi()->getIdCadrempl()) {
                        $totalCe111 = $totalCe111 + ($ind111->getR1111() == null ? 0 : $ind111->getR1111());
                        $totalCeH111 += $ind111->getR1115(0);
                        $totalCeF111 += $ind111->getR1116(0);
                    }
                }

                $totalCe112H = $ind112->getR1121(0) + $ind112->getR1123(0) + $ind112->getR1125(0) + $ind112->getR1127(0);
                $totalCe112F = $ind112->getR1122(0) + $ind112->getR1124(0) + $ind112->getR1126(0) + $ind112->getR1128(0);

                if ($totalCe != $totalCe111) {
                    //error_log('CE = ' . $ind112->getRefCadreEmploi()->getLbCadrempl(), 0);
                    //error_log('$totalCe111 ' . json_encode($totalCe111),0);
                    //error_log('$totalCe ' . json_encode($totalCe),0);

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("112trCE_" . json_encode($ind112->getRefCadreEmploi()->getIdCadrempl()));
                    $incoherenceLog->setTableNum("1.1.2");
                    $incoherenceLog->setIdToggle1("toggle112");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setIdToggle2("toggle112_" . json_encode($ind112->getRefCadreEmploi()->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind112cadreemploi.consolide.incoherencelog', array('lbcadreemploi' => $ind112->getRefCadreEmploi()->getLbCadrempl())));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($totalCe == 0 && $totalCe111 > 0) {
                        // donnee manquante
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd112 != 2)
                            $blIncoInd112 = 1;
                    } else {
                        // incoherence
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd112 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if ($totalCe112H > $totalCeH111) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("112trCE_" . json_encode($ind112->getRefCadreEmploi()->getIdCadrempl()));
                    $incoherenceLog->setTableNum("1.1.2");
                    $incoherenceLog->setIdToggle1("toggle112");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setIdToggle2("toggle112_" . json_encode($ind112->getRefCadreEmploi()->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind112Hcadreemploi.consolide.incoherencelog', array('lbcadreemploi' => $ind112->getRefCadreEmploi()->getLbCadrempl())));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd112 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if ($totalCe112F > $totalCeF111) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("112trCE_" . json_encode($ind112->getRefCadreEmploi()->getIdCadrempl()));
                    $incoherenceLog->setTableNum("1.1.2");
                    $incoherenceLog->setIdToggle1("toggle112");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setIdToggle2("toggle112_" . json_encode($ind112->getRefCadreEmploi()->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind112Fcadreemploi.consolide.incoherencelog', array('lbcadreemploi' => $ind112->getRefCadreEmploi()->getLbCadrempl())));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd112 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }
        }

        /**
         * Incohérences 113
         */
        $blIncoInd113 = 0;
        if ($questionCollectiviteConsolide->getQ2() == true) {
            foreach ($bilanSocialConsolide->getInd113s() as $ind113) {
                $idCate = $ind113->getRefCategorie()->getIdCate();
                $fgGenr = $ind113->getFgGenr();
                $lbGenr = "";
                if ($fgGenr == "H") {
                    $lbGenr = "Hommes";
                }
                else if ($fgGenr == "F") {
                    $lbGenr = "Femmes";
                }

                if ($fgGenr != null && $fgGenr != "") {
                    $total = ($ind113->getR1131() == null ? 0 : $ind113->getR1131()) + ($ind113->getR1132() == null ? 0 : $ind113->getR1132());

                    $total112 = 0;

                    foreach ($bilanSocialConsolide->getInd112s() as $ind112) {
                        if ($idCate == $ind112->getRefCadreEmploi()->getRefCategorie()->getIdCate()) {
                            if ($fgGenr == "H") {
                                $total112 = $total112 + ($ind112->getR1123() == null ? 0 : $ind112->getR1123()) +
                                        ($ind112->getR1125() == null ? 0 : $ind112->getR1125()) +
                                        ($ind112->getR1127() == null ? 0 : $ind112->getR1127());
                            }
                            else if ($fgGenr == "F") {
                                $total112 = $total112 + ($ind112->getR1124() == null ? 0 : $ind112->getR1124()) +
                                        ($ind112->getR1126() == null ? 0 : $ind112->getR1126()) +
                                        ($ind112->getR1128() == null ? 0 : $ind112->getR1128());
                            }
                        }
                    }

                    if ($total != $total112) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("113idTr_" . json_encode($ind113->getRefCategorie()->getIdCate()) . "-" . $fgGenr);
                        $incoherenceLog->setTableNum("1.1.3");
                        $incoherenceLog->setIdToggle1("toggle113");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind113categorie.consolide.incoherencelog', array('lbcategorie' => $ind113->getRefCategorie()->getLbCate(), 'genre' => $lbGenr)));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setForm("1");


                        if ($total == 0 && $total112 > 0) {
                            $incoherenceLog->setBlIncoherence(false);
                            if ($blIncoInd113 != 2)
                                $blIncoInd113 = 1;
                        } else {
                            $incoherenceLog->setBlIncoherence(true);
                            $blIncoInd113 = 2;
                        }
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }
                }
            }
        }

        /**
         * Incohérences 114
         */
        $blIncoInd114 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true) {
            foreach ($bilanSocialConsolide->getInd114s() as $ind114) {
                $totalFil = ($ind114->getR1143() == null ? 0 : $ind114->getR1143()) + ($ind114->getR1144() == null ? 0 : $ind114->getR1144());
                $idFili = $ind114->getRefFiliere()->getIdFili();

                $totalFil111 = 0;
                foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                    if ($idFili == $ind111->getRefGrade()->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                        $totalFil111 = $totalFil111 + ($ind111->getR1115() == null ? 0 : $ind111->getR1115()) + ($ind111->getR1116() == null ? 0 : $ind111->getR1116());
                    }
                }

                if ($totalFil111 > 0 && $totalFil == 0) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("114idTr_" . json_encode($ind114->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setTableNum("1.1.4");
                    $incoherenceLog->setIdToggle1("toggle114");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind114filiere.consolide.incoherencelog', array('lbfiliere' => $ind114->getRefFiliere()->getLbFili())));
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd114 = 2;
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setForm("1");
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
        }


        // Incoherences 1.2.1
        $blIncoInd121 = 0;
        if ($questionCollectiviteConsolide->getQ4() == true) {
            foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                if ($blIncoInd121 == 0)
                    $blIncoInd121 = 4;
                $total18 = 0;
                if ($ind121->getR12118() != null)
                    $total18 = $ind121->getR12118();

                //error_log('total18 = ' . $total18);

                $totalCdi = 0;
                if ($ind121->getR12114() != null)
                    $totalCdi += $ind121->getR12114();
                if ($ind121->getR12116() != null)
                    $totalCdi += $ind121->getR12116();

                //error_log('totalcdi = ' . $totalCdi);
                $message = "";
                if ($total18 != $totalCdi) {
                    $message = $this->get('translator')->trans('ind121cadreemploicdi.consolide.incoherencelog', array('lbcadreemploi' => $ind121->getRefCadreEmploi()->getLbCadrempl()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("121trCE_" . json_encode($ind121->getRefCadreEmploi()->getIdCadrempl()));
                    $incoherenceLog->setTableNum("1.2.1");
                    $incoherenceLog->setIdToggle1("toggle121");
                    $incoherenceLog->setIdToggle2("toggle121_" . json_encode($ind121->getRefCadreEmploi()->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd121 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $total = 0;
                if ($ind121->getR1211() != null)
                    $total += $ind121->getR1211();
                if ($ind121->getR1212() != null)
                    $total += $ind121->getR1212();
                if ($ind121->getR1213() != null)
                    $total += $ind121->getR1213();
                if ($ind121->getR1214() != null)
                    $total += $ind121->getR1214();
                if ($ind121->getR1215() != null)
                    $total += $ind121->getR1215();
                if ($ind121->getR1216() != null)
                    $total += $ind121->getR1216();
                if ($ind121->getR1217() != null)
                    $total += $ind121->getR1217();
                if ($ind121->getR1218() != null)
                    $total += $ind121->getR1218();
                if ($ind121->getR12118() != null)
                    $total += $ind121->getR12118();

                //error_log('total = ' . $total);

                $totalTousEmploi = 0;
                if ($ind121->getR1219() != null)
                    $totalTousEmploi += $ind121->getR1219();
                if ($ind121->getR12110() != null)
                    $totalTousEmploi += $ind121->getR12110();

                //error_log('totalTousEmploi = ' . $totalTousEmploi);

                if ($total != $totalTousEmploi) {
                    $message = $this->get('translator')->trans('ind121cadreemploi.consolide.incoherencelog', array('lbcadreemploi' => $ind121->getRefCadreEmploi()->getLbCadrempl()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("121trCE_" . json_encode($ind121->getRefCadreEmploi()->getIdCadrempl()));
                    $incoherenceLog->setTableNum("1.2.1");
                    $incoherenceLog->setIdToggle1("toggle121");
                    $incoherenceLog->setIdToggle2("toggle121_" . json_encode($ind121->getRefCadreEmploi()->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd121 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $totalAnciennente = 0;
                if ($ind121->getR12111() != null)
                    $totalAnciennente += $ind121->getR12111();
                if ($ind121->getR12112() != null)
                    $totalAnciennente += $ind121->getR12112();
                if ($ind121->getR12113() != null)
                    $totalAnciennente += $ind121->getR12113();

                //error_log('totalAnciennente = ' . $totalAnciennente);

                if ($total != $totalAnciennente) {
                    $message = $this->get('translator')->trans('ind121cadreemploianciennete.consolide.incoherencelog', array('lbcadreemploi' => $ind121->getRefCadreEmploi()->getLbCadrempl()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("121trCE_" . json_encode($ind121->getRefCadreEmploi()->getIdCadrempl()));
                    $incoherenceLog->setTableNum("1.2.1");
                    $incoherenceLog->setIdToggle1("toggle121");
                    $incoherenceLog->setIdToggle2("toggle121_" . json_encode($ind121->getRefCadreEmploi()->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd121 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $totalHomFem = 0;
                if ($ind121->getR12114() != null)
                    $totalHomFem += $ind121->getR12114();
                if ($ind121->getR12115() != null)
                    $totalHomFem += $ind121->getR12115();
                if ($ind121->getR12116() != null)
                    $totalHomFem += $ind121->getR12116();
                if ($ind121->getR12117() != null)
                    $totalHomFem += $ind121->getR12117();

                //error_log('totalHomFem = ' . $totalHomFem);

                if ($total != $totalHomFem) {
                    $message = $this->get('translator')->trans('ind121cadreemploitotal.consolide.incoherencelog', array('lbcadreemploi' => $ind121->getRefCadreEmploi()->getLbCadrempl()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("121trCE_" . json_encode($ind121->getRefCadreEmploi()->getIdCadrempl()));
                    $incoherenceLog->setTableNum("1.2.1");
                    $incoherenceLog->setIdToggle1("toggle121");
                    $incoherenceLog->setIdToggle2("toggle121_" . json_encode($ind121->getRefCadreEmploi()->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd121 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $totalHomFemCDD = 0;
                if ($ind121->getR12117() != null)
                    $totalHomFemCDD += $ind121->getR12117();
                if ($ind121->getR12115() != null)
                    $totalHomFemCDD += $ind121->getR12115();

               // error_log('totalHomFemCDD = ' . $totalHomFemCDD);

                $totalCDD = 0;
                if ($ind121->getR1211() != null)
                    $totalCDD += $ind121->getR1211();
                if ($ind121->getR1212() != null)
                    $totalCDD += $ind121->getR1212();
                if ($ind121->getR1213() != null)
                    $totalCDD += $ind121->getR1213();
                if ($ind121->getR1214() != null)
                    $totalCDD += $ind121->getR1214();
                if ($ind121->getR1215() != null)
                    $totalCDD += $ind121->getR1215();
                if ($ind121->getR1216() != null)
                    $totalCDD += $ind121->getR1216();
                if ($ind121->getR1217() != null)
                    $totalCDD += $ind121->getR1217();
                if ($ind121->getR1218() != null)
                    $totalCDD += $ind121->getR1218();

                //error_log('totalCDD = ' . $totalCDD);

                if ($totalCDD != $totalHomFemCDD) {
                    $message = $this->get('translator')->trans('ind121cadreemploitotalcdd.consolide.incoherencelog', array('lbcadreemploi' => $ind121->getRefCadreEmploi()->getLbCadrempl()));


                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("121trCE_" . json_encode($ind121->getRefCadreEmploi()->getIdCadrempl()));
                    $incoherenceLog->setTableNum("1.2.1");
                    $incoherenceLog->setIdToggle1("toggle121");
                    $incoherenceLog->setIdToggle2("toggle121_" . json_encode($ind121->getRefCadreEmploi()->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd121 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
        }

        /**
         * Incohérences 122
         */
        $blIncoInd122 = 0;
        if ($questionCollectiviteConsolide->getQ4() == true) {
            foreach ($bilanSocialConsolide->getInd122s() as $ind122) {
                $idCe = $ind122->getRefCadreEmploi()->getIdCadrempl();

                $totalCe = ($ind122->getR1221() == null ? 0 : $ind122->getR1221()) + ($ind122->getR1223() == null ? 0 : $ind122->getR1223()) +
                        ($ind122->getR1225() == null ? 0 : $ind122->getR1225()) + ($ind122->getR1227() == null ? 0 : $ind122->getR1227()) +
                        ($ind122->getR1222() == null ? 0 : $ind122->getR1222()) + ($ind122->getR1224() == null ? 0 : $ind122->getR1224()) +
                        ($ind122->getR1226() == null ? 0 : $ind122->getR1226()) + ($ind122->getR1228() == null ? 0 : $ind122->getR1228());

                $totalCe121 = 0;
                foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                    if ($idCe == $ind121->getRefCadreEmploi()->getIdCadrempl()) {
                        $totalCe121 = $totalCe121 + $ind121->getR1219(0);
                    }
                }

                if ($totalCe != $totalCe121) {
                    //error_log('CE = ' . $ind122->getRefCadreEmploi()->getLbCadrempl(), 0);
                    //error_log('$totalCe121 ' . json_encode($totalCe121),0);
                    //error_log('$totalCe ' . json_encode($totalCe),0);

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("122trCE_" . json_encode($ind122->getRefCadreEmploi()->getIdCadrempl()));
                    $incoherenceLog->setTableNum("1.2.2");
                    $incoherenceLog->setIdToggle1("toggle122");
                    $incoherenceLog->setIdToggle2("toggle122_" . json_encode($ind122->getRefCadreEmploi()->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind122cadreemploi.consolide.incoherencelog', array('lbcadreemploi' => $ind122->getRefCadreEmploi()->getLbCadrempl())));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    //$incoherenceLog->setBlIncoherence(true);
                    $incoherenceLog->setForm("1");
                    //if ($totalCe == 0 && $totalCe121 > 0) {
                        //$incoherenceLog->setBlIncoherence(false);
                    //}
                    if ($totalCe == 0 && $totalCe121 > 0) {
                        $incoherenceLog->setBlIncoherence(false);

                        if ($blIncoInd122 != 2)
                            $blIncoInd122 = 1;
                    } else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd122 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
        }


        /**
         * Incohérences 123
         */
        $blIncoInd123 = 0;
        if ($questionCollectiviteConsolide->getQ4() == true) {
            foreach ($bilanSocialConsolide->getInd123s() as $ind123) {
                $idCate = $ind123->getRefCategorie()->getIdCate();
                $fgGenr = $ind123->getFgGenr();
                $lbGenr = "";
                if ($fgGenr == "H") {
                    $lbGenr = "Hommes";
                }
                else if ($fgGenr == "F") {
                    $lbGenr = "Femmes";
                }

                if ($fgGenr != null && $fgGenr != "") {
                    $total = ($ind123->getR1231() == null ? 0 : $ind123->getR1231()) + ($ind123->getR1232() == null ? 0 : $ind123->getR1232());

                    $total122 = 0;

                    foreach ($bilanSocialConsolide->getInd122s() as $ind122) {
                        if ($idCate == $ind122->getRefCadreEmploi()->getRefCategorie()->getIdCate()) {
                            if ($fgGenr == "H") {
                                $total122 = $total122 + ($ind122->getR1223() == null ? 0 : $ind122->getR1223()) +
                                        ($ind122->getR1225() == null ? 0 : $ind122->getR1225()) +
                                        ($ind122->getR1227() == null ? 0 : $ind122->getR1227());
                            }
                            else if ($fgGenr == "F") {
                                $total122 = $total122 + ($ind122->getR1224() == null ? 0 : $ind122->getR1224()) +
                                        ($ind122->getR1226() == null ? 0 : $ind122->getR1226()) +
                                        ($ind122->getR1228() == null ? 0 : $ind122->getR1228());
                            }
                        }
                    }

                    if ($total != $total122) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("123idTr_" . json_encode($ind123->getRefCategorie()->getIdCate()) . "-" . $fgGenr);
                        $incoherenceLog->setTableNum("1.2.3");
                        $incoherenceLog->setIdToggle1("toggle123");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setForm("1");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind123categorie.consolide.incoherencelog', array('lbcategorie' => $ind123->getRefCategorie()->getLbCate(), 'genre' => $lbGenr)));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        //$incoherenceLog->setBlIncoherence(true);
                        //if ($total == 0 && $total122 > 0) {
                            //$incoherenceLog->setBlIncoherence(false);
                        //}
                        if ($total == 0 && $total122 > 0) {
                            $incoherenceLog->setBlIncoherence(false);

                            if ($blIncoInd123 != 2)
                                $blIncoInd123 = 1;
                        } else {
                            $incoherenceLog->setBlIncoherence(true);
                            $blIncoInd123 = 2;
                        }
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }
                }
            }
        }



        /**
         * Incohérences 124
         */
        $blIncoInd124 = 0;
        if ($questionCollectiviteConsolide->getQ3() == true) {
            foreach ($bilanSocialConsolide->getInd124s() as $ind124) {
                $totalFil = ($ind124->getR1243() == null ? 0 : $ind124->getR1243()) + ($ind124->getR1244() == null ? 0 : $ind124->getR1244());
                $idFili = $ind124->getRefFiliere()->getIdFili();

                $totalFil121 = 0;
                foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                    if ($idFili == $ind121->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                        $totalFil121 = $totalFil121 + ($ind121->getR1215() == null ? 0 : $ind121->getR1215()) + ($ind121->getR1216() == null ? 0 : $ind121->getR1216()) + ($ind121->getR1217() == null ? 0 : $ind121->getR1217()) + ($ind121->getR1214() == null ? 0 : $ind121->getR1214());
                    }
                }

                if ($totalFil121 > 0 && $totalFil == 0) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("124idTr_" . json_encode($ind124->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setTableNum("1.2.4");
                    $incoherenceLog->setIdToggle1("toggle124");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind124filiere.consolide.incoherencelog',
                                            array('lbfiliere' => $ind124->getRefFiliere()->getLbFili(), 'anneecamp' => $anneeCamp)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setBlIncoherence(true);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd124 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
        }

        /**
         * Incohérences 1311 et 1312
         */
        $blIncoInd131 = 0;
        if ($questionCollectiviteConsolide->getQ5() == true || $questionCollectiviteConsolide->getQ6()) {

            foreach ($bilanSocialConsolide->getInd1311s() as $ind1311) {
                $total1 = ($ind1311->getR13111() == null ? 0 : $ind1311->getR13111()) + ($ind1311->getR13112() == null ? 0 : $ind1311->getR13112());
                $total1H = $ind1311->getR13111(0);
                $total1F = $ind1311->getR13112(0);
                $total2 = ($ind1311->getR13113() == null ? 0 : $ind1311->getR13113()) + ($ind1311->getR13114() == null ? 0 : $ind1311->getR13114());
                $total2H = $ind1311->getR13113(0);
                $total2F = $ind1311->getR13114(0);

                if ($total1 > $total2) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("1311idTr_" . json_encode($ind1311->getRefEmploiNonPermanent()->getIdEmplnonperm()));
                    $incoherenceLog->setTableNum("1.3.1.1");
                    $incoherenceLog->setIdToggle1("toggle131");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1311emploinonperm.consolide.incoherencelog', array('lbemploinonperm' => $ind1311->getRefEmploiNonPermanent()->getLbEmplnonperm())));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd131 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
                if ($total1H > $total2H) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("1311idTr_" . json_encode($ind1311->getRefEmploiNonPermanent()->getIdEmplnonperm()));
                    $incoherenceLog->setTableNum("1.3.1.1");
                    $incoherenceLog->setIdToggle1("toggle131");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1311Hemploinonperm.consolide.incoherencelog', array('lbemploinonperm' => $ind1311->getRefEmploiNonPermanent()->getLbEmplnonperm())));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd131 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
                if ($total1F > $total2F) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("1311idTr_" . json_encode($ind1311->getRefEmploiNonPermanent()->getIdEmplnonperm()));
                    $incoherenceLog->setTableNum("1.3.1.1");
                    $incoherenceLog->setIdToggle1("toggle131");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1311Femploinonperm.consolide.incoherencelog', array('lbemploinonperm' => $ind1311->getRefEmploiNonPermanent()->getLbEmplnonperm())));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd131 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }

            foreach ($bilanSocialConsolide->getInd1312s() as $ind1312) {

                $total2 = ($ind1312->getR13123() == null ? 0 : $ind1312->getR13123()) + ($ind1312->getR13124() == null ? 0 : $ind1312->getR13124());
                $total2H = $ind1312->getR13123(0);
                $total2F = $ind1312->getR13124(0);

                $ref = $ind1312->getRefEmploiNonPermanent()->getIdEmplnonperm();

                foreach ($bilanSocialConsolide->getInd1311s() as $ind1311) {
                    if ($ind1311->getRefEmploiNonPermanent()->getIdEmplnonperm() == $ref) {
                        $tot1311 = ($ind1311->getR13113() == null ? 0 : $ind1311->getR13113()) + ($ind1311->getR13114() == null ? 0 : $ind1311->getR13114());
                        $tot1311H = $ind1311->getR13113(0);
                        $tot1311F = $ind1311->getR13114(0);

                        if ($total2 > $tot1311) {
                            $incoherenceLog = new IncoherenceLog();
                            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                            $incoherenceLog->setField("1312idTr_" . json_encode($ind1312->getRefEmploiNonPermanent()->getIdEmplnonperm()));
                            $incoherenceLog->setTableNum("1.3.1.2");
                            $incoherenceLog->setIdToggle1("toggle131");
                            $incoherenceLog->setIdToggle2("");
                            $incoherenceLog->setForm("1");
                            $incoherenceLog->setMessage($this->get('translator')->trans('ind1312emploinonperm.consolide.incoherencelog', array('lbemploinonperm' => $ind1312->getRefEmploiNonPermanent()->getLbEmplnonperm())));
                            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                            $incoherenceLog->setBlIncoherence(true);
                            $blIncoInd131 = 2;
                            $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                        }
                        if ($total2H > $tot1311H) {
                            $incoherenceLog = new IncoherenceLog();
                            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                            $incoherenceLog->setField("1312idTr_" . json_encode($ind1312->getRefEmploiNonPermanent()->getIdEmplnonperm()));
                            $incoherenceLog->setTableNum("1.3.1.2");
                            $incoherenceLog->setIdToggle1("toggle131");
                            $incoherenceLog->setIdToggle2("");
                            $incoherenceLog->setForm("1");
                            $incoherenceLog->setMessage($this->get('translator')->trans('ind1312Hemploinonperm.consolide.incoherencelog', array('lbemploinonperm' => $ind1312->getRefEmploiNonPermanent()->getLbEmplnonperm())));
                            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                            $incoherenceLog->setBlIncoherence(true);
                            $blIncoInd131 = 2;
                            $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                        }
                        if ($total2F > $tot1311F) {
                            $incoherenceLog = new IncoherenceLog();
                            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                            $incoherenceLog->setField("1312idTr_" . json_encode($ind1312->getRefEmploiNonPermanent()->getIdEmplnonperm()));
                            $incoherenceLog->setTableNum("1.3.1.2");
                            $incoherenceLog->setIdToggle1("toggle131");
                            $incoherenceLog->setIdToggle2("");
                            $incoherenceLog->setForm("1");
                            $incoherenceLog->setMessage($this->get('translator')->trans('ind1312Femploinonperm.consolide.incoherencelog', array('lbemploinonperm' => $ind1312->getRefEmploiNonPermanent()->getLbEmplnonperm())));
                            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                            $incoherenceLog->setBlIncoherence(true);
                            $blIncoInd131 = 2;
                            $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                        }
                    }
                }
            }

            foreach ($bilanSocialConsolide->getInd1312s() as $ind1312) {
                $total1312 = $ind1312->getR13123(0) + $ind1312->getR13124(0);
                $idEnp2 = $ind1312->getRefEmploiNonPermanent()->getIdEmplnonperm();

                $total1311 = 0;
                foreach ($bilanSocialConsolide->getInd1311s() as $ind1311) {
                    $idEnp1 = $ind1311->getRefEmploiNonPermanent()->getIdEmplnonperm();

                    if($idEnp1 == $idEnp2) {
                        $total1311 = $ind1311->getR13111(0) + $ind1311->getR13112(0) + $ind1311->getR13113(0) + $ind1311->getR13114(0);
                        break;
                    }
                }

                if($total1312 == 0 && $total1311 != 0) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("1312idTr_" . json_encode($ind1312->getRefEmploiNonPermanent()->getIdEmplnonperm()));
                    $incoherenceLog->setTableNum("1.3.1.2");
                    $incoherenceLog->setIdToggle1("toggle131");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1312emploinonperm.consolide1311.incoherencelog', array('lbemploinonperm' => $ind1312->getRefEmploiNonPermanent()->getLbEmplnonperm())));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(false);
                    if($blIncoInd131!=2) $blIncoInd131 = 1;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
        }

        /**
         * Incohérences 132
         */
        $blIncoInd132 = 0;
        if ($bilanSocialConsolide->getQ132() == true) {
            $total13211 = 0;
            $total13212 = 0;
            $total13213 = 0;
            $total13214 = 0;

            foreach ($bilanSocialConsolide->getInd132s() as $ind132) {
                $total13211 += $ind132->getR13211(0);
                $total13212 += $ind132->getR13212(0);
                $total13213 += $ind132->getR13213(0);
                $total13214 += $ind132->getR13214(0);

                if ($total13211 > $total13213) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("tr1");
                    $incoherenceLog->setTableNum("1.3.2");
                    $incoherenceLog->setIdToggle1("toggle132");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1321.consolide.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd132 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if ($total13212 > $total13214) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("tr1");
                    $incoherenceLog->setTableNum("1.3.2");
                    $incoherenceLog->setIdToggle1("toggle132");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1321.consolide.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd132 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }

        }


        $blIncoEff110 = 0;

        if ($bilanSocialConsolide->getInd1101s()->Count() == 0) {
            //pas de donnees
            $bilanSocialConsolide->setBlIncoInd110(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd110(0);
            $blIncoEff110 = 1;
        }
        else if ($blIncoInd110 == 2) {
            //au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd110(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd110(50);
            $blIncoEff110 = 3;
        }
        else {
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd110(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd110(100);
            $blIncoEff110 = 4;
        }


        $blIncoEff111 = 0;

        if ($bilanSocialConsolide->getInd111s()->Count() == 0) {
            //pas de donnees
            $bilanSocialConsolide->setBlIncoInd111(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd111(0);
            $blIncoEff111 = 1;
        }
        else if ($blIncoInd111 == 2) {
            //au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd111(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd111(50);
            $blIncoEff111 = 3;
        }
        else {
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd111(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd111(100);
            $blIncoEff111 = 4;
        }


        $blIncoEff112 = 0;
        if ($bilanSocialConsolide->getInd112s()->Count() == 0) {
            // pas d enregistrement => etat = 1
            $bilanSocialConsolide->setBlIncoInd112(1);
            $bilanSocialConsolide->setMoyenneInd112(0);
            $blIncoEff112 = 1;
        }
        else if ($blIncoInd112 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd112(2);
            $bilanSocialConsolide->setMoyenneInd112(50);
            $blIncoEff112 = 2;
        }
        else if ($blIncoInd112 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd112(3);
            $bilanSocialConsolide->setMoyenneInd112(50);
            $blIncoEff112 = 3;
        }
        else {
            // des donnees mais aucun enregistrement dans incoh log
            $bilanSocialConsolide->setBlIncoInd112(4);
            $bilanSocialConsolide->setMoyenneInd112(100);
            $blIncoEff112 = 4;
        }

        $blIncoEff113 = 0;
        if ($bilanSocialConsolide->getInd113s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd113(1);
            $bilanSocialConsolide->setMoyenneInd113(0);
            $blIncoEff113 = 1;
        }
        else if ($blIncoInd113 == 1) {
            $bilanSocialConsolide->setBlIncoInd113(2);
            $bilanSocialConsolide->setMoyenneInd113(50);
            $blIncoEff113 = 2;
        }
        else if ($blIncoInd113 == 2) {
            $bilanSocialConsolide->setBlIncoInd113(3);
            $bilanSocialConsolide->setMoyenneInd113(50);
            $blIncoEff113 = 3;
        }
        else {
            $bilanSocialConsolide->setBlIncoInd113(4);
            $bilanSocialConsolide->setMoyenneInd113(100);
            $blIncoEff113 = 4;
        }

        $blIncoEff114 = 0;
        $moyenneInd114 = 0;
        if ($bilanSocialConsolide->getInd114s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd114(1);
            $bilanSocialConsolide->setMoyenneInd114(0);
            $moyenneInd114 = 0;
            $blIncoEff114 = 1;
        }
        else if ($blIncoInd114 == 1) {
            $bilanSocialConsolide->setBlIncoInd114(2);
            $bilanSocialConsolide->setMoyenneInd114(50);
            $moyenneInd114 = 50;
            $blIncoEff114 = 2;
        }
        else if ($blIncoInd114 == 2) {

            $bilanSocialConsolide->setBlIncoInd114(3);
            $bilanSocialConsolide->setMoyenneInd114(50);
            $moyenneInd114 = 50;
            $blIncoEff114 = 3;
        }
        else {
            $bilanSocialConsolide->setBlIncoInd114(4);
            $bilanSocialConsolide->setMoyenneInd114(100);
            $moyenneInd114 = 100;
            $blIncoEff114 = 4;
        }
        $blIncoEff121 = 0;
        if ($bilanSocialConsolide->getInd121s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd121(1);
            $bilanSocialConsolide->setMoyenneInd121(0);
            $blIncoEff121 = 1;
        }
        else if ($blIncoInd121 == 1) {
            $bilanSocialConsolide->setBlIncoInd121(2);
            $bilanSocialConsolide->setMoyenneInd121(50);
            $blIncoEff121 = 2;
        }
        else
        if ($blIncoInd121 == 2) {

            $bilanSocialConsolide->setBlIncoInd121(3);
            $bilanSocialConsolide->setMoyenneInd121(50);
            $blIncoEff121 = 3;
        }
        else {
            $bilanSocialConsolide->setBlIncoInd121(4);
            $bilanSocialConsolide->setMoyenneInd121(100);
            $blIncoEff121 = 4;
        }
        $blIncoEff122 = 0;
        if ($bilanSocialConsolide->getInd122s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd122(1);
            $bilanSocialConsolide->setMoyenneInd122(0);
            $blIncoEff122 = 1;
        }
        else if ($blIncoInd122 == 1) {
            $bilanSocialConsolide->setBlIncoInd122(2);
            $bilanSocialConsolide->setMoyenneInd122(50);
            $blIncoEff122 = 2;
        }
        else if ($blIncoInd122 == 2) {

            $bilanSocialConsolide->setBlIncoInd122(3);
            $bilanSocialConsolide->setMoyenneInd122(50);
            $blIncoEff122 = 3;
        }
        else {
            $bilanSocialConsolide->setBlIncoInd122(4);
            $bilanSocialConsolide->setMoyenneInd122(100);
            $blIncoEff122 = 4;
        }

        $blIncoEff123 = 0;
        if ($bilanSocialConsolide->getInd123s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd123(1);
            $bilanSocialConsolide->setMoyenneInd123(0);
            $blIncoEff123 = 1;
        }
        else if ($blIncoInd123 == 1) {
            $bilanSocialConsolide->setBlIncoInd123(2);
            $bilanSocialConsolide->setMoyenneInd123(50);
            $blIncoEff123 = 2;
        }
        else if ($blIncoInd123 == 2) {

            $bilanSocialConsolide->setBlIncoInd123(3);
            $bilanSocialConsolide->setMoyenneInd123(50);
            $blIncoEff123 = 3;
        }
        else {
            $bilanSocialConsolide->setBlIncoInd123(4);
            $bilanSocialConsolide->setMoyenneInd123(100);
            $blIncoEff123 = 4;
        }
        $blIncoEff124 = 0;
        if ($bilanSocialConsolide->getInd124s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd124(1);
            $bilanSocialConsolide->setMoyenneInd124(0);
            $blIncoEff124 = 1;
        }
        else if ($blIncoInd124 == 1) {
            $bilanSocialConsolide->setBlIncoInd124(2);
            $bilanSocialConsolide->setMoyenneInd124(50);
            $blIncoEff124 = 2;
        }
        else if ($blIncoInd124 == 2) {

            $bilanSocialConsolide->setBlIncoInd124(3);
            $bilanSocialConsolide->setMoyenneInd124(50);
            $blIncoEff124 = 3;
        }
        else {
            $bilanSocialConsolide->setBlIncoInd124(4);
            $bilanSocialConsolide->setMoyenneInd124(100);
            $blIncoEff124 = 4;
        }

        $blIncoEff131 = 0;
        if ($bilanSocialConsolide->getInd1311s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd131(1);
            $bilanSocialConsolide->setMoyenneInd131(0);
            $blIncoEff131 = 1;
        }
        else if ($blIncoInd131 == 1) {
            $bilanSocialConsolide->setBlIncoInd131(2);
            $bilanSocialConsolide->setMoyenneInd131(50);
            $blIncoEff131 = 2;
        }
        else if ($blIncoInd131 == 2) {

            $bilanSocialConsolide->setBlIncoInd131(3);
            $bilanSocialConsolide->setMoyenneInd131(50);
            $blIncoEff131 = 3;
        }
        else {
            $bilanSocialConsolide->setBlIncoInd131(4);
            $bilanSocialConsolide->setMoyenneInd131(100);
            $blIncoEff131 = 4;
        }

        $blIncoEff132 = 0;
        if ($bilanSocialConsolide->getInd132s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd132(1);
            $bilanSocialConsolide->setMoyenneInd132(0);
            $blIncoEff132 = 1;
        }
        else if ($blIncoInd132 == 1) {
            $bilanSocialConsolide->setBlIncoInd132(2);
            $bilanSocialConsolide->setMoyenneInd132(50);
            $blIncoEff132 = 2;
        }
        else if ($blIncoInd132 == 2) {
            $bilanSocialConsolide->setBlIncoInd132(3);
            $bilanSocialConsolide->setMoyenneInd132(50);
            $blIncoEff132 = 3;
        }
        else {
            $bilanSocialConsolide->setBlIncoInd132(4);
            $bilanSocialConsolide->setMoyenneInd132(100);
            $blIncoEff132 = 4;
        }


        $blIncoEff = 0;
        if (($blIncoEff110 == 3) || ($blIncoEff111 == 3) || ($blIncoEff112 == 3) || ($blIncoEff113 == 3) || ($blIncoEff114 == 3) || ($blIncoEff121 == 3) || ($blIncoEff122 == 3) || ($blIncoEff123 == 3) || ($blIncoEff124 == 3) || ($blIncoEff131 == 3) || ($blIncoEff132 == 3)) {
            $blIncoEff = 3;
        }
        elseif (($blIncoEff110 == 2) || ($blIncoEff111 == 2) || ($blIncoEff112 == 2) || ($blIncoEff113 == 2) || ($blIncoEff114 == 2) || ($blIncoEff121 == 2) || ($blIncoEff122 == 2) || ($blIncoEff123 == 2) || ($blIncoEff124 == 2) || ($blIncoEff131 == 2)|| ($blIncoEff132 == 2)) {
            $blIncoEff = 2;
        }
        elseif (($blIncoEff110 == 1) && ($blIncoEff111 == 1) && ($blIncoEff112 == 1) && ($blIncoEff113 == 1) && ($blIncoEff114 == 1) && ($blIncoEff121 == 1) && ($blIncoEff122 == 1) && ($blIncoEff123 == 1) && ($blIncoEff124 == 1) && ($blIncoEff131 == 1) && ($blIncoEff132 == 1)) {
            $blIncoEff = 1;
        }
        elseif (($blIncoEff110 == 4 ) && ($blIncoEff111 == 4 ) && ($blIncoEff112 == 4) && ($blIncoEff113 == 4) && ($blIncoEff114 == 4) && ($blIncoEff121 == 4) && ($blIncoEff122 == 4) && ($blIncoEff123 == 4) && ($blIncoEff124 == 4) && ($blIncoEff131 == 4) && ($blIncoEff132 == 4)) {
            $blIncoEff = 4;
        }
        $bilanSocialConsolide->setBlIncoEff($blIncoEff);
    }

    protected function UpdateIncoherenceMouvementLog($bilanSocialConsolide, $questionCollectiviteConsolide) {

        /**
         * Incohérences 150
         */
        $blIncoInd150 = 0;
        if ($questionCollectiviteConsolide->GetQ9() == true || $questionCollectiviteConsolide->GetQ10() == true ) {

            // error_log('ind111 = ' . json_encode($bilanSocialConsolide->getInd111s()->count()), 0);
            // error_log('ind121 = ' . json_encode($bilanSocialConsolide->getInd121s()->count()), 0);
            // error_log('ind1311 = ' . json_encode($bilanSocialConsolide->getInd1311s()->count()), 0);
            // error_log('ind1501 = ' . json_encode($bilanSocialConsolide->getInd1501s()->count()), 0);
            // error_log('ind152 = ' . json_encode($bilanSocialConsolide->getInd152s()->count()), 0);
            // error_log('ind1531 = ' . json_encode($bilanSocialConsolide->getInd1531s()->count()), 0);

            if ($bilanSocialConsolide->getInd111s() != null && $bilanSocialConsolide->getInd111s()->count() > 0 &&
                $bilanSocialConsolide->getInd121s() != null && $bilanSocialConsolide->getInd121s()->count() > 0 &&
                $bilanSocialConsolide->getInd1311s() != null && $bilanSocialConsolide->getInd1311s()->count() > 0 &&
                $bilanSocialConsolide->getInd1501s() != null && $bilanSocialConsolide->getInd1501s()->count() > 0 &&
                $bilanSocialConsolide->getInd152s() != null && $bilanSocialConsolide->getInd152s()->count() > 0 &&
                $bilanSocialConsolide->getInd1531s() != null && $bilanSocialConsolide->getInd1531s()->count() > 0) {

                $total15X = 0;
                if ($bilanSocialConsolide->getInd152s() != null && $bilanSocialConsolide->getInd152s()->count() > 0) {
                    // 1.5.2 (colonne total 1 toutes filiere)
                    foreach ($bilanSocialConsolide->getInd152s() as $ind152) {
                        $total15X += ($ind152->getR1521() == null ? 0 : $ind152->getR1521());
                        $total15X += ($ind152->getR1522() == null ? 0 : $ind152->getR1522());
                        $total15X += ($ind152->getR1523() == null ? 0 : $ind152->getR1523());
                        $total15X += ($ind152->getR1524() == null ? 0 : $ind152->getR1524());
                        $total15X += ($ind152->getR1525() == null ? 0 : $ind152->getR1525());
                        $total15X += ($ind152->getR1526() == null ? 0 : $ind152->getR1526());
                        $total15X += ($ind152->getR1527() == null ? 0 : $ind152->getR1527());
                        $total15X += ($ind152->getR1528() == null ? 0 : $ind152->getR1528());
                        $total15X += ($ind152->getR1529() == null ? 0 : $ind152->getR1529());
                        $total15X += ($ind152->getR15210() == null ? 0 : $ind152->getR15210());
                        $total15X += ($ind152->getR15211() == null ? 0 : $ind152->getR15211());
                        $total15X += ($ind152->getR15212() == null ? 0 : $ind152->getR15212());
                        $total15X += ($ind152->getR15213() == null ? 0 : $ind152->getR15213());
                        $total15X += ($ind152->getR15214() == null ? 0 : $ind152->getR15214());
                    }
                }
                if ($bilanSocialConsolide->getInd1531s() != null && $bilanSocialConsolide->getInd1531s()->count() > 0) {
                    // 1.5.3.1 (colonne total pour la ligne remplacant CD_MOTI_ARRI REMPLACANT ) +
                    // + 1.5.3.1 (colonne total pour la ligne Réintégration (agent non rémunéré pendant la période) CD_MOTI_ARRI REMPLACANT ) +
                    // + 1.5.3.1 (colonne total pour la ligne retour agent remunere CD_MOTI_ARRI REMPLACANT ) +
                    foreach ($bilanSocialConsolide->getInd1531s() as $ind1531) {
                        if (   $ind1531->getRefMotifArrivee()->getCdMotiarri() == "MA016"
                            || $ind1531->getRefMotifArrivee()->getCdMotiarri() == "MA017"
                            || $ind1531->getRefMotifArrivee()->getCdMotiarri() == "MA018") {
                            $total15X += ($ind1531->getR15311() == null ? 0 : $ind1531->getR15311());
                            $total15X += ($ind1531->getR15312() == null ? 0 : $ind1531->getR15312());
                            $total15X += ($ind1531->getR15313() == null ? 0 : $ind1531->getR15313());
                            $total15X += ($ind1531->getR15314() == null ? 0 : $ind1531->getR15314());
                        }
                    }
                }
                if ($bilanSocialConsolide->getInd1532s() != null && $bilanSocialConsolide->getInd1532s()->count() > 0) {
                    // + 1.5.3.2 (colonne total Toute filiere colonne total grisé)
                    foreach ($bilanSocialConsolide->getInd1532s() as $ind1532) {
                        $total15X += ($ind1532->getR15321() == null ? 0 : $ind1532->getR15321());
                        $total15X += ($ind1532->getR15322() == null ? 0 : $ind1532->getR15322());
                        $total15X += ($ind1532->getR15323() == null ? 0 : $ind1532->getR15323());
                        $total15X += ($ind1532->getR15324() == null ? 0 : $ind1532->getR15324());
                    }
                }
                $total150 = 0;

                if ($questionCollectiviteConsolide->GetQ9() == true ) {
                    if ($bilanSocialConsolide->getInd1501s() != null && $bilanSocialConsolide->getInd1501s()->count() > 0) {
                        foreach ($bilanSocialConsolide->getInd1501s() as $ind1501) {
                            $total150 += ($ind1501->getR15011() == null ? 0 : $ind1501->getR15011());
                            $total150 += ($ind1501->getR15012() == null ? 0 : $ind1501->getR15012());
                            $total150 += ($ind1501->getR15013() == null ? 0 : $ind1501->getR15013());
                            $total150 += ($ind1501->getR15014() == null ? 0 : $ind1501->getR15014());
                            $total150 += ($ind1501->getR15015() == null ? 0 : $ind1501->getR15015());
                            $total150 += ($ind1501->getR15016() == null ? 0 : $ind1501->getR15016());
                            $total150 += ($ind1501->getR15017() == null ? 0 : $ind1501->getR15017());
                            $total150 += ($ind1501->getR15018() == null ? 0 : $ind1501->getR15018());
                        }
                    }
                }
                if ($questionCollectiviteConsolide->GetQ10() == true ) {
                    if ($bilanSocialConsolide->getInd1502s() != null && $bilanSocialConsolide->getInd1502s()->count() > 0) {
                        foreach ($bilanSocialConsolide->getInd1502s() as $ind1502) {
                            $total150 += ($ind1502->getR15021() == null ? 0 : $ind1502->getR15021());
                            $total150 += ($ind1502->getR15022() == null ? 0 : $ind1502->getR15022());
                            $total150 += ($ind1502->getR15023() == null ? 0 : $ind1502->getR15023());
                            $total150 += ($ind1502->getR15024() == null ? 0 : $ind1502->getR15024());
                            $total150 += ($ind1502->getR15025() == null ? 0 : $ind1502->getR15025());
                            $total150 += ($ind1502->getR15026() == null ? 0 : $ind1502->getR15026());
                            $total150 += ($ind1502->getR15027() == null ? 0 : $ind1502->getR15027());
                            $total150 += ($ind1502->getR15028() == null ? 0 : $ind1502->getR15028());
                        }
                    }
                }
                $totalDifference = $total15X - $total150;

                //error_log('$total15X = ' . json_encode($total15X), 0);
                //error_log('$total150 = ' . json_encode($total150), 0);
                //error_log('$totalDifference = ' . json_encode($totalDifference), 0);

                $totalEffectif = 0;

                if ($bilanSocialConsolide->getInd111s() != null && $bilanSocialConsolide->getInd111s()->count() > 0) {
                    foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                        $totalEffectif += ($ind111->getR1115() == null ? 0 : $ind111->getR1115());
                        $totalEffectif += ($ind111->getR1116() == null ? 0 : $ind111->getR1116());
                    }
                }

                if ($bilanSocialConsolide->getInd121s() != null && $bilanSocialConsolide->getInd121s()->count() > 0) {
                    foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                        $totalEffectif += ($ind121->getR1211() == null ? 0 : $ind121->getR1211());
                        $totalEffectif += ($ind121->getR1212() == null ? 0 : $ind121->getR1212());
                        $totalEffectif += ($ind121->getR1213() == null ? 0 : $ind121->getR1213());
                        $totalEffectif += ($ind121->getR1214() == null ? 0 : $ind121->getR1214());
                        $totalEffectif += ($ind121->getR1215() == null ? 0 : $ind121->getR1215());
                        $totalEffectif += ($ind121->getR1216() == null ? 0 : $ind121->getR1216());
                        $totalEffectif += ($ind121->getR1217() == null ? 0 : $ind121->getR1217());
                        $totalEffectif += ($ind121->getR1218() == null ? 0 : $ind121->getR1218());
                        $totalEffectif += ($ind121->getR12118() == null ? 0 : $ind121->getR12118());
                    }
                }

                if ($totalEffectif != 0) {
                    if ($totalDifference > $totalEffectif) {

                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("150tr");
                        $incoherenceLog->setTableNum("1.5.0");
                        $incoherenceLog->setForm("2");
                        $incoherenceLog->setIdToggle1("toggle150");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind150totauxnoncorrespondant.consolide.incoherencelog'));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                        //$incoherenceLog->setTest($test);
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd150 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }
                }
            }
        }

        /**
         * Incohérences 152
         */
        $blIncoInd152 = 0;
        if ($questionCollectiviteConsolide->GetQ12() == true) {


            if ($bilanSocialConsolide->getInd152s() != null && $bilanSocialConsolide->getInd152s()->count() > 0) {
                // 1.5.2
                foreach ($bilanSocialConsolide->getInd152s() as $ind152) {
                    $total1 = 0;
                    $total2 = 0;
                    $total1 += ($ind152->getR1521() == null ? 0 : $ind152->getR1521());
                    $total1 += ($ind152->getR1522() == null ? 0 : $ind152->getR1522());
                    $total1 += ($ind152->getR1523() == null ? 0 : $ind152->getR1523());
                    $total1 += ($ind152->getR1524() == null ? 0 : $ind152->getR1524());
                    $total1 += ($ind152->getR1525() == null ? 0 : $ind152->getR1525());
                    $total1 += ($ind152->getR1526() == null ? 0 : $ind152->getR1526());
                    $total1 += ($ind152->getR1527() == null ? 0 : $ind152->getR1527());
                    $total1 += ($ind152->getR1528() == null ? 0 : $ind152->getR1528());
                    $total1 += ($ind152->getR1529() == null ? 0 : $ind152->getR1529());
                    $total1 += ($ind152->getR15210() == null ? 0 : $ind152->getR15210());
                    $total1 += ($ind152->getR15211() == null ? 0 : $ind152->getR15211());
                    $total1 += ($ind152->getR15212() == null ? 0 : $ind152->getR15212());
                    $total1 += ($ind152->getR15213() == null ? 0 : $ind152->getR15213());
                    $total1 += ($ind152->getR15214() == null ? 0 : $ind152->getR15214());
                    $total1 += ($ind152->getR15215() == null ? 0 : $ind152->getR15215());
                    $total1 += ($ind152->getR15216() == null ? 0 : $ind152->getR15216());
                    $total1 += ($ind152->getR15217() == null ? 0 : $ind152->getR15217());

                    $total2 += ($ind152->getR15218() == null ? 0 : $ind152->getR15218());
                    $total2 += ($ind152->getR15219() == null ? 0 : $ind152->getR15219());
                    $total2 += ($ind152->getR15220() == null ? 0 : $ind152->getR15220());
                    $total2 += ($ind152->getR15221() == null ? 0 : $ind152->getR15221());

                    //error_log('$total1 = ' . json_encode($total1), 0);

                    //error_log('$total2 = ' . json_encode($total2), 0);



                    if($total1 != $total2) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("152trCE_" . json_encode($ind152->getRefCadreEmploi()->getIdCadrempl()));
                        $incoherenceLog->setTableNum("1.5.2");
                        $incoherenceLog->setForm("2");
                        $incoherenceLog->setIdToggle1("toggle152");
                        $incoherenceLog->setIdToggle2("toggle152_" . json_encode($ind152->getRefCadreEmploi()->getRefFiliere()->getIdFili()));
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind152cadreemploi.consolide.incoherencelog', array('lbcadreemploi' => $ind152->getRefCadreEmploi()->getLbCadrempl())));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd152 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }
                }
            }
        }



        /**
         * Incohérences 154
         */
        $blIncoInd154 = 0;
        if ($questionCollectiviteConsolide->GetQ1() == true || $questionCollectiviteConsolide->GetQ3() == true) {
            $total154H = 0;
            $total154F = 0;
//            $total156H = 0;
//            $total156F = 0;
            foreach ($bilanSocialConsolide->getInd154s() as $ind154) {

                if ($ind154->getRefStageTitularisation()->getCdStagtitu() == "TS006") {

                    $total154H = $ind154->getR1541(0);
                    $total154F = $ind154->getR1542(0);

                    $total150H = 0;
                    $total150F = 0;
                    foreach ($bilanSocialConsolide->getInd1502s() as $ind1502) {
                        if($ind1502->getRefMotifDepart()->getCdMotidepa() == "MD018") {
                            $total150H += $ind1502->getR15021(0);
                            $total150H += $ind1502->getR15022(0);
                            $total150H += $ind1502->getR15023(0);
                            $total150H += $ind1502->getR15027(0);
                            $total150F += $ind1502->getR15024(0);
                            $total150F += $ind1502->getR15025(0);
                            $total150F += $ind1502->getR15026(0);
                            $total150F += $ind1502->getR15028(0);
                        }

                    }

                    //error_log('$total150 = ' . json_encode($total150),0);
                    //error_log('$total154 = ' . json_encode($total154),0);

                    if ($total154H != $total150H) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("154tr_" . json_encode($ind154->getRefStageTitularisation()->getIdStagtitu()));
                        $incoherenceLog->setTableNum("1.5.4");
                        $incoherenceLog->setIdToggle1("toggle154");
                        $incoherenceLog->setForm("2");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind154stagetituH.consolide.incoherencelog', array('lbstagetitu' => $ind154->getRefStageTitularisation()->getLbStagtitu())));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                        if ($total154H == 0 && $total150H > 0) {
                            // donnee manquante
                            $incoherenceLog->setBlIncoherence(false);
                            if ($blIncoInd154 != 2)
                                $blIncoInd154 = 1;
                        } else {
                            // incoherence
                            $incoherenceLog->setBlIncoherence(true);
                            $blIncoInd154 = 2;
                        }
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }
                    if ($total154F != $total150F) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("154tr_" . json_encode($ind154->getRefStageTitularisation()->getIdStagtitu()));
                        $incoherenceLog->setTableNum("1.5.4");
                        $incoherenceLog->setIdToggle1("toggle154");
                        $incoherenceLog->setForm("2");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind154stagetituF.consolide.incoherencelog', array('lbstagetitu' => $ind154->getRefStageTitularisation()->getLbStagtitu())));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                        if ($total154F == 0 && $total150F > 0) {
                            // donnee manquante
                            $incoherenceLog->setBlIncoherence(false);
                            if ($blIncoInd154 != 2)
                                $blIncoInd154 = 1;
                        } else {
                            // incoherence
                            $incoherenceLog->setBlIncoherence(true);
                            $blIncoInd154 = 2;
                        }
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }
                }
            }


//            foreach ($bilanSocialConsolide->getInd156s() as $ind156) {
//                $total156H += $ind156->getR1561(0);
//                $total156F += $ind156->getR1562(0);
//            }

//            if ($total156H > $total154H) {
//                $incoherenceLog = new IncoherenceLog();
//                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
//                $incoherenceLog->setField("total156");
//                $incoherenceLog->setTableNum("1.5.6");
//                $incoherenceLog->setIdToggle1("toggle154");
//                $incoherenceLog->setForm("2");
//                $incoherenceLog->setIdToggle2("");
//                $incoherenceLog->setMessage($this->get('translator')->trans('ind156H.ind154H'));
//                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
//                $incoherenceLog->setBlIncoherence(true);
//                $blIncoInd154 = 2;
//                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
//            }
//            if ($total156F > $total154F) {
//                $incoherenceLog = new IncoherenceLog();
//                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
//                $incoherenceLog->setField("total156");
//                $incoherenceLog->setTableNum("1.5.6");
//                $incoherenceLog->setIdToggle1("toggle154");
//                $incoherenceLog->setForm("2");
//                $incoherenceLog->setIdToggle2("");
//                $incoherenceLog->setMessage($this->get('translator')->trans('ind156F.ind154F'));
//                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
//                $incoherenceLog->setBlIncoherence(true);
//                $blIncoInd154 = 2;
//                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
//            }

        }


        /**
         * Incohérences 161
         */
        $blIncoInd161 = 0;
        if ($questionCollectiviteConsolide->getQ2() == true || $questionCollectiviteConsolide->getQ4() == true || $questionCollectiviteConsolide->getQ6() == true) {

            foreach ($bilanSocialConsolide->getInd161s() as $ind161) {
                $idCate = $ind161->getRefCategorie()->getIdCate();
                $lbGenr = "";

                $totalHFonc = $ind161->getR1611(0);
                $totalFFonc = $ind161->getR1612(0);
                $totalHCont = $ind161->getR1613(0);
                $totalFCont = $ind161->getR1614(0);

                $total111H = 0;
                $total111F = 0;
                $total121H = 0;
                $total121F = 0;


                foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                    $idCate111 = $ind111->getRefGrade()->getRefCadreEmploi()->getRefCategorie()->getIdCate();

                    if ($idCate == $idCate111) {
                        $total111H += $ind111->getR1115(0);
                        $total111F += $ind111->getR1116(0);
                    }
                }

                foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                    $idCate121 = $ind121->getRefCadreEmploi()->getRefCategorie()->getIdCate();

                    if ($idCate == $idCate121) {
                        $total121H += $ind121->getR12114(0) + $ind121->getR12115(0);
                        $total121F += $ind121->getR12116(0) + $ind121->getR12117(0);
                    }
                }

                if ($questionCollectiviteConsolide->getQ2() == true){
                    if ($totalHFonc > $total111H ) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("161idTr_" . json_encode($ind161->getRefCategorie()->getIdCate()));
                        $incoherenceLog->setTableNum("1.6.1");
                        $incoherenceLog->setIdToggle1("toggle161");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind161categorieH111.consolide.incoherencelog', array('lbcategorie' => $ind161->getRefCategorie()->getLbCate())));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setForm("2");
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd161 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }

                    if ($totalFFonc > $total111F ) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("161idTr_" . json_encode($ind161->getRefCategorie()->getIdCate()));
                        $incoherenceLog->setTableNum("1.6.1");
                        $incoherenceLog->setIdToggle1("toggle161");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind161categorieF111.consolide.incoherencelog', array('lbcategorie' => $ind161->getRefCategorie()->getLbCate())));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setForm("2");
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd161 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }
                }

                if ($questionCollectiviteConsolide->getQ4() == true){
                    if ($totalHCont > $total121H ) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("161idTr_" . json_encode($ind161->getRefCategorie()->getIdCate()));
                        $incoherenceLog->setTableNum("1.6.1");
                        $incoherenceLog->setIdToggle1("toggle161");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind161categorieH121.consolide.incoherencelog', array('lbcategorie' => $ind161->getRefCategorie()->getLbCate())));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setForm("2");
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd161 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }

                    if ($totalFCont > $total121F ) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("161idTr_" . json_encode($ind161->getRefCategorie()->getIdCate()));
                        $incoherenceLog->setTableNum("1.6.1");
                        $incoherenceLog->setIdToggle1("toggle161");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind161categorieF121.consolide.incoherencelog', array('lbcategorie' => $ind161->getRefCategorie()->getLbCate())));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setForm("2");
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd161 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }
                }
            }

            if ($questionCollectiviteConsolide->getQ6() == true){
                foreach ($bilanSocialConsolide->getInd1612s() as $ind1612) {
                    $totalH = $ind1612->getR16121(0);
                    $totalF = $ind1612->getR16122(0);

                    $total131H = 0;
                    $total131F = 0;

                    foreach ($bilanSocialConsolide->getInd1311s() as $ind131) {
                        $total131H += $ind131->getR13111(0);
                        $total131F += $ind131->getR13112(0);
                    }

                    if ($totalH > $total131H ) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("1612idTr");
                        $incoherenceLog->setTableNum("1.6.1.2");
                        $incoherenceLog->setIdToggle1("toggle161");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind1612H131.consolide.incoherencelog'));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setForm("2");
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd161 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }

                    if ($totalF > $total131F ) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("1612idTr");
                        $incoherenceLog->setTableNum("1.6.1.2");
                        $incoherenceLog->setIdToggle1("toggle161");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind1612F131.consolide.incoherencelog'));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setForm("2");
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd161 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }


                }
            }
        }

        /**
         * Incohérences 171
         */
        $blIncoInd171 = 0;
        if ($questionCollectiviteConsolide->getQ2() == true || $questionCollectiviteConsolide->getQ4() == true || $questionCollectiviteConsolide->getQ6() == true) {

            $total1711H = 0;
            $total1712H = 0;
            $total1713H = 0;
            $total1711F = 0;
            $total1712F = 0;
            $total1713F = 0;

            foreach ($bilanSocialConsolide->getInd171s() as $ind171) {
                if($ind171->getFgGenr() == "H") {
                    $total1711H += $ind171->getR1711(0);
                    $total1712H += $ind171->getR1712(0);
                    $total1713H += $ind171->getR1713(0);
                }
                if($ind171->getFgGenr() == "F") {
                    $total1711F += $ind171->getR1711(0);
                    $total1712F += $ind171->getR1712(0);
                    $total1713F += $ind171->getR1713(0);
                }
            }

            $total111H = 0;
            $total111F = 0;
            foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                $total111H += $ind111->getR1115(0);
                $total111F += $ind111->getR1116(0);
            }

            $total121H = 0;
            $total121F = 0;
            foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                $total121H += $ind121->getR12114(0) + $ind121->getR12115(0);
                $total121F += $ind121->getR12116(0) + $ind121->getR12117(0);
            }
            $total131H = 0;
            $total131F = 0;
            foreach ($bilanSocialConsolide->getInd1311s() as $ind131) {
                $total131H += $ind131->getR13111(0);
                $total131F += $ind131->getR13112(0);
            }

            if ($questionCollectiviteConsolide->getQ2() == true ) {
                if ($total1711H != $total111H) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totGenr_H");
                    $incoherenceLog->setTableNum("1.7.1");
                    $incoherenceLog->setIdToggle1("toggle171");
                    $incoherenceLog->setForm("2");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1711H.consolide.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total1711H == 0 && $total111H > 0) {
                        // donnee manquante
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd171 != 2)
                            $blIncoInd171 = 1;
                    } else {
                        // incoherence
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd171 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
                if ($total1711F != $total111F) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totGenr_F");
                    $incoherenceLog->setTableNum("1.7.1");
                    $incoherenceLog->setIdToggle1("toggle171");
                    $incoherenceLog->setForm("2");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1711F.consolide.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total1711F == 0 && $total111F > 0) {
                        // donnee manquante
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd171 != 2)
                            $blIncoInd171 = 1;
                    } else {
                        // incoherence
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd171 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
            if ($questionCollectiviteConsolide->getQ4() == true ) {
                if ($total1712H != $total121H) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totGenr_H");
                    $incoherenceLog->setTableNum("1.7.1");
                    $incoherenceLog->setIdToggle1("toggle171");
                    $incoherenceLog->setForm("2");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1712H.consolide.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total1712H == 0 && $total121H > 0) {
                        // donnee manquante
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd171 != 2)
                            $blIncoInd171 = 1;
                    } else {
                        // incoherence
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd171 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
                if ($total1712F != $total121F) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totGenr_F");
                    $incoherenceLog->setTableNum("1.7.1");
                    $incoherenceLog->setIdToggle1("toggle171");
                    $incoherenceLog->setForm("2");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1712F.consolide.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total1712F == 0 && $total121F > 0) {
                        // donnee manquante
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd171 != 2)
                            $blIncoInd171 = 1;
                    } else {
                        // incoherence
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd171 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
            if ($questionCollectiviteConsolide->getQ6() == true) {
                if ($total1713H != $total131H) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totGenr_H");
                    $incoherenceLog->setTableNum("1.7.1");
                    $incoherenceLog->setIdToggle1("toggle171");
                    $incoherenceLog->setForm("2");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1713H.consolide.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total1713H == 0 && $total131H > 0) {
                        // donnee manquante
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd171 != 2)
                            $blIncoInd171 = 1;
                    } else {
                        // incoherence
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd171 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
                if ($total1713F != $total131F) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totGenr_F");
                    $incoherenceLog->setTableNum("1.7.1");
                    $incoherenceLog->setIdToggle1("toggle171");
                    $incoherenceLog->setForm("2");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind1713F.consolide.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total1713F == 0 && $total131F > 0) {
                        // donnee manquante
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd171 != 2)
                            $blIncoInd171 = 1;
                    } else {
                        // incoherence
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd171 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }

        }

        $blIncoMouv150 = 0;
        if ($bilanSocialConsolide->getInd1501s()->Count() == 0) {
            //pas de donnees
            $bilanSocialConsolide->setBlIncoInd150(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd150(0);
            $blIncoMouv150 = 1;
        }
        else if ($blIncoInd150 == 2) {
            //au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd150(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd150(50);
            $blIncoMouv150 = 3;
        }
        else {
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd150(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd150(100);
            $blIncoMouv150 = 4;
        }


        $blIncoMouv152 = 0;
        if ($bilanSocialConsolide->getInd152s()->Count() == 0) {
            //pas de donnees
            $bilanSocialConsolide->setBlIncoInd152(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd152(0);
            $blIncoMouv152 = 1;
        }
        else if ($blIncoInd152 == 2) {
            //au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd152(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd152(50);
            $blIncoMouv152 = 3;
        }
        else {
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd152(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd152(100);
            $blIncoMouv152 = 4;
        }


        $blIncoMouv154 = 0;
        if ($bilanSocialConsolide->getInd154s()->Count() == 0) {
            // pas d enregistrement => etat = 1
            $bilanSocialConsolide->setBlIncoInd154(1);
            $bilanSocialConsolide->setMoyenneInd154(0);
            $blIncoMouv154 = 1;
        }
        else if ($blIncoInd154 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd154(2);
            $bilanSocialConsolide->setMoyenneInd154(50);
            $blIncoMouv154 = 2;
        }
        else if ($blIncoInd154 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd154(3);
            $bilanSocialConsolide->setMoyenneInd154(50);
            $blIncoMouv154 = 3;
        }
        else {
            // des donnees mais aucun enregistrement dans incoh log
            $bilanSocialConsolide->setBlIncoInd154(4);
            $bilanSocialConsolide->setMoyenneInd154(100);
            $blIncoMouv154 = 4;
        }



        $blIncoMouv161 = 0;
        if ($bilanSocialConsolide->getInd161s()->Count() == 0) {
            //pas de donnees
            $bilanSocialConsolide->setBlIncoInd161(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd161(0);
            $blIncoMouv161 = 1;
        }
        else if ($blIncoInd161 == 2) {
            //au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd161(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd161(50);
            $blIncoMouv161 = 3;
        }
        else {
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd161(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd161(100);
            $blIncoMouv161 = 4;
        }

        $blIncoMouv171 = 0;
        if ($bilanSocialConsolide->getInd171s()->Count() == 0) {
            //pas de donnees
            $bilanSocialConsolide->setBlIncoInd171(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd171(0);
            $blIncoMouv171 = 1;
        }
        else if ($blIncoInd171 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd171(2);
            $bilanSocialConsolide->setMoyenneInd171(50);
            $blIncoMouv171 = 2;
        }
        else if ($blIncoInd171 == 2) {
            //au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd171(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd171(50);
            $blIncoMouv171 = 3;
        }
        else {
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd171(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd171(100);
            $blIncoMouv171 = 4;
        }

        $blIncoMouv = 0;
        if ($blIncoMouv150 == 3 || $blIncoMouv152 == 3 || $blIncoMouv154 == 3 || $blIncoMouv161 == 3 || $blIncoMouv171 == 3) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoMouv = 3;
        }
        elseif ($blIncoMouv150 == 2 || $blIncoMouv152 == 2 || $blIncoMouv154 == 2 || $blIncoMouv161 == 2 || $blIncoMouv171 == 2) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoMouv = 2;
        }
        elseif ($blIncoMouv150 == 1 && $blIncoMouv152 == 1 && $blIncoMouv154 == 1 && $blIncoMouv161 == 1 && $blIncoMouv171 == 1) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoMouv = 1;
        }
        elseif ($blIncoMouv150 == 4 && $blIncoMouv152 == 4  && $blIncoMouv154 == 4 && $blIncoMouv161 == 4 && $blIncoMouv171 == 4) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoMouv = 4;
        }
        $bilanSocialConsolide->setBlIncoMouv($blIncoMouv);
    }

    protected function UpdateIncoherenceTpsTravailLog($bilanSocialConsolide, $questionCollectiviteConsolide) {

        /**
         * Incohérences 211
         */
        $blIncoInd211 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true) {
            // Test 2111
            foreach ($bilanSocialConsolide->getInd2111s() as $ind2111) {
                if($ind2111->getRefMotifAbsence()->getCdMotiabse() == "ABS008") continue;

                $total1 = $ind2111->getR21111(0);
                $total2 = $ind2111->getR21112(0);
                $total3 = $ind2111->getR21113(0);
                $total4 = $ind2111->getR21114(0);
                $total5 = $ind2111->getR21115(0);
                $total6 = $ind2111->getR21116(0);

                $message = "";
                if ($total3 < $total1) {
                    $message = $this->get('translator')->trans('ind2111motifabsencenbjourneehomme.consolide.incoherencelog', array('lbmotiabse' => $ind2111->getRefMotifAbsence()->getLbMotiabse()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2111idMa_" . json_encode($ind2111->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.1");
                    $incoherenceLog->setIdToggle1("toggle211");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd211 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $message = "";
                if ($total5 > $total3) {
                    $message = $this->get('translator')->trans('ind2111motifabsencenbjourneesuparrethomme.consolide.incoherencelog', array('lbmotiabse' => $ind2111->getRefMotifAbsence()->getLbMotiabse()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2111idMa_" . json_encode($ind2111->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.1");
                    $incoherenceLog->setIdToggle1("toggle211");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd211 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $message = "";
                if ($total4 < $total2) {
                    $message = $this->get('translator')->trans('ind2111motifabsencenbjourneefemme.consolide.incoherencelog', array('lbmotiabse' => $ind2111->getRefMotifAbsence()->getLbMotiabse()));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2111idMa_" . json_encode($ind2111->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.1");
                    $incoherenceLog->setIdToggle1("toggle211");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd211 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $message = "";
                if ($total6 > $total4) {
                    $message = $this->get('translator')->trans('ind2111motifabsencenbjourneesuparretfemme.consolide.incoherencelog', array('lbmotiabse' => $ind2111->getRefMotifAbsence()->getLbMotiabse()));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2111idMa_" . json_encode($ind2111->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.1");
                    $incoherenceLog->setIdToggle1("toggle211");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd211 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }

            // Test 2112
            foreach ($bilanSocialConsolide->getInd2112s() as $ind2112) {
                $idMa2 = $ind2112->getRefMotifAbsence()->getIdMotiabse();
                if($ind2112->getRefMotifAbsence()->getCdMotiabse() == "ABS008") continue;


                //error_log('idMa2 ' . $idMa2);

                $total1 = ($ind2112->getR21121() != null ? $ind2112->getR21121() : 0);
                $total2 = ($ind2112->getR21122() != null ? $ind2112->getR21122() : 0);
                $total3 = ($ind2112->getR21123() != null ? $ind2112->getR21123() : 0);
                $total4 = ($ind2112->getR21124() != null ? $ind2112->getR21124() : 0);
                $total5 = ($ind2112->getR21125() != null ? $ind2112->getR21125() : 0);
                $total6 = ($ind2112->getR21126() != null ? $ind2112->getR21126() : 0);
                $total7 = ($ind2112->getR21127() != null ? $ind2112->getR21127() : 0);
                $total8 = ($ind2112->getR21128() != null ? $ind2112->getR21128() : 0);
                $total9 = ($ind2112->getR21129() != null ? $ind2112->getR21129() : 0);
                $total10 = ($ind2112->getR211210() != null ? $ind2112->getR211210() : 0);
                $total_2112 = $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10;

                $total_2111 = 0;
                foreach ($bilanSocialConsolide->getInd2111s() as $ind2111) {
                    if($ind2111->getRefMotifAbsence()->getCdMotiabse() == "ABS008") continue;
                    $idMa1 = $ind2111->getRefMotifAbsence()->getIdMotiabse();
                    if ($idMa2 == $idMa1) {
                        $total11 = ($ind2111->getR21111() != null ? $ind2111->getR21111() : 0);
                        $total12 = ($ind2111->getR21112() != null ? $ind2111->getR21112() : 0);
                        $total_2111 = $total11 + $total12;
                        break;
                    }
                }

                $message = "";

                //error_log('total_2111 ' . $total_2111);
                //error_log('total_2112 ' . $total_2112);

                if ($total_2112 != $total_2111) {
                    $message = $this->get('translator')->trans('ind2112motifabsencenbfonctionnaire.consolide.incoherencelog', array('lbmotiabse' => $ind2112->getRefMotifAbsence()->getLbMotiabse()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2112idMa_" . json_encode($ind2112->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.1");
                    $incoherenceLog->setIdToggle1("toggle211");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2112 == 0 && $total_2111 > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd211 != 2)
                            $blIncoInd211 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd211 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }

            // Test 2113
            foreach ($bilanSocialConsolide->getInd2113s() as $ind2113) {
                $idMa3 = $ind2113->getRefMotifAbsence()->getIdMotiabse();
                if($ind2113->getRefMotifAbsence()->getCdMotiabse() == "ABS008") continue;

                $total1 = ($ind2113->getR21131() != null ? $ind2113->getR21131() : 0);
                $total2 = ($ind2113->getR21132() != null ? $ind2113->getR21132() : 0);
                $total3 = ($ind2113->getR21133() != null ? $ind2113->getR21133() : 0);
                $total4 = ($ind2113->getR21134() != null ? $ind2113->getR21134() : 0);
                $total5 = ($ind2113->getR21135() != null ? $ind2113->getR21135() : 0);
                $total6 = ($ind2113->getR21136() != null ? $ind2113->getR21136() : 0);
                $total7 = ($ind2113->getR21137() != null ? $ind2113->getR21137() : 0);
                $total8 = ($ind2113->getR21138() != null ? $ind2113->getR21138() : 0);
                $total9 = ($ind2113->getR21139() != null ? $ind2113->getR21139() : 0);
                $total10 = ($ind2113->getR211310() != null ? $ind2113->getR211310() : 0);
                $total_2113 = $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10;

                $total_2111 = 0;
                foreach ($bilanSocialConsolide->getInd2111s() as $ind2111) {
                    $idMa1 = $ind2111->getRefMotifAbsence()->getIdMotiabse();
                    if ($idMa3 == $idMa1) {
                        $total11 = ($ind2111->getR21113() != null ? $ind2111->getR21113() : 0);
                        $total12 = ($ind2111->getR21114() != null ? $ind2111->getR21114() : 0);
                        $total_2111 = $total11 + $total12;
                        break;
                    }
                }

                $message = "";
                if ($total_2113 != $total_2111) {
                    $message = $this->get('translator')->trans('ind2113motifabsencenbjournee2111.consolide.incoherencelog', array('lbmotiabse' => $ind2113->getRefMotifAbsence()->getLbMotiabse()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2113idMa_" . json_encode($ind2113->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.1");
                    $incoherenceLog->setIdToggle1("toggle211");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2113 == 0 && $total_2111 > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd211 != 2)
                            $blIncoInd211 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd211 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }
        }


        /**
         * Incohérences 212
         */
        $blIncoInd212 = 0;
        if ($questionCollectiviteConsolide->getQ3() == true) {
            // Test 2121
            foreach ($bilanSocialConsolide->getInd2121s() as $ind2121) {
                $total1 = ($ind2121->getR21211() != null ? $ind2121->getR21211() : 0);
                $total2 = ($ind2121->getR21212() != null ? $ind2121->getR21212() : 0);
                $total3 = ($ind2121->getR21213() != null ? $ind2121->getR21213() : 0);
                $total4 = ($ind2121->getR21214() != null ? $ind2121->getR21214() : 0);
                $total5 = ($ind2121->getR21215() != null ? $ind2121->getR21215() : 0);
                $total6 = ($ind2121->getR21216() != null ? $ind2121->getR21216() : 0);

                if($ind2121->getRefMotifAbsence()->getCdMotiabse() == "ABS008") continue;

                $message = "";
                if ($total3 < $total1) {
                    $message = $this->get('translator')->trans('ind2121motifabsencenbabsencehommesupemplpermhomme.consolide.incoherencelog', array('lbmotiabse' => $ind2121->getRefMotifAbsence()->getLbMotiabse()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2121idMa_" . json_encode($ind2121->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.2");
                    $incoherenceLog->setIdToggle1("toggle212");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd212 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $message = "";

                if ($total5 > $total3) {
                    $message = $this->get('translator')->trans('ind2121motifabsencenbjourneesuparrethomme.consolide.incoherencelog', array('lbmotiabse' => $ind2121->getRefMotifAbsence()->getLbMotiabse()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2121idMa_" . json_encode($ind2121->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.2");
                    $incoherenceLog->setIdToggle1("toggle212");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd212 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $message = "";
                if ($total4 < $total2) {
                    $message = $this->get('translator')->trans('ind2121motifabsencenbabsencefemmesupemplpermfemme.consolide.incoherencelog', array('lbmotiabse' => $ind2121->getRefMotifAbsence()->getLbMotiabse()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2121idMa_" . json_encode($ind2121->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.2");
                    $incoherenceLog->setIdToggle1("toggle212");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd212 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $message = "";
                if ($total6 > $total4) {
                    //$message = "2.1.2.1 : Motif absence " . $ind2121->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Femmes doit être supérieur au nombre d'arrêts Femmes";
                    $message = $this->get('translator')->trans('ind2121motifabsencenbjourneesuparretfemme.consolide.incoherencelog', array('lbmotiabse' => $ind2121->getRefMotifAbsence()->getLbMotiabse()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2121idMa_" . json_encode($ind2121->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.2");
                    $incoherenceLog->setIdToggle1("toggle212");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd212 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }

            // Test 2122
            foreach ($bilanSocialConsolide->getInd2122s() as $ind2122) {
                $idMa2 = $ind2122->getRefMotifAbsence()->getIdMotiabse();
                if($ind2122->getRefMotifAbsence()->getCdMotiabse() == "ABS008") continue;

                $total1 = ($ind2122->getR21221() != null ? $ind2122->getR21221() : 0);
                $total2 = ($ind2122->getR21222() != null ? $ind2122->getR21222() : 0);
                $total3 = ($ind2122->getR21223() != null ? $ind2122->getR21223() : 0);
                $total4 = ($ind2122->getR21224() != null ? $ind2122->getR21224() : 0);
                $total5 = ($ind2122->getR21225() != null ? $ind2122->getR21225() : 0);
                $total6 = ($ind2122->getR21226() != null ? $ind2122->getR21226() : 0);
                $total7 = ($ind2122->getR21227() != null ? $ind2122->getR21227() : 0);
                $total8 = ($ind2122->getR21228() != null ? $ind2122->getR21228() : 0);
                $total9 = ($ind2122->getR21229() != null ? $ind2122->getR21229() : 0);
                $total10 = ($ind2122->getR212210() != null ? $ind2122->getR212210() : 0);
                $total_2122 = $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10;

                $total_2121 = 0;
                foreach ($bilanSocialConsolide->getInd2121s() as $ind2121) {
                    $idMa1 = $ind2121->getRefMotifAbsence()->getIdMotiabse();
                    if ($idMa2 == $idMa1) {
                        $total11 = ($ind2121->getR21211() != null ? $ind2121->getR21211() : 0);
                        $total12 = ($ind2121->getR21212() != null ? $ind2121->getR21212() : 0);
                        $total_2121 = $total11 + $total12;
                        break;
                    }
                }

                $message = "";
                if ($total_2122 != $total_2121) {
                    $message = $this->get('translator')->trans('ind2122nbemploipermanent2121.consolide.incoherencelog', array('lbmotiabse' => $ind2122->getRefMotifAbsence()->getLbMotiabse()));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2122idMa_" . json_encode($ind2122->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.2");
                    $incoherenceLog->setIdToggle1("toggle212");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2122 == 0 && $total_2121 > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd212 != 2)
                            $blIncoInd212 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd212 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }

            // Test 2123
            foreach ($bilanSocialConsolide->getInd2123s() as $ind2123) {
                $idMa3 = $ind2123->getRefMotifAbsence()->getIdMotiabse();
                if($ind2123->getRefMotifAbsence()->getCdMotiabse() == "ABS008") continue;

                $total1 = ($ind2123->getR21231() != null ? $ind2123->getR21231() : 0);
                $total2 = ($ind2123->getR21232() != null ? $ind2123->getR21232() : 0);
                $total3 = ($ind2123->getR21233() != null ? $ind2123->getR21233() : 0);
                $total4 = ($ind2123->getR21234() != null ? $ind2123->getR21234() : 0);
                $total5 = ($ind2123->getR21235() != null ? $ind2123->getR21235() : 0);
                $total6 = ($ind2123->getR21236() != null ? $ind2123->getR21236() : 0);
                $total7 = ($ind2123->getR21237() != null ? $ind2123->getR21237() : 0);
                $total8 = ($ind2123->getR21238() != null ? $ind2123->getR21238() : 0);
                $total9 = ($ind2123->getR21239() != null ? $ind2123->getR21239() : 0);
                $total10 = ($ind2123->getR212310() != null ? $ind2123->getR212310() : 0);
                $total_2123 = $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10;

                $total_2121 = 0;
                foreach ($bilanSocialConsolide->getInd2121s() as $ind2121) {
                    $idMa1 = $ind2121->getRefMotifAbsence()->getIdMotiabse();
                    if ($idMa3 == $idMa1) {
                        $total11 = ($ind2121->getR21213() != null ? $ind2121->getR21213() : 0);
                        $total12 = ($ind2121->getR21214() != null ? $ind2121->getR21214() : 0);
                        $total_2121 = $total11 + $total12;
                        break;
                    }
                }

                $message = "";
                if ($total_2123 != $total_2121) {
                    $message = $this->get('translator')->trans('ind2123nbemploipermanent2121.consolide.incoherencelog', array('lbmotiabse' => $ind2123->getRefMotifAbsence()->getLbMotiabse()));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2123idMa_" . json_encode($ind2123->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.2");
                    $incoherenceLog->setIdToggle1("toggle212");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2123 == 0 && $total_2121 > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd212 != 2)
                            $blIncoInd212 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd212 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }
        }

        /**
         * Incohérences 213
         */
        $blIncoInd213 = 0;
        if ($questionCollectiviteConsolide->getQ5() == true) {
            // Test 2131
            foreach ($bilanSocialConsolide->getInd2131s() as $ind2131) {
                $total1 = ($ind2131->getR21311() != null ? $ind2131->getR21311() : 0);
                $total2 = ($ind2131->getR21312() != null ? $ind2131->getR21312() : 0);
                $total3 = ($ind2131->getR21313() != null ? $ind2131->getR21313() : 0);
                $total4 = ($ind2131->getR21314() != null ? $ind2131->getR21314() : 0);
                $total5 = ($ind2131->getR21315() != null ? $ind2131->getR21315() : 0);
                $total6 = ($ind2131->getR21316() != null ? $ind2131->getR21316() : 0);

                if($ind2131->getRefMotifAbsence()->getCdMotiabse() == "ABS008") continue;

                $message = "";
                if ($total3 < $total1) {
                    $message = $this->get('translator')->trans('ind2131motifabsencenbabsencehommesupemplnonpermhomme.consolide.incoherencelog', array('lbmotiabse' => $ind2131->getRefMotifAbsence()->getLbMotiabse()));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2131idMa_" . json_encode($ind2131->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.3");
                    $incoherenceLog->setIdToggle1("toggle213");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd213 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $message = "";
                if ($total5 > $total3) {
                    $message = $this->get('translator')->trans('ind2131motifabsencenbjourneesuparrethomme.consolide.incoherencelog', array('lbmotiabse' => $ind2131->getRefMotifAbsence()->getLbMotiabse()));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2131idMa_" . json_encode($ind2131->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.3");
                    $incoherenceLog->setIdToggle1("toggle213");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd213 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $message = "";
                if ($total4 < $total2) {
                    $message = $this->get('translator')->trans('ind2131motifabsencenbabsencefemmesupemplnonpermfemme.consolide.incoherencelog', array('lbmotiabse' => $ind2131->getRefMotifAbsence()->getLbMotiabse()));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2131idMa_" . json_encode($ind2131->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.3");
                    $incoherenceLog->setIdToggle1("toggle213");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd213 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $message = "";
                if ($total6 > $total4) {
                    $message = $this->get('translator')->trans('ind2131motifabsencenbjourneesuparretfemme.consolide.incoherencelog', array('lbmotiabse' => $ind2131->getRefMotifAbsence()->getLbMotiabse()));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2131idMa_" . json_encode($ind2131->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.3");
                    $incoherenceLog->setIdToggle1("toggle213");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd213 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }

            // Test 2132
            foreach ($bilanSocialConsolide->getInd2132s() as $ind2132) {
                $idMa2 = $ind2132->getRefMotifAbsence()->getIdMotiabse();
                 if($ind2132->getRefMotifAbsence()->getCdMotiabse() == "ABS008") continue;

                $total1 = ($ind2132->getR21321() != null ? $ind2132->getR21321() : 0);
                $total2 = ($ind2132->getR21322() != null ? $ind2132->getR21322() : 0);
                $total3 = ($ind2132->getR21323() != null ? $ind2132->getR21323() : 0);
                $total4 = ($ind2132->getR21324() != null ? $ind2132->getR21324() : 0);
                $total5 = ($ind2132->getR21325() != null ? $ind2132->getR21325() : 0);
                $total6 = ($ind2132->getR21326() != null ? $ind2132->getR21326() : 0);
                $total7 = ($ind2132->getR21327() != null ? $ind2132->getR21327() : 0);
                $total8 = ($ind2132->getR21328() != null ? $ind2132->getR21328() : 0);
                $total9 = ($ind2132->getR21329() != null ? $ind2132->getR21329() : 0);
                $total10 = ($ind2132->getR213210() != null ? $ind2132->getR213210() : 0);
                $total_2132 = $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10;

                $total_2131 = 0;
                foreach ($bilanSocialConsolide->getInd2131s() as $ind2131) {
                    $idMa1 = $ind2131->getRefMotifAbsence()->getIdMotiabse();
                    if ($idMa2 == $idMa1) {
                        $total11 = ($ind2131->getR21311() != null ? $ind2131->getR21311() : 0);
                        $total12 = ($ind2131->getR21312() != null ? $ind2131->getR21312() : 0);
                        $total_2131 = $total11 + $total12;
                        break;
                    }
                }


                $message = "";
                if ($total_2132 != $total_2131) {
                    $message = $this->get('translator')->trans('ind2132motifabsencenbfonctionnaire2131', array('lbmotiabse' => $ind2132->getRefMotifAbsence()->getLbMotiabse()));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2132idMa_" . json_encode($ind2132->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.3");
                    $incoherenceLog->setIdToggle1("toggle213");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2132 == 0 && $total_2131 > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd213 != 2)
                            $blIncoInd213 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd213 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }


            }

            // Test 2133
            foreach ($bilanSocialConsolide->getInd2133s() as $ind2133) {
                $idMa3 = $ind2133->getRefMotifAbsence()->getIdMotiabse();
                if($ind2133->getRefMotifAbsence()->getCdMotiabse() == "ABS008") continue;

                $total1 = ($ind2133->getR21331() != null ? $ind2133->getR21331() : 0);
                $total2 = ($ind2133->getR21332() != null ? $ind2133->getR21332() : 0);
                $total3 = ($ind2133->getR21333() != null ? $ind2133->getR21333() : 0);
                $total4 = ($ind2133->getR21334() != null ? $ind2133->getR21334() : 0);
                $total5 = ($ind2133->getR21335() != null ? $ind2133->getR21335() : 0);
                $total6 = ($ind2133->getR21336() != null ? $ind2133->getR21336() : 0);
                $total7 = ($ind2133->getR21337() != null ? $ind2133->getR21337() : 0);
                $total8 = ($ind2133->getR21338() != null ? $ind2133->getR21338() : 0);
                $total9 = ($ind2133->getR21339() != null ? $ind2133->getR21339() : 0);
                $total10 = ($ind2133->getR213310() != null ? $ind2133->getR213310() : 0);
                $total_2133 = $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10;

                $total_2131 = 0;
                foreach ($bilanSocialConsolide->getInd2131s() as $ind2131) {
                    $idMa1 = $ind2131->getRefMotifAbsence()->getIdMotiabse();
                    if ($idMa3 == $idMa1) {
                        $total11 = ($ind2131->getR21313() != null ? $ind2131->getR21313() : 0);
                        $total12 = ($ind2131->getR21314() != null ? $ind2131->getR21314() : 0);
                        $total_2131 = $total11 + $total12;
                        break;
                    }
                }

                $message = "";
                if ($total_2133 != $total_2131) {
                    $message = $this->get('translator')->trans('ind2133motifabsencenbcontractuel2131', array('lbmotiabse' => $ind2133->getRefMotifAbsence()->getLbMotiabse()));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2133idMa_" . json_encode($ind2133->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.3");
                    $incoherenceLog->setIdToggle1("toggle213");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2133 == 0 && $total_2131 > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd213 != 2)
                            $blIncoInd213 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd213 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }
        }



        /**
         * Incohérences 214
         */
        $blIncoInd214 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true || $questionCollectiviteConsolide->getQ3() == true) {
            $total2141 = 0;
            $total2142 = 0;
            $idCatefirst = 0;

            foreach ($bilanSocialConsolide->getInd214s() as $ind214) {
                if ($idCatefirst == 0)
                    $idCatefirst = $ind214->getRefCategorie()->getIdCate();
                $total2141 += ($ind214->getR2141() == null ? 0 : $ind214->getR2141());
                $total2142 += ($ind214->getR2142() == null ? 0 : $ind214->getR2142());
            }

            $total21X1 = 0;
            $total21X2 = 0;

            $codeMotiAbseParternite = "ABS007";

            foreach ($bilanSocialConsolide->getInd2111s() as $ind2111) {
                $cdMaParternite = $ind2111->getRefMotifAbsence()->getCdMotiabse();
                if ($cdMaParternite == $codeMotiAbseParternite) {
                    $total21X1 += ($ind2111->getR21111() != null ? $ind2111->getR21111() : 0);
                    $total21X1 += ($ind2111->getR21112() != null ? $ind2111->getR21112() : 0);
                    $total21X2 += ($ind2111->getR21113() != null ? $ind2111->getR21113() : 0);
                    $total21X2 += ($ind2111->getR21114() != null ? $ind2111->getR21114() : 0);
                    break;
                }
            }

            foreach ($bilanSocialConsolide->getInd2121s() as $ind2121) {
                $cdMaParternite = $ind2121->getRefMotifAbsence()->getCdMotiabse();
                if ($cdMaParternite == $codeMotiAbseParternite) {
                    $total21X1 += ($ind2121->getR21211() != null ? $ind2121->getR21211() : 0);
                    $total21X1 += ($ind2121->getR21212() != null ? $ind2121->getR21212() : 0);
                    $total21X2 += ($ind2121->getR21213() != null ? $ind2121->getR21213() : 0);
                    $total21X2 += ($ind2121->getR21214() != null ? $ind2121->getR21214() : 0);
                    break;
                }
            }

            foreach ($bilanSocialConsolide->getInd2131s() as $ind2131) {
                $cdMaParternite = $ind2131->getRefMotifAbsence()->getCdMotiabse();
                if ($cdMaParternite == $codeMotiAbseParternite) {
                    $total21X1 += ($ind2131->getR21311() != null ? $ind2131->getR21311() : 0);
                    $total21X1 += ($ind2131->getR21312() != null ? $ind2131->getR21312() : 0);
                    $total21X2 += ($ind2131->getR21313() != null ? $ind2131->getR21313() : 0);
                    $total21X2 += ($ind2131->getR21314() != null ? $ind2131->getR21314() : 0);
                    break;
                }
            }

            if ($total2141 != $total21X1) {
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("nbAgents");
                $incoherenceLog->setTableNum("2.1.4");
                $incoherenceLog->setIdToggle1("toggle214");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($this->get('translator')->trans('ind214erreurtotalpaternite'));
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setForm("3");

                if ($total2141 == 0 && $total21X1 > 0) {
                    $incoherenceLog->setBlIncoherence(false);
                    if ($blIncoInd214 != 2)
                        $blIncoInd214 = 1;
                } else {
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd214 = 2;
                }
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

            if ($total2142 != $total21X2) {
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("nmTotJourAbs");
                $incoherenceLog->setTableNum("2.1.4");
                $incoherenceLog->setIdToggle1("toggle214");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($this->get('translator')->trans('ind214erreurtotalsommepaternite'));
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setForm("3");

                if ($total2142 == 0 && $total21X2 > 0) {
                    $incoherenceLog->setBlIncoherence(false);
                    if ($blIncoInd214 != 2)
                        $blIncoInd214 = 1;
                } else {
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd214 = 2;
                }
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }
        }


         /**
         * Incohérences 221
         */
        $blIncoInd221 = 0;
        if ($questionCollectiviteConsolide->getQ2() == true || $questionCollectiviteConsolide->getQ4() == true) {
            $total221H = 0;
            $total221F = 0;
            $totalH = 0;
            $totalF = 0;

            foreach ($bilanSocialConsolide->getInd221s() as $ind221) {
                $total221H += $ind221->getR2211(0);
                $total221F += $ind221->getR2212(0);
            }

            foreach ($bilanSocialConsolide->getInd112s() as $ind112) {
                $totalH += $ind112->getR1121(0) + $ind112->getR1123(0) + $ind112->getR1125(0) + $ind112->getR1127(0);
                $totalF += $ind112->getR1122(0) + $ind112->getR1124(0) + $ind112->getR1126(0) + $ind112->getR1128(0);
            }
            foreach ($bilanSocialConsolide->getInd122s() as $ind122) {
                $totalH += $ind122->getR1221(0) + $ind122->getR1223(0) + $ind122->getR1225(0) + $ind122->getR1227(0);
                $totalF += $ind122->getR1222(0) + $ind122->getR1224(0) + $ind122->getR1226(0) + $ind122->getR1228(0);
            }

            if ($total221H != $totalH) {
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("totalGlo");
                $incoherenceLog->setTableNum("2.2.1");
                $incoherenceLog->setIdToggle1("toggle221");
                $incoherenceLog->setForm("3");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($this->get('translator')->trans('ind221cadreemploiH.consolide.incoherencelog'));
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                if ($total221H == 0 && $totalH > 0) {
                    // donnee manquante
                    $incoherenceLog->setBlIncoherence(false);
                    if ($blIncoInd221 != 2)
                        $blIncoInd221 = 1;
                } else {
                    // incoherence
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd221 = 2;
                }
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

            if ($total221F != $totalF) {
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("totalGlo");
                $incoherenceLog->setTableNum("2.2.1");
                $incoherenceLog->setIdToggle1("toggle221");
                $incoherenceLog->setForm("3");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($this->get('translator')->trans('ind221cadreemploiF.consolide.incoherencelog'));
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                if ($total221F == 0 && $totalF > 0) {
                    // donnee manquante
                    $incoherenceLog->setBlIncoherence(false);
                    if ($blIncoInd221 != 2)
                        $blIncoInd221 = 1;
                } else {
                    // incoherence
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd221 = 2;
                }
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }
        }


        /**
         * Incohérences 222
         */
        $blIncoInd222 = 0;
        if ($questionCollectiviteConsolide->getQ2() == true || $questionCollectiviteConsolide->getQ4() == true) {
            $total112H = 0;
            $total112F = 0;
            $total122H = 0;
            $total122F = 0;
            $total222H = 0;
            $total222F = 0;

            foreach ($bilanSocialConsolide->getInd112s() as $ind112) {
                $total112H += $ind112->getR1121(0) + $ind112->getR1123(0) + $ind112->getR1125(0) + $ind112->getR1127(0);
                $total112F += $ind112->getR1122(0) + $ind112->getR1124(0) + $ind112->getR1126(0) + $ind112->getR1128(0);
            }

            foreach ($bilanSocialConsolide->getInd122s() as $ind122) {
                $total122H += $ind122->getR1221(0) + $ind122->getR1223(0) + $ind122->getR1225(0) + $ind122->getR1227(0);
                $total122F += $ind122->getR1222(0) + $ind122->getR1224(0) + $ind122->getR1226(0) + $ind122->getR1228(0);
            }

            foreach ($bilanSocialConsolide->getInd222s() as $ind222) {
                $total222H = $ind222->getR2221(0);
                $total222F = $ind222->getR2222(0);
                $idCt = $ind222->getRefContrainteTravail()->getIdConttrav();
                $lbCt = $ind222->getRefContrainteTravail()->getLbConttrav();


                if ($total222H > $total112H + $total122H) {
                    $message = $this->get('translator')->trans('ind222H.consolide.incoherencelog', array('lbCt' => $lbCt ));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("222idTr_".$idCt);
                    $incoherenceLog->setTableNum("2.2.2");
                    $incoherenceLog->setIdToggle1("toggle222");
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd222 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if ($total222F > $total112F + $total122F) {
                    $message = $this->get('translator')->trans('ind222F.consolide.incoherencelog', array('lbCt' => $lbCt ));

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("222idTr_".$idCt);
                    $incoherenceLog->setTableNum("2.2.2");
                    $incoherenceLog->setIdToggle1("toggle222");
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd222 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
        }


        /**
         * Incohérences 223
         */
        $blIncoInd223 = 0;
        if ($questionCollectiviteConsolide->getQ2() == true || $questionCollectiviteConsolide->getQ4() == true ) {
            $total2231H = 0;
            $total2231F = 0;

            $total1X1H = 0;
            $total1X1F = 0;


            foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                $total1X1H += $ind111->getR1115(0);
                $total1X1F += $ind111->getR1116(0);
            }

            foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                $total1X1H += $ind121->getR12114(0);
                $total1X1H += $ind121->getR12115(0);
                $total1X1F += $ind121->getR12116(0);
                $total1X1F += $ind121->getR12117(0);
            }

            foreach ($bilanSocialConsolide->getInd2231s() as $ind2231) {

                $total2231H += $ind2231->getR22311(0);
                $total2231F += $ind2231->getR22312(0);

                if ( $ind2231->getR22313(0) > $ind2231->getR22311(0)) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2231tr_" . json_encode($ind2231->getRefCategorie()->getIdCate()));
                    $incoherenceLog->setTableNum("2.2.3.1");
                    $incoherenceLog->setIdToggle1("toggle2231");
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind2231H.cate'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd223 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
                if ( $ind2231->getR22314(0) > $ind2231->getR22312(0)) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2231tr_" . json_encode($ind2231->getRefCategorie()->getIdCate()));
                    $incoherenceLog->setTableNum("2.2.3.1");
                    $incoherenceLog->setIdToggle1("toggle2231");
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind2231F.cate'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd223 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }

            if ( $total2231H > $total1X1H) {
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("total2231");
                $incoherenceLog->setTableNum("2.2.3.1");
                $incoherenceLog->setIdToggle1("toggle2231");
                $incoherenceLog->setForm("3");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($this->get('translator')->trans('ind2231H'));
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd223 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

            if ( $total2231F > $total1X1F) {
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("total2231");
                $incoherenceLog->setTableNum("2.2.3.1");
                $incoherenceLog->setIdToggle1("toggle2231");
                $incoherenceLog->setForm("3");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($this->get('translator')->trans('ind2231F'));
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd223 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

        }

        /**
         * Incohérences 224
         */
        $blIncoInd224 = 0;
        if ($questionCollectiviteConsolide->getQ2() == true || $questionCollectiviteConsolide->getQ4() == true || $questionCollectiviteConsolide->getQ6() == true) {
            $total224H = 0;
            $total224F = 0;
            $totalH = 0;
            $totalF = 0;

            foreach ($bilanSocialConsolide->getInd224s() as $ind224) {
                $total224H += $ind224->getR2241(0) + $ind224->getR2242(0) + $ind224->getR2243(0) + $ind224->getR2247(0);
                $total224F += $ind224->getR2244(0) + $ind224->getR2245(0) + $ind224->getR2246(0) + $ind224->getR2248(0);
            }


            foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                $totalH += $ind111->getR1115(0);
                $totalF +=  $ind111->getR1116(0);
            }

            foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                $totalH += $ind121->getR12114(0) + $ind121->getR12115(0);
                $totalF += $ind121->getR12116(0) + $ind121->getR12117(0);
            }

            foreach ($bilanSocialConsolide->getInd1311s() as $ind1311) {
                $totalH += $ind1311->getR13111(0);
                $totalF += $ind1311->getR13112(0);
            }

            if ($total224H > $totalH) {
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("line224");
                $incoherenceLog->setTableNum("2.2.4");
                $incoherenceLog->setIdToggle1("toggle224");
                $incoherenceLog->setForm("3");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($this->get('translator')->trans('ind224H.consolide.incoherencelog'));
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd224 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

            if ($total224F > $totalF) {
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("line224");
                $incoherenceLog->setTableNum("2.2.4");
                $incoherenceLog->setIdToggle1("toggle224");
                $incoherenceLog->setForm("3");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($this->get('translator')->trans('ind224F.consolide.incoherencelog'));
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd224 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

        }

        $blIncoTpsTrav211 = 0;
        if ($bilanSocialConsolide->getInd2111s()->Count() == 0) {
            // pas d enregistrement => etat = 1
            $bilanSocialConsolide->setBlIncoInd211(1);
            $bilanSocialConsolide->setMoyenneInd211(0);
            $blIncoTpsTrav211 = 1;
        }
        else if ($blIncoInd211 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd211(2);
            $bilanSocialConsolide->setMoyenneInd211(50);
            $blIncoTpsTrav211 = 2;
        }
        else if ($blIncoInd211 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd211(3);
            $bilanSocialConsolide->setMoyenneInd211(50);
            $blIncoTpsTrav211 = 3;
        }
        else {
            // des donnees mais aucun enregistrement dans incoh log
            $bilanSocialConsolide->setBlIncoInd211(4);
            $bilanSocialConsolide->setMoyenneInd211(100);
            $blIncoTpsTrav211 = 4;
        }


        $blIncoTpsTrav212 = 0;
        if ($bilanSocialConsolide->getInd2121s()->Count() == 0) {
            // pas d enregistrement => etat = 1
            $bilanSocialConsolide->setBlIncoInd212(1);
            $bilanSocialConsolide->setMoyenneInd212(0);
            $blIncoTpsTrav212 = 1;
        }
        else if ($blIncoInd212 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd212(2);
            $bilanSocialConsolide->setMoyenneInd212(50);
            $blIncoTpsTrav212 = 2;
        }
        else if ($blIncoInd212 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd212(3);
            $bilanSocialConsolide->setMoyenneInd212(50);
            $blIncoTpsTrav212 = 3;
        }
        else {
            // des donnees mais aucun enregistrement dans incoh log
            $bilanSocialConsolide->setBlIncoInd212(4);
            $bilanSocialConsolide->setMoyenneInd212(100);
            $blIncoTpsTrav212 = 4;
        }

        $blIncoTpsTrav213 = 0;
        if ($bilanSocialConsolide->getInd2131s()->Count() == 0) {
            // pas d enregistrement => etat = 1
            $bilanSocialConsolide->setBlIncoInd213(1);
            $bilanSocialConsolide->setMoyenneInd213(0);
            $blIncoTpsTrav213 = 1;
        }
        else if ($blIncoInd213 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd213(2);
            $bilanSocialConsolide->setMoyenneInd213(50);
            $blIncoTpsTrav213 = 2;
        }
        else if ($blIncoInd213 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd213(3);
            $bilanSocialConsolide->setMoyenneInd213(50);
            $blIncoTpsTrav213 = 3;
        }
        else {
            // des donnees mais aucun enregistrement dans incoh log
            $bilanSocialConsolide->setBlIncoInd213(4);
            $bilanSocialConsolide->setMoyenneInd213(100);
            $blIncoTpsTrav213 = 4;
        }

        $blIncoTpsTrav214 = 0;
        if ($bilanSocialConsolide->getInd214s()->Count() == 0) {
            // pas d enregistrement => etat = 1
            $bilanSocialConsolide->setBlIncoInd214(1);
            $bilanSocialConsolide->setMoyenneInd214(0);
            $blIncoTpsTrav214 = 1;
        }
        else if ($blIncoInd214 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd214(2);
            $bilanSocialConsolide->setMoyenneInd214(50);
            $blIncoTpsTrav214 = 2;
        }
        else if ($blIncoInd214 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd214(3);
            $bilanSocialConsolide->setMoyenneInd214(50);
            $blIncoTpsTrav214 = 3;
        }
        else {
            // des donnees mais aucun enregistrement dans incoh log
            $bilanSocialConsolide->setBlIncoInd214(4);
            $bilanSocialConsolide->setMoyenneInd214(100);
            $blIncoTpsTrav214 = 4;
        }

        $blIncoTpsTrav221 = 0;
        if ($bilanSocialConsolide->getInd221s()->Count() == 0) {
            // pas d enregistrement => etat = 1
            $bilanSocialConsolide->setBlIncoInd221(1);
            $bilanSocialConsolide->setMoyenneInd221(0);
            $blIncoTpsTrav221 = 1;
        }
        else if ($blIncoInd221 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd221(2);
            $bilanSocialConsolide->setMoyenneInd221(50);
            $blIncoTpsTrav221 = 2;
        }
        else if ($blIncoInd221 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd221(3);
            $bilanSocialConsolide->setMoyenneInd221(50);
            $blIncoTpsTrav221 = 3;
        }
        else {
            // des donnees mais aucun enregistrement dans incoh log
            $bilanSocialConsolide->setBlIncoInd221(4);
            $bilanSocialConsolide->setMoyenneInd221(100);
            $blIncoTpsTrav221 = 4;
        }
        $blIncoTpsTrav222 = 0;
        if ($bilanSocialConsolide->getInd222s()->Count() == 0) {
            // pas d enregistrement => etat = 1
            $bilanSocialConsolide->setBlIncoInd222(1);
            $bilanSocialConsolide->setMoyenneInd222(0);
            $blIncoTpsTrav222 = 1;
        }
        else if ($blIncoInd222 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd222(2);
            $bilanSocialConsolide->setMoyenneInd222(50);
            $blIncoTpsTrav222 = 2;
        }
        else if ($blIncoInd222 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd222(3);
            $bilanSocialConsolide->setMoyenneInd222(50);
            $blIncoTpsTrav222 = 3;
        }
        else {
            // des donnees mais aucun enregistrement dans incoh log
            $bilanSocialConsolide->setBlIncoInd222(4);
            $bilanSocialConsolide->setMoyenneInd222(100);
            $blIncoTpsTrav222 = 4;
        }

        $blIncoTpsTrav223 = 0;
        if ($bilanSocialConsolide->getInd2231s()->Count() == 0) {
            // pas d enregistrement => etat = 1
            $bilanSocialConsolide->setBlIncoInd223(1);
            $bilanSocialConsolide->setMoyenneInd223(0);
            $blIncoTpsTrav223 = 1;
        }
        else if ($blIncoInd223 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd223(2);
            $bilanSocialConsolide->setMoyenneInd223(50);
            $blIncoTpsTrav223 = 2;
        }
        else if ($blIncoInd223 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd223(3);
            $bilanSocialConsolide->setMoyenneInd223(50);
            $blIncoTpsTrav223 = 3;
        }
        else {
            // des donnees mais aucun enregistrement dans incoh log
            $bilanSocialConsolide->setBlIncoInd223(4);
            $bilanSocialConsolide->setMoyenneInd223(100);
            $blIncoTpsTrav223 = 4;
        }


        $blIncoTpsTrav224 = 0;
        if ($bilanSocialConsolide->getInd224s()->Count() == 0) {
            // pas d enregistrement => etat = 1
            $bilanSocialConsolide->setBlIncoInd224(1);
            $bilanSocialConsolide->setMoyenneInd224(0);
            $blIncoTpsTrav224 = 1;
        }
        else if ($blIncoInd224 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd224(2);
            $bilanSocialConsolide->setMoyenneInd224(50);
            $blIncoTpsTrav224 = 2;
        }
        else if ($blIncoInd224 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd224(3);
            $bilanSocialConsolide->setMoyenneInd224(50);
            $blIncoTpsTrav224 = 3;
        }
        else {
            // des donnees mais aucun enregistrement dans incoh log
            $bilanSocialConsolide->setBlIncoInd224(4);
            $bilanSocialConsolide->setMoyenneInd224(100);
            $blIncoTpsTrav224 = 4;
        }


        $blIncoTpsTrav = 0;
        if ($blIncoTpsTrav211 == 3 || $blIncoTpsTrav212 == 3 || $blIncoTpsTrav213 == 3 || $blIncoTpsTrav214 == 3
                    || $blIncoTpsTrav221 == 3 || $blIncoTpsTrav222 == 3 || $blIncoTpsTrav223 == 3 || $blIncoTpsTrav224 == 3) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoTpsTrav = 3;
        }
        elseif ($blIncoTpsTrav211 == 2 || $blIncoTpsTrav212 == 2 || $blIncoTpsTrav213 == 2 || $blIncoTpsTrav214 == 2
                || $blIncoTpsTrav221 == 2 || $blIncoTpsTrav222 == 2 || $blIncoTpsTrav223 == 2 || $blIncoTpsTrav224 == 2) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoTpsTrav = 2;
        }
        elseif ($blIncoTpsTrav211 == 1 && $blIncoTpsTrav212 == 1 && $blIncoTpsTrav213 == 1 && $blIncoTpsTrav214 == 1
                && $blIncoTpsTrav221 == 1 && $blIncoTpsTrav222 == 1 && $blIncoTpsTrav223 == 1 && $blIncoTpsTrav224 == 1) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoTpsTrav = 1;
        }
        elseif ($blIncoTpsTrav211 == 4 && $blIncoTpsTrav212 == 4 && $blIncoTpsTrav213 == 4 && $blIncoTpsTrav214 == 4
                && $blIncoTpsTrav221 == 4 && $blIncoTpsTrav222 == 4 && $blIncoTpsTrav223 == 4 && $blIncoTpsTrav224 == 4) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoTpsTrav = 4;
        }
        $bilanSocialConsolide->setBlIncoTpsTrav($blIncoTpsTrav);
    }

    protected function UpdateIncoherenceRemunerationLog($bilanSocialConsolide, $questionCollectiviteConsolide) {

        // Incoherences 3.1.1
        $blIncoInd311 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true) {
            foreach ($bilanSocialConsolide->getInd311s() as $ind311) {
                if ($blIncoInd311 == 0)
                    $blIncoInd311 = 4;


                $totalHFDont = 0;
                if ($ind311->getR3113() != null)
                    $totalHFDont += $ind311->getR3113();
                if ($ind311->getR3114() != null)
                    $totalHFDont += $ind311->getR3114();
                if ($ind311->getR3115() != null)
                    $totalHFDont += $ind311->getR3115();
                if ($ind311->getR3116() != null)
                    $totalHFDont += $ind311->getR3116();
                if ($ind311->getR3117() != null)
                    $totalHFDont += $ind311->getR3117();
                if ($ind311->getR3118() != null)
                    $totalHFDont += $ind311->getR3118();
                if ($ind311->getR3119() != null)
                    $totalHFDont += $ind311->getR3119();
                if ($ind311->getR31110() != null)
                    $totalHFDont += $ind311->getR31110();
                if ($ind311->getR31111() != null)
                    $totalHFDont += $ind311->getR31111();
                if ($ind311->getR31112() != null)
                    $totalHFDont += $ind311->getR31112();

                $totalHF = 0;
                if ($ind311->getR3111() != null)
                    $totalHF += $ind311->getR3111();
                if ($ind311->getR3112() != null)
                    $totalHF += $ind311->getR3112();

                //                $message = "";
                //                if ($totalHF < $totalHFDont) {
                //                    $message = $this->get('translator')->trans('ind311erreurtotalstrictementsup', array('lbcategorie' => $ind311->getRefCategorie()->getLbCate()));
                //                    $incoherenceLog = new IncoherenceLog();
                //                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                //                    $incoherenceLog->setField("311idTr_" . json_encode($ind311->getRefCategorie()->getIdCate()));
                //                    $incoherenceLog->setTableNum("3.1.1");
                //                    $incoherenceLog->setIdToggle1("toggle311");
                //                    $incoherenceLog->setIdToggle2("");
                //                    $incoherenceLog->setMessage($message);
                //                    $incoherenceLog->setForm("4");
                //                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                //                    $incoherenceLog->setBlIncoherence(true);
                //                    $blIncoInd311 = 2;
                //                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                //                }

                $totalHDont = 0;
                if ($ind311->getR3113() != null)
                    $totalHDont += $ind311->getR3113();
                if ($ind311->getR3115() != null)
                    $totalHDont += $ind311->getR3115();
                if ($ind311->getR3117() != null)
                    $totalHDont += $ind311->getR3117();
                if ($ind311->getR3119() != null)
                    $totalHDont += $ind311->getR3119();
                if ($ind311->getR31111() != null)
                    $totalHDont += $ind311->getR31111();

                $totalH = 0;
                if ($ind311->getR3111() != null)
                    $totalH += $ind311->getR3111();


                $message = "";
                if ($totalH < $totalHDont) {
                    $message = $this->get('translator')->trans('ind311totalhommesupsomme', array('lbcategorie' => $ind311->getRefCategorie()->getLbCate() ));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("311idTr_" . json_encode($ind311->getRefCategorie()->getIdCate()));
                    $incoherenceLog->setTableNum("3.1.1");
                    $incoherenceLog->setIdToggle1("toggle311");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("4");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd311 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $totalFDont = 0;
                if ($ind311->getR3114() != null)
                    $totalFDont += $ind311->getR3114();
                if ($ind311->getR3116() != null)
                    $totalFDont += $ind311->getR3116();
                if ($ind311->getR3118() != null)
                    $totalFDont += $ind311->getR3118();
                if ($ind311->getR31110() != null)
                    $totalFDont += $ind311->getR31110();
                if ($ind311->getR31112() != null)
                    $totalFDont += $ind311->getR31112();

                $totalF = 0;
                if ($ind311->getR3112() != null)
                    $totalF += $ind311->getR3112();

                $message = "";
                if ($totalF < $totalFDont) {
                    $message = $this->get('translator')->trans('ind311totalfemmesupsomme', array('lbcategorie' => $ind311->getRefCategorie()->getLbCate() ));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("311idTr_" . json_encode($ind311->getRefCategorie()->getIdCate()));
                    $incoherenceLog->setTableNum("3.1.1");
                    $incoherenceLog->setIdToggle1("toggle311");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("4");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd311 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }

            $total1115 = 0;
            $total1116 = 0;
            foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                $total1115 += $ind111->getR1115(0);
                $total1116 += $ind111->getR1116(0);
            }
            $totalEffectif111 = $total1115 + $total1116;
            $total3111 = 0;
            $total3112 = 0;
            foreach ($bilanSocialConsolide->getInd311s() as $ind311) {
                $total3111 += $ind311->getR3111(0);
                $total3112 += $ind311->getR3112(0);
            }
            $totalRemuneration311 = $total3111 + $total3112;
            if ( ($totalEffectif111 !=  null && $totalRemuneration311 == null) || ($totalEffectif111 ==  null && $totalRemuneration311 != null) ){
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("totalGlo");
                $incoherenceLog->setTableNum("3.1.1");
                $incoherenceLog->setForm("4");
                $incoherenceLog->setIdToggle1("toggle311");
                $incoherenceLog->setMessage($this->get('translator')->trans('ind311totalremunerations'));
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd311 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }
        }

        // Incoherences 3.2.1
        $blIncoInd321 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true) {
            foreach ($bilanSocialConsolide->getInd321s() as $ind321) {
                if ($blIncoInd321 == 0)
                    $blIncoInd321 = 4;


                $totalHFDont = 0;
                if ($ind321->getR3213() != null)
                    $totalHFDont += $ind321->getR3213();
                if ($ind321->getR3214() != null)
                    $totalHFDont += $ind321->getR3214();
                if ($ind321->getR3215() != null)
                    $totalHFDont += $ind321->getR3215();
                if ($ind321->getR3216() != null)
                    $totalHFDont += $ind321->getR3216();

                $totalHF = 0;
                if ($ind321->getR3211() != null)
                    $totalHF += $ind321->getR3211();
                if ($ind321->getR3212() != null)
                    $totalHF += $ind321->getR3212();

                //                $message = "";
                //                if ($totalHF < $totalHFDont) {
                //                    $message = $this->get('translator')->trans('ind321totalstrictementsup', array('lbcategorie' => $ind321->getRefCategorie()->getLbCate() ));
                //                    $incoherenceLog = new IncoherenceLog();
                //                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                //                    $incoherenceLog->setField("321idTr_" . json_encode($ind321->getRefCategorie()->getIdCate()));
                //                    $incoherenceLog->setTableNum("3.2.1");
                //                    $incoherenceLog->setIdToggle1("toggle321");
                //                    $incoherenceLog->setIdToggle2("");
                //                    $incoherenceLog->setMessage($message);
                //                    $incoherenceLog->setForm("4");
                //                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                //                    $incoherenceLog->setBlIncoherence(true);
                //                    $blIncoInd321 = 2;
                //                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                //                }

                $totalHDont = 0;
                if ($ind321->getR3213() != null)
                    $totalHDont += $ind321->getR3213();
                if ($ind321->getR3215() != null)
                    $totalHDont += $ind321->getR3215();

                $totalH = 0;
                if ($ind321->getR3211() != null)
                    $totalH += $ind321->getR3211();


                $message = "";
                if ($totalH < $totalHDont) {
                    $message = $this->get('translator')->trans('ind321totalsuphomme', array('lbcategorie' => $ind321->getRefCategorie()->getLbCate() ));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("321idTr_" . json_encode($ind321->getRefCategorie()->getIdCate()));
                    $incoherenceLog->setTableNum("3.2.1");
                    $incoherenceLog->setIdToggle1("toggle321");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("4");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd321 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $totalFDont = 0;
                if ($ind321->getR3214() != null)
                    $totalFDont += $ind321->getR3214();
                if ($ind321->getR3216() != null)
                    $totalFDont += $ind321->getR3216();

                $totalF = 0;
                if ($ind321->getR3212() != null)
                    $totalF += $ind321->getR3212();

                $message = "";
                if ($totalF < $totalFDont) {
                    $message = $this->get('translator')->trans('ind321totalsupfemme', array('lbcategorie' => $ind321->getRefCategorie()->getLbCate() ));
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("321idTr_" . json_encode($ind321->getRefCategorie()->getIdCate()));
                    $incoherenceLog->setTableNum("3.2.1");
                    $incoherenceLog->setIdToggle1("toggle321");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("4");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd321 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
            $total12114 = 0;
            $total12115 = 0;
            $total12116 = 0;
            $total12117 = 0;
            foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                $total12114 += $ind121->getR12114(0);
                $total12115 += $ind121->getR12115(0);
                $total12116 += $ind121->getR12116(0);
                $total12117 += $ind121->getR12117(0);
            }
            $totalEffectif121H = $total12114 + $total12115;
            $totalEffectif121F = $total12116 + $total12117;

            $totalH = 0;
            $totalF = 0;
            foreach ($bilanSocialConsolide->getInd321s() as $ind321) {
                $totalH += $ind321->getR3211();
                $totalF += $ind321->getR3212();
            }
            if ( ($totalEffectif121H != null && $totalH == null) || ($totalEffectif121H == null && $totalH != null) || ($totalEffectif121F != null && $totalF == null) || ($totalEffectif121F == null && $totalF != null) ){
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("totalGlo");
                $incoherenceLog->setTableNum("3.2.1");
                $incoherenceLog->setForm("4");
                $incoherenceLog->setIdToggle1("toggle321");
                $incoherenceLog->setMessage($this->get('translator')->trans('ind321totalremunerations'));
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd321 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }
        }

        // Incoherences 3.4.5
        $blIncoInd345 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true || $questionCollectiviteConsolide->getQ3() == true || $questionCollectiviteConsolide->getQ5() == true) {

            if($bilanSocialConsolide->getR3451() != null || $bilanSocialConsolide->getR3452() != null) {

                //1 >= 2
                $total1 = 0;
                if($bilanSocialConsolide->getR3451() != null) {
                    $total1 = $bilanSocialConsolide->getR3451();
                }

                $total2 = 0;
                if($bilanSocialConsolide->getR3452() != null) {
                    $total2 = $bilanSocialConsolide->getR3452();
                }

                $message = "";
                if ($total1 <= $total2) {
                    $message = $this->get('translator')->trans('ind345chargepersonnelstrictementinferieur');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("idTr1");
                    $incoherenceLog->setTableNum("3.4.5");
                    $incoherenceLog->setIdToggle1("toggle345");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("4");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd345 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }

        }


        $blIncoRemuneration311 = 0;

        if ($bilanSocialConsolide->getInd311s()->Count() == 0) {
            //pas de donnees
            $bilanSocialConsolide->setBlIncoInd311(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd311(0);
            $blIncoRemuneration311 = 1;
        }
        else if ($blIncoInd311 == 2) {
            //au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd311(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd311(50);
            $blIncoRemuneration311 = 3;
        }
        else {
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd311(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd311(100);
            $blIncoRemuneration311 = 4;
        }


        $blIncoRemuneration321 = 0;

        if ($bilanSocialConsolide->getInd321s()->Count() == 0) {
            //pas de donnees
            $bilanSocialConsolide->setBlIncoInd321(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd321(0);
            $blIncoRemuneration321 = 1;
        }
        else if ($blIncoInd321 == 2) {
            //au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd321(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd321(50);
            $blIncoRemuneration321 = 3;
        }
        else {
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd321(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd321(100);
            $blIncoRemuneration321 = 4;
        }
        
        $blIncoRemuneration331 = 0;

        if ($bilanSocialConsolide->getInd331s()->Count() == 0) {
            //pas de donnees
            $bilanSocialConsolide->setBlIncoInd331(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd331(0);
            $blIncoRemuneration331 = 1;
        }else{
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd331(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd331(100);
            $blIncoRemuneration331 = 4;
        }

        $blIncoRemuneration345 = 0;

        if ($bilanSocialConsolide->getR3451() === null || $bilanSocialConsolide->getR3451() == 0 || $bilanSocialConsolide->getR3452() === null || $bilanSocialConsolide->getR3452() == 0) {
            //pas de donnees
            $bilanSocialConsolide->setBlIncoInd345(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd345(0);
            $blIncoRemuneration345 = 1;

            if ($bilanSocialConsolide->getR3451() == 0 || $bilanSocialConsolide->getR3452() == 0) {
                if ($bilanSocialConsolide->getR3451() == 0){
                    $message = $this->get('translator')->trans('ind345nonrenseigne');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("idTr1");
                    $incoherenceLog->setTableNum("3.4.5");
                    $incoherenceLog->setIdToggle1("toggle345");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("4");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd345 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);

                    $bilanSocialConsolide->setBlIncoInd345(3); // Au moins une incoherence présente
                    $bilanSocialConsolide->setMoyenneInd345(50);
                    $blIncoRemuneration345 = 3;
                }
                if ($bilanSocialConsolide->getR3452() == 0){
                    $message = $this->get('translator')->trans('ind345nonrenseigne');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("idTr2");
                    $incoherenceLog->setTableNum("3.4.5");
                    $incoherenceLog->setIdToggle1("toggle345");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("4");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd345 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);

                    $bilanSocialConsolide->setBlIncoInd345(3); // Au moins une incoherence présente
                    $bilanSocialConsolide->setMoyenneInd345(50);
                    $blIncoRemuneration345 = 3;
                }    
            }
        }
        else if ($blIncoInd345 == 2) {
            //au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd345(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd345(50);
            $blIncoRemuneration345 = 3;
        }
        else {
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd345(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd345(100);
            $blIncoRemuneration345 = 4;
        }
        
        
        if ($bilanSocialConsolide->getQ3411() === null && $bilanSocialConsolide->getQ3412() === null) {
            
            //pas de donnees
            $bilanSocialConsolide->setMoyenneInd341(0);
            $blIncoRemuneration341 = 1;
        } else {
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd341(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd341(100);
            $blIncoRemuneration341 = 4;
        }
        
        if ($bilanSocialConsolide->getQ3421() === null && $bilanSocialConsolide->getQ3422() === null && $bilanSocialConsolide->getQ3423() === null) {
            
            //pas de donnees
            $bilanSocialConsolide->setMoyenneInd342(0);
            $blIncoRemuneration342 = 1;
        } else {
            //aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd342(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd342(100);
            $blIncoRemuneration342 = 4;
        }
       

        $blIncoRemuneration = 0;
        if ($blIncoRemuneration311 == 3 || $blIncoRemuneration321 == 3 || $blIncoRemuneration345 == 3) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoRemuneration = 3;
        }
        elseif ($blIncoRemuneration311 == 2 || $blIncoRemuneration321 == 2 || $blIncoRemuneration345 == 2) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoRemuneration = 2;
        }
        elseif ($blIncoRemuneration311 == 1 && $blIncoRemuneration321 == 1 && $blIncoRemuneration345 == 1) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoRemuneration = 1;
        }
        elseif ($blIncoRemuneration311 == 4 && $blIncoRemuneration321 == 4 && $blIncoRemuneration345 == 4) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoRemuneration = 4;
        }
        $bilanSocialConsolide->setBlIncoRemuneration($blIncoRemuneration);
    }

    protected function UpdateIncoherenceConditionsLog($bilanSocialConsolide, $questionCollectiviteConsolide) {
        $blIncoInd411 = 0;
        if ($questionCollectiviteConsolide->getQ2() == true || $questionCollectiviteConsolide->getQ4() == true ) {
            $total111 = 0;
            foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                $total111 += $ind111->getR1115(0) + $ind111->getR1116(0);
            }

            $total121 = 0;
            foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                $total121 += $ind121->getR1211(0) + $ind121->getR1212(0) + $ind121->getR1213(0) + $ind121->getR1214(0) +
                    $ind121->getR1215(0) + $ind121->getR1216(0) + $ind121->getR1217(0) + $ind121->getR1218(0) + $ind121->getR12118(0);
            }

            $total411 = 0;
            foreach ($bilanSocialConsolide->getInd411s() as $ind411) {
                $total411 += ($ind411->getR4111() != null ? $ind411->getR4111() : 0);
            }

            if ( ($total111 + $total121) < $total411) {
                $message = $this->get('translator')->trans('ind411agentaffectprevent');
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("tot411");
                $incoherenceLog->setTableNum("4.1.1");
                $incoherenceLog->setIdToggle1("toggle411");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($message);
                $incoherenceLog->setForm("5");
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd411 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

            $tot412 = 0;
            foreach ($bilanSocialConsolide->getInd412s() as $ind412) {
                if ($ind412->getRefActionPrevention()->getCdActionprev() == RefActionPrevention::AP005) {
                    $tot412 += $ind412->getR4121(0);
                }
            }
            $tot3451 = $bilanSocialConsolide->getR3451() ?? 0;

            if ($tot412 > $tot3451) {
                $message = $this->get('translator')->trans('ind411actionpreventmontant');
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("412idTr_5");
                $incoherenceLog->setTableNum("4.1.2");
                $incoherenceLog->setIdToggle1("toggle411");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($message);
                $incoherenceLog->setForm("5");
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd411 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }
        }
        
        if($bilanSocialConsolide->getR4131() !== null){
            $bilanSocialConsolide->setMoyenneInd413(100);
            $bilanSocialConsolide->setBlIncoInd411(4);
        }else{
            $bilanSocialConsolide->setMoyenneInd413(0);
            $bilanSocialConsolide->setBlIncoInd411(1);
        }
        
        $blIncoInd414 = 0;
        //$camp = $this->getEntityManager()->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne()->getDtDebu();
        $camp = $this->getEntityManager()->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne()->getNmAnne();
        $crea = $bilanSocialConsolide->getR4141();
        $q414 = $bilanSocialConsolide->getQ414();
        //$date = new DateTime('1980-01-01');
        $date = 1980;

        if($crea!=null && $q414 = 1) {
            if ($crea <= $date || $crea > $camp) {
                $message = $this->get('translator')->trans('ind414annecreationdocument.consolide.incoherencelog', array('datecamp' => $camp));

                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("dateCrea");
                $incoherenceLog->setTableNum("4.1.4");
                $incoherenceLog->setIdToggle1("toggle414");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($message);
                $incoherenceLog->setForm("5");
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd414 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

            $lastUpdate = $bilanSocialConsolide->getR4142();

            if ($lastUpdate > $camp ) {
                $message = $this->get('translator')->trans('ind414annemiseajourdocument.consolide.incoherencelog', array('datecamp' => $camp, 'datemaj' => $lastUpdate));

                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("dateUpdate");
                $incoherenceLog->setTableNum("4.1.4");
                $incoherenceLog->setIdToggle1("toggle414");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($message);
                $incoherenceLog->setForm("5");
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd414 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

            if ($lastUpdate < $crea ) {
                $message = $this->get('translator')->trans('ind414annemiseajourdocument2.consolide.incoherencelog', array('datecrea' => $crea, 'datemaj' => $lastUpdate));

                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("dateUpdate");
                $incoherenceLog->setTableNum("4.1.4");
                $incoherenceLog->setIdToggle1("toggle414");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($message);
                $incoherenceLog->setForm("5");
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd414 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

        }else if($q414 !== 1 && $q414 !== null){
            $blIncoInd414 = null;
        }

        $blIncoInd421 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true || $questionCollectiviteConsolide->getQ3() == true || $questionCollectiviteConsolide->getQ5() == true) {
            if ($bilanSocialConsolide->getInd421s()->Count() != 0) {
                $total4211  = 0;
                $total4212  = 0;
                $total4213  = 0;
                $total4214  = 0;
                $total4215  = 0;
                $total4216  = 0;
                $total4217  = 0;
                $total4218  = 0;
                $total4219  = 0;
                $total42110 = 0;
                $total42111 = 0;
                $total42112 = 0;

                foreach ($bilanSocialConsolide->getInd421s() as $ind421) {
                    $total4211 += $ind421->getR4211(0);
                    $total4212 += $ind421->getR4212(0);
                    $total4213 += $ind421->getR4213(0);
                    $total4214 += $ind421->getR4214(0);
                    $total4215 += $ind421->getR4215(0);
                    $total4216 += $ind421->getR4216(0);
                    $total4217 += $ind421->getR4217(0);
                    $total4218 += $ind421->getR4218(0);
                    $total4219 += $ind421->getR4219(0); // K103
                    $total42110 += $ind421->getR42110(0); //L103
                    $total42111 += $ind421->getR42111(0); // M103
                    $total42112 += $ind421->getR42112(0); // N103
                }

                $ind421s = $bilanSocialConsolide->getInd421s();
                for($i=0; $i<sizeof($ind421s); $i++){
                    if( $ind421s[$i]->getR4211(0) < $ind421s[$i]->getR4213(0) ){
                        $message = $this->get('translator')->trans('ind421_SansArret_Service');
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("totalGlo");
                        $incoherenceLog->setTableNum("4.2.1");
                        $incoherenceLog->setIdToggle1("toggle421");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($message);
                        $incoherenceLog->setForm("5");
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd421 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }
                    if( $ind421s[$i]->getR4212(0) < $ind421s[$i]->getR4214(0) ){
                        $message = $this->get('translator')->trans('ind421_SansArret_Service');
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("totalGlo");
                        $incoherenceLog->setTableNum("4.2.1");
                        $incoherenceLog->setIdToggle1("toggle421");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($message);
                        $incoherenceLog->setForm("5");
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd421 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }
                    if( $ind421s[$i]->getR4215(0) < $ind421s[$i]->getR4217(0) ){
                        $message = $this->get('translator')->trans('ind421_SansArret_Trajet');
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("totalGlo");
                        $incoherenceLog->setTableNum("4.2.1");
                        $incoherenceLog->setIdToggle1("toggle421");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($message);
                        $incoherenceLog->setForm("5");
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd421 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }
                    if( $ind421s[$i]->getR4216(0) < $ind421s[$i]->getR4218(0) ){
                        $message = $this->get('translator')->trans('ind421_SansArret_Trajet');
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("totalGlo");
                        $incoherenceLog->setTableNum("4.2.1");
                        $incoherenceLog->setIdToggle1("toggle421");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($message);
                        $incoherenceLog->setForm("5");
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd421 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
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

                // Rassct Nombre d'accidents
                $total421TotalAccidents     = 0;
                $totalBscRAccident2         = 0;
                $bscRAccident2SansArret     = 0;
                $bscRAccident2AvecArret     = 0;
                $totalRNbJourArretAccidents = 0;
                $totalRNbJourArretNL        = 0;
                $totalRNbJourArretSL        = 0;
                $totalRNbJourArretEM        = 0;

                // Rassct Nombre de jours d'absence

                if ($bilanSocialConsolide->getBscRassctAccidentTravails() != null && $bilanSocialConsolide->getBscRassctAccidentTravails()->count() > 0) {
                    foreach ($bilanSocialConsolide->getBscRassctAccidentTravails() as $bscRassctAccidentTravail) {
                        $totalBscRAccident2 += $bscRassctAccidentTravail->getRAccident2(0);
                    }   
                    $bscRassctAccidentTravails = $bilanSocialConsolide->getBscRassctAccidentTravails();
                    $bscRAccident2SansArret = $bscRassctAccidentTravails[0]->getRAccident2(0);
                    for($i=1; $i<sizeof($bscRassctAccidentTravails); $i++){
                        $bscRAccident2AvecArret += $bscRassctAccidentTravails[$i]->getRAccident2(0);
                    }
                }

                if ($bilanSocialConsolide->getBscRassctNbAccidentTravails() != null && $bilanSocialConsolide->getBscRassctNbAccidentTravails()->count() > 0) {
                    foreach ($bilanSocialConsolide->getBscRassctNbAccidentTravails() as $bscRassctNbAccidentTravails) {
                        $totalRNbJourArretAccidents += $bscRassctNbAccidentTravails->getRNbJourArretAccidents(0);
                    }
                }

                if ($bilanSocialConsolide->getBscRassctNatureLesions() != null && $bilanSocialConsolide->getBscRassctNatureLesions()->count() > 0) {
                    foreach ($bilanSocialConsolide->getBscRassctNatureLesions() as $bscRassctNL) {
                        $totalRNbJourArretNL += $bscRassctNL->getRNbJourArret(0);
                    }
                }

                if ($bilanSocialConsolide->getBscRassctSiegeLesions() != null && $bilanSocialConsolide->getBscRassctSiegeLesions()->count() > 0) {     
                    foreach ($bilanSocialConsolide->getBscRassctSiegeLesions() as $bscRassctSiegeLesion) {
                        $totalRNbJourArretSL += $bscRassctSiegeLesion->getRNbJourArret(0);              
                    } 
                }      

                if ($bilanSocialConsolide->getBscRassctElementMateriels() != null && $bilanSocialConsolide->getBscRassctElementMateriels()->count() > 0) {   
                    foreach ($bilanSocialConsolide->getBscRassctElementMateriels() as $bscRassctElementMateriel) {
                        $totalRNbJourArretEM += $bscRassctElementMateriel->getRNbJourArret(0);       
                    } 
                }    

                // 4.2.1 : Total Nombre d'accidents 
                $total421TotalAccidents = $total4211 + $total4212 + $total4215 + $total4216 ;
                $total421SansArret = $total4213 + $total4214 + $total4217 + $total4218 ;
                $total421AvecArret = $total421TotalAccidents - $total421SansArret;

                // 4.2.1 : Total Nombre de jours d'arrêt
                $total421NbJoursArrets = $total4219 + $total42110 + $total42111 + $total42112;

                if($total4219 != $total21XH_1) {
                    $message = $this->get('translator')->trans('ind421_Col9');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo");
                    $incoherenceLog->setTableNum("4.2.1");
                    $incoherenceLog->setIdToggle1("toggle421");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd421 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if($total42110 != $total21XF_1) {
                    $message = $this->get('translator')->trans('ind421_Col10');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo");
                    $incoherenceLog->setTableNum("4.2.1");
                    $incoherenceLog->setIdToggle1("toggle421");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd421 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if($total42111 != $total21XH_2) {
                    $message = $this->get('translator')->trans('ind421_Col11');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo");
                    $incoherenceLog->setTableNum("4.2.1");
                    $incoherenceLog->setIdToggle1("toggle421");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd421 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if($total42112 != $total21XF_2) {
                    $message = $this->get('translator')->trans('ind421_Col12');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo");
                    $incoherenceLog->setTableNum("4.2.1");
                    $incoherenceLog->setIdToggle1("toggle421");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd421 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if( $total421SansArret != $bscRAccident2SansArret){
                    $message = $this->get('translator')->trans('ind421_Rassct_SansArret');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo");
                    $incoherenceLog->setTableNum("4.2.1");
                    $incoherenceLog->setIdToggle1("toggle421");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd421 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if( $total421AvecArret != $bscRAccident2AvecArret){
                    $message = $this->get('translator')->trans('ind421_Rassct_AvecArret');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo");
                    $incoherenceLog->setTableNum("4.2.1");
                    $incoherenceLog->setIdToggle1("toggle421");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd421 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
                if( $total421NbJoursArrets < $totalRNbJourArretAccidents){
                    $message = $this->get('translator')->trans('ind421_Rassct_NbJour_ArretAccidents');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo");
                    $incoherenceLog->setTableNum("4.2.1");
                    $incoherenceLog->setIdToggle1("toggle421");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd421 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
                if( $total421NbJoursArrets < $totalRNbJourArretNL){
                    $message = $this->get('translator')->trans('ind421_Rassct_NbJour_NL');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo");
                    $incoherenceLog->setTableNum("4.2.1");
                    $incoherenceLog->setIdToggle1("toggle421");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd421 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
                if( $total421NbJoursArrets < $totalRNbJourArretSL){
                    $message = $this->get('translator')->trans('ind421_Rassct_NbJour_SL');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo");
                    $incoherenceLog->setTableNum("4.2.1");
                    $incoherenceLog->setIdToggle1("toggle421");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd421 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
                if( $total421NbJoursArrets < $totalRNbJourArretEM){
                    $message = $this->get('translator')->trans('ind421_Rassct_NbJour_EM');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo");
                    $incoherenceLog->setTableNum("4.2.1");
                    $incoherenceLog->setIdToggle1("toggle421");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd421 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }else{
                $blIncoInd421 = 0;
            }
        }


        $blIncoInd422 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true || $questionCollectiviteConsolide->getQ3() == true || $questionCollectiviteConsolide->getQ5() == true) {
            if ($bilanSocialConsolide->getInd422s()->Count() != 0) {
                $total422H = 0;
                $total422F = 0;

                 //error_log('total422H = ' . $total422H);

                foreach ($bilanSocialConsolide->getInd422s() as $ind422) {
                    $total422H += $ind422->getR4225(0) + $ind422->getR4227(0);
                    $total422F += $ind422->getR4226(0) + $ind422->getR4228(0);
                }

                //error_log('total422H = ' . $total422H);

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

                if($total422H != $total21XH_1) {
                    $message = $this->get('translator')->trans('ind422_Col5_7');

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo422");
                    $incoherenceLog->setTableNum("4.2.2");
                    $incoherenceLog->setIdToggle1("toggle422");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd422 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if($total422F != $total21XF_1) {
                    $message = $this->get('translator')->trans('ind422_Col6_8');

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo422");
                    $incoherenceLog->setTableNum("4.2.2");
                    $incoherenceLog->setIdToggle1("toggle422");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd422 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }else{
                /* quand pas d'absence et que la question dans l'indicateur 422 est a NON pour remplir la progresse bar */
                $blIncoInd422 = 0;
            }
        }


        $blIncoInd424 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true || $questionCollectiviteConsolide->getQ3() == true) {

            // Total titulaire + stagiaire > total 111(5) + 111(6)
            $totTituSta = 0;
            $totTituStaH = 0;
            $totTituStaF = 0;

            $totEmpPerma = 0;
            $totEmpPermaH = 0;
            $totEmpPermaF = 0;

            foreach ($bilanSocialConsolide->getInd424s() as $ind424) {

                $totTituSta += $ind424->getRTS4241(0) +
                                $ind424->getRTS4242(0) +
                                $ind424->getRTS4243(0) +
                                $ind424->getRTS4244(0) +
                                $ind424->getRTS4245(0) +
                                $ind424->getRTS4246(0);

                $totTituStaH += $ind424->getRTS4241(0) +
                                $ind424->getRTS4243(0) +
                                $ind424->getRTS4245(0);

                $totTituStaF += $ind424->getRTS4242(0) +
                                $ind424->getRTS4244(0) +
                                $ind424->getRTS4246(0);

                $totEmpPerma += $ind424->getREMP4241(0) +
                                $ind424->getREMP4242(0) +
                                $ind424->getREMP4243(0) +
                                $ind424->getREMP4244(0) +
                                $ind424->getREMP4245(0) +
                                $ind424->getREMP4246(0);

                $totEmpPermaH += $ind424->getREMP4241(0) +
                                $ind424->getREMP4243(0) +
                                $ind424->getREMP4245(0);

                $totEmpPermaF += $ind424->getREMP4242(0) +
                                $ind424->getREMP4244(0) +
                                $ind424->getREMP4246(0);

            }

            $tot111 = 0;
            $tot111H = 0;
            $tot111F = 0;
            foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                $tot111 += $ind111->getR1115(0) + $ind111->getR1116(0);
                $tot111H += $ind111->getR1115(0);
                $tot111F += $ind111->getR1116(0);
            }

            //error_log('totTituSta = ' . $totTituSta);
            //error_log('tot111 = ' . $tot111);

            if ($tot111 < $totTituSta) {
                $message = $this->get('translator')->trans('ind424allocationtempinvalidinfer111');
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("424idTr_1");
                $incoherenceLog->setTableNum("4.2.4");
                $incoherenceLog->setIdToggle1("toggle424");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($message);
                $incoherenceLog->setForm("5");
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd424 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }


            if ($tot111H < $totTituStaH) {
                $message = $this->get('translator')->trans('ind424allocationtempinvalidhommeinfer111');
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("424idTr_1");
                $incoherenceLog->setTableNum("4.2.4");
                $incoherenceLog->setIdToggle1("toggle424");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($message);
                $incoherenceLog->setForm("5");
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd424 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

            if ($totTituStaF > $tot111F) {
                $message = $this->get('translator')->trans('ind424allocationtempinvalidfemmeinfer111');
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("424idTr_1");
                $incoherenceLog->setTableNum("4.2.4");
                $incoherenceLog->setIdToggle1("toggle424");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($message);
                $incoherenceLog->setForm("5");
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd424 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

            // Comparaison Contractuel sur emploi permanant et 1.2.1
            $tot121 = 0;
            $tot121H = 0;
            $tot121F = 0;
            foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                $tot121 += ($ind121->getR1211() != null ? $ind121->getR1211() : 0) +
                        ($ind121->getR1212() != null ? $ind121->getR1212() : 0) +
                        ($ind121->getR1213() != null ? $ind121->getR1213() : 0) +
                        ($ind121->getR1214() != null ? $ind121->getR1214() : 0) +
                        ($ind121->getR1215() != null ? $ind121->getR1215() : 0) +
                        ($ind121->getR1216() != null ? $ind121->getR1216() : 0) +
                        ($ind121->getR1217() != null ? $ind121->getR1217() : 0) +
                        ($ind121->getR1218() != null ? $ind121->getR1218() : 0) +
                        ($ind121->getR12118() != null ? $ind121->getR12118() : 0)
                    ;

                $tot121H += ($ind121->getR12114() != null ? $ind121->getR12114() : 0) +
                        ($ind121->getR12115() != null ? $ind121->getR12115() : 0);

                $tot121F += ($ind121->getR12116() != null ? $ind121->getR12116() : 0) +
                        ($ind121->getR12117() != null ? $ind121->getR12117() : 0);
            }

           // error_log('totEmpPermaH = ' . $totEmpPermaH);
           // error_log('$tot121H = ' . $tot121H);

            if ($tot121 < $totEmpPerma) {
                $message = $this->get('translator')->trans('ind424allocationtempinvalidempperminfercdd121');
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("424idTr_2");
                $incoherenceLog->setTableNum("4.2.4");
                $incoherenceLog->setIdToggle1("toggle424");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($message);
                $incoherenceLog->setForm("5");
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd424 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

            if ($tot121H < $totEmpPermaH) {
                $message = $this->get('translator')->trans('ind424allocationtempinvalidemppermhommeinfercdd121');
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("424idTr_2");
                $incoherenceLog->setTableNum("4.2.4");
                $incoherenceLog->setIdToggle1("toggle424");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($message);
                $incoherenceLog->setForm("5");
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd424 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }

            if ($tot121F < $totEmpPermaF) {
                $message = $this->get('translator')->trans('ind424allocationtempinvalidemppermfemmeinfercdd121');
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("424idTr_2");
                $incoherenceLog->setTableNum("4.2.4");
                $incoherenceLog->setIdToggle1("toggle424");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage($message);
                $incoherenceLog->setForm("5");
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setBlIncoherence(true);
                $blIncoInd424 = 2;
                $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
            }
        }

        $blIncoInd431 = 0;
        if ($bilanSocialConsolide->getInd431s()->Count() != 0) {
            if ($bilanSocialConsolide->getQ4311() == true && ($questionCollectiviteConsolide->getQ1() == true || $questionCollectiviteConsolide->getQ3() == true || $questionCollectiviteConsolide->getQ5() == true)) {
                $tot431H = 0;
                $tot431F = 0;
                // si true -> a une valeur
                foreach ($bilanSocialConsolide->getInd431s() as $ind431) {
                    if ($ind431->getRefActeViolencePhysique()->getCdActviolphys() == RefActeViolencePhysique::AVP001 || $ind431->getRefActeViolencePhysique()->getCdActviolphys() == RefActeViolencePhysique::AVP003) {
                        $tot431H += $ind431->getR43111() ?? 0;
                        $tot431F += $ind431->getR43112() ?? 0;
                    }
                }

                $Ind211H = 0;
                $Ind211F = 0;
                foreach ($bilanSocialConsolide->getInd2111s() as $ind211) {
                    if ($ind211->getRefMotifAbsence()->getCdMotiabse() == RefMotifAbsence::ABS003 || $ind211->getRefMotifAbsence()->getCdMotiabse() == RefMotifAbsence::ABS004) {
                        $Ind211H += $ind211->getR21115() ?? 0;
                        $Ind211F += $ind211->getR21116() ?? 0;
                    }
                }

                $Ind212H = 0;
                $Ind212F = 0;
                foreach ($bilanSocialConsolide->getInd2121s() as $ind212) {
                    if ($ind212->getRefMotifAbsence()->getCdMotiabse() == RefMotifAbsence::ABS003 || $ind212->getRefMotifAbsence()->getCdMotiabse() == RefMotifAbsence::ABS004) {
                        $Ind212H += $ind212->getR21215() ?? 0;
                        $Ind212F += $ind212->getR21216() ?? 0;
                    }
                }

                $Ind213H = 0;
                $Ind213F = 0;
                foreach ($bilanSocialConsolide->getInd2131s() as $ind213) {
                    if ($ind213->getRefMotifAbsence()->getCdMotiabse() == RefMotifAbsence::ABS003 || $ind213->getRefMotifAbsence()->getCdMotiabse() == RefMotifAbsence::ABS004) {
                        $Ind213H += $ind213->getR21315() ?? 0;
                        $Ind213F += $ind213->getR21316() ?? 0;
                    }
                }

                if ($tot431H > ($Ind211H + $Ind212H + $Ind213H)) {
                    $message = $this->get('translator')->trans('ind431acteviolencephysiquehomme');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("431idTr_1");
                    $incoherenceLog->setTableNum("4.3.1");
                    $incoherenceLog->setIdToggle1("toggle431");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd431 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if ($tot431F > ($Ind211F + $Ind212F + $Ind213F)) {

                    $message = $this->get('translator')->trans('ind431acteviolencephysiquefemme');
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("431idTr_3");
                    $incoherenceLog->setTableNum("4.3.1");
                    $incoherenceLog->setIdToggle1("toggle431");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("5");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd431 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
        }

        $blIncoConditions411 = 0;
        if ($bilanSocialConsolide->getInd411s()->Count() == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd411(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd411(0);
            $blIncoConditions411 = 1;
        }
        else if ($blIncoInd411 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd411(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd411(50);
            $blIncoConditions411 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd411(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd411(100);
            $blIncoConditions411 = 4;
        }

        $blIncoConditions414 = 0;
        if ($bilanSocialConsolide->getR4141() == "" && $bilanSocialConsolide->getR4142() == "" && $blIncoInd414 !== null) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd414(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd414(0);
            $blIncoConditions414 = 1;
        }
        else if ($blIncoInd414 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd414(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd414(50);
            $blIncoConditions414 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd414(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd414(100);
            $blIncoConditions414 = 4;
        }

        $blIncoConditions421 = 0;
        if ($bilanSocialConsolide->getInd421s()->Count() == 0) {

            // pas de donnees
            $bilanSocialConsolide->setBlIncoInd421(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd421(0);
            $blIncoConditions421 = 1;
        }
        else if ($blIncoInd421 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd421(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd421(50);
            $blIncoConditions421 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd421(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd421(100);
            $blIncoConditions421 = 4;
        }

        $blIncoConditions422 = 0;
        if ($bilanSocialConsolide->getInd422s()->Count() == 0) {
            // pas de donnees
            $bilanSocialConsolide->setBlIncoInd422(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd422(0);
            $blIncoConditions422 = 1;
        }
        else if ($blIncoInd422 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd422(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd422(50);
            $blIncoConditions422 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd422(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd422(100);
            $blIncoConditions422 = 4;
        }

        $blIncoConditions424 = 0;
        if ($bilanSocialConsolide->getInd424s()->Count() == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd424(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd424(0);
            $blIncoConditions424 = 1;
        }
        else if ($blIncoInd424 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd424(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd424(50);
            $blIncoConditions424 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd424(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd424(100);
            $blIncoConditions424 = 4;
        }

        $blIncoConditions431 = 0;
        if ($bilanSocialConsolide->getInd431s()->Count() == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd431(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd431(0);
            $blIncoConditions431 = 1;
        }
        else if ($blIncoInd431 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd431(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd431(50);
            $blIncoConditions431 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd431(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd431(100);
            $blIncoConditions431 = 4;
        }

        $blIncoConditions = 0;
        if ($blIncoConditions411 == 3 || $blIncoConditions414 == 3 || $blIncoConditions421 == 3  || $blIncoConditions422 == 3
                || $blIncoConditions424 == 3 || $blIncoConditions431 == 3) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoConditions = 3;
        }
        elseif ($blIncoConditions411 == 2 || $blIncoConditions414 == 2 || $blIncoConditions421 == 2 || $blIncoConditions422 == 2
                || $blIncoConditions424 == 2 || $blIncoConditions431 == 2) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoConditions = 2;
        }
        elseif ($blIncoConditions411 == 1 && $blIncoConditions414 == 1 && $blIncoConditions421 == 1 && $blIncoConditions422 == 1
                && $blIncoConditions424 == 1 && $blIncoConditions431 == 1) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoConditions = 1;
        }
        elseif ($blIncoConditions411 == 4 && $blIncoConditions414 == 4 && $blIncoConditions421 == 4 && $blIncoConditions422 == 4
                && $blIncoConditions424 == 4 && $blIncoConditions431 == 4) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoConditions = 4;
        }
        $bilanSocialConsolide->setBlIncoConditions($blIncoConditions);
    }

    protected function UpdateIncoherenceFormationLog($bilanSocialConsolide, $questionCollectiviteConsolide) {

        $categories = $this->getEntityManager()->getRepository('ReferencielBundle:RefCategorie')->findByAllWithOrder();

        // 5111
        $blIncoInd5111 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true || $questionCollectiviteConsolide->getQ3() == true ) {
            foreach ($bilanSocialConsolide->getInd5111s() as $ind5111) {
                $idCate = $ind5111->getRefCategorie()->getIdCate();
                $lbCate = $ind5111->getRefCategorie()->getLbCate();

                $total111H = 0;
                $total111F = 0;
                $total121H = 0;
                $total121F = 0;

                foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                    if($idCate == $ind111->getRefGrade()->getRefCadreEmploi()->getRefCategorie()->getIdCate()) {
                        $total111H += $ind111->getR1115(0);
                        $total111F += $ind111->getR1116(0);
                    }
                }

                foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                    if($idCate == $ind121->getRefCadreEmploi()->getRefCategorie()->getIdCate()) {
                        $total121H += $ind121->getR12114(0) + $ind121->getR12115(0);
                        $total121F += $ind121->getR12116(0) + $ind121->getR12117(0);
                    }
                }

                if ($ind5111->getR51111(0) > $total111H) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5111idTr_" . json_encode($idCate));
                    $incoherenceLog->setTableNum("5.1.1.1");
                    $incoherenceLog->setIdToggle1("toggle5111");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5111categ.consolide111H.incoherencelog', array('lbcate' => $lbCate)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd5111 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if ($ind5111->getR51112(0) > $total111F) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5111idTr_" . json_encode($idCate));
                    $incoherenceLog->setTableNum("5.1.1.1");
                    $incoherenceLog->setIdToggle1("toggle5111");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5111categ.consolide111F.incoherencelog', array('lbcate' => $lbCate)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd5111 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if ($ind5111->getR51113(0) > $total121H) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5111idTr_" . json_encode($idCate));
                    $incoherenceLog->setTableNum("5.1.1.1");
                    $incoherenceLog->setIdToggle1("toggle5111");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5111categ.consolide121H.incoherencelog', array('lbcate' => $lbCate)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd5111 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if ($ind5111->getR51114(0) > $total121F) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5111idTr_" . json_encode($idCate));
                    $incoherenceLog->setTableNum("5.1.1.1");
                    $incoherenceLog->setIdToggle1("toggle5111");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5111categ.consolide121F.incoherencelog', array('lbcate' => $lbCate)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd5111 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }

        }

        $blIncoFormation5111 = 0;
        if ($bilanSocialConsolide->getInd5111s()->Count() == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd5111(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd5111(0);
            $blIncoFormation5111 = 1;
        }
        else if ($blIncoInd5111 == 1) {
            $bilanSocialConsolide->setBlIncoInd5111(2);
            $bilanSocialConsolide->setBlIncoInd5111(50);
            $blIncoFormation5111 = 2;
        }
        else if ($blIncoInd5111 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd5111(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd5111(50);
            $blIncoFormation5111 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd5111(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd5111(100);
            $blIncoFormation5111 = 4;
        }



        // 5112
        $blIncoInd5112 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true || $questionCollectiviteConsolide->getQ3() == true ) {
            foreach ($bilanSocialConsolide->getInd5112s() as $ind5112) {
                $idCate = $ind5112->getRefCategorie()->getIdCate();
                $lbCate = $ind5112->getRefCategorie()->getLbCate();
                $lbForm = $ind5112->getRefFormation()->getLbForm();
                $idForm = $ind5112->getRefFormation()->getIdForm();

                if($ind5112->getR51125(0) > ($ind5112->getR51121(0) + $ind5112->getR51122(0) + $ind5112->getR51123(0)+ $ind5112->getR51124(0)) ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5112idTr_" . json_encode($idCate) . "_" . json_encode($idForm));
                    $incoherenceLog->setTableNum("5.1.1.2");
                    $incoherenceLog->setIdToggle1("toggle5112");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5112categ.totalCPF1.incoherencelog', array('lbcate' => $lbCate, 'lbForm' => $lbForm)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd5112 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if($ind5112->getR51128(0) > ($ind5112->getR51126(0) + $ind5112->getR51127(0)) ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5112idTr_" . json_encode($idCate) . "_" . json_encode($idForm));
                    $incoherenceLog->setTableNum("5.1.1.2");
                    $incoherenceLog->setIdToggle1("toggle5112");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5112categ.totalCPF2.incoherencelog', array('lbcate' => $lbCate, 'lbForm' => $lbForm)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd5112 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if( ($ind5112->getR51126(0) + $ind5112->getR51127(0)) !=
                                        ($ind5112->getR51121(0) + $ind5112->getR51122(0) + $ind5112->getR51123(0)+ $ind5112->getR51124(0) ) ) {
//                    $incoherenceLog = new IncoherenceLog();
//                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
//                    $incoherenceLog->setField("5112idTr_" . json_encode($idCate) . "_" . json_encode($idForm));
//                    $incoherenceLog->setTableNum("5.1.1.2");
//                    $incoherenceLog->setIdToggle1("toggle5112");
//                    $incoherenceLog->setForm("6");
//                    $incoherenceLog->setIdToggle2("");
//                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5112categ.totaux.incoherencelog', array('lbcate' => $lbCate, 'lbForm' => $lbForm)));
//                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
//                    $incoherenceLog->setBlIncoherence(true);
//                    $blIncoInd5112 = 2;
//                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }

            foreach ($categories as $categorie) {
                $total5112H = 0;
                $total5112F = 0;

                $total5111FoncH = 0;
                $total5111FoncF = 0;

                $idCate = $categorie->getIdCate();
                $lbCate = $categorie->getLbCate();

                foreach ($bilanSocialConsolide->getInd5111s() as $ind5111) {
                    if($categorie->getIdCate() == $ind5111->getRefCategorie()->getIdCate()) {
                        $total5111FoncH += $ind5111->getR51111(0);
                        $total5111FoncF += $ind5111->getR51112(0);
                    }
                }

                foreach ($bilanSocialConsolide->getInd5112s() as $ind5112) {
                    if($categorie->getIdCate() == $ind5112->getRefCategorie()->getIdCate()) {
                        $total5112H += $ind5112->getR51126(0);
                        $total5112F += $ind5112->getR51127(0);
                    }
                }

                //error_log($categorie->getIdCate() .  " - ----------------------------------" );
                //error_log('total5112H =' .$total5112H);
                //error_log('total5112F =' .$total5112F);
                //error_log('total5113H =' .$total5113H);
                //error_log('total5113F =' .$total5113F);
                //error_log('total5111FoncH =' .$total5111FoncH);
                //error_log('total5111FoncF =' .$total5111FoncF);
                //error_log('total5111ContrH =' .$total5111ContrH);
                //error_log('total5111ContrF =' .$total5111ContrF);

                if($total5112H < $total5111FoncH) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalCateg5112_" . json_encode($idCate));
                    $incoherenceLog->setTableNum("5.1.1.2");
                    $incoherenceLog->setIdToggle1("toggle5112");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5112Hcateg.ind5111H.incoherencelog', array('lbcate' => $lbCate)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total5112H == 0 && $total5111FoncH > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd5112 != 2)
                            $blIncoInd5112 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd5112 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if($total5112F < $total5111FoncF) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalCateg5112_" . json_encode($idCate));
                    $incoherenceLog->setTableNum("5.1.1.2");
                    $incoherenceLog->setIdToggle1("toggle5112");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5112Fcateg.ind5111F.incoherencelog', array('lbcate' => $lbCate)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total5112F == 0 && $total5111FoncF > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd5112 != 2)
                            $blIncoInd5112 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd5112 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }


            }

        }

        $blIncoFormation5112 = 0;
        if ($bilanSocialConsolide->getInd5112s()->Count() == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd5112(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd5112(0);
            $blIncoFormation5112 = 1;
        }
        else if ($blIncoInd5112 == 1) {
            $bilanSocialConsolide->setBlIncoInd5112(2);
            $bilanSocialConsolide->setMoyenneInd5112(50);
            $blIncoFormation5112 = 2;
        }
        else if ($blIncoInd5112 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd5112(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd5112(50);
            $blIncoFormation5112 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd5112(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd5112(100);
            $blIncoFormation5112 = 4;
        }

         // 5113
        $blIncoInd5113 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true || $questionCollectiviteConsolide->getQ3() == true ) {

            foreach ($bilanSocialConsolide->getInd5113s() as $ind5113) {
                $idCate = $ind5113->getRefCategorie()->getIdCate();
                $lbCate = $ind5113->getRefCategorie()->getLbCate();
                $lbForm = $ind5113->getRefFormation()->getLbForm();
                $idForm = $ind5113->getRefFormation()->getIdForm();

                if($ind5113->getR51135(0) > ($ind5113->getR51131(0) + $ind5113->getR51132(0) + $ind5113->getR51133(0)+ $ind5113->getR51134(0)) ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5113idTr_" . json_encode($idCate) . "_" . json_encode($idForm));
                    $incoherenceLog->setTableNum("5.1.1.3");
                    $incoherenceLog->setIdToggle1("toggle5113");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5113categ.totalCPF1.incoherencelog', array('lbcate' => $lbCate, 'lbForm' => $lbForm)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd5113 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if($ind5113->getR51138(0) > ($ind5113->getR51136(0) + $ind5113->getR51137(0)) ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5113idTr_" . json_encode($idCate) . "_" . json_encode($idForm));
                    $incoherenceLog->setTableNum("5.1.1.3");
                    $incoherenceLog->setIdToggle1("toggle5113");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5113categ.totalCPF2.incoherencelog', array('lbcate' => $lbCate, 'lbForm' => $lbForm)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd5113 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if( ($ind5113->getR51136(0) + $ind5113->getR51137(0)) !=
                                        ($ind5113->getR51131(0) + $ind5113->getR51132(0) + $ind5113->getR51133(0)+ $ind5113->getR51134(0) ) ) {
//                    $incoherenceLog = new IncoherenceLog();
//                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
//                    $incoherenceLog->setField("5113idTr_" . json_encode($idCate) . "_" . json_encode($idForm));
//                    $incoherenceLog->setTableNum("5.1.1.3");
//                    $incoherenceLog->setIdToggle1("toggle5113");
//                    $incoherenceLog->setForm("6");
//                    $incoherenceLog->setIdToggle2("");
//                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5113categ.totaux.incoherencelog', array('lbcate' => $lbCate, 'lbForm' => $lbForm)));
//                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
//                    $incoherenceLog->setBlIncoherence(true);
//                    $blIncoInd5113 = 2;
//                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }

            foreach ($categories as $categorie) {

                $total5113H = 0;
                $total5113F = 0;

                $total5111ContrH = 0;
                $total5111ContrF = 0;

                $idCate = $categorie->getIdCate();
                $lbCate = $categorie->getLbCate();

                foreach ($bilanSocialConsolide->getInd5111s() as $ind5111) {
                    if($categorie->getIdCate() == $ind5111->getRefCategorie()->getIdCate()) {
                        $total5111ContrH += $ind5111->getR51113(0);
                        $total5111ContrF += $ind5111->getR51114(0);
                    }
                }

                foreach ($bilanSocialConsolide->getInd5113s() as $ind5113) {
                    if($categorie->getIdCate() == $ind5113->getRefCategorie()->getIdCate()) {
                        $total5113H += $ind5113->getR51136(0);
                        $total5113F += $ind5113->getR51137(0);
                    }
                }

                //error_log($categorie->getIdCate() .  " - ----------------------------------" );
                //error_log('total5112H =' .$total5112H);
                //error_log('total5112F =' .$total5112F);
                //error_log('total5113H =' .$total5113H);
                //error_log('total5113F =' .$total5113F);
                //error_log('total5111FoncH =' .$total5111FoncH);
                //error_log('total5111FoncF =' .$total5111FoncF);
                //error_log('total5111ContrH =' .$total5111ContrH);
                //error_log('total5111ContrF =' .$total5111ContrF);

                if($total5113H < $total5111ContrH) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalCateg5113_" . json_encode($idCate));
                    $incoherenceLog->setTableNum("5.1.1.3");
                    $incoherenceLog->setIdToggle1("toggle5113");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5113Hcateg.ind5111H.incoherencelog', array('lbcate' => $lbCate)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total5113H == 0 && $total5111ContrH > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd5113 != 2)
                            $blIncoInd5113 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd5113 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if($total5113F < $total5111ContrF) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalCateg5113_" . json_encode($idCate));
                    $incoherenceLog->setTableNum("5.1.1.3");
                    $incoherenceLog->setIdToggle1("toggle5113");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5113Fcateg.ind5111F.incoherencelog', array('lbcate' => $lbCate)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total5113F == 0 && $total5111ContrF > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd5113 != 2)
                            $blIncoInd5113 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd5113 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }

        }

        $blIncoFormation5113 = 0;
        if ($bilanSocialConsolide->getInd5113s()->Count() == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd5113(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd5113(0);
            $blIncoFormation5113 = 1;
        }
        else if ($blIncoInd5113 == 1) {
            $bilanSocialConsolide->setBlIncoInd5113(2);
            $bilanSocialConsolide->setMoyenneInd5113(50);
            $blIncoFormation5113 = 2;
        }
        else if ($blIncoInd5113 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd5113(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd5113(50);
            $blIncoFormation5113 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd5113(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd5113(100);
            $blIncoFormation5113 = 4;
        }



        $blIncoInd512 = 0;
        if ($questionCollectiviteConsolide->getQ5() == true) {

            foreach ($bilanSocialConsolide->getInd5121s() as $ind5121) {
                $idEmplnonperm = $ind5121->getRefEmploiNonPermanent()->getIdEmplnonperm();
                $lbEmplnonperm = $ind5121->getRefEmploiNonPermanent()->getLbEmplnonperm();

                if($ind5121->getR51215(0) > ($ind5121->getR51211(0) + $ind5121->getR51212(0) + $ind5121->getR51213(0)+ $ind5121->getR51214(0)) ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5121idTr_" . json_encode($idEmplnonperm));
                    $incoherenceLog->setTableNum("5.1.2.2");
                    $incoherenceLog->setIdToggle1("toggle521");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5121enp.totalCPF1.incoherencelog', array('lbEmplnonperm' => $lbEmplnonperm)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd512 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if($ind5121->getR51218(0) > ($ind5121->getR51216(0) + $ind5121->getR51217(0)) ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5121idTr_" . json_encode($idEmplnonperm));
                    $incoherenceLog->setTableNum("5.1.2.2");
                    $incoherenceLog->setIdToggle1("toggle521");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5121enp.totalCPF2.incoherencelog', array('lbEmplnonperm' => $lbEmplnonperm)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd512 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if( ($ind5121->getR51216(0) + $ind5121->getR51217(0)) >
                                        ($ind5121->getR51211(0) + $ind5121->getR51212(0) + $ind5121->getR51213(0)+ $ind5121->getR51214(0) ) ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5121idTr_" . json_encode($idEmplnonperm));
                    $incoherenceLog->setTableNum("5.1.2.2");
                    $incoherenceLog->setIdToggle1("toggle521");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5121enp.totaux.incoherencelog', array('lbEmplnonperm' => $lbEmplnonperm)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd512 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }

            $refEmplNonPerms = $this->getEntityManager()->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findAll();

            foreach ($refEmplNonPerms as $enp) {
                $total512H = 0;
                $total512F = 0;
                $total131H = 0;
                $total131F = 0;

                $idEmplnonperm = $enp->getIdEmplnonperm();
                $lbEmplnonperm = $enp->getLbEmplnonperm();

                foreach ($bilanSocialConsolide->getInd5122s() as $ind5122) {
                    if($idEmplnonperm == $ind5122->getRefEmploiNonPermanent()->getIdEmplnonperm()) {
                        $total512H += $ind5122->getR51221(0);
                        $total512F += $ind5122->getR51222(0);
                    }
                }

                foreach ($bilanSocialConsolide->getInd1311s() as $ind1311) {
                    if($idEmplnonperm == $ind1311->getRefEmploiNonPermanent()->getIdEmplnonperm()) {
                        $total131H += $ind1311->getR13111(0);
                        $total131F += $ind1311->getR13112(0);
                    }
                }

                if($total512H > $total131H) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5122idTr_" . json_encode($idEmplnonperm));
                    $incoherenceLog->setTableNum("5.1.2.1");
                    $incoherenceLog->setIdToggle1("toggle512");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5121Henp.ind131H.incoherencelog', array('lbEmplnonperm' => $lbEmplnonperm)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd512 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                if($total512F > $total131F) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("5122idTr_" . json_encode($idEmplnonperm));
                    $incoherenceLog->setTableNum("5.1.2.1");
                    $incoherenceLog->setIdToggle1("toggle512");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind5121Fenp.ind131F.incoherencelog', array('lbEmplnonperm' => $lbEmplnonperm)));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd512 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

            }

        }

        $blIncoInd514 = 0;
        $saisie514 = 1;

        if( $bilanSocialConsolide->getR5141() === null && $bilanSocialConsolide->getR5142() === null && $bilanSocialConsolide->getR5143() === null && $bilanSocialConsolide->getR5144() === null) {
            $saisie514 = 0;
        }

        if ($questionCollectiviteConsolide->getQ1() == true || $questionCollectiviteConsolide->getQ5() == true) {
            //if($saisie514) {
                $total114 = 0;
                foreach ($bilanSocialConsolide->getInd114s() as $ind114) {
                    $total114 += $ind114->getR1143(0) + $ind114->getR1144(0);
                }
                $total124 = 0;
                foreach ($bilanSocialConsolide->getInd124s() as $ind124) {
                    $total124 += $ind124->getR1243(0) + $ind124->getR1244(0);
                }


                $total111 = 0;
                foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                    $total111 += $ind111->getR1111(0);
                }
                $total121 = 0;
                foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                    $total121 += $ind121->getR1219(0);
                }

                //Somme 1.1.1 (1) + 1.2.1 (9) > 1, alors il faut une donnée sur la ligne 10
                if( ($total111 + $total121) > 0 && ($bilanSocialConsolide->getR5141() == null || $bilanSocialConsolide->getR5141() == 0)) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("idTr1");
                    $incoherenceLog->setTableNum("5.1.4");
                    $incoherenceLog->setIdToggle1("toggle514");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind514_ligne1.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd514 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }

                $total51121 = 0;//B49
                $total51122 = 0;//C49
                $total51123 = 0;//D49
                $total51124 = 0;//E49

                $total5121 = 0;//B25
                $total5122 = 0;//C25
                $total5123 = 0;//D25
                $total5124 = 0;//E25


                foreach ($bilanSocialConsolide->getInd5112s() as $ind5112) {
                    $total51121 += $ind5112->getR51121(0);
                    $total51122 += $ind5112->getR51122(0);
                    $total51123 += $ind5112->getR51123(0);
                    $total51124 += $ind5112->getR51124(0);
                }

                foreach ($bilanSocialConsolide->getInd5121s() as $ind5121) {
                    $total5121 += $ind5121->getR51211(0);
                    $total5122 += $ind5121->getR51212(0);
                    $total5123 += $ind5121->getR51213(0);
                    $total5124 += $ind5121->getR51214(0);
                }


                if( ($total51122 + $total5122) > 0 && ($bilanSocialConsolide->getR5142() == null || $bilanSocialConsolide->getR5142() == 0) ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("idTr2");
                    $incoherenceLog->setTableNum("5.1.4");
                    $incoherenceLog->setIdToggle1("toggle514");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind514_ligne2.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd514 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }



                $total5141 = 0;
                if( $bilanSocialConsolide->getR5141() != null) $total5141 = $bilanSocialConsolide->getR5141();
                $total5142 = 0;
                if( $bilanSocialConsolide->getR5142() != null) $total5142 = $bilanSocialConsolide->getR5142();
                $total5143 = 0;
                if( $bilanSocialConsolide->getR5143() != null) $total5143 = $bilanSocialConsolide->getR5143();
                $total5144 = 0;
                if( $bilanSocialConsolide->getR5144() != null) $total5144 = $bilanSocialConsolide->getR5144();

                $total514 = $total5141 + $total5142 + $total5143 + $total5144;

                $total3451 = $bilanSocialConsolide->getR3451();
                if($total3451 == null) $total3451 = 0;

                if( $total514 > $total3451) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("totalGlo");
                    $incoherenceLog->setTableNum("5.1.4");
                    $incoherenceLog->setIdToggle1("toggle514");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind514_lignetot.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd514 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }


                // Si 5.1.1 (2) B49 + 5.1.2 (1) B25 > 0 ; 5.1.4 C10 > 0
                if( ($total51121 + $total5121) > 0 && $total5141 == 0 ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("idTr1");
                    $incoherenceLog->setTableNum("5.1.4");
                    $incoherenceLog->setIdToggle1("toggle514");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind514_ligne1_51X.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd514 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }


                //- Si 5.1.1 (2) C49 + 5.1.2 (1) C25 > 0 ; 5.1.4 C11 > 0
                if( ($total51122 + $total5122) > 0 && $total5142 == 0 ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("idTr2");
                    $incoherenceLog->setTableNum("5.1.4");
                    $incoherenceLog->setIdToggle1("toggle514");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind514_ligne2_51X.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd514 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }


                //- Si 5.1.1 (2) E49 + 5.1.2 (1) E25 > 0 ; 5.1.4 C12 > 0
                if( ($total51124 + $total5124) > 0 && $total5143 == 0 ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("idTr3");
                    $incoherenceLog->setTableNum("5.1.4");
                    $incoherenceLog->setIdToggle1("toggle514");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind514_ligne3_51X.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd514 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }


                //- Si 5.1.1 (2) E49 + 5.1.2 (1) E25 > 0 ; 5.1.4 C13 > 0
               /* if( ($total51124 + $total5124) > 0 && $total5144 == 0 ) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("idTr4");
                    $incoherenceLog->setTableNum("5.1.4");
                    $incoherenceLog->setIdToggle1("toggle514");
                    $incoherenceLog->setForm("6");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($this->get('translator')->trans('ind514_ligne4_51X.incoherencelog'));
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd514 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }*/
            //}

        }

        $blIncoFormation512 = 0;
        if ($bilanSocialConsolide->getInd5121s()->Count() == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd512(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd512(0);
            $blIncoFormation512 = 1;
        }
        else if ($blIncoInd512 == 1) {
            $bilanSocialConsolide->setBlIncoInd512(2);
            $bilanSocialConsolide->setBlIncoInd512(50);
            $blIncoFormation512 = 2;
        }
        else if ($blIncoInd512 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd512(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd512(50);
            $blIncoFormation512 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd512(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd512(100);
            $blIncoFormation512 = 4;
        }

        $blIncoFormation514 = 0;
        if ($saisie514 == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd514(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd514(0);
            $blIncoFormation514 = 1;
        }
        else if ($blIncoInd514 == 1) {
            $bilanSocialConsolide->setBlIncoInd514(2);
            $bilanSocialConsolide->setBlIncoInd514(50);
            $blIncoFormation514 = 2;
        }
        else if ($blIncoInd514 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd514(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd514(50);
            $blIncoFormation514 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd514(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd514(100);
            $blIncoFormation514 = 4;
        }


        $blIncoFormation = 0;
        if ($blIncoFormation5111 == 3 || $blIncoFormation5112 == 3 || $blIncoFormation5113 == 3 || $blIncoFormation512 == 3
                    || $blIncoFormation514 == 3) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoFormation = 3;
        }
        elseif ($blIncoFormation5111 == 2 || $blIncoFormation5112 == 2 || $blIncoFormation5113 == 2 || $blIncoFormation512 == 2
                    || $blIncoFormation514 == 2) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoFormation = 2;
        }
        elseif ($blIncoFormation5111 == 1 && $blIncoFormation5112 == 1 && $blIncoFormation5113 == 1 && $blIncoFormation512 == 1
                     && $blIncoFormation514 == 1) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoFormation = 1;
        }
        elseif ($blIncoFormation5111 == 4 && $blIncoFormation5112 == 4 && $blIncoFormation5113 == 4 && $blIncoFormation512 == 4
                    && $blIncoFormation514 == 4) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoFormation = 4;
        }
        $bilanSocialConsolide->setBlIncoFormation($blIncoFormation);

    }

    protected function UpdateIncoherenceDroitLog($bilanSocialConsolide, $questionCollectiviteConsolide) {


        // 714
        $blIncoInd714 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true || $questionCollectiviteConsolide->getQ3() == true ) {
            if ($bilanSocialConsolide->getInd7141s() != null && $bilanSocialConsolide->getInd7141s()->count() > 0) {
                foreach ($bilanSocialConsolide->getInd7141s() as $ind7141) {
                    $idCate7141 = $ind7141->getRefCategorie()->getIdCate();
                    $lbCate = $ind7141->getRefCategorie()->getLbCate();

                    $tota17141 = $ind7141->getR71411(0) + $ind7141->getR71412(0);
                    $total = 0;
                    if ($bilanSocialConsolide->getInd111s() != null && $bilanSocialConsolide->getInd111s()->count() > 0) {
                        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                            if($ind111->getRefGrade()->getRefCadreEmploi()->getRefCategorie()->getIdCate() == $idCate7141) {
                                $total += $ind111->getR1115(0) + $ind111->getR1116(0);
                            }
                        }
                    }

                    $total121 = 0;
                    if ($bilanSocialConsolide->getInd121s() != null && $bilanSocialConsolide->getInd121s()->count() > 0) {
                        foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                            if($ind121->getRefCadreEmploi()->getRefCategorie()->getIdCate() == $idCate7141) {
                                $total += $ind121->getR1211(0) + $ind121->getR1212(0) + $ind121->getR1213(0) + $ind121->getR1214(0) +
                                         $ind121->getR1216(0) + $ind121->getR1215(0) + $ind121->getR1217(0) + $ind121->getR1218(0) + $ind121->getR12118(0);
                            }
                        }
                    }

                    if($total == 0 && $tota17141 > 0 ) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("7141idTr_" . json_encode($idCate7141));
                        $incoherenceLog->setTableNum("7.1.4.1");
                        $incoherenceLog->setIdToggle1("toggle714");
                        $incoherenceLog->setForm("7");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind7141categ.totaux.incoherencelog', array('lbcate' => $lbCate)));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd714 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }

                }

                foreach ($bilanSocialConsolide->getInd7142s() as $ind7142) {
                    $idCate7142 = $ind7142->getRefCategorie()->getIdCate();
                    $lbCate = $ind7142->getRefCategorie()->getLbCate();

                    $tota17142 = $ind7142->getR71421(0) + $ind7142->getR71422(0);
                    $total = 0;
                    if ($bilanSocialConsolide->getInd111s() != null && $bilanSocialConsolide->getInd111s()->count() > 0) {
                        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                            if($ind111->getRefGrade()->getRefCadreEmploi()->getRefCategorie()->getIdCate() == $idCate7142) {
                                $total += $ind111->getR1115(0) + $ind111->getR1116(0);
                            }
                        }
                    }

                    $total121 = 0;
                    if ($bilanSocialConsolide->getInd121s() != null && $bilanSocialConsolide->getInd121s()->count() > 0) {
                        foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                            if($ind121->getRefCadreEmploi()->getRefCategorie()->getIdCate() == $idCate7142) {
                                $total += $ind121->getR1211(0) + $ind121->getR1212(0) + $ind121->getR1213(0) + $ind121->getR1214(0) +
                                         $ind121->getR1216(0) + $ind121->getR1215(0) + $ind121->getR1217(0) + $ind121->getR1218(0) + $ind121->getR12118(0);
                            }
                        }
                    }

                    if($total == 0 && $tota17142 > 0 ) {
                        $incoherenceLog = new IncoherenceLog();
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setField("7142idTr_" . json_encode($idCate7142));
                        $incoherenceLog->setTableNum("7.1.4.2");
                        $incoherenceLog->setIdToggle1("toggle714");
                        $incoherenceLog->setForm("7");
                        $incoherenceLog->setIdToggle2("");
                        $incoherenceLog->setMessage($this->get('translator')->trans('ind7142categ.totaux.incoherencelog', array('lbcate' => $lbCate)));
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd714 = 2;
                        $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                    }

                }

            }

        }

        $blIncoDroit714 = 0;
        if ($bilanSocialConsolide->getQS7141() === null && $bilanSocialConsolide->getQS7142() === null && $bilanSocialConsolide->getQP7143() === null && $bilanSocialConsolide->getQP7144() === null) {
 //            pas de donnees
            $bilanSocialConsolide->setBlIncoInd714(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd714(0);
            $blIncoDroit714 = 1;
        }
        else if ($blIncoInd714 == 1) {
            $bilanSocialConsolide->setBlIncoInd714(2);
            $bilanSocialConsolide->setMoyenneInd714(50);
            $blIncoDroit714 = 2;
        }
        else if ($blIncoInd714 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd714(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd714(50);
            $blIncoDroit714 = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd714(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd714(100);
            $blIncoDroit714 = 4;
        }



        $blIncoDroit = 0;
        if ($blIncoDroit714 == 3 ) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoDroit = 3;
        }
        elseif ($blIncoDroit714 == 2 ) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoDroit = 2;
        }
        elseif ($blIncoDroit714 == 1 ) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoDroit = 1;
        }
        elseif ($blIncoDroit714 == 4 ) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoDroit = 4;
        }
        $bilanSocialConsolide->setBlIncoDroit($blIncoDroit);
    }


    protected function UpdateIncoherenceRassctLog($bilanSocialConsolide, $questionCollectiviteConsolide) {       

        $bscRAccident2SansArret         = 0;
        $bscRAccident2AvecArret         = 0;
        $totalBscRAccident2             = 0;

        $bscRAccident1SansArret         = 0;
        $bscRAccident1AvecArret         = 0;
        $totalBscRAccident1             = 0;

        $totalRNbAccidentsSurvenus      = 0;
        $totalRNbJourArretAccidents     = 0;

        $totalRNbAccidentNLSansArret    = 0;
        $totalRNbAccidentNLAvecArret    = 0;
        $totalRNbAccidentNL             = 0;
        $totalRNbJourArretNL            = 0;

        $totalRNbAccidentSL             = 0; 
        $totalRNbJourArretSL            = 0;

        $totalRNbAccidentEM             = 0;  
        $totalRNbJourArretEM            = 0;

        $totalBscRAccidentAvecArret     = 0;
        $blIncoRassctAccidentTravail    = 0;


        if ($bilanSocialConsolide->getBscRassctAccidentTravails() != null && $bilanSocialConsolide->getBscRassctAccidentTravails()->count() > 0) {
            foreach ($bilanSocialConsolide->getBscRassctAccidentTravails() as $bscRassctAccidentTravail) {
                $totalBscRAccident1 += $bscRassctAccidentTravail->getRAccident1(0);
                $totalBscRAccident2 += $bscRassctAccidentTravail->getRAccident2(0);
            }   
            $bscRassctAccidentTravails = $bilanSocialConsolide->getBscRassctAccidentTravails();
            $bscRAccident1SansArret    = $bscRassctAccidentTravails[0]->getRAccident1(0);
            $bscRAccident2SansArret    = $bscRassctAccidentTravails[0]->getRAccident2(0);
            for($i=1; $i<sizeof($bscRassctAccidentTravails); $i++){
                $bscRAccident1AvecArret += $bscRassctAccidentTravails[$i]->getRAccident1(0);
                $bscRAccident2AvecArret += $bscRassctAccidentTravails[$i]->getRAccident2(0);
            }
        }

        if ($bilanSocialConsolide->getBscRassctNbAccidentTravails() != null && $bilanSocialConsolide->getBscRassctNbAccidentTravails()->count() > 0) {
            foreach ($bilanSocialConsolide->getBscRassctNbAccidentTravails() as $bscRassctNbAccidentTravails) {
                $totalRNbAccidentsSurvenus   += $bscRassctNbAccidentTravails->getRNbAccidentsSurvenus(0);
                $totalRNbJourArretAccidents  += $bscRassctNbAccidentTravails->getRNbJourArretAccidents(0);
            }
        }

        if ($bilanSocialConsolide->getBscRassctNatureLesions() != null && $bilanSocialConsolide->getBscRassctNatureLesions()->count() > 0) {
            foreach ($bilanSocialConsolide->getBscRassctNatureLesions() as $bscRassctNL) {
                $totalRNbAccidentNLSansArret += $bscRassctNL->getRNbAccidentSansArret(0);
                $totalRNbAccidentNLAvecArret += $bscRassctNL->getRNbAccidentAvecArret(0);
                $totalRNbJourArretNL         += $bscRassctNL->getRNbJourArret(0);
            }
            $totalRNbAccidentNL = $totalRNbAccidentNLSansArret + $totalRNbAccidentNLAvecArret;
        }

        if ($bilanSocialConsolide->getBscRassctSiegeLesions() != null && $bilanSocialConsolide->getBscRassctSiegeLesions()->count() > 0) {     
            foreach ($bilanSocialConsolide->getBscRassctSiegeLesions() as $bscRassctSiegeLesion) {
                $totalRNbAccidentSL  += $bscRassctSiegeLesion->getRNbAccident(0);
                $totalRNbJourArretSL += $bscRassctSiegeLesion->getRNbJourArret(0);              
            } 
        }      

        if ($bilanSocialConsolide->getBscRassctElementMateriels() != null && $bilanSocialConsolide->getBscRassctElementMateriels()->count() > 0) {   
            foreach ($bilanSocialConsolide->getBscRassctElementMateriels() as $bscRassctElementMateriel) {
                $totalRNbAccidentEM  += $bscRassctElementMateriel->getRNbAccident(0);
                $totalRNbJourArretEM += $bscRassctElementMateriel->getRNbJourArret(0);       
            } 
        }    
        
       /* $totalBscRAccidentAvecArret = $bscRAccident1AvecArret + $bscRAccident2AvecArret ;*/

        if ($totalBscRAccident2 < $totalRNbAccidentsSurvenus) {
            $incoherenceLog = new IncoherenceLog();
            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
            $incoherenceLog->setField("total");
            $incoherenceLog->setTableNum("Nombre d'accidents");
            $incoherenceLog->setIdToggle1("toggle_nb_accident_travail");
            $incoherenceLog->setForm("8"); 
            $incoherenceLog->setIdToggle2("");
            $incoherenceLog->setMessage($this->get('translator')->trans('rassct_totalRNbAccidentsSurvenus.incoherencelog'));
            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
            $incoherenceLog->setBlIncoherence(true);
            $blIncoRassctAccidentTravail = 2;
            $blIncoRassctNbAccidentTravail = 2;
            $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
        }

        if ($totalBscRAccident2 < $totalRNbAccidentNL) {
            $incoherenceLog = new IncoherenceLog();
            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
            $incoherenceLog->setField("total");
            $incoherenceLog->setTableNum("Nature Lésions");
            $incoherenceLog->setIdToggle1("toggle_nature_lesion");
            $incoherenceLog->setForm("8"); 
            $incoherenceLog->setIdToggle2("");
            $incoherenceLog->setMessage($this->get('translator')->trans('rassct_totalRNbAccidentNL.incoherencelog'));
            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
            $incoherenceLog->setBlIncoherence(true);
            $blIncoRassctAccidentTravail = 2;
            $blIncoRassctNatureLesion = 2;
            $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
        }

        if ($totalBscRAccident2 < $totalRNbAccidentSL){
            $incoherenceLog = new IncoherenceLog();
            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
            $incoherenceLog->setField("totalGlo");
            $incoherenceLog->setTableNum("Siège Lésions");
            $incoherenceLog->setIdToggle1("toggle_siege_lesion");
            $incoherenceLog->setIdToggle2("");
            $incoherenceLog->setMessage($this->get('translator')->trans('rassct_totalRNbAccidentSL.incoherencelog'));
            $incoherenceLog->setForm("8");
            $incoherenceLog->setBlIncoherence(true);
            $blIncoRassctAccidentTravail = 2;
            $blIncoRassctSiegeLesion = 2;
            $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
        }  

        if ($totalBscRAccident2 < $totalRNbAccidentEM ){
            $incoherenceLog = new IncoherenceLog();
            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
            $incoherenceLog->setField("totalGlo");
            $incoherenceLog->setTableNum("Eléments Matériels");
            $incoherenceLog->setIdToggle1("toggle_element_materiel");
            $incoherenceLog->setIdToggle2("");
            $incoherenceLog->setMessage($this->get('translator')->trans('rassct_totalRNbAccidentEM.incoherencelog'));
            $incoherenceLog->setForm("8");
            $incoherenceLog->setBlIncoherence(true);
            $blIncoRassctAccidentTravail = 2;
            $blIncoRassctElementMateriel = 2;
            $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
        }  

        if ($bscRAccident2SansArret < $totalRNbAccidentNLSansArret) {
            $incoherenceLog = new IncoherenceLog();
            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
            $incoherenceLog->setField("total");
            $incoherenceLog->setTableNum("Nature Lésions");
            $incoherenceLog->setIdToggle1("toggle_nature_lesion");
            $incoherenceLog->setForm("8"); 
            $incoherenceLog->setIdToggle2("");
            $incoherenceLog->setMessage($this->get('translator')->trans('rassct_totalRNbAccidentNLSansArret.incoherencelog'));
            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
            $incoherenceLog->setBlIncoherence(true);
            $blIncoRassctAccidentTravail = 2;
            $blIncoRassctNatureLesion = 2;
            $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
        }

        if ($bscRAccident2AvecArret < $totalRNbAccidentNLAvecArret) {
            $incoherenceLog = new IncoherenceLog();
            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
            $incoherenceLog->setField("total");
            $incoherenceLog->setTableNum("Nature Lésions");
            $incoherenceLog->setIdToggle1("toggle_nature_lesion");
            $incoherenceLog->setForm("8"); 
            $incoherenceLog->setIdToggle2("");
            $incoherenceLog->setMessage($this->get('translator')->trans('rassct_totalRNbAccidentNLAvecArret.incoherencelog'));
            $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
            $incoherenceLog->setBlIncoherence(true);
            $blIncoRassctAccidentTravail = 2;
            $blIncoRassctNatureLesion = 2;
            $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
        }

        $blIncoRassctDureeArrets = 0;
        if ($bilanSocialConsolide->getBscRassctAccidentTravails()->Count() == 0) {

            // pas de donnees
            $bilanSocialConsolide->setBlIncoRassctAccidentTravail(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneRassctAccidentTravail(0);
            $blIncoRassctDureeArrets = 1;
        }
        else if ($blIncoRassctAccidentTravail == 1) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoRassctAccidentTravail(2); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneRassctAccidentTravail(50);
            $blIncoRassctDureeArrets = 2;
        }
        else if ($blIncoRassctAccidentTravail == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoRassctAccidentTravail(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneRassctAccidentTravail(50);
            $blIncoRassctDureeArrets = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoRassctAccidentTravail(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneRassctAccidentTravail(100);
            $blIncoRassctDureeArrets = 4;
        }


        $blIncoRassctTypeActivite = 0;
        if ($bilanSocialConsolide->getBscRassctNbAccidentTravails()->Count() == 0) {

            // pas de donnees
            $bilanSocialConsolide->setBlIncoRassctNbAccidentTravail(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneRassctNbAccidentTravail(0);
            $blIncoRassctTypeActivite = 1;
        }
        else if ($blIncoRassctNbAccidentTravail == 1) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoRassctNbAccidentTravail(2); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneRassctNbAccidentTravail(50);
            $blIncoRassctTypeActivite = 2;
        }
        else if ($blIncoRassctNbAccidentTravail == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoRassctNbAccidentTravail(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneRassctNbAccidentTravail(50);
            $blIncoRassctTypeActivite = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoRassctNbAccidentTravail(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneRassctNbAccidentTravail(100);
            $blIncoRassctTypeActivite = 4;
        }


        $blIncoRassctLaNatureLesion = 0;
        if ($bilanSocialConsolide->getBscRassctNatureLesions()->Count() == 0) {

            // pas de donnees
            $bilanSocialConsolide->setBlIncoRassctNatureLesion(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneRassctNatureLesion(0);
            $blIncoRassctLaNatureLesion = 1;
        }
        else if ($blIncoRassctNatureLesion == 1) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoRassctNatureLesion(2); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneRassctNatureLesion(50);
            $blIncoRassctLaNatureLesion = 2;
        }
        else if ($blIncoRassctNatureLesion == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoRassctNatureLesion(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneRassctNatureLesion(50);
            $blIncoRassctLaNatureLesion = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoRassctNatureLesion(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneRassctNatureLesion(100);
            $blIncoRassctLaNatureLesion = 4;
        }


        $blIncoRassctLeSiegeLesion = 0;
        if ($bilanSocialConsolide->getBscRassctSiegeLesions()->Count() == 0) {

            // pas de donnees
            $bilanSocialConsolide->setBlIncoRassctSiegeLesion(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneRassctSiegeLesion(0);
            $blIncoRassctLeSiegeLesion = 1;
        }
        else if ($blIncoRassctSiegeLesion == 1) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoRassctSiegeLesion(2); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneRasscSiegeLesion(50);
            $blIncoRassctLeSiegeLesion = 2;
        }
        else if ($blIncoRassctSiegeLesion == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoRassctSiegeLesion(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneRassctSiegeLesion(50);
            $blIncoRassctLeSiegeLesion = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoRassctSiegeLesion(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneRassctSiegeLesion(100);
            $blIncoRassctLeSiegeLesion = 4;
        }

        $blIncoRassctLElementMateriel = 0;
        if ($bilanSocialConsolide->getBscRassctElementMateriels()->Count() == 0) {

            // pas de donnees
            $bilanSocialConsolide->setBlIncoRassctElementMateriel(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneRassctElementMateriel(0);
            $blIncoRassctLElementMateriel = 1;
        }
        else if ($blIncoRassctSiegeLesion == 1) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoRassctElementMateriel(2); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneRasscElementMateriel(50);
            $blIncoRassctLElementMateriel = 2;
        }
        else if ($blIncoRassctSiegeLesion == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoRassctElementMateriel(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneRassctElementMateriel(50);
            $blIncoRassctLElementMateriel = 3;
        }
        else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoRassctElementMateriel(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneRassctElementMateriel(100);
            $blIncoRassctLElementMateriel = 4;
        }


        $blIncoRassct = 0;
        if ($blIncoRassctDureeArrets == 3 || $blIncoRassctTypeActivite == 3 || $blIncoRassctLaNatureLesion == 3 || $blIncoRassctLeSiegeLesion == 3 || $blIncoRassctLElementMateriel == 3) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoRassct = 3;
        }
        elseif ($blIncoRassctDureeArrets == 2 || $blIncoRassctTypeActivite == 2 || $blIncoRassctLaNatureLesion == 2 || $blIncoRassctLeSiegeLesion == 2  || $blIncoRassctLElementMateriel == 2) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoRassct = 2;
        }
        elseif ($blIncoRassctDureeArrets == 1 || $blIncoRassctTypeActivite == 1 || $blIncoRassctLaNatureLesion == 1 || $blIncoRassctLeSiegeLesion == 1  || $blIncoRassctLElementMateriel == 1) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoRassct = 1;
        }
        elseif ($blIncoRassctDureeArrets == 4 || $blIncoRassctTypeActivite == 4 || $blIncoRassctLaNatureLesion == 4 || $blIncoRassctLeSiegeLesion == 4  || $blIncoRassctLElementMateriel == 4) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoRassct = 4;
        }
        $bilanSocialConsolide->setBlIncoRassct($blIncoRassct);      
                                           
    }


    protected function UpdateIncoherenceLog($bilanSocialConsolide, $questionCollectiviteConsolide) {
        $incoherenceLogRepository = $this->getEntityManager()->getRepository('CoreBundle:IncoherenceLog');
        $incoherenceLogRepository->removeOlderIncoherenceBilan($bilanSocialConsolide->getIdBilasocicons());

        $bilanSocialConsolide->setIncoherenceLogs(new ArrayCollection());

        $this->UpdateIncoherenceEffectifLog($bilanSocialConsolide, $questionCollectiviteConsolide);
        $this->UpdateIncoherenceMouvementLog($bilanSocialConsolide, $questionCollectiviteConsolide);
        $this->UpdateIncoherenceTpsTravailLog($bilanSocialConsolide, $questionCollectiviteConsolide);
        $this->UpdateIncoherenceRemunerationLog($bilanSocialConsolide, $questionCollectiviteConsolide);
        $this->UpdateIncoherenceConditionsLog($bilanSocialConsolide, $questionCollectiviteConsolide);
        $this->UpdateIncoherenceFormationLog($bilanSocialConsolide, $questionCollectiviteConsolide);
        $this->UpdateIncoherenceDroitLog($bilanSocialConsolide, $questionCollectiviteConsolide);
        $this->UpdateIncoherenceRassctLog($bilanSocialConsolide, $questionCollectiviteConsolide);
       
        $this->getEntityManager()->flush();
    }

    public function EditBilanSocialConsolideAction(Request $request) {

        $initBilanSocial = $this->getEntityManager()->getRepository('BilanSocialBundle:InitBilanSocial')
                                ->findOneBy(array('collectivite' => $this->getMaCollectivite()->getIdColl(), 'enquete' => $this->getMonEnquete()->getIdEnqu()));
        if (empty($initBilanSocial)) {
            $this->addFlash(
                    'notice', "Pas de consolidé initialisée"
            );
            $redirectionConso = $this->redirectToRoute('bilan_social_homepage');
            return $redirectionConso;
        }
        
        $bilanSocialConsolide = $this->getEntityManager()->getRepository('ConsoBundle:BilanSocialConsolide')
                    ->findOneByActif($this->getMaCollectivite()->getIdColl(),
                                     $this->getMonEnquete()->getIdEnqu());

       /* $connection_other_bdd = $this->get('bs_conso_precedent_preparator')->getBddConnection(2017);
        $ancien_bilan_social_consolide = $connection_other_bdd->getRepository('ConsoBundle:BilanSocialConsolide')
            ->findOneByActif($this->getMaCollectivite()->getIdColl(),
                $this->getMonEnquete()->getIdEnqu());
        dump($ancien_bilan_social_consolide);*/

        try {
            $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);
            return $this->render('@Conso/BilanSocialConsolide/edit.html.twig', array('bilanConso' => $bilanSocialConsolide, 'questionCollectiviteConsolide' => new QuestionCollectiviteConsolide(), 'nombreQuestion' => $nombreQuestion, 'canwrite' => $this->isUserCanWrite(), 'collectivite'=>$this->getMaCollectivite()));
        }
        catch (NotFoundHttpException $e) {
            $this->addFlash('notice', $e->getMessage());
            return $this->redirectToRoute('homepage');
        }
    }

    public function ConsolideBackToApaAction() {
        $this->getEntityManager()->transactional(function($em) {
            $bilanSocialConsolide = $em->getRepository('ConsoBundle:BilanSocialConsolide')
                    ->findOneByActif($this->getMaCollectivite()->getIdColl(),
                                     $this->getMonEnquete()->getIdEnqu());

            // enregistrement table historique bs -> changement type bs + retour à en cours de saisie
            $this->chgtEtatBilanSocial(0, $this->getMaCollectivite(), $this->getMonEnquete());

            $query = "CALL consolide_delete_value (:idColl, :idEnqu)";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->bindParam(':idColl',$idColl,PDO::PARAM_INT);
            $stmt->bindParam(':idEnqu',$idEnqu,PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
            $this->getEntityManager()->flush();
            $this->getEntityManager()->clear();

            $initBilanSocial = $this->getEntityManager()->getRepository('BilanSocialBundle:InitBilanSocial')
                                ->findOneBy(array('collectivite' => $this->getMaCollectivite()->getIdColl(), 'enquete' => $this->getMonEnquete()->getIdEnqu()));
            $initBilanSocial->setBlCons(false);
            
            $em->flush();
        });
        $redirection = $this->redirectToRoute('bilansocialagent_index');
        return $redirection;
    }

    public function ApaToConsoAction(Request $request) {
        $collectivite = $this->getMaCollectivite();
        $enquete = $this->getMonEnquete();
        $idColl = $collectivite->getIdColl();
        $idEnqu = $enquete->getIdEnqu();
        $blAffiColl = $collectivite->getBlAffiColl();
        if ($blAffiColl == true) {
            $blAffiCollInt = 1;
        }
        elseif ($blAffiColl == false || $blAffiColl == null) {
            $blAffiCollInt = 0;
        }

        $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
        try {


            //$query = "CALL apa2cons (" . $collectivite->getIdColl() . "," . $enquete->getIdEnqu() . "," . $blAffiCollInt . ")";
            $query = "CALL apa2cons (:idColl, :idEnqu, :blAffiCollInt)";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->bindParam(':idColl',$idColl,PDO::PARAM_INT);
            $stmt->bindParam(':idEnqu',$idEnqu,PDO::PARAM_INT);
            $stmt->bindParam(':blAffiCollInt',$blAffiCollInt);
            $stmt->execute();
            $stmt->closeCursor();


            $this->getEntityManager()->flush();
            $this->getEntityManager()->clear();

            $bilanSocialConsolide = $this->getMonBilanSocialConsolide(false);
            $questionnaire = new QuestionCollectiviteConsolide();

            $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

            
            $initBilanSocial = $this->getEntityManager()->getRepository('BilanSocialBundle:InitBilanSocial')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
            $initBilanSocial->setBlCons(true);
            $initBilanSocial->setBlApa(true);
            $this->getEntityManager()->flush();
        
            $this->getEntityManager()->getConnection()->commit();
            

            //exit;
        } catch (\Exception $e) {

            $this->getEntityManager()->getConnection()->rollBack();
            error_log("Error Message ". $e->getMessage(), 0);
            error_log("Error " . $e->getTraceAsString(), 0);
            $this->addFlash('notice', $e->getMessage());

            $redirection = $this->redirectToRoute('bilansocialagent_index');
            return $redirection;
        }
        
        //$redirection = $this->redirectToRoute('bilansocialagent_index');
        $redirectionConso = $this->redirectToRoute('bilan_conso_edit');
        return $redirectionConso;
        //return $this->EditBilanSocialConsolideAction($request);

    }

    public function DgclToConsoAction(Request $request) {
        $collectivite = $this->getMaCollectivite();
        $enquete = $this->getMonEnquete();
        $idColl = $collectivite->getIdColl();
        $idEnqu = $enquete->getIdEnqu();
        $cdUtil = $this->getUser()->getUsername();
        $idUtil = $this->getUser()->getIdUtil();//1;

        $campagne = $this->getMaCampagne();
        $annee_campagne = $campagne->getNmAnne();

        $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
        try {
            //
            // Lecture du fichier en memoire
            $fichier = $request->get('fichier');
            $fichierTab = explode("\n", $fichier);

            $firstLine = "";

            foreach ($fichierTab as $line) {
                $firstLine = str_replace("\n",'',$line);
                break;
            }

            $firstLine = str_replace("\r",'',$firstLine); ;
            $firstLine = str_replace("\r\n", '', $firstLine);

            $fileYear = substr($firstLine, 14, 4);
            if ($fileYear != $annee_campagne) {
                $response = new JsonResponse();
                $response->setContent(json_encode(array('message' => "wrongYear", "annee_campagne" => $annee_campagne)));
                return $response; 
            }

            if (strlen($firstLine) < 14) {
                $response = new JsonResponse();
                $response->setContent(json_encode(array('message' => "incorrectFile")));
                return $response;
            }
            else if (substr($firstLine, 0, 14) != $cdUtil) {
                $response = new JsonResponse();
                $response->setContent(json_encode(array('message' => "wrongNmSiret")));
                return $response;
            }

            error_log('First Lines : ' . $firstLine . '-END');

            error_log('idColl = ' . $idColl);
            error_log('idEnqu = ' . $idEnqu);

            $query = "CALL bs_batchs.DGCL_import_initialise(:idColl,:idEnqu,:idUtil,:firstLine, @pIdImpHeader); ";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->bindParam(':idColl',$idColl,PDO::PARAM_INT);
            $stmt->bindParam(':idEnqu',$idEnqu,PDO::PARAM_INT);
            $stmt->bindParam(':idUtil',$idUtil,PDO::PARAM_INT);
            $stmt->bindParam(':firstLine',$firstLine);
            $stmt->execute();

            $idImpHeader = null;
            $rowset = $stmt->fetchAll(\PDO::FETCH_NUM);


            foreach ($rowset as $item){
                // Result set de l'idBilaSociConso
                error_log(json_encode($item), 0);
            }

            $stmt->getWrappedStatement()->nextRowset();
            $rowset2 = $stmt->fetchAll(\PDO::FETCH_NUM);

            foreach ($rowset2 as $item2){
                // Result set de l'idImpHeader
                error_log(json_encode($item2), 0);
                $idImpHeader = $item2[0];
            }

            $stmt->closeCursor();

            error_log('idImpHeader : ' . $idImpHeader);

            $first = 1;
            $nbLineTraite = 0;

            foreach ($fichierTab as $line) {
                if($first == 1) {
                    $first = 0;
                    continue;
                }

                $lineAutre = str_replace("\n",'',$line);
                $lineAutre = str_replace("\r",'',$lineAutre); ;
                $lineAutre = str_replace("\r\n",'',$lineAutre);

                $nmSiretOfLine = substr($lineAutre, 0, 14);
                if ($lineAutre != "") {
                    if ($nmSiretOfLine == $cdUtil) {

                        $query2 = "CALL bs_batchs.DGCL_import_add_one_row_to(:idImpHeader,:lineAutre)";
                        $stmt2 = $this->getEntityManager()->getConnection()->prepare($query2);
                        $stmt2->bindParam(':idImpHeader', $idImpHeader);
                        $stmt2->bindParam(':lineAutre', $lineAutre);
                        $stmt2->execute();
                        $stmt2->closeCursor();

                        $nbLineTraite++;
                    }
                    else {
                        $response = new JsonResponse();
                        $response->setContent(json_encode(array('message' => "wrongNmSiret")));
                        return $response;
                    }
                }
            }
            error_log('nbLineTraite : ' . $nbLineTraite);

            $query3 = "CALL bs_batchs.DGCL_import_process (:idImpHeader, :flag)";
            $stmt3 = $this->getEntityManager()->getConnection()->prepare($query3);
            $stmt3->bindParam(':idImpHeader',$idImpHeader);
            $stmt3->bindValue(':flag',"%");
            $stmt3->execute();
            $stmt3->closeCursor();

            error_log('end');
            $this->getEntityManager()->flush();
            $this->getEntityManager()->clear();

            $bilanSocialConsolide = $this->getMonBilanSocialConsolide(false);
            $questionnaire = new QuestionCollectiviteConsolide();

            $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

            $initBilanSocial = $this->getEntityManager()->getRepository('BilanSocialBundle:InitBilanSocial')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));

            if($initBilanSocial == null) {
                $initBilanSocial = new InitBilanSocial();
                error_log("new initBilanSoci");
            }

            $this->getEntityManager()->flush();
            $this->getEntityManager()->getConnection()->commit();

        } catch (\Exception $e) {
            $this->getEntityManager()->getConnection()->rollBack();
            error_log("Error Message ". $e->getMessage(), 0);
            error_log("Error " . $e->getTraceAsString(), 0);

            $response = new JsonResponse();
            $response->setContent(json_encode(array('message' =>$e->getMessage())));
            return $response;
        }

        $response = new JsonResponse();
        $response->setContent(json_encode(array('message' => "Import DGCL réussi")));
        return $response;

    }


    public function transmettreAction(Request $request = null, $idBilaSociCons = null) {




        $contactService = $this->get('Bilan_Social.ContactBundle.Services.Contact');
        $user = $this->getUser();

        if ($idBilaSociCons != null) {
            $idBS = $idBilaSociCons;
        }
        else {
            $idBS = $request->get('idBS');
        }


        $em = $this->getDoctrine()->getManager();
        $res = $em->getRepository('ConsoBundle:BilanSocialConsolide')->find($idBS);

        $collectvite = $res->getCollectivite();
        $enquete = $res->getEnquete();
       
        if ($res->getFgStat() == 0) {
            $res->setFgStat(1);
            $etat = 1;
        }
        elseif ($res->getFgStat() == 4 || $res->getFgStat() == 3) {
            $res->setFgStat(5);
            $etat = 5;
        }else{
            $etat  = $res->getFgStat();
        }
        $envoiMail = $contactService->sendEmailInterneAppli('TRANSBLC', null, null);
        if ($envoiMail == true) {
            $resultat = 'done';
            $this->chgtEtatBilanSocial($etat, $collectvite, $enquete);
            }
        else {
            $resultat = "erreur";
        }

        $response = new Response();
        $response->setContent(json_encode($resultat));

        return $response;

    }

    public function validerAction(Request $request) {
        $contactService = $this->get('Bilan_Social.ContactBundle.Services.Contact');
        $idBS = $request->get('idBS');
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();

        $res = $em->getRepository('ConsoBundle:BilanSocialConsolide')->findOneByIdBilasocicons($idBS);

        $collectvite = $res->getCollectivite();
        $enquete = $res->getEnquete();
        $idColl = $collectvite->getIdColl();
        $res->setFgStat(2);
        $res->setDtModi(new \DateTime());
        $res->setCdUtilmodi($current_user->getUsername());

        $this->chgtEtatBilanSocial(2, $collectvite, $enquete);

        try {
//            $em->persist($res);
//            $em->flush();
//
//            $this->addFlash('notice', $this->get('translator')->trans('valide.consolide.flash'));
            $envoiMail = $contactService->valideOuRefusBilanSocial($idColl, 'VALIDEBLC');
            $resultat = 'done';
        }
        catch (Exception $ex) {
            $resultat = $ex;
            $this->addFlash('notice', $this->get('translator')->trans('erreur.consolide.flash'));
        }


        $response = new Response();
        $response->setContent(json_encode($resultat));

        return $response;
    }

    public function deverrouillerAction(Request $request) {
        $contactService = $this->get('Bilan_Social.ContactBundle.Services.Contact');
        $idBS = $request->get('idBS');
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();

        $res = $em->getRepository('ConsoBundle:BilanSocialConsolide')->find($idBS);

        $collectivite = $res->getCollectivite();
        $enquete = $res->getEnquete();
        $idColl = $collectivite->getIdColl();
        $res->setFgStat(0);
        $res->setDtModi(new \DateTime());
        $res->setCdUtilmodi($current_user->getUsername());

        $this->chgtEtatBilanSocial(0, $collectivite, $enquete);

        try {
            $em->persist($res);
            $em->flush();

            $this->addFlash('notice', $this->get('translator')->trans('deverrouiller.consolide.flash'));

            $resultat = 'done';
        }
        catch (Exception $ex) {
            $resultat = $ex;
            $this->addFlash('notice', $this->get('translator')->trans('erreur.consolide.flash'));
        }

        $response = new Response();
        $response->setContent(json_encode($resultat));

        return $response;
    }

    public function refuserAction(Request $request) {
        $contactService = $this->get('Bilan_Social.ContactBundle.Services.Contact');
        $idBS = $request->get('idBS');
        $sendEmail = $request->get('sendEmail');
        
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();

        $res = $em->getRepository('ConsoBundle:BilanSocialConsolide')->find($idBS);

        $collectvite = $res->getCollectivite();
        $enquete = $res->getEnquete();
        $idColl = $collectvite->getIdColl();

        $res->setFgStat(3);
        $res->setDtModi(new \DateTime());
        $res->setCdUtilmodi($current_user->getUsername());

        $this->chgtEtatBilanSocial(3, $collectvite, $enquete);

        try {
            $em->persist($res);
            $em->flush();

            $this->addFlash('notice', $this->get('translator')->trans('refuse.consolide.flash'));
            if ($sendEmail == "true") {
                $contactService->valideOuRefusBilanSocial($idColl, 'REFUSBLC');
            }
            $resultat = 'done';
        }
        catch (Exception $ex) {
            $resultat = $ex;
            $this->addFlash('notice', $this->get('translator')->trans('erreur.consolide.flash'));
        }


        $response = new Response();
        $response->setContent(json_encode($resultat));

        return $response;
    }

    public function getNumberQuestion($bilanSocialConsolide = null){

        $em = $this->getDoctrine()->getManager();
        $collectivite = $this->getMaCollectivite();

        /*initialisation du nombre de question presentes a 0 par defaut */
        $effectifs = 0;
        $mouvement = 0;
        $remuneration = 0;
        $tempsDeTravail = 0;
        $conditions = 0;
        $droit = 0;
        $handitorial = 0;
        $gpeec = 0;
        $rassct = 0;
        $formation = 0;
        $dgcl = 0;


        /*initialisation des tableaux vide par onglet */
        $onglet_effectif = ["pgInd" => array()];
        $onglet_mouvement = ["pgInd" => array()];
        $onglet_remuneration = ["pgInd" => array()];
        $onglet_absencetempstravail = ["pgInd" => array()];
        $onglet_condition = ["pgInd" => array()];
        $onglet_droit = ["pgInd" => array()];
        $onglet_handitorial = ["pgInd" => array()];
        $onglet_gpeec = ["pgInd" => array()];
        $onglet_rassct = ["pgInd" => array()];
        $onglet_formation = ["pgInd" => array()];
        $onglet_dgcl = ["pgInd" => array()];

        $array_pc_ind = array();


        /* initialisation des totaux pour les progresses bar a 0 par defaut */
        $array_pc_ind['pcEffectif'] = 0;
        $array_pc_ind['pcConditions'] = 0;
        $array_pc_ind['pcFormation'] = 0;
        $array_pc_ind['pcMouvement'] = 0;
        $array_pc_ind['pcTempsdetravail'] = 0;
        $array_pc_ind['pcRemuneration'] = 0;
        $array_pc_ind['pcDroit'] = 0;
        $array_pc_ind['pcGpeec'] = 0;
        $array_pc_ind['pcRassct'] = 0;
        $array_pc_ind['pcHanditorial'] = 0;
        $array_pc_ind['pcDgcl'] = 0;




        $enqueteCollectivite = $this->getMonEnqueteCollectiviteActive();
        $questionnaireCollectivite = new QuestionCollectiviteConsolide();

        if($bilanSocialConsolide == null){
            $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        }

        if($enqueteCollectivite->getBlBilaSoci() == true){

            $effectifs += 2;
            array_push($onglet_effectif['pgInd'],array('ind' => 140, 'blinco' => $bilanSocialConsolide->getBlIncoInd140(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd140()));
            array_push($onglet_effectif['pgInd'],array('ind' => 132, 'blinco' => $bilanSocialConsolide->getBlIncoInd132(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd132()));
            $array_pc_ind['pcEffectif'] += $bilanSocialConsolide->getMoyenneInd132() + $bilanSocialConsolide->getMoyenneInd140();

            $conditions += 1;
            array_push($onglet_condition['pgInd'],array('ind' => 425, 'blinco' => $bilanSocialConsolide->getBlIncoInd425(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd425()));
            $array_pc_ind['pcConditions'] += $bilanSocialConsolide->getMoyenneInd425() + $bilanSocialConsolide->getMoyenneInd425();

            $remuneration += 4;
            array_push($onglet_remuneration['pgInd'],array('ind' => 341, 'blinco' => $bilanSocialConsolide->getBlIncoInd341(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd341()));
            array_push($onglet_remuneration['pgInd'],array('ind' => 342, 'blinco' => $bilanSocialConsolide->getBlIncoInd342(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd342()));
            array_push($onglet_remuneration['pgInd'],array('ind' => 343, 'blinco' => $bilanSocialConsolide->getBlIncoInd343(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd343()));
            array_push($onglet_remuneration['pgInd'],array('ind' => 344, 'blinco' => $bilanSocialConsolide->getBlIncoInd344(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd344()));
            $array_pc_ind['pcRemuneration'] = $bilanSocialConsolide->getMoyenneInd341() + $bilanSocialConsolide->getMoyenneInd342() + $bilanSocialConsolide->getMoyenneInd342() + $bilanSocialConsolide->getMoyenneInd344();

            $droit += 1;
            $array_pc_ind['pcDroit'] += $bilanSocialConsolide->getMoyenneInd614();
            array_push($onglet_droit['pgInd'],array('ind' => 614, 'blinco' => $bilanSocialConsolide->getBlIncoInd614(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd614()));

            $tempsDeTravail += 2;
            $array_pc_ind['pcTempsdetravail'] += $bilanSocialConsolide->getMoyenneInd210();
            $array_pc_ind['pcTempsdetravail'] += $bilanSocialConsolide->getMoyenneInd227();

            array_push($onglet_absencetempstravail['pgInd'],array('ind' => 210, 'blinco' => $bilanSocialConsolide->getBlIncoInd210(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd210()));
            array_push($onglet_absencetempstravail['pgInd'],array('ind' => 227, 'blinco' => $bilanSocialConsolide->getBlIncoInd227(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd227()));
        }
        if($enqueteCollectivite->getBlRast() == true){
            $rassct = 12;
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctAccidentTravail();
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctAutresMesures();
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctElementMateriel();
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctMaladieProCaracPro();
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctNatureLesion();
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctNbAccidentTravail();
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctNbMaladiePro();
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctPredictionsAutresMesures();
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctPrevisionFormationSanteTravail();
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctRealisationFormationSanteTravail();
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctSiegeLesion();
            $array_pc_ind['pcRassct'] += $bilanSocialConsolide->getMoyenneRassctInformationCollectivite();

            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctAccidentTravail', 'blinco' => $bilanSocialConsolide->getBlIncoRassctAccidentTravail(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctAccidentTravail()));
            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctAutresMesures', 'blinco' => $bilanSocialConsolide->getBlIncoRassctAutresMesures(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctAutresMesures()));
            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctElementMateriel', 'blinco' => $bilanSocialConsolide->getBlIncoRassctElementMateriel(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctElementMateriel()));
            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctMaladieProCaracPro', 'blinco' => $bilanSocialConsolide->getBlIncoRassctMaladieProCaracPro(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctMaladieProCaracPro()));
            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctNatureLesion', 'blinco' => $bilanSocialConsolide->getBlIncoRassctNatureLesion(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctNatureLesion()));
            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctNbAccidentTravail', 'blinco' => $bilanSocialConsolide->getBlIncoRassctNbAccidentTravail(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctNbAccidentTravail()));
            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctNbMaladiePro', 'blinco' => $bilanSocialConsolide->getBlIncoRassctNbMaladiePro(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctNbMaladiePro()));
            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctPredictionsAutresMesures', 'blinco' => $bilanSocialConsolide->getBlIncoRassctPredictionsAutresMesures(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctPredictionsAutresMesures()));
            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctPrevisionFormationSanteTravail', 'blinco' => $bilanSocialConsolide->getBlIncoRassctPrevisionFormationSanteTravail(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctPrevisionFormationSanteTravail()));
            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctRealisationFormationSanteTravail', 'blinco' => $bilanSocialConsolide->getBlIncoRassctRealisationFormationSanteTravail(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctRealisationFormationSanteTravail()));
            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctSiegeLesion', 'blinco' => $bilanSocialConsolide->getBlIncoRassctSiegeLesion(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctSiegeLesion()));
            array_push($onglet_rassct['pgInd'],array('ind' => 'RassctInformationCollectivite', 'blinco' => $bilanSocialConsolide->getBlIncoRassctInformationCollectivite(), 'moyenne' => $bilanSocialConsolide->getMoyenneRassctInformationCollectivite()));

        }


        if($enqueteCollectivite->getBlBilaSoci() == true || $enqueteCollectivite->getBlRast()) {
            $tempsDeTravail += 1;
            $array_pc_ind['pcTempsdetravail'] += $bilanSocialConsolide->getMoyenneInd225();
            array_push($onglet_absencetempstravail['pgInd'], array('ind' => 225, 'blinco' => $bilanSocialConsolide->getBlIncoInd225(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd225()));
        }

        if($enqueteCollectivite->getBlGepe() == true) {
            $gpeec += 2;
            $array_pc_ind['pcGpeec'] = $bilanSocialConsolide->getMoyenneGpeecNbAgentsTituEmpPermaParFoncEtAge() + $bilanSocialConsolide->getMoyenneGpeecNiveauDiplome();
            array_push($onglet_gpeec['pgInd'], array('ind' => 'GpeecNbAgentsTituEmpPermaParFoncEtAge', 'blinco' => $bilanSocialConsolide->getBlIncoGpeecNbAgentsTituEmpPermaParFoncEtAge(), 'moyenne' => $bilanSocialConsolide->getMoyenneGpeecNbAgentsTituEmpPermaParFoncEtAge()));
            array_push($onglet_gpeec['pgInd'], array('ind' => 'GpeecNiveauDiplome', 'blinco' => $bilanSocialConsolide->getBlIncoGpeecNiveauDiplome(), 'moyenne' => $bilanSocialConsolide->getMoyenneGpeecNiveauDiplome()));
        }
        if(!empty($questionnaireCollectivite)){
            if($questionnaireCollectivite->getQ4() == true){
                $effectifs += 1;
                $array_pc_ind['pcEffectif'] += $bilanSocialConsolide->getMoyenneInd121();
                array_push($onglet_effectif['pgInd'],array('ind' => 121, 'blinco' => $bilanSocialConsolide->getBlIncoInd121(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd121()));

                if($enqueteCollectivite->getBlBilaSoci() == true){
                    $effectifs += 2;
                    array_push($onglet_effectif['pgInd'],array('ind' => 122, 'blinco' => $bilanSocialConsolide->getBlIncoInd122(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd122()));
                    array_push($onglet_effectif['pgInd'],array('ind' => 123, 'blinco' => $bilanSocialConsolide->getBlIncoInd123(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd123()));
                    $array_pc_ind['pcEffectif'] += $bilanSocialConsolide->getMoyenneInd122() + $bilanSocialConsolide->getMoyenneInd123();
                }
            }
            if($questionnaireCollectivite->getQ5() == true){
                if($enqueteCollectivite->getBlBilaSoci() == true) {
                    $formation += 1;
                    $array_pc_ind['pcFormation'] += $bilanSocialConsolide->getMoyenneInd512();
                    array_push($onglet_formation['pgInd'], array('ind' => 512, 'blinco' => $bilanSocialConsolide->getBlIncoInd512(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd512()));
                }
                if($enqueteCollectivite->getBlBilaSoci() == true) {
                    $remuneration += 1;
                    $array_pc_ind['pcRemuneration'] += $bilanSocialConsolide->getMoyenneInd331();
                    array_push($onglet_remuneration['pgInd'], array('ind' => 331, 'blinco' => $bilanSocialConsolide->getBlIncoInd331(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd331()));
                }
                if($enqueteCollectivite->getBlBilaSoci() == true || $enqueteCollectivite->getBlRast()) {
                    $tempsDeTravail += 1;
                    $array_pc_ind['pcTempsdetravail'] += $bilanSocialConsolide->getMoyenneInd213();
                    array_push($onglet_absencetempstravail['pgInd'],array('ind' => 213, 'blinco' => $bilanSocialConsolide->getBlIncoInd213(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd213()));
                }
            }
            if($questionnaireCollectivite->getQ3() == true || $questionnaireCollectivite->getQ1() == true){
                if($enqueteCollectivite->getBlBilaSoci() == true){
                    $formation += 4;
                    $array_pc_ind['pcFormation'] += $bilanSocialConsolide->getMoyenneInd5111() + $bilanSocialConsolide->getMoyenneInd5112() + $bilanSocialConsolide->getMoyenneInd5113() + $bilanSocialConsolide->getMoyenneInd514();
                    array_push($onglet_formation['pgInd'],array('ind' => 5111, 'blinco' => $bilanSocialConsolide->getBlIncoInd5111(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd5111()));
                    array_push($onglet_formation['pgInd'],array('ind' => 5112, 'blinco' => $bilanSocialConsolide->getBlIncoInd5112(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd5112()));
                    array_push($onglet_formation['pgInd'],array('ind' => 5113, 'blinco' => $bilanSocialConsolide->getBlIncoInd5113(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd5113()));
                    array_push($onglet_formation['pgInd'],array('ind' => 514, 'blinco' => $bilanSocialConsolide->getBlIncoInd514(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd514()));

                }
                if($enqueteCollectivite->getBlBilaSoci() == true || $enqueteCollectivite->getBlHand()) {
                    $conditions += 2;
                    $array_pc_ind['pcConditions'] += $bilanSocialConsolide->getMoyenneInd423() + $bilanSocialConsolide->getMoyenneInd424();
                    array_push($onglet_condition['pgInd'], array('ind' => 423, 'blinco' => $bilanSocialConsolide->getBlIncoInd423(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd423()));
                    array_push($onglet_condition['pgInd'], array('ind' => 424, 'blinco' => $bilanSocialConsolide->getBlIncoInd424(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd424()));
                }
                if($enqueteCollectivite->getBlBilaSoci() == true || $enqueteCollectivite->getBlRast()) {
                    $tempsDeTravail += 3;
                    $array_pc_ind['pcTempsdetravail'] += $bilanSocialConsolide->getMoyenneInd214() + $bilanSocialConsolide->getMoyenneInd215() + $bilanSocialConsolide->getMoyenneInd216();
                    array_push($onglet_absencetempstravail['pgInd'], array('ind' => 214, 'blinco' => $bilanSocialConsolide->getBlIncoInd214(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd214()));
                    array_push($onglet_absencetempstravail['pgInd'], array('ind' => 215, 'blinco' => $bilanSocialConsolide->getBlIncoInd215(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd215()));
                    array_push($onglet_absencetempstravail['pgInd'], array('ind' => 216, 'blinco' => $bilanSocialConsolide->getBlIncoInd216(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd216()));
                }
                if($enqueteCollectivite->getBlBilaSoci() == true){
                    $droit += 1;
                    $array_pc_ind['pcDroit'] += $bilanSocialConsolide->getMoyenneInd714();
                    array_push($onglet_droit['pgInd'],array('ind' => 714, 'blinco' => $bilanSocialConsolide->getBlIncoInd714(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd714()));
                }

            }
            if($questionnaireCollectivite->getQ1() == true || $questionnaireCollectivite->getQ3() == true || $questionnaireCollectivite->getQ5() == true){
                if($enqueteCollectivite->getBlBilaSoci() == true){
                    $formation += 1;
                    $array_pc_ind['pcFormation'] += $bilanSocialConsolide->getMoyenneInd513();
                    array_push($onglet_formation['pgInd'],array('ind' => 513, 'blinco' => $bilanSocialConsolide->getBlIncoInd513(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd513()));

                }
                 if($enqueteCollectivite->getBlBilaSoci() == true || $enqueteCollectivite->getBlRast()){
                    $conditions += 5;
                    $array_pc_ind['pcConditions'] += $bilanSocialConsolide->getMoyenneInd413() + $bilanSocialConsolide->getMoyenneInd414() +
                        $bilanSocialConsolide->getMoyenneInd421() + $bilanSocialConsolide->getMoyenneInd422() + $bilanSocialConsolide->getMoyenneInd431();
                    array_push($onglet_condition['pgInd'],array('ind' => 413, 'blinco' => $bilanSocialConsolide->getBlIncoInd413(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd413()));
                    array_push($onglet_condition['pgInd'],array('ind' => 414, 'blinco' => $bilanSocialConsolide->getBlIncoInd414(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd414()));
                    array_push($onglet_condition['pgInd'],array('ind' => 421, 'blinco' => $bilanSocialConsolide->getBlIncoInd421(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd421()));
                    array_push($onglet_condition['pgInd'],array('ind' => 422, 'blinco' => $bilanSocialConsolide->getBlIncoInd422(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd422()));
                    array_push($onglet_condition['pgInd'],array('ind' => 431, 'blinco' => $bilanSocialConsolide->getBlIncoInd431(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd431()));

                    $tempsDeTravail += 1;
                    $array_pc_ind['pcTempsdetravail'] += $bilanSocialConsolide->getMoyenneInd217();
                    array_push($onglet_absencetempstravail['pgInd'],array('ind' => 217, 'blinco' => $bilanSocialConsolide->getBlIncoInd217(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd217()));


                }
                $tempsDeTravail += 1;
                $array_pc_ind['pcTempsdetravail'] += $bilanSocialConsolide->getMoyenneInd231();
                array_push($onglet_absencetempstravail['pgInd'],array('ind' => 231, 'blinco' => $bilanSocialConsolide->getBlIncoInd231(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd231()));
                if($enqueteCollectivite->getBlBilaSoci() == true) {
                    $remuneration += 1;
                    $array_pc_ind['pcRemuneration'] += $bilanSocialConsolide->getMoyenneInd345();
                    array_push($onglet_remuneration['pgInd'], array('ind' => 345, 'blinco' => $bilanSocialConsolide->getBlIncoInd345(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd345()));
                }
               if($enqueteCollectivite->getBlBilaSoci() == true){
                    $droit += 4;
                    $array_pc_ind['pcDroit'] += $bilanSocialConsolide->getMoyenneInd613() + $bilanSocialConsolide->getMoyenneInd711() +
                        $bilanSocialConsolide->getMoyenneInd712() + $bilanSocialConsolide->getMoyenneInd713();
                    array_push($onglet_droit['pgInd'],array('ind' => 613, 'blinco' => $bilanSocialConsolide->getBlIncoInd613(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd613()));
                    array_push($onglet_droit['pgInd'],array('ind' => 711, 'blinco' => $bilanSocialConsolide->getBlIncoInd711(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd711()));
                    array_push($onglet_droit['pgInd'],array('ind' => 712, 'blinco' => $bilanSocialConsolide->getBlIncoInd712(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd712()));
                    array_push($onglet_droit['pgInd'],array('ind' => 713, 'blinco' => $bilanSocialConsolide->getBlIncoInd713(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd713()));
                }

                if($collectivite->getRefTypeCollectivite()->getCdTypeColl() == 'CDG' || $collectivite->getBlAffiColl() == null || $collectivite->getBlAffiColl() == false ){
                    if($enqueteCollectivite->getBlBilaSoci() == true){
                        $droit += 1;
                        $array_pc_ind['pcDroit'] += $bilanSocialConsolide->getMoyenneInd612();
                        array_push($onglet_droit['pgInd'],array('ind' => 612, 'blinco' => $bilanSocialConsolide->getBlIncoInd612(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd612()));
                    }
                }
            }
            if($questionnaireCollectivite->getQ3() == true){
                if($enqueteCollectivite->getBlBilaSoci() == true) {
                    $remuneration += 1;
                    $array_pc_ind['pcRemuneration'] += $bilanSocialConsolide->getMoyenneInd321();
                    array_push($onglet_remuneration['pgInd'],array('ind' => 321, 'blinco' => $bilanSocialConsolide->getBlIncoInd321(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd321()));
                }
                   if($enqueteCollectivite->getBlBilaSoci() == true || $enqueteCollectivite->getBlRast()) {
                    $tempsDeTravail += 1;
                    $array_pc_ind['pcTempsdetravail'] += $bilanSocialConsolide->getMoyenneInd212();
                    array_push($onglet_absencetempstravail['pgInd'],array('ind' => 212, 'blinco' => $bilanSocialConsolide->getBlIncoInd212(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd212()));
                }

                $effectifs += 1;
                $array_pc_ind['pcEffectif'] += $bilanSocialConsolide->getMoyenneInd124();
                array_push($onglet_effectif['pgInd'],array('ind' => 124, 'blinco' => $bilanSocialConsolide->getBlIncoInd124(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd124()));

            }
            if($questionnaireCollectivite->getQ8() == true && $enqueteCollectivite->getBlBilaSoci() == true ){

                array_push($onglet_effectif['pgInd'],array('ind' => 110, 'blinco' => $bilanSocialConsolide->getBlIncoInd110(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd110()));
                $array_pc_ind['pcEffectif'] += $bilanSocialConsolide->getMoyenneInd110();
                $effectifs += 1;
            }
            if($questionnaireCollectivite->getQ1() == true){
                if($enqueteCollectivite->getBlBilaSoci() == true) {
                    $remuneration += 1;
                    $array_pc_ind['pcRemuneration'] += $bilanSocialConsolide->getMoyenneInd311();
                    array_push($onglet_remuneration['pgInd'], array('ind' => 311, 'blinco' => $bilanSocialConsolide->getBlIncoInd311(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd311()));
                }
                if($enqueteCollectivite->getBlBilaSoci() == true || $enqueteCollectivite->getBlRast() == true) {
                    $tempsDeTravail += 1;
                    $array_pc_ind['pcTempsdetravail'] += $bilanSocialConsolide->getMoyenneInd211();
                    array_push($onglet_absencetempstravail['pgInd'], array('ind' => 211, 'blinco' => $bilanSocialConsolide->getBlIncoInd211(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd211()));

                    $effectifs += 1;
                    $array_pc_ind['pcEffectif'] += $bilanSocialConsolide->getMoyenneInd114();
                    array_push($onglet_effectif['pgInd'],array('ind' => 114, 'blinco' => $bilanSocialConsolide->getBlIncoInd114(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd114()));

                }

                if ($enqueteCollectivite->getBlBilaSoci() == true) {
                    $mouvement += 1;
//                    $array_pc_ind['pcMouvement'] += $bilanSocialConsolide->getMoyenneInd154() + $bilanSocialConsolide->getMoyenneInd156();
                    $array_pc_ind['pcMouvement'] += $bilanSocialConsolide->getMoyenneInd154();
                    array_push($onglet_mouvement['pgInd'],array('ind' => 154, 'blinco' => $bilanSocialConsolide->getBlIncoInd154(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd154()));

    
                    $mouvement += 2;
                    $array_pc_ind['pcMouvement'] += $bilanSocialConsolide->getMoyenneInd158();
                    array_push($onglet_mouvement['pgInd'],array('ind' => 157, 'blinco' => $bilanSocialConsolide->getBlIncoInd157(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd157()));
                    array_push($onglet_mouvement['pgInd'],array('ind' => 158, 'blinco' => $bilanSocialConsolide->getBlIncoInd158(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd158()));

                }

            }
            if($questionnaireCollectivite->getQ4() == true || $questionnaireCollectivite->getQ2() == true){

                if($enqueteCollectivite->getBlBilaSoci() == true || $enqueteCollectivite->getBlRast() == true){
                    $conditions += 1;
                    $array_pc_ind['pcConditions'] += $bilanSocialConsolide->getMoyenneInd411();
                    array_push($onglet_condition['pgInd'],array('ind' => 411, 'blinco' => $bilanSocialConsolide->getBlIncoInd411(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd411()));
                }
                if($enqueteCollectivite->getBlBilaSoci() == true){
                    $tempsDeTravail += 3;
                    $array_pc_ind['pcTempsdetravail'] += $bilanSocialConsolide->getMoyenneInd221() + $bilanSocialConsolide->getMoyenneInd222() + $bilanSocialConsolide->getMoyenneInd223();
                    array_push($onglet_absencetempstravail['pgInd'],array('ind' => 221, 'blinco' => $bilanSocialConsolide->getBlIncoInd221(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd221()));
                    array_push($onglet_absencetempstravail['pgInd'],array('ind' => 222, 'blinco' => $bilanSocialConsolide->getBlIncoInd222(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd222()));
                    array_push($onglet_absencetempstravail['pgInd'],array('ind' => 223, 'blinco' => $bilanSocialConsolide->getBlIncoInd223(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd223()));

                }

             }
             if($questionnaireCollectivite->getQ2() == true || $questionnaireCollectivite->getQ4() == true || $questionnaireCollectivite->getQ6() == true){

                 if($enqueteCollectivite->getBlBilaSoci() == true){
                     $tempsDeTravail += 1;
                     $array_pc_ind['pcTempsdetravail'] += $bilanSocialConsolide->getMoyenneInd224();
                     array_push($onglet_absencetempstravail['pgInd'],array('ind' => 224, 'blinco' => $bilanSocialConsolide->getBlIncoInd224(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd224()));
                 }
                $mouvement += 1;
                $array_pc_ind['pcMouvement'] += $bilanSocialConsolide->getMoyenneInd171();
                 array_push($onglet_mouvement['pgInd'],array('ind' => 171, 'blinco' => $bilanSocialConsolide->getBlIncoInd171(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd171()));


                if(($enqueteCollectivite->getBlBilaSoci() == true ) || ($enqueteCollectivite->getBlBilaSoci() == false && $enqueteCollectivite->getBlHand() == true)) {
                    $mouvement += 1;
                    $array_pc_ind['pcMouvement'] += $bilanSocialConsolide->getMoyenneInd161();
                    array_push($onglet_mouvement['pgInd'],array('ind' => 161, 'blinco' => $bilanSocialConsolide->getBlIncoInd161(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd161()));


                }
            }
            if($questionnaireCollectivite->getQ2() == true){
                $effectifs += 2;
                array_push($onglet_effectif['pgInd'],array('ind' => 111, 'blinco' => $bilanSocialConsolide->getBlIncoInd111(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd111()));
                array_push($onglet_effectif['pgInd'],array('ind' => 112, 'blinco' => $bilanSocialConsolide->getBlIncoInd112(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd112()));
                $array_pc_ind['pcEffectif'] += $bilanSocialConsolide->getMoyenneInd111() + $bilanSocialConsolide->getMoyenneInd112();
                if($enqueteCollectivite->getBlBilaSoci() == true){
                    $effectifs += 1;
                    $array_pc_ind['pcEffectif'] += $bilanSocialConsolide->getMoyenneInd113();
                    array_push($onglet_effectif['pgInd'],array('ind' => 113, 'blinco' => $bilanSocialConsolide->getBlIncoInd113(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd113()));
                }
            }
            if($questionnaireCollectivite->getQ5() == true || $questionnaireCollectivite->getQ6() == true){
               $effectifs += 1;
               $array_pc_ind['pcEffectif'] += $bilanSocialConsolide->getMoyenneInd131();
                array_push($onglet_effectif['pgInd'],array('ind' => 131, 'blinco' => $bilanSocialConsolide->getBlIncoInd131(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd131()));


            }
            if($enqueteCollectivite->getBlBilaSoci() == true && ($questionnaireCollectivite->getQ9() == true || $questionnaireCollectivite->getQ10() == true)) {
               $mouvement += 1;
                $array_pc_ind['pcMouvement'] += $bilanSocialConsolide->getMoyenneInd150();
                array_push($onglet_mouvement['pgInd'],array('ind' => 150, 'blinco' => $bilanSocialConsolide->getBlIncoInd150(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd150()));
            }
            if(($questionnaireCollectivite->getQ7() == true && $enqueteCollectivite->getBlBilaSoci() == true )|| ($enqueteCollectivite->getBlBilaSoci() == false && $enqueteCollectivite->getBlGepe() == true)){
                $mouvement += 1;
                $array_pc_ind['pcMouvement'] += $bilanSocialConsolide->getMoyenneInd151();
                array_push($onglet_mouvement['pgInd'],array('ind' => 151, 'blinco' => $bilanSocialConsolide->getBlIncoInd151(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd151()));
            }
            if($enqueteCollectivite->getBlBilaSoci() == true && $questionnaireCollectivite->getQ12() == true){
                $mouvement += 1;
                $array_pc_ind['pcMouvement'] += $bilanSocialConsolide->getMoyenneInd152();
                array_push($onglet_mouvement['pgInd'],array('ind' => 152, 'blinco' => $bilanSocialConsolide->getBlIncoInd152(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd152()));
            }
            if($enqueteCollectivite->getBlBilaSoci() == true && $questionnaireCollectivite->getQ13() == true){
                $mouvement += 2;
                $array_pc_ind['pcMouvement'] += $bilanSocialConsolide->getMoyenneInd1531() + $bilanSocialConsolide->getMoyenneInd1532();
                array_push($onglet_mouvement['pgInd'],array('ind' => 1531, 'blinco' => $bilanSocialConsolide->getBlIncoInd1531(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd1531()));
                array_push($onglet_mouvement['pgInd'],array('ind' => 1532, 'blinco' => $bilanSocialConsolide->getBlIncoInd1532(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd1532()));
            }

                if($collectivite->getBlCtCdg() != true){


                if ($collectivite->getRefTypeCollectivite()->getCdTypecoll() == 'CDG' ||  ( ($collectivite->getblCtCdg() != true) and (($enqueteCollectivite->getblBilaSoci() == false ) and ($enqueteCollectivite->getblRast() == true) ) || ($enqueteCollectivite->getblBilaSoci() == true)) ) {
                    if ($enqueteCollectivite->getBlBilaSoci() == true || $enqueteCollectivite->getBlRast() == true) {
                        $droit += 1;
                        $array_pc_ind['pcDroit'] += $bilanSocialConsolide->getMoyenneInd611();
                        array_push($onglet_droit['pgInd'], array('ind' => 611, 'blinco' => $bilanSocialConsolide->getBlIncoInd611(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd611()));

                    }
                }
            }
            if(($enqueteCollectivite->getBlBilaSoci() == true ) || ($enqueteCollectivite->getBlBilaSoci() == false && $enqueteCollectivite->getBlHand() == true)){
                $mouvement += 1;
                $array_pc_ind['pcMouvement'] += $bilanSocialConsolide->getMoyenneInd162();
                array_push($onglet_mouvement['pgInd'],array('ind' => 162, 'blinco' => $bilanSocialConsolide->getBlIncoInd162(), 'moyenne' => $bilanSocialConsolide->getMoyenneInd162()));
            }


        }

        
        if($enqueteCollectivite->getBlGpeecPlus() == true && $enqueteCollectivite->getBlGepe() == true ) {
            $gpeec += 1;
            $array_pc_ind['pcGpeec'] += $bilanSocialConsolide->getMoyenneGpeecPlusNbAgentsParSpeEtAge();
            array_push($onglet_gpeec['pgInd'],array('ind' => 'GpeecPlusNbAgentsParSpeEtAge', 'blinco' => $bilanSocialConsolide->getBlIncoGpeecPlusNbAgentsParSpeEtAge(), 'moyenne' => $bilanSocialConsolide->getMoyenneGpeecPlusNbAgentsParSpeEtAge()));
        }

        if($enqueteCollectivite->getBlHand() == true) {
            $handitorial += 9;
            $array_pc_ind['pcHanditorial'] += $bilanSocialConsolide->getMoyenneHanditorialQuestionsGenerales() + $bilanSocialConsolide->getMoyenneHanditorialInaptitudeEtReclassement()+ $bilanSocialConsolide->getMoyenneHanditorialQuestionsBoeths() + $bilanSocialConsolide->getMoyenneHanditorialCadreEmplois() +
                $bilanSocialConsolide->getMoyenneHanditorialMetiers() + $bilanSocialConsolide->getMoyenneHanditorialTempsComplets() + $bilanSocialConsolide->getMoyenneHanditorialInaptEtReclaCadreEmplois() + $bilanSocialConsolide->getMoyenneHanditorialInaptEtReclaMetiers() + $bilanSocialConsolide->getMoyenneHanditorialInaptEtReclaTempsComplets();

            array_push($onglet_handitorial['pgInd'],array('ind' => 'handitorialQuestionsGenerales', 'blinco' => $bilanSocialConsolide->getBlIncoHanditorialQuestionsGenerales(), 'moyenne' => $bilanSocialConsolide->getMoyenneHanditorialQuestionsGenerales()));
            array_push($onglet_handitorial['pgInd'],array('ind' => 'handitorialInaptitudeEtReclassement', 'blinco' => $bilanSocialConsolide->getBlIncoHanditorialInaptitudeEtReclassement(), 'moyenne' => $bilanSocialConsolide->getMoyenneHanditorialInaptitudeEtReclassement()));
            array_push($onglet_handitorial['pgInd'],array('ind' => 'handitorialQuestionsBoeths', 'blinco' => $bilanSocialConsolide->getBlIncoHanditorialQuestionsBoeths(), 'moyenne' => $bilanSocialConsolide->getMoyenneHanditorialQuestionsBoeths()));
            array_push($onglet_handitorial['pgInd'],array('ind' => 'handitorialCadreEmplois', 'blinco' => $bilanSocialConsolide->getBlIncoHanditorialCadreEmplois(), 'moyenne' => $bilanSocialConsolide->getMoyenneHanditorialCadreEmplois()));
            array_push($onglet_handitorial['pgInd'],array('ind' => 'handitorialMetiers', 'blinco' => $bilanSocialConsolide->getBlIncoHanditorialMetiers(), 'moyenne' => $bilanSocialConsolide->getMoyenneHanditorialMetiers()));
            array_push($onglet_handitorial['pgInd'],array('ind' => 'handitorialTempsComplets', 'blinco' => $bilanSocialConsolide->getBlIncoHanditorialTempsComplets(), 'moyenne' => $bilanSocialConsolide->getMoyenneHanditorialTempsComplets()));
            array_push($onglet_handitorial['pgInd'],array('ind' => 'handitorialInaptEtReclaCadreEmplois', 'blinco' => $bilanSocialConsolide->getBlIncoHanditorialInaptEtReclaCadreEmplois(), 'moyenne' => $bilanSocialConsolide->getMoyenneHanditorialInaptEtReclaCadreEmplois()));
            array_push($onglet_handitorial['pgInd'],array('ind' => 'handitorialInaptEtReclaMetiers', 'blinco' => $bilanSocialConsolide->getBlIncoHanditorialInaptEtReclaMetiers(), 'moyenne' => $bilanSocialConsolide->getMoyenneHanditorialInaptEtReclaMetiers()));
            array_push($onglet_handitorial['pgInd'],array('ind' => 'handitorialInaptEtReclaTempsComplets', 'blinco' => $bilanSocialConsolide->getBlIncoHanditorialInaptEtReclaTempsComplets(), 'moyenne' => $bilanSocialConsolide->getMoyenneHanditorialInaptEtReclaTempsComplets()));

        }

        if($collectivite->getBlCollDgcl()){
            $dgcl += 1;
            $array_pc_ind['pcDgcl'] += $bilanSocialConsolide->getMoyenneDgclJoursCarence();
            array_push($onglet_dgcl['pgInd'],array('ind' => 'DgclJoursCarence', 'blinco' => $bilanSocialConsolide->getBlIncoDgclJoursCarence(), 'moyenne' => $bilanSocialConsolide->getMoyenneDgclJoursCarence()));
        }

        $listeIncoh = array(
            'effectif' => array(),
            'mouvement' => array(),
            'tempstravail' => array(),
            'remuneration' => array(),
            'condition' => array(),
            'droit' => array(),
            'formation' => array(),
            'rassct' => array(),
            'gpeec' => array(),
            'handitorial' => array(),
            'dgcl' => array()
        );
    /* TODO gerer par formulaire !!! */
        if ($bilanSocialConsolide->getIncoherenceLogs() != null) {
            $i  = 0;
            foreach ($bilanSocialConsolide->getIncoherenceLogs() as $incoh) {


                    $idToggle2 = $incoh->getIdToggle2();
                    if ($idToggle2 == null)
                        $idToggle2 = "";

                    $incoherence = "0";
                    if ($incoh->getBlIncoherence() != null) {
                        if ($incoh->getBlIncoherence()) {
                            $incoherence = "1";
                        }
                    }
                    $listeIncoh_temp = array(
                        'tableNum' => $incoh->getTableNum(),
                        'idToggle1' => $incoh->getIdToggle1(),
                        'idToggle2' => $idToggle2,
                        'field' => $incoh->getField(),
                        'form' => $incoh->getForm(),
                        'incoherence' => $incoherence,
                        'message' => $incoh->getMessage()
                    );
                    if($incoh->getForm() == 1){
                        array_push($listeIncoh['effectif'], $listeIncoh_temp);
                    }
                    if($incoh->getForm() == 2){
                        array_push($listeIncoh['mouvement'], $listeIncoh_temp);
                    }
                    if($incoh->getForm() == 3){
                        array_push($listeIncoh['tempstravail'], $listeIncoh_temp);
                    }
                    if($incoh->getForm() == 4){
                        array_push($listeIncoh['remuneration'], $listeIncoh_temp);
                    }
                    if($incoh->getForm() == 5){
                        array_push($listeIncoh['condition'], $listeIncoh_temp);
                    }
                    if($incoh->getForm() == 6){
                        array_push($listeIncoh['formation'], $listeIncoh_temp);
                    }
                    if($incoh->getForm() == 7){
                        array_push($listeIncoh['droit'], $listeIncoh_temp);
                    }
                    if($incoh->getForm() == 8){
                        array_push($listeIncoh['rassct'], $listeIncoh_temp);
                    }
                    if($incoh->getForm() == 9){
                        array_push($listeIncoh['gpeec'], $listeIncoh_temp);
                    }
                    if($incoh->getForm() == 10){
                        array_push($listeIncoh['handitorial'], $listeIncoh_temp);
                    }
                    if($incoh->getForm() == 11){
                        array_push($listeIncoh['dgcl'], $listeIncoh_temp);
                    }
                }
        }


        $array_nbquestion_pc = array();
        /* initialisation du data qui sera rempli dans les controllers des indicateurs dans la fonction getResponse() */
        $array_nbquestion_pc['data'] = '';
        /* Renvoi la liste des pourcentages */

        $array_nbquestion_pc['pc'] = $array_pc_ind;


        /* renvoi les incoherences */
        $array_nbquestion_pc['list'] = $listeIncoh;
        /* renvoi le nombre de question par onglets */
        $nombreDeQuestionParOnglet = array(
            'effectifs' => $effectifs > 0 ? $effectifs : 1,
            'mouvement' => $mouvement > 0 ? $mouvement : 1,
            'tempsDeTravail' => $tempsDeTravail > 0 ? $tempsDeTravail : 1,
            'remuneration' => $remuneration > 0 ? $remuneration : 1,
            'droit' => $droit > 0 ? $droit : 1,
            'conditions' => $conditions > 0 ? $conditions : 1,
            'formation' => $formation > 0 ? $formation : 1,
            'gpeec' => $gpeec > 0 ? $gpeec : 1,
            'rassct' => $rassct > 0 ? $rassct : 1,
            'handitorial' => $handitorial > 0 ? $handitorial : 1,
            'dgcl' => $dgcl > 0 ? $dgcl : 1,
        );

        $array_moyenne_onglet = [
            'effectif' => $array_pc_ind['pcEffectif']/$nombreDeQuestionParOnglet['effectifs'],
            'mouvement' => $array_pc_ind['pcMouvement']/$nombreDeQuestionParOnglet['mouvement'],
            'remuneration' => $array_pc_ind['pcRemuneration']/$nombreDeQuestionParOnglet['remuneration'],
            'gpeec' => $array_pc_ind['pcGpeec']/$nombreDeQuestionParOnglet['gpeec'],
            'rassct' => $array_pc_ind['pcRassct']/$nombreDeQuestionParOnglet['rassct'],
            'droit' => $array_pc_ind['pcDroit']/$nombreDeQuestionParOnglet['droit'],
            'tempstravail' => $array_pc_ind['pcTempsdetravail']/$nombreDeQuestionParOnglet['tempsDeTravail'],
            'formation' => $array_pc_ind['pcFormation']/$nombreDeQuestionParOnglet['formation'],
            'condition' => $array_pc_ind['pcConditions']/$nombreDeQuestionParOnglet['conditions'],
            'handitorial' => $array_pc_ind['pcHanditorial']/$nombreDeQuestionParOnglet['handitorial'],
            'dgcl' => $array_pc_ind['pcDgcl']/$nombreDeQuestionParOnglet['dgcl'],
        ];
        $array_nbquestion_pc['nmquestion'] = $nombreDeQuestionParOnglet;
        $array_nbquestion_pc['moyenne'] = $array_moyenne_onglet;
        /* Effectif */
        $array_nbquestion_pc['effectif'] = $onglet_effectif;
        $array_nbquestion_pc['effectif']['blIncoGlobal'] = $bilanSocialConsolide->getBlIncoEff();
        /* Droit */
        $array_nbquestion_pc['droit'] = $onglet_droit;
        $array_nbquestion_pc['droit']['blIncoGlobal'] = $bilanSocialConsolide->getBlIncoDroit();
        /* Remuneration */
        $array_nbquestion_pc['remuneration'] = $onglet_remuneration;
        $array_nbquestion_pc['remuneration']['blIncoGlobal'] = $bilanSocialConsolide->getBlIncoRemuneration();
        /* Formation */
        $array_nbquestion_pc['formation'] = $onglet_formation;
        $array_nbquestion_pc['formation']['blIncoGlobal'] = $bilanSocialConsolide->getBlIncoFormation();
        /* Temps de travail */
        $array_nbquestion_pc['tempstravail'] = $onglet_absencetempstravail;
        $array_nbquestion_pc['tempstravail']['blIncoGlobal'] = $bilanSocialConsolide->getBlIncoTpsTrav();
        /* Mouvement */
        $array_nbquestion_pc['mouvement'] = $onglet_mouvement;
        $array_nbquestion_pc['mouvement']['blIncoGlobal'] = $bilanSocialConsolide->getBlIncoMouv();

        /* condition */
        $array_nbquestion_pc['condition'] = $onglet_condition;
        $array_nbquestion_pc['condition']['blIncoGlobal'] = $bilanSocialConsolide->getBlIncoConditions();

        /* gpeec */
        $array_nbquestion_pc['gpeec'] = $onglet_gpeec;
        $array_nbquestion_pc['gpeec']['blIncoGlobal'] = $bilanSocialConsolide->getBlIncoGpeec();

        /* handitorial */
        $array_nbquestion_pc['handitorial'] = $onglet_handitorial;
        $array_nbquestion_pc['handitorial']['blIncoGlobal'] = $bilanSocialConsolide->getBlIncoHanditorial();

        /* Rassct */
        $array_nbquestion_pc['rassct'] = $onglet_rassct;
        $array_nbquestion_pc['rassct']['blIncoGlobal'] = $bilanSocialConsolide->getBlIncoRassct();
        
        /* Dgcl */
        $array_nbquestion_pc['dgcl'] = $onglet_dgcl;
        $array_nbquestion_pc['dgcl']['blIncoGlobal'] = $bilanSocialConsolide->getBlIncoDgcl();
        return $array_nbquestion_pc;


    }

    public function getImportTxtZippedFileAction(Request $request){

        $logger = $this->get('logger');
        $session = $this->get('session');
        $username = $this->getUser()->getUsername();
        $nmAnnee = $request->get('nm_annee',null);
        $idUtil = null;
        if (null != $session->get('coll_id') && !$request->get('from_info_centre')) {
            $idUtil = $session->get('user_id');
        }
        else {
            $idUtil = $this->getUser()->getIdUtil();
        }
        $chemin = $this->getParameter('file_manager.default_upload_dir');
        $file_action_log = fopen($chemin['action_log_dgcl'].'/'.$idUtil . '.txt', 'a');
        $nom_fichier = "export_dgcl_".$idUtil.".zip";
        $file_content = "";
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - - - - - START - - - - - - '."\n");
        if($request->get('from_infocentre')){
            fputs($file_action_log, date("d-m-Y H:i:s") . ' - Export depuis l\'Infocentre'."\n");
            $multiple_annee = $request->get("multiple_annee",null);
            if(empty($multiple_annee)){
                fclose($file_action_log);
                $idColl = $request->get('id_coll');
                $idEnqu = $request->get('id_enqu');
                $file_data = $this->createOneImportxtZippedFile($idColl,$idEnqu,$idUtil,$nmAnnee);
                $nom_fichier = $file_data[0];
                $file_content = $file_data[1];
            }else{
                fputs($file_action_log, date("d-m-Y H:i:s") . ' - Export multiples années (nombre : '.count($multiple_annee).')'."\n");
                fclose($file_action_log);
                $zip = new \ZipArchive();
                $zip->open($nom_fichier,\ZipArchive::CREATE);     
                foreach ($multiple_annee as $key => $annee_params) {
                    $idColl = $annee_params['id_coll'];
                    $idEnqu = $annee_params['id_enqu'];
                    $nmAnnee = $annee_params['nm_annee'];
                    $file_data = $this->createOneImportxtZippedFile($idColl,$idEnqu,$idUtil,$nmAnnee);
                    $file_name = $file_data[0];
                    $temp_file_content = $file_data[1];
                    $zip->addFromString($file_name,$temp_file_content);
                }
                $zip->close();
                $file_content = file_get_contents($nom_fichier);
            }
            /*fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début récupération consolidé'."\n");
            $bsc = $this->getBilanSocialConsolide($id_coll,$id_enqu,$nm_annee);
            $idBilanSociCons = $bsc!=null ? $bsc->getIdBilasocicons() : null;
            fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin récupération consolidé'."\n");*/
        }else{
            fclose($file_action_log);
            $bsc = $this->getMonBilanSocialConsolide(true,$nmAnnee);
            $id_coll = $bsc->getCollectivite()->getIdColl();
            $id_enqu = $bsc->getEnquete()->getIdEnqu();
            
            $file_data = $this->createOneImportxtZippedFile($id_coll,$id_enqu,$idUtil,$nmAnnee);
            $nom_fichier = $file_data[0];
            $file_content = $file_data[1];
            /*fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début récupération consolidé'."\n");
            $bsc = $this->getMonBilanSocialConsolide(true,$nm_annee);
            $idBilanSociCons = $bsc!=null ? $bsc->getIdBilasocicons() : null;
            fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin récupération consolidé'."\n");*/
        }
        $file_action_log = fopen($chemin['action_log_dgcl'].'/'.$idUtil . '.txt', 'a');
        
        
        // if ($idUtil == null) {
        //     throw new NotFoundHttpException($this->get('translator')->trans('nocollectivite.consolide.exception'));
        // }
        
        // $database_name = "bs_batchs";
        // $em = $this->getEntityManager();
        // /*
        // *   si une année est donnée on se branche sur le puits de données
        // */
        // if($nm_annee!=null){
        //     $batchs_annee_em = $this->getDataWellBatchsConnection($nm_annee);
        //     $em = $batchs_annee_em !=null ? $batchs_annee_em : $em;
        //     $database_name = $batchs_annee_em!=null ? $database_name."_".$nm_annee : $database_name;
        // }
        // if($idBilanSociCons!==null){
        //     fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début procédure stockée'."\n");
        //     $query = "CALL ".$database_name.".DGCL_export_process(:pIdBilaSociCons, :pIdUtil)";
        //     $stmt = $em->getConnection()->prepare($query);
        //     $stmt->bindParam(':pIdBilaSociCons',$idBilanSociCons,PDO::PARAM_INT);
        //     $stmt->bindParam(':pIdUtil',$idUtil,PDO::PARAM_INT);
        //     $stmt->execute();
        //     $results = $stmt->fetchAll();

        //     $stmt->closeCursor();
        //     fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin procédure stockée'."\n");
        // }else{
        //     $results = array();
        // }
        // $content = '';
        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début traitement des données'."\n");
        // foreach($results as $key => $result){
        //         $content .= $result['rowData'] . "\r\n";        // Windows style EOL pour permettre utilisation avec Excel VBA (open file)
        // }
        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin traitement des données'."\n");

        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début création du zip'."\n");
        // $zip = new ZipArchive();
        // $filename = $idUtil . "_export_DGCL.zip";
        // if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        //     exit("Impossible d'ouvrir le fichier <$filename>\n");
        // }
        // $campagne = $this->getMaCampagne();
        // $annee_campagne = $nm_annee==null ? $campagne->getNmAnne() : $nm_annee;
        // $nom_fichier = 'export_dgcl_'. $annee_campagne .'.zip';
        
        // $fileManager = $this->getBSFileManager();
        
        // $fichier_dgcl_last = $this->getEntityManager()->getRepository(Fichier::class)->findOneByLogicalFolder('MODEL_DGCL');
        // $fichier_pdf_last = $this->getEntityManager()->getRepository(Fichier::class)->findOneByLogicalFolder('AIDE_PDF');

        // $modele_excel_temp = $fileManager->getFileContent($fichier_dgcl_last->getFileKey());
        // $pdf_consigne_temp = $fileManager->getFileContent($fichier_pdf_last->getFileKey());
        
        // $file_temp_dgcl = fopen($modele_excel_temp['body'],'rb', $chemin['file_dgcl_temp'] );
        // $file_excel  = $idUtil .'bilan_social_dgcl.xlsm';
        // file_put_contents($file_excel,$file_temp_dgcl);
        // //        
        // $file_temp_pdf = fopen($pdf_consigne_temp['body'],'rb', $chemin['file_dgcl_temp']);
        // $file_pdf  = $idUtil .'recuperer_mon_bilan_social_et_mon_analyse.pdf';
        // file_put_contents($file_pdf,$file_temp_pdf);
        
        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début de copie des fichiers temporaires'."\n");
        // copy($file_excel, $chemin['file_dgcl_temp'] . $idUtil . 'bilan_social_dgcl.xlsm');
        // copy($file_pdf, $chemin['file_dgcl_temp'] . $idUtil . 'recuperer_mon_bilan_social_et_mon_analyse.pdf');
        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin de copie des fichiers temporaires'."\n");
        
        // $fileManager = $this->getBSFileManager();
        
        // $fichier_dgcl_last = $this->getEntityManager()->getRepository(Fichier::class)->findOneByLogicalFolder('MODEL_DGCL');
        // $fichier_pdf_last = $this->getEntityManager()->getRepository(Fichier::class)->findOneByLogicalFolder('AIDE_PDF');

        // $modele_excel_temp = $fileManager->getFileContent($fichier_dgcl_last->getFileKey());
        // $pdf_consigne_temp = $fileManager->getFileContent($fichier_pdf_last->getFileKey());
        
        // $file_temp_dgcl = fopen($modele_excel_temp['body'],'rb', $chemin['file_dgcl_temp'] );
        // $file_excel  = $idUtil .'bilan_social_dgcl.xlsm';
        // file_put_contents($file_excel,$file_temp_dgcl);
        
        // $file_temp_pdf = fopen($pdf_consigne_temp['body'],'rb', $chemin['file_dgcl_temp']);
        // $file_pdf  = $idUtil .'recuperer_mon_bilan_social_et_mon_analyse.pdf';
        // file_put_contents($file_pdf,$file_temp_pdf);
        
        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début de copie des fichiers temporaires'."\n");
        // copy($file_excel, $chemin['file_dgcl_temp'] . $idUtil . 'bilan_social_dgcl.xlsm');
        // copy($file_pdf, $chemin['file_dgcl_temp'] . $idUtil . 'recuperer_mon_bilan_social_et_mon_analyse.pdf');
        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin de copie des fichiers temporaires'."\n");

        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début Récupération des fichiers temporaires'."\n");
        // $modele_excel_temp = $chemin['file_dgcl_temp'] . $idUtil . 'bilan_social_dgcl.xlsm';
        // $pdf_consigne_temp = $chemin['file_dgcl_temp'] . $idUtil . 'recuperer_mon_bilan_social_et_mon_analyse.pdf';
        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin de récupération des fichiers temporaires'."\n");

        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début d ajout au zip les fichiers temporaires'."\n");
        // $zip->addFile($modele_excel_temp, 'modele_DGCL_' . $annee_campagne . '.xlsm');
        // $zip->addFile($pdf_consigne_temp, 'recuperer_mon_bilan_social_et_mon_analyse.pdf');
        // $zip->addFromString("export_dgcl".$annee_campagne.".txt",$content);
        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin d ajout au zip les fichiers temporaires'."\n");
        // $zip->close();
        // fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fermeture création du zip'."\n");

        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début Création reponse'."\n");
        $response = new Response($file_content);
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'application/zip');
        $response->headers->set('Content-Disposition', "attachment; filename=" . $nom_fichier);
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin Création reponse'."\n");

        /*fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début suppression fichiers temp'."\n");
        unlink($idUtil . "_export_DGCL.zip");
        unlink($pdf_consigne_temp);
        unlink($modele_excel_temp);
        unlink($file_pdf);
        unlink($file_excel);
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin suppression fichiers temp'."\n");*/
        setcookie("DownloadOk", true, time()+1);
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - - - - - END - - - - - - '."\n");
        fclose($file_action_log);
        return $response;

    }
    
    public function createOneImportxtZippedFile($collId,$idEnqu,$idUtil,$nmAnnee=null){
        $logger = $this->get('logger');
        $chemin = $this->getParameter('file_manager.default_upload_dir');
        $file_action_log = fopen($chemin['action_log_dgcl'].'/'.$idUtil . '.txt', 'a');
        /*$session = $this->get('session');
        $username = $this->getUser()->getUsername();
        $nm_annee = $request->get('nm_annee',null);
        if (null != $session->get('coll_id') && !$request->get('from_infocentre')) {
            $idUtil = $session->get('user_id');
        }
        else {
            $idUtil = $this->getUser()->getIdUtil();
        }
        $chemin = $this->getParameter('file_manager.default_upload_dir');
        $file_action_log = fopen($chemin['action_log_dgcl'].'/'.$idUtil . '.txt', 'a');
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - - - - - START - - - - - - '."\n");
        if($request->get('from_infocentre')){
            fputs($file_action_log, date("d-m-Y H:i:s") . ' - Export depuis l\'Infocentre'."\n");
            $id_coll = $request->get('id_coll');
            $id_enqu = $request->get('id_enqu');
            fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début récupération consolidé'."\n");
            $bsc = $this->getBilanSocialConsolide($id_coll,$id_enqu,$nm_annee);
            $idBilanSociCons = $bsc!=null ? $bsc->getIdBilasocicons() : null;
            fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin récupération consolidé'."\n");
        }else{
            
            $bsc = $this->getMonBilanSocialConsolide(true,$nm_annee);
            $idBilanSociCons = $bsc!=null ? $bsc->getIdBilasocicons() : null;
            
        }*/
        $em = $this->getDoctrine()->getManager();
        $idUtil = null;
        if(($username = $this->getFromSession('username')) != null){
            $user = $em->getRepository('UserBundle:User')->findOneByUsername($username);
            $idUtil = $user->getIdUtil();
            //dump($user);die;
        }else {
            $user= $this->getUser();
            $idUtil = $user->getIdUtil();
        }
        $file_data = array();
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début récupération consolidé'."\n");
        $bsc = $this->getBilanSocialConsolide($collId,$idEnqu,$nmAnnee);
        $idBilanSociCons = $bsc!=null ? $bsc->getIdBilasocicons() : null;
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin récupération consolidé'."\n");

        if ($idUtil == null) {
            throw new NotFoundHttpException($this->get('translator')->trans('nocollectivite.consolide.exception'));
        }
        
        $database_name = "bs_batchs";
        $em = $this->getEntityManager();
        /*
        *   si une année est donnée on se branche sur le puits de données
        */
        $campagne = $this->getMaCampagne();
        $annee_campagne = $campagne->getNmAnne();
        if($nmAnnee!=null && ($annee_campagne==null || $annee_campagne>$nmAnnee)){
            $batchs_annee_em = $this->getDataWellBatchsConnection($nmAnnee);
            $em = $batchs_annee_em !=null ? $batchs_annee_em : $em;
            $database_name = $batchs_annee_em!=null ? $database_name."_".$nmAnnee : $database_name;
        }
        if($idBilanSociCons!==null){
            fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début procédure stockée'."\n");
            $query = "CALL ".$database_name.".DGCL_export_process(:pIdBilaSociCons, :pIdUtil)";
            $stmt = $em->getConnection()->prepare($query);
            $stmt->bindParam(':pIdBilaSociCons',$idBilanSociCons,PDO::PARAM_INT);
            $stmt->bindParam(':pIdUtil',$idUtil,PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $stmt->closeCursor();
            fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin procédure stockée'."\n");
        }else{
            $results = array();
        }
        $content = '';
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début traitement des données'."\n");
        foreach($results as $key => $result){
                $content .= $result['rowData'] . "\r\n";        // Windows style EOL pour permettre utilisation avec Excel VBA (open file)
        }
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin traitement des données'."\n");

        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début création du zip'."\n");
        $zip = new ZipArchive();
        $filename = $idUtil . "_export_DGCL.zip";
        if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
            exit("Impossible d'ouvrir le fichier <$filename>\n");
        }
        $campagne = $this->getMaCampagne();
        $annee_campagne = $nmAnnee==null ? $campagne->getNmAnne() : $nmAnnee;
        $nom_fichier = 'export_dgcl_'. $annee_campagne .'.zip';
        
        $fileManager = $this->getBSFileManager();
        
        $fichier_dgcl_last = $this->getEntityManager()->getRepository(Fichier::class)->findOneByLogicalFolder('MODEL_DGCL');
        $fichier_pdf_last = $this->getEntityManager()->getRepository(Fichier::class)->findOneByLogicalFolder('AIDE_PDF');

        $modele_excel_temp = $fileManager->getFileContent($fichier_dgcl_last->getFileKey());
        $pdf_consigne_temp = $fileManager->getFileContent($fichier_pdf_last->getFileKey());
        //dump($chemin);
        $file_temp_dgcl = fopen($modele_excel_temp['body'],'rb', $chemin['file_dgcl_temp'] );
        $file_excel  = $idUtil .'bilan_social_dgcl.xlsm';
        file_put_contents($file_excel,$file_temp_dgcl);
        //        
        $file_temp_pdf = fopen($pdf_consigne_temp['body'],'rb', $chemin['file_dgcl_temp']);
        $file_pdf  = $idUtil .'recuperer_mon_bilan_social_et_mon_analyse.pdf';
        file_put_contents($file_pdf,$file_temp_pdf);
        
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début de copie des fichiers temporaires'."\n");
        copy($file_excel, $chemin['file_dgcl_temp'] . $idUtil . 'bilan_social_dgcl.xlsm');
        copy($file_pdf, $chemin['file_dgcl_temp'] . $idUtil . 'recuperer_mon_bilan_social_et_mon_analyse.pdf');
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin de copie des fichiers temporaires'."\n");
        
        $fileManager = $this->getBSFileManager();
        
        $fichier_dgcl_last = $this->getEntityManager()->getRepository(Fichier::class)->findOneByLogicalFolder('MODEL_DGCL');
        $fichier_pdf_last = $this->getEntityManager()->getRepository(Fichier::class)->findOneByLogicalFolder('AIDE_PDF');

        $modele_excel_temp = $fileManager->getFileContent($fichier_dgcl_last->getFileKey());
        $pdf_consigne_temp = $fileManager->getFileContent($fichier_pdf_last->getFileKey());
        
        $file_temp_dgcl = fopen($modele_excel_temp['body'],'rb', $chemin['file_dgcl_temp'] );
        $file_excel  = $idUtil .'bilan_social_dgcl.xlsm';
        file_put_contents($file_excel,$file_temp_dgcl);
        
        $file_temp_pdf = fopen($pdf_consigne_temp['body'],'rb', $chemin['file_dgcl_temp']);
        $file_pdf  = $idUtil .'recuperer_mon_bilan_social_et_mon_analyse.pdf';
        file_put_contents($file_pdf,$file_temp_pdf);
        
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début de copie des fichiers temporaires'."\n");
        copy($file_excel, $chemin['file_dgcl_temp'] . $idUtil . 'bilan_social_dgcl.xlsm');
        copy($file_pdf, $chemin['file_dgcl_temp'] . $idUtil . 'recuperer_mon_bilan_social_et_mon_analyse.pdf');
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin de copie des fichiers temporaires'."\n");

        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début Récupération des fichiers temporaires'."\n");
        $modele_excel_temp = $chemin['file_dgcl_temp'] . $idUtil . 'bilan_social_dgcl.xlsm';
        $pdf_consigne_temp = $chemin['file_dgcl_temp'] . $idUtil . 'recuperer_mon_bilan_social_et_mon_analyse.pdf';
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin de récupération des fichiers temporaires'."\n");

        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début d ajout au zip les fichiers temporaires'."\n");
        $zip->addFile($modele_excel_temp, 'modele_DGCL_' . $annee_campagne . '.xlsm');
        $zip->addFile($pdf_consigne_temp, 'recuperer_mon_bilan_social_et_mon_analyse.pdf');
        $zip->addFromString("export_dgcl".$annee_campagne.".txt",$content);
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin d ajout au zip les fichiers temporaires'."\n");
        $zip->close();
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fermeture création du zip'."\n");

        $file_data[0] = $nom_fichier;
        $file_data[1] = file_get_contents($filename);

        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Début suppression fichiers temp'."\n");
        unlink($idUtil . "_export_DGCL.zip");
        unlink($pdf_consigne_temp);
        unlink($modele_excel_temp);
        unlink($file_pdf);
        unlink($file_excel);
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - Fin suppression fichiers temp'."\n");
        //setcookie("DownloadOk", true, time()+1);
        fputs($file_action_log, date("d-m-Y H:i:s") . ' - - - - - END - - - - - - '."\n");
        fclose($file_action_log);

        return $file_data;
    }

    public function getImportDGCLWithLimitAction(){
        $em = $this->getDoctrine()->getManager();
        $logger = $this->get('logger');
        $session = $this->get('session');
        $username = $this->getUser()->getUsername();
        
        if (null != $session->get('coll_id')) {
            $idUtil = $session->get('user_id');
        }
        else {
            $idUtil = $this->getUser()->getIdUtil();
        }
        $chemin = $this->getParameter('file_manager.default_upload_dir');
        $file_action_log = fopen($chemin['action_log_dgcl'].'/'.$idUtil . '.txt', 'a');

        if ($idUtil == null) {
            throw new NotFoundHttpException($this->get('translator')->trans('nocollectivite.consolide.exception'));
        }
        
        
        $array_enquetes = array();
        foreach ($this->getMonCDG()->getCdgDepartements() as $key => $value) {
            $array_enquetes = array_merge($array_enquetes, $value->getEnquetes()->toArray());
        }
        
        
        $res = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteForExportDGCLByCdg($this->getUser());
        
        
        
        
        $pIdColls = '';
        
        foreach ($res as $key => $value) {
            
            $pIdColls .= $value->getIdColl();
            
            if ($value !== end($res)) {
                $pIdColls .= ', ';
            }
        }
       $results = array();
        foreach ($array_enquetes as $key => $value) {
            $pIdGroupExpHeader = '';
            $idEnquete = $value->getIdEnqu();
            // FIXME UTILE ?????????
            $query = "CALL DGCL_GROUP_process_export(:pIdEnqu, :pIdColls, :pIdUtil, :pIdGroupExpHeader, '%%')";
        
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->bindParam(':pIdEnqu',$idEnquete,PDO::PARAM_INT);
            $stmt->bindParam(':pIdUtil',$idUtil,PDO::PARAM_INT);
            $stmt->bindParam(':pIdColls',$pIdColls,PDO::PARAM_STR);
            $stmt->bindParam(':pIdGroupExpHeader',$pIdGroupExpHeader,PDO::PARAM_INT);
            $stmt->execute();
            $results = array_merge($results, $stmt->fetchAll());

            $stmt->closeCursor();
        }

        $content = '';
        foreach($results as $key => $result){
                $content .= $result['rowData'] . "\r\n";        // Windows style EOL pour permettre utilisation avec Excel VBA (open file)
        }

        $zip = new ZipArchive();
        $filename = $idUtil . "_export_DGCL.zip";
        if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
            exit("Impossible d'ouvrir le fichier <$filename>\n");
        }
        $campagne = $this->getMaCampagne();
        $annee_campagne = $campagne->getNmAnne();
        $nom_fichier = 'export_dgcl_'. $annee_campagne .'.zip';
        
        $modele_excel = $chemin['file_dgcl'] . 'bilan_social_dgcl.xlsm';
        $pdf_consigne = $chemin['file_dgcl'] . 'recuperer_mon_bilan_social_et_mon_analyse.pdf';
        
        copy($modele_excel, $chemin['file_dgcl_temp'] . $idUtil . 'bilan_social_dgcl.xlsm');
        copy($pdf_consigne, $chemin['file_dgcl_temp'] . $idUtil . 'recuperer_mon_bilan_social_et_mon_analyse.pdf');
        
        $modele_excel_temp = $chemin['file_dgcl_temp'] . $idUtil . 'bilan_social_dgcl.xlsm';
        $pdf_consigne_temp = $chemin['file_dgcl_temp'] . $idUtil . 'recuperer_mon_bilan_social_et_mon_analyse.pdf';
        
        $zip->addFile($modele_excel_temp, 'modele_DGCL_' . $annee_campagne . '.xlsm');
        $zip->addFile($pdf_consigne_temp, 'recuperer_mon_bilan_social_et_mon_analyse.pdf');
        $zip->addFromString("export_dgcl".$annee_campagne.".txt",$content);
        $zip->close();
        
        $response = new Response(file_get_contents($filename));
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'application/zip');
        $response->headers->set('Content-Disposition', "attachment; filename=" . $nom_fichier);
        
        unlink($idUtil . "_export_DGCL.zip");
        unlink($pdf_consigne_temp);
        unlink($modele_excel_temp);
        
        setcookie("DownloadOk", true, time()+1);
        fclose($file_action_log);
        return $response;

    }

}

