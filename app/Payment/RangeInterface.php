<?php


namespace App\Payment;


/**
 * Interface RangeInterface
 * @package App\Payment
 */
interface RangeInterface
{

    public function getDay();
    public function getDate();

    /**
     * @param $date
     * @return mixed
     */
    public function setDate($date);
}