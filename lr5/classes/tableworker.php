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

    public static function TableExists(string $tablename):bool{
        $query = DB::prepare("SHOW TABLES LIKE '".$tablename."'"); 
        $query->execute();
        return $query->fetchColumn();
    }

    public static function HasDuplicateData(string $tablename, int $id, string $hash):bool{
        $query = DB::prepare("SELECT COUNT(*) FROM ".$tablename.
        " WHERE id=:id AND crc32=:crc32;");
        $query->bindValue(":id",$id);
        $query->bindValue(":crc32",$hash);
        $query->execute();
        return $query->fetchColumn();
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

    public static function HasSameId(string $tablename, int $id):bool{
        $query = DB::prepare("SELECT COUNT(*) FROM ".$tablename." WHERE id=:id");
        $query->bindValue(":id",$id);
        $query->execute();
        return $query->fetchColumn()>0;
    }

    public static function UpdateItem(string $tablename, int $id, array $row):bool{
        $str = "UPDATE ".$tablename." SET "; 
        $columns = self::GetColumnNames($tablename); 
        array_shift($row);
        array_shift($columns);
        for($i = 0; $i<count($columns)-1;$i++)
            $str.=$columns[$i]."=?,";
        $str.=$columns[count($columns)-1]."=? WHERE id=?";
        array_push($row,$id);
        error_log($str);
        $query=DB::prepare($str);
        return $query->execute($row);
    }

    public static function AddItem(string $tablename,array $row):bool{
        $str = "INSERT INTO ".$tablename." VALUES("; 
        for($i=0;$i<count($row)-1;$i++) 
            $str.="?, ";
        $str.="?);";
        $query = DB::prepare($str);
        return $query->execute($row);
    }

}

?>