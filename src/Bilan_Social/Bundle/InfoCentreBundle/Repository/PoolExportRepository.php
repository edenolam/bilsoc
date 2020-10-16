<?php

namespace Bilan_Social\Bundle\InfoCentreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Bilan_Social\Bundle\CoreBundle\Repository\AbstractRepository;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;
use Bilan_Social\Bundle\InfoCentreBundle\Entity\PoolExport;

/**
 * PoolExportRepository
 *
 */
class PoolExportRepository extends AbstractRepository {
    
    public function findOneByTaskKey($task_key){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('pe, p, lth')
            ->from('InfoCentreBundle:PoolExport','pe')
            ->join('InfoCentreBundle:Pool', 'p', 'WITH', 'p.id = pe.pool')
            ->leftJoin('LongTaskManagerBundle:LongTaskHeader', 'lth', 'WITH', 'lth.id = pe.longTaskHeader')
            ->where('lth.task_key = :task_key')
            ->setParameter('task_key', $task_key);

        return $qb->getQuery()->getResult();
    }

    public function findOneByTaskKeyNativeQuery($task_key){
        $rsmb = new ResultSetMappingBuilder($this->_em);
        $rsmb->addRootEntityFromClassMetadata(PoolExport::class, 'pe');
        $select = $rsmb->generateSelectClause(array('pe'=>'pe'));
        $query = "SELECT ".$select." FROM pool_export pe JOIN  pool_export_task_header peth ON peth.ID_POOL_EXPORT = pe.ID_POOL_EXPORT JOIN bsltm_longtask_header bth ON bth.id = peth.ID_TASK WHERE bth.task_key = ?";
        $query = $this->_em->createNativeQuery($query,$rsmb);
        $query->setParameter(1, $task_key);
        $result = $query->getResult(); 
        $result = is_array($result) && !empty($result) ? $result[0] : null;
        return $result;
        /*$qb = $this->_em->createQueryBuilder();
        $qb->select('pe, p, lth')
            ->from('InfoCentreBundle:PoolExport','pe')
            ->join('InfoCentreBundle:Pool', 'p', 'WITH', 'p.id = pe.pool')
            //->leftJoin('LongTaskManagerBundle:LongTaskHeader', 'lth', 'WITH', 'lth.id = pe.longTaskHeader')
            ->leftJoin('pe.longTaskHeader', 'lth')
            ->where('lth.task_key = :task_key')
            ->setParameter('task_key', $task_key);

        return $qb->getQuery()->getResult();*/

    }

    public function getUserPoolExport($user,$pool_export=null){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('pe, p, lth')
            ->from('InfoCentreBundle:PoolExport','pe')
            ->join('pe.pool', 'p')
            ->leftJoin('pe.longTaskHeaders', 'lth')
            ->leftJoin('pe.headerExportHRG', 'heh')
            ->addSelect('heh')
            ->where('p.utilisateur = :user')
            ->setParameter('user',$user);
        if($pool_export!=null){
            $qb->andWhere('pe.id = :pool_export')
                ->setParameter('pool_export',$pool_export);
        }

        return $qb->getQuery()->getResult();
    }
}