<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Enums;

abstract class AlerteNonPermanentN4dsEnum
{
    const ALERNONPERM_040 = "040";
    const ALERNONPERM_052 = "052";
    const ALERNONPERM_053 = "053";
    const ALERNONPERM_054 = "054";
    const ALERNONPERM_059 = "059";
    const ALERNONPERM_060 = "060";
    const ALERNONPERM_061 = "061";
    const ALERNONPERM_062 = "062";
    const ALERNONPERM_070 = "070";
    const ALERNONPERM_110 = "110";
    const ALERNONPERM_150 = "150";
    const ALERNONPERM_160 = "160";




    /** @var array user friendly named type */
    protected static $alerteNonPermanentN4dsLibelle = [
        self::ALERNONPERM_040  => 'Alerte contractuel occasionnel ou saisonnier',
        self::ALERNONPERM_052  => 'Alerte assistants maternels',
        self::ALERNONPERM_053  => 'Alerte personnel médical hospitalier',
        self::ALERNONPERM_054  => 'Alerte non titulaire sur emploi particulier',
        self::ALERNONPERM_059  => 'Alerte médecin sans statut hospitalier',
        self::ALERNONPERM_060  => 'Alerte emploi aidé de droit public',
        self::ALERNONPERM_061  => 'Alerte maître et documentaliste de l’enseignement privé général sous contrat',
        self::ALERNONPERM_062  => 'Alerte maître et documentaliste de l’enseignement privé agricole sous contrat',
        self::ALERNONPERM_070  => 'Alerte vacataire (personnel payé à l’acte ou à la tâche)',
        self::ALERNONPERM_110  => 'Alerte stagiaire (en convention de stage)',
        self::ALERNONPERM_150  => 'Alerte volontaire civil',
        self::ALERNONPERM_160  => 'Alerte Parcours d’accès aux carrières territoriales, hospitalières et de l’État (Pacte)',

    ];

    /**
     * @param  string $alerteNonPermanentShortLibelle
     * @return string
     */
    public static function getAlerteNonPermanentLibelle($alerteNonPermanentShortLibelle)
    {
        if (!isset(static::$alerteNonPermanentN4dsLibelle[$alerteNonPermanentShortLibelle])) {
            return "Alerte référentiel non permanent inconnue ($alerteNonPermanentShortLibelle)";
        }

        return static::$alerteNonPermanentN4dsLibelle[$alerteNonPermanentShortLibelle];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableTypes()
    {
        return [
            self::ALERNONPERM_040,
            self::ALERNONPERM_052,
            self::ALERNONPERM_053,
            self::ALERNONPERM_054,
            self::ALERNONPERM_059,
            self::ALERNONPERM_060,
            self::ALERNONPERM_061,
            self::ALERNONPERM_062,
            self::ALERNONPERM_070,
            self::ALERNONPERM_110,
            self::ALERNONPERM_150,
            self::ALERNONPERM_160,

        ];
    }
}