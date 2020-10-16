<?php

namespace Bilan_Social\Bundle\FileManagerBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * File
 */
class File
{
    /**
     * @var string
     */
    private $file;
  
    private $image;

    /**
     * Set file
     *
     * @param UploadedFile $file
     *
     * @return File
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }
    function getImage() {
        return $this->image;
    }

    function setImage($image) {
        $this->image = $image;
    }


}
