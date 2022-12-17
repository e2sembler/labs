<?php 
$root = "../";
require_once('./classes/importer.php');
require_once("../classes/tableworker.php");
require_once("./classes/echoslam.php");
if($_GET['importfile']){
    $added_rows_count=0;
    $tablename = "";
    $error_message = Importer::BeginImport($_GET['importfile'],$added_rows_count, $tablename); 
    if($added_rows_count>0){
        echo $added_rows_count." записей было добавлено в ".$tablename;
        EchoSlam::DrawHeader($tablename);
        $rows = TableWorker::GetItems($tablename);
        EchoSlam::DrawRows($rows);
    } 
    else
        echo $error_message;
        
    die();
}
?>