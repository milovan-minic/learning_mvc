<?php

namespace Core;

use ErrorException;
use \App\Config;

/**
 *  Error and exception handler
 *
 *  PHP Version 5.5.9
 */

/**
 * Class Error
 * @package Core
 */
class Error
{
    /**
     *  Error handler.
     *  Converts all errors to Exceptions by throwing and ErrorException.
     *
     * @param int       $level      Error level
     * @param string    $message    Error message
     * @param string    $file       File name the error was raised in
     * @param int       $line       Line number in the file
     *
     * @throws ErrorException
     *
     * @return void
     */
    public static function errorHandler($level, $message, $file, $line)
    {
        if(error_reporting() !== 0) { // to keep the @ operator working
            throw new ErrorException($message, 0, $level, $file, $line);
        }
    }

    public static function exceptionHandler($exception)
    {
        if (Config::SHOW_ERRORS) {
            echo '<h1>Fatal error</h1>';
            echo '<p>Uncaught exception: \'' . get_class($exception) . '\'</p>';
            echo '<p>Message: \'' . $exception->getMessage() . '\'</p>';
            echo '<p>Stack trace:<pre>' . $exception->getTraceAsString() . '</pre></p>';
            echo '<p>Thrown in  \'' . $exception->getFile() . '\' on line ' .
                $exception->getLine() . '\'</p>';
        } else {
            $log = dirname(__DIR__) . '/logs/' . 'ErrorLog_' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = 'Uncaught exception: \'' . get_class($exception) . '\'';
            $message .= ' with message \'' . $exception->getMessage() . '\'';
            $message .= '\nStack trace: ' . $exception->getTraceAsString();
            $message .= '\nThrown in \'' . $exception->getFile() . '\' on line ' .
                $exception->getLine();

            error_log($message); // TODO: Check why custom error file is not created

            echo '<h1>An error occurred!</h1>';
        }
    }
}
