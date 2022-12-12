
<?php
$root = "../";
require_once('./classes/reg.php');
require_once($root.'classes/user.php');
 


if(User::IsLogged()) {
    echo '<script> 
        alert("Вы уже авторизованы"); 
        window.location.href="'.$root.'";
        </script>';
    die();
}

//ajax 
if(!empty($_POST['userdata'])){
    $arr = json_decode($_POST['userdata']);
    $errorlog = Reg::CheckData($arr);
    if(!$errorlog) 
        Reg::RegisterUser($arr);
    echo $errorlog;
    die();
}


require_once("./regbody.php");
?>