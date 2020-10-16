<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Enums;

abstract class TempsPartielN4dsEnum
{
    const TPSPART_010 = "10";
    const TPSPART_021 = "21";
    const TPSPART_022 = "22";
    const TPSPART_023 = "23";
    const TPSPART_024 = "24";
    const TPSPART_025 = "25";
    const TPSPART_026 = "26";
    const TPSPART_027 = "27";
    const TPSPART_028 = "28";
    const TPSPART_029 = "29";
    const TPSPART_030 = "30";
    const TPSPART_031 = "31";
    const TPSPART_032 = "32";
    const TPSPART_033 = "33";
    const TPSPART_040 = "40";
    const TPSPART_041 = "41";
    const TPSPART_042 = "42";
    const TPSPART_050 = "50";
    const TPSPART_090 = "90";




    /** @var array user friendly named type */
    protected static $tempsPartielN4dsLibelle = [

        self::TPSPART_010 => "10 - Temps plein",
        self::TPSPART_021 => "21 - Temps partiel sur autorisation",
        self::TPSPART_022 => "22 - Temps partiel de droit à l'occasion d'une naissance ou d'une adoption",
        self::TPSPART_023 => "23 - Temps partiel de droit à l'occasion d'une naissance ou d'une adoption (sur TNC)",
        self::TPSPART_024 => "24 - Temps partiel de droit pour soins à conjoint ou enfant ou ascendant",
        self::TPSPART_025 => "25 - Temps partiel de droit pour soins à conjoint ou enfant ou ascendant (sur TNC)",
        self::TPSPART_026 => "26 - Temps partiel de droit au profit des travailleurs handicapés",
        self::TPSPART_027 => "27 - Temps partiel de droit au profit des travailleurs handicapés (sur TNC)",
        self::TPSPART_028 => "28 - Temps partiel de droit pour créer ou reprendre une entreprise",
        self::TPSPART_029 => "29 - Temps partiel de droit pour créer ou reprendre une entreprise (sur TNC)",
        self::TPSPART_030 => "30 - Temps partiel pour raison thérapeutique après CMO ou CLM ou CLD",
        self::TPSPART_031 => "31 - Temps partiel pour raison thérapeutique après CMO ou CLM ou CLD (sur TNC)",
        self::TPSPART_032 => "32 - Temps partiel pour raison thérapeutique après accident de service ou maladie professionnelle",
        self::TPSPART_033 => "33 - Temps partiel pour raison thérapeutique après accident de service ou maladie professionnelle (sur TNC)",
        self::TPSPART_040 => "40 - Cessation progressive d'activité ancien régime (avant le 2 janvier 2004)",
        self::TPSPART_041 => "41 - Cessation progressive d'activité dégressive",
        self::TPSPART_042 => "42 - Cessation progressive d'activité fixe",
        self::TPSPART_050 => "50 - Temps non complet",
        self::TPSPART_090 => "90 - salarié non concerné",

    ];

    /**
     * @param  string $tempsPartielN4dsShortLibelle
     * @return string
     */
    public static function getTempsPartielN4dsShortLibelle($tempsPartielN4dsShortLibelle)
    {
        if (!isset(static::$tempsPartielN4dsLibelle[$tempsPartielN4dsShortLibelle])) {
            return "Temps Partiel inconnu ($tempsPartielN4dsShortLibelle)";
        }

        return static::$tempsPartielN4dsLibelle[$tempsPartielN4dsShortLibelle];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableTypes()
    {
        return [
            self::TPSPART_010,
            self::TPSPART_021,
            self::TPSPART_022,
            self::TPSPART_023,
            self::TPSPART_024,
            self::TPSPART_025,
            self::TPSPART_026,
            self::TPSPART_027,
            self::TPSPART_028,
            self::TPSPART_029,
            self::TPSPART_030,
            self::TPSPART_031,
            self::TPSPART_032,
            self::TPSPART_033,
            self::TPSPART_040,
            self::TPSPART_041,
            self::TPSPART_042,
            self::TPSPART_050,
            self::TPSPART_090,
        ];
    }
}