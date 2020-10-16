<?php

namespace Bilan_Social\Bundle\UserBundle\Listener;

use Bilan_Social\Bundle\UserBundle\Entity\User;
use Bilan_Social\Bundle\UserBundle\Entity\UserDraft;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

/* use Doctrine\ORM\Event\PreUpdateEventArgs;
  use Doctrine\ORM\Event\PostFlushEventArgs; */

/**
 * UserProposalListener
 */
class UserProposalListener {

    /** @var UserDraft */
    protected $userDraft = null;

    /** @var AuthorizationChecker */
    protected $securityAuthorizationChecker;

    /**
     *
     * @param AuthorizationChecker $securityAuthorizationChecker
     */
    public function __construct(AuthorizationChecker $securityAuthorizationChecker) {
        $this->securityAuthorizationChecker = $securityAuthorizationChecker;
    }

    /**
     * PreUpdate User
     *
     * @param PreUpdateEventArgs $args
     */
    /* public function preUpdate(PreUpdateEventArgs $args) {
      $entity = $args->getEntity();

      if (!$entity instanceof User ||
      $this->securityAuthorizationChecker->isGranted('ROLE_CDG')) {
      return;
      }

      $em = $args->getEntityManager();
      $userDraft = new UserDraft();

      foreach ($args->getEntityChangeSet() as $field => $value) {
      $method = 'set' . ucfirst($field);

      if (method_exists($userDraft, $method)) {
      $userDraft->{$method}($args->getNewValue($field));
      $entity->{$method}($args->getOldValue($field));
      }
      }

      $entity->setChangeRequest(true);
      $uow = $em->getUnitOfWork();
      $meta = $em->getClassMetadata(get_class($entity));
      $uow->recomputeSingleEntityChangeSet($meta, $entity);

      $userDraft->setUser($entity);

      $this->userDraft = $userDraft;
      } */

    /**
     * postFlush
     *
     * flush entity userDraft
     *
     * @param PostFlushEventArgs $event
     */
    /* public function postFlush(PostFlushEventArgs $event) {
      dump($this->userDraft);
      exit();
      if (!is_null($this->userDraft)) {
      $em = $event->getEntityManager();
      $em->persist($this->userDraft);
      $this->userDraft = null;
      $em->flush();
      }
      } */
}
