<?php
namespace App\Payment;

/**
 * Class Payment
 * @package namespace App\Payment;
 */
class PaymentRange extends Range implements RangeInterface
{
    /**
     * @return \DateTime
     */
    public function getDay()
    {

        $date = $this->getDate();

        $date->modify('last day of this month');

        switch ($date->format('N'))
        {
            case 6:
            case 7:
                $date->modify('last friday');
                break;
        }

        return $date;
    }
}