<?php

namespace App\Controllers;

use \Core\Controller;
use \Core\View;

/**
 *  Home Controller
 *
 *  PHP Version 5.5.9
 */

class Home extends Controller
{
    /**
     * Before filter
     *
     * return void
     */
    protected function before()
    {
//        echo '(Before) ';

        /**
         * By returning false from before method, the originally called method will not be executed.
         * This is handy to check, for example, if user has been logged in or not, or have
         * correct permissions.
         *
         * Also very useful for authentication.
         */
//        return false;
    }

    /**
     * After filter
     *
     * return void
     */
    protected function after()
    {
//        echo ' (After)';
    }

    /**
     *  Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
//        echo 'Hello from the index action in the Home controller';
//        View::render('Home/index.php', [
//            'name'      =>  'Dave',
//            'colours'   =>  ['red', 'green', 'blue']
//        ]);
        View::renderTemplate('Home/index.html', [
            'name'      =>  'Dave',
            'colours'   =>  ['red', 'green', 'blue']
        ]);
    }
}