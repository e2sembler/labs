<?php
require_once('../classes/db.php');
require_once('../classes/tableworker.php');

class Exporter{
     
    private static $filename = 'items_exported.csv';
    private static $filepath = '../uploads/';

    public static function PrepareFile():string{
        $file = fopen(self::$filepath.self::$filename,'w');
        //fwrite($file, pack("CCCC", 0xef, 0xbb, 0xbf,'\n'));
        $arr = TableWorker::GetColumnNames("Items");
        fputcsv($file,$arr,";","\"","\\","\n");
        $arr = TableWorker::GenerateData(); 
        $i=0;
        for(;$i<count($arr);$i++){
            fputcsv($file,$arr[$i],";","\"","\r","\n");
        } 
        fclose($file);
        return self::$filename;        
    }
}
?>