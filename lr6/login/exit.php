<?php 
require_once("../classes/user.php");
if(User::IsLogged()){
    session_start();
    session_destroy();
}
header("Location: ./login.php");
?>
