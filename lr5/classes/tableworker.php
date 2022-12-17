<?php 
require_once('../classes/db.php');
class TableWorker{
    public static function GetColumnCount(string $tablename):int{
            $query = DB::prepare("
            SELECT COUNT(*)
            FROM information_schema.columns
            WHERE table_name=:table");
            $query->bindValue(":table",$tablename);
            $query->execute();
            return $query->fetchColumn();
    }

    
    public static function GenerateData():array{
        $query = DB::prepare(("SELECT * FROM Items;"));
        $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function Test(){
        $query = DB::prepare("SELECT * FROM Items");
        $query->execute();
    }

    public static function GetColumnNames(string $tablename):array{  
        $query = DB::prepare("SHOW COLUMNS FROM ".$tablename);
        $query->execute();
        $arr = array();
        while($item = $query->fetchcolumn()){
            array_push($arr,$item);
        }
        return $arr;
    }

    public static function GetItems(string $tablename):array{
        $query = DB::prepare("SELECT * FROM ".$tablename); 
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function HasDuplicate(string $tablename, string $crc32):bool{
        
        $query = DB::prepare("SELECT COUNT(*) FROM ".$tablename.
        " WHERE crc32=:crc32;");
        $query->bindValue(":crc32",$crc32);
        $query->execute();
        return $query->fetchColumn()>0;
    }

    public static function CreateTable(string $tablename,array $columns):bool{
        $str = "CREATE TABLE IF NOT EXISTS ".$tablename." (";
        $str.="id int(6) AUTO_INCREMENT PRIMARY KEY NOT NULL, ";
        array_shift($columns);
        for($i=0;$i<count($columns);$i++){
            $str.=$columns[$i]." varchar(1488), ";
        }
        $str.="crc32 varchar(255), UNIQUE(crc32));"; 
        $query = DB::prepare($str);
        return ($query->execute());
    }

    public static function AddItem(string $tablename,array $row):bool{
        $str = "INSERT INTO ".$tablename." VALUES( default, ";
        array_shift($row);
        $tmp="";
        foreach($row as $column) 
            $tmp.=$column; 
        array_push($row,crc32($tmp));
        error_log($column);
        if(TableWorker::HasDuplicate($tablename,crc32($tmp)))
            return false;
        for($i=0;$i<count($row)-1;$i++) 
            $str.="?, ";
        $str.="?);";
        $query = DB::prepare($str);
        return $query->execute($row);
    }

}

?>