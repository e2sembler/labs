<?php 
const conn = 'mysql:host=localhost;dbname=store';
const user = 'root';
const pass = '1'; 

class SQL{


    static function Querier($query, $args)
    {
        $db = new PDO(conn,user,pass); 
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $exec = $db->prepare($query); 
        $exec->execute($args);
        $res = $exec->fetch();
        $db=null; 
       if(is_array($res)){
        if(!empty($res)) return $res[0]; 
            else return null;
       }
       else {
        error_log($res);
        return $res;
       }
    }


    static function GetPasswordHash($mail){
        $query = "SELECT password FROM users WHERE mail=?";
        $args = [$mail];
        return SQL::Querier($query, $args);
    }

    static function MailExists($mail){
        error_log("Mailexists func \n");
        $query = "SELECT mail FROM users WHERE mail=?";
        $args = [$mail];
        $value =  SQL::Querier($query,$args);
        error_log("count=".$value."\n");
        return $value==$mail;
    }

    static function CreateUser($arr){   
        $query = "INSERT INTO users VALUES (default,?,?,?,?,?,?,?,?,?,?,?)";
        $arr[1] = password_hash($arr[1],PASSWORD_DEFAULT);
        SQL::Querier($query, $arr);
    }

    static function GetUserName($mail){
        $query = "SELECT name FROM users where mail=?";
        $args = [$mail];
        return SQL::Querier($query,$args);
    }

}
?>