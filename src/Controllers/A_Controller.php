<?php

namespace MovieApi\Controllers;

use DI\Container;

abstract class A_Controller
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }   
}
