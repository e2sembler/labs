<?php 

require_once("sql.php");
Class Reg{
    static function RegisterUser($userinfo){  
        $repeatedpassword = 2;
        array_splice($userinfo,$repeatedpassword,1);
        SQL::CreateUser($userinfo);
    }

    static function CheckData($arr){
        $mail = $arr[0];
        $errors="";
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
            $errors.="неверный формат почты\n";
        if(SQL::MailExists($mail)==$mail)
            $errors.="такая почта уже существует\n";
        $pass1=$arr[1];
        if(strlen($pass1)<=6)
            $errors.="пароль должен содержать больше 6 символов\n";
        if(!preg_match("#[A-Z]#",$pass1))
            $errors.="пароль должен содержать большие латинские буквы\n";
        if(!preg_match("#[a-z]#",$pass1))
            $errors.="пароль должен содержать маленькие латинские буквы\n"; 
        if(preg_match("#[А-Яа-я]#",$pass1))
            $errors.="пароль Кириллица запрещена\n"; 
        if(!preg_match("#[0-9]#",$pass1)) 
            $errors.="пароль должен содержать цифры\n";
        if(!preg_match("#\s#",$pass1))
            $errors.="пароль должен содержать пробел\n";
        if(!preg_match("#\_#",$pass1))
            $errors.="пароль должен содержать подчеркивание\n";
        if(!preg_match("#\-#",$pass1))
            $errors.="пароль должен содержать дефис\n";
        if(!preg_match("#\+|\*|\?|\^|\.|\[|\]|\{|\}|\(|\)|\||\/#",$pass1)) 
            $errors.="пароль должен содержать спецсимвол\n";
        $pass2=$arr[2];
        if($pass1!=$pass2)
            $errors.="пароли не совпадают\n";
        return $errors;
    }

}
?>