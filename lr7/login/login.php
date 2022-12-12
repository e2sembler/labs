
<?php $root = "../";
require_once('./classes/login.php');
require_once($root.'classes/user.php');


if(User::IsLogged()) {
    echo '<script> 
        alert("Вы уже авторизованы"); 
        window.location.href="'.$root.'";
        </script>';
    die();
} 

if(!empty($_POST['mail'])&&!empty($_POST['pass'])){
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    if(Login::TryLimit()){
        echo "Превышено количество попыток";
        die();
    }
    if(Login::LoginTry($mail,$pass))
        Login::SuccessLoginSetUp($mail);
    else{
        echo "Неверные данные";
        Login::LoginFailsCounter();
    }
    die();
}


require_once("loginbody.php"); 
?>