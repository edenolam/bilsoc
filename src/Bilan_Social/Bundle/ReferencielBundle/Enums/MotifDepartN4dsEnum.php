<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Enums;

abstract class MotifDepartN4dsEnum
{
    const MOTIDEPA_004 = "004";
    const MOTIDEPA_006 = "006";
    const MOTIDEPA_008 = "008";
    const MOTIDEPA_010 = "010";
    const MOTIDEPA_012 = "012";
    const MOTIDEPA_014 = "014";
    const MOTIDEPA_018 = "018";
    const MOTIDEPA_042 = "042";
    const MOTIDEPA_058 = "058";
    const MOTIDEPA_062 = "062";
    const MOTIDEPA_070 = "070";
    const MOTIDEPA_074 = "074";
    const MOTIDEPA_090 = "090";
    const MOTIDEPA_096 = "096";
    const MOTIDEPA_098 = "098";
    const MOTIDEPA_112 = "112";
    const MOTIDEPA_114 = "114";
    const MOTIDEPA_120 = "120";
    const MOTIDEPA_122 = "122";
    const MOTIDEPA_132 = "132";
    const MOTIDEPA_134 = "134";
    const MOTIDEPA_136 = "136";
    const MOTIDEPA_138 = "138";
    const MOTIDEPA_140 = "140";
    const MOTIDEPA_144 = "144";
    const MOTIDEPA_452 = "452";
    const MOTIDEPA_902 = "902";
    const MOTIDEPA_904 = "904";




    /** @var array user friendly named type */
    protected static $motifDepartN4dsLibelle = [
        self::MOTIDEPA_004 => "suspension du contrat de travail",
        self::MOTIDEPA_006 => "congé sans solde supérieur ou égal à 30 jours consécutifs",
        self::MOTIDEPA_008 => "fin de contrat de travail, fin d'activité, fin de détachement, perte",
        self::MOTIDEPA_010 => "démission",
        self::MOTIDEPA_012 => "licenciement",
        self::MOTIDEPA_014 => "convention de conversion",
        self::MOTIDEPA_018 => "décès, disparition",
        self::MOTIDEPA_042 => "congé demi solde",
        self::MOTIDEPA_058 => "service national volontaire (y compris volontaires du service civique)",
        self::MOTIDEPA_062 => "paiement des congés payés",
        self::MOTIDEPA_070 => "congé parental d'éducation",
        self::MOTIDEPA_074 => "créateur d'entreprise",
        self::MOTIDEPA_090 => "sortie d'activité d'un retraité cumulant retraite et activité",
        self::MOTIDEPA_096 => "salarié  quittant  ou  ayant  quitté  l'entreprise ",
        self::MOTIDEPA_098 => "continuité d'activité en fin de période",
        self::MOTIDEPA_112 => "congé de solidarité familiale",
        self::MOTIDEPA_114 => "congé de présence parentale",
        self::MOTIDEPA_120 => "fin de période pré retraite IEG (réservé échanges inter organismes)",
        self::MOTIDEPA_122 => "congé sabbatique, disponibilité, congé sans traitement de l'agent public",
        self::MOTIDEPA_132 => "fin de période RATP (réservé échanges inter organisme)",
        self::MOTIDEPA_134 => "départ volontaire à la retraite",
        self::MOTIDEPA_136 => "mise à la retraite d'office à l'initiative de l'employeur",
        self::MOTIDEPA_138 => "rupture conventionnelle du contrat de travail",
        self::MOTIDEPA_140 => "événements prévoyance (réservé aux déclarations prévoyance événementielles)",
        self::MOTIDEPA_144 => "maintien de cotisations prévoyance en période de chômage",
        self::MOTIDEPA_452 => "départ en détachement",
        self::MOTIDEPA_902 => "changement de situation administrative du salarié ou de l'assuré",
        self::MOTIDEPA_904 => "fin de période d’apprentissage dans le cadre d’un CDI",
    ];

    /**
     * @param  string $motifDepartN4dsShortLibelle
     * @return string
     */
    public static function getMotifDepartN4dsShortLibelle($motifDepartN4dsShortLibelle)
    {
        if (!isset(static::$motifDepartN4dsLibelle[$motifDepartN4dsShortLibelle])) {
            return "Motif départ inconnu ($motifDepartN4dsShortLibelle)";
        }

        return static::$motifDepartN4dsLibelle[$motifDepartN4dsShortLibelle];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableTypes()
    {
        return [
            self::MOTIDEPA_004,
            self::MOTIDEPA_006,
            self::MOTIDEPA_008,
            self::MOTIDEPA_010,
            self::MOTIDEPA_012,
            self::MOTIDEPA_014,
            self::MOTIDEPA_018,
            self::MOTIDEPA_042,
            self::MOTIDEPA_058,
            self::MOTIDEPA_062,
            self::MOTIDEPA_070,
            self::MOTIDEPA_074,
            self::MOTIDEPA_090,
            self::MOTIDEPA_096,
            self::MOTIDEPA_098,
            self::MOTIDEPA_112,
            self::MOTIDEPA_114,
            self::MOTIDEPA_120,
            self::MOTIDEPA_122,
            self::MOTIDEPA_132,
            self::MOTIDEPA_134,
            self::MOTIDEPA_136,
            self::MOTIDEPA_138,
            self::MOTIDEPA_140,
            self::MOTIDEPA_144,
            self::MOTIDEPA_452,
            self::MOTIDEPA_902,
            self::MOTIDEPA_904
        ];
    }
}