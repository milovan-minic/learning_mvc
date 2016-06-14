<?php

namespace Core;

/**
 *  Router
 *
 *  PHP Version 5.5.9
 */

class Router
{
    /**
     * Associative array of routes (the routing table)
     *
     * @var array
     */
    protected $_routes = [];

    /**
     * Parameters from the matched routes
     *
     * @var array
     */
    protected $_params = [];

    /**
     * Add the route to the routing table
     *
     * @param string    $route  The route URL
     * @param array     $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->_routes[$route] = $params;
    }

    /**
     * Get all the routes from the routing table
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->_routes;
    }

    /**
     * Match the route to the routes in the routing table, setting the $params
     * property if a route is found
     *
     * @param string    $url The route URL
     *
     * @return bool     true if match is found, false otherwise
     */
    public function match($url)
    {
//        foreach ($this->_routes as $route => $params) {
//            if($url == $route) {
//                $this->_params = $params;
//                return true;
//            }
//        }

        // Match to the fixed URL format /controller/action
//        $regExp = '/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/';

        foreach($this->_routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
//                $params = [];

                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->_params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Get currently matched parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * Dispatch the route, creating the controller object and running
     * the action method
     *
     * @param string $url The route URL
     *
     * @return void
     */
    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);

        if($this->match($url)) {
            $controller = $this->_params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = "App\Controllers\\$controller";

            if(class_exists($controller)) {
                $controllerObject = new $controller();

                $action = $this->_params['action'];
                $action = $this->convertToCamelCase($action);

                if(is_callable([$controllerObject, $action])) {
                    $controllerObject->$action();
                } else {
                    echo "Method $action (in controller $controller) not found";
                }
            } else {
                echo "Controller class $controller not found";
            }
        } else {
            echo 'No route matched';
        }
    }

    /**
     * Convert the string with hyphens to StudlyCaps
     * e.g. post-authors => PostAuthors
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    public function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * Convert string with hyphens to camelCase
     * e.g. add-new => addNew
     *
     * @param string $string String to convert
     *
     * @return string
     */
    public function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
     * ===============================================================================
     *      URL                     |   $_SERVER['QUERY_STRING']    |   Route
     * ===============================================================================
     * localhost                        ''                              ''
     * localhost/?                      ''                              ''
     * localhost/?page=1                'page1'                         ''
     * localhost/posts?page=1           'posts&page=1'                  'posts'
     * localhost/posts/index            'posts/index'                   'posts/index'
     * localhost/posts/index?page=1     'posts/index&page=1'            'posts/index'
     * ===============================================================================
     *
     * A URL of the format localhost/?page (one variable name, no value) won't work
     * however. (NB. The .htaccess file converts the first ? to a & when it's passed
     * through to the $_SERVER variable).
     *
     * @param string $url The full URL
     *
     * @return string The URL with the query string variables removed
     */
    protected function removeQueryStringVariables($url)
    {
        if($url != '') {
            $parts = explode('&', $url, 2);

            if(strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }
}
