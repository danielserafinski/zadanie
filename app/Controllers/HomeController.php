<?php


namespace App\Controllers;

use App\Payment\DateRange;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Payment\BonusRange;
use App\Payment\PaymentRange;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends Controller
{

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {

        $timeZone = new \DateTimeZone('Europe/Warsaw');
        $start = new \DateTime(null, $timeZone);
        $interval = new \DateInterval('P1M');
        $end = new \DateTime('last day of december this year', $timeZone);

        $rangeBonus = new DateRange($start, $interval, $end);
        $rangeBonus->setDateType(new BonusRange());

        $rangePayment = new DateRange($start, $interval, $end);
        $rangePayment->setDateType(new PaymentRange());



        $range = [];


        $rangePaymentDates = $rangePayment->getDates();
        $rangeBonusDates = $rangeBonus->getDates();

        foreach ($rangePaymentDates as $key => $item)
        {
            $range[] = [
                'payment' => $item->format("Y-m-d"),
                'bonus' => (isset($rangeBonusDates[$key]))?$rangeBonusDates[$key]->format("Y-m-d"):''
            ];
        }

        $stream = fopen('php://memory', 'w+');

        foreach ($range as $fields) {
            fputcsv($stream, $fields, ';');
        }

        rewind($stream);

        $response = $response->withHeader('Content-Type', 'text/csv');
        $response = $response->withHeader('Content-Disposition', 'attachment; filename="file.csv"');

        return $response->withBody(new \Slim\Http\Stream($stream));
    }
}