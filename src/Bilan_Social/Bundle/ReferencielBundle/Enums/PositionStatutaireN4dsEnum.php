<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Enums;

abstract class PositionStatutaireN4dsEnum
{

    const POSISTAT_101 = "101";
    const POSISTAT_102 = "102";
    const POSISTAT_103 = "103";
    const POSISTAT_104 = "104";
    const POSISTAT_105 = "105";
    const POSISTAT_106 = "106";
    const POSISTAT_107 = "107";
    const POSISTAT_108 = "108";
    const POSISTAT_109 = "109";
    const POSISTAT_110 = "110";
    const POSISTAT_111 = "111";
    const POSISTAT_112 = "112";

    /** @var array user friendly named type */
    protected static $positionStatutaireN4dsLibelle = [
        self::POSISTAT_101 => "Position normale d’activité",
        self::POSISTAT_102 => "Mise à disposition",
        self::POSISTAT_103 => "Délégation",
        self::POSISTAT_104 => "Détachement",
        self::POSISTAT_105 => "Position hors cadre",
        self::POSISTAT_106 => "Congé parental",
        self::POSISTAT_107 => "Disponibilité",
        self::POSISTAT_108 => "Congé sans traitement (stagiaire uniquement)",
        self::POSISTAT_109 => "Disponibilité spéciale des officiers généraux",
        self::POSISTAT_110 => "Position de non activité des militaires",
        self::POSISTAT_111 => "Position hors cadre des préfets",
        self::POSISTAT_112 => "Position de non activité des enseignants",
    ];

    /**
     * @param  string $positionStatutaireN4dsShortLibelle
     * @return string
     */
    public static function getPositionStatutaireN4dsShortLibelle($positionStatutaireN4dsShortLibelle)
    {
        if (!isset(static::$positionStatutaireN4dsLibelle[$positionStatutaireN4dsShortLibelle])) {
            return "Position Statutaire inconnue ($positionStatutaireN4dsShortLibelle)";
        }

        return static::$positionStatutaireN4dsLibelle[$positionStatutaireN4dsShortLibelle];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableTypes()
    {
        return [
            self::POSISTAT_101,
            self::POSISTAT_102,
            self::POSISTAT_103,
            self::POSISTAT_104,
            self::POSISTAT_105,
            self::POSISTAT_106,
            self::POSISTAT_107,
            self::POSISTAT_108,
            self::POSISTAT_109,
            self::POSISTAT_110,
            self::POSISTAT_111,
            self::POSISTAT_112,
        ];
    }
}