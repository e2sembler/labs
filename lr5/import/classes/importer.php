<?php
require_once($root.'classes/db.php');
require_once($root.'classes/tableworker.php');
class Importer{

    private static $path = "../uploads/";

    public static function ListItems():array{
        $files = scandir(self::$path);
        return $files;
    }

    private static function CheckFile(string $filename):bool{
        if(preg_match('/(\/)/u',$filename)) 
            return false;
        return file_exists(self::$path.$filename);
    }

    public static function BeginImport(string $filename,int &$added_rows_count,string &$tablename):string{ 
        $error_message="";
        if(self::CheckFile($filename)){
            $file = fopen(self::$path.$filename,'r');
            $tablename = preg_split('/\./u',$filename)[0]."_imported";
            $title_row = fgetcsv($file,9999,";","\r","\n");
            $column_count = count($title_row);
            if($column_count<2) 
                $error_message = "Слишком мало столбцов";
            if(TableWorker::CreateTable($tablename,$title_row)){
                while($row = fgetcsv($file,9999,";","\r","\n")){
                        if(count($row)!=$column_count) 
                            continue;
                        if(TableWorker::AddItem($tablename,$row)) 
                            $added_rows_count++;
                    }
                if($added_rows_count==0) 
                    $error_message="Не было найдено уникальных записей";
                }
            }
        else 
            $error_message = "Отсутствует файл";
        return $error_message;
    }

}
?>