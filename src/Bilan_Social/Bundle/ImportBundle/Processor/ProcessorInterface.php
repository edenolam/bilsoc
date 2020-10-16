<?php

namespace Bilan_Social\Bundle\ImportBundle\Processor;

interface ProcessorInterface {

    /**
     * Process
     *
     * @param array $items
     */
    public function process(array $items);
}
