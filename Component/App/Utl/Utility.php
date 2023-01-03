<?php

namespace App\Utl;

class Utility
{
    private string $langPath;
    private string $jsonFilePath;

    /**
     * Utility constructor.
     */
    public function __construct()
    {
        $this->langPath = "assets/lang/";
        $this->jsonFilePath = "config/";
    }
    /**
     * @param String $data
     * @return bool
     */
    public function lang(String $data)
    { 
        if (empty($data) || !isset($data))
        {
            return "";
        }
        $defaultValue = 'Not found';
        $analyseData = explode(".", $data);
        if (!isset($doc)){
            $doc = include ($this->langPath . $analyseData[0] . ".php");
        }
        return (!empty($doc[$analyseData[1]])) ? $doc[$analyseData[1]] : '' ;
    }

    /**
     * @param String $data
     * @return String
     */
    public function loadCommand(String $data): String
    {
        $analyseData = explode('.', $data);
        $file = file_get_contents($this->jsonFilePath . $analyseData[0] . ".json");
        $fileContent = (array) json_decode($file);
        return (!empty($fileContent[$analyseData[1]])) ? $fileContent[$analyseData[1]] : '';
    }
}
