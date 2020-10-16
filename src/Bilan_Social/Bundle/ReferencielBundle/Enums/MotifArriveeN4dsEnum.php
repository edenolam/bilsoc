<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Enums;

abstract class MotifArriveeN4dsEnum
{
    const MOTIARRI_001 = "001";
    const MOTIARRI_003 = "003";
    const MOTIARRI_005 = "005";
    const MOTIARRI_041 = "041";
    const MOTIARRI_057 = "057";
    const MOTIARRI_061 = "061";
    const MOTIARRI_069 = "069";
    const MOTIARRI_089 = "089";
    const MOTIARRI_095 = "095";
    const MOTIARRI_097 = "097";
    const MOTIARRI_111 = "111";
    const MOTIARRI_113 = "113";
    const MOTIARRI_119 = "119";
    const MOTIARRI_121 = "121";
    const MOTIARRI_ent = "ent";
    const MOTIARRI_131 = "131";
    const MOTIARRI_139 = "139";
    const MOTIARRI_143 = "143";
    const MOTIARRI_451 = "451";
    const MOTIARRI_901 = "901";
    const MOTIARRI_903 = "903";




    /** @var array user friendly named type */
    protected static $motifArriveeN4dsLibelle = [
        self::MOTIARRI_001  => '001 embauche, début d\'activité, recrutement direct ou sur concours (fonction publique), début de détachement, début de vie cultuelle (cultes)',
        self::MOTIARRI_003  => '003 reprise d\'activité suite à suspension du contrat de travail',
        self::MOTIARRI_005  => '005 congé sans solde supérieur ou égal à 30 jours consécutifs',
        self::MOTIARRI_041  => '041 congé demi solde',
        self::MOTIARRI_057  => '057 service national volontaire (y compris volontaires du service civique)',
        self::MOTIARRI_061  => '061 paiement des congés payés',
        self::MOTIARRI_069  => '069 congé parental d\'éducation',
        self::MOTIARRI_089  => '089 embauche d\'un retraité reprenant une activité',
        self::MOTIARRI_095  => '095 salarié quittant ou ayant quitté l\'entreprise (sommes versées dont indemnités de non concurrence pour l\'Agirc Arrco ou rappels Ircantec)',
        self::MOTIARRI_097  => '097 continuité d\'activité en début de période',
        self::MOTIARRI_111  => '111 congé de solidarité familiale',
        self::MOTIARRI_113  => '113 congé de présence parentale',
        self::MOTIARRI_119  => '119 début de période IEG pensions (réservé aux échanges inter organismes)',
        self::MOTIARRI_121  => '121 congé sabbatique, disponibilité, congé sans traitement de l\'ag',
        self::MOTIARRI_ent  => 'ent public stagiaire, fonctionnaire hors cadre',
        self::MOTIARRI_131  => '131 début de période RATP (réservé échanges interorganismes)',
        self::MOTIARRI_139  => '139 événement prévoyance (réservé aux déclarations évènementielles prévoyance)',
        self::MOTIARRI_143  => '143 maintien de cotisations prévoyance en période de chômage',
        self::MOTIARRI_451  => '451 retour de détachement',
        self::MOTIARRI_901  => '901 changement de situation administrative du salarié ou de l\'assuré',
        self::MOTIARRI_903  => '903 début de période d’apprentissage dans le cadre d\'un CDI',
    ];

    /**
     * @param  string $motifArriveeN4dsShortLibelle
     * @return string
     */
    public static function getMotifArriveeN4dsShortLibelle($motifArriveeN4dsShortLibelle)
    {
        if (!isset(static::$motifArriveeN4dsLibelle[$motifArriveeN4dsShortLibelle])) {
            return "Motif arrivée inconnu ($motifArriveeN4dsShortLibelle)";
        }

        return static::$motifArriveeN4dsLibelle[$motifArriveeN4dsShortLibelle];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableTypes()
    {
        return [
            self::MOTIARRI_001,
            self::MOTIARRI_003,
            self::MOTIARRI_005,
            self::MOTIARRI_041,
            self::MOTIARRI_057,
            self::MOTIARRI_061,
            self::MOTIARRI_069,
            self::MOTIARRI_089,
            self::MOTIARRI_095,
            self::MOTIARRI_097,
            self::MOTIARRI_111,
            self::MOTIARRI_113,
            self::MOTIARRI_119,
            self::MOTIARRI_121,
            self::MOTIARRI_ent,
            self::MOTIARRI_131,
            self::MOTIARRI_139,
            self::MOTIARRI_143,
            self::MOTIARRI_451,
            self::MOTIARRI_901,
            self::MOTIARRI_903,
        ];
    }
}