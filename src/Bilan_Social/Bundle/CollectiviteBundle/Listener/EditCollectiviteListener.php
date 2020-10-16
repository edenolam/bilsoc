<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Listener;

use Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\CollectiviteDraft;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;

/**
 * EditCollectiviteListener
 */
class EditCollectiviteListener {

    /** @var ColleviteDraft */
    protected $collectiviteDraft = null;

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
     * PreUpdate Collectivite
     *
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args) {
        $entity = $args->getEntity();
        if(!$entity instanceof Collectivite || !$this->securityAuthorizationChecker->isGranted('ROLE_COLLECTIVITY' ) || $entity->getchange_request() == 0)
            return null;

        $em = $args->getEntityManager();
        $collectiviteDraft = new CollectiviteDraft();
        

        foreach ($args->getEntityChangeSet() as $field => $value) {
            $method = 'set' . ucfirst($field);

            if (method_exists($collectiviteDraft, $method)) {
                $collectiviteDraft->{$method}($args->getNewValue($field));
                $entity->{$method}($args->getOldValue($field));
            }
        }
        
        if(!array_key_exists('nmSire', $args->getEntityChangeSet())){
            $collectiviteDraft->setNmSire($entity->getNmSire());
        }

        $uow = $em->getUnitOfWork();
        $meta = $em->getClassMetadata(get_class($entity));
        $uow->recomputeSingleEntityChangeSet($meta, $entity);
        
        $collectiviteDraft->setCollectivite($entity);

        $this->collectiviteDraft = $collectiviteDraft;
    }

    /**
     * postFlush
     *
     * flush entity collectiviteDraft
     *
     * @param PostFlushEventArgs $event
     */
    public function postFlush(PostFlushEventArgs $event) {
        if (!is_null($this->collectiviteDraft)) {
            $em = $event->getEntityManager();
            $em->persist($this->collectiviteDraft);
            $this->collectiviteDraft = null;
            $em->flush();
        }
    }

}
