<?php

namespace Database;

class DB{
    private static $sname = 'localhost',
        $uname = 'root',
        $password = '',
        $db_name = 'testusers',
        $connection;

    public static function connect(){
        self::$connection = mysqli_connect(self::$sname,self::$uname,self::$password,self::$db_name);

        if(!self::$connection){
            echo 'Connection failed!';die;
        }
        return self::$connection;

    }

    public function query($sql = ""){
        try {
            return self::$connection->query($sql);
        } Catch(Exception $e) {
            var_dump($e->getMessage()); die;
        }
    }
}