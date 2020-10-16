<?php

namespace Bilan_Social\Bundle\ImportBundle\Reader;

use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class CsvReader implements ReaderInterface {

    /** @var string */
    protected $filename;

    /** @var string */
    protected $delimiter;

    /**
     * Construct
     *
     * @param string $filename
     * @param string $delemiter
     */
    public function __construct(string $filename, string $delimiter) {
        $this->filename = $filename;
        $this->delimiter = $delimiter;
    }

    /**
     * Read Csv File and return array
     *
     * @return mixed
     */
    public function read() {
        if (!file_exists($this->filename) || !is_readable($this->filename)) {
            throw new FileNotFoundException($this->filename);
        }

        $header = NULL;
        $data = array();

        if (($handle = fopen($this->filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $this->delimiter)) !== FALSE) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }

}
