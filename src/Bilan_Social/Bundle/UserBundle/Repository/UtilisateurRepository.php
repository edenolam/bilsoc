<?php

namespace Bilan_Social\Bundle\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\UserBundle\Entity\User;

/**
 * Utilisateur Repository
 */
class UtilisateurRepository extends EntityRepository {

    /**
     * @param string $role
     *
     * @return array
     */
    public function findByRoles($role) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
                ->from($this->_entityName, 'u')
                ->where('u.roles LIKE :roles')
                ->setParameter('roles', '%"' . $role . '"%');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param string $username
     *
     * @return array
     */
    public function findByUsername($username) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
                ->from($this->_entityName, 'u')
                ->where('u.username LIKE :username')
                ->setParameter('username', '%"' . $username . '"%');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param string $username
     *
     * @return array
     */
    public function findOneByUsername($username) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
                ->from($this->_entityName, 'u')
                ->where('u.username LIKE :username')
                ->setParameter('username', '%"' . $username . '"%');


        try {
            $user = $qb->getQuery()->getSingleResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll

            return null;
        }

        return $user;
    }

    /**
     * Get collectivities by department
     *
     * @param string $department
     * @return array
     */
    /* public function getCollectivitiesByDepartment($department) {
      $qb = $this->_em->createQueryBuilder();
      $qb->select(array('u','c'))
      ->from($this->_entityName, 'u')
      ->join('collectivite','c')
      ->where('u.roles LIKE :role')
      ->andWhere('c.department = :department')
      ->setParameter('role', '%"' . USER::ROLE_COLLECTIVITY . '"%')
      ->setParameter('department', $department);

      return $qb->getQuery()->getResult();
      } */
}
