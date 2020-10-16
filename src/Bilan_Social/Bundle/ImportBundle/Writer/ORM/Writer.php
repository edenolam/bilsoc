<?php

namespace Bilan_Social\Bundle\ImportBundle\Writer\ORM;

use Doctrine\ORM\EntityManager;
use Bilan_Social\Bundle\ImportBundle\Writer\WriterInterface;

class Writer implements WriterInterface {

    /** @var EntityManager */
    protected $entityManager;

    /**
     * Construct
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Write item in database
     *
     * @param array $items
     */
    public function write(array $items) {
        foreach ($items as $item) {
            if ($item) {
                $this->entityManager->persist($item);
            }
        }

        $this->entityManager->flush();
        $this->entityManager->clear();
    }

}
