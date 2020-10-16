<?php

namespace Bilan_Social\Bundle\LongTaskManagerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Bilan_Social\Bundle\CoreBundle\Repository\AbstractRepository;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;

/**
 * PoolRepository
 *
 */
class LongTaskHeaderRepository extends AbstractRepository {


    function findOneLightByTaskKey($task_key){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('partial lth.{id,owner_key,task_type,task_key,start_date,run_data,external_ref_id,details_count,details_done_count,details_error_count,end_date,status,status_linked_data,owner_email}')
            ->from('LongTaskManagerBundle:LongTaskHeader','lth')
            ->where('lth.task_key = :task_key')
            ->setParameter('task_key', $task_key);
        $query = $qb->getQuery();
        $query->setHint(\Doctrine\ORM\Query::HINT_FORCE_PARTIAL_LOAD, 1);
        $result = $query->getOneOrNullResult();
        if($result!=null){
            $result->setRunData(utf8_encode($result->getRunData()));
        }

        return $result;
    }

    function findByOwnerAndType($owner,$types){
        $types = is_array($types) ? $types : array($types);

        $conn = $this->getEntityManager()->getConnection();
        $meta_data = $this->getClassMetadata();
        $table = $meta_data->getTableName();
        $array_parameters = array();
        $sql = "SELECT * FROM ".$table." lth WHERE lth.".$meta_data->getColumnName("owner_key")." = :owner_key ";
        $array_parameters['owner_key']=$owner;
        if(!empty($types)){
            $array_placeholder = array(); 
            foreach ($types as $key => $type) {
                $temp_placeholder = ':type_'.$key;
                $array_placeholder[] = $temp_placeholder;
                $array_parameters[$temp_placeholder] = $type;
            }
            $sql .= " AND lth.".$meta_data->getColumnName("task_type")." IN (".implode(",", $array_placeholder).");";
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute($array_parameters);

        $result = $stmt->fetchAll();
        return $result;
    }
    function findByTaskKey($task_key){
        $conn = $this->getEntityManager()->getConnection();
        $meta_data = $this->getClassMetadata();
        $table = $meta_data->getTableName();
        $array_parameters = array();
        $sql = "SELECT * FROM ".$table." lth WHERE lth.".$meta_data->getColumnName("task_key")." = :task_key ";
        $array_parameters['task_key']=$task_key;
        $stmt = $conn->prepare($sql);
        $stmt->execute($array_parameters);

        $result = $stmt->fetchAll();
        return $result;
    }
}