<?php

namespace Bilan_Social\Bundle\ImportBundle\Writer;

interface WriterInterface {

    /**
     * write
     *
     * @param array $items
     */
    public function write(array $items);
}
