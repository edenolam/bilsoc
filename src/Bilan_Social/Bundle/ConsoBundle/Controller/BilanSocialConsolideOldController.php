<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;


use Bilan_Social\Bundle\CoreBundle\Entity\IncoherenceLog;
use Bilan_Social\Bundle\BilanSocialBundle\Entity\HistoriqueBilanSocial;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

class BilanSocialConsolideOldController extends Controller {


    protected function GetQuestionnaireAction(int $idColl, int $idEnqu) {
        $em = $this->getDoctrine()->getManager();

        $questionCollectiviteConsolide = $em->getRepository('ConsoBundle:QuestionCollectiviteConsolide')
                ->findOneByActif($idColl, $idEnqu);

        if ($questionCollectiviteConsolide == null) {
            $this->addFlash(
                    'notice', 'Vous devez saisir le questionnaire avant de créer le bilan'
            );
            return null;
        }
        return $questionCollectiviteConsolide;
    }

    public function UpdateIncoherenceLog($bilanSocialConsolide, $questionCollectiviteConsolide) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $incoherenceLogRepository = $em->getRepository('CoreBundle:IncoherenceLog');
        $incoherenceLogRepository->removeOlderIncoherenceBilan($bilanSocialConsolide->getIdBilasocicons());

        $bilanSocialConsolide->setIncoherenceLogs(new ArrayCollection());


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
                    $incoherenceLog->setMessage("Grade " . $ind111->getRefGrade()->getLbGrad() . " : " . "Totaux non correspondants");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    //$incoherenceLog->setTest($test);
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
                foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                    if ($idCe == $ind111->getRefGrade()->getRefCadreEmploi()->getIdCadrempl()) {
                        $totalCe111 = $totalCe111 + ($ind111->getR1111() == null ? 0 : $ind111->getR1111());
                    }
                }

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
                    $incoherenceLog->setMessage("Cadre emploi " . $ind112->getRefCadreEmploi()->getLbCadrempl() . " : " . "Totaux non correspondants avec 1.1.1");
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
                } else if ($fgGenr == "F") {
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
                            } else if ($fgGenr == "F") {
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
                        $incoherenceLog->setMessage("Catégorie " . $ind113->getRefCategorie()->getLbCate() . " - " . $lbGenr . " : " . "Totaux non correspondants avec 1.1.2");
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

                if ($totalFil != $totalFil111) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("114idTr_" . json_encode($ind114->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setTableNum("1.1.4");
                    $incoherenceLog->setIdToggle1("toggle114");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage("Filière " . $ind114->getRefFiliere()->getLbFili() . " : " . "Totaux non correspondants avec 1.1.1");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setForm("1");

                    if ($totalFil == 0 && $totalFil111 > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd114 != 2)
                            $blIncoInd114 = 1;
                    } else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd114 = 2;
                    }
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

                $totalCdi = 0;
                if ($ind121->getR12114() != null)
                    $totalCdi += $ind121->getR12114();
                if ($ind121->getR12116() != null)
                    $totalCdi += $ind121->getR12116();

                $message = "";
                if ($total18 != $totalCdi) {
                    $message = "Cadre emploi " . $ind121->getRefCadreEmploi()->getLbCadrempl() . " : " . "Le total agent en CDI est différent du total Homme + Femme en CDI. ";

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

                $totalTousEmploi = 0;
                if ($ind121->getR1219() != null)
                    $totalTousEmploi += $ind121->getR1219();
                if ($ind121->getR12110() != null)
                    $totalTousEmploi += $ind121->getR12110();

                if ($total != $totalTousEmploi) {
                    $message = "Cadre emploi " . $ind121->getRefCadreEmploi()->getLbCadrempl() . " : " . "Le total est différent du total tous emplois à temps complet ou non complet. ";

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

                if ($total != $totalAnciennente) {
                    $message = "Cadre emploi " . $ind121->getRefCadreEmploi()->getLbCadrempl() . " : " . "Le total est différent du total Ancienneté dans la collectivité. ";

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

                if ($total != $totalHomFem) {
                    $message = "Cadre emploi " . $ind121->getRefCadreEmploi()->getLbCadrempl() . " : " . "Le total est différent du total Hommes + Femmes. ";

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

                if ($totalCDD != $totalHomFemCDD) {
                    $message = "Cadre emploi " . $ind121->getRefCadreEmploi()->getLbCadrempl() . " : " . "Le total CDD est différent du total Hommes + Femmes en CDD. ";

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
                        $totalCe121 = $totalCe121 + ($ind121->getR1219() == null ? 0 : $ind121->getR1219());
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
                    $incoherenceLog->setMessage("Cadre emploi " . $ind122->getRefCadreEmploi()->getLbCadrempl() . " : " . "Totaux non correspondants avec 1.2.1");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
//                    $incoherenceLog->setBlIncoherence(true);
                    $incoherenceLog->setForm("1");
//                    if ($totalCe == 0 && $totalCe121 > 0) {
//                        $incoherenceLog->setBlIncoherence(false);
//                    }
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
                } else if ($fgGenr == "F") {
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
                            } else if ($fgGenr == "F") {
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
                        $incoherenceLog->setMessage("Catégorie " . $ind123->getRefCategorie()->getLbCate() . " - " . $lbGenr . " : " . "Totaux non correspondants avec 1.2.2");
                        $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
//                        $incoherenceLog->setBlIncoherence(true);
//                        if ($total == 0 && $total122 > 0) {
//                            $incoherenceLog->setBlIncoherence(false);
//                        }
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

                if ($totalFil121 != $totalFil) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("124idTr_" . json_encode($ind124->getRefFiliere()->getIdFili()));
                    $incoherenceLog->setTableNum("1.2.4");
                    $incoherenceLog->setIdToggle1("toggle124");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage("Filière " . $ind124->getRefFiliere()->getLbFili() . " : " . "Totaux non correspondants avec 1.2.1");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setBlIncoherence(true);
//                    if ($totalFil == 0 && $totalFil121 > 0) {
//                        $incoherenceLog->setBlIncoherence(false);
//                    }
                    if ($totalFil == 0 && $totalFil121 > 0) {
                        $incoherenceLog->setBlIncoherence(false);

                        if ($blIncoInd124 != 2)
                            $blIncoInd124 = 1;
                    } else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd124 = 2;
                    }
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
                $total2 = ($ind1311->getR13113() == null ? 0 : $ind1311->getR13113()) + ($ind1311->getR13114() == null ? 0 : $ind1311->getR13114());

                if ($total1 != $total2) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("1311idTr_" . json_encode($ind1311->getRefEmploiNonPermanent()->getIdEmplnonperm()));
                    $incoherenceLog->setTableNum("1.3.1.1");
                    $incoherenceLog->setIdToggle1("toggle131");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setMessage("Emploi non permanent " . $ind1311->getRefEmploiNonPermanent()->getLbEmplnonperm() . " : " . "Totaux non correspondants");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total2 == 0 && $total1 > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd131 != 2)
                            $blIncoInd131 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd131 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }

            foreach ($bilanSocialConsolide->getInd1312s() as $ind1312) {
                $total1 = ($ind1312->getR13121() == null ? 0 : $ind1312->getR13121()) + ($ind1312->getR13122() == null ? 0 : $ind1312->getR13122());
                $total2 = ($ind1312->getR13123() == null ? 0 : $ind1312->getR13123()) + ($ind1312->getR13124() == null ? 0 : $ind1312->getR13124());

                if ($total1 != $total2) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("1312idTr_" . json_encode($ind1312->getRefEmploiNonPermanent()->getIdEmplnonperm()));
                    $incoherenceLog->setTableNum("1.3.1.2");
                    $incoherenceLog->setIdToggle1("toggle131");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setForm("1");
                    $incoherenceLog->setMessage("Emploi non permanent " . $ind1312->getRefEmploiNonPermanent()->getLbEmplnonperm() . " : " . "Totaux non correspondants");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total2 == 0 && $total1 > 0) {
                        $incoherenceLog->setBlIncoherence(false);
                        if ($blIncoInd131 != 2)
                            $blIncoInd131 = 1;
                    }
                    else {
                        $incoherenceLog->setBlIncoherence(true);
                        $blIncoInd131 = 2;
                    }
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
        }

        /**
         * Incohérences 161
         */
        $blIncoInd161 = 0;
        if ($questionCollectiviteConsolide->getQ2() == true) {
            $totalH = 0;
            $totalF = 0;
            $total111H = 0;
            $total111F = 0;
            foreach ($bilanSocialConsolide->getInd161s() as $ind161) {
                $idCate = $ind161->getRefCategorie()->getIdCate();
                $lbGenr = "";


                $totalH = ($ind161->getR1611() == null ? 0 : $ind161->getR1611()) + ($ind161->getR1613() == null ? 0 : $ind161->getR1613());
                $totalF = ($ind161->getR1612() == null ? 0 : $ind161->getR1612()) + ($ind161->getR1614() == null ? 0 : $ind161->getR1614());

                error_log("Total H = ".$totalH, 0);

                foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                    $idCate111 = $ind111->getRefGrade()->getRefCadreEmploi()->getRefCategorie()->getIdCate();

                    if ($idCate == $idCate111) {
                        $total111H = $total111H + $ind111->getR1115() == null ? 0 : $ind111->getR1115();
                        $total111F = $total111F + $ind111->getR1116() == null ? 0 : $ind111->getR1116();
                    }
                }

                if ($totalH <= $total111H || $totalF <= $total111F) {
                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("161idTr_" . json_encode($ind161->getRefCategorie()->getIdCate()));
                    $incoherenceLog->setTableNum("1.6.1");
                    $incoherenceLog->setIdToggle1("toggle161");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage("Catégorie " . $ind161->getRefCategorie()->getIdCate() . " : " . "Totaux non correspondants avec 1.1.1");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setForm("2");
                    $incoherenceLog->setBlIncoherence(true);
                    $blIncoInd161 = 2;
                    $bilanSocialConsolide->addIncoherenceLog($incoherenceLog);
                }
            }
        }






        /**
         * Incohérences 211
         */
        $blIncoInd211 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true) {
            // Test 2111
            foreach ($bilanSocialConsolide->getInd2111s() as $ind2111) {
                $total1 = ($ind2111->getR21111()!=null ? $ind2111->getR21111() : 0);
                $total2 = ($ind2111->getR21112()!=null ? $ind2111->getR21112() : 0);
                $total3 = ($ind2111->getR21113()!=null ? $ind2111->getR21113() : 0);
                $total4 = ($ind2111->getR21114()!=null ? $ind2111->getR21114() : 0);
                $total5 = ($ind2111->getR21115()!=null ? $ind2111->getR21115() : 0);
                $total6 = ($ind2111->getR21116()!=null ? $ind2111->getR21116() : 0);

                $message = "";
                if ($total5 < $total1) {
                    $message = "2.1.1.1 : Motif absence " . $ind2111->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre d'arrêts Hommes doit être supérieur au nombre de fonctionnaires Hommes";

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
                if ($total3 < $total1) {
                    $message = "2.1.1.1 : Motif absence " . $ind2111->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Hommes doit être supérieur au nombre de fonctionnaires Hommes";

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
                if ($total5 < $total3) {
                    $message = "2.1.1.1 : Motif absence " . $ind2111->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Hommes doit être supérieur au nombre d'arrêts Hommes";

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
                if ($total6 < $total2) {
                    $message = "2.1.1.1 : Motif absence " . $ind2111->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre d'arrêts Femmes doit être supérieur au nombre de fonctionnaires Femmes";

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
                    $message = "2.1.1.1 : Motif absence " . $ind2111->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Femmes doit être supérieur au nombre de fonctionnaires Femmes";

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
                if ($total6 < $total4) {
                    $message = "2.1.1.1 : Motif absence " . $ind2111->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Femmes doit être supérieur au nombre d'arrêts Femmes";

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

                $total1 = ($ind2112->getR21121()!=null ? $ind2112->getR21121() : 0);
                $total2 = ($ind2112->getR21122()!=null ? $ind2112->getR21122() : 0);
                $total3 = ($ind2112->getR21123()!=null ? $ind2112->getR21123() : 0);
                $total4 = ($ind2112->getR21124()!=null ? $ind2112->getR21124() : 0);
                $total5 = ($ind2112->getR21125()!=null ? $ind2112->getR21125() : 0);
                $total6 = ($ind2112->getR21126()!=null ? $ind2112->getR21126() : 0);
                $total7 = ($ind2112->getR21127()!=null ? $ind2112->getR21127() : 0);
                $total8 = ($ind2112->getR21128()!=null ? $ind2112->getR21128() : 0);
                $total9 = ($ind2112->getR21129()!=null ? $ind2112->getR21129() : 0);
                $total10 = ($ind2112->getR211210()!=null ? $ind2112->getR211210() : 0);
                $total_2112 = $total1+$total2+$total3+$total4+$total5+$total6+$total7+$total8+$total9+$total10;

                $total_2111 = 0;
                foreach ($bilanSocialConsolide->getInd2111s() as $ind2111) {
                    $idMa1 = $ind2111->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa2==$idMa1) {
                        $total11 = ($ind2111->getR21111()!=null ? $ind2111->getR21111() : 0);
                        $total12 = ($ind2111->getR21112()!=null ? $ind2111->getR21112() : 0);
                        $total_2111 = $total11 + $total12;
                        break;
                    }
                }

                $total_2113 = 0;
                foreach ($bilanSocialConsolide->getInd2113s() as $ind2113) {
                    $idMa3 = $ind2113->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa2==$idMa3) {
                        $total31 = ($ind2113->getR21131()!=null ? $ind2113->getR21131() : 0);
                        $total32 = ($ind2113->getR21132()!=null ? $ind2113->getR21132() : 0);
                        $total33 = ($ind2113->getR21133()!=null ? $ind2113->getR21133() : 0);
                        $total34 = ($ind2113->getR21134()!=null ? $ind2113->getR21134() : 0);
                        $total35 = ($ind2113->getR21135()!=null ? $ind2113->getR21135() : 0);
                        $total36 = ($ind2113->getR21136()!=null ? $ind2113->getR21136() : 0);
                        $total37 = ($ind2113->getR21137()!=null ? $ind2113->getR21137() : 0);
                        $total38 = ($ind2113->getR21138()!=null ? $ind2113->getR21138() : 0);
                        $total39 = ($ind2113->getR21139()!=null ? $ind2113->getR21139() : 0);
                        $total310 = ($ind2113->getR211310()!=null ? $ind2113->getR211310() : 0);
                        $total_2113 = $total31+$total32+$total33+$total34+$total35+$total36+$total37+$total38+$total39+$total310;
                        break;
                    }
                }

                $message = "";
                if ($total_2112 != $total_2111) {
                    $message = "2.1.1.2 : Motif absence " . $ind2112->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de fonctionnaire est différent du tableau 2.1.1.1";

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

                $message = "";
                if ($total_2112 != $total_2113) {
                    $message = "2.1.1.2 : Motif absence " . $ind2112->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de fonctionnaire est différent du tableau 2.1.1.3";

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2112idMa_" . json_encode($ind2112->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.1");
                    $incoherenceLog->setIdToggle1("toggle211");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2112 == 0 && $total_2113 > 0) {
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

                $total1 = ($ind2113->getR21131()!=null ? $ind2113->getR21131() : 0);
                $total2 = ($ind2113->getR21132()!=null ? $ind2113->getR21132() : 0);
                $total3 = ($ind2113->getR21133()!=null ? $ind2113->getR21133() : 0);
                $total4 = ($ind2113->getR21134()!=null ? $ind2113->getR21134() : 0);
                $total5 = ($ind2113->getR21135()!=null ? $ind2113->getR21135() : 0);
                $total6 = ($ind2113->getR21136()!=null ? $ind2113->getR21136() : 0);
                $total7 = ($ind2113->getR21137()!=null ? $ind2113->getR21137() : 0);
                $total8 = ($ind2113->getR21138()!=null ? $ind2113->getR21138() : 0);
                $total9 = ($ind2113->getR21139()!=null ? $ind2113->getR21139() : 0);
                $total10 = ($ind2113->getR211310()!=null ? $ind2113->getR211310() : 0);
                $total_2113 = $total1+$total2+$total3+$total4+$total5+$total6+$total7+$total8+$total9+$total10;

                $total_2111 = 0;
                foreach ($bilanSocialConsolide->getInd2111s() as $ind2111) {
                    $idMa1 = $ind2111->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa3==$idMa1) {
                        $total11 = ($ind2111->getR21113()!=null ? $ind2111->getR21113() : 0);
                        $total12 = ($ind2111->getR21114()!=null ? $ind2111->getR21114() : 0);
                        $total_2111 = $total11 + $total12;
                        break;
                    }
                }

                $total_2112 = 0;
                foreach ($bilanSocialConsolide->getInd2112s() as $ind2112) {
                    $idMa2 = $ind2112->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa3==$idMa2) {
                        $total31 = ($ind2112->getR21121()!=null ? $ind2112->getR21121() : 0);
                        $total32 = ($ind2112->getR21122()!=null ? $ind2112->getR21122() : 0);
                        $total33 = ($ind2112->getR21123()!=null ? $ind2112->getR21123() : 0);
                        $total34 = ($ind2112->getR21124()!=null ? $ind2112->getR21124() : 0);
                        $total35 = ($ind2112->getR21125()!=null ? $ind2112->getR21125() : 0);
                        $total36 = ($ind2112->getR21126()!=null ? $ind2112->getR21126() : 0);
                        $total37 = ($ind2112->getR21127()!=null ? $ind2112->getR21127() : 0);
                        $total38 = ($ind2112->getR21128()!=null ? $ind2112->getR21128() : 0);
                        $total39 = ($ind2112->getR21129()!=null ? $ind2112->getR21129() : 0);
                        $total310 = ($ind2112->getR211210()!=null ? $ind2112->getR211210() : 0);
                        $total_2112 = $total31+$total32+$total33+$total34+$total35+$total36+$total37+$total38+$total39+$total310;
                        break;
                    }
                }

                $message = "";
                if ($total_2113 != $total_2111) {
                    $message = "2.1.1.3 : Motif absence " . $ind2113->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence est différent du tableau 2.1.1.1";

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

                $message = "";
                if ($total_2113 != $total_2112) {
                    $message = "2.1.1.3 : Motif absence " . $ind2113->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence est différent du tableau 2.1.1.2";

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2113idMa_" . json_encode($ind2113->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.1");
                    $incoherenceLog->setIdToggle1("toggle211");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2113 == 0 && $total_2112 > 0) {
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
        if ($questionCollectiviteConsolide->getQ1() == true) {
            // Test 2121
            foreach ($bilanSocialConsolide->getInd2121s() as $ind2121) {
                $total1 = ($ind2121->getR21211()!=null ? $ind2121->getR21211() : 0);
                $total2 = ($ind2121->getR21212()!=null ? $ind2121->getR21212() : 0);
                $total3 = ($ind2121->getR21213()!=null ? $ind2121->getR21213() : 0);
                $total4 = ($ind2121->getR21214()!=null ? $ind2121->getR21214() : 0);
                $total5 = ($ind2121->getR21215()!=null ? $ind2121->getR21215() : 0);
                $total6 = ($ind2121->getR21216()!=null ? $ind2121->getR21216() : 0);

                $message = "";
                if ($total5 < $total1) {
                    $message = "2.1.2.1 : Motif absence " . $ind2121->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre d'arrêts Hommes doit être supérieur au nombre de contractuels sur emplois permanents Hommes";

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
                if ($total3 < $total1) {
                    $message = "2.1.2.1 : Motif absence " . $ind2121->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Hommes doit être supérieur au nombre de contractuels sur emplois permanents Hommes";

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
                if ($total5 < $total3) {
                    $message = "2.1.2.1 : Motif absence " . $ind2121->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Hommes doit être supérieur au nombre d'arrêts Hommes";

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
                if ($total6 < $total2) {
                    $message = "2.1.2.1 : Motif absence " . $ind2121->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre d'arrêts Femmes doit être supérieur au nombre de contractuels sur emplois permanents  Femmes";

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
                    $message = "2.1.2.1 : Motif absence " . $ind2121->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Femmes doit être supérieur au nombre de contractuels sur emplois permanents  Femmes";

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
                if ($total6 < $total4) {
                    $message = "2.1.2.1 : Motif absence " . $ind2121->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Femmes doit être supérieur au nombre d'arrêts Femmes";

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

                $total1 = ($ind2122->getR21221()!=null ? $ind2122->getR21221() : 0);
                $total2 = ($ind2122->getR21222()!=null ? $ind2122->getR21222() : 0);
                $total3 = ($ind2122->getR21223()!=null ? $ind2122->getR21223() : 0);
                $total4 = ($ind2122->getR21224()!=null ? $ind2122->getR21224() : 0);
                $total5 = ($ind2122->getR21225()!=null ? $ind2122->getR21225() : 0);
                $total6 = ($ind2122->getR21226()!=null ? $ind2122->getR21226() : 0);
                $total7 = ($ind2122->getR21227()!=null ? $ind2122->getR21227() : 0);
                $total8 = ($ind2122->getR21228()!=null ? $ind2122->getR21228() : 0);
                $total9 = ($ind2122->getR21229()!=null ? $ind2122->getR21229() : 0);
                $total10 = ($ind2122->getR212210()!=null ? $ind2122->getR212210() : 0);
                $total_2122 = $total1+$total2+$total3+$total4+$total5+$total6+$total7+$total8+$total9+$total10;

                $total_2121 = 0;
                foreach ($bilanSocialConsolide->getInd2121s() as $ind2121) {
                    $idMa1 = $ind2121->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa2==$idMa1) {
                        $total11 = ($ind2121->getR21211()!=null ? $ind2121->getR21211() : 0);
                        $total12 = ($ind2121->getR21212()!=null ? $ind2121->getR21212() : 0);
                        $total_2121 = $total11 + $total12;
                        break;
                    }
                }

                $total_2123 = 0;
                foreach ($bilanSocialConsolide->getInd2123s() as $ind2123) {
                    $idMa3 = $ind2123->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa2==$idMa3) {
                        $total31 = ($ind2123->getR21231()!=null ? $ind2123->getR21231() : 0);
                        $total32 = ($ind2123->getR21232()!=null ? $ind2123->getR21232() : 0);
                        $total33 = ($ind2123->getR21233()!=null ? $ind2123->getR21233() : 0);
                        $total34 = ($ind2123->getR21234()!=null ? $ind2123->getR21234() : 0);
                        $total35 = ($ind2123->getR21235()!=null ? $ind2123->getR21235() : 0);
                        $total36 = ($ind2123->getR21236()!=null ? $ind2123->getR21236() : 0);
                        $total37 = ($ind2123->getR21237()!=null ? $ind2123->getR21237() : 0);
                        $total38 = ($ind2123->getR21238()!=null ? $ind2123->getR21238() : 0);
                        $total39 = ($ind2123->getR21239()!=null ? $ind2123->getR21239() : 0);
                        $total310 = ($ind2123->getR212310()!=null ? $ind2123->getR212310() : 0);
                        $total_2123 = $total31+$total32+$total33+$total34+$total35+$total36+$total37+$total38+$total39+$total310;
                        break;
                    }
                }

                $message = "";
                if ($total_2122 != $total_2121) {
                    $message = "2.1.2.2 : Motif absence " . $ind2122->getRefMotifAbsence()->getLbMotiabse() . " : " .
                            "Le nombre de contractuels sur emplois permanents  est différent du tableau 2.1.2.1";

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

                $message = "";
                if ($total_2122 != $total_2123) {
                    $message = "2.1.2.2 : Motif absence " . $ind2122->getRefMotifAbsence()->getLbMotiabse() . " : " .
                            "Le nombre de contractuels sur emplois permanents  est différent du tableau 2.1.2.3";

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2122idMa_" . json_encode($ind2122->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.2");
                    $incoherenceLog->setIdToggle1("toggle212");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2122 == 0 && $total_2123 > 0) {
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

                $total1 = ($ind2123->getR21231()!=null ? $ind2123->getR21231() : 0);
                $total2 = ($ind2123->getR21232()!=null ? $ind2123->getR21232() : 0);
                $total3 = ($ind2123->getR21233()!=null ? $ind2123->getR21233() : 0);
                $total4 = ($ind2123->getR21234()!=null ? $ind2123->getR21234() : 0);
                $total5 = ($ind2123->getR21235()!=null ? $ind2123->getR21235() : 0);
                $total6 = ($ind2123->getR21236()!=null ? $ind2123->getR21236() : 0);
                $total7 = ($ind2123->getR21237()!=null ? $ind2123->getR21237() : 0);
                $total8 = ($ind2123->getR21238()!=null ? $ind2123->getR21238() : 0);
                $total9 = ($ind2123->getR21239()!=null ? $ind2123->getR21239() : 0);
                $total10 = ($ind2123->getR212310()!=null ? $ind2123->getR212310() : 0);
                $total_2123 = $total1+$total2+$total3+$total4+$total5+$total6+$total7+$total8+$total9+$total10;

                $total_2121 = 0;
                foreach ($bilanSocialConsolide->getInd2121s() as $ind2121) {
                    $idMa1 = $ind2121->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa3==$idMa1) {
                        $total11 = ($ind2121->getR21211()!=null ? $ind2121->getR21211() : 0);
                        $total12 = ($ind2121->getR21212()!=null ? $ind2121->getR21212() : 0);
                        $total_2121 = $total11 + $total12;
                        break;
                    }
                }

                $total_2122 = 0;
                foreach ($bilanSocialConsolide->getInd2122s() as $ind2122) {
                    $idMa2 = $ind2122->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa3==$idMa2) {
                        $total31 = ($ind2122->getR21221()!=null ? $ind2122->getR21221() : 0);
                        $total32 = ($ind2122->getR21222()!=null ? $ind2122->getR21222() : 0);
                        $total33 = ($ind2122->getR21223()!=null ? $ind2122->getR21223() : 0);
                        $total34 = ($ind2122->getR21224()!=null ? $ind2122->getR21224() : 0);
                        $total35 = ($ind2122->getR21225()!=null ? $ind2122->getR21225() : 0);
                        $total36 = ($ind2122->getR21226()!=null ? $ind2122->getR21226() : 0);
                        $total37 = ($ind2122->getR21227()!=null ? $ind2122->getR21227() : 0);
                        $total38 = ($ind2122->getR21228()!=null ? $ind2122->getR21228() : 0);
                        $total39 = ($ind2122->getR21229()!=null ? $ind2122->getR21229() : 0);
                        $total310 = ($ind2122->getR212210()!=null ? $ind2122->getR212210() : 0);
                        $total_2122 = $total31+$total32+$total33+$total34+$total35+$total36+$total37+$total38+$total39+$total310;
                        break;
                    }
                }

                $message = "";
                if ($total_2123 != $total_2121) {
                    $message = "2.1.2.3 : Motif absence " . $ind2123->getRefMotifAbsence()->getLbMotiabse() . " : " .
                            "Le nombre de contractuels sur emplois permanents  est différent du tableau 2.1.2.1";

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

                $message = "";
                if ($total_2123 != $total_2122) {
                    $message = "2.1.2.3 : Motif absence " . $ind2123->getRefMotifAbsence()->getLbMotiabse() . " : " .
                            "Le nombre de contractuels sur emplois permanents  est différent du tableau 2.1.2.2";

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2123idMa_" . json_encode($ind2123->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.2");
                    $incoherenceLog->setIdToggle1("toggle212");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2123 == 0 && $total_2122 > 0) {
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
        if ($questionCollectiviteConsolide->getQ1() == true) {
            // Test 2131
            foreach ($bilanSocialConsolide->getInd2131s() as $ind2131) {
                $total1 = ($ind2131->getR21311()!=null ? $ind2131->getR21311() : 0);
                $total2 = ($ind2131->getR21312()!=null ? $ind2131->getR21312() : 0);
                $total3 = ($ind2131->getR21313()!=null ? $ind2131->getR21313() : 0);
                $total4 = ($ind2131->getR21314()!=null ? $ind2131->getR21314() : 0);
                $total5 = ($ind2131->getR21315()!=null ? $ind2131->getR21315() : 0);
                $total6 = ($ind2131->getR21316()!=null ? $ind2131->getR21316() : 0);

                $message = "";
                if ($total5 < $total1) {
                    $message = "2.1.3.1 : Motif absence " . $ind2131->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre d'arrêts Hommes doit être supérieur au nombre de contractuels sur emplois non permanents Hommes";

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
                if ($total3 < $total1) {
                    $message = "2.1.3.1 : Motif absence " . $ind2131->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Hommes doit être supérieur au nombre de contractuels sur emplois non permanents Hommes";

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
                if ($total5 < $total3) {
                    $message = "2.1.3.1 : Motif absence " . $ind2131->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Hommes doit être supérieur au nombre d'arrêts Hommes";

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
                if ($total6 < $total2) {
                    $message = "2.1.3.1 : Motif absence " . $ind2131->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre d'arrêts Femmes doit être supérieur au nombre de contractuels sur emplois non permanents Femmes";

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
                    $message = "2.1.3.1 : Motif absence " . $ind2131->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Femmes doit être supérieur au nombre de contractuels sur emplois non permanents Femmes";

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
                if ($total6 < $total4) {
                    $message = "2.1.3.1 : Motif absence " . $ind2131->getRefMotifAbsence()->getLbMotiabse() . " : " . "Le nombre de journées d'absence Femmes doit être supérieur au nombre d'arrêts Femmes";

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

                $total1 = ($ind2132->getR21321()!=null ? $ind2132->getR21321() : 0);
                $total2 = ($ind2132->getR21322()!=null ? $ind2132->getR21322() : 0);
                $total3 = ($ind2132->getR21323()!=null ? $ind2132->getR21323() : 0);
                $total4 = ($ind2132->getR21324()!=null ? $ind2132->getR21324() : 0);
                $total5 = ($ind2132->getR21325()!=null ? $ind2132->getR21325() : 0);
                $total6 = ($ind2132->getR21326()!=null ? $ind2132->getR21326() : 0);
                $total7 = ($ind2132->getR21327()!=null ? $ind2132->getR21327() : 0);
                $total8 = ($ind2132->getR21328()!=null ? $ind2132->getR21328() : 0);
                $total9 = ($ind2132->getR21329()!=null ? $ind2132->getR21329() : 0);
                $total10 = ($ind2132->getR213210()!=null ? $ind2132->getR213210() : 0);
                $total_2132 = $total1+$total2+$total3+$total4+$total5+$total6+$total7+$total8+$total9+$total10;

                $total_2131 = 0;
                foreach ($bilanSocialConsolide->getInd2131s() as $ind2131) {
                    $idMa1 = $ind2131->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa2==$idMa1) {
                        $total11 = ($ind2131->getR21311()!=null ? $ind2131->getR21311() : 0);
                        $total12 = ($ind2131->getR21312()!=null ? $ind2131->getR21312() : 0);
                        $total_2131 = $total11 + $total12;
                        break;
                    }
                }

                $total_2133 = 0;
                foreach ($bilanSocialConsolide->getInd2133s() as $ind2133) {
                    $idMa3 = $ind2133->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa2==$idMa3) {
                        $total31 = ($ind2133->getR21331()!=null ? $ind2133->getR21331() : 0);
                        $total32 = ($ind2133->getR21332()!=null ? $ind2133->getR21332() : 0);
                        $total33 = ($ind2133->getR21333()!=null ? $ind2133->getR21333() : 0);
                        $total34 = ($ind2133->getR21334()!=null ? $ind2133->getR21334() : 0);
                        $total35 = ($ind2133->getR21335()!=null ? $ind2133->getR21335() : 0);
                        $total36 = ($ind2133->getR21336()!=null ? $ind2133->getR21336() : 0);
                        $total37 = ($ind2133->getR21337()!=null ? $ind2133->getR21337() : 0);
                        $total38 = ($ind2133->getR21338()!=null ? $ind2133->getR21338() : 0);
                        $total39 = ($ind2133->getR21339()!=null ? $ind2133->getR21339() : 0);
                        $total310 = ($ind2133->getR213310()!=null ? $ind2133->getR213310() : 0);
                        $total_2133 = $total31+$total32+$total33+$total34+$total35+$total36+$total37+$total38+$total39+$total310;
                        break;
                    }
                }

                $message = "";
                if ($total_2132 != $total_2131) {
                    $message = "2.1.3.2 : Motif absence " . $ind2132->getRefMotifAbsence()->getLbMotiabse() . " : " .
                            "Le nombre de fonctionnaire est différent du tableau 2.1.3.1";

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

                $message = "";
                if ($total_2132 != $total_2133) {
                    $message = "2.1.3.2 : Motif absence " . $ind2132->getRefMotifAbsence()->getLbMotiabse() . " : " .
                            "Le nombre de contractuels sur emplois non permanents est différent du tableau 2.1.3.3";

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2132idMa_" . json_encode($ind2132->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.3");
                    $incoherenceLog->setIdToggle1("toggle213");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2132 == 0 && $total_2133 > 0) {
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

                $total1 = ($ind2133->getR21331()!=null ? $ind2133->getR21331() : 0);
                $total2 = ($ind2133->getR21332()!=null ? $ind2133->getR21332() : 0);
                $total3 = ($ind2133->getR21333()!=null ? $ind2133->getR21333() : 0);
                $total4 = ($ind2133->getR21334()!=null ? $ind2133->getR21334() : 0);
                $total5 = ($ind2133->getR21335()!=null ? $ind2133->getR21335() : 0);
                $total6 = ($ind2133->getR21336()!=null ? $ind2133->getR21336() : 0);
                $total7 = ($ind2133->getR21337()!=null ? $ind2133->getR21337() : 0);
                $total8 = ($ind2133->getR21338()!=null ? $ind2133->getR21338() : 0);
                $total9 = ($ind2133->getR21339()!=null ? $ind2133->getR21339() : 0);
                $total10 = ($ind2133->getR213310()!=null ? $ind2133->getR213310() : 0);
                $total_2133 = $total1+$total2+$total3+$total4+$total5+$total6+$total7+$total8+$total9+$total10;

                $total_2131 = 0;
                foreach ($bilanSocialConsolide->getInd2131s() as $ind2131) {
                    $idMa1 = $ind2131->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa3==$idMa1) {
                        $total11 = ($ind2131->getR21311()!=null ? $ind2131->getR21311() : 0);
                        $total12 = ($ind2131->getR21312()!=null ? $ind2131->getR21312() : 0);
                        $total_2131 = $total11 + $total12;
                        break;
                    }
                }

                $total_2132 = 0;
                foreach ($bilanSocialConsolide->getInd2132s() as $ind2132) {
                    $idMa2 = $ind2132->getRefMotifAbsence()->getIdMotiabse();
                    if($idMa3==$idMa2) {
                        $total31 = ($ind2132->getR21321()!=null ? $ind2132->getR21321() : 0);
                        $total32 = ($ind2132->getR21322()!=null ? $ind2132->getR21322() : 0);
                        $total33 = ($ind2132->getR21323()!=null ? $ind2132->getR21323() : 0);
                        $total34 = ($ind2132->getR21324()!=null ? $ind2132->getR21324() : 0);
                        $total35 = ($ind2132->getR21325()!=null ? $ind2132->getR21325() : 0);
                        $total36 = ($ind2132->getR21326()!=null ? $ind2132->getR21326() : 0);
                        $total37 = ($ind2132->getR21327()!=null ? $ind2132->getR21327() : 0);
                        $total38 = ($ind2132->getR21328()!=null ? $ind2132->getR21328() : 0);
                        $total39 = ($ind2132->getR21329()!=null ? $ind2132->getR21329() : 0);
                        $total310 = ($ind2132->getR213210()!=null ? $ind2132->getR213210() : 0);
                        $total_2132 = $total31+$total32+$total33+$total34+$total35+$total36+$total37+$total38+$total39+$total310;
                        break;
                    }
                }

                $message = "";
                if ($total_2133 != $total_2131) {
                    $message = "2.1.3.3 : Motif absence " . $ind2133->getRefMotifAbsence()->getLbMotiabse() . " : " .
                            "Le nombre de contractuels sur emplois non permanents est différent du tableau 2.1.3.1";

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

                $message = "";
                if ($total_2133 != $total_2132) {
                    $message = "2.1.3.3 : Motif absence " . $ind2133->getRefMotifAbsence()->getLbMotiabse() . " : " .
                            "Le nombre de contractuels sur emplois non permanents est différent du tableau 2.1.3.2";

                    $incoherenceLog = new IncoherenceLog();
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                    $incoherenceLog->setField("2133idMa_" . json_encode($ind2133->getRefMotifAbsence()->getIdMotiabse()));
                    $incoherenceLog->setTableNum("2.1.3");
                    $incoherenceLog->setIdToggle1("toggle213");
                    $incoherenceLog->setIdToggle2("");
                    $incoherenceLog->setMessage($message);
                    $incoherenceLog->setForm("3");
                    $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);

                    if ($total_2133 == 0 && $total_2132 > 0) {
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
                if($idCatefirst==0) $idCatefirst = $ind214->getRefCategorie()->getIdCate();
                $total2141 += ($ind214->getR2141() == null ? 0 : $ind214->getR2141());
                $total2142 += ($ind214->getR2142() == null ? 0 : $ind214->getR2142());
            }

            $total21X1 = 0;
            $total21X2 = 0;

            $codeMotiAbseParternite = "ABS007";

            foreach ($bilanSocialConsolide->getInd2111s() as $ind2111) {
                $cdMaParternite = $ind2111->getRefMotifAbsence()->getCdMotiabse();
                if($cdMaParternite == $codeMotiAbseParternite) {
                    $total21X1 += ($ind2111->getR21111()!=null ? $ind2111->getR21111() : 0);
                    $total21X2 += ($ind2111->getR21113()!=null ? $ind2111->getR21113() : 0);
                    break;
                }
            }

            foreach ($bilanSocialConsolide->getInd2121s() as $ind2121) {
                $cdMaParternite = $ind2121->getRefMotifAbsence()->getCdMotiabse();
                if($cdMaParternite == $codeMotiAbseParternite) {
                    $total21X1 += ($ind2121->getR21211()!=null ? $ind2121->getR21211() : 0);
                    $total21X2 += ($ind2121->getR21213()!=null ? $ind2121->getR21213() : 0);
                    break;
                }
            }

            foreach ($bilanSocialConsolide->getInd2131s() as $ind2131) {
                $cdMaParternite = $ind2131->getRefMotifAbsence()->getCdMotiabse();
                if($cdMaParternite == $codeMotiAbseParternite) {
                    $total21X1 += ($ind2131->getR21311()!=null ? $ind2131->getR21311() : 0);
                    $total21X2 += ($ind2131->getR21313()!=null ? $ind2131->getR21313() : 0);
                    break;
                }
            }

            if ($total2141 != $total21X1) {
                $incoherenceLog = new IncoherenceLog();
                $incoherenceLog->setBilanSocialConsolide($bilanSocialConsolide);
                $incoherenceLog->setField("214idTr_" . json_encode($idCatefirst));
                $incoherenceLog->setTableNum("2.1.4");
                $incoherenceLog->setIdToggle1("toggle214");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage("Totaux des nombres d'agents non correspondants avec total de la ligne paternité sur 1.1.1, 1.1.2 et 1.1.3");
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
                $incoherenceLog->setField("214idTr_" . json_encode($idCatefirst));
                $incoherenceLog->setTableNum("2.1.4");
                $incoherenceLog->setIdToggle1("toggle214");
                $incoherenceLog->setIdToggle2("");
                $incoherenceLog->setMessage("Totaux des nombres totaux de journées d'absence non correspondants avec la somme des totaux de la ligne paternité sur 1.1.1, 1.1.2 et 1.1.3");
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



        // Incoherences 3.1.1
        $blIncoInd311 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true) {
            foreach ($bilanSocialConsolide->getInd311s() as $ind311) {
                if ($blIncoInd311 == 0)
                    $blIncoInd311 = 4;


                $totalHFDont = 0;
                if ($ind311->getR3113() != null) $totalHFDont += $ind311->getR3113();
                if ($ind311->getR3114() != null) $totalHFDont += $ind311->getR3114();
                if ($ind311->getR3115() != null) $totalHFDont += $ind311->getR3115();
                if ($ind311->getR3116() != null) $totalHFDont += $ind311->getR3116();
                if ($ind311->getR3117() != null) $totalHFDont += $ind311->getR3117();
                if ($ind311->getR3118() != null) $totalHFDont += $ind311->getR3118();
                if ($ind311->getR3119() != null) $totalHFDont += $ind311->getR3119();
                if ($ind311->getR31110() != null) $totalHFDont += $ind311->getR31110();

                $totalHF = 0;
                if ($ind311->getR3111() != null) $totalHF += $ind311->getR3111();
                if ($ind311->getR3112() != null) $totalHF += $ind311->getR3112();

                $message = "";
                if ($totalHF < $totalHFDont) {
                    $message = "Categorie " . $ind311->getRefCategorie()->getLbCate() . " : " . "le total 3.1.1 doit être strictement supérieur à la somme des totaux 3.1.1.1 , 3.1.1.2, 3.1.1.3 et 3.1.1.4";
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

                $totalHDont = 0;
                if ($ind311->getR3113() != null) $totalHDont += $ind311->getR3113();
                if ($ind311->getR3115() != null) $totalHDont += $ind311->getR3115();
                if ($ind311->getR3117() != null) $totalHDont += $ind311->getR3117();
                if ($ind311->getR3119() != null) $totalHDont += $ind311->getR3119();

                $totalH = 0;
                if ($ind311->getR3111() != null) $totalH += $ind311->getR3111();


                $message = "";
                if ($totalH < $totalHDont) {
                    $message = "Categorie " . $ind311->getRefCategorie()->getLbCate() . " : " . "le total 3.1.1 Hommes doit être supérieur à la somme des totaux 3.1.1.1 , 3.1.1.2, 3.1.1.3 et 3.1.1.4 Hommes" ;
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
                if ($ind311->getR3114() != null) $totalFDont += $ind311->getR3114();
                if ($ind311->getR3116() != null) $totalFDont += $ind311->getR3116();
                if ($ind311->getR3118() != null) $totalFDont += $ind311->getR3118();
                if ($ind311->getR31110() != null) $totalFDont += $ind311->getR31110();

                $totalF = 0;
                if ($ind311->getR3112() != null) $totalF += $ind311->getR3112();

                $message = "";
                if ($totalF < $totalFDont) {
                    $message = "Categorie " . $ind311->getRefCategorie()->getLbCate() . " : " . "le total 3.1.1 Femmes doit être supérieur à la somme des totaux 3.1.1.1 , 3.1.1.2, 3.1.1.3 et 3.1.1.4 Femmes";
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
        }

        // Incoherences 3.2.1
        $blIncoInd321 = 0;
        if ($questionCollectiviteConsolide->getQ1() == true) {
            foreach ($bilanSocialConsolide->getInd321s() as $ind321) {
                if ($blIncoInd321 == 0)
                    $blIncoInd321 = 4;


                $totalHFDont = 0;
                if ($ind321->getR3213() != null) $totalHFDont += $ind321->getR3213();
                if ($ind321->getR3214() != null) $totalHFDont += $ind321->getR3214();
                if ($ind321->getR3215() != null) $totalHFDont += $ind321->getR3215();
                if ($ind321->getR3216() != null) $totalHFDont += $ind321->getR3216();

                $totalHF = 0;
                if ($ind321->getR3211() != null) $totalHF += $ind321->getR3211();
                if ($ind321->getR3212() != null) $totalHF += $ind321->getR3212();

                $message = "";
                if ($totalHF < $totalHFDont) {
                    $message = "Categorie " . $ind321->getRefCategorie()->getLbCate() . " : " . "le total 3.2.1 doit être strictement supérieur à la somme des totaux 3.2.1.1 et 3.2.1.2";
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

                $totalHDont = 0;
                if ($ind321->getR3213() != null) $totalHDont += $ind321->getR3213();
                if ($ind321->getR3215() != null) $totalHDont += $ind321->getR3215();

                $totalH = 0;
                if ($ind321->getR3211() != null) $totalH += $ind321->getR3211();


                $message = "";
                if ($totalH < $totalHDont) {
                    $message = "Categorie " . $ind321->getRefCategorie()->getLbCate() . " : " . "le total 3.2.1 Hommes doit être supérieur à la somme des totaux 3.2.1.1 et 3.2.1.2 Hommes" ;
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
                if ($ind321->getR3214() != null) $totalFDont += $ind321->getR3214();
                if ($ind321->getR3216() != null) $totalFDont += $ind321->getR3216();

                $totalF = 0;
                if ($ind321->getR3212() != null) $totalF += $ind321->getR3212();

                $message = "";
                if ($totalF < $totalFDont) {
                    $message = "Categorie " . $ind321->getRefCategorie()->getLbCate() . " : " . "le total 3.2.1 Femmes doit être supérieur à la somme des totaux 3.2.1.1 et 3.2.1.2 Femmes";
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
        }





        /* GESTION DES PROGRESSE BAR EFFECTIF */

        $blIncoEff111 = 0;

        if ($bilanSocialConsolide->getInd111s()->Count() == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd111(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd111(0);
            $blIncoEff111 = 1;
        } else if ($blIncoInd111 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd111(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd111(50);
            $blIncoEff111 = 3;
        } else {
//            aucune incodherence no donnee manq
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
        } else if ($blIncoInd112 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd112(2);
            $bilanSocialConsolide->setMoyenneInd112(50);
            $blIncoEff112 = 2;
        } else if ($blIncoInd112 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd112(3);
            $bilanSocialConsolide->setMoyenneInd112(50);
            $blIncoEff112 = 3;
        } else {
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
        } else if ($blIncoInd113 == 1) {
            $bilanSocialConsolide->setBlIncoInd113(2);
            $bilanSocialConsolide->setMoyenneInd113(50);
            $blIncoEff113 = 2;
        } else if ($blIncoInd113 == 2) {
            $bilanSocialConsolide->setBlIncoInd113(3);
            $bilanSocialConsolide->setMoyenneInd113(50);
            $blIncoEff113 = 3;
        } else {
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
        } else if ($blIncoInd114 == 1) {
            $bilanSocialConsolide->setBlIncoInd114(2);
            $bilanSocialConsolide->setMoyenneInd114(50);
            $moyenneInd114 = 50;
            $blIncoEff114 = 2;
        } else if ($blIncoInd114 == 2) {

            $bilanSocialConsolide->setBlIncoInd114(3);
            $bilanSocialConsolide->setMoyenneInd114(50);
            $moyenneInd114 = 50;
            $blIncoEff114 = 3;
        } else {
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
        } else if ($blIncoInd121 == 1) {
            $bilanSocialConsolide->setBlIncoInd121(2);
            $bilanSocialConsolide->setMoyenneInd121(50);
            $blIncoEff121 = 2;
        } else
        if ($blIncoInd121 == 2) {

            $bilanSocialConsolide->setBlIncoInd121(3);
            $bilanSocialConsolide->setMoyenneInd121(50);
            $blIncoEff121 = 3;
        } else {
            $bilanSocialConsolide->setBlIncoInd121(4);
            $bilanSocialConsolide->setMoyenneInd121(100);
            $blIncoEff121 = 4;
        }
        $blIncoEff122 = 0;
        if ($bilanSocialConsolide->getInd122s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd122(1);
            $bilanSocialConsolide->setMoyenneInd122(0);
            $blIncoEff122 = 1;
        } else if ($blIncoInd122 == 1) {
            $bilanSocialConsolide->setBlIncoInd122(2);
            $bilanSocialConsolide->setMoyenneInd122(50);
            $blIncoEff122 = 2;
        } else if ($blIncoInd122 == 2) {

            $bilanSocialConsolide->setBlIncoInd122(3);
            $bilanSocialConsolide->setMoyenneInd122(50);
            $blIncoEff122 = 3;
        } else {
            $bilanSocialConsolide->setBlIncoInd122(4);
            $bilanSocialConsolide->setMoyenneInd122(100);
            $blIncoEff122 = 4;
        }

        $blIncoEff123 = 0;
        if ($bilanSocialConsolide->getInd123s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd123(1);
            $bilanSocialConsolide->setMoyenneInd123(0);
            $blIncoEff123 = 1;
        } else if ($blIncoInd123 == 1) {
            $bilanSocialConsolide->setBlIncoInd123(2);
            $bilanSocialConsolide->setMoyenneInd123(50);
            $blIncoEff123 = 2;
        } else if ($blIncoInd123 == 2) {

            $bilanSocialConsolide->setBlIncoInd123(3);
            $bilanSocialConsolide->setMoyenneInd123(50);
            $blIncoEff123 = 3;
        } else {
            $bilanSocialConsolide->setBlIncoInd123(4);
            $bilanSocialConsolide->setMoyenneInd123(100);
            $blIncoEff123 = 4;
        }
        $blIncoEff124 = 0;
        if ($bilanSocialConsolide->getInd124s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd124(1);
            $bilanSocialConsolide->setMoyenneInd124(0);
            $blIncoEff124 = 1;
        } else if ($blIncoInd124 == 1) {
            $bilanSocialConsolide->setBlIncoInd124(2);
            $bilanSocialConsolide->setMoyenneInd124(50);
            $blIncoEff124 = 2;
        } else if ($blIncoInd124 == 2) {

            $bilanSocialConsolide->setBlIncoInd124(3);
            $bilanSocialConsolide->setMoyenneInd124(50);
            $blIncoEff124 = 3;
        } else {
            $bilanSocialConsolide->setBlIncoInd124(4);
            $bilanSocialConsolide->setMoyenneInd124(100);
            $blIncoEff124 = 4;
        }

        $blIncoEff131 = 0;
        if ($bilanSocialConsolide->getInd1311s()->Count() == 0) {
            $bilanSocialConsolide->setBlIncoInd131(1);
            $bilanSocialConsolide->setMoyenneInd131(0);
            $blIncoEff131 = 1;
        } else if ($blIncoInd131 == 1) {
            $bilanSocialConsolide->setBlIncoInd131(2);
            $bilanSocialConsolide->setMoyenneInd131(50);
            $blIncoEff131 = 2;
        } else if ($blIncoInd131 == 2) {

            $bilanSocialConsolide->setBlIncoInd131(3);
            $bilanSocialConsolide->setMoyenneInd131(50);
            $blIncoEff131 = 3;
        } else {
            $bilanSocialConsolide->setBlIncoInd131(4);
            $bilanSocialConsolide->setMoyenneInd131(100);
            $blIncoEff131 = 4;
        }


        $blIncoEff = 0;
        if (($blIncoEff111 == 3) || ($blIncoEff112 == 3) || ($blIncoEff113 == 3) || ($blIncoEff114 == 3) || ($blIncoEff121 == 3) || ($blIncoEff122 == 3) || ($blIncoEff123 == 3) || ($blIncoEff124 == 3) || ($blIncoEff131 == 3)) {
            $blIncoEff = 3;
        } elseif (($blIncoEff111 == 2) || ($blIncoEff112 == 2) || ($blIncoEff113 == 2) || ($blIncoEff114 == 2) || ($blIncoEff121 == 2) || ($blIncoEff122 == 2) || ($blIncoEff123 == 2) || ($blIncoEff124 == 2) || ($blIncoEff131 == 2)) {
            $blIncoEff = 2;
        } elseif (($blIncoEff111 == 1) && ($blIncoEff112 == 1) && ($blIncoEff113 == 1) && ($blIncoEff114 == 1) && ($blIncoEff121 == 1) && ($blIncoEff122 == 1) && ($blIncoEff123 == 1) && ($blIncoEff124 == 1) && ($blIncoEff131 == 1)) {
            $blIncoEff = 1;
        } elseif (($blIncoEff111 == 4 ) && ($blIncoEff112 == 4) && ($blIncoEff113 == 4) && ($blIncoEff114 == 4) && ($blIncoEff121 == 4) && ($blIncoEff122 == 4) && ($blIncoEff123 == 4) && ($blIncoEff124 == 4) && ($blIncoEff131 == 4)) {
            $blIncoEff = 4;
        }
        $bilanSocialConsolide->setBlIncoEff($blIncoEff);






        $blIncoMouv161 = 0;
        if ($bilanSocialConsolide->getInd161s()->Count() == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd161(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd161(0);
            $blIncoMouv161 = 1;
        } else if ($blIncoInd161 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd161(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd161(50);
            $blIncoMouv161 = 3;
        } else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd161(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd161(100);
            $blIncoMouv161 = 4;
        }

        $blIncoMouv = 0;
        if (($blIncoMouv161 == 3)) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoMouv = 3;
        } elseif (($blIncoMouv161 == 2)) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoMouv = 2;
        } elseif (($blIncoMouv161 == 1)) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoMouv = 1;
        } elseif (($blIncoMouv161 == 4)) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoMouv = 4;
        }
        $bilanSocialConsolide->setBlIncoMouv($blIncoMouv);


        $blIncoTpsTrav211 = 0;
        if ($bilanSocialConsolide->getInd2111s()->Count() == 0) {
            // pas d enregistrement => etat = 1
            $bilanSocialConsolide->setBlIncoInd211(1);
            $bilanSocialConsolide->setMoyenneInd211(0);
            $blIncoTpsTrav211 = 1;
        } else if ($blIncoInd211 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd211(2);
            $bilanSocialConsolide->setMoyenneInd211(50);
            $blIncoTpsTrav211 = 2;
        } else if ($blIncoInd211 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd211(3);
            $bilanSocialConsolide->setMoyenneInd211(50);
            $blIncoTpsTrav211 = 3;
        } else {
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
        } else if ($blIncoInd212 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd212(2);
            $bilanSocialConsolide->setMoyenneInd212(50);
            $blIncoTpsTrav212 = 2;
        } else if ($blIncoInd212 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd212(3);
            $bilanSocialConsolide->setMoyenneInd212(50);
            $blIncoTpsTrav212 = 3;
        } else {
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
        } else if ($blIncoInd213 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd213(2);
            $bilanSocialConsolide->setMoyenneInd213(50);
            $blIncoTpsTrav213 = 2;
        } else if ($blIncoInd213 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd213(3);
            $bilanSocialConsolide->setMoyenneInd213(50);
            $blIncoTpsTrav213 = 3;
        } else {
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
        } else if ($blIncoInd214 == 1) {
            // que des donnees manquantes
            $bilanSocialConsolide->setBlIncoInd214(2);
            $bilanSocialConsolide->setMoyenneInd214(50);
            $blIncoTpsTrav214 = 2;
        } else if ($blIncoInd214 == 2) {
            // au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd214(3);
            $bilanSocialConsolide->setMoyenneInd214(50);
            $blIncoTpsTrav214 = 3;
        } else {
            // des donnees mais aucun enregistrement dans incoh log
            $bilanSocialConsolide->setBlIncoInd214(4);
            $bilanSocialConsolide->setMoyenneInd214(100);
            $blIncoTpsTrav214 = 4;
        }

        $blIncoTpsTrav = 0;
        if ($blIncoTpsTrav211 == 3 || $blIncoTpsTrav212 == 3 || $blIncoTpsTrav213 == 3 || $blIncoTpsTrav214 == 3) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoTpsTrav = 3;
        } elseif ($blIncoTpsTrav211 == 2 || $blIncoTpsTrav212 == 2 || $blIncoTpsTrav213 == 2 || $blIncoTpsTrav214 == 2) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoTpsTrav = 2;
        } elseif ($blIncoTpsTrav211 == 1 && $blIncoTpsTrav212 == 1 && $blIncoTpsTrav213 == 1 && $blIncoTpsTrav214 == 1) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoTpsTrav = 1;
        } elseif ($blIncoTpsTrav211 == 4 && $blIncoTpsTrav212 == 4 && $blIncoTpsTrav213 == 4 && $blIncoTpsTrav214 == 4) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoTpsTrav = 4;
        }
        $bilanSocialConsolide->setBlIncoTpsTrav($blIncoTpsTrav);

        $blIncoConditions = 0;
        $bilanSocialConsolide->setBlIncoConditions($blIncoConditions);




        $blIncoRemuneration311 = 0;

        if ($bilanSocialConsolide->getInd311s()->Count() == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd311(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd311(0);
            $blIncoRemuneration311 = 1;
        } else if ($blIncoInd311 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd311(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd311(50);
            $blIncoRemuneration311 = 3;
        } else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd311(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd311(100);
            $blIncoRemuneration311 = 4;
        }

        $blIncoRemuneration321 = 0;

        if ($bilanSocialConsolide->getInd321s()->Count() == 0) {
//            pas de donnees
            $bilanSocialConsolide->setBlIncoInd321(1); // pas de donnees
            $bilanSocialConsolide->setMoyenneInd321(0);
            $blIncoRemuneration321 = 1;
        } else if ($blIncoInd321 == 2) {
//            au moins une incoherence
            $bilanSocialConsolide->setBlIncoInd321(3); // Au moins une incoherence présente
            $bilanSocialConsolide->setMoyenneInd321(50);
            $blIncoRemuneration321 = 3;
        } else {
//            aucune incodherence no donnee manq
            $bilanSocialConsolide->setBlIncoInd321(4); // OK  => que du null ou pas d'erreur
            $bilanSocialConsolide->setMoyenneInd321(100);
            $blIncoRemuneration321 = 4;
        }


        $blIncoRemuneration = 0;
        if ($blIncoRemuneration311 == 3 || $blIncoRemuneration321 == 3 ) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoRemuneration = 3;
        } elseif ($blIncoRemuneration311 == 2 || $blIncoRemuneration321 == 2) {
            // !!!!!!!!!!! on est sur des   OR
            $blIncoRemuneration = 2;
        } elseif ($blIncoRemuneration311 == 1 && $blIncoRemuneration321 == 1) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoRemuneration = 1;
        } elseif ($blIncoRemuneration311 == 4 && $blIncoRemuneration321 == 4) {
            // !!!!!!!!!!! on est sur des   AND
            $blIncoRemuneration = 4;
        }
        $bilanSocialConsolide->setBlIncoRemuneration($blIncoRemuneration);




        $em->flush();
    }





    public function EditBilanSocialConsolideAction(Request $request) {

        $user = $this->getUser();

        $session = $this->get('session');
        if (null == $session->get('coll_id')) {
            $idColl = $user->getCollectivite()->getIdColl();
        } else {
            $idColl = $session->get('coll_id');
        }

//        $idColl = $user->getCollectivite()->getIdColl();

        if ($idColl == null) {
            $this->addFlash(
                    'notice', 'Pas de collectivité associée'
            );
            return $this->render('@Conso/BilanSocialConsolide/edit.html.twig', array());
        }

        $em = $this->getDoctrine()->getManager();
        $ec = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->getEnqueteCollectiviteActive($idColl);
        if ($ec == null) {
            $this->addFlash(
                    'notice', 'Pas d\'enquête active pour la collectivité'
            );
            return $this->render('@Conso/BilanSocialConsolide/edit.html.twig', array());
        }

        // Find Enquete active
        $idEnqu = $ec->getEnquete()->getIdEnqu();

        if ($this->GetQuestionnaireAction($idColl, $idEnqu) == null) {
            return $this->redirectToRoute('bilan_conso_edit');
        }

        return $this->render('@Conso/BilanSocialConsolide/edit.html.twig', array());
    }

    public function ConsolideBackToApaAction() {


        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
//        $idColl = $user->getCollectivite()->getIdColl();
        $session = $this->get('session');
        if (null == $session->get('coll_id')) {
            $idColl = $user->getCollectivite()->getIdColl();
        } else {
            $idColl = $session->get('coll_id');
        }
        $ec = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->getEnqueteCollectiviteActive($idColl);

        $collectvite = $ec->getCollectivite();
        $enquete = $ec->getEnquete();

        // Find Enquete active
        $idEnqu = $ec->getEnquete()->getIdEnqu();

        $bilanSocialConsolide = $em->getRepository('ConsoBundle:BilanSocialConsolide')
                ->findOneByActif($idColl, $idEnqu);

        //enregistrement table historique bs -> changement type bs + retour à en cours de saisie
        $this->chgtEtatBilanSocial(0, $collectvite, $enquete);
        $em->remove($bilanSocialConsolide);
        $em->flush();

        $redirection = $this->redirectToRoute('bilansocialagent_index');

        return $redirection;
    }

    public function transmettreAction(Request $request) {
        $idBS = $request->get('idBS');
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();

        $res = $em->getRepository('ConsoBundle:BilanSocialConsolide')->find($idBS);

        $collectvite = $res->getCollectivite();
        $enquete = $res->getEnquete();

        if ($res->getFgStat() == 0) {
            $res->setFgStat(1);
            $etat = 1;
        } elseif ($res->getFgStat() == 4) {
            $res->setFgStat(5);
            $etat = 5;
        }


        $email = $current_user->getEmail();
        $contact = $collectvite->getCdgDepartement()->getCdg()->getContacts();
        $emailContact = $contact[0]->getLbMail();

        if($email !== '' && $email !== null && $emailContact !== '' && $emailContact !== null ){
            try {

//                $message = (new \Swift_Message('Transmission de votre bilan social'))
//                                    ->setFrom($email)
//                                    ->setTo($emailContact)
//                                    ->setBody(
//                                    $this->renderView(
//                                            '@User/Email/TransmissionBilanSocial.html.twig', array('user' => $current_user)
//                                    ), 'text/html'
//                            );
//                            try {
//                                $this->get('mailer')->send($message);
//                                $jsonContent = 'email_sent';
//                            } catch (Exception $ex) {
//                                $jsonContent = 'not_sent';
//                            }
                $this->chgtEtatBilanSocial($etat, $collectvite, $enquete);
                $res->setDtModi(new \DateTime());
                $res->setCdUtilmodi($current_user->getUsername());
                $em->persist($res);

                $this->addFlash('notice', 'Le bilan social a été transmis avec succès.');
                 $em->flush();
                 $resultat = 'done';
                } catch (Exception $ex) {
                $resultat  = $ex;
                $this->addFlash('notice', 'Une erreur est survenue, veuillez recommencer.');

               }
        }else{
            $this->addFlash('notice', 'Une erreur est survenue, veuillez recommencer.');
            $resultat = 'no email';
        }

        $response = new Response();
        $response->setContent(json_encode($resultat));

        return $response;
    }

    public function validerAction(Request $request) {
        $idBS = $request->get('idBS');
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();

        $res = $em->getRepository('ConsoBundle:BilanSocialConsolide')->find($idBS);

        $collectvite = $res->getCollectivite();
        $enquete = $res->getEnquete();

        $res->setFgStat(2);
        $res->setDtModi(new \DateTime());
        $res->setCdUtilmodi($current_user->getUsername());

        $this->chgtEtatBilanSocial(2, $collectvite, $enquete);

        try {
            $em->persist($res);
            $em->flush();

            $this->addFlash('notice', 'Le bilan social a été validé avec succès.');

            $resultat = 'done';
        } catch (Exception $ex) {
            $resultat = $ex;
            $this->addFlash('notice', 'Une erreur est survenue, veuillez recommencer.');
        }


        $response = new Response();
        $response->setContent(json_encode($resultat));

        return $response;
    }

    public function refuserAction(Request $request) {
        $idBS = $request->get('idBS');
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();

        $res = $em->getRepository('ConsoBundle:BilanSocialConsolide')->find($idBS);

        $collectvite = $res->getCollectivite();
        $enquete = $res->getEnquete();

        $res->setFgStat(3);
        $res->setDtModi(new \DateTime());
        $res->setCdUtilmodi($current_user->getUsername());

        $this->chgtEtatBilanSocial(3, $collectvite, $enquete);

        try {
            $em->persist($res);
            $em->flush();

            $this->addFlash('notice', 'Le bilan social a été refusé.');

            $resultat = 'done';
        } catch (Exception $ex) {
            $resultat = $ex;
            $this->addFlash('notice', 'Une erreur est survenue, veuillez recommencer.');
        }


        $response = new Response();
        $response->setContent(json_encode($resultat));

        return $response;
    }

    protected function chgtEtatBilanSocial($etat, $collectivite, $enquete) {
        $em = $this->getDoctrine()->getManager();
        $histBS = $em->getRepository('BilanSocialBundle:HistoriqueBilanSocial')->getLastHist($collectivite, $enquete);
        $histBSNew = new HistoriqueBilanSocial();
        $histBSNew->setDepartement($histBS[0]->getDepartement());
        $histBSNew->setCollectivite($histBS[0]->getCollectivite());
        $histBSNew->setEnquete($histBS[0]->getEnquete());
        $histBSNew->setFgStat($etat);
        $histBSNew->setDtChgt(new \DateTime());
        $histBSNew->setCdTypebilasoci(1);

        try {
            $em->persist($histBSNew);
            $em->flush();
        } catch (Exception $ex) {

        }
    }

}
