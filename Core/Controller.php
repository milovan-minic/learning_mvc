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

    /**
     * @param string $name
     * @param array $args Arguments passed to the methos
     *
     * @return void
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if(method_exists($this, $method)) {
            if($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            echo "Method $method not found in controller " . get_class($this);
        }
    }

    /**
     * Before filter - called before an action method
     *
     * @return void
     */
    protected function before()
    {

    }

    /**
     * After filter - called after and action method
     *
     * @return void
     */
    protected function after()
    {

    }
}
