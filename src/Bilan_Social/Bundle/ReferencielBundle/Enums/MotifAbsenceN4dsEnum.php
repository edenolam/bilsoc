<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Enums;

abstract class MotifAbsenceN4dsEnum
{
    const MOTIABSE_100 = "100";
    const MOTIABSE_105 = "105";
    const MOTIABSE_106 = "106";
    const MOTIABSE_107 = "107";
    const MOTIABSE_108 = "108";
    const MOTIABSE_110 = "110";
    const MOTIABSE_113 = "113";
    const MOTIABSE_115 = "115";
    const MOTIABSE_200 = "200";
    const MOTIABSE_201 = "201";
    const MOTIABSE_202 = "202";
    const MOTIABSE_203 = "203";
    const MOTIABSE_204 = "204";
    const MOTIABSE_205 = "205";
    const MOTIABSE_206 = "206";
    const MOTIABSE_301 = "301";
    const MOTIABSE_302 = "302";
    const MOTIABSE_413 = "413";




    /** @var array user friendly named type */
    protected static $motifAbsenceN4dsLibelle = [
        self::MOTIABSE_100  => 'Congé de maladie ou de maladie ordinaire',
        self::MOTIABSE_105  => 'Congé suite à un accident de trajet',
        self::MOTIABSE_106  => 'Congé de longue ou grave maladie imputable au service',
        self::MOTIABSE_107  => 'Congé suite à une maladie imputable au service',
        self::MOTIABSE_108  => 'Congé suite à maladie professionnelle',
        self::MOTIABSE_110  => 'Congé suite à accident du travail ou de service',
        self::MOTIABSE_113  => 'Congé de longue maladie',
        self::MOTIABSE_115  => 'Congé de longue durée',
        self::MOTIABSE_200  => 'Congé de maternité (englobe l\'adoption dans le privé)',
        self::MOTIABSE_201  => 'Congé pour adoption (public)',
        self::MOTIABSE_202  => 'Congé pour maternité (hors adoption)',
        self::MOTIABSE_203  => 'Congé de paternité',
        self::MOTIABSE_204  => 'Congé d\'accompagnement d\'une personne en fin de vie',
        self::MOTIABSE_205  => 'Congé de présence parentale (public car S40 si privé)',
        self::MOTIABSE_206  => 'Congé de solidarité / soutien familial',
        self::MOTIABSE_301  => 'Congé de formation professionnelle',
        self::MOTIABSE_302  => 'Congé de formation mobilité',
        self::MOTIABSE_413  => 'Congé spécial',
    ];

    /**
     * @param  string $motifAbsenceN4dsShortLibelle
     * @return string
     */
    public static function getMotifAbsenceN4dsShortLibelle($motifAbsenceN4dsShortLibelle)
    {
        if (!isset(static::$motifAbsenceN4dsLibelle[$motifAbsenceN4dsShortLibelle])) {
            return "Motif Absence inconnu ($motifAbsenceN4dsShortLibelle)";
        }

        return static::$motifAbsenceN4dsLibelle[$motifAbsenceN4dsShortLibelle];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableTypes()
    {
        return [
            self::MOTIABSE_100,
            self::MOTIABSE_105,
            self::MOTIABSE_106,
            self::MOTIABSE_107,
            self::MOTIABSE_108,
            self::MOTIABSE_110,
            self::MOTIABSE_113,
            self::MOTIABSE_115,
            self::MOTIABSE_200,
            self::MOTIABSE_201,
            self::MOTIABSE_202,
            self::MOTIABSE_203,
            self::MOTIABSE_204,
            self::MOTIABSE_205,
            self::MOTIABSE_206,
            self::MOTIABSE_301,
            self::MOTIABSE_302,
            self::MOTIABSE_413,
        ];
    }
}
