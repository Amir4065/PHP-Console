<?php
namespace App\Run;

use App\Utl\Utility;
use App\Input\File;
use App\Input\InputStream;
use App\Utl\DateCalculation;

class Run
{
    private object $language;
    private array $fileContent = [];

    /**
     * Run constructor.
     */
    public function __construct()
    {
        $this->language = new Utility();
    }

    /**
     * @param array $argument
     */
    public function init(array $argument)
    {
        $input = new InputStream();
        $fileName = $input->inputFromConsole($argument);
        $extension = $this->explodeFileName($fileName);
        $fileContent = $this->createContent();
        $file = new File($extension, "files");
        $file->init();
        $file->writeToCsvFile($fileContent);
        $file->close();
    }

    /**
     * @param String $fileName
     * @return bool
     */
    public function explodeFileName (String $fileName): string
    {
        $position = strpos($fileName, $this->language->lang("app.file_extension"));
        if ($position > 0) {
            $file = explode (".", $fileName);
            return $file[0];
        }
        return $fileName;
    }

    /**
     * @return array
     */
    public function createContent(): array
    {
        $header = ['month name', 'salary payment date', 'bouns payment date'];
        array_push($this->fileContent, $header);
        $dataObj = new DateCalculation();

        for ($i = 0; $i <= 12; $i++) {
            /** @var TYPE_NAME $dataObj */
            $fileRow = [
                $dataObj->reloadNameOfDate($i),
                $dataObj->calculateDateOfSalary($i),
                $dataObj->calculateDateOfBouns($i)
            ];
            array_push($this->fileContent, $fileRow);
        }
        return $this->fileContent;
    }
}