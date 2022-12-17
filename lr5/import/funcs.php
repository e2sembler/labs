<?php 

function SkipEncodingRow(&$file):void{
    fgetcsv($file,9999,";","\r","\n");
}
?>