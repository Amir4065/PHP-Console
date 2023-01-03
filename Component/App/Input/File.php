<?php

namespace App\Input;

class File
{
    private $fileName;
    private $fileDestination;
    private $fileHandle;
    private $path;

    /**
     * File constructor.
     * @param $fileName
     * @param $fileDestination
     */
    public function __construct($fileName, $fileDestination)
    {
        $this->fileName = $fileName . ".csv";
        $this->fileDestination = $fileDestination;
        $this->path = "assets" . DIRECTORY_SEPARATOR;
    }

    public function init()
    {
        $this->fileHandle = fopen($this->path . $this->fileDestination . DIRECTORY_SEPARATOR . $this->fileName, "w");
    }

    /**
     * Write to file CSV
     * @param $fileContents
     */
    public function writeToCsvFile($fileContents)
    {
        foreach ($fileContents as $content) {
            fputcsv($this->fileHandle, $content);
        }
    }

    /**
     *Close File Handle
     */
    public function close()
    {
        fclose($this->fileHandle);
    }
}
