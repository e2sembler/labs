<?php  
require_once("./classes/sql.php");
if(isset($_POST["fmail"]))
{
    error_log("Mail check");
    if (!filter_var($_POST["fmail"], FILTER_VALIDATE_EMAIL))
        echo "<p>Неверный формат почты</p>";
    else if(SQL::MailExists($_POST["fmail"]))
        echo "<p>Такая почта уже существует</p>";
    die();
}
if(isset($_POST["loginmail"]))
{
    error_log("Mail check");
    if (!filter_var($_POST["loginmail"], FILTER_VALIDATE_EMAIL))
        echo "<p>Неверный формат почты</p>";
    die();
}



//не используется
if(isset($_POST["fpass2"]) && isset($_POST["fpass1"])){
    if($_POST["fpass2"]!=$_POST["fpass1"])  
    echo ("<p>Пароли не совпадают</p>"); 
    die();
}

if(isset($_POST["fpass1"])){
    $value = $_POST["fpass1"]; 
    if(strlen($value)<=6)
    echo("<p>Должен содержать больше 6 символов</p>");
    if(!preg_match("#[A-Z]#",$value))
    echo("<p>Должен содержать большие латинские буквы</p>");
    if(!preg_match("#[a-z]#",$value))
    echo ("<p>Должен содержать маленькие латинские буквы</p>"); 
    if(preg_match("#[А-Яа-я]#",$value))
    echo ("<p>Кириллица запрещена</p>"); 
    if(!preg_match("#[0-9]#",$value)) 
    echo ("<p>Должен содержать цифры</p>");
    if(!preg_match("#\s#",$value))
    echo ("<p>Должен содержать пробел</p>");
    if(!preg_match("#\_#",$value))
    echo("<p>Должен содержать подчеркивание</p>");
    if(!preg_match("#\-#",$value))
    echo("<p>Должен содержать дефис</p>");
    if(!preg_match("#\+|\*|\?|\^|\.|\[|\]|\{|\}|\(|\)|\||\/#",$value)) 
    echo("<p>Должен содержать спецсимвол</p>");
    die();
 }
?>