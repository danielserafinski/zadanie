<?php
namespace App\Payment;


/**
 * Class Bonus
 * @package App\Payment
 */
class BonusRange extends Range implements RangeInterface
{
    /**
     * @return \DateTime
     */

    public function getDay()
    {

        $date = $this->getDate();
        $date->modify('next month');
        $date->modify('+14 days');

        switch ($date->format('N'))
        {
            case 6:
            case 7:
                $date->modify('next wednesday');
                break;
        }

        return $date;
    }

}