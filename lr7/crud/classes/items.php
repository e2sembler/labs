<?php 
require_once ("database.php");
class Items{
    public static function GetData():array{
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
    public static function AddElement(&$filename, $name, &$brand_id, $desc, $price):bool{
       $query = DB::prepare("INSERT INTO Items Values(default(Items.id),:filename,:name,:brand_id,:desc,:price);");
       $query->bindValue(':filename',$filename);
       $query->bindValue(':name',$name);
       $query->bindValue(":brand_id",$brand_id);
       $query->bindValue(":desc",$desc);
       $query->bindValue(":price",$price);
       return $query->execute();
    }
    public static function IsDuplicate(&$name):bool{
        $query = DB::prepare("SELECT COUNT(*) FROM Items WHERE Items.name=:name");
        $query->bindValue(":name",$name);
        $query->execute();
        return $query->fetchColumn();
    }

    public static function DeleteItem($id):bool{
        $query = DB::prepare("DELETE FROM Items WHERE Items.id=:id;");
        $query->bindValue(":id",$id);
        return $query->execute();
    }

    public static function UpdateItem(&$id,$name,$brand_id,$desc,$price,$img_path=null):bool{
        $str = "UPDATE Items 
                    SET Items.name=:name, Items.id_brand=:brandid, Items.description=:desc, Items.price=:price ";
        if($img_path!=null){
            $str.=", Items.img_path=:img_path ";
        }
        $str.="WHERE Items.id=:id";
        $query = DB::prepare($str);
        $query->bindValue(":name",$name);
        $query->bindValue(":price",$price);
        $query->bindValue(":brandid",$brand_id);
        $query->bindValue(":desc",$desc);
        $query->bindValue(":id",$id);
        if($img_path!=null) 
            $query->bindValue(":img_path",$img_path); 
        return $query->execute();
    }

    public static function GetImageName(&$id):string{
        $query = DB::prepare("SELECT Items.img_path from Items WHERE id=:id");
        $query->bindValue(":id",$id);
        if($query->execute())
            return $query->fetchColumn();
    }
}
?>