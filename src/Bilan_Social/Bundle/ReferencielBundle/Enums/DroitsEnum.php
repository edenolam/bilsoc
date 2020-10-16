<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\ReferencielBundle\Enums;

/**
 * Description of DroitsEnum
 *
 * 00 => Les deux premiers entier concernent les droits sur la lecture et écriture sur la gestion des collectivités
 * 00 => Les deux entiers suivants concernent les drouts sur la lecture et écriture sur la gestion des enquêtes
 * 0 => Le cinquième entier concerne le droit permettant à l'utilisateur de prendre la place de la collectivité
 * 0 => Le sixième entier concertne le droit permettant à l'utilisateur de gérer les modèles de mail
 * 0 => Le dernier entier concerne le droit permettant à l'utilisateur d'avoir accès à l'espace analyse RH
 */
abstract class DroitsEnum
{
    CONST MASK_READ_WRITE_COLLECTIVITE = '1100000'; // Constante permettant de récupérer le droit de lecture et écriture sur la gestion des collectivtés
    CONST MASK_READ_COLLECTIVITE = '1000000'; // Constante permettant de récupérer le droit de lecture sur la gestion des collectivtés
    CONST MASK_READ_ENQUETE = '0010000'; // Constante permettant de récupérer le droit de lecture sur la gestion des enquêtes
    CONST MASK_READ_WRITE_ENQUETE = '0011000'; // Constante permettant de récupérer le droit de lecture et écriture sur la gestion des enquêtes
    CONST MASK_ESPACE_ANALYSE = '0000001'; // Constante permettant de récupérer le droit de lecture et écriture sur la gestion des enquêtes

    /** @var array user friendly named type */
    /*protected static $droit = [
        self::MOTIARRI_001,
        self::MOTIARRI_003
    ];*/
    
    /**
     * @param  string $motifArriveeN4dsShortLibelle
     * @return string
     */
    /*public static function getDroit($droitValue)
    {
        return static::$droit[$droitValue];
    }*/
}
