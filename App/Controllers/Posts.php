<?php

namespace App\Controllers;

/**
 *  Posts Controller
 *
 *  PHP Version 5.5.9
 */

class Posts {

    /**
     *  Show the index page
     *
     * @return void
     */
    public function index()
    {
        echo 'Hello from index action in the Posts Controller!';
    }

    /**
     *  Show the add new page
     *
     * @return void
     */
    public function addNew()
    {
        echo 'Hello from addNew action in the Posts Controller!';
    }
}
