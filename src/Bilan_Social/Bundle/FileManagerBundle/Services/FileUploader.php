<?php

namespace Bilan_Social\Bundle\FileManagerBundle\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Service FileUploader
 */
class FileUploader
{
    /**
     * Upload a file
     *
     * @param UploadedFile  $file               File to upload
     * @param string        $directoryUpload    The directory where the file is uploaded
     *
     * @return string                           Name of the uploaded file
     */
    public function upload(UploadedFile $file, $directoryUpload)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($directoryUpload, $fileName);

        return $fileName;
    }
}
