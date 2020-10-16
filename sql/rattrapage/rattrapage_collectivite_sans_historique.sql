/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  mbusson
 * Created: 12 juil. 2018
 *  CE RATTRAPAGE PERMET DE METTRE A JOUR EN CREANT UNE LIGNE DANS HISTORIQUE BILAN SOCIAL LES COLLECTIVITES 
 *  N AYANT PAS DE LIGNE CREES POUR L ENQUETE EN COURS, NI DE CONSOLIDE, NI D AGENT PAR AGENT ET AYANT UNE DATE DE CONNECTION NON NULL
 *  AINSI POUR CES COLLECTIVITES, LEUR STATUT SERA 7 ( NON SAISIE ) POUR LE DASHBOARD OU LE SUIVI DES ENQUETES
 */

# BIEN VERIFIER CE QU ON RECUPERE AVANT D INSERER LA LIGNE !

INSERT INTO historique_bilan_social(FG_STAT, CD_TYPEBILASOCI, DT_CHGT, ID_ENQU, ID_COLL, ID_DEPA)
SELECT 7,NULL,NOW(), e1_.ID_ENQU, u8_.ID_COLL,d6_.ID_DEPA
	FROM utilisateur_droits u11_ 
	INNER JOIN utilisateur_cdg u12_ ON (u11_.ID_UTILISATEUR_CDG = u12_.ID_UTILISATEUR_CDG) 
	INNER JOIN cdg_departement c13_ ON (u11_.ID_CDG_DEPARTEMENT = c13_.ID_CDG_DEPARTEMENT) 
	INNER JOIN departement d6_ ON (d6_.ID_DEPA = c13_.ID_DEPA)
	INNER JOIN collectivite c4_ ON (c4_.ID_DEPA = d6_.ID_DEPA)
	LEFT JOIN enquete_collectivite e2_ ON (c4_.ID_COLL = e2_.ID_COLL) 	
	INNER JOIN enquete e1_ ON (e2_.ID_ENQU = e1_.ID_ENQU AND e1_.FG_STAT = 1 AND e1_.ID_CAMP = 1)
	LEFT JOIN historique_bilan_social h0_ ON (h0_.ID_COLL = c4_.ID_COLL AND h0_.ID_ENQU = e1_.ID_ENQU AND h0_.DT_CHGT = (
	SELECT MAX(h15_.DT_CHGT) AS dctrn__2 
	FROM historique_bilan_social h15_ 
	WHERE h15_.ID_COLL = c4_.ID_COLL AND h15_.ID_ENQU = e1_.ID_ENQU)) 
      
      LEFT JOIN bilan_social_consolide b9_ ON (b9_.ID_COLL = c4_.ID_COLL AND b9_.ID_ENQU = e1_.ID_ENQU) 
	  LEFT JOIN bilan_social_agent b17_ ON (b17_.ID_COLL = c4_.ID_COLL AND b17_.ID_ENQU = e1_.ID_ENQU)
      LEFT OUTER JOIN (SELECT ID_BILASOCICONS, COUNT(id) NB_INCOHERENCES
                       FROM incoherencelog
                       GROUP BY ID_BILASOCICONS) AS il ON il.ID_BILASOCICONS = b9_.ID_BILASOCICONS
      LEFT JOIN utilisateur u8_ ON (c4_.ID_COLL = u8_.ID_COLL) 
		WHERE c4_.BL_ACTI = 1 AND CONV('0011000',2,10) & u11_.FG_DROITS IN (16, 24) AND h0_.FG_STAT IS NULL AND 
		u8_.DT_LASTCONN IS NOT NULL AND b17_.ID_BILASOCIAGEN IS NULL AND b9_.ID_BILASOCICONS IS NULL
		GROUP BY c4_.ID_COLL;
