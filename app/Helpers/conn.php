<?php

namespace App\Helpers;

define('DIR_VENDOR', __DIR__.'/vendor/');
$dotenv = new Dotenv\Dotenv(__DIR__);

class Connect{
    private $dbName;
    private $server; 
    private $usr; 
    private $psd; 
    private $conn;

    function _construct(){
        $dbName = "blogged";
        $server = "127.0.0.1";
        $usr = "root";
        $psd = "ibanezgio";
    }

    function connectDb(){
        $conn = mysqli_connect($server, $usr, $psd, $dbName);

        if(!$conn) {
            echo 'could not connect';
            return 0;
        }
        return $conn;
    }

    function closeDbConnection(){
        try{
            mysqli_close($conn);
        }catch(Exception $e){
            echo 'Error: '.$e;
        }
    }

    function _destruct(){

    }
}
