<?php
namespace Bilan_Social\Bundle\ImportBundle\Controller;

use Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent;
use Bilan_Social\Bundle\ApaBundle\Entity\BilanQ30Alerte;
use Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent;
use Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent;
use Bilan_Social\Bundle\ApaBundle\Entity\Etpr114AnneePrecedente;
use Bilan_Social\Bundle\ApaBundle\Entity\Etpr124AnneePrecedente;
use Bilan_Social\Bundle\ApaBundle\Entity\Etpr131AnneePrecedente;
//use Bilan_Social\Bundle\ApaBundle\Entity\HeurRemTotaAgent;
//use Bilan_Social\Bundle\ApaBundle\Entity\RemAnnBruPrimAgent;
//use Bilan_Social\Bundle\ApaBundle\Entity\RemAnnBruHeuSuppAgent;
use Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent;
use Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent;
use Bilan_Social\Bundle\ApaBundle\Entity\Dgcl;
use Bilan_Social\Bundle\ImportBundle\Entity\Import;
use Bilan_Social\Bundle\ReferencielBundle\Enums\StatutJuridiqueN4dsEnum;
use Bilan_Social\Bundle\ReferencielBundle\Enums\MotifArriveeN4dsEnum;
use Bilan_Social\Bundle\ReferencielBundle\Enums\MotifDepartN4dsEnum;
use Bilan_Social\Bundle\ReferencielBundle\Enums\TempsPartielN4dsEnum;
use Bilan_Social\Bundle\ReferencielBundle\Enums\EmploiNonPermanentN4dsEnum;
use Bilan_Social\Bundle\ReferencielBundle\Enums\PositionStatutaireN4dsEnum;
use Bilan_Social\Bundle\ReferencielBundle\Enums\AlerteNonPermanentN4dsEnum;
use Bilan_Social\Bundle\ReferencielBundle\Enums\GradeN4dsEnum;
use Bilan_Social\Bundle\ReferencielBundle\Enums\MotifAbsenceN4dsEnum;
use Bilan_Social\Bundle\ReferencielBundle\Enums\CategSocioProfN4dsEnum;
use Doctrine\Common\Collections\ArrayCollection;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bilan_Social\Bundle\ApaBundle\Entity\Handitorial;
use DateTime;


class ImportController extends AbstractBSController {

    function paques($Y){
    	$a = $Y%19;
    	$b = intval($Y/100);
    	$C = $Y%100;
    	$P = intval($b / 4);
    	$E = $b%4;
    	$F = intval(($b + 8) / 25);
    	$g = intval(($b - $F + 1) / 3);
    	$h = (19 * $a + $b - $P - $g + 15)%30;
    	$i = intval($C / 4);
    	$K = $C%4;
    	$r = (32 + 2 * $E + 2 * $i - $h - $K)%7;
    	$N = intval(($a + 11 * $h + 22 * $r) / 451);
    	$M = intval(($h + $r - 7 * $N + 114) / 31);
    	$D = (($h + $r - 7 * $N + 114)%31) + 1;
    	return $Y.'-'.$M.'-'.$D;
    }

    //$d = 1;
    function jourFeries($y){
        $cal = array();

        $cal['0101'.$y] = 1; //nouvelan
        $cal['0105'.$y] = 2; //travail
        $cal['0805'.$y] = 3; //victoire
        $cal['1407'.$y] = 4; //nationale
        $cal['1508'.$y] = 5; //assomption
        $cal['0111'.$y] = 6; //toussaint
        $cal['1111'.$y] = 7; //armistice
        $cal['2512'.$y] = 8; //noel

        //Paques
        $paques = $this->paques($y);
        //error_log('paques = ' . $paques, 0);

        $paq = date('dmY', strtotime($paques.' +0 days'));
        //error_log('paq = ' . json_encode($paq), 0);
        $cal[$paq] = 9; //paques

        $lpaques = date('dmY', strtotime($paques.' +1 days'));
        //error_log('lpaque = ' . json_encode($lpaques), 0);
        $cal[$lpaques] = 10; // lundi paques

        $asc = date('dmY', strtotime($paques.' +39 days'));
        //error_log('asc = ' . json_encode($asc), 0);
        $cal[$asc] = 11; // asce

        $pent = date('dmY', strtotime($paques.' +49 days'));
        //error_log('pent = ' . json_encode($pent), 0);
        $cal[$pent] = 12; // pentecote

        $lpent = date('dmY', strtotime($paques.' +50 days'));
        //error_log('lpent = ' . json_encode($lpent), 0);
        $cal[$lpent] = 13; // lundi pentecote


        return $cal;
    }
    function getNbJoursDiff($dateDebutStr, $dateFinStr) {// ddMMYYYY , // ddMMYYYY
        $count = 0;
        if($dateDebutStr== null) return 0;
        if($dateFinStr== null) return 0;

        //error_log('$dateDebutStr ' . $dateDebutStr  ,0 );

        $dateDebutDt = \DateTime::createFromFormat('dmY', $dateDebutStr);
        $dateFinDt = \DateTime::createFromFormat('dmY', $dateFinStr);
        $interval = $dateDebutDt->diff($dateFinDt);
        return $interval->format('%a')+1;
    }
    function getNbJoursOuvres($dateDebutStr, $dateFinStr) {// ddMMYYYY , // ddMMYYYY
        $count = 0;
        if($dateDebutStr== null) return 0;
        if($dateFinStr== null) return 0;

        //error_log('$dateDebutStr ' . $dateDebutStr  ,0 );

        $dateDebutDt = \DateTime::createFromFormat('dmY', $dateDebutStr);
        $dateFinDt = \DateTime::createFromFormat('dmY', $dateFinStr);

        $y = $dateDebutDt->format('Y');
        //error_log('$y = ' . $y,0 );

        $jourFeries = $this->jourFeries($y);

        $dateStr = $dateDebutStr;

        $idx = 0;

        while ($dateStr != $dateFinStr && $idx != 400) {

            $dateDt = \DateTime::createFromFormat('dmY', $dateStr);
            $n = $dateDt->format('N');

            if (array_key_exists($dateStr, $jourFeries)) {
                // jour férié
                //error_log('$dateStr ' . $dateStr . ' = jour ferie' ,0 );
            }
            else if($n == 6 || $n == 7) {
                // we
                //error_log('$dateStr ' . $dateStr . ' = we' ,0 );
            }
            else {
                //error_log('$dateStr ' . $dateStr . ' = jour ouvré' ,0 );
                $count++;
            }

            if($idx > 365) {
                error_log($dateDebutStr . '-' . $dateFinStr . ' : pbm pour determiner le nb de jours ouvré dans l\'intervalle ',0 );
            }

            $dateStrYmd = $dateDt->format('Y-m-d');

            $dateStr = date('dmY', strtotime($dateStrYmd.' +1 days'));
            $idx++;
          //  error_log('$dateStrNext ' . $dateStr  ,0 );
        }


        $nFin = $dateFinDt->format('N');

        // traitement du dernier jour non traité par le while
        if (array_key_exists($dateFinStr, $jourFeries)) {
            // jour férié
            //error_log('$dateStr ' . $dateFinStr . ' = jour ferie' ,0 );
        }
        else if($nFin == 6 || $nFin == 7) {
            // we
            //error_log('$dateStr ' . $dateFinStr . ' = we' ,0 );
        }
        else {
            //error_log('$dateStr ' . $dateFinStr . ' = jour ouvré' ,0 );
            $count++;
        }

        return $count;

    }



    public function ImportAction(Request $request) {
        // Test Postman : POST
        // URL : http://cig-bilan-social.local/web/app_dev.php/api/n4ds/file
        // Headers Add : Cookie PHPSESSID=   => à récupérer à  chaque fois different
        // Body : raw : JSON

        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '3G');
        // Pour recup json de Fred
        //$json = $request->getContent();
        error_log("Debut du traitement", 0);

        // Recup temporaire pour test

        //$json = "{\"lines\" : [" . $request->get('fichier') . "]}";

        //$count = $this->getNbJoursOuvres('01012017', '10012017');
        //error_log("count : " . json_encode($count), 0);
        //return;


        // Récupération du fichier brut avant de l'encoder en JSON
        $fichier = $request->get('fichier');
        //FP        $tab = explode("\n", $fichier);

        //FP        $jsonencoded = json_encode($tab);

        //FP        $json = "{\"lines\" : $jsonencoded}";

        //$json = "{\"lines\" : [" . $request->get('fichier') . "]}";

        //FP        $jsonObj = json_decode($json);

        //FP        $jsonArrayOrig = $jsonObj->{'lines'};
        $jsonArrayOrig = explode("\n", $fichier);

        $em = $this->getDoctrine()->getManager();

        $n4dss = $em->getRepository('ReferencielBundle:RefN4ds')->findBy(array('blVali' => false));

        $n4dsList = "|";
        $n4dsListOblig = new ArrayCollection();
        foreach ($n4dss as $n4ds) {
            $n4dsList = $n4dsList  . $n4ds->getCdValeur() . "|" ;

            if($n4ds->getBlObligatoire()) {
                $n4dsListOblig->add($n4ds->getCdValeur());
            }
        }

        //error_log($n4dsList, 0);

        error_log("Nb lignes fichier complet : " . json_encode(sizeof($jsonArrayOrig)), 0);

        $erreur = "";

        $jsonArray = array();

        foreach ($jsonArrayOrig as $line) {
            $tab = explode(",", $line);
            $codeValeur = $tab[0];

            $posList = strpos($n4dsList, $codeValeur . "|");
            $absent = false;

            //error_log($codeValeur . "|"  . " - " . $posList, 0);
            if($posList == null) {
                //error_log('Absent null', 0);
                $absent = true;
            }

            if ($absent) {
                // Absent de la liste => ko
                //$erreur = $erreur  . "Le code " . $codeValeur . " n existe pas.<br/>\n";
            }
            else{
                //$jsonArray
                array_push($jsonArray, $line);
            }
        }

        //error_log(json_encode($jsonArray), 0);

        error_log("Nb lignes white liste fichier : " . json_encode(sizeof($jsonArray)), 0);

        foreach ($n4dsListOblig as $n4ds) {
            $present = false;
            //error_log($n4ds, 0);
            foreach ($jsonArray as $line) {
                $posList = strpos("|".$line, $n4ds);
                //error_log($line . "|"  . " - " . $posList, 0);

                if($posList != null) {
                   $present = true;
                   break;
                }
            }

            if (!$present) {
                $erreur = $erreur  . "Le code " . $n4ds . " est obligatoire.\n";
            }

        }

        if($erreur != "") {
            $response = new Response();
            $response->setContent($erreur);
            return $response;
        }

        $refTpsNonCompletList = $em->getRepository('ReferencielBundle:RefTempsNonComplet')->findBy(array('blVali' => false));
        $refPourcentageTempaPartielList = $em->getRepository('ReferencielBundle:RefPourcentageTempaPartiel')->findBy(array('blVali' => false));

        $user = $this->getUser();

        if($user == null) {
            $response = new Response();
            $response->setContent("L'utilisateur est inconnu.");
            return $response;
        }
        error_log("Traitement lancé par " . $user->getUsername(), 0);

        $idColl = $user->getCollectivite()->getIdColl();
        if($idColl == null) {
            $response = new Response();
            $response->setContent("L'utilisateur doit être une collectivité.");
            return $response;
        }
        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($idColl);

        if($collectivite == null) {
            $response = new Response();
            $response->setContent("La collectivité associée n'existe pas.");
            return $response;
        }
        $campagneCourante = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        $enquete = $em->getRepository('EnqueteBundle:Enquete')->getEnqueteActive($idColl, $campagneCourante->getIdCamp());


        $siret = null; //obligatoire
        $dtDebutRef = null; // obligatoire
        $dtFinRef = null; // obligatoire

        // Parcours du fichier une premiere fois pour traiter les erreurs bloquantes
        foreach ($jsonArray as $line) {
            $tab = explode(",", $line);
            $codeValeur = $tab[0];

            if( Count($tab) <= 1 ) continue;

            $valeur = $tab[1];
            //error_log($valeur, 0);

            if("S10.G01.00.001.001" == $codeValeur) { // Siren de l'émetteur de l'envoi : OBLIGATOIRE
                $siret = str_replace("'", "", $valeur);
            }

            if("S10.G01.00.001.002" == $codeValeur) { // Nic : OBLIGATOIRE
                $siret = $siret . str_replace("'", "", $valeur);
            }

            // S10.G01.00.003.007 => Cd Insee ===============================================================================================> UNUSED NORMAL OBLIGATOIRE

            if("S20.G01.00.003.001" == $codeValeur) {  // Date de début de la période de référence de la déclaration  : OBLIGATOIRE
                $dtDebutRef = str_replace("'", "", $valeur);
            }
            if("S20.G01.00.003.002" == $codeValeur) { // Date de fin de la période de référence de la déclaration  : OBLIGATOIRE
                $dtFinRef = str_replace("'", "", $valeur);
            }

            //S20.G01.00.018  // Code type périodicité de la déclaration  ===================================================================> UNUSED NORMAL OBLIGATOIRE
        }

        //error_log($siret ,0);
        //error_log($dtDebutRef ,0);// ddMMyyyy
        //error_log($dtFinRef ,0);// ddMMyyyy

        if ($siret != $collectivite->getNmSire()) {
            $response = new JsonResponse();
            $response->setContent(json_encode(array('message' =>"Le SIRET ne correspond pas à celui de votre collectivité.")));
            return $response;
        }


        if($campagneCourante == null) {
            $response = new JsonResponse();
            $response->setContent(json_encode(array('message' =>"Aucune campagne courante trouvée.")));
            return $response;
        }
        $anneeCampagneCourante = $campagneCourante->getNmAnne();

        $anneeCampagneCouranteMoins1 = $anneeCampagneCourante - 1;
        //$anneeCampagneCouranteMoins2 = $anneeCampagneCourante - 2;

        $anneeDebutRef = substr($dtDebutRef, 4);
        //error_log($anneeDebutRef ,0);
       // error_log($anneeCampagneCourante ,0);
        $anneeFinRef = substr($dtFinRef, 4);

        $fichierN = false;
        $fichierNMoins1 = false;

        if($anneeCampagneCourante == $anneeDebutRef && $anneeCampagneCourante == $anneeFinRef) {
            $fichierN = true;
        }

        if($anneeCampagneCouranteMoins1 == $anneeDebutRef && $anneeCampagneCouranteMoins1 == $anneeFinRef) {
            $fichierNMoins1 = true;
        }

        if($fichierN == false && $fichierNMoins1 == false) {
            $response = new JsonResponse();
            $response->setContent(json_encode(array('message' =>"Le fichier ne correspond ni l'année " . json_encode($anneeCampagneCourante) .
                                        " ni à l'année " . json_encode($anneeCampagneCouranteMoins1) . " .")));
            return $response;
        }

        $importN = $em->getRepository('ImportBundle:Import')
                        ->findOneByImport($collectivite->getIdColl(), $enquete->getIdEnqu(), $anneeCampagneCourante);

        $importNMoins1 = $em->getRepository('ImportBundle:Import')
                        ->findOneByImport($collectivite->getIdColl(), $enquete->getIdEnqu(), $anneeCampagneCouranteMoins1);


        //Si fichier N-1, si celui ci a  deja été importé (pour idcoll/idenqu/ annne = N-1 ) => Erreur le fichier N-1 a déjà été importé
        if($fichierNMoins1 == true && $importNMoins1 != null) {
            $response = new JsonResponse();
            $response->setContent(json_encode(array('message' =>"Le fichier " . json_encode($anneeCampagneCouranteMoins1) . " a déjà été importé.")));
            return $response;
        }

        //Si fichier N-1, si le fichier N n'est pas encore importé  (pour idcoll/idenqu/ annne = N ) => Erreur le fichier N n'a pas encore été importé
        if($fichierNMoins1 == true && $importN == null) {
            $response = new JsonResponse();
            $response->setContent(json_encode(array('message' =>"Le fichier " . json_encode($anneeCampagneCourante) . " n'a pas encore été importé.")));
            return $response;
        }

        //si Fichier N , si fichier N deja importé (pour idcoll/idenqu/ annne = N )
            //=> remove préalable de  bilansocialagen voire bilansocialconso existant + ligne import
        if($fichierN == true && $importN != null) {
            // Delete tous les bilans par agent de la coll / enquete courante
            $bilanSocialAgents = $em->getRepository('ApaBundle:BilanSocialAgent')
                        ->GetAllAgentsForImport($enquete->getIdEnqu(), $collectivite->getIdColl());

            if ($bilanSocialAgents!=null) {

                foreach ($bilanSocialAgents as $bsa) {
                    $idInfocollagen = $bsa->getIdInfocollagen();
                    //error_log('step1',0);
                    $em->remove($bsa);
                    //error_log('step1b',0);
                    $infoCollAgen = $em->getRepository('ApaBundle:InformationColectiviteAgent')
                                                        ->findOneByIdInfocollagen($idInfocollagen);
                    if($infoCollAgen!=null) {
                        //error_log('step2',0);
                        $em->remove($infoCollAgen);
                        //error_log('step2b',0);
                    }
                }
            }

            // Delete du bilan consolide de la coll / enquete courante
            $bilanSocialConsolide = $em->getRepository('ConsoBundle:BilanSocialConsolide')
                        ->findOneByActif($collectivite->getIdColl(), $enquete->getIdEnqu());

            if($bilanSocialConsolide != null) {
                $em->remove($bilanSocialConsolide);
            }
            $em->remove($importN);

            $em->flush();

        }

        // Nouvel import
        $agent = null;
        $agentList = new ArrayCollection();
        $nom = null;
        $prenom = null;
        $nomUsage = null;
        $civilite = null;
        $dtNaissance = null;
        $dtDebutPeriodeActivite = null;
        $dtDebutPeriodeActivite1ere = null;
        $dtDebutPeriodeActiviteDerniere = null;
        $cdMotifDebutPeriodeActivite = null;
        $cdMotifDebutPeriodeActivite1ere = null;
        $dtFinPeriodeActivite = null;
        $dtFinPeriodeActiviteDerniere = null;
        $cdMotifFinPeriodeActivite = null;
        $cdMotifFinPeriodeActiviteDerniere = null;
        $totalHeuresPayees = null;
        $totalHeuresPayeesDerniere = null;
        $cdPosistat = null;
        $cdPosistatDerniere = null;
        $cdStatjuri = null;
        $cdStatjuriDerniere = null;
        $cdCategstat = null;
        $cdFoncpubl = null;
        $cdFoncpublDerniere = null;
        $cdStatAppart = null;
        $cdGradOrig = null;
        $cdGrad1 = null;
        $cdGrad2 = null;
        $cdNatureContratTrav = null;
        $cdModaliteExerTrav = null;
        $cdModaliteExerTravDerniere = null;
        $dureeHebdoDerniere = null;
        $dureeHebdo = null;
        $tauxTravTpsPartiel = null;
        $tauxTravTpsPartielDerniere = null;
        $cdIntiContTrav = null;
        $cdIntiContTravDerniere = null;
        $cdStatjuri08 = null;
        $cdStatjuri08Derniere = null;
        $nbHeurPayeSansSuppl = null;
        $baseFiscale = null;
        $primeIndemnite = null;
        $primeIndemnite601 = null;
        $primeIndemnite101 = null;
        $primeIndemnite102 = null;
        $typeIndemnite = null;
        $codeNatureCotisation = null;
        $lbNatureEmploiN4ds = null;
        $montantRetenues = null;
        $cdInactivite = null;
        $dtDebutInactivite  = null;
        $dtFinInactivite  = null;

        $periodeActiviteList = new ArrayCollection();
        $periodeActiviteMoinsDerniereList = new ArrayCollection();
        $periodeActivite = null;
        $periodeInactiviteList = new ArrayCollection();
        $periodeInactivite = null;
        $cdProfessionCategSocio = null;

        $now = new DateTime('NOW');

        error_log("Debut du recuperation des agents :" .
                " idColl = " . json_encode($idColl) .
                " - idEnqu = " . json_encode($enquete->getIdEnqu() .
                " - " . ($fichierN ? "Annee N" : "Annee N-1") ), 0);

        // Parcours du fichier et de tous les champs et creation d'un liste d'agent avec liste de periode d'activité chacun
        foreach ($jsonArray as $line) {
            $tab = explode(",", $line);

            $codeValeur = $tab[0];

            //error_log($tab[0], 0);
            if( Count($tab) <= 1 ) continue;

            $valeur = $tab[1];
            //error_log("Hello ".$valeur, 0);

            if("S30.G01.00.001" == $codeValeur) { // Numéro d'inscription au répertoire  : OBLIGATOIRE => Indicateur de passage à un nouvel agent
                // Passage à un nouvel agent,
                // Si agent precedent existe (pas le premier passage) alors  init des champs et ajout à la liste de l'agent precedemment init
                if($agent != null) {
                    // Affectation des données à l'agent existant
                    $agent->setNom($nom);
                    $agent->setPrenom($prenom);
                    $agent->setNomUsage($nomUsage);
                    $agent->setCivilite($civilite);
                    $agent->setDtNaissance($dtNaissance);
                    $agent->setDtDebutPeriodeActivite($dtDebutPeriodeActivite);
                    $agent->setDtDebutPeriodeActivite1ere($dtDebutPeriodeActivite1ere);
                    $agent->setDtDebutPeriodeActiviteDerniere($dtDebutPeriodeActiviteDerniere);
                    $agent->setCdMotifDebutPeriodeActivite($cdMotifDebutPeriodeActivite);
                    $agent->setCdMotifDebutPeriodeActivite1ere($cdMotifDebutPeriodeActivite1ere);
                    $agent->setDtFinPeriodeActivite($dtFinPeriodeActivite);
                    $agent->setDtFinPeriodeActiviteDerniere($dtFinPeriodeActiviteDerniere);
                    $agent->setCdMotifFinPeriodeActivite($cdMotifFinPeriodeActivite);
                    $agent->setCdMotifFinPeriodeActiviteDerniere($cdMotifFinPeriodeActiviteDerniere);
                    $agent->setTotalHeuresPayees($totalHeuresPayees);
                    $agent->setTotalHeuresPayeesDerniere($totalHeuresPayeesDerniere);
                    $agent->setCdPosistat($cdPosistat);
                    $agent->setCdPosistatDerniere($cdPosistatDerniere);
                    $agent->setCdStatjuri($cdStatjuri);
                    $agent->setCdStatjuriDerniere($cdStatjuriDerniere);
                    $agent->setCdCategstat($cdCategstat);
                    $agent->setCdFoncpubl($cdFoncpubl);
                    $agent->setCdFoncpublDerniere($cdFoncpublDerniere);
                    $agent->setCdStatAppart($cdStatAppart);
                    $agent->setCdGradOrig($cdGradOrig);
                    $agent->setCdGrad1($cdGrad1);
                    $agent->setCdGrad2($cdGrad2);
                    $agent->setCdNatureContratTrav($cdNatureContratTrav);
                    $agent->setCdModaliteExerTrav($cdModaliteExerTrav);
                    $agent->setCdModaliteExerTravDerniere($cdModaliteExerTravDerniere);
                    $agent->setDureeHebdoDerniere($dureeHebdoDerniere);
                    $agent->setTauxTravTpsPartiel($tauxTravTpsPartiel);
                    $agent->setTauxTravTpsPartielDerniere($tauxTravTpsPartielDerniere);
                    $agent->setCdIntiContTrav($cdIntiContTrav);
                    $agent->setCdIntiContTravDerniere($cdIntiContTravDerniere);
                    $agent->setCdStatjuri08($cdStatjuri08);
                    $agent->setCdStatjuri08Derniere($cdStatjuri08Derniere);
                    $agent->setNbHeurPayeSansSuppl($nbHeurPayeSansSuppl);
                    $agent->setBaseFiscale($baseFiscale);
                    $agent->setPrimeIndemnite($primeIndemnite);
                    $agent->setPrimeIndemnite601($primeIndemnite601);
                    $agent->setPrimeIndemnite101($primeIndemnite101);
                    $agent->setPrimeIndemnite102($primeIndemnite102);
                    $agent->setCodeNatureCotisation($codeNatureCotisation);
                    $agent->setLbNatureEmploiN4ds($lbNatureEmploiN4ds);
                    $agent->setMontantRetenues($montantRetenues);
                    //$agent->setMontantCarence($montantCarence);
                    $agent->setCdProfessionCategSocio($cdProfessionCategSocio);


                    if($periodeActivite!=null) {
                        $periodeActiviteList->add($periodeActivite);
                        $periodeActiviteMoinsDerniereList->add($periodeActivite);
                    }

                    if($periodeInactivite!=null) {
                        $periodeInactiviteList->add($periodeInactivite);
                    }

                    if(count($periodeActiviteMoinsDerniereList)>1) {
                        // Suppression de la derniere periode d'activité
                        $periodeActiviteMoinsDerniereList->remove(count($periodeActiviteMoinsDerniereList)-1);
                    }
                    $agent->setPeriodeActiviteList($periodeActiviteList);
                    $agent->setPeriodeInactiviteList($periodeInactiviteList);
                    $agent->setPeriodeActiviteMoinsDerniereList($periodeActiviteMoinsDerniereList);
                    $agentList->add($agent);
                }

                // Creation du nouvel agent, tous les champs remis à null
                $agent = new Agent();
                $nom = null;
                $prenom = null;
                $nomUsage = null;
                $civilite = null;
                $dtNaissance = null;
                $dtDebutPeriodeActivite = null;
                $dtDebutPeriodeActivite1ere = null;
                $dtDebutPeriodeActiviteDerniere = null;
                $cdMotifDebutPeriodeActivite = null;
                $cdMotifDebutPeriodeActivite1ere = null;
                $dtFinPeriodeActivite = null;
                $dtFinPeriodeActiviteDerniere = null;
                $cdMotifFinPeriodeActivite = null;
                $cdMotifFinPeriodeActiviteDerniere = null;
                $totalHeuresPayees = null;
                $totalHeuresPayeesDerniere = null;
                $cdPosistat = null;
                $cdPosistatDerniere = null;
                $cdStatjuri = null;
                $cdStatjuriDerniere = null;
                $cdCategstat = null;
                $cdFoncpubl = null;
                $cdFoncpublDerniere = null;
                $cdStatAppart = null;
                $cdGradOrig = null;
                $cdGrad1 = null;
                $cdGrad2 = null;
                $cdNatureContratTrav = null;
                $cdModaliteExerTrav = null;
                $cdModaliteExerTravDerniere = null;
                $dureeHebdoDerniere = null;
                $dureeHebdo = null;
                $tauxTravTpsPartiel = null;
                $tauxTravTpsPartielDerniere = null;
                $cdIntiContTrav = null;
                $cdIntiContTravDerniere = null;
                $cdStatjuri08 = null;
                $cdStatjuri08Derniere = null;
                $nbHeurPayeSansSuppl = null;
                $baseFiscale = null;
                $primeIndemnite = 0;
                $primeIndemnite601 = 0;
                $primeIndemnite101 = 0;
                $primeIndemnite102 = 0;
                $codeNatureCotisation = null;
                $lbNatureEmploiN4ds = null;
                $montantRetenues = null;
                $montantCarence = null;
                $periodeActiviteList = new ArrayCollection();
                $periodeActiviteMoinsDerniereList = new ArrayCollection();
                $periodeActivite = null;
                $cdProfessionCategSocio = null;

                $periodeInactiviteList = new ArrayCollection();
                $periodeInactivite = null;
            }

            if("S30.G01.00.002" == $codeValeur) { //  Nom de famille
                $nom = str_replace("'", "", $valeur);
            }
            if("S30.G01.00.003" == $codeValeur) { // Prénoms
                $prenom = str_replace("'", "", $valeur);
            }
            if("S30.G01.00.004" == $codeValeur) { //  Nom d usage
                $nomUsage = str_replace("'", "", $valeur);
            }
            if("S30.G01.00.007" == $codeValeur) { // Code civilité
                $civilite = str_replace("'", "", $valeur);
            }
            if("S30.G01.00.009" == $codeValeur) {// Date de naissance
                $dtNaissance = str_replace("'", "", $valeur);
            }
            if("S40.G01.00.001" == $codeValeur) { // Date de début de période d'activité déclarée => Se repete
                $dtDebutPeriodeActivite = str_replace("'", "", $valeur);
                $dtDebutPeriodeActiviteDerniere = $dtDebutPeriodeActivite;
                if ($dtDebutPeriodeActivite1ere == null) {
                    $dtDebutPeriodeActivite1ere = $dtDebutPeriodeActivite;
                }

                if($periodeActivite!=null) {
                    $periodeActiviteList->add($periodeActivite);
                    $periodeActiviteMoinsDerniereList->add($periodeActivite);
                }

                $periodeActivite = new PeriodeActivite();
                $periodeActivite->setDtDebut($dtDebutPeriodeActivite);

            }
            if("S40.G01.00.002.001" == $codeValeur) { // Code motif de début de période d'activité déclarée  => Se repete
                $cdMotifDebutPeriodeActivite = str_replace("'", "", $valeur);
                if ($cdMotifDebutPeriodeActivite1ere == null) {
                    $cdMotifDebutPeriodeActivite1ere = $cdMotifDebutPeriodeActivite;
                }
                if($periodeActivite!=null) {
                    $periodeActivite->setCdMotifDebut($cdMotifDebutPeriodeActivite);
                }
            }
            if("S40.G01.00.003" == $codeValeur) { // Date de fin de période d'activité déclarée  => Se repete
                $dtFinPeriodeActivite = str_replace("'", "", $valeur);
                $dtFinPeriodeActiviteDerniere = $dtFinPeriodeActivite;
                if($periodeActivite!=null) {
                    $periodeActivite->setDtFin($dtFinPeriodeActivite);
                }
            }
            if("S40.G01.00.004.001" == $codeValeur) { // Code motif de fin de période d'activité déclarée  => Se repete
                $cdMotifFinPeriodeActivite = str_replace("'", "", $valeur);
                $cdMotifFinPeriodeActiviteDerniere = $cdMotifFinPeriodeActivite;
            }

            if("S40.G10.05.012.003" == $codeValeur) { // Code intitulé du contrat de travail
                $cdIntiContTrav = str_replace("'", "", $valeur);
                if($periodeActivite!=null) {
                    $periodeActivite->setCdIntiContTrav($cdIntiContTrav);
                }
                $cdIntiContTravDerniere = $cdIntiContTrav;
            }

            if("S40.G10.08.002.002" == $codeValeur) { // Code statut juridique 08
                $cdStatjuri08 = str_replace("'", "", $valeur);
                if($periodeActivite!=null) {
                    $periodeActivite->setCdStatjuri08($cdStatjuri08);
                }
                $cdStatjuri08Derniere = $cdStatjuri08;
            }

            if("S40.G10.10.002.002" == $codeValeur) { // Code statut juridique 10
                $cdStatjuri = str_replace("'", "", $valeur);
                $cdStatjuriDerniere = $cdStatjuri;

                if($periodeActivite!=null) {
                    $periodeActivite->setCdStatut($cdStatjuri);
                }
            }

            if("S40.G10.08.002.004" == $codeValeur) { // Code emploi statutaire (Droit statut d'emploi privé) grade 1
                $cdGrad1 = str_replace("'", "", $valeur);
                if($periodeActivite!=null) {
                    $periodeActivite->setCdGrad($cdGrad1);
                }
            }
            if("S40.G10.10.002.004" == $codeValeur) { // Code emploi statutaire (Statut d'emploi public) (grade 2)
                $cdGrad2 = str_replace("'", "", $valeur);
                if($periodeActivite!=null) {
                    if($periodeActivite->getCdGrad()== null || $periodeActivite->getCdGrad()== "") {
                        $periodeActivite->setCdGrad($cdGrad2);
                    }
                }
            }
            if("S40.G10.10.002.006" == $codeValeur) { // Code catégorie statutaire
                $cdCategstat = str_replace("'", "", $valeur);
            }

            if("S40.G10.10.011.001" == $codeValeur) { // Code profession et catégorie socioprofessionnelle
                $cdProfessionCategSocio = str_replace("'", "", $valeur);
            }

            if("S40.G10.10.012.001" == $codeValeur) { // Code nature du contrat de travail
                $cdNatureContratTrav = str_replace("'", "", $valeur);
            }

            if("S40.G10.10.024" == $codeValeur) { // Code position statutaire
                $cdPosistat = str_replace("'", "", $valeur);
                $cdPosistatDerniere = $cdPosistat;
            }
            if("S40.G10.25.002.001" == $codeValeur) { // Code statut d'appartenance à une fonction publique
                $cdStatAppart = str_replace("'", "", $valeur);
            }

            //S40.G15.00.003    // Temps de travail payé  ==========================================================================================> NON UTILISE

            if("S40.G15.00.020.001" == $codeValeur) { // Taux de travail à temps partiel (numérateur)
                $tauxTravTpsPartiel = str_replace("'", "", $valeur);
                $tauxTravTpsPartielDerniere = $tauxTravTpsPartiel;
            }
            if("S40.G15.00.022.001" == $codeValeur) { // Total des heures payées (heures supplémentaires, complémentaires ou de toute autre durée du travail comprises)
                $totalHeuresPayees = str_replace("'", "", $valeur);
                if($periodeActivite!=null) {
                    $periodeActivite->setTotalHeuresPayees($totalHeuresPayees);
                }
                $totalHeuresPayeesDerniere = $totalHeuresPayees;
            }
            if("S40.G15.00.022.002" == $codeValeur) { //  Total des heures payées (sans les heures supplémentaires, complémentaires)
                $nbHeurPayeSansSuppl = str_replace("'", "", $valeur);
                if($periodeActivite!=null) {
                    $periodeActivite->setNbHeurPayeSansSuppl($nbHeurPayeSansSuppl);
                }
            }
            if("S40.G15.10.013.001" == $codeValeur) { // Code modalité d'exercice du travail
                $cdModaliteExerTrav = str_replace("'", "", $valeur);
                $cdModaliteExerTravDerniere = $cdModaliteExerTrav;
                if($periodeActivite!=null) {
                    $periodeActivite->setCdModaliteExerTrav($cdModaliteExerTrav);
                }
            }
            if("S40.G15.10.025.004" == $codeValeur) { // Duree hebdo
                $dureeHebdo = str_replace("'", "", $valeur);
                $dureeHebdoDerniere = $dureeHebdo;
            }

            if("S40.G28.20.001" == $codeValeur) {  //   Code type de l'indemnité ou de la prime versée aux agents sous statut public
                $typeIndemnite = str_replace("'", "", $valeur);
            }

            if("S40.G28.20.002" == $codeValeur) {  // Montant de l'indemnité ou de la prime versée
                // Cas particulier, peut se rencontrer plusieurs fois par période d'activité, on ajooute ces primeactivité en focntion du dernier typeactivité rencontré
                // dans prime601 prime701 ou prime Autre
                $primeIndemniteStr = str_replace("'", "", $valeur); // Valeur recup dans le fichier

                //error_log('$typeIndemnite ' . $typeIndemnite,0);
                //error_log('$primeIndemniteStr ' . $primeIndemniteStr,0);

                if($periodeActivite!=null) {
                    $mt601 = $periodeActivite->getPrimeIndemnite601(); // recup du type indemnite 601
                    $mt102 = $periodeActivite->getPrimeIndemnite102(); // recup du type indemnite 102
                    $mt101 = $periodeActivite->getPrimeIndemnite101(); // recup du type indemnite 101
                    $mt = $periodeActivite->getPrimeIndemnite(); // recup de la prime autre rencontré

                    if($mt601==null || $mt601=="") $mt601 = 0;
                    if($mt102==null || $mt102=="") $mt102 = 0;
                    if($mt101==null || $mt101=="") $mt101 = 0;
                    if($mt==null || $mt=="") $mt = 0;

                    $primeIndemnite = 0;

                    if($primeIndemniteStr != null ) {
                        $primeIndemnite = floatval($primeIndemniteStr);
                    }

                    if($typeIndemnite == "601") {
                        // si type indem precedemment rencontré, ajout de la prime dans le montant total 601
                        $periodeActivite->setPrimeIndemnite601($mt601 + $primeIndemnite);
                    }
                    if($typeIndemnite == "102") {
                        // si type indem precedemment rencontré, ajout de la prime dans le montant total 102
                        $periodeActivite->setPrimeIndemnite102($mt102 + $primeIndemnite);
                    }
                    if($typeIndemnite == "101") {
                        // si type indem precedemment rencontré, ajout de la prime dans le montant total 101
                        $periodeActivite->setPrimeIndemnite101($mt101 + $primeIndemnite);
                    }

                    if($typeIndemnite != "101" && $typeIndemnite != "102" && $typeIndemnite != "200" && $typeIndemnite != "301" && $typeIndemnite != "403" && $typeIndemnite != "604" && $typeIndemnite != "601") {
                        $periodeActivite->setPrimeIndemnite($mt + $primeIndemnite);
                    }

                    //error_log('$periodeActivite->getPrimeIndemnite601()' . json_encode($periodeActivite->getPrimeIndemnite601()),0);
                    ///error_log('$periodeActivite->getPrimeIndemnite()' . json_encode($periodeActivite->getPrimeIndemnite()),0);

                }
            }

            if("S40.G40.00.035.001" == $codeValeur) { //Base brute fiscale
                $baseFiscale = str_replace("'", "", $valeur);
                if($periodeActivite!=null) {
                    $periodeActivite->setBaseFiscale($baseFiscale);
                }
            }

            if("S65.G43.10.001" == $codeValeur) {  // Code nature de la cotisation
                $codeNatureCotisation = str_replace("'", "", $valeur);
                if($periodeActivite!=null) {
                    $periodeActivite->setCodeNatureCotisation($codeNatureCotisation);
                }
            }

            if("S40.G10.00.010" == $codeValeur) {  // libellé nature emploi
                $lbNatureEmploiN4ds = str_replace("'", "", $valeur);
            }

            if("S65.G43.10.002.002" == $codeValeur) {  // Montant des retenues
                $montantRetenues = str_replace("'", "", $valeur);
                if($periodeActivite!=null) {
                    $periodeActivite->setMontantRetenues($montantRetenues);
                }
            }

            if("S40.G10.24.025.004" == $codeValeur) { // Code détaillé de la position de détachement  emploi fonctionnel
                $cdFoncpubl = str_replace("'", "", $valeur);
                if($periodeActivite!=null) {
                    $periodeActivite->setCdFoncpubl($cdFoncpubl);
                }
                $cdFoncpublDerniere = $cdFoncpubl;
            }

            if("S60.G05.00.001" == $codeValeur) { // Code inactivite => debut d' une nvlle periode d'inactivité => se repete
                $cdInactivite = str_replace("'", "", $valeur);

                if($periodeInactivite!=null) {
                    $periodeInactiviteList->add($periodeInactivite);
                }

                $periodeInactivite = new PeriodeInactivite();
                $periodeInactivite->setCdInactivite($cdInactivite);

            }

            if("S60.G05.00.002" == $codeValeur) { // Date de debut de période d'inactivité => Se repete
                $dtDebutInactivite = str_replace("'", "", $valeur);
                if($periodeInactivite!=null) {
                    $periodeInactivite->setDtDebut($dtDebutInactivite);
                }
            }

            if("S60.G05.00.003" == $codeValeur) { // Date de fin de période d'inactivité => Se repete
                $dtFinInactivite = str_replace("'", "", $valeur);
                if($periodeInactivite!=null) {
                    $periodeInactivite->setDtFin($dtFinInactivite);
                }
            }

            /* if("S65.G43.10.002.001" == $codeValeur) {  // Montant des retenues
              $montantCarence = str_replace("'", "", $valeur);
              if($periodeInactivite!=null) {
              $periodeInactivite->setNbMontantCarence($montantCarence);
              }
              } */

            if("S40.G10.25.002.004" == $codeValeur) { // // Code emploi statutaire
                $cdGradOrig = str_replace("'", "", $valeur);
            }

            if("S40.G10.10.002.002" == $codeValeur) {
                $codeStatutJuridique = str_replace("'", "", $valeur);
                if (($codeStatutJuridique == 11 || $codeStatutJuridique == 12) || ($codeStatutJuridique != 11 || $codeStatutJuridique != 12)) {
                    $blJourDeCarence = true;
                } else {
                    $blJourDeCarence = false;
                }
            }
        }//end foreach

        if($agent != null) {
            $agent->setNom($nom);
            $agent->setNomUsage($nomUsage);
            $agent->setPrenom($prenom);
            $agent->setCivilite($civilite);
            $agent->setDtNaissance($dtNaissance);
            $agent->setDtDebutPeriodeActivite($dtDebutPeriodeActivite);
            $agent->setDtDebutPeriodeActivite1ere($dtDebutPeriodeActivite1ere);
            $agent->setDtDebutPeriodeActiviteDerniere($dtDebutPeriodeActiviteDerniere);
            $agent->setCdMotifDebutPeriodeActivite($cdMotifDebutPeriodeActivite);
            $agent->setCdMotifDebutPeriodeActivite1ere($cdMotifDebutPeriodeActivite1ere);
            $agent->setDtFinPeriodeActivite($dtFinPeriodeActivite);
            $agent->setDtFinPeriodeActiviteDerniere($dtFinPeriodeActiviteDerniere);
            $agent->setCdMotifFinPeriodeActivite($cdMotifFinPeriodeActivite);
            $agent->setCdMotifFinPeriodeActiviteDerniere($cdMotifFinPeriodeActiviteDerniere);
            $agent->setTotalHeuresPayees($totalHeuresPayees);
            $agent->setTotalHeuresPayeesDerniere($totalHeuresPayeesDerniere);
            $agent->setCdPosistat($cdPosistat);
            $agent->setCdPosistatDerniere($cdPosistatDerniere);
            $agent->setCdStatjuri($cdStatjuri);
            $agent->setCdStatjuriDerniere($cdStatjuriDerniere);
            $agent->setCdCategstat($cdCategstat);
            $agent->setCdFoncpubl($cdFoncpubl);
            $agent->setCdFoncpublDerniere($cdFoncpublDerniere);
            $agent->setCdStatAppart($cdStatAppart);
            $agent->setCdGradOrig($cdGradOrig);
            $agent->setCdGrad1($cdGrad1);
            $agent->setCdGrad2($cdGrad2);
            $agent->setCdNatureContratTrav($cdNatureContratTrav);
            $agent->setCdModaliteExerTrav($cdModaliteExerTrav);
            $agent->setCdModaliteExerTravDerniere($cdModaliteExerTravDerniere);
            $agent->setDureeHebdoDerniere($dureeHebdoDerniere);
            $agent->setTauxTravTpsPartiel($tauxTravTpsPartiel);
            $agent->setTauxTravTpsPartielDerniere($tauxTravTpsPartielDerniere);
            $agent->setCdIntiContTrav($cdIntiContTrav);
            $agent->setCdIntiContTravDerniere($cdIntiContTravDerniere);
            $agent->setCdStatjuri08($cdStatjuri08);
            $agent->setCdStatjuri08Derniere($cdStatjuri08Derniere);
            $agent->setNbHeurPayeSansSuppl($nbHeurPayeSansSuppl);
            $agent->setBaseFiscale($baseFiscale);
            $agent->setPrimeIndemnite($primeIndemnite);
            $agent->setPrimeIndemnite601($primeIndemnite601);
            $agent->setPrimeIndemnite101($primeIndemnite101);
            $agent->setPrimeIndemnite102($primeIndemnite102);
            $agent->setCodeNatureCotisation($codeNatureCotisation);
            $agent->setLbNatureEmploiN4ds($lbNatureEmploiN4ds);
            $agent->setMontantRetenues($montantRetenues);
            $agent->setMontantCarence($montantCarence);
            $agent->setCdProfessionCategSocio($cdProfessionCategSocio);

            if($periodeActivite!=null) {
                $periodeActiviteList->add($periodeActivite);
                $periodeActiviteMoinsDerniereList->add($periodeActivite);
            }

            if($periodeInactivite!=null) {
                $periodeInactiviteList->add($periodeInactivite);
            }

            if(count($periodeActiviteMoinsDerniereList)>1) {
                // Suppression de la derniere periode d'activité
                $periodeActiviteMoinsDerniereList->remove(count($periodeActiviteMoinsDerniereList)-1);
            }
            $agent->setPeriodeActiviteList($periodeActiviteList);
            $agent->setPeriodeInactiviteList($periodeInactiviteList);
            $agent->setPeriodeActiviteMoinsDerniereList($periodeActiviteMoinsDerniereList);
            $agentList->add($agent);
        }


        // Chargement referentiel fixe global
        $refCycleTravailHebdoCTT001b = $em->getRepository('ReferencielBundle:RefCycleTravail')->findOneByCdCycltrav("CTT001b");
        //$emploiNonPermEF001 = $em->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findOneByCdEmplnonperm("EF001");
        $motifDepartSauv = $em->getRepository('ReferencielBundle:RefMotifDepart')->findOneByCdMotidepa("SAUVADET");
        //$code451 = "451";
        //$motifArrive451 = $em->getRepository('ReferencielBundle:RefMotifArrivee')->findOneByCdMotiN4ds($code451);
        //$emploiNonPermEF010 = $em->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findOneByCdEmplnonperm("EF010");
        //$emploiNonPermEF012 = $em->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findOneByCdEmplnonperm("EF012");
        //$empNonPerEF001 = $em->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findOneByCdEmplnonperm("EF001");

        $idFiliCulturelle = 3;


        /**
         *  Traitement import
         */

        $em->getConnection()->beginTransaction(); // suspend auto-commit

        try {
            error_log("Debut du traitement des agents nombre : " . json_encode(sizeof($agentList)), 0);

            // Recup un infocollagenexistent
            $info = $em->getRepository('ApaBundle:InformationColectiviteAgent')
                                        ->GetInformationCollectivite($collectivite->getIdColl(), $enquete->getIdEnqu(), $campagneCourante->getIdCamp());

            if($info == null) {
                $info = new InformationColectiviteAgent();
                $info->setCollectivite($collectivite);
                $info->setEnquete($enquete);
                $info->setCreatedAt($now);
                $em->persist($info);
                $em->flush();
                //error_log("info id = " . json_encode($info->getIdInfocollagen()), 0);
            }

            $nbAjout = 0;
            $nbRetraitViaQ42 = 0;

            //===================================================================================================================
            //===================================================================================================================
            //===================================================================================================================
            //===================================================================================================================
            //===================================================================================================================
            //===================================================================================================================
            //===================================================================================================================
            // Boucle principal de traitemzent, parcours des agents en memoire
            //===================================================================================================================
            //===================================================================================================================
            //===================================================================================================================
            //===================================================================================================================
            //===================================================================================================================
            //===================================================================================================================
            //===================================================================================================================
            foreach ($agentList as $agent) {
                $nom = $agent->getNom();
                $nomUsage = $agent->getNomUsage();
                $prenom = $agent->getPrenom();
                $civilite = $agent->getCivilite();
                $dtNaissance = $agent->getDtNaissance();
                $dtDebutPeriodeActivite = $agent->getDtDebutPeriodeActivite();
                $dtDebutPeriodeActivite1ere = $agent->getDtDebutPeriodeActivite1ere();
                $dtDebutPeriodeActiviteDerniere = $agent->getDtDebutPeriodeActiviteDerniere();
                $cdMotifDebutPeriodeActivite = $agent->getCdMotifDebutPeriodeActivite();
                $cdMotifDebutPeriodeActivite1ere = $agent->getCdMotifDebutPeriodeActivite1ere();
                $dtFinPeriodeActivite = $agent->getDtFinPeriodeActivite();
                $dtFinPeriodeActiviteDerniere = $agent->getDtFinPeriodeActiviteDerniere();
                $cdMotifFinPeriodeActivite = $agent->getCdMotifFinPeriodeActivite();
                $cdMotifFinPeriodeActiviteDerniere = $agent->getCdMotifFinPeriodeActiviteDerniere();
                $totalHeuresPayees = $agent->getTotalHeuresPayees();
                $totalHeuresPayeesDerniere = $agent->getTotalHeuresPayeesDerniere();
                $cdPosistat = $agent->getCdPosistat();
                $cdPosistatDerniere = $agent->getCdPosistatDerniere();
                $cdStatjuri = $agent->getCdStatjuri();
                $cdStatjuriDerniere = $agent->getCdStatjuriDerniere();
                $cdCategstat = $agent->getCdCategstat();
                $cdFoncpubl = $agent->getCdFoncpubl();
                $cdFoncpublDerniere = $agent->getCdFoncpublDerniere();
                $cdStatAppart = $agent->getCdStatAppart();
                $cdGradOrig = $agent->getCdGradOrig();
                $cdGrad1 = $agent->getCdGrad1();
                $cdGrad2 = $agent->getCdGrad2();
                $cdNatureContratTrav = $agent->getCdNatureContratTrav();
                $cdModaliteExerTrav = $agent->getCdModaliteExerTrav();
                $cdModaliteExerTravDerniere = $agent->getCdModaliteExerTravDerniere();
                $dureeHebdoDerniere = $agent->getDureeHebdoDerniere();
                $tauxTravTpsPartiel = $agent->getTauxTravTpsPartiel();
                $tauxTravTpsPartielDerniere = $agent->getTauxTravTpsPartielDerniere();
                $cdIntiContTrav = $agent->getCdIntiContTrav();
                $cdIntiContTravDerniere = $agent->getCdIntiContTravDerniere();
                $cdStatjuri08 = $agent->getCdStatjuri08();
                $cdStatjuri08Derniere = $agent->getCdStatjuri08Derniere();
                $nbHeurPayeSansSuppl = $agent->getNbHeurPayeSansSuppl();
                $baseFiscale = $agent->getBaseFiscale();
                $primeIndemnite = $agent->getPrimeIndemnite();
                $primeIndemnite601 = $agent->getPrimeIndemnite601();
                $primeIndemnite101 = $agent->getPrimeIndemnite101();
                $primeIndemnite102 = $agent->getPrimeIndemnite102();
                $codeNatureCotisation = $agent->getCodeNatureCotisation();
                $cdProfessionCategSocio = $agent->getCdProfessionCategSocio();
                $lbNatureEmploiN4ds = $agent->getLbNatureEmploiN4ds();
                $montantRetenues = $agent->getMontantRetenues();
                $montantCarence = $agent->getMontantCarence();
                $periodeActiviteList = $agent->getPeriodeActiviteList();
                $periodeActiviteMoinsDerniereList = $agent->getPeriodeActiviteMoinsDerniereList();
                $periodeInactiviteList = $agent->getPeriodeInactiviteList();

                //error_log($nom ,0);
                //error_log($prenom ,0);
                //error_log($civilite ,0);

                // Constitution de tableaux key/value pour les Q29.X
                $periodeActiviteStatutEmploiNonPermanentArray = array();
                $periodeActiviteStatutFiliereCategorieArray = array();
                //$periodeActiviteStatutCadreEmploiFiliereArray = array(); // => pour alerte Q30

                // init du bilanSocialAgent
                $bilanSocialAgent = new BilanSocialAgent();

                if($fichierN) {
                    if($nomUsage != null) {
                        $bilanSocialAgent->setLbNom($nomUsage);
                    }
                    else {
                        $bilanSocialAgent->setLbNom($nom);
                    }
                    $bilanSocialAgent->setLbPren($prenom);

                    $anneeNais = substr($dtNaissance, 4);
                    $moisNais = substr($dtNaissance, 2, 2);

                    $bilanSocialAgent->setLbDatenais($moisNais . "/" . $anneeNais);
                    //error_log($moisNais . "/" . $anneeNais,0);

                    // $civilite  H/F (fichier excel) ou 01/02 (json) ??   => cd_sexe = 1 ou 2
                    $sexe = "";
                    if($civilite == '01') {
                        $sexe = "1";
                    }
                    else if($civilite == '02') {
                        $sexe = "2";
                    }
                    $bilanSocialAgent->setCdSexe($sexe);

                    /**
                     *  Q5.1 c'est pour la premiere apparition de $dtDebutPeriodeActivite
                     */
                    // CALCUL Q51
                    $date1 = \DateTime::createFromFormat('dmY', $dtDebutPeriodeActivite1ere); // S40.G01.00.001
                    $date2 = \DateTime::createFromFormat('dmY', '0101'.$anneeCampagneCourante); // 01/01/N

                   // error_log('$date1:'.$date1->format('d/m/Y'),0);
                    //error_log('$date2:'.$date2->format('d/m/Y'),0);

                    $q51 = false;
                    if($date1>$date2) {
                        $q51 = true;
                    }
                    else if($date1==$date2  &&
                            ($cdMotifDebutPeriodeActivite1ere=="001" || $cdMotifDebutPeriodeActivite1ere=="089"
                                || $cdMotifDebutPeriodeActivite1ere=="903" || $cdMotifDebutPeriodeActivite1ere=="451")
                         ) {
                        $q51 = true;
                    }
                    else if($date1==$date2  &&
                            ($cdMotifDebutPeriodeActivite1ere!="001" && $cdMotifDebutPeriodeActivite1ere!="089"
                                && $cdMotifDebutPeriodeActivite1ere!="903" && $cdMotifDebutPeriodeActivite1ere!="451")
                         ) {
                        $q51 = false;
                    }

                    $bilanSocialAgent->setBlAgenarriannecoll($q51);

                    //error_log('q51 : ' . json_encode($q51), 0);

                    if($q51 == true) {
                        // $dtDebutPeriodeActivite1ere
                        $bilanSocialAgent->setDtArriStat($date1);
                    }

                    // CALCUL Q41 => pour la derniere S40.G01.00.003 du fichier
                    $q41 = false;

                    $dtFinPeriodeActiviteDerniereDate = \DateTime::createFromFormat('dmY', $dtFinPeriodeActiviteDerniere); // S40.G01.00.003
                    $dtFinCampagneCouranteDate = \DateTime::createFromFormat('dmY', '3112'.$anneeCampagneCourante); // 31/12/N

                    //error_log('$dtFinPeriodeActiviteDerniereDate:'. json_encode($dtFinPeriodeActiviteDerniereDate),0);
                    //error_log('$dtFinCampagneCouranteDate:'. json_encode($dtFinCampagneCouranteDate),0);


                    //error_log('$dtFinPeriodeActiviteDerniereDate:'.$dtFinPeriodeActiviteDerniereDate->format('d/m/Y'),0);
                    //error_log('$dtFinCampagneCouranteDate:'.$dtFinCampagneCouranteDate->format('d/m/Y'),0);


                    if($dtFinPeriodeActiviteDerniereDate < $dtFinCampagneCouranteDate) {
                        $q41 = false;
                    }
                    else if($dtFinPeriodeActiviteDerniereDate==$dtFinCampagneCouranteDate &&  floatval($totalHeuresPayeesDerniere) == 0) {
                        $q41 = false;
                    }
                    else if($dtFinPeriodeActiviteDerniereDate==$dtFinCampagneCouranteDate  && floatval($totalHeuresPayeesDerniere) > 0 &&
                            ($cdPosistatDerniere=="106" || $cdPosistatDerniere=="107" || $cdPosistatDerniere=="108")
                         ) {
                        $q41 = false;
                    }
                    /*else if($dtFinPeriodeActiviteDerniereDate == $dtFinCampagneCouranteDate
                            && ( $cdMotifFinPeriodeActiviteDerniere != "098" && $cdMotifFinPeriodeActiviteDerniere != "902" )) {
                        //error_log("q41 false par motif : " . $nom, 0);
                        $q41 = false;
                    }*/
                    else if($dtFinPeriodeActiviteDerniereDate==$dtFinCampagneCouranteDate  && floatval($totalHeuresPayeesDerniere) > 0 &&
                            ($cdPosistatDerniere!="104" && $cdPosistatDerniere!="106" && $cdPosistatDerniere!="107" && $cdPosistatDerniere!="108")
                         ) {
                        $q41 = true;
                    }
                    else if ($dtFinPeriodeActiviteDerniereDate==$dtFinCampagneCouranteDate  && floatval($totalHeuresPayeesDerniere) > 0 && $cdPosistatDerniere=="104"
                             && ($cdCategstat == "10" || $cdCategstat == "11" || $cdFoncpublDerniere == "113" )) {
                        $q41 = true;
                    }
                    else{
                        $q41 = false;
                    }

                   // error_log('$q41 : ' . json_encode($q41), 0);
                    $bilanSocialAgent->setBlAgenremu3112($q41);


                    // CALCUL Q42
                    $q42 = false;
                    if($q41 == true) {
                        $q42 = true;
                    }
                    else{
                        // calcul des totaux heures payes des périodes sauf la dernière
                        $totalHeuresPayeesSaufDerniere = 0;
                        foreach ($periodeActiviteMoinsDerniereList as $periode) {
                            $totalHeuresPayeesSaufDerniere += floatval($periode->getTotalHeuresPayees());
                        }
                        if($totalHeuresPayeesSaufDerniere == 0) {
                            $q42 = false;
                        }
                        else if($totalHeuresPayeesSaufDerniere > 0) {
                            $q42 = true;
                        }

                    }

                    if($q42 == false) {
                        // Si q42 = non , on importe pas l'agent, passage au suivante
                        $nbRetraitViaQ42++;
                        continue;
                    }

                    //error_log('$q42 : ' . json_encode($q42), 0);

                    $bilanSocialAgent->setBlAgenremuanne($q42);

                    // Calcul Q2  => Pour la derniere periode activité
                    // on matche cdMotiN4ds en mode Like car contient liste de code separé par -
                    $statut = $em->getRepository('ReferencielBundle:RefStatut')->findOneByInCdN4ds($cdStatjuriDerniere);
                    if($statut != null) {
                        // champs :  id_stat renseigne si trouvé
                        //error_log('statut found ',0);
                        $bilanSocialAgent->setRefStatut($statut);
                    }
                    else {
                        // Si non trouvé, alert statut n4ds : mettre le libellé correspondan cdStatjuriDerniere n4ds que l'on a pas encore => enum
                        $lbStatjuriDerniere = StatutJuridiqueN4dsEnum::getStatutJuridiqueN4dsShortLibelle($cdStatjuriDerniere);
                        //error_log('$lbStatjuriDerniere ' . $lbStatjuriDerniere,0);
                        $bilanSocialAgent->setLbStatJuriN4ds($lbStatjuriDerniere);
                    }

                    // Q2.0 : S40.G10.10.002.002  : si tous ces codes pareil => non sinon oui
                    // champs : bl_acqustatanne
                    $q20 = false;
                    $blStatutChange = false;
                    if(count($periodeActiviteList) != 0) {
                        $cdStatutCurr = "";
                        $count = 0;
                        foreach ($periodeActiviteList as $periode) {
                            if($count==0) {
                                $cdStatutCurr = $periode->getCdStatut();
                            }
                            else {
                                if($cdStatutCurr != $periode->getCdStatut()) {
                                    $blStatutChange = true;
                                    break;
                                }
                            }
                            $count++;
                        }
                    }

                    if($blStatutChange == true) {
                        $q20 = true;
                    }

                    //error_log('$q20 : ' . json_encode($q20), 0);
                    $bilanSocialAgent->setBlAcqustatanne($q20);


                    // Q8.1  champ unique  S40.G10.10.002.006 = 10 ou si S40.G10.24.025.004 = 113   oui sinon non
                    $q81 = false;
                    // champ bl_emplfonc
                    if($cdCategstat == "10" || $cdFoncpubl == "113") {
                        $q81 = true;
                    }
                    $bilanSocialAgent->setBlEmplfonc($q81);
                    //error_log('$q81 : ' . json_encode($q81), 0);

                    // Q8.2    : un seul champ
                    // champ id_foncpubl   (ref_fonction_publique)
                    $fctPubl = $em->getRepository('ReferencielBundle:RefFonctionPublique')->findOneByCdFoncpubl($cdStatAppart);
                    if($fctPubl != null) {
                        //error_log('fct publique found ',0);
                        $bilanSocialAgent->setRefFonctionPublique($fctPubl);
                    }

                    // Q8.2.1 : champ unique   : S40.G10.25.002.004   recup grade et donc cadre emploi
                    if ($cdGradOrig != null) {
                        $gradeOrig = $em->getRepository('ReferencielBundle:RefGrade')->findOneByInCdN4ds($cdGradOrig);
                        if($gradeOrig != null) {
                            // champ id_cadreemporig
                            //error_log('cadr emploi orig found ',0);
                            $bilanSocialAgent->setRefCadreEmploiOrigin($gradeOrig->getRefCadreEmploi());
                        }
                        else {
                            // si non trouver, on crée une alerte + nvl colonne
                            if($cdGradOrig != null && $cdGradOrig != "") {
                                $lbGradOrigDerniere = GradeN4dsEnum::getGradeN4dsShortLibelle($cdGradOrig);
                                //error_log('$lbGradOrigDerniere ' . $lbGradOrigDerniere,0);
                                $bilanSocialAgent->setLbGradeOrigN4ds($lbGradOrigDerniere);
                            }
                        }
                    }

                    // Q3 : Champ de la derniere periode  : soit un soit autre => ref_grade
                    $cdGrad = $cdGrad2;
                    if($cdGrad1 != null && $cdGrad1 != "") {
                        $cdGrad = $cdGrad1;
                    }
                    $grade = $em->getRepository('ReferencielBundle:RefGrade')->findOneByInCdN4ds($cdGrad);
                    if($grade!=null) {
                        //error_log('grade, etc  found ',0);
                        // champs : id_grad ; id_cadrempl ;  id_fili ; id_cate
                        $bilanSocialAgent->setRefGrade($grade);
                        $bilanSocialAgent->setRefCadreEmploi($grade->getRefCadreEmploi());
                        $bilanSocialAgent->setRefFiliere($grade->getRefCadreEmploi()->getRefFiliere());
                        $bilanSocialAgent->setRefCategorie($grade->getRefCadreEmploi()->getRefCategorie());
                    }
                    else {
                        // si non trouver, on crée une alerte + nvl colonne
                        $lbGrad = GradeN4dsEnum::getGradeN4dsShortLibelle($cdGrad);
                        //error_log('$lbGrad ' . $lbGrad,0);
                        $bilanSocialAgent->setLbGradeN4ds($lbGrad);
                    }

                    // Emploi fonctionnel
                    if($q81 == true) {
                        $bilanSocialAgent->setFiliereEmpFonc($bilanSocialAgent->getRefFiliere());
                        $emploiFonc = $em->getRepository('ReferencielBundle:RefEmploiFonctionnel')->findOneByInCdN4ds($cdGrad);
                        $bilanSocialAgent->setRefEmploiFonctionnel($emploiFonc);
                    }

                    // Emploi non permanent
                    if($statut != null && $statut->getCdStat() == 'CONTNONPERM') {
                        // Si statut emploi non permanent
                        $enp = $em->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findOneByInCdN4ds($cdGrad);
                        $bilanSocialAgent->setRefEmploiNonPermanent($enp);

                        $lbAlerteNonPermanentN4ds = AlerteNonPermanentN4dsEnum::getAlerteNonPermanentLibelle($cdStatjuriDerniere);
                        //error_log('$lbAlerteNonPermanentN4ds ' . $lbAlerteNonPermanentN4ds,0);
                        $bilanSocialAgent->setLbAlerteNonPermanentN4ds($lbAlerteNonPermanentN4ds);

                    }

                    // Q5.3   : comparer toutes les periodes
                    // si chgt de statut (stat juridique, refStatut S40.G10.10.002.002 ) dans ces periodes
                    // si pas de chgt : si chgt de filiere via id_grad par periode  => oui sinon non
                    // si chgt  : oui
                    // champ bl_mouvinteanne
                    $q53 = false;
                    $blStatutChange = false;
                    $cdStatutCurr = "";
                    $count = 0;
                    foreach ($periodeActiviteList as $periode) {
                        if($count==0) {
                            $cdStatutCurr = $periode->getCdStatut();
                        }
                        else {
                            if($cdStatutCurr != $periode->getCdStatut()) {
                                $blStatutChange = true;
                                break;
                            }
                        }
                        $count++;
                    }

                    if($blStatutChange) {
                        $q53 = true;
                    }
                    else{
                        $blFiliChange = false;
                        $cdFiliCurr = "";
                        $count = 0;
                        foreach ($periodeActiviteList as $periode) {
                            if($periode->getCdGrad() == null || $periode->getCdGrad() == "") {
                                continue;
                            }

                            $gradeCurr = $em->getRepository('ReferencielBundle:RefGrade')->findOneByInCdN4ds($periode->getCdGrad());
                            if($gradeCurr == null) {
                                continue;
                            }

                            if($count==0) {
                                $cdFiliCurr = $gradeCurr->getRefCadreEmploi()->getRefFiliere()->getCdFili();
                            }
                            else {
                                if($cdFiliCurr != $gradeCurr->getRefCadreEmploi()->getRefFiliere()->getCdFili()) {
                                    $blFiliChange = true;
                                    break;
                                }
                            }

                            $count++;
                        }

                        if($blFiliChange) {
                            $q53 = true;
                        }
                    }

                    //error_log('$q53 : ' . json_encode($q53), 0);

                    //$bilanSocialAgent->setBlMouvinteanne($q53);

                    // Q2.7
                    if($q41 == true && $q81 == false) {
                        if($cdPosistatDerniere == "101") {
                            //error_log('posi acti : 1',0);
                            $bilanSocialAgent->setBlPosiacti(true);
                        }
                        else{
                            $bilanSocialAgent->setBlPosiacti(false);
                            $posistat = $em->getRepository('ReferencielBundle:RefPositionStatutaire')->findOneByInCdN4ds($cdPosistatDerniere);
                            if($posistat != null) {
                                // champs :  id_posistat renseigne si trouvé
                                //error_log('posi stat found ',0);
                                $bilanSocialAgent->setRefPositionStatutaire($posistat);
                            }
                            else {
                                // Si non trouvé, alert statut n4ds : mettre le libellé correspondan cdPosistatDerniere n4ds que l'on a pas encore => enum
                                $lbPosistatDerniere = PositionStatutaireN4dsEnum::getPositionStatutaireN4dsShortLibelle($cdPosistatDerniere);
                                //error_log('$lbPosistatDerniere ' . $lbPosistatDerniere,0);
                                $bilanSocialAgent->setlbPosiStatN4ds($lbPosistatDerniere);
                            }
                        }
                    }
                    else if($q41 == false && $q42 == false) {
                        if($cdPosistatDerniere == "101") {
                            $bilanSocialAgent->setBlPosiactiNonRemu(true);
                             //error_log('posi acti non remu : 1',0);
                        }
                        else{
                            $bilanSocialAgent->setBlPosiactiNonRemu(false);
                            $posistat = $em->getRepository('ReferencielBundle:RefPositionStatutaire')->findOneByInCdN4ds($cdPosistatDerniere);
                            if($posistat != null) {
                                // champs :  id_posistat renseigne si trouvé
                                //error_log('posi stat non remu found ',0);
                                $bilanSocialAgent->setRefPositionStatutaireNonRemu($posistat);
                            }
                            else {
                                // Si non trouvé, alert statut n4ds : mettre le libellé correspondan cdPosistatDerniere n4ds que l'on a pas encore => enum
                                $lbPosistatDerniere = PositionStatutaireN4dsEnum::getPositionStatutaireN4dsShortLibelle($cdPosistatDerniere);
                                //error_log('$lbPosistatDerniere non remu ' . $lbPosistatDerniere,0);
                                $bilanSocialAgent->setLbPosiStatNonRemuN4ds($lbPosistatDerniere);
                            }
                        }
                    }

                    // Q17 :
                    // si statut = 011 ou 012 sur la derniere periode, et que
                    // Toute periode sauf derniere le statut juridique = "030 OU 040 OU 052 OU 054  OU 060  OU 110 OU 150 OU 160
                    //  alors q17 = oui
                    // sinon non
                    // champ :  bl_agentitustagannee
                    // si oui , renseigner une valeur : id_motidepart par SAUVADET (notre code)
                    $q17 = false;
                    $statutOk = false;
                    $dtDebutPeriodeActiviteDerniereDate = \DateTime::createFromFormat('dmY', $dtDebutPeriodeActiviteDerniere);
                    if($cdStatjuriDerniere == "011" ||  $cdStatjuriDerniere == "012") {
                        foreach ($periodeActiviteMoinsDerniereList as $periode) {
                            if($periode->getCdStatut() == "030" ||
                                    $periode->getCdStatut() == "040" ||
                                    $periode->getCdStatut() == "052" ||
                                    $periode->getCdStatut() == "054" ||
                                    $periode->getCdStatut() == "060" ||
                                    $periode->getCdStatut() == "110" ||
                                    $periode->getCdStatut() == "150" ||
                                    $periode->getCdStatut() == "160"
                                    ) {
                                $statutOk = true;
                                break;
                            }
                        }
                    }
                    if($statutOk) {
                        $q17 = true;
                        // si true, init par SAUVADET
                        if($motifDepartSauv !=null) {
                            $bilanSocialAgent->setRefMotifDepart($motifDepartSauv);
                        }

                        // update de dt_chanstat = date de début de la dern per d'activ
                        //$bilanSocialAgent->setDtChanstat($dtDebutPeriodeActiviteDerniereDate);

                    }

                    //error_log('$q17 : ' . json_encode($q17), 0);

                    $bilanSocialAgent->setBlAgentitustaganne($q17);

                    // Q5.2 derniere periode activité
                    if($dtFinPeriodeActiviteDerniereDate <= $dtFinCampagneCouranteDate
                            && ( $cdMotifFinPeriodeActiviteDerniere != "098" && $cdMotifFinPeriodeActiviteDerniere != "902" )) {
                        // ou $dtFinPeriodeActiviteDerniereDate = 31/12 et modif fin de la derniere periode != 098 et != 902 , on reporte la date +
                        // setRefMotifDepart init par motif fin dern periode , via leur code
                        // sinon alerte si non trouvé

                        //error_log('$dtFinPeriodeActiviteDerniere ' . $dtFinPeriodeActiviteDerniere,0 );

                        $bilanSocialAgent->setLbDatedepacoll($dtFinPeriodeActiviteDerniereDate);

                        // Q16 motif de fin de la derniere periode
                        // referentiel :  ref_motif_depart : ajout d'un code de chez eux
                        // matcher, si on trouve pas, mettre le champ en alerte : manque un champ alerte dans bilan social agent
                        // => il faut mettre le code  (S40.G01.00.004.001) (mais corresp libelle) du fichier dans un champ lb_motin4ds si id_moti_depa = null
                        // Dans colonne n4ds du refe motidepar, il pourra avoir plusieur code separé par - ex : 50-60-20
                        if ($statut != null) {
                            if ($cdMotifFinPeriodeActiviteDerniere == "008") {
                                /*if ($statut->getCdStat() == 'TITU' || $statut->getCdStat() == 'STAG') {
                                    $cdMotifFinPeriodeActiviteDerniere = $cdMotifFinPeriodeActiviteDerniere."F";
                                } else if ($statut->getCdStat() == 'CONTPERM') {
                                    $cdMotifFinPeriodeActiviteDerniere = $cdMotifFinPeriodeActiviteDerniere."C";
                                }*/
                            }
                        }
                        $motifDepart = $em->getRepository('ReferencielBundle:RefMotifDepart')->findOneByInCdN4ds($cdMotifFinPeriodeActiviteDerniere);

                        if( $motifDepart != null) {
                            //error_log('motif depart found ',0);
                            $bilanSocialAgent->setRefMotifDepart($motifDepart);
                        }
                        else {
                            // Si non trouvé, alert statut n4ds : mettre le libellé correspondan cdMotifFinPeriodeActiviteDerniere n4ds que l'on a pas encore => enum
                            $lbMotifFinPeriodeActiviteDerniere = MotifDepartN4dsEnum::getMotifDepartN4dsShortLibelle($cdMotifFinPeriodeActiviteDerniere);
                            //error_log('$lbMotifFinPeriodeActiviteDerniere ' . $lbMotifFinPeriodeActiviteDerniere,0);
                            $bilanSocialAgent->setLbMotiN4ds($lbMotifFinPeriodeActiviteDerniere);
                        }
                    }

                    // Q2.1 : derniere periode activite , si date fin periode = 31/12 , et cdnature == 01 q21  = oui
                    $q21 = false;
                    if($dtFinPeriodeActiviteDerniereDate == $dtFinCampagneCouranteDate && $cdNatureContratTrav == "01") {
                        $q21 = true;
                    }
                    //error_log('$q21 : ' . json_encode($q21), 0);
                    $bilanSocialAgent->setBlCdi($q21);

                    // Nvlle donnée natrue emploii de l'agent
                    $bilanSocialAgent->setLbNatureEmploiN4ds($lbNatureEmploiN4ds);

                    $q111 = false;
                    // Q11.1  Code modalité d'exercice du travail  <>90 OU <>'50<>23<>25<>27<>29<>31<>33  Alors oui sinon Non
                    // champ bl_tempcomp
                    if($cdModaliteExerTravDerniere != "90" && $cdModaliteExerTravDerniere != "50" && $cdModaliteExerTravDerniere != "23" && $cdModaliteExerTravDerniere != "25"
                        && $cdModaliteExerTravDerniere != "27" && $cdModaliteExerTravDerniere != "29" && $cdModaliteExerTravDerniere != "31"&& $cdModaliteExerTravDerniere != "33") {
                        $q111 = true;
                    }

                    $bilanSocialAgent->setBlTempcomp($q111);
                    //error_log('$q111 : ' . json_encode($q111), 0);

                    // Q12.1 :
                    // si code modalite = 10  alors q121 = oui
                    // sinon q121 = non
                    // champ bl_tempplein
                    $q121 = true;
                    if($cdModaliteExerTravDerniere != "10") {
                        $q121 = false;
                    }
                    $bilanSocialAgent->setBlTempplein($q121);
                    //error_log('$q121 : ' . json_encode($q121), 0);

                    // Q12.2 :
                    // si q121 = non     alors    recup valeur du code modalite,
                    // init de refTpsPartiel (+ ajout de colonne de corresp dans tpspartiel n4ds)
                    // champ id_tpspartiel
                    if($q121 == false) {
                        // cdModa n4ds peut etre une liste de code speraré par - dans refTpsPartiel
                        $refTpsPartiel = $em->getRepository('ReferencielBundle:RefTempsPartiel')->findOneByInCdN4ds($cdModaliteExerTravDerniere);
                        if( $refTpsPartiel != null) {
                            $bilanSocialAgent->setRefTempsPartiel($refTpsPartiel);
                            //error_log('ref tps partiel found ',0);
                        }
                        else {
                            // on stocke le libellé corresp au code n4ds
                            $lbModaliteExerTravDerniere = TempsPartielN4dsEnum::getTempsPartielN4dsShortLibelle($cdModaliteExerTravDerniere);
                            //error_log('$lbModaliteExerTravDerniere ' . $lbModaliteExerTravDerniere,0);
                            $bilanSocialAgent->setLbModaN4ds($lbModaliteExerTravDerniere);
                        }
                    }


                    // Q11.2 :
                    // si code modalite = 50, alors, recup duree hebdo n4ds (nb à point) => refeentiel tps non complet (ajout champs borne min et max) : 3 valeurs :
                    // moins 17h30  ou 17h30 à 28h et plus de 28h
                    // champ id_tpsnoncomplet
                    if($cdModaliteExerTravDerniere == "50" && $dureeHebdoDerniere != "") {
                        //error_log('$cdModaliteExerTravDerniere ' . $cdModaliteExerTravDerniere,0 );
                        $tab2 = explode(".", $dureeHebdoDerniere);
                        $heure = "0";
                        $minute = "0";
                        if( Count($tab2) > 0 )  {
                            $heure = $tab2[0];
                        }
                        if( Count($tab2) > 1 )  {
                            $minute = $tab2[1];
                        }

                        $heureInt = intval($heure);

                        //error_log('$heure ' . $heure,0 );
                        //error_log('$minute ' . $minute,0 );

                        $minuteInt = intval($minute);
                        $tpsMinute = $heureInt * 60 + $minuteInt;

                        //error_log('$tpsMinute '  . json_encode($tpsMinute),0 );

                        foreach ($refTpsNonCompletList as $tpsNonComplet) {
                            $borneMin = 0;
                            if($tpsNonComplet->getNbMinuteBorneMin() != null) {
                                $borneMin = $tpsNonComplet->getNbMinuteBorneMin();
                            }
                            $borneMax = 10000000;
                            if($tpsNonComplet->getNbMinuteBorneMax() != null) {
                                $borneMax = $tpsNonComplet->getNbMinuteBorneMax();
                            }

                            if ( $tpsMinute >= $borneMin && $tpsMinute < $borneMax ) {
                                //error_log('ref tps non complet found '.$tpsNonComplet->getCdTempnoncomp(),0);
                                $bilanSocialAgent->setRefTempsNonComplet($tpsNonComplet);
                                break;
                            }
                        }
                    }

                    // Q12.3
                    // Si q11.1 = oui et q12.1 = non alors
                    // recup d'un nombre et dans notre referentiel, on a un pourcentage : + borne min et max dans type tps partiel
                    // champ id_refpourcentage tps partiel
                    if($q111 == true && $q121 == false ) {
                        if($tauxTravTpsPartielDerniere=="") {
                            $tauxTravTpsPartielDerniere = "0";
                        }
                        $tauxTravTpsPartielDerniereFloat = floatval($tauxTravTpsPartielDerniere);

                        foreach ($refPourcentageTempaPartielList as $refPourcentageTempaPartiel) {
                            $borneMin = 0;
                            if($refPourcentageTempaPartiel->getPcBorneMin() != null) {
                                $borneMin = $refPourcentageTempaPartiel->getPcBorneMin();
                            }
                            $borneMax = 100;
                            if($refPourcentageTempaPartiel->getPcBorneMax() != null) {
                                $borneMax = $refPourcentageTempaPartiel->getPcBorneMax();
                            }

                            if ( $tauxTravTpsPartielDerniereFloat >= $borneMin && $tauxTravTpsPartielDerniereFloat < $borneMax ) {
                                $bilanSocialAgent->setRefPourcentageTempaPartiel($refPourcentageTempaPartiel);
                                //error_log('ref pc tps partie found '.$refPourcentageTempaPartiel->getCdPourtemppart(),0);
                                break;
                            }
                        }
                    }

                    // Q24  :
                    // champ mettre id_ ref_cycle travail = cycle hebdomadaire de 35h (ctt001b)
                    $bilanSocialAgent->setRefCycleTravail($refCycleTravailHebdoCTT001b);


                    //Q20.1
                    //        Q20.1 = 1 si nb periode inactivité > 0
                    //        sinon = 0
                    //        BL_AGENABSE = Q20.1
                    $q201 = false;
                    if(count($periodeInactiviteList) != 0) {
                        $q201 = true;
                    }
                    $bilanSocialAgent->setBlAgenabse($q201);
                    //error_log('===============> $q201 : ' . json_encode($q201), 0);

                    if(count($periodeInactiviteList) != 0) {
                        //Q20.2
                        //Init la table absence_arret_agent pour chaque periode d'inactivité
                        //=> Groupé par id_motiabse : que fait on si on trouve pas????? => ajout d'une ligne pas de groupement
                        //- cherche id_motiabse avec le code n4ds  S60.G05.00.001
                        //- sinon ajout du libellé n4ds via enum
                        //- NB_JOURABSE calculé avec la methode nb jour moins ferié et WE
                        //- Nb_ARRE : nb de periodes
                        
                        $nbJourCarencePreleves100 = 0;
                        $nbJourCarencePreleves118 = 0;
                        foreach ($periodeInactiviteList as $periode) {
                            $absenceCdN4ds = $periode->getCdInactivite();
                            $dgclJoursCarence = $bilanSocialAgent->getDgcl();
                            $nbJoursOuvres = $this->getNbJoursDiff($periode->getDtDebut(), $periode->getDtFin());
                            $periode->setNbJourOuvre($nbJoursOuvres);
                            //error_log('jours ouvre période ' . json_encode($periode->getDtDebut()) . ' => ' .  json_encode($periode->getDtFin())
                            //            . ' : ' . json_encode($nbJoursOuvres)
                            //        , 0);

                            $motifAbsence = $em->getRepository('ReferencielBundle:RefMotifAbsence')->findOneByInCdN4ds($periode->getCdInactivite());
                            $ajoutNew = true;
                            
                            /*
                            *   dgcl jours de carence
                            */
                            if($absenceCdN4ds == '118'){
                                $nbJourCarencePreleves118++;
                                // $nbJourCarencePreleves118 += $nbJoursOuvres;
                                if($dgclJoursCarence == null){
                                    $dgclJoursCarence = new Dgcl();
                                    $dgclJoursCarence->setBlJoursCarence($blJourDeCarence);
                                    $dgclJoursCarence->setNbJoursCarence(0);
                                    //$dgclJoursCarence->setNbMontantCarence(0);
                                    $dgclJoursCarence->setBilanSocialAgent($bilanSocialAgent);
                                    $bilanSocialAgent->setDgcl($dgclJoursCarence);
                                }
                                $dgclJoursCarence->setNbJoursCarence($nbJoursOuvres);
                                $nbJoursCarence = $dgclJoursCarence->getNbJoursCarence() + floatval($periode->getNbJourOuvre());
                                $nbMontantCarence = floatval($montantCarence);
                                // $dgclJoursCarence->setNbJoursCarence($nbJoursCarence);
                                //$dgclJoursCarence->setNbMontantCarence($nbMontantCarence);
                            }
                            if($absenceCdN4ds == '100'){
                                $nbJourCarencePreleves100++;
                                // $nbJourCarencePreleves100 += $nbJoursOuvres;
                                if($dgclJoursCarence == null){
                                    $dgclJoursCarence = new Dgcl();
                                    $dgclJoursCarence->setBlJoursCarence($blJourDeCarence);
                                    $dgclJoursCarence->setNbJoursCarence(0);
                                    //$dgclJoursCarence->setNbMontantCarence(0);
                                    $dgclJoursCarence->setBilanSocialAgent($bilanSocialAgent);
                                    $bilanSocialAgent->setDgcl($dgclJoursCarence);
                                }
                                $dgclJoursCarence->setNbJoursCarence($nbJourCarencePreleves100);
                                $nbJoursCarence = $dgclJoursCarence->getNbJoursCarence() + floatval($periode->getNbJourOuvre());
                                $nbMontantCarence = floatval($montantCarence);
                                // $dgclJoursCarence->setNbJoursCarence($nbJoursCarence);
                                //$dgclJoursCarence->setNbMontantCarence($nbMontantCarence);
                            }
                            if( $motifAbsence != null) {
                                //error_log('motif absence found ',0);
                                // Est il deja dans le liste des abasences
                                foreach ($bilanSocialAgent->getAbsenceArretAgents() as $abs) {
                                    if($abs->getRefMotifAbsence() != null &&
                                        $abs->getRefMotifAbsence()->getIdMotiabse() == $motifAbsence->getIdMotiabse()) {
                                        // motif absence deja dans la liste, on ajoute le nb de jour
                                        $nbJourabse = $abs->getNbJourabse() + floatval($periode->getNbJourOuvre());
                                        $nbArre = $absenceCdN4ds == '118' ? $abs->getNbArre() : $abs->getNbArre() + 1;

                                        $abs->setNbJourabse($nbJourabse);
                                        $abs->setNbArre($nbArre);
                                        $ajoutNew = false;
                                        break;
                                    }
                                }
                            }

                            //error_log('$ajoutNew : ' . json_encode($ajoutNew)
                            //        , 0);

                            if($ajoutNew == true) {
                                // Pas de motif absence trouvé ou motif trouvé mais pas encore dans le liste AbsenceArretAgent du bilan
                                // => ajout d'une nouvelle ligne
                                $abs = new AbsenceArretAgent();

                                if( $motifAbsence == null) {
                                    // Si non trouvé, alert motif abs n4ds : mettre le libellé correspondant
                                    $lbMotifAbsence = MotifAbsenceN4dsEnum::getMotifAbsenceN4dsShortLibelle($periode->getCdInactivite());
                                    //error_log('$lbMotifAbsence ' . $lbMotifAbsence,0);
                                    $abs->setLbMotiAbseN4ds($lbMotifAbsence);
                                }

                                $abs->setBilanSocialAgent($bilanSocialAgent);
                                $abs->setCdUtilcrea($user->getUsername());
                                $abs->setCreatedAt($now);
                                $abs->setNbJourabse(floatval($periode->getNbJourOuvre()));
                                $abs->setNbArre($absenceCdN4ds == '118' ? 0 : 1);
                                $abs->setRefMotifAbsence($motifAbsence);
                                $bilanSocialAgent->addAbsenceArretAgent($abs);
                            }
                        }

                        //Q21
                        //si code motif abs n4ds = 203  => Q21 = 1
                        //sinon = 0
                        //BL_CONGPATEACCU
                        $code203 = "203";
                        $blMotif203Exist = false;
                        $q21 = false;
                        foreach ($periodeInactiviteList as $periode) {
                            if($periode->getCdInactivite() == $code203) {
                                $blMotif203Exist = true;
                                break;
                            }
                        }
                        if($blMotif203Exist==true) {
                            $q21 = true;
                        }
                        //error_log('$q21 : ' . json_encode($q21), 0);

                        $bilanSocialAgent->setBlCongpateaccuenfa($q21);

                        //Q21.1
                        //Si Q21 = 1
                        //renseigner NB_JOURCONGPATEACCU = somme des jour ouvré de des periodes 203
                        $nbJours203 = 0;
                        foreach ($periodeInactiviteList as $periode) {
                            if($periode->getCdInactivite() == $code203 && $periode->getNbJourOuvre()!=null ) {
                                $nbJours203 = $nbJours203 + floatval($periode->getNbJourOuvre());
                            }
                        }
                        //error_log('$nbJours203 : ' . json_encode($nbJours203), 0);
                        $bilanSocialAgent->setNbJourcongpateaccuenfa($nbJours203);

                    }

                }// End fichierN

                // Regroupement par periode pour alimentation table remuneration_agent
                foreach ($periodeActiviteList as $periode) {
                    $idStatut = null;
                    $statut = $em->getRepository('ReferencielBundle:RefStatut')->findOneByInCdN4ds($periode->getCdStatut());
                    if ($statut != null) {
                        $idStatut = $statut->getIdStat();
                    } else {
                        continue;
                    }

                    // Recup Filiere / Categorie
                    $gradeExist = false;
                    $idFili = null;
                    $refFiliere = null;
                    $idCate = null;
                    $refCategorie = null;
                    $cdGrade = $periode->getCdGrad();
                    $grade = $em->getRepository('ReferencielBundle:RefGrade')->findOneByInCdN4ds($periode->getCdGrad());

                    if ($grade != null) {
                        $gradeExist = true;
                        $idFili = $grade->getRefCadreEmploi()->getRefFiliere()->getIdFili();
                        $refFiliere = $grade->getRefCadreEmploi()->getRefFiliere();
                        $idCate = $grade->getRefCadreEmploi()->getRefCategorie()->getIdCate();
                        $refCategorie = $grade->getRefCadreEmploi()->getRefCategorie();
                    }

                    // Recup emploi non permanent
                    $empNonPer = null;
                    if ($statut != null && $statut->getCdStat() == 'CONTNONPERM' && $cdGrade !== null) {
                        // Si statut emploi non permanent
                        $empNonPer = $em->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findOneByInCdN4ds($cdGrade);
                    }
                    $idEmplNonPermanent = null;
                    $cdEmplNonPermanent = "";
                    if ($empNonPer != null) {
                        $idEmplNonPermanent = $empNonPer->getIdEmplnonperm();
                        $cdEmplNonPermanent = $empNonPer->getCdEmplnonperm();
                    }

                    if ($statut->getCdStat() == 'CONTNONPERM') {
                        // Regroupement des périodes par statut et par emploi non permanent
                        $key = $periode->getCdStatut() . "-" . $cdEmplNonPermanent;

                        if (array_key_exists($key, $periodeActiviteStatutEmploiNonPermanentArray)) {
                            // Si doublon statut/grade deja ajoute => on le recupere et on ajoute le nb heure
                            $periodeActiviteStatutENP = $periodeActiviteStatutEmploiNonPermanentArray[$key];

                            $montantRemunerationAnnuelleBrute = $periodeActiviteStatutENP->getMontantRemunerationAnnuelleBrute();
                            if($periode->getBaseFiscale()!=null && $periode->getBaseFiscale() != "") {
                                $montantRemunerationAnnuelleBrute = $montantRemunerationAnnuelleBrute + floatval($periode->getBaseFiscale());
                                $periodeActiviteStatutENP->setMontantRemunerationAnnuelleBrute($montantRemunerationAnnuelleBrute);
                            }

                            $dtDeb = \DateTime::createFromFormat('dmY', $periode->getDtDebut());
                            $dtFin = \DateTime::createFromFormat('dmY', $periode->getDtFin());
                            if($periodeActiviteStatutENP->getDtDebut() > $dtDeb) {
                                $periodeActiviteStatutENP->setDtDebut($dtDeb);
                            }
                            if($periodeActiviteStatutENP->getDtFin() < $dtFin) {
                                $periodeActiviteStatutENP->setDtFin($dtFin);
                            }

                        }
                        else {
                            // Si doublon statut/grade pas encore ajouté => on l ajoute
                            $periodeActiviteStatutENP = new PeriodeActiviteStatutEmploiNonPermanent();
                            $periodeActiviteStatutENP->setIdStat($idStatut);
                            $periodeActiviteStatutENP->setRefStatut($statut);
                            $periodeActiviteStatutENP->setIdEmploiNonPermanent($idEmplNonPermanent);
                            $periodeActiviteStatutENP->setRefEmploiNonPermanent($empNonPer);

                            $periodeActiviteStatutENP->setMontantRemunerationAnnuelleBrute(0);
                            if($periode->getBaseFiscale()!=null && $periode->getBaseFiscale() != "") {
                                $periodeActiviteStatutENP->setMontantRemunerationAnnuelleBrute(floatval($periode->getBaseFiscale()));
                            }

                            $periodeActiviteStatutENP->setDtDebut(\DateTime::createFromFormat('dmY', $periode->getDtDebut()));
                            $periodeActiviteStatutENP->setDtFin(\DateTime::createFromFormat('dmY', $periode->getDtFin()));

                            $periodeActiviteStatutEmploiNonPermanentArray[$key] = $periodeActiviteStatutENP;
                        }

                    }
                    else {
                        // Regroupement des périodes par statut , filiere et categ
                        if ($gradeExist && $idFili != null && $idCate != null) {
                            $key2 = $periode->getCdStatut() . "-" . $idFili . "-" . $idCate;

                            if (array_key_exists($key2, $periodeActiviteStatutFiliereCategorieArray)) {
                                // Si doublon statut/grade deja ajoute => on le recupere et on ajoute le nb heure
                                $periodeActiviteStatut = $periodeActiviteStatutFiliereCategorieArray[$key2];

                                $montantRemunerationAnnuelleBrute = $periodeActiviteStatut->getMontantRemunerationAnnuelleBrute();
                                if($periode->getBaseFiscale()!=null && $periode->getBaseFiscale() != "") {
                                    $montantRemunerationAnnuelleBrute = $montantRemunerationAnnuelleBrute + floatval($periode->getBaseFiscale());
                                    $periodeActiviteStatut->setMontantRemunerationAnnuelleBrute($montantRemunerationAnnuelleBrute);
                                }

                                $montantPrime = $periodeActiviteStatut->getMontantPrime();
                                if($periode->getPrimeIndemnite()!=null && $periode->getPrimeIndemnite() != "") {
                                    $montantPrime = $montantPrime + floatval($periode->getPrimeIndemnite());
                                    $periodeActiviteStatut->setMontantPrime($montantPrime);
                                }

                                $montantHcHs = $periodeActiviteStatut->getMontantHcHs();
                                if($periode->getPrimeIndemnite601()!=null && $periode->getPrimeIndemnite601() != "") {
                                    $montantHcHs = $montantHcHs + floatval($periode->getPrimeIndemnite601());
                                    $periodeActiviteStatut->setMontantHcHs($montantHcHs);
                                }

                                $montantSft = $periodeActiviteStatut->getMontantSft();
                                if($periode->getPrimeIndemnite102()!=null && $periode->getPrimeIndemnite102() != "") {
                                    $montantSft = $montantSft + floatval($periode->getPrimeIndemnite102());
                                    $periodeActiviteStatut->setMontantSft($montantSft);
                                }

                                $montantIr = $periodeActiviteStatut->getMontantIr();
                                if($periode->getPrimeIndemnite101()!=null && $periode->getPrimeIndemnite101() != "") {
                                    $montantIr = $montantIr + floatval($periode->getPrimeIndemnite101());
                                    $periodeActiviteStatut->setMontantIr($montantIr);
                                }

                                $montantNbi = $periodeActiviteStatut->getMontantNbi();
                                if($periode->getCodeNatureCotisation()== "20") {
                                    if($periode->getMontantRetenues()!=null && $periode->getMontantRetenues() != "") {
                                        $montantNbi = $montantNbi + floatval($periode->getMontantRetenues());
                                        $periodeActiviteStatut->setMontantNbi($montantNbi);
                                    }
                                }

                                $dtDeb = \DateTime::createFromFormat('dmY', $periode->getDtDebut());
                                $dtFin = \DateTime::createFromFormat('dmY', $periode->getDtFin());
                                if($periodeActiviteStatut->getDtDebut() > $dtDeb) {
                                    $periodeActiviteStatut->setDtDebut($dtDeb);
                                }
                                if($periodeActiviteStatut->getDtFin() < $dtFin) {
                                    $periodeActiviteStatut->setDtFin($dtFin);
                                }

                            }
                            else {
                                // Si doublon statut/grade pas encore ajouté => on l ajoute
                                $periodeActiviteStatut = new PeriodeActiviteStatutFiliereCategorie();

                                $periodeActiviteStatut->setIdStat($idStatut);
                                $periodeActiviteStatut->setRefStatut($statut);
                                $periodeActiviteStatut->setIdFili($idFili);
                                $periodeActiviteStatut->setRefFiliere($refFiliere);
                                $periodeActiviteStatut->setIdCate($idCate);
                                $periodeActiviteStatut->setRefCategorie($refCategorie);

                                $periodeActiviteStatut->setMontantRemunerationAnnuelleBrute(0);
                                if($periode->getBaseFiscale()!=null && $periode->getBaseFiscale() != "") {
                                    $periodeActiviteStatut->setMontantRemunerationAnnuelleBrute(floatval($periode->getBaseFiscale()));
                                }

                                $periodeActiviteStatut->setMontantPrime(0);
                                if($periode->getPrimeIndemnite()!=null && $periode->getPrimeIndemnite() != "") {
                                    $periodeActiviteStatut->setMontantPrime(floatval($periode->getPrimeIndemnite()));
                                }

                                $periodeActiviteStatut->setMontantHcHs(0);
                                if($periode->getPrimeIndemnite601()!=null && $periode->getPrimeIndemnite601() != "") {
                                    $periodeActiviteStatut->setMontantHcHs(floatval($periode->getPrimeIndemnite601()));
                                }

                                $periodeActiviteStatut->setMontantSft(0);
                                if($periode->getPrimeIndemnite102()!=null && $periode->getPrimeIndemnite102() != "") {
                                    $periodeActiviteStatut->setMontantSft(floatval($periode->getPrimeIndemnite102()));
                                }

                                $periodeActiviteStatut->setMontantIr(0);
                                if($periode->getPrimeIndemnite101()!=null && $periode->getPrimeIndemnite101() != "") {
                                    $periodeActiviteStatut->setMontantIr(floatval($periode->getPrimeIndemnite101()));
                                }

                                $periodeActiviteStatut->setMontantNbi(0);
                                if($periode->getCodeNatureCotisation()== "20") {
                                    if($periode->getMontantRetenues()!=null && $periode->getMontantRetenues() != "") {
                                        $periodeActiviteStatut->setMontantNbi(floatval($periode->getMontantRetenues()));
                                    }
                                }

                                $periodeActiviteStatut->setDtDebut(\DateTime::createFromFormat('dmY', $periode->getDtDebut()));
                                $periodeActiviteStatut->setDtFin(\DateTime::createFromFormat('dmY', $periode->getDtFin()));


                                $q111 = false;
                                // Q11.1  Code modalité d'exercice du travail  <>90 OU <>'50<>23<>25<>27<>29<>31<>33  Alors oui sinon Non
                                // champ bl_tempcomp
                                if($periode->getCdModaliteExerTrav() != "90" && $periode->getCdModaliteExerTrav() != "50" && $periode->getCdModaliteExerTrav() != "23" && $periode->getCdModaliteExerTrav() != "25"
                                    && $periode->getCdModaliteExerTrav() != "27" && $periode->getCdModaliteExerTrav() != "29" && $periode->getCdModaliteExerTrav() != "31"&& $periode->getCdModaliteExerTrav() != "33") {
                                    $q111 = true;
                                }
                                $periodeActiviteStatut->setBlTempComp($q111);

                                $periodeActiviteStatutFiliereCategorieArray[$key2] = $periodeActiviteStatut;

                            }
                        }
                    }
                }

                // Q29.X : Agent contr non perm
                foreach ($periodeActiviteStatutEmploiNonPermanentArray as $key3 => $periodeActiviteStatutEmploiNonPermanent) {
                    $remunerationAgent = new RemunerationAgent();
                    $remunerationAgent->setRefStatut($periodeActiviteStatutEmploiNonPermanent->getRefStatut());
                    $remunerationAgent->setRefEmploiNonPermanent($periodeActiviteStatutEmploiNonPermanent->getRefEmploiNonPermanent());
                    $remunerationAgent->setBilanSocialAgent($bilanSocialAgent);
                    $remunerationAgent->setCreatedAt($now);
                    $remunerationAgent->setCdUtilcrea($user->getUsername());
                    $remunerationAgent->setDateIn($periodeActiviteStatutEmploiNonPermanent->getDtDebut()->format('m/Y'));
                    $remunerationAgent->setDateOut($periodeActiviteStatutEmploiNonPermanent->getDtFin()->format('m/Y'));
                    $remunerationAgent->setMtTotalRemunerationBrute($periodeActiviteStatutEmploiNonPermanent->getMontantRemunerationAnnuelleBrute());
                    $bilanSocialAgent->addRemunerationAgent($remunerationAgent);
                }
                foreach ($periodeActiviteStatutFiliereCategorieArray as $key4 => $periodeActiviteStatutFiliereCategorie) {
                    $remunerationAgent = new RemunerationAgent();
                    $remunerationAgent->setRefStatut($periodeActiviteStatutFiliereCategorie->getRefStatut());
                    $remunerationAgent->setRefFiliere($periodeActiviteStatutFiliereCategorie->getRefFiliere());
                    $remunerationAgent->setRefCategorie($periodeActiviteStatutFiliereCategorie->getRefCategorie());
                    $remunerationAgent->setBilanSocialAgent($bilanSocialAgent);
                    $remunerationAgent->setCreatedAt($now);
                    $remunerationAgent->setCdUtilcrea($user->getUsername());
                    $remunerationAgent->setDateIn($periodeActiviteStatutFiliereCategorie->getDtDebut()->format('m/Y'));
                    $remunerationAgent->setDateOut($periodeActiviteStatutFiliereCategorie->getDtFin()->format('m/Y'));
                    $remunerationAgent->setBlTempcomp($periodeActiviteStatutFiliereCategorie->getBlTempcomp());
                    $remunerationAgent->setMtTotalRemunerationBrute($periodeActiviteStatutFiliereCategorie->getMontantRemunerationAnnuelleBrute());
                    $remunerationAgent->setMtPrime($periodeActiviteStatutFiliereCategorie->getMontantPrime());
                    $remunerationAgent->setMtHcHs($periodeActiviteStatutFiliereCategorie->getMontantHcHs());

                    if ($periodeActiviteStatutFiliereCategorie->getRefStatut()->getCdStat() != 'CONTPERM') {
                        $remunerationAgent->setMtNBI($periodeActiviteStatutFiliereCategorie->getMontantNbi());
                        $remunerationAgent->setMtSFT($periodeActiviteStatutFiliereCategorie->getMontantSft());
                        $remunerationAgent->setMtIR($periodeActiviteStatutFiliereCategorie->getMontantIr());
                    }
                    $bilanSocialAgent->addRemunerationAgent($remunerationAgent);
                }

                    /*
                    // Q30.1  Q30.2
                    $periodeActiviteStatutCadreEmploiFiliere = null;
                    foreach ($periodeActiviteList as $periode) {
                        $idStatut = null;
                        $statut = $em->getRepository('ReferencielBundle:RefStatut')->findOneByInCdN4ds($periode->getCdStatut());
                        if($statut != null) {
                            $idStatut = $statut->getIdStat();
                        }
                        else {
                            continue;
                        }

                        $gradeExist = false;
                        $idFili = null;
                        $refFiliere = null;
                        $idCadrempl = null;
                        $cdCadrempl = "";
                        $refCadreEmploi = null;

                        $cdGrade = $periode->getCdGrad();
                        $grade = $em->getRepository('ReferencielBundle:RefGrade')->findOneByInCdN4ds($periode->getCdGrad());
                        if($grade != null) {
                            $gradeExist = true;
                            $idCadrempl = $grade->getRefCadreEmploi()->getIdCadrempl();
                            $cdCadrempl = $grade->getRefCadreEmploi()->getCdCadrempl();
                            $refCadreEmploi = $grade->getRefCadreEmploi();
                            $idFili = $grade->getRefCadreEmploi()->getRefFiliere()->getIdFili();

                            $refFiliere = $grade->getRefCadreEmploi()->getRefFiliere();
                        }

                        if($gradeExist) {
                            // Si le statut et le grade existe
                            $key = $periode->getCdStatut() . "-" . $cdCadrempl;

                            if (array_key_exists($key, $periodeActiviteStatutCadreEmploiFiliereArray)) {
                                // Si doublon statut/ce deja ajoute => on le recupere et on ajoute le nb heure
                                $periodeActiviteStatutFiliere = $periodeActiviteStatutCadreEmploiFiliereArray[$key];

                                $heureTotal = 0;

                                if($periode->getTotalHeuresPayees()!=null && $periode->getTotalHeuresPayees() != "") {
                                    $heureTotal = floatval($periode->getTotalHeuresPayees());
                                }

                                $heureSansSupp = 0;
                                if($periode->getNbHeurPayeSansSuppl()!=null && $periode->getNbHeurPayeSansSuppl() != "") {
                                    $heureSansSupp = floatval($periode->getNbHeurPayeSansSuppl());
                                }
                                $heure = $heureTotal - $heureSansSupp;

                                $heureCurr = $periodeActiviteStatutFiliere->getHeuresSuppComp();
                                $heureCurr = $heureCurr + $heure;
                                $periodeActiviteStatutFiliere->setHeuresSuppComp($heureCurr);
                            }
                            else {
                                // Si doublon statut/grade pas encore ajouté => on l ajoute
                                $periodeActiviteStatutFiliere = new PeriodeActiviteStatutCadreEmploiFiliere();
                                $periodeActiviteStatutFiliere->setIdStat($idStatut);
                                $periodeActiviteStatutFiliere->setRefStatut($statut);
                                $periodeActiviteStatutFiliere->setIdFili($idFili);
                                $periodeActiviteStatutFiliere->setRefFiliere($refFiliere);
                                $periodeActiviteStatutFiliere->setIdCadrempl($idCadrempl);
                                $periodeActiviteStatutFiliere->setRefCadreEmploi($refCadreEmploi);

                                $heureTotal = 0;
                                if($periode->getTotalHeuresPayees()!=null && $periode->getTotalHeuresPayees() != "") {
                                    $heureTotal = floatval($periode->getTotalHeuresPayees());
                                }
                                $heureSansSupp = 0;
                                if($periode->getNbHeurPayeSansSuppl()!=null && $periode->getNbHeurPayeSansSuppl() != "") {
                                    $heureSansSupp = floatval($periode->getNbHeurPayeSansSuppl());
                                }

                                $heure = $heureTotal - $heureSansSupp;
                                $periodeActiviteStatutFiliere->setHeuresSuppComp($heure);
                                $periodeActiviteStatutCadreEmploiFiliereArray[$key] = $periodeActiviteStatutFiliere;
                            }
                        }
                    }

                    foreach ($periodeActiviteStatutCadreEmploiFiliereArray as $key => $periodeActiviteStatutFiliere3) {
                        //error_log('$key ' . $key,0 );
                        //error_log('$periodeActiviteStatutFiliere3->getHeuresSuppComp() ' . json_encode($periodeActiviteStatutFiliere3->getHeuresSuppComp()),0 );

                        $bilanQ30Alerte = new BilanQ30Alerte();
                        $bilanQ30Alerte->setRefStatut($periodeActiviteStatutFiliere3->getRefStatut());
                        $bilanQ30Alerte->setRefCadreEmploi($periodeActiviteStatutFiliere3->getRefCadreEmploi());
                        $bilanQ30Alerte->setRefFiliere($periodeActiviteStatutFiliere3->getRefFiliere());
                        $bilanQ30Alerte->setNbHeure($periodeActiviteStatutFiliere3->getHeuresSuppComp());
                        $bilanQ30Alerte->setBilanSocialAgent($bilanSocialAgent);
                        $bilanQ30Alerte->setCreatedAt($now);
                        $bilanQ30Alerte->setCdUtilcrea($user->getUsername());
                        $bilanSocialAgent->addBilanQ30Alerte($bilanQ30Alerte);
                    }
                    */

                // GPEEC
                $lbProfessionCategSocio = CategSocioProfN4dsEnum::getCategSocioProfN4dsShortLibelle($cdProfessionCategSocio);
                $bilanSocialAgent->setCdProfessionCategSocio($lbProfessionCategSocio);

                //var_dump($bilanSocialAgent);

                //error_log("Before Persist " . $nom . "  " . $prenom, 0);
                $bilanSocialAgent->setFgStat(0);
                $bilanSocialAgent->setCollectivite($collectivite);
                $bilanSocialAgent->setEnquete($enquete);
                $bilanSocialAgent->setCreatedAt($now);
                $bilanSocialAgent->setIdInfocollagen($info->getIdInfocollagen());
                $em->persist($bilanSocialAgent);

                $nbAjout++;
                //error_log("After Flush " . $nom . "  " . $prenom, 0);

            }// end foreach agent

            error_log("Nombre d'agents ajoutés = " . json_encode($nbAjout), 0);
            error_log("Nombre d'agents non ajoutés via Q42 = " . json_encode($nbRetraitViaQ42), 0);
            error_log("Fin du traitement des agents ", 0);

            // Creation un seul enregistrement dans import
            $newImport = new Import();
            $newImport->setCollectivite($collectivite);
            $newImport->setEnquete($enquete);
            $newImport->setDtImpo($now);
            $newImport->setDtCrea($now);
            $newImport->setFgTypeimpo(0); // type n4ds

            if($fichierN) {
                $newImport->setNmAnnee($anneeCampagneCourante);
            }
            else if($fichierNMoins1) {
                $newImport->setNmAnnee($anneeCampagneCouranteMoins1);
            }
            $newImport->setCdUtilcrea($user->getUsername());
            $em->persist($newImport);
            $em->flush();
            $em->getConnection()->commit();

            error_log("Fin du traitement ", 0);

        } catch (\Error $e) {
            $em->getConnection()->rollBack();
            error_log("Error Error ". $e->getMessage(), 0);
            error_log("Error " . $e->getTraceAsString(), 0);

            $response = new JsonResponse();
            
            $response->setContent(json_encode(array('message' => 'Une erreur est survenue, si le problème persiste veuillez contacter votre administrateur.' .$e->getTraceAsString() )));
            return $response;

        }

        $resInit = $em->getRepository('BilanSocialBundle:InitBilanSocial')->findOneBy(array('collectivite' => $idColl, 'enquete' => $enquete->getIdEnqu()));

        $typeBs = $resInit->getBlApa();

        $bsAnneeN = true;
        $saveOldData = true;
        if($fichierNMoins1){
            $bsAnneeN = false;
            $saveOldData = false;
        }
        
        $response = new JsonResponse();

        $response->setContent(json_encode(array('message' => "Import N4DS réussi", 'bsAnneeN' => $bsAnneeN, 'typeBs' => $typeBs, 'saveOldData' => $saveOldData)));
        return $response;

        //return $this->render('@Import/Import/index.html.twig', array());
    }

    public function savedOldDataAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $maCollectivite = $this->getMaCollectivite();
        $collGenealogy = $em->getRepository('CollectiviteBundle:HistoriqueCollectivite')->getGenealogy($maCollectivite->getNmSire());
        $action = $request->get('action');
        $idColls = array();
        foreach ($collGenealogy as $key => $geaColl) {
            $temp_id_coll = $geaColl->getIdColl();
            if(!is_null($temp_id_coll)) array_push($idColls, $temp_id_coll);
        }
        if ($action == 'modal-apa-get-old-saved-data-btn-confirm') {
            $oldDataAgents = $em->getRepository('ApaBundle:SauvegardeDonneesAgents')->findByIdCollectivite($idColls);
            if ($oldDataAgents) {
                foreach ($oldDataAgents as $oldAgent) {
                    // On vérifie si un agent de l'import N4DS match avec un agent sauvegardé lors de la fermeture de la précédente campagne
                    $agent = $em->getRepository('ApaBundle:BilanSocialAgent')->getOneByNameAndBirthday($maCollectivite->getIdColl(), $oldAgent->getLbNom(), $oldAgent->getLbPrenom(), $oldAgent->getDateNaissance());
                    if ($agent != null) {
                        if ($oldAgent != null) {

                            // Handitorial
                            $idMesureInaptitudeEnCoursAnnee = 'NULL';
                            $idMesureInaptitudeAvantAnnee = 'NULL';
                            $idInaptitudeEnCoursAnnee = 'NULL';
                            $idInaptitudeAvantAnnee = 'NULL';
                            $idNatureHandicapBoeth = 'NULL';
                            $idCategorieBoeth = 'NULL';
                            $blAvisInaptitudeEnCours = 'NULL';
                            $blAvisInaptitudeAvant = 'NULL';
                            if ($oldAgent->getIdMesureInaptitudeEnCoursAnnee() != null) {
                                $idMesureInaptitudeEnCoursAnnee = $oldAgent->getIdMesureInaptitudeEnCoursAnnee()->getIdMesureboeth();
                            }
                            if ($oldAgent->getIdMesureInaptitudeAvantAnnee() != null) {
                                $idMesureInaptitudeAvantAnnee = $oldAgent->getIdMesureInaptitudeAvantAnnee()->getIdMesureboeth();
                            }
                            if ($oldAgent->getIdInaptitudeEnCoursAnnee() != null) {
                                $idInaptitudeEnCoursAnnee = $oldAgent->getIdInaptitudeEnCoursAnnee()->getIdInaptitudeboeth();
                            }
                            if ($oldAgent->getIdInaptitudeAvantAnnee() != null) {
                                $idInaptitudeAvantAnnee = $oldAgent->getIdInaptitudeAvantAnnee()->getIdInaptitudeboeth();
                            }
                            if ($oldAgent->getIdNatureHandicapBoeth() != null) {
                                $idNatureHandicapBoeth = $oldAgent->getIdNatureHandicapBoeth()->getIdNathandiboeth();
                            }
                            if ($oldAgent->getIdCategorieBoeth() != null) {
                                $idCategorieBoeth = $oldAgent->getIdCategorieBoeth()->getIdCategorieboeth();
                            }
                            if ($oldAgent->getBlAvisInaptitudeEnCours() != null) {
                                $blAvisInaptitudeEnCours = $oldAgent->getBlAvisInaptitudeEnCours();
                            }
                            if ($oldAgent->getBlAvisInaptitudeAvant() != null) {
                                $blAvisInaptitudeAvant = $oldAgent->getBlAvisInaptitudeAvant();
                            }

                            $query = 'INSERT INTO Bilan_Social_Agent_Handitorial 
                                (id_mesure_inaptitude_encours_annne, id_mesure_inaptitude_avant_annne, id_inaptitude_encours_annne, id_inaptitude_avant_annne, 
                                id_nature_handicap_boeth, id_categorie_boeth, bl_avis_inaptitude_en_cours, 
                                bl_avis_inaptitude_avant, ID_BILASOCIAGEN)
                                VALUES(' . $idMesureInaptitudeEnCoursAnnee . ',' . $idMesureInaptitudeAvantAnnee . ',' . $idInaptitudeEnCoursAnnee .
                                    ',' . $idInaptitudeAvantAnnee . ',' . $idNatureHandicapBoeth . ',' . $idCategorieBoeth .
                                    ',' . $blAvisInaptitudeEnCours . ',' . $blAvisInaptitudeAvant . ',' . $agent->getIdBilasociagen() . ')';

                            $statement = $em->getConnection()->prepare($query);
                            $statement->execute();

                            if ($oldAgent->getBlBoeth() == true) {
                                $query = 'UPDATE bilan_social_agent SET BL_BOETH = 1 WHERE id_bilasociagen = ' . $agent->getIdBilasociagen();
                                $statement = $em->getConnection()->prepare($query);
                                $statement->execute();
                            }
                            else {
                                $query = 'UPDATE bilan_social_agent SET BL_BOETH = 0 WHERE id_bilasociagen = ' . $agent->getIdBilasociagen();
                                $statement = $em->getConnection()->prepare($query);
                                $statement->execute();
                            }

                            // Gpeec
                            $idMetier = 'NULL';
                            $idDomaineDiplomeGpeec = 'NULL';

                            if ($oldAgent->getIdMetier() != null) {
                                $idMetier = $oldAgent->getIdMetier()->getIdMetier();
                            }
                            if ($oldAgent->getIdDomaineDiplomeGpeec() != null) {
                                $idDomaineDiplomeGpeec = $oldAgent->getIdDomaineDiplomeGpeec()->getIdDomaineDiplome();
                            }

                            $query = 'INSERT INTO bilan_social_agent_gpeec (ID_METIER, ID_DOMAINE_DIPLOME_GPEEC, ID_BILASOCIAGEN) VALUES(' . $idMetier . ',' . $idDomaineDiplomeGpeec . ',' . $agent->getIdBilasociagen() . ')';
                            $statement = $em->getConnection()->prepare($query);
                            $statement->execute();

                            // Gpeec Plus
                            $idSpecialite = 'NULL';

                            if ($oldAgent->getIdSpecialite() != null) {
                                $idSpecialite = $oldAgent->getIdSpecialite()->getIdSpecialite();
                            }

                            $query = 'INSERT INTO bilan_social_agent_gpeec_plus (ID_SPECIALITE, ID_BILASOCIAGEN) VALUES(' . $idSpecialite . ',' . $agent->getIdBilasociagen() . ')';
                            $statement = $em->getConnection()->prepare($query);
                            $statement->execute();
                        }
                    }
                }
            }
        }

        $response = new JsonResponse();
        $response->setContent('success');

        return $response;
    }

    public function GetWhiteListAction(Request $request) {
        //$json = $request->getContent();
        //$jsonObj = json_decode($json);
        //$jsonArray = $jsonObj->{'lines'};

        $em = $this->getDoctrine()->getManager();
        $n4dss = $em->getRepository('ReferencielBundle:RefN4ds')->findAll();
        $this->saveAndUnlockSession($request);
        $n4dsList = '{"items" :{';

        foreach ($n4dss as $n4ds) {
            $n4dsList = $n4dsList . '"' . $n4ds->getCdValeur() . '" : true, ' ;
        }

        $n4dsList = substr($n4dsList, 0, -2);
        $n4dsList = $n4dsList . '}}';

        $response = new JsonResponse();
        $response->setContent($n4dsList);
        return $response;
    }
}

class PeriodeActivite {
    private $dtDebut;
    private $dtFin;
    private $cdStatut;
    private $cdGrad;
    private $cdMotifDebut;

    private $baseFiscale;
    private $primeIndemnite;
    private $montantRetenues;
    private $primeIndemnite601;
    private $primeIndemnite102;
    private $primeIndemnite101;

    private $totalHeuresPayees;
    private $nbHeurPayeSansSuppl;

    private $codeNatureCotisation;
    private $cdFoncpubl;
    private $cdStatjuri08;
    private $cdIntiContTrav;
    private $cdModaliteExerTrav;

    /**
     * @return mixed
     */
    public function getDtDebut()
    {
        return $this->dtDebut;
    }

    /**
     * @param mixed $dtDebut
     */
    public function setDtDebut($dtDebut)
    {
        $this->dtDebut = $dtDebut;
    }

    /**
     * @return mixed
     */
    public function getDtFin()
    {
        return $this->dtFin;
    }

    /**
     * @param mixed $dtFin
     */
    public function setDtFin($dtFin)
    {
        $this->dtFin = $dtFin;
    }

    /**
     * @return mixed
     */
    public function getCdStatut()
    {
        return $this->cdStatut;
    }

    /**
     * @param mixed $cdStatut
     */
    public function setCdStatut($cdStatut)
    {
        $this->cdStatut = $cdStatut;
    }

    /**
     * @return mixed
     */
    public function getCdGrad()
    {
        return $this->cdGrad;
    }

    /**
     * @param mixed $cdGrad
     */
    public function setCdGrad($cdGrad)
    {
        $this->cdGrad = $cdGrad;
    }

    /**
     * @return mixed
     */
    public function getCdMotifDebut()
    {
        return $this->cdMotifDebut;
    }

    /**
     * @param mixed $cdMotifDebut
     */
    public function setCdMotifDebut($cdMotifDebut)
    {
        $this->cdMotifDebut = $cdMotifDebut;
    }

    /**
     * @return mixed
     */
    public function getBaseFiscale()
    {
        return $this->baseFiscale;
    }

    /**
     * @param mixed $baseFiscale
     */
    public function setBaseFiscale($baseFiscale)
    {
        $this->baseFiscale = $baseFiscale;
    }

    /**
     * @return mixed
     */
    public function getPrimeIndemnite()
    {
        return $this->primeIndemnite;
    }

    /**
     * @param mixed $primeIndemnite
     */
    public function setPrimeIndemnite($primeIndemnite)
    {
        $this->primeIndemnite = $primeIndemnite;
    }

    /**
     * @return mixed
     */
    public function getPrimeIndemnite601()
    {
        return $this->primeIndemnite601;
    }

    /**
     * @param mixed $primeIndemnite601
     */
    public function setPrimeIndemnite601($primeIndemnite601)
    {
        $this->primeIndemnite601 = $primeIndemnite601;
    }

    /**
     * @return mixed
     */
    public function getPrimeIndemnite102()
    {
        return $this->primeIndemnite102;
    }

    /**
     * @param mixed $primeIndemnite102
     */
    public function setPrimeIndemnite102($primeIndemnite102)
    {
        $this->primeIndemnite102 = $primeIndemnite102;
    }

    /**
     * @return mixed
     */
    public function getPrimeIndemnite101()
    {
        return $this->primeIndemnite101;
    }

    /**
     * @param mixed $primeIndemnite101
     */
    public function setPrimeIndemnite101($primeIndemnite101)
    {
        $this->primeIndemnite101 = $primeIndemnite101;
    }

    /**
     * @return mixed
     */
    public function getCodeNatureCotisation()
    {
        return $this->codeNatureCotisation;
    }

    /**
     * @param mixed $codeNatureCotisation
     */
    public function setCodeNatureCotisation($codeNatureCotisation)
    {
        $this->codeNatureCotisation = $codeNatureCotisation;
    }

    /**
     * @return mixed
     */
    public function getCdFoncpubl()
    {
        return $this->cdFoncpubl;
    }

    /**
     * @param mixed $cdFoncpubl
     */
    public function setCdFoncpubl($cdFoncpubl)
    {
        $this->cdFoncpubl = $cdFoncpubl;
    }

    /**
     * @return mixed
     */
    public function getCdStatjuri08()
    {
        return $this->cdStatjuri08;
    }

    /**
     * @param mixed $cdStatjuri08
     */
    public function setCdStatjuri08($cdStatjuri08)
    {
        $this->cdStatjuri08 = $cdStatjuri08;
    }

    /**
     * @return mixed
     */
    public function getCdIntiContTrav()
    {
        return $this->cdIntiContTrav;
    }

    /**
     * @param mixed $cdIntiContTrav
     */
    public function setCdIntiContTrav($cdIntiContTrav)
    {
        $this->cdIntiContTrav = $cdIntiContTrav;
    }

    /**
     * @return mixed
     */
    public function getMontantRetenues()
    {
        return $this->montantRetenues;
    }

    /**
     * @param mixed $montantRetenues
     */
    public function setMontantRetenues($montantRetenues)
    {
        $this->montantRetenues = $montantRetenues;
    }

    /**
     * @return mixed
     */
    public function getCdModaliteExerTrav()
    {
        return $this->cdModaliteExerTrav;
    }

    /**
     * @param mixed $cdModaliteExerTrav
     */
    public function setCdModaliteExerTrav($cdModaliteExerTrav)
    {
        $this->cdModaliteExerTrav = $cdModaliteExerTrav;
    }

    /**
     * @return mixed
     */
    public function getTotalHeuresPayees()
    {
        return $this->totalHeuresPayees;
    }

    /**
     * @param mixed $totalHeuresPayees
     */
    public function setTotalHeuresPayees($totalHeuresPayees)
    {
        $this->totalHeuresPayees = $totalHeuresPayees;
    }

    /**
     * @return mixed
     */
    public function getNbHeurPayeSansSuppl()
    {
        return $this->nbHeurPayeSansSuppl;
    }

    /**
     * @param mixed $nbHeurPayeSansSuppl
     */
    public function setNbHeurPayeSansSuppl($nbHeurPayeSansSuppl)
    {
        $this->nbHeurPayeSansSuppl = $nbHeurPayeSansSuppl;
    }

}


class PeriodeInactivite {
    private $dtDebut;
    private $dtFin;
    private $cdInactivite;
    private $nbJourOuvre;
    private $nbMontantCarence;
    function getDtDebut() {
        return $this->dtDebut;
    }

    function getDtFin() {
        return $this->dtFin;
    }



    function getNbJourOuvre() {
        return $this->nbJourOuvre;
    }

    function setDtDebut($dtDebut) {
        $this->dtDebut = $dtDebut;
    }

    function setDtFin($dtFin) {
        $this->dtFin = $dtFin;
    }



    function setNbJourOuvre($nbJourOuvre) {
        $this->nbJourOuvre = $nbJourOuvre;
    }

    function getCdInactivite() {
        return $this->cdInactivite;
    }

    function setCdInactivite($cdInactivite) {
        $this->cdInactivite = $cdInactivite;
    }

    function getNbMontantCarence() {
        return $this->nbMontantCarence;
    }

    function setNbMontantCarence($nbMontantCarence) {
        $this->nbMontantCarence = $nbMontantCarence;
    }


}


// Class pour Titulaire et Emploi permanent
class PeriodeActiviteStatutFiliereCategorie
{
    private $dtDebut;
    private $dtFin;
    private $idStat;
    private $idFili;
    private $idCate;
    private $blTempComp;

    private $montantRemunerationAnnuelleBrute;
    private $montantPrime;
    private $montantNbi;
    private $montantHcHs;
    private $montantSft;
    private $montantIr;

    private $refFiliere;
    private $refStatut;
    private $refCategorie;

    /**
     * @return mixed
     */
    public function getDtDebut()
    {
        return $this->dtDebut;
    }

    /**
     * @param mixed $dtDebut
     */
    public function setDtDebut($dtDebut)
    {
        $this->dtDebut = $dtDebut;
    }

    /**
     * @return mixed
     */
    public function getDtFin()
    {
        return $this->dtFin;
    }

    /**
     * @param mixed $dtFin
     */
    public function setDtFin($dtFin)
    {
        $this->dtFin = $dtFin;
    }

    /**
     * @return mixed
     */
    public function getIdStat()
    {
        return $this->idStat;
    }

    /**
     * @param mixed $idStat
     */
    public function setIdStat($idStat)
    {
        $this->idStat = $idStat;
    }

    /**
     * @return mixed
     */
    public function getIdFili()
    {
        return $this->idFili;
    }

    /**
     * @param mixed $idFili
     */
    public function setIdFili($idFili)
    {
        $this->idFili = $idFili;
    }

    /**
     * @return mixed
     */
    public function getIdCate()
    {
        return $this->idCate;
    }

    /**
     * @param mixed $idCate
     */
    public function setIdCate($idCate)
    {
        $this->idCate = $idCate;
    }

    /**
     * @return mixed
     */
    public function getBlTempComp()
    {
        return $this->blTempComp;
    }

    /**
     * @param mixed $blTempComp
     */
    public function setBlTempComp($blTempComp)
    {
        $this->blTempComp = $blTempComp;
    }

    /**
     * @return mixed
     */
    public function getMontantRemunerationAnnuelleBrute()
    {
        return $this->montantRemunerationAnnuelleBrute;
    }

    /**
     * @param mixed $montantRemunerationAnnuelleBrute
     */
    public function setMontantRemunerationAnnuelleBrute($montantRemunerationAnnuelleBrute)
    {
        $this->montantRemunerationAnnuelleBrute = $montantRemunerationAnnuelleBrute;
    }

    /**
     * @return mixed
     */
    public function getMontantPrime()
    {
        return $this->montantPrime;
    }

    /**
     * @param mixed $montantPrime
     */
    public function setMontantPrime($montantPrime)
    {
        $this->montantPrime = $montantPrime;
    }

    /**
     * @return mixed
     */
    public function getMontantNbi()
    {
        return $this->montantNbi;
    }

    /**
     * @param mixed $montantNbi
     */
    public function setMontantNbi($montantNbi)
    {
        $this->montantNbi = $montantNbi;
    }

    /**
     * @return mixed
     */
    public function getMontantHcHs()
    {
        return $this->montantHcHs;
    }

    /**
     * @param mixed $montantHcHs
     */
    public function setMontantHcHs($montantHcHs)
    {
        $this->montantHcHs = $montantHcHs;
    }

    /**
     * @return mixed
     */
    public function getMontantSft()
    {
        return $this->montantSft;
    }

    /**
     * @param mixed $montantSft
     */
    public function setMontantSft($montantSft)
    {
        $this->montantSft = $montantSft;
    }

    /**
     * @return mixed
     */
    public function getMontantIr()
    {
        return $this->montantIr;
    }

    /**
     * @param mixed $montantIr
     */
    public function setMontantIr($montantIr)
    {
        $this->montantIr = $montantIr;
    }

    /**
     * @return mixed
     */
    public function getRefFiliere()
    {
        return $this->refFiliere;
    }

    /**
     * @param mixed $refFiliere
     */
    public function setRefFiliere($refFiliere)
    {
        $this->refFiliere = $refFiliere;
    }

    /**
     * @return mixed
     */
    public function getRefStatut()
    {
        return $this->refStatut;
    }

    /**
     * @param mixed $refStatut
     */
    public function setRefStatut($refStatut)
    {
        $this->refStatut = $refStatut;
    }

    /**
     * @return mixed
     */
    public function getRefCategorie()
    {
        return $this->refCategorie;
    }

    /**
     * @param mixed $refCategorie
     */
    public function setRefCategorie($refCategorie)
    {
        $this->refCategorie = $refCategorie;
    }



}


// Class pour Emploi non permanent
class PeriodeActiviteStatutEmploiNonPermanent
{
    private $dtDebut;
    private $dtFin;
    private $idStat;
    private $idEmploiNonPermanent;

    private $montantRemunerationAnnuelleBrute;

    private $refStatut;
    private $refEmploiNonPermanent;

    /**
     * @return mixed
     */
    public function getDtDebut()
    {
        return $this->dtDebut;
    }

    /**
     * @param mixed $dtDebut
     */
    public function setDtDebut($dtDebut)
    {
        $this->dtDebut = $dtDebut;
    }

    /**
     * @return mixed
     */
    public function getDtFin()
    {
        return $this->dtFin;
    }

    /**
     * @param mixed $dtFin
     */
    public function setDtFin($dtFin)
    {
        $this->dtFin = $dtFin;
    }

    /**
     * @return mixed
     */
    public function getIdStat()
    {
        return $this->idStat;
    }

    /**
     * @param mixed $idStat
     */
    public function setIdStat($idStat)
    {
        $this->idStat = $idStat;
    }

    /**
     * @return mixed
     */
    public function getIdEmploiNonPermanent()
    {
        return $this->idEmploiNonPermanent;
    }

    /**
     * @param mixed $idEmploiNonPermanent
     */
    public function setIdEmploiNonPermanent($idEmploiNonPermanent)
    {
        $this->idEmploiNonPermanent = $idEmploiNonPermanent;
    }

    /**
     * @return mixed
     */
    public function getMontantRemunerationAnnuelleBrute()
    {
        return $this->montantRemunerationAnnuelleBrute;
    }

    /**
     * @param mixed $montantRemunerationAnnuelleBrute
     */
    public function setMontantRemunerationAnnuelleBrute($montantRemunerationAnnuelleBrute)
    {
        $this->montantRemunerationAnnuelleBrute = $montantRemunerationAnnuelleBrute;
    }

    /**
     * @return mixed
     */
    public function getRefStatut()
    {
        return $this->refStatut;
    }

    /**
     * @param mixed $refStatut
     */
    public function setRefStatut($refStatut)
    {
        $this->refStatut = $refStatut;
    }

    /**
     * @return mixed
     */
    public function getRefEmploiNonPermanent()
    {
        return $this->refEmploiNonPermanent;
    }

    /**
     * @param mixed $refEmploiNonPermanent
     */
    public function setRefEmploiNonPermanent($refEmploiNonPermanent)
    {
        $this->refEmploiNonPermanent = $refEmploiNonPermanent;
    }

}


// TODO : BilanQ30Alerte
class PeriodeActiviteStatutCadreEmploiFiliere {
    private $idStat;
    private $idCadrempl;
    private $idFili;
    private $refFiliere;
    private $refCadreEmploi;
    private $refStatut;
    private $heuresSuppComp;

    function getIdStat() {
        return $this->idStat;
    }

    function getIdCadrempl() {
        return $this->idCadrempl;
    }

    function getIdFili() {
        return $this->idFili;
    }

    function getRefFiliere() {
        return $this->refFiliere;
    }

    function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    function getRefStatut() {
        return $this->refStatut;
    }

    function getHeuresSuppComp() {
        return $this->heuresSuppComp;
    }

    function setIdStat($idStat) {
        $this->idStat = $idStat;
    }

    function setIdCadrempl($idCadrempl) {
        $this->idCadrempl = $idCadrempl;
    }

    function setIdFili($idFili) {
        $this->idFili = $idFili;
    }

    function setRefFiliere($refFiliere) {
        $this->refFiliere = $refFiliere;
    }

    function setRefCadreEmploi($refCadreEmploi) {
        $this->refCadreEmploi = $refCadreEmploi;
    }

    function setRefStatut($refStatut) {
        $this->refStatut = $refStatut;
    }

    function setHeuresSuppComp($heuresSuppComp) {
        $this->heuresSuppComp = $heuresSuppComp;
    }




}


class Agent {
    private $nom = null;
    private $prenom = null;
    private $nomUsage = null;
    private $civilite = null;
    private $dtNaissance = null;
    private $dtDebutPeriodeActivite = null;
    private $dtDebutPeriodeActivite1ere = null;
    private $dtDebutPeriodeActiviteDerniere = null;
    private $cdMotifDebutPeriodeActivite = null;
    private $cdMotifDebutPeriodeActivite1ere = null;
    private $dtFinPeriodeActivite = null;
    private $dtFinPeriodeActiviteDerniere = null;
    private $cdMotifFinPeriodeActivite = null;
    private $cdMotifFinPeriodeActiviteDerniere = null;
    private $totalHeuresPayees = null;
    private $totalHeuresPayeesDerniere = null;
    private $cdPosistat = null;
    private $cdPosistatDerniere = null;
    private $cdStatjuri = null;
    private $cdStatjuriDerniere = null;
    private $cdCategstat = null;
    private $cdFoncpubl = null;
    private $cdFoncpublDerniere = null;
    private $cdStatAppart = null;
    private $cdGradOrig = null;
    private $cdGrad1 = null;
    private $cdGrad2 = null;
    private $cdNatureContratTrav = null;
    private $cdModaliteExerTrav = null;
    private $cdModaliteExerTravDerniere = null;
    private $dureeHebdoDerniere = null;
    private $dureeHebdo = null;
    private $tauxTravTpsPartiel = null;
    private $tauxTravTpsPartielDerniere = null;
    private $cdIntiContTrav = null;
    private $cdIntiContTravDerniere = null;
    private $cdStatjuri08 = null;
    private $cdStatjuri08Derniere = null;
    private $nbHeurPayeSansSuppl = null;
    private $baseFiscale = null;
    private $primeIndemnite = null;
    private $primeIndemnite601 = null;
    private $primeIndemnite101 = null;
    private $primeIndemnite102 = null;
    private $codeNatureCotisation = null;
    private $cdProfessionCategSocio = null;
    private $lbNatureEmploiN4ds = null;
    private $montantRetenues = null;
    private $montantCarence = null;
    private $periodeActiviteList = null;
    private $periodeActiviteMoinsDerniereList = null;
    private $periodeInactiviteList = null;


    function getSiret() {
        return $this->siret;
    }

    function getDtDebutRef() {
        return $this->dtDebutRef;
    }

    function getDtFinRef() {
        return $this->dtFinRef;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getCivilite() {
        return $this->civilite;
    }

    function getDtNaissance() {
        return $this->dtNaissance;
    }

    function getDtDebutPeriodeActivite() {
        return $this->dtDebutPeriodeActivite;
    }

    function getDtDebutPeriodeActivite1ere() {
        return $this->dtDebutPeriodeActivite1ere;
    }

    function getCdMotifDebutPeriodeActivite() {
        return $this->cdMotifDebutPeriodeActivite;
    }

    function getCdMotifDebutPeriodeActivite1ere() {
        return $this->cdMotifDebutPeriodeActivite1ere;
    }

    function getDtFinPeriodeActivite() {
        return $this->dtFinPeriodeActivite;
    }

    function getDtFinPeriodeActiviteDerniere() {
        return $this->dtFinPeriodeActiviteDerniere;
    }

    function getCdMotifFinPeriodeActivite() {
        return $this->cdMotifFinPeriodeActivite;
    }

    function getCdMotifFinPeriodeActiviteDerniere() {
        return $this->cdMotifFinPeriodeActiviteDerniere;
    }

    function getTotalHeuresPayees() {
        return $this->totalHeuresPayees;
    }

    function getTotalHeuresPayeesDerniere() {
        return $this->totalHeuresPayeesDerniere;
    }

    function getCdPosistat() {
        return $this->cdPosistat;
    }

    function getCdPosistatDerniere() {
        return $this->cdPosistatDerniere;
    }

    function getCdStatjuri() {
        return $this->cdStatjuri;
    }

    function getCdStatjuriDerniere() {
        return $this->cdStatjuriDerniere;
    }

    function getCdCategstat() {
        return $this->cdCategstat;
    }

    function getCdFoncpubl() {
        return $this->cdFoncpubl;
    }

    function getCdFoncpublDerniere() {
        return $this->cdFoncpublDerniere;
    }

    function getCdStatAppart() {
        return $this->cdStatAppart;
    }

    function getCdGradOrig() {
        return $this->cdGradOrig;
    }

    function getCdGrad1() {
        return $this->cdGrad1;
    }

    function getCdGrad2() {
        return $this->cdGrad2;
    }

    function getCdNatureContratTrav() {
        return $this->cdNatureContratTrav;
    }

    function getCdModaliteExerTrav() {
        return $this->cdModaliteExerTrav;
    }

    function getCdModaliteExerTravDerniere() {
        return $this->cdModaliteExerTravDerniere;
    }

    function getDureeHebdoDerniere() {
        return $this->dureeHebdoDerniere;
    }

    function getDureeHebdo() {
        return $this->dureeHebdo;
    }

    function getTauxTravTpsPartiel() {
        return $this->tauxTravTpsPartiel;
    }

    function getTauxTravTpsPartielDerniere() {
        return $this->tauxTravTpsPartielDerniere;
    }

    function getCdIntiContTrav() {
        return $this->cdIntiContTrav;
    }

    function getCdIntiContTravDerniere() {
        return $this->cdIntiContTravDerniere;
    }

    function getCdStatjuri08() {
        return $this->cdStatjuri08;
    }

    function getCdStatjuri08Derniere() {
        return $this->cdStatjuri08Derniere;
    }

    function getNbHeurPayeSansSuppl() {
        return $this->nbHeurPayeSansSuppl;
    }

    function getBaseFiscale() {
        return $this->baseFiscale;
    }

    function getPrimeIndemnite() {
        return $this->primeIndemnite;
    }

    function getCodeNatureCotisation() {
        return $this->codeNatureCotisation;
    }
    
    function getMontantRetenues() {
        return $this->montantRetenues;
    }

    function getMontantCarence() {
        return $this->montantCarence;
    }

    function getPeriodeActiviteList() {
        return $this->periodeActiviteList;
    }

    function getPeriodeActiviteMoinsDerniereList() {
        return $this->periodeActiviteMoinsDerniereList;
    }

    function setSiret($siret) {
        $this->siret = $siret;
    }

    function setDtDebutRef($dtDebutRef) {
        $this->dtDebutRef = $dtDebutRef;
    }

    function setDtFinRef($dtFinRef) {
        $this->dtFinRef = $dtFinRef;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setCivilite($civilite) {
        $this->civilite = $civilite;
    }

    function setDtNaissance($dtNaissance) {
        $this->dtNaissance = $dtNaissance;
    }

    function setDtDebutPeriodeActivite($dtDebutPeriodeActivite) {
        $this->dtDebutPeriodeActivite = $dtDebutPeriodeActivite;
    }

    function setDtDebutPeriodeActivite1ere($dtDebutPeriodeActivite1ere) {
        $this->dtDebutPeriodeActivite1ere = $dtDebutPeriodeActivite1ere;
    }

    function setCdMotifDebutPeriodeActivite($cdMotifDebutPeriodeActivite) {
        $this->cdMotifDebutPeriodeActivite = $cdMotifDebutPeriodeActivite;
    }

    function setCdMotifDebutPeriodeActivite1ere($cdMotifDebutPeriodeActivite1ere) {
        $this->cdMotifDebutPeriodeActivite1ere = $cdMotifDebutPeriodeActivite1ere;
    }

    function setDtFinPeriodeActivite($dtFinPeriodeActivite) {
        $this->dtFinPeriodeActivite = $dtFinPeriodeActivite;
    }

    function setDtFinPeriodeActiviteDerniere($dtFinPeriodeActiviteDerniere) {
        $this->dtFinPeriodeActiviteDerniere = $dtFinPeriodeActiviteDerniere;
    }

    function setCdMotifFinPeriodeActivite($cdMotifFinPeriodeActivite) {
        $this->cdMotifFinPeriodeActivite = $cdMotifFinPeriodeActivite;
    }

    function setCdMotifFinPeriodeActiviteDerniere($cdMotifFinPeriodeActiviteDerniere) {
        $this->cdMotifFinPeriodeActiviteDerniere = $cdMotifFinPeriodeActiviteDerniere;
    }

    function setTotalHeuresPayees($totalHeuresPayees) {
        $this->totalHeuresPayees = $totalHeuresPayees;
    }

    function setTotalHeuresPayeesDerniere($totalHeuresPayeesDerniere) {
        $this->totalHeuresPayeesDerniere = $totalHeuresPayeesDerniere;
    }

    function setCdPosistat($cdPosistat) {
        $this->cdPosistat = $cdPosistat;
    }

    function setCdPosistatDerniere($cdPosistatDerniere) {
        $this->cdPosistatDerniere = $cdPosistatDerniere;
    }

    function setCdStatjuri($cdStatjuri) {
        $this->cdStatjuri = $cdStatjuri;
    }

    function setCdStatjuriDerniere($cdStatjuriDerniere) {
        $this->cdStatjuriDerniere = $cdStatjuriDerniere;
    }

    function setCdCategstat($cdCategstat) {
        $this->cdCategstat = $cdCategstat;
    }

    function setCdFoncpubl($cdFoncpubl) {
        $this->cdFoncpubl = $cdFoncpubl;
    }

    function setCdFoncpublDerniere($cdFoncpublDerniere) {
        $this->cdFoncpublDerniere = $cdFoncpublDerniere;
    }

    function setCdStatAppart($cdStatAppart) {
        $this->cdStatAppart = $cdStatAppart;
    }

    function setCdGradOrig($cdGradOrig) {
        $this->cdGradOrig = $cdGradOrig;
    }

    function setCdGrad1($cdGrad1) {
        $this->cdGrad1 = $cdGrad1;
    }

    function setCdGrad2($cdGrad2) {
        $this->cdGrad2 = $cdGrad2;
    }

    function setCdNatureContratTrav($cdNatureContratTrav) {
        $this->cdNatureContratTrav = $cdNatureContratTrav;
    }

    function setCdModaliteExerTrav($cdModaliteExerTrav) {
        $this->cdModaliteExerTrav = $cdModaliteExerTrav;
    }

    function setCdModaliteExerTravDerniere($cdModaliteExerTravDerniere) {
        $this->cdModaliteExerTravDerniere = $cdModaliteExerTravDerniere;
    }

    function setDureeHebdoDerniere($dureeHebdoDerniere) {
        $this->dureeHebdoDerniere = $dureeHebdoDerniere;
    }

    function setDureeHebdo($dureeHebdo) {
        $this->dureeHebdo = $dureeHebdo;
    }

    function setTauxTravTpsPartiel($tauxTravTpsPartiel) {
        $this->tauxTravTpsPartiel = $tauxTravTpsPartiel;
    }

    function setTauxTravTpsPartielDerniere($tauxTravTpsPartielDerniere) {
        $this->tauxTravTpsPartielDerniere = $tauxTravTpsPartielDerniere;
    }

    function setCdIntiContTrav($cdIntiContTrav) {
        $this->cdIntiContTrav = $cdIntiContTrav;
    }

    function setCdIntiContTravDerniere($cdIntiContTravDerniere) {
        $this->cdIntiContTravDerniere = $cdIntiContTravDerniere;
    }

    function setCdStatjuri08($cdStatjuri08) {
        $this->cdStatjuri08 = $cdStatjuri08;
    }

    function setCdStatjuri08Derniere($cdStatjuri08Derniere) {
        $this->cdStatjuri08Derniere = $cdStatjuri08Derniere;
    }

    function setNbHeurPayeSansSuppl($nbHeurPayeSansSuppl) {
        $this->nbHeurPayeSansSuppl = $nbHeurPayeSansSuppl;
    }

    function setBaseFiscale($baseFiscale) {
        $this->baseFiscale = $baseFiscale;
    }

    function setPrimeIndemnite($primeIndemnite) {
        $this->primeIndemnite = $primeIndemnite;
    }

    function setCodeNatureCotisation($codeNatureCotisation) {
        $this->codeNatureCotisation = $codeNatureCotisation;
    }

    function setMontantRetenues($montantRetenues) {
        $this->montantRetenues = $montantRetenues;
    }
    
    function setMontantCarence($montantCarence) {
        $this->montantCarence = $montantCarence;
    }

    function setPeriodeActiviteList($periodeActiviteList) {
        $this->periodeActiviteList = $periodeActiviteList;
    }

    function setPeriodeActiviteMoinsDerniereList($periodeActiviteMoinsDerniereList) {
        $this->periodeActiviteMoinsDerniereList = $periodeActiviteMoinsDerniereList;
    }

    function getPrimeIndemnite601() {
        return $this->primeIndemnite601;
    }

    function setPrimeIndemnite601($primeIndemnite601) {
        $this->primeIndemnite601 = $primeIndemnite601;
    }

    function getLbNatureEmploiN4ds() {
        return $this->lbNatureEmploiN4ds;
    }

    function setLbNatureEmploiN4ds($lbNatureEmploiN4ds) {
        $this->lbNatureEmploiN4ds = $lbNatureEmploiN4ds;
    }

    function getDtDebutPeriodeActiviteDerniere() {
        return $this->dtDebutPeriodeActiviteDerniere;
    }

    function setDtDebutPeriodeActiviteDerniere($dtDebutPeriodeActiviteDerniere) {
        $this->dtDebutPeriodeActiviteDerniere = $dtDebutPeriodeActiviteDerniere;
    }

    function getPeriodeInactiviteList() {
        return $this->periodeInactiviteList;
    }

    function setPeriodeInactiviteList($periodeInactiviteList) {
        $this->periodeInactiviteList = $periodeInactiviteList;
    }

    function getNomUsage() {
        return $this->nomUsage;
    }

    function setNomUsage($nomUsage) {
        $this->nomUsage = $nomUsage;
    }

    function getCdProfessionCategSocio() {
        return $this->cdProfessionCategSocio;
    }

    function setCdProfessionCategSocio($cdProfessionCategSocio) {
        $this->cdProfessionCategSocio = $cdProfessionCategSocio;
    }

    public function getPrimeIndemnite101()
    {
        return $this->primeIndemnite101;
    }

    public function setPrimeIndemnite101($primeIndemnite101)
    {
        $this->primeIndemnite101 = $primeIndemnite101;
    }

    public function getPrimeIndemnite102()
    {
        return $this->primeIndemnite102;
    }

    public function setPrimeIndemnite102($primeIndemnite102)
    {
        $this->primeIndemnite102 = $primeIndemnite102;
    }




}