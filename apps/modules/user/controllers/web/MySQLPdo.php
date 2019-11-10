<?php

class MySQLPdo extends PDO{

    function __construct($host, $name, $user, $password)
    {
        try {
            $dsn = "mysql:dbname=". $name .";host=".$host."";
            $databasehandler = new PDO($dsn, $user, $password);
            return $databasehandler;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
            // echo 'Connection failed: ' . $e->getMessage();
        }
    }
}