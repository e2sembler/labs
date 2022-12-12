<?php $root="../";   
require_once ($root."classes/user.php");
?>
<head>
    <link rel="stylesheet" href="<?=$root?>styles/header.css">
    <link rel="stylesheet" href="<?=$root?>styles/footer.css">
    <link rel="stylesheet" href="./style.css">
    <meta charset="utf-8">
    <link rel="icon" href="./images/favicon.png" type="image/png">
    <script type="text/javascript" src="./funcs.js"></script>
    <title>CRUD</title>
</head>
<html>  
  <body>
  <?php require_once ($root.'header.php');?> 
  <?php require_once ('body.php');?>
  <?php require_once ($root.'footer.php');?>
  </body>
</html>