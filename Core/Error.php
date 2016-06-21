<?php

namespace Core;

use ErrorException;

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
        echo '<h1>Fatal error</h1>';
        echo '<p>Uncaught exception: \'' . get_class($exception) . '\'</p>';
        echo '<p>Message: \'' . $exception->getMessage() . '\'</p>';
        echo '<p>Stack trace:<pre>' . $exception->getTraceAsString() . '</pre></p>';
        echo '<p>Thrown in  \'' . $exception->getFile() . '\' on line ' .
            $exception->getLine() . '\'</p>';
    }
}
