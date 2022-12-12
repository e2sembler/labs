
<head>
<link rel="stylesheet" href="<?=$root?>styles/header.css">
<link rel="stylesheet" href="<?=$root?>styles/footer.css"> 
<link rel="stylesheet" href="./css/login.css">
<script type="text/javascript" src="./js/login.js"></script>
<meta charset="utf-8">
<link rel="icon" href="<?=$root?>./images/favicon.png" type="image/png">
<title>Авторизация</title>
</head>
<html>
<body>
<?php require_once ($root.'header.php');?> 

<div id="randomname"> 
<div id = reglog>
    <a href="./reg.php">Регистрация</a>
    <p>/</p>
    <a>Вход</a></div>
<form id="logform">
    <table>
    <tr><td><p>Почта</p></td>
    <td><input id="flogin" onfocusout="CheckMail()">
    <div></div>
    </td></tr>
    <tr><td><p>Пароль</p></td>
    <td id="passtd">
        <input type="password" id="fpass1">
        <div>  
        </div>
    </td></tr> 
</table>
</form> 
<button id="login" class="orange-btn" onclick="Login()">Войти</button>
</div>

<?php require_once ($root.'footer.php');?>
</body>
</html>