<?php

namespace App\Controllers;

use \Core\Controller;
use \Core\View;
use \App\Models\Post;

/**
 *  Posts Controller
 *
 *  PHP Version 5.5.9
 */

class Posts extends Controller
{

    /**
     *  Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $posts = Post::getAll();
        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
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
