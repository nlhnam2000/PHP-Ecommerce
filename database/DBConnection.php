<?php
class DBConnection
{

    public function __construct()
    {
    }
    public static function getDBConnection()
    {
        static $con = null;
        if ($con === null) {
            // $con = new mysqli(self::$hostname, self::$username, self::$password, self::$dbName);
            $con = new mysqli('localhost', 'root', '', 'Shopping');
            if ($con->connect_error) {
                die("Connection failed " . $con->connect_error);
            }
        }
        return $con;
    }
}
