<?php

namespace Core;

/**
 * Base Controller
 *
 * PHP Version 5.5.9
 *
 * Class Controller
 * @package Core
 */
abstract class Controller
{
    /**
     * Parameters from the matched route
     *
     * @var array
     */
    protected $_routeParams = [];

    /**
     * Class constructor
     *
     * @param array $routeParams Parameters from the route
     */
    public function __construct($routeParams)
    {
        $this->_routeParams = $routeParams;
    }
}
