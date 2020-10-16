<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Bilan_Social\Bundle\CoreBundle\Repository\AbstractRepository;
/**
 * RefAbstractRepository
 *
 */
class RefAbstractRepository extends AbstractRepository {
	public function findAll(){
		return $this->findBy(array(),array('nmOrdre' => 'ASC'));
	}
}