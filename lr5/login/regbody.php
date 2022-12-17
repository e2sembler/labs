
<head>
<link rel="stylesheet" href="<?=$root?>styles/header.css">
<link rel="stylesheet" href="<?=$root?>styles/footer.css"> 
<link rel="stylesheet" href="./css/reg.css">
<script type="text/javascript" src="./js/reg.js"></script>
<meta charset="utf-8">
<link rel="icon" href="<?=$root?>images/favicon.png" type="image/png">
<title>Регистрация</title>
</head>
<html>
<body> 
<?php require_once ($root.'header.php');?>  
<div id="randomname"> 
<div id = reglog>
    <a>Регистрация</a>
    <p>/</p>
    <a href="./login.php">Вход</a></div>
<form id="regform">
    <table>
    <tr><td><p>Почта</p></td>
    <td><input id="flogin" onfocusout="CheckMail()">
    <div></div>
    </td></tr>
    <tr><td><p>Пароль</p></td>
    <td id="passtd">
        <input type="password" id="fpass1" onfocusout="CheckPass()">
        <div>  
        </div>
    </td></tr>
    <tr><td><p>Повторите пароль</p></td>
    <td id="passtd2"><input type="password" onfocusout="CheckPass2()">
    <div></div>
</td></tr>

    <tr><td><p>Фамилия</p></td>
<td><input id="ffamily"></input></tr></td>
    <tr>
        <td>
    <p>Имя</p> </td>
    <td>
    <input id="fname"></input></td></tr>
    <tr><td>
    <p>Отчество</p></td>
    <td><input id="ffather"></input></td></tr>
    <tr><td>
    <p>Адрес</p></td>
    <td><input id="fadress"></input></td></tr>
    <tr><td>
    <p>Пол</p></td>
    <td><input id="fsex"></input></td></tr>
    <tr><td>
    <p>Интересы</p></td>
    <td><input id="finterests"></input></td></tr>
    <tr><td>
    <p>Vk профиль</p></td>
    <td><input id="fvk"></input></td></tr>
    <tr><td>
    <p>Группа крови</p></td>
    <td><input id="fblood"></input></td></tr>
    <tr><td>
    <p>Резус</p></td>
    <td><input id="fresus"></input></td></tr>
</table>
</form> 
<button id="register" class="orange-btn" onclick="Register()">Зарегистрироваться</button>
</div>
<?php require_once ($root.'footer.php');?>
</body>
</html>