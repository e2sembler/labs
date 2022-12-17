<?php 
require_once('./classes/exporter.php');

if($_GET['download']){
    $file = '../uploads/'.Exporter::PrepareFile();
    header("Content-Type: text/csv"); 
    header("Content-Disposition: attachment; filename=\"". basename($file) ."\""); 
    readfile ($file);
    exit();
}
?>