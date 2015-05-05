<?php

namespace Kouz;

use DateTime;

class Greeter
{
    protected $dateTime;

    public function __construct()
    {
        $this->dateTime = new DateTime();
    }

    public function greetUser()
    {
        $hour = $this->dateTime->format('H');
        $greeting = "Good evening";

        if ($this->isMorning($hour)) {
            $greeting = "Good morning";
        } 
        
        if ($this->isAfternoon($hour)) {
            $greeting = "Good afternoon";
        } 

        return $greeting;
    }

    protected function isAfternoon($hour)
    {
        return ($hour >= 12 && $hour < 17);
    }

    protected function isMorning($hour)
    {
        return ($hour >= 5 && $hour < 12);
    }

    public function setDateTime(DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }
}
