<?php
require_once($root.'classes/db.php');
require_once($root.'classes/tableworker.php');
class Importer{

    private static $path = "../uploads/";
    private static $added_count;
    private static $skipped_count;
    private static $updated_count;
    private static $column_count;

    public static function ListItems():array{
        $files = scandir(self::$path);
        return $files;
    }

    private static function CheckFile(string $filename):bool{
        if(preg_match('/(\/)/u',$filename)) 
            return false;
        return file_exists(self::$path.$filename);
    }

    private static function CheckColumns(string $tablename,array $file_columns):bool{
        $db_colums = TableWorker::GetColumnNames($tablename);
        if(count($db_colums)-1!=count($file_columns)) return false;
        for($i=0; $i<count($file_columns);$i++){
            if($db_colums[$i]!=$file_columns[$i]) return false;
        }
        return true;
    }
 
    private static function GenerateHash(array $arr):string{
        $tmp="";
        foreach($arr as $column) 
            $tmp.=$column;
        return crc32($tmp);
    }

    private static function ImportToNewTable(&$file, string $tablename):void{
        while($row = fgetcsv($file,9999,";","\r","\n")){
            if(count($row)!=self::$column_count){
                self::$skipped_count++;
                continue;
            }
            array_push($row,self::GenerateHash($row));
            if(TableWorker::AddItem($tablename,$row)) 
                self::$added_count++;
        }
    }

    private static function ImportToExistingTable(&$file, string $tablename):void{
        while($row = fgetcsv($file,9999,";","\r","\n")){
            if(count($row)!=self::$column_count){
                self::$skipped_count++;
                continue;
            }
            array_push($row,self::GenerateHash($row));
            if(TableWorker::HasSameId($tablename,$row[0]))
                if(TableWorker::HasDuplicateData($tablename,$row[0],$row[count($row)-1])){
                    self::$skipped_count++;
                    continue;
                }
                else {
                    if(TableWorker::UpdateItem($tablename,$row[0],$row));
                    self::$updated_count++;
                }
            else {
                if(TableWorker::AddItem($tablename,$row)) 
                self::$added_count++;
            }
        }
    }

/**
 * @return ?string error message
 */
    public static function BeginImport(string $filename,int &$added_count, 
    int &$skipped_count, int &$updated_count,string &$tablename):?string{  
        self::$added_count=0;
        self::$skipped_count=0;
        self::$updated_count=0; //если статик работает как в С-подобных
        if(self::CheckFile($filename)){
            $file = fopen(self::$path.$filename,'r');
            $tablename = preg_split('/\./u',$filename)[0]."_imported";
            $title_row = fgetcsv($file,9999,";","\r","\n");
            self::$column_count = count($title_row);
            if(self::$column_count<2)
                return  "Слишком мало столбцов";
            if(TableWorker::TableExists($tablename)){
                if(self::CheckColumns($tablename, $title_row)){
                    self::ImportToExistingTable($file,$tablename);
                }
                else return "Столбцы не совпадают";
            }
            else{
                if(TableWorker::CreateTable($tablename,$title_row)){
                    self::ImportToNewTable($file,$tablename);
                }
                else return "Что-то пошло не так с созданием таблицы";
            }
        }
        else return "Нет такого файла";
        $updated_count=self::$updated_count;
        $skipped_count=self::$skipped_count;
        $added_count = self::$added_count;  
        return null;
    }
}
?>