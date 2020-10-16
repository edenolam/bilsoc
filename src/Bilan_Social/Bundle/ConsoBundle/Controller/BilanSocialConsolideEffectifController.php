<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind111;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind112;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind113;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind114;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind121;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind122;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind123;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind124;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind1311;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind1312;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind132;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind132Bis;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind141;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind142;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind143;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind144;

use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd110Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd111Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd112Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd113Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd114Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd121Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd122Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd123Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd124Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd131Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd132Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd140Type;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Bilan_Social\Bundle\ConsoBundle\Controller\BilanSocialConsolideController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class BilanSocialConsolideEffectifController extends BilanSocialConsolideController {

    public $idFiliAotm = 11;

    public function GetResponse($code, $bilanSocialConsolide) {
        $json = $this->getNumberQuestion($bilanSocialConsolide);
        $json['data'] = $code;
        // nmForm = 1
        return new JsonResponse($json);
    }


    public function EditBilanSocialConsolideEffecAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();

        $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);
        $em = $this->getDoctrine()->getManager();
        $ind1101s = $em->getRepository('ConsoBundle:Ind1101')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind1102s = $em->getRepository('ConsoBundle:Ind1102')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind1103s = $em->getRepository('ConsoBundle:Ind1103')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind111s = $em->getRepository('ConsoBundle:Ind111')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind112s = $em->getRepository('ConsoBundle:Ind112')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind113s = $em->getRepository('ConsoBundle:Ind113')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind114s = $em->getRepository('ConsoBundle:Ind114')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind121s = $em->getRepository('ConsoBundle:Ind121')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind122s = $em->getRepository('ConsoBundle:Ind122')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind123s = $em->getRepository('ConsoBundle:Ind123')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind124s = $em->getRepository('ConsoBundle:Ind124')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind1311s = $em->getRepository('ConsoBundle:Ind1311')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind1312s = $em->getRepository('ConsoBundle:Ind1312')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind141s = $em->getRepository('ConsoBundle:Ind141')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind142s = $em->getRepository('ConsoBundle:Ind142')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind143s = $em->getRepository('ConsoBundle:Ind143')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind144s = $em->getRepository('ConsoBundle:Ind144')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind132s = $em->getRepository('ConsoBundle:Ind132')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind132Biss = $em->getRepository('ConsoBundle:Ind132Bis')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());

        //ind1101
        $totalInd1101R1101 = 0;
        $totalInd1101R1102 = 0;
        $totalInd1101R1103 = 0;
        $totalInd1101R1104 = 0;
        $totalInd1101R1105 = 0;
        $totalInd1101R1106 = 0;
        $totalInd1101R1107 = 0;
        $totalInd1101R1108 = 0;
        $totalInd1101R1109 = 0;
        $totalInd1101R1110 = 0;
        foreach ($ind1101s as $ind1101) {
            $totalInd1101R1101 += $ind1101->getR1101(0);
            $totalInd1101R1102 += $ind1101->getR1102(0);
            $totalInd1101R1103 += $ind1101->getR1103(0);
            $totalInd1101R1104 += $ind1101->getR1104(0);
            $totalInd1101R1105 += $ind1101->getR1105(0);
            $totalInd1101R1106 += $ind1101->getR1106(0);
            $totalInd1101R1107 += $ind1101->getR1107(0);
            $totalInd1101R1108 += $ind1101->getR1108(0);
            $totalInd1101R1109 += $ind1101->getR1109(0);
            $totalInd1101R1110 += $ind1101->getR1110(0);
        }
        $totalInd1101 = $totalInd1101R1101 + $totalInd1101R1102 + $totalInd1101R1103 + $totalInd1101R1104 + $totalInd1101R1105 + $totalInd1101R1106 + $totalInd1101R1107 + $totalInd1101R1108 + $totalInd1101R1109 + $totalInd1101R1110;
        //ind1102
        $totalInd1102R1101 = 0;
        $totalInd1102R1102 = 0;
        $totalInd1102R1103 = 0;
        $totalInd1102R1104 = 0;
        $totalInd1102R1105 = 0;
        $totalInd1102R1106 = 0;
        $totalInd1102R1107 = 0;
        $totalInd1102R1108 = 0;
        $totalInd1102R1109 = 0;
        $totalInd1102R1110 = 0;
        foreach ($ind1102s as $ind1102) {
            $totalInd1102R1101 += $ind1102->getR1101(0);
            $totalInd1102R1102 += $ind1102->getR1102(0);
            $totalInd1102R1103 += $ind1102->getR1103(0);
            $totalInd1102R1104 += $ind1102->getR1104(0);
            $totalInd1102R1105 += $ind1102->getR1105(0);
            $totalInd1102R1106 += $ind1102->getR1106(0);
            $totalInd1102R1107 += $ind1102->getR1107(0);
            $totalInd1102R1108 += $ind1102->getR1108(0);
            $totalInd1102R1109 += $ind1102->getR1109(0);
            $totalInd1102R1110 += $ind1102->getR1110(0);
        }
        $totalInd1102 = $totalInd1102R1101 + $totalInd1102R1102 + $totalInd1102R1103 + $totalInd1102R1104 + $totalInd1102R1105 + $totalInd1102R1106 + $totalInd1102R1107 + $totalInd1102R1108 + $totalInd1102R1109 + $totalInd1102R1110;
        //ind1103
        $totalInd1103R1101 = 0;
        $totalInd1103R1102 = 0;
        foreach ($ind1103s as $ind1103) {
               $totalInd1103R1101 += $ind1103->getR1101(0);
               $totalInd1103R1102 += $ind1103->getR1102(0);
           }
        $totalInd1103 = $totalInd1103R1101 + $totalInd1103R1102;

        $totalInd110 = $totalInd1101 + $totalInd1102 + $totalInd1103;
        //ind111
        $totalInd111R1111 = 0;
        $totalInd111R1112 = 0;
        $totalInd111R1113 = 0;
        $totalInd111R1114 = 0;
        $totalInd111R1115 = 0;
        $totalInd111R1116 = 0;
        foreach ($ind111s as $ind111) {
            $totalInd111R1111 += $ind111->getR1111();
            $totalInd111R1112 += $ind111->getR1112();
            $totalInd111R1113 += $ind111->getR1113();
            $totalInd111R1114 += $ind111->getR1114();
            $totalInd111R1115 += $ind111->getR1115();
            $totalInd111R1116 += $ind111->getR1116();
        }
        $totalInd111 = $totalInd111R1111 + $totalInd111R1112 + $totalInd111R1113 + $totalInd111R1114 + $totalInd111R1115 + $totalInd111R1116;
        //ind112
        $totalInd112R1121 = 0;
        $totalInd112R1122 = 0;
        $totalInd112R1123 = 0;
        $totalInd112R1124 = 0;
        $totalInd112R1125 = 0;
        $totalInd112R1126 = 0;
        foreach ($ind112s as $ind112) {
            $totalInd112R1121 += $ind112->getR1121();
            $totalInd112R1122 += $ind112->getR1122();
            $totalInd112R1123 += $ind112->getR1123();
            $totalInd112R1124 += $ind112->getR1124();
            $totalInd112R1125 += $ind112->getR1125();
            $totalInd112R1126 += $ind112->getR1126();
        }
        $totalInd112 = $totalInd112R1121 + $totalInd112R1122 + $totalInd112R1123 + $totalInd112R1124 + $totalInd112R1125 + $totalInd112R1126;
        //ind113
        $totalInd113R1131 = 0;
        $totalInd113R1132 = 0;
        foreach ($ind113s as $ind113) {
            $totalInd113R1131 += $ind113->getR1131();
            $totalInd113R1132 += $ind113->getR1132();
        }
        $totalInd113 = $totalInd113R1131 + $totalInd113R1132;
        //ind114
//        $totalInd114R1141 = 0;
//        $totalInd114R1142 = 0;
        $totalInd114R1143 = 0;
        $totalInd114R1144 = 0;
        foreach ($ind114s as $ind114) {
//            $totalInd114R1141 += $ind114->getR1141();
//            $totalInd114R1142 += $ind114->getR1142();
            $totalInd114R1143 += $ind114->getR1143();
            $totalInd114R1144 += $ind114->getR1144();
        }
       // $totalInd114 = $totalInd114R1141 + $totalInd114R1142 + $totalInd114R1143 + $totalInd114R1144;
        $totalInd114 = $totalInd114R1143 + $totalInd114R1144;
        //ind121
        $totalInd121R1211 = 0;
        $totalInd121R1212 = 0;
        $totalInd121R1213 = 0;
        $totalInd121R1214 = 0;
        $totalInd121R1215 = 0;
        $totalInd121R1216 = 0;
        $totalInd121R1217 = 0;
        $totalInd121R1218 = 0;
        $totalInd121R1219 = 0;
        $totalInd121R12110 = 0;
        $totalInd121R12111 = 0;
        $totalInd121R12112 = 0;
        $totalInd121R12113 = 0;
        $totalInd121R12114 = 0;
        $totalInd121R12115 = 0;
        $totalInd121R12116 = 0;
        $totalInd121R12117 = 0;
        $totalInd121R12118 = 0;
        foreach ($ind121s as $ind121) {
            $totalInd121R1211 += $ind121->getR1211();
            $totalInd121R1212 += $ind121->getR1212();
            $totalInd121R1213 += $ind121->getR1213();
            $totalInd121R1214 += $ind121->getR1214();
            $totalInd121R1215 += $ind121->getR1215();
            $totalInd121R1216 += $ind121->getR1216();
            $totalInd121R1217 += $ind121->getR1217();
            $totalInd121R1218 += $ind121->getR1218();
            $totalInd121R1219 += $ind121->getR1219();
            $totalInd121R12110 += $ind121->getR12110();
            $totalInd121R12111 += $ind121->getR12111();
            $totalInd121R12112 += $ind121->getR12112();
            $totalInd121R12113 += $ind121->getR12113();
            $totalInd121R12114 += $ind121->getR12114();
            $totalInd121R12115 += $ind121->getR12115();
            $totalInd121R12116 += $ind121->getR12116();
            $totalInd121R12117 += $ind121->getR12117();
            $totalInd121R12118 += $ind121->getR12118();
        }
        $totalInd121 = $totalInd121R1211 + $totalInd121R1212 + $totalInd121R1213 + $totalInd121R1214 + $totalInd121R1215 + $totalInd121R1216 + $totalInd121R1217 + $totalInd121R1218 + $totalInd121R1219 + $totalInd121R12110 + $totalInd121R12111 + $totalInd121R12112 + $totalInd121R12113 + $totalInd121R12114 + $totalInd121R12115 + $totalInd121R12116 + $totalInd121R12117 + $totalInd121R12118;
        //ind122
        $totalInd122R1221 = 0;
        $totalInd122R1222 = 0;
        $totalInd122R1223 = 0;
        $totalInd122R1224 = 0;
        $totalInd122R1225 = 0;
        $totalInd122R1226 = 0;
        $totalInd122R1227 = 0;
        $totalInd122R1228 = 0;
        foreach ($ind122s as $ind122) {
            $totalInd122R1221 += $ind122->getR1221();
            $totalInd122R1222 += $ind122->getR1222();
            $totalInd122R1223 += $ind122->getR1223();
            $totalInd122R1224 += $ind122->getR1224();
            $totalInd122R1225 += $ind122->getR1225();
            $totalInd122R1226 += $ind122->getR1226();
            $totalInd122R1227 += $ind122->getR1227();
            $totalInd122R1228 += $ind122->getR1228();
        }
        $totalInd122 = $totalInd122R1221 + $totalInd122R1222 + $totalInd122R1223 + $totalInd122R1224 + $totalInd122R1225 + $totalInd122R1226 + $totalInd122R1227 + $totalInd122R1228;
        //ind123
        $totalInd123R1231 = 0;
        $totalInd123R1232 = 0;
        foreach ($ind123s as $ind123) {
            $totalInd123R1231 += $ind123->getR1231();
            $totalInd123R1232 += $ind123->getR1232();
        }
        $totalInd123 = $totalInd123R1231 + $totalInd123R1232;
        //ind124
//        $totalInd124R1241 = 0;
//        $totalInd124R1242 = 0;
        $totalInd124R1243 = 0;
        $totalInd124R1244 = 0;
        foreach ($ind124s as $ind124) {
//            $totalInd124R1241 += $ind124->getR1241();
//            $totalInd124R1242 += $ind124->getR1242();
            $totalInd124R1243 += $ind124->getR1243();
            $totalInd124R1244 += $ind124->getR1244();
        }
        //$totalInd124 = $totalInd124R1241 + $totalInd124R1242 + $totalInd124R1243 + $totalInd124R1244;
        $totalInd124 = $totalInd124R1243 + $totalInd124R1244;
        //ind131
        $totalInd1311R13111 = 0;
        $totalInd1311R13112 = 0;
        $totalInd1311R13113 = 0;
        $totalInd1311R13114 = 0;
        foreach ($ind1311s as $ind1311) {
            $totalInd1311R13111 += $ind1311->getR13111();
            $totalInd1311R13112 += $ind1311->getR13112();
            $totalInd1311R13113 += $ind1311->getR13113();
            $totalInd1311R13114 += $ind1311->getR13114();
        }
        $totalInd1311 = $totalInd1311R13111 + $totalInd1311R13112 + $totalInd1311R13113 + $totalInd1311R13114;
//        $totalInd1312R13121 = 0;
//        $totalInd1312R13122 = 0;
        $totalInd1312R13123 = 0;
        $totalInd1312R13124 = 0;
        foreach ($ind1312s as $ind1312) {
//            $totalInd1312R13121 += $ind1312->getR13121();
//            $totalInd1312R13122 += $ind1312->getR13122();
            $totalInd1312R13123 += $ind1312->getR13123();
            $totalInd1312R13124 += $ind1312->getR13124();
        }
//        $totalInd1312 = $totalInd1312R13121 + $totalInd1312R13122 + $totalInd1312R13123 + $totalInd1312R13124;
        $totalInd1312 = $totalInd1312R13123 + $totalInd1312R13124;
        $totalInd131 = $totalInd1311 + $totalInd1312;
        //ind14
        $totalInd141R1411 = 0;
        $totalInd141R1412 = 0;
        foreach ($ind141s as $ind141) {
            $totalInd141R1411 += $ind141->getR1411();
            $totalInd141R1412 += $ind141->getR1412();
        }
        $totalInd141 = $totalInd141R1411 + $totalInd141R1412;

        $totalInd142R1421 = 0;
        $totalInd142R1422 = 0;
        $totalInd142R1423 = 0;
        $totalInd142R1424 = 0;
        $totalInd142R1425 = 0;
        $totalInd142R1426 = 0;
        foreach ($ind142s as $ind142) {
            $totalInd142R1421 += $ind142->getR1421();
            $totalInd142R1422 += $ind142->getR1422();
            $totalInd142R1423 += $ind142->getR1423();
            $totalInd142R1424 += $ind142->getR1424();
            $totalInd142R1425 += $ind142->getR1425();
            $totalInd142R1426 += $ind142->getR1426();
        }
        $totalInd142 = $totalInd142R1421 + $totalInd142R1422 + $totalInd142R1423 + $totalInd142R1424 + $totalInd142R1425 + $totalInd142R1426;

        $totalInd143R1431 = 0;
        $totalInd143R1432 = 0;
        $totalInd143R1433 = 0;
        $totalInd143R1434 = 0;
        foreach ($ind143s as $ind143) {
            $totalInd143R1431 += $ind143->getR1431();
            $totalInd143R1432 += $ind143->getR1432();
            $totalInd143R1433 += $ind143->getR1433();
            $totalInd143R1434 += $ind143->getR1434();
        }
        $totalInd143 = $totalInd143R1431 + $totalInd143R1432 + $totalInd143R1433 + $totalInd143R1434;

        $totalInd144R1441 = 0;
        $totalInd144R1442 = 0;
        foreach ($ind144s as $ind144) {
            $totalInd144R1441 += $ind144->getR1441();
            $totalInd144R1442 += $ind144->getR1442();
        }
        $totalInd144 = $totalInd144R1441 + $totalInd144R1442;

        $totalInd14 = $totalInd141 + $totalInd142 + $totalInd143 + $totalInd144;
        //ind132
        $totalInd132R13211 = 0;
        $totalInd132R13212 = 0;
        $totalInd132R13213 = 0;
        $totalInd132R13214 = 0;

        foreach ($ind132s as $ind132) {
            $totalInd132R13211 = $ind132->getR13211();
            $totalInd132R13212 = $ind132->getR13212();
            $totalInd132R13213 = $ind132->getR13213();
            $totalInd132R13214 = $ind132->getR13214();
        }

        $totalInd132R13221 = 0;
        $totalInd132R13222 = 0;
        $totalInd132R13223 = 0;
        $totalInd132R13224 = 0;

        foreach ($ind132Biss as $ind132Bis) {
            $totalInd132R13221 = $ind132Bis->getR13221();
            $totalInd132R13222 = $ind132Bis->getR13222();
            $totalInd132R13223 = $ind132Bis->getR13223();
            $totalInd132R13224 = $ind132Bis->getR13224();
        }

        $totalInd132 = $totalInd132R13211 + $totalInd132R13212 + $totalInd132R13213 + $totalInd132R13214 + $totalInd132R13221 + $totalInd132R13222 + $totalInd132R13223 + $totalInd132R13224;

        return $this->render('@Conso/BilanSocialConsolide/editEffectif.html.twig', array(
                    'questionCollectiviteConsolide' => $questionnaire,
                    'consolide' => $bilanSocialConsolide,
                    'incoherenceList' => ($bilanSocialConsolide == null ? null : $bilanSocialConsolide->getIncoherenceLogs()),
                    'nombreQuestion' => $nombreQuestion,
                    'canwrite' => $this->isUserCanWrite(),
                    'collectivite' => $this->getMaCollectivite(),
                    'totalInd110' => $totalInd110,
                    'totalInd111' => $totalInd111,
                    'totalInd112' => $totalInd112,
                    'totalInd113' => $totalInd113,
                    'totalInd114' => $totalInd114,
                    'totalInd121' => $totalInd121,
                    'totalInd122' => $totalInd122,
                    'totalInd123' => $totalInd123,
                    'totalInd124' => $totalInd124,
                    'totalInd131' => $totalInd131,
                    'totalInd14' => $totalInd14,
                    'totalInd132' => $totalInd132
        ));
    }

    public function EditBilanSocialConsolideEffecInd110Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ8() == true){
            $bsConsoIndPreparator->initIndicateurByName("Ind1101");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1101");
            $bsConsoIndPreparator->initIndicateurByName("Ind1102");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1102");
            $bsConsoIndPreparator->initIndicateurByName("Ind1103");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1103");
        }
        $nmSire = $this->getMaCollectivite()->getNmSire();

        $ancien_ind0 = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind1101", $bilanSocialConsolide);
        $ancien_ind1 = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind1102", $bilanSocialConsolide);
        $ancien_ind2 = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind1103", $bilanSocialConsolide);

        $ancien_ind = ($ancien_ind0 != null  && $ancien_ind1 != null && $ancien_ind2 != null) ? array($ancien_ind0,$ancien_ind1,$ancien_ind2) : null;

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $total111 = 0;
        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
            $total111 += $ind111->getR1115(0) + $ind111->getR1116(0);
        }

        $total121 = 0;
        foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
            $total121 += $ind121->getR1211(0) + $ind121->getR1212(0) + $ind121->getR1213(0) + $ind121->getR1214(0) +
                    $ind121->getR1215(0) + $ind121->getR1216(0) + $ind121->getR1217(0) + $ind121->getR1218(0) + $ind121->getR12118(0);
        }

        // Set des elements du form
        $formEffectif110 = $this->createForm(BilanSocialConsolideEffectifInd110Type::class, $bilanSocialConsolide);
        $formEffectif110->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif110->isSubmitted()) {

            $fgstat = $formEffectif110['valide']->getData();

            // Traitement Submit du form en AJAX
            if (!$formEffectif110->isValid()) {
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
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getInd1101sTemp() as $ind1101) {
                    if ($ind1101->getId1101() == null || $ind1101->getId1101() == 0) {
                        $ind1101->setDtCrea($now);
                        $ind1101->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind1101);
                        $bilanSocialConsolide->getInd1101s()->add($ind1101);
                    }
                }
                foreach ($bilanSocialConsolide->getInd1102sTemp() as $ind1102) {
                    if ($ind1102->getId1102() == null || $ind1102->getId1102() == 0) {
                        $ind1102->setDtCrea($now);
                        $ind1102->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind1102);
                        $bilanSocialConsolide->getInd1102s()->add($ind1102);
                    }
                }
                foreach ($bilanSocialConsolide->getInd1103sTemp() as $ind1103) {
                    if ($ind1103->getId1103() == null || $ind1103->getId1103() == 0) {
                        $ind1103->setDtCrea($now);
                        $ind1103->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind1103);
                        $bilanSocialConsolide->getInd1103s()->add($ind1103);
                    }
                }
                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd110NullToZero();
                $bilanSocialConsolide->setMoyenneInd110(100);
                $bilanSocialConsolide->setBlUpdated(true);
                //error_log('before flush', 0);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                // Retour d'un code pour le return ajax
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd110.html.twig', array(
                    'formEffectif110' => $formEffectif110->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'total111' => $total111,
                    'total121' => $total121,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'indicateur_precedent' => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideEffecInd111Action(Request $request) {
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();

        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $idFili = $request->query->get("idFili");

        //error_log('------------------------------------------------------------------', 0);
        //error_log('idfili ' . $idFili , 0);
        $filieres = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findByAllExceptAotmHorsFiliWithOrder();

        if ($questionnaire->GetQ2() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind111");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind111",$idFili);
            $bsConsoIndPreparator->initIndicateurByName("Ind111AOTM");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind111AOTM");
        }


        // Calcul Totaux hors filieres selectionné
        $totalInd111 = new Ind111(true);
        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
            if($ind111->getIdFili() != $this->idFiliAotm) {
                if ($idFili == null || $idFili != $ind111->getIdFili()) {
                    $totalInd111->cumulR111x($ind111);
                }
            }
        }

        $arrayTotalFiliere = array();
        foreach ($filieres as $filiere) {
            $arrayTotalFiliere[$filiere->getIdFili()] = null;
            foreach ($bilanSocialConsolide->getInd111s() as $key => $ind111) {
                if ($ind111->getIdFili() == $filiere->getIdFili()) {
                    $totParFiliere = $ind111->getTotalParFiliere();
                    $arrayTotalFiliere[$filiere->getIdFili()] += $totParFiliere;
                }
            }
        }

        //error_log('ind111 before createform ' . $bilanSocialConsolide->getInd111sTemp()->count());
        // Set des elements du form
        $formEffectif111 = $this->createForm(BilanSocialConsolideEffectifInd111Type::class, $bilanSocialConsolide);
        //error_log('ind111 before handlerequest ' . $bilanSocialConsolide->getInd111sTemp()->count());
        $formEffectif111->handleRequest($request);
        // error_log('ind111  after handlerequest ' . $bilanSocialConsolide->getInd111sTemp()->count());

        $now = new DateTime('NOW');
        if ($formEffectif111->isSubmitted()) {
            $fgstat = $formEffectif111['valide']->getData();

            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formEffectif111->isValid()) {
                echo "Form invalide";
                error_log($formEffectif111->getErrors(), 0);
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

                foreach ($bilanSocialConsolide->getInd111sTemp() as $ind111) {
                    if ($ind111->getId111() == null || $ind111->getId111() == 0) {
                        $ind111->setDtCrea($now);
                        $ind111->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind111);
                        $bilanSocialConsolide->getInd111s()->add($ind111);
                   }
                }

                foreach ($bilanSocialConsolide->getInd111AotmsTemp() as $ind111) {
                    if ($ind111->getId111() == null || $ind111->getId111() == 0) {
                        $ind111->setDtCrea($now);
                        $ind111->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind111);
                        $bilanSocialConsolide->getInd111s()->add($ind111);
                   }
                }
                

                $bilanSocialConsolide->setInd111NullToZero();
                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setBlUpdated(true);

                //error_log('before flush', 0);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                //error_log('after flush', 0);
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }

        $bilanSocialConsolideClone = clone $bilanSocialConsolide;
        $bsConsoIndPreparator->setBs($bilanSocialConsolideClone);
        $bsConsoIndPreparator->initIndicateurByName("Ind111");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind111",$idFili,array('force'=>true));
        $bsConsoIndPreparator->initIndicateurByName("Ind111AOTM");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind111AOTM",null,array('force'=>true));
        
        $nmSire = $this->getMaCollectivite()->getNmSire();
        $ancien_ind = null;
        $allInd = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind111", $bilanSocialConsolideClone);
        $lastFiliere = '';

        if($allInd!=null && is_array($allInd['indicateur'])){
            $ancien_ind = [];
            usort($allInd['indicateur'], function ($a, $b) {
                return $a['ID_CADREMPL'] <=> $b['ID_CADREMPL'];
            });

            foreach ($allInd['indicateur'] as $ind) {
                
                if ($lastFiliere != $ind['ID_FILI']) {
                    $ancien_ind['indicateur'][$ind['ID_FILI']] = [];
                    array_push($ancien_ind['indicateur'][$ind['ID_FILI']], $ind);
                } else {
                    array_push($ancien_ind['indicateur'][$ind['ID_FILI']], $ind);
                }

                $lastFiliere = $ind['ID_FILI'];
            }

            $ancien_ind['annee'] = $allInd['annee'];
        }

        $params = array(
            'bilanConso'                    => $bilanSocialConsolide,
            'formEffectif111'               => $formEffectif111->createView(),
            'questionCollectiviteConsolide' => $questionnaire,
            'filieres'                      => $filieres,
            'idFili'                        => $idFili,
            'incoherenceList'               => $bilanSocialConsolide->getIncoherenceLogs(),
            'totalInd111'                   => $totalInd111,
            'arrayTotalFiliere'             => $arrayTotalFiliere,
            'indicateur_precedent'          => $ancien_ind
        );
        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd111.html.twig', $params);
    }

    public function EditBilanSocialConsolideEffecInd112Action(Request $request) {
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $idFili = $request->query->get("idFili");

        //error_log('------------------------------------------------------------------', 0);
        //error_log('idfili ' . $idFili , 0);
        $filieres = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findByAllExceptAotmHorsFiliWithOrder();
        if ($questionnaire->GetQ2() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind112");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind112",$idFili);
            $bsConsoIndPreparator->initIndicateurByName("Ind112AOTM");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind112AOTM");
        }

        // Calcul Totaux hors filieres selectionné
        $totalInd112 = new Ind112(true);
        foreach ($bilanSocialConsolide->getInd112s() as $ind112) {
            if($ind112->getIdFili() != $this->idFiliAotm) {
                if ($idFili == null || $idFili != $ind112->getIdFili()) {
                    $totalInd112->cumulR112x($ind112);
                }
            }
        }

        $arrayTotalFiliere = array();
        foreach ($filieres as $filiere) {
            $arrayTotalFiliere[$filiere->getIdFili()] = null;
            foreach ($bilanSocialConsolide->getInd112s() as $key => $ind112) {
                if ($ind112->getIdFili() == $filiere->getIdFili()) {
                    $totParFiliere = $ind112->getTotalParFiliere();
                    $arrayTotalFiliere[$filiere->getIdFili()] += $totParFiliere;
                }
            }
        }

        $totalFiliereAdmin = 0;
        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
            if ($ind111->getRefGrade()->getRefCadreEmploi()->getRefFiliere()->getCdFili() == "AD") {
                $totalFiliereAdmin += $ind111->getR1111(0);
                $totalFiliereAdmin += $ind111->getR1112(0);
                $totalFiliereAdmin += $ind111->getR1113(0);
                $totalFiliereAdmin += $ind111->getR1114(0);
                $totalFiliereAdmin += $ind111->getR1115(0);
                $totalFiliereAdmin += $ind111->getR1116(0);
            }
        }

        //error_log('ind112 before createform ' . $bilanSocialConsolide->getInd112sTemp()->count());
        // Set des elements du form
        $formEffectif112 = $this->createForm(BilanSocialConsolideEffectifInd112Type::class, $bilanSocialConsolide);
        //error_log('ind112 before handlerequest ' . $bilanSocialConsolide->getInd112sTemp()->count());
        $formEffectif112->handleRequest($request);
        // error_log('ind112  after handlerequest ' . $bilanSocialConsolide->getInd112sTemp()->count());

        $now = new DateTime('NOW');
        if ($formEffectif112->isSubmitted()) {
            $fgstat = $formEffectif112['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formEffectif112->isValid()) {
                echo "Form invalide";
                error_log($formEffectif112->getErrors(), 0);
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

                // Remise à 0 des ind112 pour filiere AD si totalFiliereAdmin de ind111 = 0
                foreach ($bilanSocialConsolide->getInd112s() as $ind112) {
                    if ($ind112->getRefCadreEmploi()->getRefFiliere()->getCdFili() == "AD" && $totalFiliereAdmin == 0) {
                        $ind112->setR1121(null);
                        $ind112->setR1122(null);
                        $ind112->setR1123(null);
                        $ind112->setR1124(null);
                        $ind112->setR1125(null);
                        $ind112->setR1126(null);
                        $ind112->setR1127(null);
                        $ind112->setR1128(null);
                    }
                }

                foreach ($bilanSocialConsolide->getInd112sTemp() as $ind112) {
                    if ($ind112->getId112() == null || $ind112->getId112() == 0) {
                        $ind112->setDtCrea($now);
                        $ind112->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind112);
                        $bilanSocialConsolide->getInd112s()->add($ind112);
                    }
                }
                foreach ($bilanSocialConsolide->getInd112AotmsTemp() as $ind112) {
                    if ($ind112->getId112() == null || $ind112->getId112() == 0) {
                        $ind112->setDtCrea($now);
                        $ind112->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind112);
                        $bilanSocialConsolide->getInd112s()->add($ind112);
                    }
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                $bilanSocialConsolide->setInd112NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                //error_log('before flush', 0);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                //error_log('after flush', 0);
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd112.html.twig', array(
                    'formEffectif112' => $formEffectif112->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'filieres' => $filieres,
                    'idFili' => $idFili,
                    'totalInd112' => $totalInd112,
                    'totalFiliereAdmin'             => $totalFiliereAdmin,
                    'arrayTotalFiliere'             => $arrayTotalFiliere,
                    'bilanConso' => $bilanSocialConsolide
        ));
    }

    public function EditBilanSocialConsolideEffecInd113Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ2() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind113");
                $bsConsoIndPreparator->moveIndTempToRealByName("Ind113");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        foreach ($bilanSocialConsolide->getInd113s() as $ind113) {
            $totalInd112 = 0;

            foreach ($bilanSocialConsolide->getInd112s() as $ind112) {
                if ($ind112->getRefCadreEmploi()->getRefCategorie()->getIdCate() == $ind113->getRefCategorie()->getIdCate()) {
                    $totalInd112 += $ind112->getR1123(0) + $ind112->getR1124(0) + $ind112->getR1125(0) +
                                        $ind112->getR1126(0) + $ind112->getR1127(0) + $ind112->getR1128(0);
                }
            }

            $ind113->setTotalInd112($totalInd112);
        }

        $formEffectif113 = $this->createForm(BilanSocialConsolideEffectifInd113Type::class, $bilanSocialConsolide);
        $formEffectif113->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif113->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formEffectif113->isValid()) {
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

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd113NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                //error_log('after flush', 0);
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd113.html.twig', array(
                    'formEffectif113' => $formEffectif113->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideEffecInd114Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

//        if ($questionnaire->GetQ1() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind114");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind114");
//            $bsConsoIndPreparator->initIndicateurByName("Ind114AOTM");
//            $bsConsoIndPreparator->moveIndTempToRealByName("Ind114AOTM");
//        }
        $bilanSocialConsolide->setInd114NullToZero();

        $formEffectif114 = $this->createForm(BilanSocialConsolideEffectifInd114Type::class, $bilanSocialConsolide);
        $formEffectif114->handleRequest($request);
        $now = new DateTime('NOW');
        if ($formEffectif114->isSubmitted()) {
            // Traitement submit du form en AJAX
            /*if (!$formEffectif114->isValid()) {
                echo "Form invalide";
                exit;
            }*/
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

                foreach ($bilanSocialConsolide->getInd114sTemp() as $ind114) {
                    if ($ind114->getId114() == null || $ind114->getId114() == 0) {
                        $ind114->setDtCrea($now);
                        $ind114->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind114);
                        $bilanSocialConsolide->getInd114s()->add($ind114);
                    }
                }

//                foreach ($bilanSocialConsolide->getInd114AotmsTemp() as $ind114) {
//                    if ($ind114->getId114() == null || $ind114->getId114() == 0) {
//                        $ind114->setDtCrea($now);
//                        $ind114->setCdUtilcrea($cdUtil);
//                        $this->getEntityManager()->persist($ind114);
//                        $bilanSocialConsolide->getInd114s()->add($ind114);
//                    }
//                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd114NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                //error_log('after flush', 0);
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd114.html.twig', array(
                    'formEffectif114' => $formEffectif114->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideEffecInd121Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $idFili = $request->query->get("idFili");

        //error_log('------------------------------------------------------------------', 0);
        //error_log('idfili ' . $idFili , 0);
        $filieres = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findByAllExceptAotmHorsFiliWithOrder();

        if ($questionnaire->GetQ4() == true) {
            $bsConsoIndPreparator->initIndicateurByName('Ind121AOTM');
            $bsConsoIndPreparator->moveIndTempToRealByName('Ind121AOTM');
            $bsConsoIndPreparator->initIndicateurByName('Ind121');
            $bsConsoIndPreparator->moveIndTempToRealByName('Ind121',$idFili);
        }

        // Calcul Totaux hors filieres selectionné
        $totalInd121 = new Ind121(true);
        foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
            if($ind121->getIdFili() != $this->idFiliAotm) {
                if ($idFili == null || $idFili != $ind121->getIdFili()) {
                    $totalInd121->cumulR121x($ind121);
                }
            }
        }

        $arrayTotalFiliere = array();
        foreach ($filieres as $filiere) {
            $arrayTotalFiliere[$filiere->getIdFili()] = null;
            foreach ($bilanSocialConsolide->getInd121s() as $key => $ind121) {
                if ($ind121->getIdFili() == $filiere->getIdFili()) {
                    $totParFiliere = $ind121->getTotalParFiliere();
                    $arrayTotalFiliere[$filiere->getIdFili()] += $totParFiliere;
                }
            }
        }

        //error_log('ind111 before createform ' . $bilanSocialConsolide->getInd111sTemp()->count());
        // Set des elements du form
        $formEffectif121 = $this->createForm(BilanSocialConsolideEffectifInd121Type::class, $bilanSocialConsolide);
        //error_log('ind111 before handlerequest ' . $bilanSocialConsolide->getInd111sTemp()->count());
        $formEffectif121->handleRequest($request);
        // error_log('ind111  after handlerequest ' . $bilanSocialConsolide->getInd111sTemp()->count());

        $now = new DateTime('NOW');
        if ($formEffectif121->isSubmitted()) {
            $fgstat = $formEffectif121['valide']->getData();

            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formEffectif121->isValid()) {
                echo "Form invalide";
                error_log($formEffectif121->getErrors(), 0);
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($exist) {
                    $incoherenceLogRepository = $this->getEntityManager()->getRepository('CoreBundle:IncoherenceLog');
                    $incoherenceLogRepository->removeOlderIncoherenceBilan($bilanSocialConsolide->getIdBilasocicons());
                }

                // Association des incoherences
                $bilanSocialConsolide->setIncoherenceLogs(new ArrayCollection());

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getInd121sTemp() as $ind121) {
                    if ($ind121->getId121() == null || $ind121->getId121() == 0) {
                        $ind121->setDtCrea($now);
                        $ind121->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind121);
                        $bilanSocialConsolide->getInd121s()->add($ind121);
                    }
                }
                foreach ($bilanSocialConsolide->getInd121AotmsTemp() as $ind121) {
                    if ($ind121->getId121() == null || $ind121->getId121() == 0) {
                        $ind121->setDtCrea($now);
                        $ind121->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind121);
                        $bilanSocialConsolide->getInd121s()->add($ind121);
                    }
                }
                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd121NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                //error_log('before flush', 0);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                //error_log('after flush', 0);
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }

        $bilanSocialConsolideClone = clone $bilanSocialConsolide;
        $bsConsoIndPreparator->setBs($bilanSocialConsolideClone);
        $bsConsoIndPreparator->initIndicateurByName("Ind121");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind121",$idFili,array('force'=>true));
        $bsConsoIndPreparator->initIndicateurByName("Ind121AOTM");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind121AOTM",null,array('force'=>true));
        
        $nmSire = $this->getMaCollectivite()->getNmSire();
        $ancien_ind = null;
        $allInd = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind121", $bilanSocialConsolideClone);
        $lastCadreEmploi = '';
        if($allInd!=null && is_array($allInd['indicateur'])){
            $ancien_ind = [];
            usort($allInd['indicateur'], function ($a, $b) {
                return $a['ID_CADREMPL'] <=> $b['ID_CADREMPL'];
            });

            foreach ($allInd['indicateur'] as $ind) {
                
                if ($lastCadreEmploi != $ind['ID_FILI']) {
                    $ancien_ind['indicateur'][$ind['ID_FILI']] = [];
                    array_push($ancien_ind['indicateur'][$ind['ID_FILI']], $ind);
                } else {
                    array_push($ancien_ind['indicateur'][$ind['ID_FILI']], $ind);
                }

                $lastCadreEmploi = $ind['ID_FILI'];
            }

            $ancien_ind['annee'] = $allInd['annee'];
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd121.html.twig', array(
                    'formEffectif121' => $formEffectif121->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'filieres' => $filieres,
                    'idFili' => $idFili,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'totalInd121'                   => $totalInd121,
                    'arrayTotalFiliere'             => $arrayTotalFiliere,
                    'indicateur_precedent'          => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideEffecInd122Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $idFili = $request->query->get("idFili");

        //error_log('------------------------------------------------------------------', 0);
        //error_log('idfili ' . $idFili , 0);
        $filieres = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findByAllExceptAotmWithOrder();
        if ($questionnaire->GetQ4() == true) {
            $bsConsoIndPreparator->initIndicateurByName('Ind122AOTM');
            $bsConsoIndPreparator->moveIndTempToRealByName('Ind122AOTM');
            $bsConsoIndPreparator->initIndicateurByName('Ind122');
            $bsConsoIndPreparator->moveIndTempToRealByName('Ind122',$idFili);
        }

        $totalInd122 = new Ind122(true);
        foreach ($bilanSocialConsolide->getInd122s() as $ind122) {
            if($ind122->getIdFili() != $this->idFiliAotm) {
                if ($idFili == null || $idFili != $ind122->getIdFili()) {
                    $totalInd122->cumulR122x($ind122);
                }
            }
        }

        $arrayTotalFiliere = array();
        foreach ($filieres as $filiere) {
            $arrayTotalFiliere[$filiere->getIdFili()] = null;
            foreach ($bilanSocialConsolide->getInd122s() as $key => $ind122) {
                if ($ind122->getIdFili() == $filiere->getIdFili()) {
                    $totParFiliere = $ind122->getTotalParFiliere();
                    $arrayTotalFiliere[$filiere->getIdFili()] += $totParFiliere;
                }
            }
        }

        //error_log('ind112 before createform ' . $bilanSocialConsolide->getInd112sTemp()->count());
        // Set des elements du form
        $formEffectif122 = $this->createForm(BilanSocialConsolideEffectifInd122Type::class, $bilanSocialConsolide);
        //error_log('ind112 before handlerequest ' . $bilanSocialConsolide->getInd112sTemp()->count());
        $formEffectif122->handleRequest($request);
        // error_log('ind112  after handlerequest ' . $bilanSocialConsolide->getInd112sTemp()->count());

        $now = new DateTime('NOW');
        if ($formEffectif122->isSubmitted()) {
            $fgstat = $formEffectif122['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formEffectif122->isValid()) {
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

                foreach ($bilanSocialConsolide->getInd122sTemp() as $ind122) {
                    if ($ind122->getId122() == null || $ind122->getId122() == 0) {
                        $ind122->setDtCrea($now);
                        $ind122->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind122);
                        $bilanSocialConsolide->getInd122s()->add($ind122);
                    }
                }
                foreach ($bilanSocialConsolide->getInd122AotmsTemp() as $ind122) {
                    if ($ind122->getId122() == null || $ind122->getId122() == 0) {
                        $ind122->setDtCrea($now);
                        $ind122->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind122);
                        $bilanSocialConsolide->getInd122s()->add($ind122);
                    }
                }
                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd122NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                //error_log('before flush', 0);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                //error_log('after flush', 0);
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd122.html.twig', array(
                    'formEffectif122' => $formEffectif122->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'filieres' => $filieres,
                    'totalInd122' => $totalInd122,
                    'idFili'                        => $idFili,
                    'arrayTotalFiliere'             => $arrayTotalFiliere
        ));
    }

    public function EditBilanSocialConsolideEffecInd123Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ4() == true) {
            $bsConsoIndPreparator->initIndicateurByName('Ind123');
            $bsConsoIndPreparator->moveIndTempToRealByName('Ind123');
        }

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formEffectif123 = $this->createForm(BilanSocialConsolideEffectifInd123Type::class, $bilanSocialConsolide);
        $formEffectif123->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif123->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formEffectif123->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($exist) {
                    $incoherenceLogRepository = $this->getEntityManager()->getRepository('CoreBundle:IncoherenceLog');
                    $incoherenceLogRepository->removeOlderIncoherenceBilan($bilanSocialConsolide->getIdBilasocicons());
                }

                // Association des incoherences
                $bilanSocialConsolide->setIncoherenceLogs(new ArrayCollection());

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }
                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd123NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                //error_log('after flush', 0);
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd123.html.twig', array(
                    'formEffectif123' => $formEffectif123->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideEffecInd124Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        if ($questionnaire->GetQ3() == true) {
            $bsConsoIndPreparator->initIndicateurByName('Ind124');
            $bsConsoIndPreparator->moveIndTempToRealByName('Ind124');
//            $bsConsoIndPreparator->initIndicateurByName('Ind124AOTM');
//            $bsConsoIndPreparator->moveIndTempToRealByName('Ind124AOTM');
        }
        $bilanSocialConsolide->setInd124NullToZero();

        $formEffectif124 = $this->createForm(BilanSocialConsolideEffectifInd124Type::class, $bilanSocialConsolide);
        $formEffectif124->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif124->isSubmitted()) {
            // Traitement submit du form en AJAX
//            if (!$formEffectif124->isValid()) {
//                echo "Form invalide";
//                exit;
//            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getInd124sTemp() as $ind124) {
                    if ($ind124->getId124() == null || $ind124->getId124() == 0) {
                        $ind124->setDtCrea($now);
                        $ind124->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind124);
                        $bilanSocialConsolide->getInd124s()->add($ind124);
                    }
                }

//                foreach ($bilanSocialConsolide->getInd124AotmsTemp() as $ind124) {
//                    if ($ind124->getId124() == null || $ind124->getId124() == 0) {
//                        $ind124->setDtCrea($now);
//                        $ind124->setCdUtilcrea($cdUtil);
//                        $this->getEntityManager()->persist($ind124);
//                        $bilanSocialConsolide->getInd124s()->add($ind124);
//                    }
//                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd124NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                //error_log('after flush', 0);
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd124.html.twig', array(
                    'formEffectif124' => $formEffectif124->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideEffecInd131Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ5() == true || $questionnaire->GetQ6() == true) {
            $bsConsoIndPreparator->initIndicateurByName('Ind1311');
            $bsConsoIndPreparator->moveIndTempToRealByName('Ind1311');
            $bsConsoIndPreparator->initIndicateurByName('Ind1312');
            $bsConsoIndPreparator->moveIndTempToRealByName('Ind1312');
        }
        $bilanSocialConsolide->setInd131NullToZero();

        $nmSire = $this->getMaCollectivite()->getNmSire();
        $ancien_ind0 = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind1311", $bilanSocialConsolide);
        $ancien_ind1 = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind1312", $bilanSocialConsolide);

        $ancien_ind = ($ancien_ind0 != null  && $ancien_ind1 != null) ? array($ancien_ind0,$ancien_ind1) : null;

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        // Set des elements du form
        $formEffectif131 = $this->createForm(BilanSocialConsolideEffectifInd131Type::class, $bilanSocialConsolide, array('questionnaire' => $questionnaire));
        $formEffectif131->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif131->isSubmitted()) {

            $fgstat = $formEffectif131['valide']->getData();

            // Traitement Submit du form en AJAX
            if (!$formEffectif131->isValid()) {
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
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getInd1311sTemp() as $ind1311) {
                    if ($ind1311->getId1311() == null || $ind1311->getId1311() == 0) {
                        $ind1311->setDtCrea($now);
                        $ind1311->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind1311);
                        $bilanSocialConsolide->getInd1311s()->add($ind1311);
                    }
                }

                foreach ($bilanSocialConsolide->getInd1312sTemp() as $ind1312) {
                    if ($ind1312->getId1312() == null || $ind1312->getId1312() == 0) {
                        $ind1312->setDtCrea($now);
                        $ind1312->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind1312);
                        $bilanSocialConsolide->getInd1312s()->add($ind1312);
                    }
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd131NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                //error_log('before flush', 0);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                //error_log('after flush', 0);
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd131.html.twig', array(
                    'formEffectif131' => $formEffectif131->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'indicateur_precedent' => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideEffecInd132Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $bsConsoIndPreparator->initIndicateurByName('Ind132');
        $bsConsoIndPreparator->moveIndTempToRealByName('Ind132');
        $bsConsoIndPreparator->initIndicateurByName('Ind132Bis');
        $bsConsoIndPreparator->moveIndTempToRealByName('Ind132Bis');
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formEffectif132 = $this->createForm(BilanSocialConsolideEffectifInd132Type::class, $bilanSocialConsolide);
        $formEffectif132->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif132->isSubmitted()) {
            // Traitement submit du form en AJAX
//            if (!$formEffectif132->isValid()) {
//                echo "Form invalide";
//                exit;
//            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {

                // Gestion du Ind132
                if ($bilanSocialConsolide->getQ132() == null || $bilanSocialConsolide->getQ132() != 1) {
                    // Remove du datas ind132 (1 seule ligne)
                    foreach ($bilanSocialConsolide->getInd132s() as $ind132) {
                        $ind132->setR13211(null);
                        $ind132->setR13212(null);
                        $ind132->setR13213(null);
                        $ind132->setR13214(null);
                    }
                    foreach ($bilanSocialConsolide->getInd132Biss() as $ind132Bis) {
                        $ind132Bis->setR13221(null);
                        $ind132Bis->setR13222(null);
                        $ind132Bis->setR13223(null);
                        $ind132Bis->setR13224(null);
                    }
                }

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd132NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                //error_log('after flush', 0);
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd132.html.twig', array(
                    'formEffectif132' => $formEffectif132->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideEffecInd140Action(Request $request) {
        $posistat = $this->getEntityManager()->getRepository('ReferencielBundle:RefPositionStatutaire')->findByAllWithOrder();

        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $bsConsoIndPreparator->initIndicateurByName('Ind141');
        $bsConsoIndPreparator->moveIndTempToRealByName('Ind141');
        $bsConsoIndPreparator->initIndicateurByName('Ind142');
        $bsConsoIndPreparator->moveIndTempToRealByName('Ind142');
        $bsConsoIndPreparator->initIndicateurByName('Ind143');
        $bsConsoIndPreparator->moveIndTempToRealByName('Ind143');
        $bsConsoIndPreparator->initIndicateurByName('Ind144');
        $bsConsoIndPreparator->moveIndTempToRealByName('Ind144');

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        // Set des elements du form
        $formEffectif140 = $this->createForm(BilanSocialConsolideEffectifInd140Type::class, $bilanSocialConsolide);
        $formEffectif140->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif140->isSubmitted()) {

            $fgstat = $formEffectif140['valide']->getData();

            // Traitement Submit du form en AJAX
            if (!$formEffectif140->isValid()) {
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
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getInd141s() as $ind141) {
                    if ($ind141->getId141() == null || $ind141->getId141() == 0) {
                        $ind141->setDtCrea($now);
                        $this->getEntityManager()->persist($ind141);
                        $bilanSocialConsolide->getInd141s()->add($ind141);
                    }
                }

                foreach ($bilanSocialConsolide->getInd142s() as $ind142) {
                    if ($ind142->getId142() == null || $ind142->getId142() == 0) {
                        $ind142->setDtCrea($now);
                        $this->getEntityManager()->persist($ind142);
                        $bilanSocialConsolide->getInd142s()->add($ind142);
                    }
                }

                foreach ($bilanSocialConsolide->getInd143s() as $ind143) {
                    if ($ind143->getId143() == null || $ind143->getId143() == 0) {
                        $ind143->setDtCrea($now);
                        $this->getEntityManager()->persist($ind143);
                        $bilanSocialConsolide->getInd143s()->add($ind143);
                    }
                }

                foreach ($bilanSocialConsolide->getInd144s() as $ind144) {
                    if ($ind144->getId144() == null || $ind144->getId144() == 0) {
                        $ind144->setDtCrea($now);
                        $this->getEntityManager()->persist($ind144);
                        $bilanSocialConsolide->getInd144s()->add($ind144);
                    }                 }
                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd140NullToZero();

                //error_log('before flush', 0);
                $bilanSocialConsolide->setMoyenneInd140(100);
                $bilanSocialConsolide->setBlIncoInd140(4);
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                $this->getEntityManager()->getConnection()->commit();
                //error_log('after flush', 0);
                return $this->GetResponse("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponse("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponse("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd140.html.twig', array(
                    'formEffectif140' => $formEffectif140->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs()
        ));
    }
}
