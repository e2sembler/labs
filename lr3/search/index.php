<?php $root="../";   
require_once ($root."classes/user.php");
if(!User::IsLogged())
  Header("Location: ".$root."login/");
?>
<head>
    <link rel="stylesheet" href="<?=$root?>styles/header.css">
    <link rel="stylesheet" href="<?=$root?>styles/footer.css">
    <link rel="stylesheet" href="./search.css">
    <meta charset="utf-8">
    <link rel="icon" href="./images/favicon.png" type="image/png">
    <script type="text/javascript" src="./search-filter.js"></script>
    <title>Поиск</title>
</head>
<html>  
  <body>
  <?php require_once ($root.'header.php');?> 
  <?php require_once ('body.php');?>
  <?php require_once ($root.'footer.php');?>
  </body>
</html>