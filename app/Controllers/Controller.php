<?php
namespace App\Controllers;

use Psr\Container\ContainerInterface;

/**
 * Class Controller
 * @package App\Controllers
 */
class Controller
{

    protected $container;


    /**
     * Controller constructor.
     * @param $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

}