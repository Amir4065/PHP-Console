<?php

namespace App\Utl;

use App\Utl\Utility;

class DateCalculation
{
    private object $dateObj;
    private string $formating;
    private string $lastDayOfMounth;
    private object $language;
    private string $middleDayOfMonth;

    public function __construct()
    {
        $this->formating = "j-M-Y l";
        $this->language = new Utility();
    }

    /**
     * @param int $month
     * @return string
     * @throws \Exception
     */
    public function calculateDateOfSalary(int $month): string
    {
        $this->dateObj = new \DateTime("last day of this month");

        if ($month > 0) {
            $this->dateObj->modify("last day of +$month month");
        }

        if (strpos($this->dateObj->format($this->formating), $this->language->lang("app.sunday")) > 0) {
            $this->dateObj->sub(new \DateInterval("P2D"));       
        }

        if (strpos($this->dateObj->format($this->formating), $this->language->lang("app.saturday")) > 0) {
            $this->dateObj->sub(new \DateInterval("P1D"));
        }
        $this->lastDayOfMounth = $this->dateObj->format($this->formating);
        return $this->lastDayOfMounth;
    }

    /**
     * @param int $month
     * @return string
     * @throws \Exception
     */
    public function calculateDateOfBouns(int $month): string
    {
        $internalFormatting = "m j Y";
        $this->dateObj = new \DateTime();
        $this->dateObj->modify("$month month");
        $current = $this->dateObj->format($internalFormatting);
        $dateAnalyse = explode(" ", $current);
        $this->dateObj = new \DateTime("$dateAnalyse[0]/15/$dateAnalyse[2]");
        if (strpos($this->dateObj->format($this->formating), $this->language->lang("app.sunday")) > 0) {
            $this->dateObj->add(new \DateInterval("P3D"));
        }

        if (strpos($this->dateObj->format($this->formating), $this->language->lang("app.saturday")) > 0) {
            $this->dateObj->add(new \DateInterval("P4D"));
        }
        $this->middleDayOfMonth = $this->dateObj->format($this->formating);
        return $this->middleDayOfMonth;
    }

    public function reloadNameOfDate(int $month): string
    {
        $internalFormat = "F";
        $this->dateObj = new \DateTime();
        if ($month > 0) {
            $this->dateObj->modify("$month month");
        }
        return $this->dateObj->format($internalFormat);
    }
}
