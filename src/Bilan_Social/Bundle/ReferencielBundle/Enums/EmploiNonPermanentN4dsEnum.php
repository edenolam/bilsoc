<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Enums;

abstract class EmploiNonPermanentN4dsEnum
{
    const EMPLNONPERM_021 = "021";
    const EMPLNONPERM_030 = "030";
    const EMPLNONPERM_031 = "031";
    const EMPLNONPERM_032 = "032";
    const EMPLNONPERM_041 = "041";
    const EMPLNONPERM_042 = "042";
    const EMPLNONPERM_050 = "050";
    const EMPLNONPERM_051 = "051";
    const EMPLNONPERM_055 = "055";
    const EMPLNONPERM_061 = "061";
    const EMPLNONPERM_071 = "071";
    const EMPLNONPERM_080 = "080";
    const EMPLNONPERM_090 = "090";



    /** @var array user friendly named type */
    protected static $emploiNonPermanentN4dsLibelle = [
        self::EMPLNONPERM_021 => "CUI (Contrat Initiative Emploi)",
        self::EMPLNONPERM_030 => "CDI intérimaire",
        self::EMPLNONPERM_031 => "CDI d'apprentissage",
        self::EMPLNONPERM_032 => "Contrat d'apprentissage intérimaire",
        self::EMPLNONPERM_041 => "CUI (Contrat d'Accompagnement dans l'Emploi)",
        self::EMPLNONPERM_042 => "CUI (Contrat d'accès à l'emploi )",
        self::EMPLNONPERM_050 => "Emploi d'avenir secteur marchand",
        self::EMPLNONPERM_051 => "Emploi d'avenir secteur non marchand",
        self::EMPLNONPERM_055 => "Contrat d’engagement éducatif",
        self::EMPLNONPERM_061 => "Contrat de Professionnalisation",
        self::EMPLNONPERM_071 => "Contrat d’insertion",
        self::EMPLNONPERM_080 => "Contrat de génération",
        self::EMPLNONPERM_090 => "Autres contrats",
    ];

    /**
     * @param  string $emploiNonPermanentN4dsShortLibelle
     * @return string
     */
    public static function getEmploiNonPermanentN4dsShortLibelle($emploiNonPermanentN4dsShortLibelle)
    {
        if (!isset(static::$emploiNonPermanentN4dsLibelle[$emploiNonPermanentN4dsShortLibelle])) {
            return "Motif arrivée inconnu ($emploiNonPermanentN4dsShortLibelle)";
        }

        return static::$emploiNonPermanentN4dsLibelle[$emploiNonPermanentN4dsShortLibelle];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableTypes()
    {
        return [
            self::EMPLNONPERM_021,
            self::EMPLNONPERM_030,
            self::EMPLNONPERM_031,
            self::EMPLNONPERM_032,
            self::EMPLNONPERM_041,
            self::EMPLNONPERM_042,
            self::EMPLNONPERM_050,
            self::EMPLNONPERM_051,
            self::EMPLNONPERM_055,
            self::EMPLNONPERM_061,
            self::EMPLNONPERM_071,
            self::EMPLNONPERM_080,
            self::EMPLNONPERM_090,
        ];
    }
}