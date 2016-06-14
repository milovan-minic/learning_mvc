<?php

namespace App\Controllers;

/**
 *  Home Controller
 *
 *  PHP Version 5.5.9
 */

class Home extends \Core\Controller
{
    /**
     * Before filter
     *
     * return void
     */
    protected function before()
    {
        echo 'Before ';
    }

    /**
     * After filter
     *
     * return void
     */
    protected function after()
    {
        echo ' After';
    }

    /**
     *  Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        echo 'Hello from the index action in the Home controller';
    }
}