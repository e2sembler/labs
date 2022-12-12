<?php 
require_once("database.php");

class Brands{
    public static function GetData():array
    {
        $query = DB::prepare(
            "SELECT Brands.name
            FROM Brands;");
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }
    public static function GetId(&$brandname):int{
        $query = DB::prepare(
            "SELECT Brands.id FROM Brands where Brands.name=:brandname;"
        );
        $query->bindValue(":brandname",$brandname);
        $query->execute();
        return $query->fetchColumn(); 
    }
}
?>