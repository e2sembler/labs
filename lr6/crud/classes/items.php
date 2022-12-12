<?php 
require_once ("database.php");
class Items{
    public static function GetData():array
    {
        $query = DB::prepare(
            "SELECT Items.Id, Items.img_path,Items.name , Brands.name
            ,Items.description,Items.price 
            FROM Items 
            INNER JOIN Brands on Items.id_brand=Brands.id 
            ORDER BY Items.Id"
        );
        if($query->execute())
        return $query->fetchAll(); 
    }
    public static function AddElement(&$filename, $name, &$brand_id, $desc, $price):bool
    {
       $query = DB::prepare("INSERT INTO Items Values(default(Items.id),:filename,:name,:brand_id,:desc,:price);");
       $query->bindValue(':filename',$filename);
       $query->bindValue(':name',$name);
       $query->bindValue(":brand_id",$brand_id);
       $query->bindValue(":desc",$desc);
       $query->bindValue(":price",$price);
       return $query->execute();
    }
    public static function IsDuplicate(&$name):bool
    {
        error_log($name);
        $query = DB::prepare("SELECT COUNT(*) FROM Items WHERE Items.name=:name");
        $query->bindValue(":name",$name);
        $query->execute();
        return $query->fetchColumn();
    }
}
?>