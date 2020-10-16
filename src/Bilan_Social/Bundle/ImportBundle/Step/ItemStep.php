<?php

namespace Bilan_Social\Bundle\ImportBundle\Step;

use Bilan_Social\Bundle\ImportBundle\Reader\ReaderInterface;
use Bilan_Social\Bundle\ImportBundle\Processor\ProcessorInterface;
use Bilan_Social\Bundle\ImportBundle\Writer\WriterInterface;

class ItemStep {

    /** @var ReaderInterface */
    protected $reader;

    /** @var ProcessorInterface */
    protected $processor;

    /** @var WriterInterface */
    protected $writer;

    /**
     * Data size in memory before flush
     * @var int
     */
    protected $batchSize;

    /**
     * Construct
     *
     * @param ReaderInterface $reader
     * @param ProcessorInterface $processor
     * @param WriterInterface $writer
     */
    public function __construct(ReaderInterface $reader, ProcessorInterface $processor, WriterInterface $writer, int $batchSize) {
        $this->reader = $reader;
        $this->processor = $processor;
        $this->writer = $writer;
        $this->batchSize = $batchSize;
    }

    /**
     * Execute reader, processor and writer
     * Return the number of items read
     *
     * @return int
     */
    public function execute() {
        // Get array data
        $data = $this->reader->read();

        $size = count($data);
        $i = 1;

        $itemsToWrite = [];
        foreach ($data as $row) {
            $item = $this->processor->process($row);

            $itemsToWrite[] = $item;

            if (($i % $this->batchSize) === 0) {

                $this->writer->write($itemsToWrite);

                $itemsToWrite = [];
            }

            $i++;
        }

        if (count($itemsToWrite) > 0) {
            $this->writer->write($itemsToWrite);
        }

        return $size;
    }

}
