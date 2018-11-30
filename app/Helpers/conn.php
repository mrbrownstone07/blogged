<?php



class Connect{
    var $conn;
    public function _construct(){

    }

    public static function connectDb(){
        $conn = mysqli_connect("127.0.0.1", "root", "ibanezgio", "blogged");

        if(!$conn) {
            echo 'could not connect';
            return 0;
        }
        return $conn;
    }

    public static function closeDbConnection(){
        try{
            mysqli_close($conn);
        }catch(Exception $e){
            echo 'Error: '.$e;
        }
    }

    public static function _destruct(){

    }
}
