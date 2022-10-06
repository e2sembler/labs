
<?php  
function GetData($arr){
$db = new PDO("sqlite:../laba2.db");  
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$array = array('fname'=>$arr['fname'],'fdesc'=>$arr['fdesc']);
$query = "SELECT items.img_path,items.name , brands.name
,items.description,items.price 
FROM items 
INNER JOIN Brands on id_brand=Brands.id 
WHERE items.name like '%'||:fname||'%'
AND items.description like '%'||:fdesc||'%' 
";

if(!empty($arr['fmax']) & is_numeric($arr['fmax'])){
    $query.="AND items.price <= :fmax ";
    $array+=[':fmax'=>$arr['fmax']];}
    

if(!empty($arr['fmin']) & is_numeric($arr['fmin']))
{
$query.="AND items.price >= :fmin ";
$array+=[':fmin'=>$arr['fmin']]; 
}

if(!empty($arr['fbrand'])){
$query.="AND items.id_brand=(SELECT id from brands where name=:fbrand)";
$array+=[':fbrand'=>$arr['fbrand']];}

$query.=" ";      

$exec = $db->prepare($query);
$exec->execute($array);
$res = $exec->fetchAll();
$db=null;
return $res;
}


$res = GetData($_GET);
foreach($res as $row){ 
    echo "<div>";
    echo "<div id=img><img src='../images/items/$row[0]'/></div>";
    echo "<p>$row[1]</p>";
    echo "<p>$row[2]</p>";
    echo "<p class='desc-box'>$row[3]</p>";
    echo "<p>$row[4]p</p>";
    echo "</div>";
 }
 ?>