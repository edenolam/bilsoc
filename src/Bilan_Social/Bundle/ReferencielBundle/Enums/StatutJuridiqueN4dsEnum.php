<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Enums;

abstract class StatutJuridiqueN4dsEnum
{
    const STATJURI_011 = "011";
    const STATJURI_012 = "012";
    const STATJURI_013 = "013";
    const STATJURI_016 = "016";
    const STATJURI_401 = "401";
    const STATJURI_403 = "403";
    const STATJURI_404 = "404";
    const STATJURI_405 = "405";
    const STATJURI_030 = "030";
    const STATJURI_040 = "040";
    const STATJURI_052 = "052";
    const STATJURI_053 = "053";
    const STATJURI_054 = "054";
    const STATJURI_059 = "059";
    const STATJURI_060 = "060";
    const STATJURI_061 = "061";
    const STATJURI_062 = "062";
    const STATJURI_070 = "070";
    const STATJURI_110 = "110";
    const STATJURI_150 = "150";
    const STATJURI_160 = "160";




    /** @var array user friendly named type */
    protected static $statutJuridiqueN4dsLibelle = [
        self::STATJURI_011  => 'Titulaire',
        self::STATJURI_012  => 'Stagiaire',
        self::STATJURI_013  => 'Elève',
        self::STATJURI_016  => 'Ouvrier d\'Etat',
        self::STATJURI_401  => 'Militaire de carrière',
        self::STATJURI_403  => 'Militaire sous contrat',
        self::STATJURI_404  => 'Militaire de réserve',
        self::STATJURI_405  => 'Militaire élève',
        self::STATJURI_030  => 'Contractuel sur emploi permanent',
        self::STATJURI_040  => 'Contractuel occasionnel ou saisonnier',
        self::STATJURI_052  => 'Assistant(e) maternel(le) et familial(e)',
        self::STATJURI_053  => 'Personnel médical hospitalier',
        self::STATJURI_054  => 'Contractuel sur emploi particulier',
        self::STATJURI_059  => 'Médecin sans statut hospitalier',
        self::STATJURI_060  => 'Emploi aidé de droit public',
        self::STATJURI_061  => 'Maître et documentaliste de l’enseignement privé général sous contrat',
        self::STATJURI_062  => 'Maître et documentaliste de l’enseignement privé agricole sous contrat',
        self::STATJURI_070  => 'Vacataire (personnel payé à l\'acte ou à la tâche)',
        self::STATJURI_110  => 'Stagiaire (en convention de stage)',
        self::STATJURI_150  => 'Volontaire civil',
        self::STATJURI_160  => 'Parcours d’accès aux carrières territoriales, hospitalières et de l\'État (Pacte)',
    ];

    /**
     * @param  string $statutJuridiqueN4dsShortLibelle
     * @return string
     */
    public static function getStatutJuridiqueN4dsShortLibelle($statutJuridiqueN4dsShortLibelle)
    {
        if (!isset(static::$statutJuridiqueN4dsLibelle[$statutJuridiqueN4dsShortLibelle])) {
            return "Statut juridique inconnu ($statutJuridiqueN4dsShortLibelle)";
        }

        return static::$statutJuridiqueN4dsLibelle[$statutJuridiqueN4dsShortLibelle];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableTypes()
    {
        return [
            self::STATJURI_011,
            self::STATJURI_012,
            self::STATJURI_013,
            self::STATJURI_016,
            self::STATJURI_401,
            self::STATJURI_403,
            self::STATJURI_404,
            self::STATJURI_405,
            self::STATJURI_030,
            self::STATJURI_040,
            self::STATJURI_052,
            self::STATJURI_053,
            self::STATJURI_054,
            self::STATJURI_059,
            self::STATJURI_060,
            self::STATJURI_061,
            self::STATJURI_062,
            self::STATJURI_070,
            self::STATJURI_110,
            self::STATJURI_150,
            self::STATJURI_160,
        ];
    }
}