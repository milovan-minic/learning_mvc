<?php

namespace App\Controllers;

/**
 *  Posts Controller
 *
 *  PHP Version 5.5.9
 */

class Posts extends \Core\Controller
{

    /**
     *  Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        echo 'Hello from index action in the Posts Controller!';
//        echo '<p>Query string parameters: <pre>' .
//            htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
    }

    /**
     *  Show the add new page
     *
     * @return void
     */
    public function addNewAction()
    {
        echo 'Hello from addNew action in the Posts Controller!';
    }


    public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller';
        echo '<p>Route parameters: <pre>' .
            htmlspecialchars(print_r($this->_routeParams, true)) . '</pre></p>';
    }
}
