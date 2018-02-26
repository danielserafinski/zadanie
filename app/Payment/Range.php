<?php

namespace App\Payment;

/**
 * Class DateRange
 * @package App\Payment
 */
abstract class Range implements RangeInterface
{

    private $date;


    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }



    abstract public function getDay();
}