<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind152;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind1532;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind157;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind158;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind171;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind1612;

use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd150Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd151Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd152Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd1531Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd1532Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd154Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd157Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd158Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd171Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd161Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideEffectifInd162Type;
use Symfony\Component\HttpFoundation\JsonResponse;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Bilan_Social\Bundle\ConsoBundle\Controller\BilanSocialConsolideController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class BilanSocialConsolideMouvementController extends BilanSocialConsolideController {


   public $idFiliAotm = 11;
   public $idFiliHH = 14;

   public function GetResponseMouvement($code, $bilanSocialConsolide)
   {

       // if ($incoh->getForm() == '2')
       $json = $this->getNumberQuestion($bilanSocialConsolide);
       $json['data'] = $code;

       return new JsonResponse($json);
   }


    public function EditBilanSocialConsolideMouvAction(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();

        $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);
        $em = $this->getDoctrine()->getManager();
        $ind1501s = $em->getRepository('ConsoBundle:Ind1501')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind1502s = $em->getRepository('ConsoBundle:Ind1502')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind1511s = $em->getRepository('ConsoBundle:Ind1511')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind1512s = $em->getRepository('ConsoBundle:Ind1512')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind1513s = $em->getRepository('ConsoBundle:Ind1513')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind152s = $em->getRepository('ConsoBundle:Ind152')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind1531s = $em->getRepository('ConsoBundle:Ind1531')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind1532s = $em->getRepository('ConsoBundle:Ind1532')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind154s = $em->getRepository('ConsoBundle:Ind154')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind155s = $em->getRepository('ConsoBundle:Ind155')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
//        $ind156s = $em->getRepository('ConsoBundle:Ind156')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind157s = $em->getRepository('ConsoBundle:Ind157')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind158s = $em->getRepository('ConsoBundle:Ind158')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind161s = $em->getRepository('ConsoBundle:Ind161')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind1612s = $em->getRepository('ConsoBundle:Ind1612')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind171s = $em->getRepository('ConsoBundle:Ind171')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());

        //ind150
        $totalInd1501R15011 = 0;
        $totalInd1501R15012 = 0;
        $totalInd1501R15013 = 0;
        $totalInd1501R15014 = 0;
        $totalInd1501R15015 = 0;
        $totalInd1501R15016 = 0;
        $totalInd1501R15017 = 0;
        $totalInd1501R15018 = 0;
        foreach ($ind1501s as $ind1501) {
               $totalInd1501R15011 += $ind1501->getR15011(0);
               $totalInd1501R15012 += $ind1501->getR15012(0);
               $totalInd1501R15013 += $ind1501->getR15013(0);
               $totalInd1501R15014 += $ind1501->getR15014(0);
               $totalInd1501R15015 += $ind1501->getR15015(0);
               $totalInd1501R15016 += $ind1501->getR15016(0);
               $totalInd1501R15017 += $ind1501->getR15017(0);
               $totalInd1501R15018 += $ind1501->getR15018(0);
           }
        $totalInd1501 = $totalInd1501R15011 + $totalInd1501R15012 + $totalInd1501R15013 + $totalInd1501R15014 + $totalInd1501R15015 + $totalInd1501R15016 + $totalInd1501R15017 + $totalInd1501R15018;

        $totalInd1502R15021 = 0;
        $totalInd1502R15022 = 0;
        $totalInd1502R15023 = 0;
        $totalInd1502R15024 = 0;
        $totalInd1502R15025 = 0;
        $totalInd1502R15026 = 0;
        $totalInd1502R15027 = 0;
        $totalInd1502R15028 = 0;
        foreach ($ind1502s as $ind1502) {
               $totalInd1502R15021 += $ind1502->getR15021(0);
               $totalInd1502R15022 += $ind1502->getR15022(0);
               $totalInd1502R15023 += $ind1502->getR15023(0);
               $totalInd1502R15024 += $ind1502->getR15024(0);
               $totalInd1502R15025 += $ind1502->getR15025(0);
               $totalInd1502R15026 += $ind1502->getR15026(0);
               $totalInd1502R15027 += $ind1502->getR15027(0);
               $totalInd1502R15028 += $ind1502->getR15028(0);
           }
        $totalInd1502 = $totalInd1502R15021 + $totalInd1502R15022 + $totalInd1502R15023 + $totalInd1502R15024 + $totalInd1502R15025 + $totalInd1502R15026 + $totalInd1502R15027 + $totalInd1502R15028;

        $totalInd150 = $totalInd1501 + $totalInd1502;

         //ind151
        $totalInd1511R15111 = 0;
        $totalInd1511R15112 = 0;
        $totalInd1511R15113 = 0;
        $totalInd1511R15114 = 0;
        $totalInd1511R15115 = 0;
        $totalInd1511R15116 = 0;
        $totalInd1511R15117 = 0;
        $totalInd1511R15118 = 0;
        $totalInd1511R15119 = 0;
        $totalInd1511R151110 = 0;
        foreach ($ind1511s as $ind1511) {
               $totalInd1511R15111 += $ind1511->getR15111(0);
               $totalInd1511R15112 += $ind1511->getR15112(0);
               $totalInd1511R15113 += $ind1511->getR15113(0);
               $totalInd1511R15114 += $ind1511->getR15114(0);
               $totalInd1511R15115 += $ind1511->getR15115(0);
               $totalInd1511R15116 += $ind1511->getR15116(0);
               $totalInd1511R15117 += $ind1511->getR15117(0);
               $totalInd1511R15118 += $ind1511->getR15118(0);
               $totalInd1511R15119 += $ind1511->getR15119(0);
               $totalInd1511R151110 += $ind1511->getR151110(0);
           }
        $totalInd1511 = $totalInd1511R15111 + $totalInd1511R15112 + $totalInd1511R15113 + $totalInd1511R15114 + $totalInd1511R15115 + $totalInd1511R15116 + $totalInd1511R15117 + $totalInd1511R15118 + $totalInd1511R15119 + $totalInd1511R151110;

        $totalInd1512R15121 = 0;
        $totalInd1512R15122 = 0;
        $totalInd1512R15123 = 0;
        $totalInd1512R15124 = 0;
        $totalInd1512R15125 = 0;
        $totalInd1512R15126 = 0;
        $totalInd1512R15127 = 0;
        $totalInd1512R15128 = 0;
        $totalInd1512R15129 = 0;
        $totalInd1512R151210 = 0;
        foreach ($ind1512s as $ind1512) {
               $totalInd1512R15121 += $ind1512->getR15121(0);
               $totalInd1512R15122 += $ind1512->getR15122(0);
               $totalInd1512R15123 += $ind1512->getR15123(0);
               $totalInd1512R15124 += $ind1512->getR15124(0);
               $totalInd1512R15125 += $ind1512->getR15125(0);
               $totalInd1512R15126 += $ind1512->getR15126(0);
               $totalInd1512R15127 += $ind1512->getR15127(0);
               $totalInd1512R15128 += $ind1512->getR15128(0);
               $totalInd1512R15129 += $ind1512->getR15129(0);
               $totalInd1512R151210 += $ind1512->getR151210(0);
           }
        $totalInd1512 = $totalInd1512R15121 + $totalInd1512R15122 + $totalInd1512R15123 + $totalInd1512R15124 + $totalInd1512R15125 + $totalInd1512R15126 + $totalInd1512R15127 + $totalInd1512R15128 + $totalInd1512R15129 + $totalInd1512R151210;

        $totalInd1513R15131 = 0;
        $totalInd1513R15132 = 0;
        foreach ($ind1513s as $ind1513) {
               $totalInd1513R15131 += $ind1513->getR15131(0);
               $totalInd1513R15132 += $ind1513->getR15132(0);
           }
        $totalInd1513 = $totalInd1513R15131 + $totalInd1513R15132;

        $totalInd151 = $totalInd1511 + $totalInd1512 + $totalInd1513;

         //ind152
        $totalInd152R1521 = 0;
        $totalInd152R1522 = 0;
        $totalInd152R1523 = 0;
        $totalInd152R1524 = 0;
        $totalInd152R1525 = 0;
        $totalInd152R1526 = 0;
        $totalInd152R1527 = 0;
        $totalInd152R1528 = 0;
        $totalInd152R1529 = 0;
        $totalInd152R15210 = 0;
        $totalInd152R15211 = 0;
        $totalInd152R15212 = 0;
        $totalInd152R15213 = 0;
        $totalInd152R15214 = 0;
        $totalInd152R15215 = 0;
        $totalInd152R15216 = 0;
        $totalInd152R15217 = 0;
        $totalInd152R15218 = 0;
        $totalInd152R15219 = 0;
        $totalInd152R15220 = 0;
        $totalInd152R15221 = 0;
        foreach ($ind152s as $ind152) {
               $totalInd152R1521 += $ind152->getR1521(0);
               $totalInd152R1522 += $ind152->getR1522(0);
               $totalInd152R1523 += $ind152->getR1523(0);
               $totalInd152R1524 += $ind152->getR1524(0);
               $totalInd152R1525 += $ind152->getR1525(0);
               $totalInd152R1526 += $ind152->getR1526(0);
               $totalInd152R1527 += $ind152->getR1527(0);
               $totalInd152R1528 += $ind152->getR1528(0);
               $totalInd152R1529 += $ind152->getR1529(0);
               $totalInd152R15210 += $ind152->getR15210(0);
               $totalInd152R15211 += $ind152->getR15211(0);
               $totalInd152R15212 += $ind152->getR15212(0);
               $totalInd152R15213 += $ind152->getR15213(0);
               $totalInd152R15214 += $ind152->getR15214(0);
               $totalInd152R15215 += $ind152->getR15215(0);
               $totalInd152R15216 += $ind152->getR15216(0);
               $totalInd152R15217 += $ind152->getR15217(0);
               $totalInd152R15218 += $ind152->getR15218(0);
               $totalInd152R15219 += $ind152->getR15219(0);
               $totalInd152R15220 += $ind152->getR15220(0);
               $totalInd152R15221 += $ind152->getR15221(0);
           }
        $totalInd152 = $totalInd152R1521 + $totalInd152R1522 + $totalInd152R1523 + $totalInd152R1524 + $totalInd152R1525 + $totalInd152R1526 + $totalInd152R1527 + $totalInd152R1528 + $totalInd152R1529 + $totalInd152R15210 + $totalInd152R15211 + $totalInd152R15212 + $totalInd152R15213 + $totalInd152R15214 + $totalInd152R15215 + $totalInd152R15216 + $totalInd152R15217 + $totalInd152R15218 + $totalInd152R15219 + $totalInd152R15220 + $totalInd152R15221;

        //ind1531
        $totalInd1531R15311 = 0;
        $totalInd1531R15312 = 0;
        $totalInd1531R15313 = 0;
        $totalInd1531R15314 = 0;
        foreach ($ind1531s as $ind1531) {
               $totalInd1531R15311 += $ind1531->getR15311(0);
               $totalInd1531R15312 += $ind1531->getR15312(0);
               $totalInd1531R15313 += $ind1531->getR15313(0);
               $totalInd1531R15314 += $ind1531->getR15314(0);
           }
        $totalInd1531 = $totalInd1531R15311 + $totalInd1531R15312 + $totalInd1531R15313 + $totalInd1531R15314;

        //ind1532
        $totalInd1532R15321 = 0;
        $totalInd1532R15322 = 0;
        $totalInd1532R15323 = 0;
        $totalInd1532R15324 = 0;
        foreach ($ind1532s as $ind1532) {
               $totalInd1532R15321 += $ind1532->getR15321(0);
               $totalInd1532R15322 += $ind1532->getR15322(0);
               $totalInd1532R15323 += $ind1532->getR15323(0);
               $totalInd1532R15324 += $ind1532->getR15324(0);
           }
        $totalInd1532 = $totalInd1532R15321 + $totalInd1532R15322 + $totalInd1532R15323 + $totalInd1532R15324;

        //ind154-5-6
        $totalInd154R1541 = 0;
        $totalInd154R1542 = 0;
        foreach ($ind154s as $ind154) {
               $totalInd154R1541 += $ind154->getR1541(0);
               $totalInd154R1542 += $ind154->getR1542(0);
           }
        $totalInd154 = $totalInd154R1541 + $totalInd154R1542;

        $totalInd155R1551 = 0;
        $totalInd155R1552 = 0;
        foreach ($ind155s as $ind155) {
               $totalInd155R1551 += $ind155->getR1551(0);
               $totalInd155R1552 += $ind155->getR1552(0);
           }
        $totalInd155 = $totalInd155R1551 + $totalInd155R1552;

//        $totalInd156R1561 = 0;
//        $totalInd156R1562 = 0;
//        foreach ($ind156s as $ind156) {
//               $totalInd156R1561 += $ind156->getR1561(0);
//               $totalInd156R1562 += $ind156->getR1562(0);
//           }
//        $totalInd156 = $totalInd156R1561 + $totalInd156R1562;

//        $totalInd154_5_6 = $totalInd154 + $totalInd155 + $totalInd156;
        $totalInd154_5 = $totalInd154 + $totalInd155;

        //ind157
        $totalInd157R1571 = 0;
        $totalInd157R1572 = 0;
        foreach ($ind157s as $ind157) {
            $totalInd157R1571 += $ind157->getR1571(0);
            $totalInd157R1572 += $ind157->getR1572(0);
        }
        $totalInd157 = $totalInd157R1571 + $totalInd157R1572;

        //ind158
        $totalInd158R1581 = 0;
        $totalInd158R1582 = 0;
        $totalInd158R1583 = 0;
        $totalInd158R1584 = 0;
        $totalInd158R1585 = 0;
        $totalInd158R1586 = 0;
        $totalInd158R1587 = 0;
        $totalInd158R1588 = 0;
        foreach ($ind158s as $ind158) {
               $totalInd158R1581 += $ind158->getR1581(0);
               $totalInd158R1582 += $ind158->getR1582(0);
               $totalInd158R1583 += $ind158->getR1583(0);
               $totalInd158R1584 += $ind158->getR1584(0);
               $totalInd158R1585 += $ind158->getR1585(0);
               $totalInd158R1586 += $ind158->getR1586(0);
               $totalInd158R1587 += $ind158->getR1587(0);
               $totalInd158R1588 += $ind158->getR1588(0);
           }
        $totalInd158 = $totalInd158R1581 + $totalInd158R1582 + $totalInd158R1583 + $totalInd158R1584 + $totalInd158R1585 + $totalInd158R1586 + $totalInd158R1587 + $totalInd158R1588;

        //ind161
        $totalInd161R1611 = 0;
        $totalInd161R1612 = 0;
        $totalInd161R1613 = 0;
        $totalInd161R1614 = 0;
        foreach ($ind161s as $ind161) {
               $totalInd161R1611 += $ind161->getR1611(0);
               $totalInd161R1612 += $ind161->getR1612(0);
               $totalInd161R1613 += $ind161->getR1613(0);
               $totalInd161R1614 += $ind161->getR1614(0);
           }
        $totalInd161_0 = $totalInd161R1611 + $totalInd161R1612 + $totalInd161R1613 + $totalInd161R1614;

        $totalInd1612R16121 = 0;
        $totalInd1612R16122 = 0;
        $totalInd1612R16123 = 0;
        $totalInd1612R16124 = 0;
        foreach ($ind1612s as $ind1612) {
               $totalInd1612R16121 += $ind1612->getR16121(0);
               $totalInd1612R16122 += $ind1612->getR16122(0);
               $totalInd1612R16123 += $ind1612->getR16123(0);
               $totalInd1612R16124 += $ind1612->getR16124(0);
           }
        $totalInd1612 = $totalInd1612R16121 + $totalInd1612R16122 + $totalInd1612R16123 + $totalInd1612R16124;

        $totalInd161 = $totalInd161_0 + $totalInd1612;
        //ind162
        $totalInd162R16211 = $bilanSocialConsolide->getR16211();
        $totalInd162R16212 = $bilanSocialConsolide->getR16212();
        $totalInd162R16213 = $bilanSocialConsolide->getR16213();
        $totalInd162R16214 = $bilanSocialConsolide->getR16214();
        
        $totalInd162 = $totalInd162R16211 + $totalInd162R16212 + $totalInd162R16213 + $totalInd162R16214;

         //ind171
        $totalInd171R1711 = 0;
        $totalInd171R1712 = 0;
        $totalInd171R1713 = 0;
        foreach ($ind171s as $ind171) {
               $totalInd171R1711 += $ind171->getR1711(0);
               $totalInd171R1712 += $ind171->getR1712(0);
               $totalInd171R1713 += $ind171->getR1713(0);
           }
        $totalInd171 = $totalInd171R1711 + $totalInd171R1712 + $totalInd171R1713;

        return $this->render('@Conso/BilanSocialConsolide/editMouvement.html.twig', array(
                    'questionCollectiviteConsolide' => $questionnaire,
                    'consolide' => $bilanSocialConsolide,
                    'incoherenceList' => ($bilanSocialConsolide == null ? null : $bilanSocialConsolide->getIncoherenceLogs()),
                    'nombreQuestion' => $nombreQuestion,
                    'canwrite' => $this->isUserCanWrite(),
                    'collectivite' => $this->getMaCollectivite(),
                    'totalInd150' => $totalInd150,
                    'totalInd151' => $totalInd151,
                    'totalInd152' => $totalInd152,
                    'totalInd1531' => $totalInd1531,
                    'totalInd1532' => $totalInd1532,
                    'totalInd154_5' => $totalInd154_5,
                    'totalInd157' => $totalInd157,
                    'totalInd158' => $totalInd158,
                    'totalInd161' => $totalInd161,
                    'totalInd162' => $totalInd162,
                    'totalInd171' => $totalInd171
        ));
    }

    public function EditBilanSocialConsolideEffecInd150Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ9() == true || $questionnaire->GetQ10() == true){
            $bsConsoIndPreparator->initIndicateurByName("Ind1501");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1501");
            $bsConsoIndPreparator->initIndicateurByName("Ind1502");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1502");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        // Calcul des données du tableau recap
        $nbArrives = 0;

        if ($bilanSocialConsolide->getInd152s() != null && $bilanSocialConsolide->getInd152s()->count() > 0) {
            // 1.5.2 (colonne total 1 toutes filiere)
            foreach ($bilanSocialConsolide->getInd152s() as $ind152) {
                $nbArrives += $ind152->getR1521(0);
                $nbArrives += $ind152->getR1522(0);
                $nbArrives += $ind152->getR1523(0);
                $nbArrives += $ind152->getR1524(0);
                $nbArrives += $ind152->getR1525(0);
                $nbArrives += $ind152->getR1526(0);
                $nbArrives += $ind152->getR1527(0);
                $nbArrives += $ind152->getR1528(0);
                $nbArrives += $ind152->getR1529(0);
                $nbArrives += $ind152->getR15210(0);
                $nbArrives += $ind152->getR15211(0);
                $nbArrives += $ind152->getR15212(0);
                $nbArrives += $ind152->getR15213(0);
                $nbArrives += $ind152->getR15214(0);
                $nbArrives += $ind152->getR15215(0);
                $nbArrives += $ind152->getR15216(0);
                $nbArrives += $ind152->getR15217(0);
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
                    $nbArrives += $ind1531->getR15311(0);
                    $nbArrives += $ind1531->getR15312(0);
                    $nbArrives += $ind1531->getR15313(0);
                    $nbArrives += $ind1531->getR15314(0);
                }
            }
        }

        if ($bilanSocialConsolide->getInd1532s() != null && $bilanSocialConsolide->getInd1532s()->count() > 0) {
            // + 1.5.3.2 (colonne total Toute filiere colonne total grisé)
            foreach ($bilanSocialConsolide->getInd1532s() as $ind1532) {
                $nbArrives += $ind1532->getR15321(0);
                $nbArrives += $ind1532->getR15322(0);
                $nbArrives += $ind1532->getR15323(0);
                $nbArrives += $ind1532->getR15324(0);
            }
        }

        $nbDeparts = 0;

        if ($bilanSocialConsolide->getInd1501s() != null && $bilanSocialConsolide->getInd1501s()->count() > 0) {
            foreach ($bilanSocialConsolide->getInd1501s() as $ind1501) {
                $nbDeparts += $ind1501->getR15011(0);
                $nbDeparts += $ind1501->getR15012(0);
                $nbDeparts += $ind1501->getR15013(0);
                $nbDeparts += $ind1501->getR15014(0);
                $nbDeparts += $ind1501->getR15015(0);
                $nbDeparts += $ind1501->getR15016(0);
                $nbDeparts += $ind1501->getR15017(0);
                $nbDeparts += $ind1501->getR15018(0);
            }
        }

        if ($bilanSocialConsolide->getInd1502s() != null && $bilanSocialConsolide->getInd1502s()->count() > 0) {
            foreach ($bilanSocialConsolide->getInd1502s() as $ind1502) {
                $nbDeparts += $ind1502->getR15021(0);
                $nbDeparts += $ind1502->getR15022(0);
                $nbDeparts += $ind1502->getR15023(0);
                $nbDeparts += $ind1502->getR15024(0);
                $nbDeparts += $ind1502->getR15025(0);
                $nbDeparts += $ind1502->getR15026(0);
                $nbDeparts += $ind1502->getR15027(0);
                $nbDeparts += $ind1502->getR15028(0);
            }
        }

        $nbAgents = 0;

        if ($bilanSocialConsolide->getInd111s() != null && $bilanSocialConsolide->getInd111s()->count() > 0) {
            foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                $nbAgents += $ind111->getR1115(0);
                $nbAgents += $ind111->getR1116(0);
            }
        }

        if ($bilanSocialConsolide->getInd121s() != null && $bilanSocialConsolide->getInd121s()->count() > 0) {
            foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                $nbAgents += $ind121->getR1211(0);
                $nbAgents += $ind121->getR1212(0);
                $nbAgents += $ind121->getR1213(0);
                $nbAgents += $ind121->getR1214(0);
                $nbAgents += $ind121->getR1215(0);
                $nbAgents += $ind121->getR1216(0);
                $nbAgents += $ind121->getR1217(0);
                $nbAgents += $ind121->getR1218(0);
                $nbAgents += $ind121->getR12118(0);
            }
        }
       
        $nbTotal = $nbAgents + $nbDeparts - $nbArrives   ;
      
        // Set des elements du form
        $formEffectif150 = $this->createForm(BilanSocialConsolideEffectifInd150Type::class, $bilanSocialConsolide);
        $formEffectif150->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif150->isSubmitted()) {

            $fgstat = $formEffectif150['valide']->getData();

            // Traitement Submit du form en AJAX
            if (!$formEffectif150->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getInd1501s() as $ind1501) {
                    if ($ind1501->getId1501() == null || $ind1501->getId1501() == 0) {
                        $ind1501->setDtCrea($now);
                        $this->getEntityManager()->persist($ind1501);
                        $bilanSocialConsolide->getInd1501s()->add($ind1501);
                    }
                }

                foreach ($bilanSocialConsolide->getInd1502s() as $ind1502) {
                    if ($ind1502->getId1502() == null || $ind1502->getId1502() == 0) {
                        $ind1502->setDtCrea($now);
                        $this->getEntityManager()->persist($ind1502);
                        $bilanSocialConsolide->getInd1502s()->add($ind1502);
                    }
                }

                //error_log('before flush', 0);
                $bilanSocialConsolide->setInd150NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseMouvement("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd150.html.twig', array(
                    'formEffectif150' => $formEffectif150->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'nbArrives' => $nbArrives,
                    'nbDeparts' => $nbDeparts,
                    'nbAgents' => $nbAgents,
                    'nbTotal' => $nbTotal,
        ));
    }

    public function EditBilanSocialConsolideEffecInd151Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ7() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind1511");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1511");
            $bsConsoIndPreparator->initIndicateurByName("Ind1512");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1512");
            $bsConsoIndPreparator->initIndicateurByName("Ind1513");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1513");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        // Set des elements du form
        $formEffectif151 = $this->createForm(BilanSocialConsolideEffectifInd151Type::class, $bilanSocialConsolide);
        $formEffectif151->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif151->isSubmitted()) {

            $fgstat = $formEffectif151['valide']->getData();

            // Traitement Submit du form en AJAX
            if (!$formEffectif151->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd151NullToZero();

                //error_log('before flush', 0);
                $bilanSocialConsolide->setMoyenneInd151(100);
                $bilanSocialConsolide->setBlIncoInd151(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseMouvement("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd151.html.twig', array(
                    'formEffectif151' => $formEffectif151->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs()
        ));
    }

    public function EditBilanSocialConsolideEffecInd152Action(Request $request) {
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

        if ($questionnaire->GetQ12() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind152");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind152",$idFili);
            $bsConsoIndPreparator->initIndicateurByName("Ind152AOTM");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind152AOTM");
        }

        // Calcul Totaux hors filieres selectionné
        $totalInd152 = new Ind152(true);
        foreach ($bilanSocialConsolide->getInd152s() as $ind152) {
            if($ind152->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliAotm && $ind152->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliHH) {
                if ($idFili == null || $idFili != $ind152->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                    $totalInd152->cumulR152x($ind152);
                }
            }
        }

        $arrayTotalFiliere = array();
        foreach ($filieres as $filiere) {
            $arrayTotalFiliere[$filiere->getIdFili()] = null;
            foreach ($bilanSocialConsolide->getInd152s() as $key => $ind152) {
                if ($ind152->getRefCadreEmploi()->getRefFiliere()->getIdFili() == $filiere->getIdFili()) {
                    $totParFiliere = $ind152->getTotalParFiliere();
                    $arrayTotalFiliere[$filiere->getIdFili()] += $totParFiliere;
                }
            }
        }

        //error_log('ind152 before createform ' . $bilanSocialConsolide->getInd152sTemp()->count());
        // Set des elements du form
        $formEffectif152 = $this->createForm(BilanSocialConsolideEffectifInd152Type::class, $bilanSocialConsolide);
        //error_log('ind152 before handlerequest ' . $bilanSocialConsolide->getInd152sTemp()->count());
        $formEffectif152->handleRequest($request);
        // error_log('ind152  after handlerequest ' . $bilanSocialConsolide->getInd152sTemp()->count());

        $now = new DateTime('NOW');
        if ($formEffectif152->isSubmitted()) {
            $fgstat = $formEffectif152['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formEffectif152->isValid()) {
                echo "Form invalide";
                error_log($formEffectif152->getErrors(), 0);
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getInd152sTemp() as $ind152) {
                    if ($ind152->getId152() == null || $ind152->getId152() == 0) {
                        $ind152->setDtCrea($now);
                        $ind152->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind152);
                        $bilanSocialConsolide->getInd152s()->add($ind152);
                    }
                }
                foreach ($bilanSocialConsolide->getInd152AotmsTemp() as $ind152) {
                    if ($ind152->getId152() == null || $ind152->getId152() == 0) {
                        $ind152->setDtCrea($now);
                        $ind152->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind152);
                        $bilanSocialConsolide->getInd152s()->add($ind152);
                    }
                }

                $bilanSocialConsolide->setInd152NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                //error_log('before flush', 0);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

               // error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseMouvement("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd152.html.twig', array(
                    'formEffectif152' => $formEffectif152->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'filieres' => $filieres,
                    'idFili' => $idFili,
                    'totalInd152'                   => $totalInd152,
                    'arrayTotalFiliere'             => $arrayTotalFiliere
        ));
    }

    public function EditBilanSocialConsolideEffecInd1531Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ13() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind1531");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1531");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        // Set des elements du form
        $formEffectif153 = $this->createForm(BilanSocialConsolideEffectifInd1531Type::class, $bilanSocialConsolide);
        $formEffectif153->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif153->isSubmitted()) {
            $fgstat = $formEffectif153['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formEffectif153->isValid()) {
                echo "Form invalide";
                error_log($formEffectif153->getErrors(), 0);
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd1531NullToZero();
                //error_log('before flush', 0);
                $bilanSocialConsolide->setMoyenneInd1531(100);
                $bilanSocialConsolide->setBlIncoInd1531(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseMouvement("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd1531.html.twig', array(
                    'formEffectif153' => $formEffectif153->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs()
        ));
    }

    public function EditBilanSocialConsolideEffecInd1532Action(Request $request) {
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
        if ($questionnaire->GetQ13() == true){
            $bsConsoIndPreparator->initIndicateurByName("Ind1532");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1532",$idFili);
            $bsConsoIndPreparator->initIndicateurByName("Ind1532AOTM");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1532AOTM");
        }

        // Calcul Totaux hors filieres selectionné
        $totalInd1532 = new Ind1532(true);
        foreach ($bilanSocialConsolide->getInd1532s() as $ind1532) {
            if($ind1532->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliAotm && $ind1532->getRefCadreEmploi()->getRefFiliere()->getIdFili() != $this->idFiliHH) {
                if ($idFili == null || $idFili != $ind1532->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                    $totalInd1532->cumulR1532x($ind1532);
                }
            }
        }

        $arrayTotalFiliere = array();
        foreach ($filieres as $filiere) {
            $arrayTotalFiliere[$filiere->getIdFili()] = null;
            foreach ($bilanSocialConsolide->getInd1532s() as $key => $ind1532) {
                if ($ind1532->getRefCadreEmploi()->getRefFiliere()->getIdFili() == $filiere->getIdFili()) {
                    $totParFiliere = $ind1532->getTotalParFiliere();
                    $arrayTotalFiliere[$filiere->getIdFili()] += $totParFiliere;
                }
            }
        }

        //error_log('ind1532 before createform ' . $bilanSocialConsolide->getInd1532sTemp()->count());
        // Set des elements du form
        $formEffectif153 = $this->createForm(BilanSocialConsolideEffectifInd1532Type::class, $bilanSocialConsolide);
        $formEffectif153->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif153->isSubmitted()) {
            $fgstat = $formEffectif153['valide']->getData();
            // Traitement Submit du form en AJAX
            //error_log('submit', 0);
            if (!$formEffectif153->isValid()) {
                echo "Form invalide";
                error_log($formEffectif153->getErrors(), 0);
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getInd1532sTemp() as $ind1532) {
                    if ($ind1532->getId1532() == null || $ind1532->getId1532() == 0) {
                        $ind1532->setDtCrea($now);
                        $ind1532->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind1532);
                        $bilanSocialConsolide->getInd1532s()->add($ind1532);
                    }
                }
                foreach ($bilanSocialConsolide->getInd1532AotmsTemp() as $ind1532) {
                    if ($ind1532->getId1532() == null || $ind1532->getId1532() == 0) {
                        $ind1532->setDtCrea($now);
                        $ind1532->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind1532);
                        $bilanSocialConsolide->getInd1532s()->add($ind1532);
                    }
                }

                $bilanSocialConsolide->setInd1532NullToZero();

                //error_log('before flush', 0);
                $bilanSocialConsolide->setMoyenneInd1532(100);
                $bilanSocialConsolide->setBlIncoInd1532(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseMouvement("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd1532.html.twig', array(
                    'formEffectif153' => $formEffectif153->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'filieres' => $filieres,
                    'idFili' => $idFili,
                    'totalInd1532'                  => $totalInd1532,
                    'arrayTotalFiliere'             => $arrayTotalFiliere
        ));
    }

    public function EditBilanSocialConsolideEffecInd154Action(Request $request) {
        $refStageTitularisations = $this->getEntityManager()->getRepository('ReferencielBundle:RefStageTitularisation')->findBy(array('blVali' => false));
        $refAvancementPromotionConcours = $this->getEntityManager()->getRepository('ReferencielBundle:RefAvancementPromotionConcours')->findBy(array('blVali' => false));
        $refCategories = $this->getEntityManager()->getRepository('ReferencielBundle:RefCategorie')->findBy(array('blVali' => false));

        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ1() == true ) {
            $bsConsoIndPreparator->initIndicateurByName("Ind154");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind154");
            $bsConsoIndPreparator->initIndicateurByName("Ind155");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind155");
//            $bsConsoIndPreparator->initIndicateurByName("Ind156");
//            $bsConsoIndPreparator->moveIndTempToRealByName("Ind156");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

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

        $total154H = 0;
        $total154F = 0;
        foreach ($bilanSocialConsolide->getInd154s() as $ind154) {
            if($ind154->getRefStageTitularisation()->getCdStagtitu() == "SAUVADET") {
                $total154H += $ind154->getR1541(0);
                $total154F += $ind154->getR1542(0);
            }
        }


        // Set des elements du form
        $formEffectif154 = $this->createForm(BilanSocialConsolideEffectifInd154Type::class, $bilanSocialConsolide);
        $formEffectif154->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif154->isSubmitted()) {

            $fgstat = $formEffectif154['valide']->getData();

            // Traitement Submit du form en AJAX
            if (!$formEffectif154->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd154NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                //error_log('before flush', 0);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseMouvement("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd154.html.twig', array(
                    'formEffectif154' => $formEffectif154->createView(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'total150H' => $total150H,
                    'total150F' => $total150F,
                    'total154H' => $total154H,
                    'total154F' => $total154F
        ));
    }

    public function EditBilanSocialConsolideEffecInd157Action(Request $request) {
//        $refStageTitularisations = $this->getEntityManager()->getRepository('ReferencielBundle:RefStageTitularisation')->findBy(array('blVali' => false));
//        $refAvancementPromotionConcours = $this->getEntityManager()->getRepository('ReferencielBundle:RefAvancementPromotionConcours')->findBy(array('blVali' => false));
//        $refCategories = $this->getEntityManager()->getRepository('ReferencielBundle:RefCategorie')->findBy(array('blVali' => false));

        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ1() == true ) {
            $bsConsoIndPreparator->initIndicateurByName("Ind157");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind157");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $total157H = 0;
        $total157F = 0;
        foreach ($bilanSocialConsolide->getInd157s() as $ind157) {
                $total157H += $ind157->getR1571(0);
                $total157F += $ind157->getR1572(0);
        }

        // Set des elements du form
        $formEffectif157 = $this->createForm(BilanSocialConsolideEffectifInd157Type::class, $bilanSocialConsolide);
        $formEffectif157->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif157->isSubmitted()) {

            $fgstat = $formEffectif157['valide']->getData();

            // Traitement Submit du form en AJAX
//            if (!$formEffectif157->isValid()) {
//                echo "Form invalide";
//                exit;
//            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);
                $bilanSocialConsolide->setInd157NullToZero();
                $bilanSocialConsolide->setMoyenneInd157(100);
                $bilanSocialConsolide->setBlIncoInd157(4);
                $bilanSocialConsolide->setBlUpdated(true);

                //error_log('before flush', 0);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseMouvement("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd157.html.twig', array(
            'formEffectif157' => $formEffectif157->createView(),
            'questionCollectiviteConsolide' => $questionnaire,
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'total157H' => $total157H,
            'total157F' => $total157F
        ));
    }

    public function EditBilanSocialConsolideEffecInd158Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $filiereAotm = $this->getEntityManager()->getRepository('ReferencielBundle:RefFiliere')->findOneByIdFili($this->idFiliAotm);

        if ($questionnaire->GetQ1() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind158");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind158");
            $bsConsoIndPreparator->initIndicateurByName("Ind158AOTM");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind158AOTM");
        }

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formEffectif158 = $this->createForm(BilanSocialConsolideEffectifInd158Type::class, $bilanSocialConsolide);
        $formEffectif158->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif158->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formEffectif158->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                foreach ($bilanSocialConsolide->getInd158sTemp() as $ind158) {
                    if ($ind158->getId158() == null || $ind158->getId158() == 0) {
                        $ind158->setDtCrea($now);
                        $ind158->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind158);
                        $bilanSocialConsolide->getInd158s()->add($ind158);
                    }
                }

                foreach ($bilanSocialConsolide->getInd158AotmsTemp() as $ind158) {
                    if ($ind158->getId158() == null || $ind158->getId158() == 0) {
                        $ind158->setDtCrea($now);
                        $ind158->setCdUtilcrea($cdUtil);
                        $this->getEntityManager()->persist($ind158);
                        $bilanSocialConsolide->getInd158s()->add($ind158);
                    }
                }

                //error_log('before flush', 0);

                $bilanSocialConsolide->setInd158NullToZero();

                $bilanSocialConsolide->setMoyenneInd158(100);
                $bilanSocialConsolide->setBlIncoInd158(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseMouvement("1", $bilanSocialConsolide);

                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd158.html.twig', array(
                    'formEffectif158' => $formEffectif158->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideEffecInd161Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ2() == true || $questionnaire->GetQ4() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind161");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind161");
        }
        if ($questionnaire->GetQ6() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind1612");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind1612");
        }

        $bilanSocialConsolideClone = clone $bilanSocialConsolide;
        $bsConsoIndPreparator->setBs($bilanSocialConsolideClone);
        $bsConsoIndPreparator->initIndicateurByName("Ind161");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind161",null,array('force'=>true));
        $bsConsoIndPreparator->initIndicateurByName("Ind1612");
        $bsConsoIndPreparator->moveIndTempToRealByName("Ind1612",null,array('force'=>true));
        
        $nmSire = $this->getMaCollectivite()->getNmSire();
        $ancien_ind = [];
        $ancien_ind['ind_161'] = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind161", $bilanSocialConsolideClone);
        if(!empty($ancien_ind['ind_161'])){
            $ancien_ind['ind_1612'] = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind1612", $bilanSocialConsolideClone);
        }else{
            $ancien_ind = null;
        }

        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formEffectif161 = $this->createForm(BilanSocialConsolideEffectifInd161Type::class, $bilanSocialConsolide);
        $formEffectif161->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif161->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formEffectif161->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setInd161NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseMouvement("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd161.html.twig', array(
                    'formEffectif161' => $formEffectif161->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent' => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideEffecInd162Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $nmSire = $this->getMaCollectivite()->getNmSire();

        $ancien_ind = $this->get('bs_conso_precedent_preparator')->getIndPrecedent($this->getMaCampagne()->getNmAnne()-1, $nmSire, "ind162", $bilanSocialConsolide);

        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }


        $total111 = 0;
        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
            $total111 += $ind111->getR1115(0) + $ind111->getR1116(0);
        }

        $total121 = 0;
        foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
            $total121 += $ind121->getR1211(0) + $ind121->getR1212(0) + $ind121->getR1213(0) + $ind121->getR1214(0) +
                    $ind121->getR1215(0) + $ind121->getR1216(0) + $ind121->getR1217(0) + $ind121->getR1218(0) +
                    $ind121->getR12118(0);
        }

        $total161 = 0;
        foreach ($bilanSocialConsolide->getInd161s() as $ind161) {
            $total161 += $ind161->getR1611(0) + $ind161->getR1612(0) + $ind161->getR1613(0) + $ind161->getR1614(0);
        }


        $formEffectif162 = $this->createForm(BilanSocialConsolideEffectifInd162Type::class, $bilanSocialConsolide);
        $formEffectif162->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif162->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formEffectif162->isValid()) {
                echo "Form invalide";
                exit;
            }
            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }

                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setInd162NullToZero();
                $bilanSocialConsolide->setMoyenneInd162(100);
                $bilanSocialConsolide->setBlIncoInd162(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseMouvement("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd162.html.twig', array(
                    'formEffectif162' => $formEffectif162->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'total111' => $total111,
                    'total121' => $total121,
                    'total161' => $total161,
                    'questionCollectiviteConsolide' => $questionnaire,
                    'indicateur_precedent' => $ancien_ind
        ));
    }

    public function EditBilanSocialConsolideEffecInd171Action(Request $request) {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ2() == true || $questionnaire->GetQ4() == true || $questionnaire->GetQ6() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind171");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind171");
            $bsConsoIndPreparator->initIndicateurByName("Ind171E");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind171E");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $totalInd111H = 0;
        $totalInd111F = 0;
        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
            $totalInd111H += $ind111->getR1115(0);
            $totalInd111F += $ind111->getR1116(0);
        }

        $totalInd121H = 0;
        $totalInd121F = 0;
        foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
            $totalInd121H += ($ind121->getR12114(0) + $ind121->getR12115(0));
            $totalInd121F += ($ind121->getR12116(0) + $ind121->getR12117(0));
        }

        $totalInd131H = 0;
        $totalInd131F = 0;
        foreach ($bilanSocialConsolide->getInd1311s() as $ind131) {
            $totalInd131H += $ind131->getR13111(0);
            $totalInd131F += $ind131->getR13112(0);
        }

        $formEffectif171 = $this->createForm(BilanSocialConsolideEffectifInd171Type::class, $bilanSocialConsolide);
        $formEffectif171->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formEffectif171->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formEffectif171->isValid()) {
                echo "Form invalide";
                exit;
            }

            // Delete des lignes ensembles
            foreach ($bilanSocialConsolide->getInd171sTemp() as $ind171) {
                //error_log($ind171->getId171() . "-" . $ind171->getFgGenr());
                $this->getEntityManager()->remove($ind171);
            }

            $this->getEntityManager()->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                if ($bilanSocialConsolide->getFgStat() == 3) {
                    $this->chgtEtatBilanSocial(4, $this->getMaCollectivite(), $this->getMonEnquete());
                    $bilanSocialConsolide->setFgStat(4);
                }
                $bilanSocialConsolide->setEffectifDateAndUserModif($now, $cdUtil);

                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setInd171NullToZero();
                $bilanSocialConsolide->setMoyenneInd171(100);
                $bilanSocialConsolide->setBlIncoInd171(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseMouvement("1", $bilanSocialConsolide);
                //exit;
            } catch(UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException ". $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message ". $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseMouvement("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editEffectifInd171.html.twig', array(
                    'formEffectif171' => $formEffectif171->createView(),
                    'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
                    'totalInd111H' => $totalInd111H,
                    'totalInd111F' => $totalInd111F,
                    'totalInd121H'                  => $totalInd121H,
                    'totalInd121F'                  => $totalInd121F,
                    'totalInd131H'                  => $totalInd131H,
                    'totalInd131F'                  => $totalInd131F,
                    'questionCollectiviteConsolide' => $questionnaire
        ));
    }






}
