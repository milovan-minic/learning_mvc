<?php

namespace App\Controllers\Admin;
use Core\Controller;

/**
 * User Admin controller
 *
 * PHP Version 5.5.9
 */

class Users extends Controller
{
    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        // Make sure admin is logged in for example
        // return false;
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {

    }

    public function index()
    {
        echo 'Admin user index';
    }
}
