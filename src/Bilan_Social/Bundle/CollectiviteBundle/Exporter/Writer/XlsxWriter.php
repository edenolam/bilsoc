<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Exporter\Writer;

use Exporter\Writer\TypedWriterInterface;
use PHPExcel_IOFactory;
use PHPExcel;
use PHPExcel_Style_Alignment;

class XlsxWriter implements TypedWriterInterface
{
    const LABEL_COLUMN = 1;
    /** @var  PHPExcel */
    private $phpExcelObject;
    /** @var array */
    private $headerColumns = [];
    /** @var  string */
    private $filename;
    /** @var int */
    protected $position;
    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->position = 2;
    }
    public function getDefaultMimeType()
    {
        return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    }
    public function getFormat()
    {
        return 'xlsx';
    }
    /**
     * Create PHPExcel object and set defaults
     */
    public function open()
    {
        $this->phpExcelObject = new PHPExcel();
    }
    /**
     * {@inheritdoc}
     */
    public function write(array $data)
    {
        $this->init($data);
        foreach ($data as $header => $value) {
            $this->setCellValue($this->getColumn($header), $value);
        }
        ++$this->position;
    }
    /**
     *  Set labels
     * @param $data
     *
     * @return void
     */
    protected function init($data)
    {
        if ($this->position > 2) {
            return;
        }
        $i = 0;
        foreach ($data as $header => $value) {
            $column = self::formatColumnName($i);
            $this->setHeader($column, $header);
            $i++;
        }
        $this->setBoldLabels();
    }
    /**
     * Save Excel file
     */
    public function close()
    {
        $writer = PHPExcel_IOFactory::createWriter($this->phpExcelObject, 'Excel2007');
        $writer->save($this->filename);
    }
    /**
     * Returns letter for number based on Excel columns
     * @param int $number
     * @return string
     */
    public static function formatColumnName($number)
    {
        for ($char = ""; $number >= 0; $number = intval($number / 26) - 1) {
            $char = chr($number%26 + 0x41) . $char;
        }
        return $char;
    }
    /**
     * @return \PHPExcel_Worksheet
     */
    private function getActiveSheet()
    {
        return $this->phpExcelObject->getActiveSheet();
    }
    /**
     * Makes header bold
     */
    private function setBoldLabels()
    {
        $this->getActiveSheet()->getStyle(
            sprintf(
                "%s1:%s1",
                reset($this->headerColumns),
                end($this->headerColumns)
            )
        )->getFont()->setBold(true);
    }
    /**
     * Sets cell value
     * @param string $column
     * @param string $value
     */
    private function setCellValue($column, $value)
    {
        $this->getActiveSheet()->setCellValue($column, $value);
    }
    /**
     * Set column label and make column auto size
     * @param string $column
     * @param string $value
     */
    private function setHeader($column, $value)
    {
        $this->setCellValue($column.self::LABEL_COLUMN, $value);
        $this->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
        $this->headerColumns[$value] = $column;
    }
    /**
     * Get column name
     * @param string $name
     * @return string
     */
    private function getColumn($name)
    {
        return $this->headerColumns[$name].$this->position;
    }
}