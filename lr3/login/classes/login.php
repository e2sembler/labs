<?php
require_once ("sql.php");
class Login {

static function LoginFailsCounter(){
    error_log("LoginFailFunc");
    session_start();
    if(!empty($_SESSION['lastfailtime'])){
        if($_SESSION['lastfailtime']+3600<time()){
            $_SESSION['lastfailtime']=time(); 
            $_SESSION['failcount']=0;
        }}
    else {
        error_log("Getting here");
        $_SESSION['lastfailtime']=time();
        $_SESSION['failcount']=0;
    }
        $_SESSION['failcount']++;
    session_write_close();
    error_log("Failcount=".$_SESSION['failcount']);
}

static function TryLimit(){
    session_start();
    error_log("SESSION TIME=".$_SESSION['lastfailtime']); 
    session_write_close();
    if(isset($_SESSION['failcount']) && $_SESSION['lastfailtime'])
        if($_SESSION['failcount']>=3 && $_SESSION['lastfailtime']+3600>time())
            return true;
    return false;
}

static function SuccessLoginSetUp($mail){
    session_start();
    $_SESSION['username']=htmlspecialchars(SQL::GetUserName($mail)); 
    if(isset($_SESSION['lastfailtime']))
    {
        session_unset($_SESSION['lastfailtime']);
        session_unset($_SESSION['failcount']);
    }
    session_write_close();
    error_log($_SESSION['username']);

}

static function LoginTry($mail, $pass){
    if(SQL::MailExists($mail)){
        $hash = SQL::GetPasswordHash($mail); 
        return password_verify($pass,$hash);
    }
    return false;
}

static function Exit(){
    session_destroy(); 
    header("location: ./index.php");
}
}



