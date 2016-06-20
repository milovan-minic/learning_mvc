<?php

namespace Core;

/**
 *  View
 *
 *  PHP Version 5.5.9
 */

class View
{
    /**
     *  Render a view file
     *
     * @param string $view The view file
     *
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view"; // Relative to Core directory

        if(is_readable($file)){
            require $file;
        } else {
            echo "$file not found";
        }
    }

    /**
     * Render a view template using Twig
     *
     * @param string    $template   The template file
     * @param array     $args       Associative array of data to be displayed in the view (optional)
     *
     * @return void
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if($twig === null) {
            $loader = new \Twig_Loader_Filesystem('../App/Views');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template, $args);
    }
}
