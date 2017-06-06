<?php

/**
 * Description of Logs
 *
 * @author png
 */
define("DEFAULT_LOG","/home/png/Desktop/default.log");

class Logs {

//    http://web.stanford.edu/dept/its/communications/webservices/wiki/index.php/How_to_create_logs_with_PHP
    function write_mysql_log($message, $db) {
        // Check database connection
        if (($db instanceof MySQLi) == false) {
            return array(status => false, message => 'MySQL connection is invalid');
        }

        // Check message
        if ($message == '') {
            return array(status => false, message => 'Message is empty');
        }

        // Get IP address
        if (($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
            $remote_addr = "REMOTE_ADDR_UNKNOWN";
        }

        // Get requested script
        if (($request_uri = $_SERVER['REQUEST_URI']) == '') {
            $request_uri = "REQUEST_URI_UNKNOWN";
        }

        // Escape values
        $message = $db->escape_string($message);
        $remote_addr = $db->escape_string($remote_addr);
        $request_uri = $db->escape_string($request_uri);

        // Construct query
        $sql = "INSERT INTO my_log (remote_addr, request_uri, message) VALUES('$remote_addr', '$request_uri','$message')";

        // Execute query and save data
        $result = $db->query($sql);

        if ($result) {
            return array(status => true);
        } else {
            return array(status => false, message => 'Unable to write to the database');
        }
    }

    // Filename of log to use when none is given to write_log

    /**
     * write_log($message[, $logfile])
     *
     * Author(s): thanosb, ddonahue
     * Date: May 11, 2008
     * 
     * Writes the values of certain variables along with a message in a log file.
     *
     * Parameters:
     *  $message:   Message to be logged
     *  $logfile:   Path of log file to write to.  Optional.  Default is DEFAULT_LOG.
     *
     * Returns array:
     *  $result[status]:   True on success, false on failure
     *  $result[message]:  Error message
     */
    function write_log($message, $logfile = '') {
        // Determine log file
        if ($logfile == '') {
            // checking if the constant for the log file is defined
            if (defined(DEFAULT_LOG) == TRUE) {
                $logfile = DEFAULT_LOG;
            }
// the constant is not defined and there is no log file given as input
            else {
                error_log('No log file defined!', 0);
                return array(status => false, message => 'No log file defined!');
            }
        }

// Get time of request
        if (($time = $_SERVER['REQUEST_TIME']) == '') {
            $time = time();
        }

// Get IP address
        if (($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
            $remote_addr = "REMOTE_ADDR_UNKNOWN";
        }

// Get requested script
        if (($request_uri = $_SERVER['REQUEST_URI']) == '') {
            $request_uri = "REQUEST_URI_UNKNOWN";
        }

// Format the date and time
        $date = date("Y-m-d H:i:s", $time);

// Append to the log file
        if ($fd = @fopen($logfile, "a")) {
            $result = fputcsv($fd, array($date, $remote_addr, $request_uri, $message));
            fclose($fd);

            if ($result > 0)
                return array(status => true);
            else
                return array(status => false, message => 'Unable to write to ' . $logfile . '!');
        }
        else {
            return array(status => false, message => 'Unable to open log ' . $logfile . '!');
        }
    }

}
