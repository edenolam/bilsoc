/*
* script sql de ratrrapage pour les type d'initialisation des bilans (manuelle et à vide) (01/02/2019)
*/


/*
* type d'init bs-vide + nb agent consolidé > 0 => type d'init : manu
*/

UPDATE init_bilan_social ibs
SET ibs.INIT_SOURCE = 'manu'
WHERE ibs.ID_INIT_BS IN (
	SELECT idInitbs FROM (SELECT c.ID_COLL AS "idColl", c.NM_SIRE AS "siretColl", c.LB_COLL AS "nomColl", rfc.LB_TYPE_COLL AS "lbTypeColl",
 c.ID_TYPE_COLL AS "typeColl", depa.LB_DEPA AS "lbDepa", c.ID_DEPA AS "depaColl", depa.CD_DEPA AS "cdDepa", enqu.ID_ENQU AS "idEnqu",
  camp.NM_ANNE AS "anneeCamp", bsc.ID_BILASOCICONS AS "idBilanSociCons", camp.FG_STAT AS "statutCamp", enqu.FG_STAT AS "statutEnqu",
   init_bilan.INIT_SOURCE AS "sourceInitBilan", init_bilan.BL_APA AS "apaInitBilan", init_bilan.BL_CONS AS "consoInitBilan", init_bilan.ID_INIT_BS AS "idInitbs",
	 ( COALESCE(bsc.NB_AGENT_TITULAIRE,0) + COALESCE(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_PERMANENT,0) + COALESCE(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_NON_PERMANENT,0)) AS "nbAgentCons",
	  IF((SELECT 
              c0_.ID_COLL AS ID_COLL_0 
            FROM 
              utilisateur_droits u1_ 
              INNER JOIN utilisateur_cdg u2_ ON (
                u1_.ID_UTILISATEUR_CDG = u2_.ID_UTILISATEUR_CDG
              ) 
              INNER JOIN cdg_departement c3_ ON (
                u1_.ID_CDG_DEPARTEMENT = c3_.ID_CDG_DEPARTEMENT
              )
              INNER JOIN cdg_departements_enquetes cde ON cde.ID_CDG_DEPARTEMENT = c3_.ID_CDG_DEPARTEMENT
              INNER JOIN departement d4_ ON (d4_.ID_DEPA = c3_.ID_DEPA) 
              INNER JOIN departements_enquetes de_ ON de_.ID_DEPA = d4_.ID_DEPA
              INNER JOIN collectivite c0_ ON (c0_.ID_DEPA = d4_.ID_DEPA) 
              LEFT JOIN pool_item p5_ ON (p5_.ID_COLL = c0_.ID_COLL) 
            WHERE 
              u1_.ID_UTILISATEUR_CDG = 110 
              AND CONV("1100000", 2, 10) & u1_.FG_DROITS = 96 
              AND c0_.ID_COLL IN (c.ID_COLL) 
              AND de_.ID_ENQU IN (enqu.ID_ENQU)
             GROUP BY c0_.ID_COLL) IS NULL,true,false) AS anonyme  
				FROM collectivite c join ref_type_collectivite AS rfc
                     ON  rfc.ID_TYPE_COLL = c.ID_TYPE_COLL join departement AS depa
                     ON  depa.ID_DEPA = c.ID_DEPA left join enquete_collectivite AS ec
                     ON  ec.ID_COLL = c.ID_COLL left join enquete AS enqu
                     ON  enqu.ID_ENQU = ec.ID_ENQU left join campagne AS camp
                     ON  camp.ID_CAMP = enqu.ID_CAMP left join bilan_social_consolide AS bsc
                     ON  bsc.ID_COLL = c.ID_COLL  AND bsc.ID_ENQU = ec.ID_ENQU left join init_bilan_social AS init_bilan
                     ON  init_bilan.ID_COLL = c.ID_COLL  AND init_bilan.ID_ENQU = ec.ID_ENQU   
						WHERE (camp.FG_STAT = '1' AND enqu.FG_STAT = '1' AND init_bilan.INIT_SOURCE IN ('bs-vide')) GROUP BY c.ID_COLL, enqu.ID_ENQU) AS main_query  
					WHERE  nbAgentCons >= '1'
);

/*
* type d'init manu + 0 agent consolidé => type d'init : bs-vide
*/

UPDATE init_bilan_social ibs
SET ibs.INIT_SOURCE = 'bs-vide'
WHERE ibs.ID_INIT_BS IN (
	SELECT idInitbs FROM (SELECT c.ID_COLL AS "idColl", c.NM_SIRE AS "siretColl", c.LB_COLL AS "nomColl", rfc.LB_TYPE_COLL AS "lbTypeColl",
 c.ID_TYPE_COLL AS "typeColl", depa.LB_DEPA AS "lbDepa", c.ID_DEPA AS "depaColl", depa.CD_DEPA AS "cdDepa", enqu.ID_ENQU AS "idEnqu",
  camp.NM_ANNE AS "anneeCamp", bsc.ID_BILASOCICONS AS "idBilanSociCons", camp.FG_STAT AS "statutCamp", enqu.FG_STAT AS "statutEnqu",
   init_bilan.INIT_SOURCE AS "sourceInitBilan", init_bilan.BL_APA AS "apaInitBilan", init_bilan.BL_CONS AS "consoInitBilan", init_bilan.ID_INIT_BS AS "idInitbs",
	 ( COALESCE(bsc.NB_AGENT_TITULAIRE,0) + COALESCE(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_PERMANENT,0) + COALESCE(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_NON_PERMANENT,0)) AS "nbAgentCons",
	  IF((SELECT 
              c0_.ID_COLL AS ID_COLL_0 
            FROM 
              utilisateur_droits u1_ 
              INNER JOIN utilisateur_cdg u2_ ON (
                u1_.ID_UTILISATEUR_CDG = u2_.ID_UTILISATEUR_CDG
              ) 
              INNER JOIN cdg_departement c3_ ON (
                u1_.ID_CDG_DEPARTEMENT = c3_.ID_CDG_DEPARTEMENT
              )
              INNER JOIN cdg_departements_enquetes cde ON cde.ID_CDG_DEPARTEMENT = c3_.ID_CDG_DEPARTEMENT
              INNER JOIN departement d4_ ON (d4_.ID_DEPA = c3_.ID_DEPA) 
              INNER JOIN departements_enquetes de_ ON de_.ID_DEPA = d4_.ID_DEPA
              INNER JOIN collectivite c0_ ON (c0_.ID_DEPA = d4_.ID_DEPA) 
              LEFT JOIN pool_item p5_ ON (p5_.ID_COLL = c0_.ID_COLL) 
            WHERE 
              u1_.ID_UTILISATEUR_CDG = 110 
              AND CONV("1100000", 2, 10) & u1_.FG_DROITS = 96 
              AND c0_.ID_COLL IN (c.ID_COLL) 
              AND de_.ID_ENQU IN (enqu.ID_ENQU)
             GROUP BY c0_.ID_COLL) IS NULL,true,false) AS anonyme  
				FROM collectivite c join ref_type_collectivite AS rfc
                     ON  rfc.ID_TYPE_COLL = c.ID_TYPE_COLL join departement AS depa
                     ON  depa.ID_DEPA = c.ID_DEPA left join enquete_collectivite AS ec
                     ON  ec.ID_COLL = c.ID_COLL left join enquete AS enqu
                     ON  enqu.ID_ENQU = ec.ID_ENQU left join campagne AS camp
                     ON  camp.ID_CAMP = enqu.ID_CAMP left join bilan_social_consolide AS bsc
                     ON  bsc.ID_COLL = c.ID_COLL  AND bsc.ID_ENQU = ec.ID_ENQU left join init_bilan_social AS init_bilan
                     ON  init_bilan.ID_COLL = c.ID_COLL  AND init_bilan.ID_ENQU = ec.ID_ENQU   
						WHERE (camp.FG_STAT = '1' AND enqu.FG_STAT = '1' AND init_bilan.INIT_SOURCE IN ('manu')) GROUP BY c.ID_COLL, enqu.ID_ENQU) AS main_query  
					WHERE  nbAgentCons = '0'
)