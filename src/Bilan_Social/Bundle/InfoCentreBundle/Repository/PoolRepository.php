<?php

namespace Bilan_Social\Bundle\InfoCentreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Bilan_Social\Bundle\CoreBundle\Repository\AbstractRepository;
/**
 * PoolRepositorys
 *
 */
class PoolRepository extends AbstractRepository {
    
    public function getDefaultQb(){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')
            ->addSelect('i')
            //->addSelect('c')
            //->addSelect('d')
           // ->addSelect('e')
           // ->addSelect('camp')
            ->from($this->_entityName, 'p')
            ->leftJoin('p.items', 'i')
           // ->leftJoin('CollectiviteBundle:Collectivite', 'c', 'WITH', 'i.idCollectivite = c.idColl' )
            //->leftJoin('c.departement','d')
            //->leftJoin('EnqueteBundle:Enquete', 'e', 'WITH', 'i.idEnquete = e.idEnqu' )
            //->leftJoin('e.campagne','camp')
            ->orderBy('p.dateCreation','DESC');
        return $qb;
    }
    public function getById($idPool){
    
        $qb = $this->getDefaultQb();
        $qb->where('p.id = :id')
            ->setParameter('id',$idPool);

        return $qb->getQuery()->getOneOrNullResult();
    }
    
    public function getByUser($user){
        
        $qb = $this->getDefaultQb();
        $qb->where('p.utilisateur = :user')
            ->setParameter('user',$user);

        return $qb->getQuery()->getResult();
//            
    }

    public function isPoolOkForSecretStatistique($id_pool,$id_user_cdg){
        $em = $this->getEntityManager();
        $query = 'SELECT anonyme, SUM(nb_coll) AS nb_coll, SUM(nb_agent) AS nb_agent, IF((anonyme=true AND NB_AGENT > 0) OR anonyme=false, true, false) AS "is_ok" FROM (
            SELECT anonyme, COUNT(ID_COLL) AS nb_coll, SUM(NB_AGENT) AS nb_agent, ID_COLL FROM (
                SELECT IF((SELECT 
                     c0_.ID_COLL AS ID_COLL_0 
                   FROM 
                     utilisateur_droits u1_ 
                     INNER JOIN utilisateur_cdg u2_ ON (
                       u1_.ID_UTILISATEUR_CDG = u2_.ID_UTILISATEUR_CDG
                     ) 
                     INNER JOIN cdg_departement c3_ ON (
                       u1_.ID_CDG_DEPARTEMENT = c3_.ID_CDG_DEPARTEMENT
                     )
                     INNER JOIN departement d4_ ON (d4_.ID_DEPA = c3_.ID_DEPA)
                     INNER JOIN departements_enquetes de_ ON de_.ID_DEPA = d4_.ID_DEPA 
                     INNER JOIN collectivite c0_ ON (c0_.ID_DEPA = d4_.ID_DEPA) 
                     LEFT JOIN pool_item p5_ ON (p5_.ID_COLL = c0_.ID_COLL) 
                   WHERE 
                     u1_.ID_UTILISATEUR_CDG = '.$id_user_cdg.' 
                     AND CONV("1100000", 2, 10) & u1_.FG_DROITS >= 64 
                     AND c0_.ID_COLL IN (c.ID_COLL) 
                     AND de_.ID_ENQU IN (e.ID_ENQU)
                    GROUP BY c0_.ID_COLL) IS NULL,true,false) AS anonyme ,
                     (COALESCE(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_PERMANENT,0) 
                     + COALESCE(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_NON_PERMANENT,0) 
                     + COALESCE(bsc.NB_AGENT_EMPLOI_PERMANENT,0)
                     + COALESCE(bsc.NB_AGENT_TITULAIRE,0)) AS NB_AGENT,
                     c.ID_COLL 
                FROM pool p
                JOIN pool_item pitem ON pitem.ID_POOL = p.ID_POOL
                JOIN collectivite c ON c.ID_COLL = pitem.ID_COLL
                JOIN enquete e ON e.ID_ENQU = pitem.ID_ENQU
                LEFT JOIN bilan_social_consolide bsc ON bsc.ID_COLL = c.ID_COLL AND bsc.ID_ENQU = e.ID_ENQU
                WHERE p.ID_POOL = :id_pool
            ) aggr
            GROUP BY anonyme
        ) aggr2
        GROUP BY anonyme, is_ok';
        $statement = $em->getConnection()->prepare($query);
        $statement->bindValue('id_pool', $id_pool);
        $statement->execute();
        $result = $statement->fetchAll();
        $is_ok = null;
        if(!empty($result)){
            $has_anonyme = false;
            foreach ($result as $key => $row) {
                $is_ok=false;
                if($row['anonyme']){
                    $has_anonyme = true;
                    if($row['is_ok'] && $row['nb_coll']>=5){
                        $is_ok = true;
                        break;
                    }
                }
            }
            if(!$has_anonyme){
                $is_ok = true;
            }
        }
        return $is_ok;
    }

    public function getInitQueryTempTableForSecreetStatistiqueAnnee($pool_item_list){
        $temp_table_col = "( 
            ID_COLL INT, ID_ENQU INT,
            PRIMARY KEY (ID_COLL, ID_ENQU),
            INDEX (ID_COLL),
            INDEX (ID_ENQU)
        )";
        $insert_into_temp_table_values = "";
        foreach ($pool_item_list as $key => $pool_item) {
            $insert_into_temp_table_values .= $key > 0 ? ",(" : "(";
            $insert_into_temp_table_values .= $pool_item->getIdCollectivite().",".$pool_item->getIdEnquete().")";
        } 
        $delete_temp_tables = "";
        $create_temp_tables = "";
        $insert_into_temp_tables = "";
        $temp_table_names = array('simul_pool','simul_pool_anon');
        foreach ($temp_table_names as $key => $temp_table_name) {
            $delete_temp_tables .= "DROP TEMPORARY TABLE IF EXISTS ".$temp_table_name.";";
            $create_temp_tables .= "CREATE TEMPORARY TABLE IF NOT EXISTS  ".$temp_table_name." ".$temp_table_col.";";
            $insert_into_temp_tables .= "INSERT INTO  ".$temp_table_name." (ID_COLL, ID_ENQU) VALUES ".$insert_into_temp_table_values.";";
        }
        $init_query = $delete_temp_tables.' '.$create_temp_tables.' '.$insert_into_temp_tables;
        return $init_query;
    }
    public function isPoolOkForSecretStatistiqueAnnee($pool_item_list,$id_user_cdg){
        $em = $this->getEntityManager();
        $co = $em->getConnection();
        $init_query = $this->getInitQueryTempTableForSecreetStatistiqueAnnee($pool_item_list);
        $query = 'SELECT anonyme, SUM(nb_coll) AS nb_coll, SUM(nb_agent) AS nb_agent, IF((anonyme=true AND NB_AGENT > 0) OR anonyme=false, true, false) AS "is_ok" FROM (
            SELECT anonyme, COUNT(ID_COLL) AS nb_coll, SUM(NB_AGENT) AS nb_agent, ID_COLL FROM (
                SELECT IF((SELECT 
                     c0_.ID_COLL AS ID_COLL_0 
                   FROM 
                     utilisateur_droits u1_ 
                     INNER JOIN utilisateur_cdg u2_ ON (
                       u1_.ID_UTILISATEUR_CDG = u2_.ID_UTILISATEUR_CDG
                     ) 
                     INNER JOIN cdg_departement c3_ ON (
                       u1_.ID_CDG_DEPARTEMENT = c3_.ID_CDG_DEPARTEMENT
                     )
                     INNER JOIN departement d4_ ON (d4_.ID_DEPA = c3_.ID_DEPA)
                     INNER JOIN departements_enquetes de_ ON de_.ID_DEPA = d4_.ID_DEPA 
                     INNER JOIN collectivite c0_ ON (c0_.ID_DEPA = d4_.ID_DEPA) 
                     LEFT JOIN simul_pool_anon p5_ ON (p5_.ID_COLL = c0_.ID_COLL) 
                   WHERE 
                     u1_.ID_UTILISATEUR_CDG = '.$id_user_cdg.' 
                     AND CONV("1100000", 2, 10) & u1_.FG_DROITS >= 64 
                     AND c0_.ID_COLL IN (c.ID_COLL) 
                     AND de_.ID_ENQU IN (e.ID_ENQU)
                    GROUP BY c0_.ID_COLL) IS NULL,true,false) AS anonyme ,
                     (COALESCE(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_PERMANENT,0) 
                     + COALESCE(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_NON_PERMANENT,0) 
                     + COALESCE(bsc.NB_AGENT_EMPLOI_PERMANENT,0)
                     + COALESCE(bsc.NB_AGENT_TITULAIRE,0)) AS NB_AGENT,
                     c.ID_COLL 
                FROM simul_pool pitem
                JOIN collectivite c ON c.ID_COLL = pitem.ID_COLL
                JOIN enquete e ON e.ID_ENQU = pitem.ID_ENQU
                LEFT JOIN bilan_social_consolide bsc ON bsc.ID_COLL = c.ID_COLL AND bsc.ID_ENQU = e.ID_ENQU
            ) aggr
            GROUP BY anonyme
        ) aggr2
        GROUP BY anonyme, is_ok;';
        $delete_temp_tables = "DROP TEMPORARY TABLE IF EXISTS simul_pool, simul_pool_anon;";
        $init_stm = $co->prepare($init_query);
        $init_stm->execute();
        $init_stm->closeCursor();
        $statement = $co->prepare($query.' '.$delete_temp_tables);
        $statement->execute();
        $result = $statement->fetchAll();
        $is_ok = null;
        if(!empty($result)){
            $has_anonyme = false;
            foreach ($result as $key => $row) {
                $is_ok=false;
                if($row['anonyme']){
                    $has_anonyme = true;
                    if($row['is_ok'] && $row['nb_coll']>=5){
                        $is_ok = true;
                        break;
                    }
                }
            }
            if(!$has_anonyme){
                $is_ok = true;
            }
        }
        return $is_ok;
    }
    
    public function isPoolOkForSecretStatistiqueInfoCentreAnnee($pool_item_list){
        $em = $this->getEntityManager();
        $co = $em->getConnection();
        $init_query = $this->getInitQueryTempTableForSecreetStatistiqueAnnee($pool_item_list);
        $query = 'SELECT anonyme, SUM(nb_coll) AS nb_coll, SUM(nb_agent) AS nb_agent, IF((anonyme=true AND NB_AGENT > 0) OR anonyme=false, true, false) AS "is_ok" FROM (
            SELECT anonyme, COUNT(ID_COLL) AS nb_coll, SUM(NB_AGENT) AS nb_agent, ID_COLL FROM (
                SELECT IF((SELECT 
                     c0_.ID_COLL AS ID_COLL_0 
                     FROM
                        departement d3_
                     INNER JOIN departements_enquetes de_ ON de_.ID_DEPA = d3_.ID_DEPA
                     INNER JOIN collectivite c0_ ON (c0_.ID_DEPA = d3_.ID_DEPA)
                     LEFT JOIN simul_pool_anon p5_ ON (p5_.ID_COLL = c0_.ID_COLL) 
                   WHERE c0_.ID_COLL IN (c.ID_COLL) 
                     AND de_.ID_ENQU IN (e.ID_ENQU)
                    GROUP BY c0_.ID_COLL) IS NULL,true,false) AS anonyme ,
                     (COALESCE(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_PERMANENT,0) 
                     + COALESCE(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_NON_PERMANENT,0) 
                     + COALESCE(bsc.NB_AGENT_EMPLOI_PERMANENT,0)
                     + COALESCE(bsc.NB_AGENT_TITULAIRE,0)) AS NB_AGENT,
                     c.ID_COLL 
                FROM simul_pool pitem
                JOIN collectivite c ON c.ID_COLL = pitem.ID_COLL
                JOIN enquete e ON e.ID_ENQU = pitem.ID_ENQU
                LEFT JOIN bilan_social_consolide bsc ON bsc.ID_COLL = c.ID_COLL AND bsc.ID_ENQU = e.ID_ENQU
            ) aggr
            GROUP BY anonyme
        ) aggr2
        GROUP BY anonyme, is_ok;';
        $delete_temp_tables = "DROP TEMPORARY TABLE IF EXISTS simul_pool, simul_pool_anon;";
        $init_stm = $co->prepare($init_query);
        $init_stm->execute();
        $init_stm->closeCursor();
        $statement = $co->prepare($query.' '.$delete_temp_tables);
        $statement->execute();
        $result = $statement->fetchAll();
        $is_ok = null;
        if(!empty($result)){
            $has_anonyme = false;
            foreach ($result as $key => $row) {
                $is_ok=false;
                if($row['anonyme']){
                    $has_anonyme = true;
                    if($row['is_ok'] && $row['nb_coll']>=5){
                        $is_ok = true;
                        break;
                    }
                }
            }
            if(!$has_anonyme){
                $is_ok = true;
            }
        }
        return $is_ok;
    }
}