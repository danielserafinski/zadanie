<?php


namespace App\Payment;


/**
 * Class DateRange
 * @package App\Payment
 */
class DateRange
{


    private $start;
    private $end;
    private $interval;

    private $dateType;

    /**
     * DateRange constructor.
     * @param \DateTime $start
     * @param \DateInterval $interval
     * @param \DateTime $end
     */
    public function __construct(\DateTime $start, \DateInterval $interval, \DateTime $end)
    {
        $this->start = $start;
        $this->interval = $interval;
        $this->end = $end;
    }


    /**
     * @return RangeInterface
     */
    public function getDateType()
    {
        return $this->dateType;
    }

    /**
     * @param RangeInterface $dateType
     * @return $this
     */
    public function setDateType($dateType)
    {
        $this->dateType = $dateType;
        return $this;
    }

    /**
     * @return array
     */
    public function getDates()
    {
        $period   = new \DatePeriod($this->start->modify('first day of this month'), $this->interval, $this->end);
        $days = [];
        foreach ($period as $dt)
        {
            $days[$dt->format('Ym')] = $this->getDateType()->setDate($dt)->getDay();
        }
        return $days;
    }
}