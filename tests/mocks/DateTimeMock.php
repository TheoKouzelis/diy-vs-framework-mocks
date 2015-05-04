<?php 

namespace Kouz\Mocks;

use DateTime;

class DateTimeMock extends DateTime
{
    public $formatReturn = 1;
    public $formatHistory = [];

    public function format($format)
    {
        $this->formatHistory[] = $format;

        return $this->formatReturn;
    }
}
