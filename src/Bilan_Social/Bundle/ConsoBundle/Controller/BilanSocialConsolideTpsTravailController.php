<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind224;
use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd210Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd211Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd212Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd213Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd214Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd215Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd216Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd217Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd221Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd222Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd223Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd224Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd225Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd226Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind227Type;
use Bilan_Social\Bundle\ConsoBundle\Form\BilanSocialConsolideTpsTravInd231Type;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Collections\ArrayCollection;
use Bilan_Social\Bundle\ConsoBundle\Controller\BilanSocialConsolideController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class BilanSocialConsolideTpsTravailController extends BilanSocialConsolideController
{


    public function GetResponseTpsTrav($code, $bilanSocialConsolide)
    {
        $json = $this->getNumberQuestion($bilanSocialConsolide);
        // nbForm = 3
        $json['data'] = $code;

        return new JsonResponse($json);
    }


    public function EditBilanSocialConsolideTpsTravAction(Request $request, $anneeCampagne = null)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();

        $nombreQuestion = $this->getNumberQuestion($bilanSocialConsolide);
        $em = $this->getDoctrine()->getManager();
        $ind2111s = $em->getRepository('ConsoBundle:Ind2111')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2112s = $em->getRepository('ConsoBundle:Ind2112')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2113s = $em->getRepository('ConsoBundle:Ind2113')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2121s = $em->getRepository('ConsoBundle:Ind2121')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2122s = $em->getRepository('ConsoBundle:Ind2122')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2123s = $em->getRepository('ConsoBundle:Ind2123')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2131s = $em->getRepository('ConsoBundle:Ind2131')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2132s = $em->getRepository('ConsoBundle:Ind2132')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2133s = $em->getRepository('ConsoBundle:Ind2133')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind214s = $em->getRepository('ConsoBundle:Ind214')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind215s = $em->getRepository('ConsoBundle:Ind215')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind216s = $em->getRepository('ConsoBundle:Ind216')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind221s = $em->getRepository('ConsoBundle:Ind221')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind222s = $em->getRepository('ConsoBundle:Ind222')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2231s = $em->getRepository('ConsoBundle:Ind2231')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2232s = $em->getRepository('ConsoBundle:Ind2232')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2233s = $em->getRepository('ConsoBundle:Ind2233')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2261s = $em->getRepository('ConsoBundle:Ind2261')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2262s = $em->getRepository('ConsoBundle:Ind2262')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind2263s = $em->getRepository('ConsoBundle:Ind2263')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind224s = $em->getRepository('ConsoBundle:Ind224')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());
        $ind231s = $em->getRepository('ConsoBundle:Ind231')->findByBilanSocialConsolide($bilanSocialConsolide->getIdBilasocicons());

        $campagne = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        if ($anneeCampagne == null) {
            $anneeCampagne = $campagne->getNmAnne();
        }
        //ind210
        $totalInd210R2101 = $bilanSocialConsolide->getR2101();
        $totalInd210R2102 = $bilanSocialConsolide->getR2102();
        $totalInd210 = $totalInd210R2101 + $totalInd210R2102;

        //ind211
        $totalInd2111R21111 = 0;
        $totalInd2111R21112 = 0;
        $totalInd2111R21113 = 0;
        $totalInd2111R21114 = 0;
        $totalInd2111R21115 = 0;
        $totalInd2111R21116 = 0;
        foreach ($ind2111s as $ind2111) {
            $totalInd2111R21111 += $ind2111->getR21111(0);
            $totalInd2111R21112 += $ind2111->getR21112(0);
            $totalInd2111R21113 += $ind2111->getR21113(0);
            $totalInd2111R21114 += $ind2111->getR21114(0);
            $totalInd2111R21115 += $ind2111->getR21115(0);
            $totalInd2111R21116 += $ind2111->getR21116(0);
        }
        $totalInd2111 = $totalInd2111R21111 + $totalInd2111R21112 + $totalInd2111R21113 + $totalInd2111R21114 + $totalInd2111R21115 + $totalInd2111R21116;

        $totalInd2112R21121 = 0;
        $totalInd2112R21122 = 0;
        $totalInd2112R21123 = 0;
        $totalInd2112R21124 = 0;
        $totalInd2112R21125 = 0;
        $totalInd2112R21126 = 0;
        $totalInd2112R21127 = 0;
        $totalInd2112R21128 = 0;
        $totalInd2112R21129 = 0;
        $totalInd2112R211210 = 0;
        foreach ($ind2112s as $ind2112) {
            $totalInd2112R21121 += $ind2112->getR21121(0);
            $totalInd2112R21122 += $ind2112->getR21122(0);
            $totalInd2112R21123 += $ind2112->getR21123(0);
            $totalInd2112R21124 += $ind2112->getR21124(0);
            $totalInd2112R21125 += $ind2112->getR21125(0);
            $totalInd2112R21126 += $ind2112->getR21126(0);
            $totalInd2112R21127 += $ind2112->getR21127(0);
            $totalInd2112R21128 += $ind2112->getR21128(0);
            $totalInd2112R21129 += $ind2112->getR21129(0);
            $totalInd2112R211210 += $ind2112->getR211210(0);
        }
        $totalInd2112 = $totalInd2112R21121 + $totalInd2112R21122 + $totalInd2112R21123 + $totalInd2112R21124 + $totalInd2112R21125 + $totalInd2112R21126 + $totalInd2112R21127 + $totalInd2112R21128 + $totalInd2112R21129 + $totalInd2112R211210;

        $totalInd2113R21131 = 0;
        $totalInd2113R21132 = 0;
        $totalInd2113R21133 = 0;
        $totalInd2113R21134 = 0;
        $totalInd2113R21135 = 0;
        $totalInd2113R21136 = 0;
        $totalInd2113R21137 = 0;
        $totalInd2113R21138 = 0;
        $totalInd2113R21139 = 0;
        $totalInd2113R211310 = 0;
        foreach ($ind2113s as $ind2113) {
            $totalInd2113R21131 += $ind2113->getR21131(0);
            $totalInd2113R21132 += $ind2113->getR21132(0);
            $totalInd2113R21133 += $ind2113->getR21133(0);
            $totalInd2113R21134 += $ind2113->getR21134(0);
            $totalInd2113R21135 += $ind2113->getR21135(0);
            $totalInd2113R21136 += $ind2113->getR21136(0);
            $totalInd2113R21137 += $ind2113->getR21137(0);
            $totalInd2113R21138 += $ind2113->getR21138(0);
            $totalInd2113R21139 += $ind2113->getR21139(0);
            $totalInd2113R211310 += $ind2113->getR211310(0);
        }
        $totalInd2113 = $totalInd2113R21131 + $totalInd2113R21132 + $totalInd2113R21133 + $totalInd2113R21134 + $totalInd2113R21135 + $totalInd2113R21136 + $totalInd2113R21137 + $totalInd2113R21138 + $totalInd2113R21139 + $totalInd2113R211310;

        $totalInd211 = $totalInd2111 + $totalInd2112 + $totalInd2113;

        //ind212
        $totalInd2121R21211 = 0;
        $totalInd2121R21212 = 0;
        $totalInd2121R21213 = 0;
        $totalInd2121R21214 = 0;
        $totalInd2121R21215 = 0;
        $totalInd2121R21216 = 0;
        foreach ($ind2121s as $ind2121) {
            $totalInd2121R21211 += $ind2121->getR21211(0);
            $totalInd2121R21212 += $ind2121->getR21212(0);
            $totalInd2121R21213 += $ind2121->getR21213(0);
            $totalInd2121R21214 += $ind2121->getR21214(0);
            $totalInd2121R21215 += $ind2121->getR21215(0);
            $totalInd2121R21216 += $ind2121->getR21216(0);
        }
        $totalInd2121 = $totalInd2121R21211 + $totalInd2121R21212 + $totalInd2121R21213 + $totalInd2121R21214 + $totalInd2121R21215 + $totalInd2121R21216;

        $totalInd2122R21221 = 0;
        $totalInd2122R21222 = 0;
        $totalInd2122R21223 = 0;
        $totalInd2122R21224 = 0;
        $totalInd2122R21225 = 0;
        $totalInd2122R21226 = 0;
        $totalInd2122R21227 = 0;
        $totalInd2122R21228 = 0;
        $totalInd2122R21229 = 0;
        $totalInd2122R212210 = 0;
        foreach ($ind2122s as $ind2122) {
            $totalInd2122R21221 += $ind2122->getR21221(0);
            $totalInd2122R21222 += $ind2122->getR21222(0);
            $totalInd2122R21223 += $ind2122->getR21223(0);
            $totalInd2122R21224 += $ind2122->getR21224(0);
            $totalInd2122R21225 += $ind2122->getR21225(0);
            $totalInd2122R21226 += $ind2122->getR21226(0);
            $totalInd2122R21227 += $ind2122->getR21227(0);
            $totalInd2122R21228 += $ind2122->getR21228(0);
            $totalInd2122R21229 += $ind2122->getR21229(0);
            $totalInd2122R212210 += $ind2122->getR212210(0);
        }
        $totalInd2122 = $totalInd2122R21221 + $totalInd2122R21222 + $totalInd2122R21223 + $totalInd2122R21224 + $totalInd2122R21225 + $totalInd2122R21226 + $totalInd2122R21227 + $totalInd2122R21228 + $totalInd2122R21229 + $totalInd2122R212210;

        $totalInd2123R21231 = 0;
        $totalInd2123R21232 = 0;
        $totalInd2123R21233 = 0;
        $totalInd2123R21234 = 0;
        $totalInd2123R21235 = 0;
        $totalInd2123R21236 = 0;
        $totalInd2123R21237 = 0;
        $totalInd2123R21238 = 0;
        $totalInd2123R21239 = 0;
        $totalInd2123R212310 = 0;
        foreach ($ind2123s as $ind2123) {
            $totalInd2123R21231 += $ind2123->getR21231(0);
            $totalInd2123R21232 += $ind2123->getR21232(0);
            $totalInd2123R21233 += $ind2123->getR21233(0);
            $totalInd2123R21234 += $ind2123->getR21234(0);
            $totalInd2123R21235 += $ind2123->getR21235(0);
            $totalInd2123R21236 += $ind2123->getR21236(0);
            $totalInd2123R21237 += $ind2123->getR21237(0);
            $totalInd2123R21238 += $ind2123->getR21238(0);
            $totalInd2123R21239 += $ind2123->getR21239(0);
            $totalInd2123R212310 += $ind2123->getR212310(0);
        }
        $totalInd2123 = $totalInd2123R21231 + $totalInd2123R21232 + $totalInd2123R21233 + $totalInd2123R21234 + $totalInd2123R21235 + $totalInd2123R21236 + $totalInd2123R21237 + $totalInd2123R21238 + $totalInd2123R21239 + $totalInd2123R212310;

        $totalInd212 = $totalInd2121 + $totalInd2122 + $totalInd2123;

        //ind213
        $totalInd2131R21311 = 0;
        $totalInd2131R21312 = 0;
        $totalInd2131R21313 = 0;
        $totalInd2131R21314 = 0;
        $totalInd2131R21315 = 0;
        $totalInd2131R21316 = 0;
        foreach ($ind2131s as $ind2131) {
            $totalInd2131R21311 += $ind2131->getR21311(0);
            $totalInd2131R21312 += $ind2131->getR21312(0);
            $totalInd2131R21313 += $ind2131->getR21313(0);
            $totalInd2131R21314 += $ind2131->getR21314(0);
            $totalInd2131R21315 += $ind2131->getR21315(0);
            $totalInd2131R21316 += $ind2131->getR21316(0);
        }
        $totalInd2131 = $totalInd2131R21311 + $totalInd2131R21312 + $totalInd2131R21313 + $totalInd2131R21314 + $totalInd2131R21315 + $totalInd2131R21316;

        $totalInd2132R21321 = 0;
        $totalInd2132R21322 = 0;
        $totalInd2132R21323 = 0;
        $totalInd2132R21324 = 0;
        $totalInd2132R21325 = 0;
        $totalInd2132R21326 = 0;
        $totalInd2132R21327 = 0;
        $totalInd2132R21328 = 0;
        $totalInd2132R21329 = 0;
        $totalInd2132R213210 = 0;
        foreach ($ind2132s as $ind2132) {
            $totalInd2132R21321 += $ind2132->getR21321(0);
            $totalInd2132R21322 += $ind2132->getR21322(0);
            $totalInd2132R21323 += $ind2132->getR21323(0);
            $totalInd2132R21324 += $ind2132->getR21324(0);
            $totalInd2132R21325 += $ind2132->getR21325(0);
            $totalInd2132R21326 += $ind2132->getR21326(0);
            $totalInd2132R21327 += $ind2132->getR21327(0);
            $totalInd2132R21328 += $ind2132->getR21328(0);
            $totalInd2132R21329 += $ind2132->getR21329(0);
            $totalInd2132R213210 += $ind2132->getR213210(0);
        }
        $totalInd2132 = $totalInd2132R21321 + $totalInd2132R21322 + $totalInd2132R21323 + $totalInd2132R21324 + $totalInd2132R21325 + $totalInd2132R21326 + $totalInd2132R21327 + $totalInd2132R21328 + $totalInd2132R21329 + $totalInd2132R213210;

        $totalInd2133R21331 = 0;
        $totalInd2133R21332 = 0;
        $totalInd2133R21333 = 0;
        $totalInd2133R21334 = 0;
        $totalInd2133R21335 = 0;
        $totalInd2133R21336 = 0;
        $totalInd2133R21337 = 0;
        $totalInd2133R21338 = 0;
        $totalInd2133R21339 = 0;
        $totalInd2133R213310 = 0;
        foreach ($ind2133s as $ind2133) {
            $totalInd2133R21331 += $ind2133->getR21331(0);
            $totalInd2133R21332 += $ind2133->getR21332(0);
            $totalInd2133R21333 += $ind2133->getR21333(0);
            $totalInd2133R21334 += $ind2133->getR21334(0);
            $totalInd2133R21335 += $ind2133->getR21335(0);
            $totalInd2133R21336 += $ind2133->getR21336(0);
            $totalInd2133R21337 += $ind2133->getR21337(0);
            $totalInd2133R21338 += $ind2133->getR21338(0);
            $totalInd2133R21339 += $ind2133->getR21339(0);
            $totalInd2133R213310 += $ind2133->getR213310(0);
        }
        $totalInd2133 = $totalInd2133R21331 + $totalInd2133R21332 + $totalInd2133R21333 + $totalInd2133R21334 + $totalInd2133R21335 + $totalInd2133R21336 + $totalInd2133R21337 + $totalInd2133R21338 + $totalInd2133R21339 + $totalInd2133R213310;

        $totalInd213 = $totalInd2131 + $totalInd2132 + $totalInd2133;

        //ind214
        $totalInd214R2141 = 0;
        $totalInd214R2142 = 0;
        foreach ($ind214s as $ind214) {
            $totalInd214R2141 += $ind214->getR2141();
            $totalInd214R2142 += $ind214->getR2142();
        }
        $totalInd214 = $totalInd214R2141 + $totalInd214R2142;

        //ind215
        $totalInd215R2151 = 0;
        $totalInd215R2152 = 0;
        foreach ($ind215s as $ind215) {
            $totalInd215R2151 += $ind215->getR2151();
            $totalInd215R2152 += $ind215->getR2152();
        }
        $totalInd215 = $totalInd215R2151 + $totalInd215R2152;

        //ind216
        $totalInd216R2161 = 0;
        $totalInd216R2162 = 0;
        foreach ($ind216s as $ind216) {
            $totalInd216R2161 += $ind216->getR2161();
            $totalInd216R2162 += $ind216->getR2162();
        }
        $totalInd216 = $totalInd216R2161 + $totalInd216R2162;

        //ind221
        $totalInd221R2211 = 0;
        $totalInd221R2212 = 0;
        foreach ($ind221s as $ind221) {
            $totalInd221R2211 += $ind221->getR2211(0);
            $totalInd221R2212 += $ind221->getR2212(0);
        }
        $totalInd221 = $totalInd221R2211 + $totalInd221R2212;

        //ind222
        $totalInd222R2221 = 0;
        $totalInd222R2222 = 0;
        foreach ($ind222s as $ind222) {
            $totalInd222R2221 += $ind222->getR2221(0);
            $totalInd222R2222 += $ind222->getR2222(0);
        }
        $totalInd222 = $totalInd222R2221 + $totalInd222R2222;

        //ind223
        $totalInd2231R22311 = 0;
        $totalInd2231R22312 = 0;
        $totalInd2231R22313 = 0;
        $totalInd2231R22314 = 0;
        foreach ($ind2231s as $ind2231) {
            $totalInd2231R22311 += $ind2231->getR22311(0);
            $totalInd2231R22312 += $ind2231->getR22312(0);
            $totalInd2231R22313 += $ind2231->getR22313(0);
            $totalInd2231R22314 += $ind2231->getR22314(0);
        }
        $totalInd2231 = $totalInd2231R22311 + $totalInd2231R22312 + $totalInd2231R22313 + $totalInd2231R22314;

        $totalInd2232R22321 = 0;
        $totalInd2232R22322 = 0;
        $totalInd2232R22323 = 0;
        $totalInd2232R22324 = 0;
        foreach ($ind2232s as $ind2232) {
            $totalInd2232R22321 += $ind2232->getR22321(0);
            $totalInd2232R22322 += $ind2232->getR22322(0);
            $totalInd2232R22323 += $ind2232->getR22323(0);
            $totalInd2232R22324 += $ind2232->getR22324(0);
        }
        $totalInd2232 = $totalInd2232R22321 + $totalInd2232R22322 + $totalInd2232R22323 + $totalInd2232R22324;

        $totalInd2233R22331 = 0;
        $totalInd2233R22332 = 0;
        $totalInd2233R22333 = 0;
        $totalInd2233R22334 = 0;
        $totalInd2233R22335 = 0;
        $totalInd2233R22336 = 0;
        foreach ($ind2233s as $ind2233) {
            $totalInd2233R22331 += $ind2233->getR22331(0);
            $totalInd2233R22332 += $ind2233->getR22332(0);
            $totalInd2233R22333 += $ind2233->getR22333(0);
            $totalInd2233R22334 += $ind2233->getR22334(0);
            $totalInd2233R22335 += $ind2233->getR22335(0);
            $totalInd2233R22336 += $ind2233->getR22336(0);
        }
        $totalInd2233 = $totalInd2233R22331 + $totalInd2233R22332 + $totalInd2233R22333 + $totalInd2233R22334 + $totalInd2233R22335 + $totalInd2233R22336;

        $totalInd223 = $totalInd2231 + $totalInd2232 + $totalInd2233;

        //ind224
        $totalInd224R2241 = 0;
        $totalInd224R2242 = 0;
        $totalInd224R2243 = 0;
        $totalInd224R2244 = 0;
        $totalInd224R2245 = 0;
        $totalInd224R2246 = 0;
        $totalInd224R2247 = 0;
        $totalInd224R2248 = 0;
        $totalInd224R2249 = 0;
        $totalInd224R22410 = 0;
        $totalInd224R22411 = 0;
        $totalInd224R22412 = 0;
        $totalInd224R22413 = 0;
        $totalInd224R22414 = 0;
        $totalInd224R22415 = 0;
        $totalInd224R22416 = 0;
        foreach ($ind224s as $ind224) {
            $totalInd224R2241 += $ind224->getR2241(0);
            $totalInd224R2242 += $ind224->getR2242(0);
            $totalInd224R2243 += $ind224->getR2243(0);
            $totalInd224R2244 += $ind224->getR2244(0);
            $totalInd224R2245 += $ind224->getR2245(0);
            $totalInd224R2246 += $ind224->getR2246(0);
            $totalInd224R2247 += $ind224->getR2247(0);
            $totalInd224R2248 += $ind224->getR2248(0);
            $totalInd224R2249 += $ind224->getR2249(0);
            $totalInd224R22410 += $ind224->getR22410(0);
            $totalInd224R22411 += $ind224->getR22411(0);
            $totalInd224R22412 += $ind224->getR22412(0);
            $totalInd224R22413 += $ind224->getR22413(0);
            $totalInd224R22414 += $ind224->getR22414(0);
            $totalInd224R22415 += $ind224->getR22415(0);
            $totalInd224R22416 += $ind224->getR22416(0);
        }
        $totalInd224 = $totalInd224R2241 + $totalInd224R2242 + $totalInd224R2243 + $totalInd224R2244 + $totalInd224R2245 + $totalInd224R2246 + $totalInd224R2247 + $totalInd224R2248
            + $totalInd224R2249 + $totalInd224R22410 + $totalInd224R22411 + $totalInd224R22412 + $totalInd224R22413 + $totalInd224R22414 + $totalInd224R22415 + $totalInd224R22416;


        //ind226
        $totalInd2261R22611 = 0;
        $totalInd2261R22612 = 0;
        $totalInd2261R22613 = 0;
        $totalInd2261R22614 = 0;
        $totalInd2261R22615 = 0;
        $totalInd2261R22616 = 0;
        foreach ($ind2261s as $ind2261) {
            $totalInd2261R22611 += $ind2261->getR22611(0);
            $totalInd2261R22612 += $ind2261->getR22612(0);
            $totalInd2261R22613 += $ind2261->getR22613(0);
            $totalInd2261R22614 += $ind2261->getR22614(0);
            $totalInd2261R22615 += $ind2261->getR22614(0);
            $totalInd2261R22616 += $ind2261->getR22614(0);
        }
        $totalInd2261 = $totalInd2261R22611 + $totalInd2261R22612 + $totalInd2261R22613 + $totalInd2261R22614 + $totalInd2261R22615 + $totalInd2261R22616;

        $totalInd2262R22621 = 0;
        $totalInd2262R22622 = 0;
        $totalInd2262R22623 = 0;
        $totalInd2262R22624 = 0;
        $totalInd2262R22625 = 0;
        $totalInd2262R22626 = 0;
        foreach ($ind2262s as $ind2262) {
            $totalInd2262R22621 += $ind2262->getR22621(0);
            $totalInd2262R22622 += $ind2262->getR22622(0);
            $totalInd2262R22623 += $ind2262->getR22623(0);
            $totalInd2262R22624 += $ind2262->getR22624(0);
        }
        $totalInd2262 = $totalInd2262R22621 + $totalInd2262R22622 + $totalInd2262R22623 + $totalInd2262R22624 + $totalInd2262R22625 + $totalInd2262R22626;

        $totalInd2263R22631 = 0;
        $totalInd2263R22632 = 0;
        $totalInd2263R22633 = 0;
        $totalInd2263R22634 = 0;
        $totalInd2263R22635 = 0;
        $totalInd2263R22636 = 0;
        foreach ($ind2263s as $ind2263) {
            $totalInd2263R22631 += $ind2263->getR22631(0);
            $totalInd2263R22632 += $ind2263->getR22632(0);
            $totalInd2263R22633 += $ind2263->getR22633(0);
            $totalInd2263R22634 += $ind2263->getR22634(0);
            $totalInd2263R22635 += $ind2263->getR22635(0);
            $totalInd2263R22636 += $ind2263->getR22636(0);
        }
        $totalInd2263 = $totalInd2263R22631 + $totalInd2263R22632 + $totalInd2263R22633 + $totalInd2263R22634 + $totalInd2263R22635 + $totalInd2263R22636;

        $totalInd226 = $totalInd2261 + $totalInd2262 + $totalInd2263;

        //ind227
        $totalInd227R2271 = $bilanSocialConsolide->getR2271();
        $totalInd227R2272 = $bilanSocialConsolide->getR2272();
        $totalInd227 = $totalInd227R2271 + $totalInd227R2272;

        //ind231
        $totalInd231R2311 = 0;
        $totalInd231R2312 = 0;
        foreach ($ind231s as $ind231) {
            $totalInd231R2311 += $ind231->getR2311(0);
            $totalInd231R2312 += $ind231->getR2312(0);
        }
        $totalInd231 = $totalInd231R2311 + $totalInd231R2312;

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravail.html.twig', array(
            'questionCollectiviteConsolide' => $questionnaire,
            'consolide' => $bilanSocialConsolide,
            'incoherenceList' => ($bilanSocialConsolide == null ? null : $bilanSocialConsolide->getIncoherenceLogs()),
            'nombreQuestion' => $nombreQuestion,
            'canwrite' => $this->isUserCanWrite(),
            'collectivite' => $this->getMaCollectivite(),
            'totalInd210' => $totalInd210,
            'totalInd211' => $totalInd211,
            'totalInd212' => $totalInd212,
            'totalInd213' => $totalInd213,
            'totalInd214' => $totalInd214,
            'totalInd215' => $totalInd215,
            'totalInd216' => $totalInd216,
            'totalInd221' => $totalInd221,
            'totalInd222' => $totalInd222,
            'totalInd223' => $totalInd223,
            'totalInd224' => $totalInd224,
            'totalInd226' => $totalInd226,
            'totalInd227' => $totalInd227,
            'totalInd231' => $totalInd231,
            'anneeCampagneEnCours' => $anneeCampagne
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd210Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formTpsTravail210 = $this->createForm(BilanSocialConsolideTpsTravInd210Type::class, $bilanSocialConsolide);
        $formTpsTravail210->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTravail210->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formTpsTravail210->isValid()) {
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
                $bilanSocialConsolide->setMoyenneInd210(100);
                $bilanSocialConsolide->setBlIncoInd210(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();
                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd210.html.twig', array(
            'formTpsTravail210' => $formTpsTravail210->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd211Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ1() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind2111");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind2111");
            $bsConsoIndPreparator->initIndicateurByName("Ind2112");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind2112");
            $bsConsoIndPreparator->initIndicateurByName("Ind2113");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind2113");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formTpsTrav211 = $this->createForm(BilanSocialConsolideTpsTravInd211Type::class, $bilanSocialConsolide);
        $formTpsTrav211->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTrav211->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formTpsTrav211->isValid()) {
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

                $bilanSocialConsolide->setInd211NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd211.html.twig', array(
            'formTpsTrav211' => $formTpsTrav211->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }


    public function EditBilanSocialConsolideTpsTravInd212Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ3() == true) {

            $bsConsoIndPreparator->initIndicateurByName("Ind2121");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind2121");
            $bsConsoIndPreparator->initIndicateurByName("Ind2122");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind2122");
            $bsConsoIndPreparator->initIndicateurByName("Ind2123");
            $bsConsoIndPreparator->moveIndTempToRealByName("Ind2123");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formTpsTrav212 = $this->createForm(BilanSocialConsolideTpsTravInd212Type::class, $bilanSocialConsolide);
        $formTpsTrav212->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTrav212->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formTpsTrav212->isValid()) {
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

                $bilanSocialConsolide->setInd212NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd212.html.twig', array(
            'formTpsTrav212' => $formTpsTrav212->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd213Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ5() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind2131");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind2131");
            $bsConsoIndPreparator->initIndicateurByName("Ind2132");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind2132");
            $bsConsoIndPreparator->initIndicateurByName("Ind2133");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind2133");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formTpsTrav213 = $this->createForm(BilanSocialConsolideTpsTravInd213Type::class, $bilanSocialConsolide);
        $formTpsTrav213->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTrav213->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formTpsTrav213->isValid()) {
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

                $bilanSocialConsolide->setInd213NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);
                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }
        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd213.html.twig', array(
            'formTpsTrav213' => $formTpsTrav213->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd214Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ1() == true || $questionnaire->GetQ3() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind214");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind214");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

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

        $formTpsTrav214 = $this->createForm(BilanSocialConsolideTpsTravInd214Type::class, $bilanSocialConsolide);
        $formTpsTrav214->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTrav214->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formTpsTrav214->isValid()) {
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

                $bilanSocialConsolide->setInd214NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd214.html.twig', array(
            'formTpsTrav214' => $formTpsTrav214->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'total21X1' => $total21X1,
            'total21X2' => $total21X2,
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd215Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ1() == true || $questionnaire->GetQ3() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind215");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind215");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formTpsTrav215 = $this->createForm(BilanSocialConsolideTpsTravInd215Type::class, $bilanSocialConsolide);
        $formTpsTrav215->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTrav215->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formTpsTrav215->isValid()) {
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

                $bilanSocialConsolide->setInd215NullToZero();
                $bilanSocialConsolide->setMoyenneInd215(100);
                $bilanSocialConsolide->setBlIncoInd215(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd215.html.twig', array(
            'formTpsTrav215' => $formTpsTrav215->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd216Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ1() == true || $questionnaire->GetQ3() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind216");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind216");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formTpsTrav216 = $this->createForm(BilanSocialConsolideTpsTravInd216Type::class, $bilanSocialConsolide);
        $formTpsTrav216->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTrav216->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formTpsTrav216->isValid()) {
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

                $bilanSocialConsolide->setInd216NullToZero();
                $bilanSocialConsolide->setMoyenneInd216(100);
                $bilanSocialConsolide->setBlIncoInd216(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd216.html.twig', array(
            'formTpsTrav216' => $formTpsTrav216->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd217Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
//        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
//        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

//        if ($questionnaire->GetQ1() == true || $questionnaire->GetQ3() == true || $questionnaire->GetQ5() == true) {
//            $bsConsoIndPreparator->initIndicateurByName("Ind217");
//            $bsConsoIndPreparator->moveIndToTemplateByName("Ind217");
//        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formTpsTrav217 = $this->createForm(BilanSocialConsolideTpsTravInd217Type::class, $bilanSocialConsolide);
        $formTpsTrav217->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTrav217->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formTpsTrav217->isValid()) {
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

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setMoyenneInd217(100);
                $bilanSocialConsolide->setBlIncoInd217(4);
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd217.html.twig', array(
            'formTpsTrav217' => $formTpsTrav217->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd221Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ2() == true || $questionnaire->GetQ4() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind221");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind221");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $nbAgents = 0;

        if ($bilanSocialConsolide->getInd111s() != null && $bilanSocialConsolide->getInd111s()->count() > 0) {
            foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
                $nbAgents += $ind111->getR1111(0);
            }
        }
        if ($bilanSocialConsolide->getInd121s() != null && $bilanSocialConsolide->getInd121s()->count() > 0) {
            foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
                $nbAgents += $ind121->getR1211(0) + $ind121->getR1212(0) + $ind121->getR1213(0) + $ind121->getR1214(0) +
                    $ind121->getR1215(0) + $ind121->getR1216(0) + $ind121->getR1217(0) + $ind121->getR1218(0) +
                    $ind121->getR12118(0);
            }
        }


        $totalH = 0;
        $totalF = 0;

        foreach ($bilanSocialConsolide->getInd112s() as $ind112) {
            $totalH += $ind112->getR1121(0) + $ind112->getR1123(0) + $ind112->getR1125(0) + $ind112->getR1127(0);
            $totalF += $ind112->getR1122(0) + $ind112->getR1124(0) + $ind112->getR1126(0) + $ind112->getR1128(0);
        }
        foreach ($bilanSocialConsolide->getInd122s() as $ind122) {
            $totalH += $ind122->getR1221(0) + $ind122->getR1223(0) + $ind122->getR1225(0) + $ind122->getR1227(0);
            $totalF += $ind122->getR1222(0) + $ind122->getR1224(0) + $ind122->getR1226(0) + $ind122->getR1228(0);
        }


        $formTpsTravail221 = $this->createForm(BilanSocialConsolideTpsTravInd221Type::class, $bilanSocialConsolide);
        $formTpsTravail221->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTravail221->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formTpsTravail221->isValid()) {
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

                $bilanSocialConsolide->setInd221NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd221.html.twig', array(
            'formTpsTrav221' => $formTpsTravail221->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'nbAgents' => $nbAgents,
            'questionCollectiviteConsolide' => $questionnaire,
            'totalH' => $totalH,
            'totalF' => $totalF,
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd222Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ2() == true || $questionnaire->GetQ4() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind222");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind222");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formTpsTravail222 = $this->createForm(BilanSocialConsolideTpsTravInd222Type::class, $bilanSocialConsolide);
        $formTpsTravail222->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTravail222->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formTpsTravail222->isValid()) {
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

                $bilanSocialConsolide->setInd222NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd222.html.twig', array(
            'formTpsTrav222' => $formTpsTravail222->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd223Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        if ($questionnaire->GetQ2() == true || $questionnaire->GetQ4() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind2231");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind2231");
            $bsConsoIndPreparator->initIndicateurByName("Ind2232");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind2232");
            $bsConsoIndPreparator->initIndicateurByName("Ind2233");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind2233");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        // Set des elements du form
        $formTpsTrav223 = $this->createForm(BilanSocialConsolideTpsTravInd223Type::class, $bilanSocialConsolide);
        $formTpsTrav223->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTrav223->isSubmitted()) {

            $fgstat = $formTpsTrav223['valide']->getData();

            // Traitement Submit du form en AJAX
            if (!$formTpsTrav223->isValid()) {
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

                $bilanSocialConsolide->setTpsTravDateAndUserModif($now, $cdUtil);
                if (!$exist) {
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                }

                $bilanSocialConsolide->setInd223NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                //error_log('before flush', 0);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd223.html.twig', array(
            'formTpsTrav223' => $formTpsTrav223->createView(),
            'questionCollectiviteConsolide' => $questionnaire,
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs()
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd224Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();


        //$ref = ["Nombre d'agents exerçant leur fonctions dans le cadre du télétravail (article 133 de la loi du 12 mars 2012"];
        if ($questionnaire->GetQ2() == true || $questionnaire->GetQ4() == true || $questionnaire->getQ6() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind224");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind224");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $totalH = 0;
        $totalF = 0;
        foreach ($bilanSocialConsolide->getInd111s() as $ind111) {
            $totalH += $ind111->getR1115(0);
            $totalF += $ind111->getR1116(0);
        }

        foreach ($bilanSocialConsolide->getInd121s() as $ind121) {
            $totalH += $ind121->getR12114(0) + $ind121->getR12115(0);
            $totalF += $ind121->getR12116(0) + $ind121->getR12117(0);
        }

        foreach ($bilanSocialConsolide->getInd1311s() as $ind1311) {
            $totalH += $ind1311->getR13111(0);
            $totalF += $ind1311->getR13112(0);
        }

        $formTpsTravail224 = $this->createForm(BilanSocialConsolideTpsTravInd224Type::class, $bilanSocialConsolide);
        $formTpsTravail224->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTravail224->isSubmitted()) {


            // Traitement submit du form en AJAX
            if (!$formTpsTravail224->isValid()) {
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
                    $ind224 = new Ind224();
                    $ind224->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($ind224);
                }

                $bilanSocialConsolide->setInd224NullToZero();
                $bilanSocialConsolide->setBlUpdated(true);

                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd224.html.twig', array(
            'formTpsTrav224' => $formTpsTravail224->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire,
            'totalH' => $totalH,
            'totalF' => $totalF,
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd225Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formTpsTravail225 = $this->createForm(BilanSocialConsolideTpsTravInd225Type::class, $bilanSocialConsolide);
        $formTpsTravail225->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTravail225->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formTpsTravail225->isValid()) {
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
                $bilanSocialConsolide->setMoyenneInd225(100);
                $bilanSocialConsolide->setBlIncoInd225(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd225.html.twig', array(
            'formTpsTrav225' => $formTpsTravail225->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd226Action(Request $request, $anneeCampagne = null)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();

        $em = $this->getEntityManager();
        $campagne = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        if ($anneeCampagne == null) {
            $anneeCampagne = $campagne->getNmAnne();
        }

        //$ref = array(array(0 => "DPR"), array(1 => "DAC"), array(2 => "PDS"), array(3 => "MOQ"), array(4 => "RTP"));
        if ($questionnaire->GetQ2() == true || $questionnaire->GetQ4() == true || $questionnaire->getQ6() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind2261");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind2261");
            $bsConsoIndPreparator->initIndicateurByName("Ind2262");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind2262");
            $bsConsoIndPreparator->initIndicateurByName("Ind2263");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind2263");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formTpsTravail226 = $this->createForm(BilanSocialConsolideTpsTravInd226Type::class, $bilanSocialConsolide);
        $formTpsTravail226->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTravail226->isSubmitted()) {

            // Traitement submit du form en AJAX
            if (!$formTpsTravail226->isValid()) {
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
                    $ind226 = new Ind226();
                    $ind226->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($ind226);
                }

                $bilanSocialConsolide->setInd226NullToZero();
                $bilanSocialConsolide->setMoyenneInd226(100);
                $bilanSocialConsolide->setBlIncoInd226(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd226.html.twig', array(
            'formTpsTrav226' => $formTpsTravail226->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire,
            'anneeCampagne' => $anneeCampagne,
        ));
    }




    public function EditBilanSocialConsolideInd227Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
//        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();


        $exist = true;
        if ($bilanSocialConsolide->getIdBilasocicons() == null) {
            $exist = false;
        }

        $formInd227 = $this->createForm(Ind227Type::class, $bilanSocialConsolide);
        $formInd227->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formInd227->isSubmitted()) {
            // Traitement submit du form en AJAX
            if (!$formInd227->isValid()) {
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
                $bilanSocialConsolide->setMoyenneInd227(100);
                $bilanSocialConsolide->setBlIncoInd227(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();
//                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editInd227.html.twig', array(
            'formInd227' => $formInd227->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
//            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

    public function EditBilanSocialConsolideTpsTravInd231Action(Request $request)
    {
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $bsConsoIndPreparator = $this->get('bs_conso_ind_preparator');
        $bsConsoIndPreparator->setBs($bilanSocialConsolide);
        $questionnaire = new QuestionCollectiviteConsolide();
        $cdUtil = $this->getUser()->getUsername();


        //$ref = array(array(0 => "DPR"), array(1 => "DAC"), array(2 => "PDS"), array(3 => "MOQ"), array(4 => "RTP"));
        if ($questionnaire->GetQ2() == true || $questionnaire->GetQ4() == true || $questionnaire->getQ6() == true) {
            $bsConsoIndPreparator->initIndicateurByName("Ind231");
            $bsConsoIndPreparator->moveIndToTemplateByName("Ind231");
        }
        $exist = $bilanSocialConsolide->getIdBilasocicons() != null;

        $formTpsTravail231 = $this->createForm(BilanSocialConsolideTpsTravInd231Type::class, $bilanSocialConsolide);
        $formTpsTravail231->handleRequest($request);

        $now = new DateTime('NOW');
        if ($formTpsTravail231->isSubmitted()) {

            // Traitement submit du form en AJAX
            if (!$formTpsTravail231->isValid()) {
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
                    $ind231->setBilanSocialConsolide($bilanSocialConsolide);
                    //error_log('before persist bsc', 0);
                    $this->getEntityManager()->persist($bilanSocialConsolide);
                    $this->getEntityManager()->persist($ind231);
                }

                $bilanSocialConsolide->setInd231NullToZero();
                $bilanSocialConsolide->setMoyenneInd231(100);
                $bilanSocialConsolide->setBlIncoInd231(4);
                $bilanSocialConsolide->setBlUpdated(true);
                $this->getEntityManager()->flush();

                $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionnaire);

                //error_log('after flush', 0);
                $this->getEntityManager()->getConnection()->commit();
                return $this->GetResponseTpsTrav("1", $bilanSocialConsolide);
                //exit;
            } catch (UniqueConstraintViolationException $ex) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message  UniqueConstraintViolationException " . $ex->getMessage(), 0);
                error_log("Error " . $ex->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-3", $bilanSocialConsolide);
            } catch (Exception $e) {
                $this->getEntityManager()->getConnection()->rollBack();
                error_log("Error Message " . $e->getMessage(), 0);
                error_log("Error " . $e->getTraceAsString(), 0);
                return $this->GetResponseTpsTrav("-1", $bilanSocialConsolide);
            }
        }

        return $this->render('@Conso/BilanSocialConsolide/editTpsTravailInd231.html.twig', array(
            'formTpsTrav231' => $formTpsTravail231->createView(),
            'incoherenceList' => $bilanSocialConsolide->getIncoherenceLogs(),
            'questionCollectiviteConsolide' => $questionnaire
        ));
    }

}
