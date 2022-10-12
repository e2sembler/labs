<?php 
const conn = 'mysql:host=localhost;dbname=store';
const user = 'root';
const pass = '1';

function GetData($arr){
    $db = new PDO(conn,user,pass); 
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
     $array = array('fname'=>$arr['fname'],'fdesc'=>$arr['fdesc']);
    $query = "SELECT Items.img_path,Items.name , Brands.name
    ,Items.description,Items.price 
    FROM Items 
    INNER JOIN Brands on Items.id_brand=Brands.id 
    WHERE Items.name like CONCAT('%',:fname,'%')
    AND Items.description like CONCAT('%',:fdesc,'%')
    ";
    
    if(!empty($arr['fmax']) & is_numeric($arr['fmax'])){
        $query.="AND Items.price <= :fmax ";
        $array+=[':fmax'=>$arr['fmax']];}
        
    
    if(!empty($arr['fmin']) & is_numeric($arr['fmin']))
    {
    $query.="AND Items.price >= :fmin ";
    $array+=[':fmin'=>$arr['fmin']]; 
    }
    
    if(!empty($arr['fbrand'])){
    $query.="AND Items.id_brand=(SELECT id from Brands where name=:fbrand)";
    $array+=[':fbrand'=>$arr['fbrand']];}
    
    $query.=" order by Items.price";       
    $exec = $db->prepare($query);
    try{
    $exec->execute($array);}
    catch(Exception $ex){
        error_log($ex->getMessage());
        exit();
    } 
    $res = $exec->fetchAll();
    $db=null;
    return $res;
    }
 

function GetBrands(){
 $db = new PDO(conn,user,pass); 
 try{
    $res = $db->query("SELECT name from Brands");
    $db = null;
    return $res;
   }
    catch(Exception $ex){
        error_log($ex->getMessage());
        exit();
    }
}
?>