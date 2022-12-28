<?php 
$root = "../";
require_once('./classes/importer.php');
require_once("../classes/tableworker.php");
require_once("./classes/echoslam.php");
if($_GET['importfile']){
    $added_count=0;
    $updated_count=0;
    $skipped_count=0;
    $tablename = "";
    $error_message = Importer::BeginImport($_GET['importfile'],$added_count,$skipped_count,$updated_count, $tablename); 
    if($added_count>0||$updated_count>0||$skipped_count>0){
        echo $added_count." записей было добавлено ".$updated_count.", было обновлено ".$skipped_count.
        ", было пропущено в ".$tablename;
        EchoSlam::DrawHeader($tablename);
        $rows = TableWorker::GetItems($tablename);
        EchoSlam::DrawRows($rows);
    } 
    else
        echo $error_message;
        
    die();
}
?>