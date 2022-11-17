<?php 
//5 9 15 17 
require_once("./preset.php");
require_once("./funcs.php");

if(!empty($_GET["preset"])){
    $i = $_GET["preset"]; 
    if($i==1)
        echo Kpreset1;
    if($i==2)
        echo Kpreset2;
    if($i==3)
        echo Kpreset3;
    die();
}
 
if(!empty('php://input')){
$postData = file_get_contents('php://input'); 
$data = json_decode($postData, true); 
if(!empty($data['inputarea'])){
    $text = $data['inputarea']; 
    $text = DoTheStuffIamTheStuff($text);
    echo $text;
    die();
}
}

?>