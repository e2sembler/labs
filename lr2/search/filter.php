
<?php       
$db = new PDO("sqlite:../laba2.db");  
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$array = array('fname'=>$_GET['fname'],'fdesc'=>$_GET['fdesc']);
$query = "SELECT img_path,name,
(select name from brands as brand where id_brand=id)
,description,price 
FROM items 
WHERE name like '%'||:fname||'%'
AND description like '%'||:fdesc||'%' 
";

if(!empty($_GET['fmax']) & is_numeric($_GET['fmax'])){
    $query.="AND price <= :fmax ";
    $array+=[':fmax'=>$_GET['fmax']];}
    

if(!empty($_GET['fmin']) & is_numeric($_GET['fmin']))
{
$query.="AND price >= :fmin ";
$array+=[':fmin'=>$_GET['fmin']]; 
}

if(!empty($_GET['fbrand'])){
$query.="AND id_brand=(SELECT id from brands where name=:fbrand)";
$array+=[':fbrand'=>$_GET['fbrand']];}


$exec = $db->prepare($query);
$exec->execute($array);


$res = $exec->fetchAll();
foreach($res as $row){ 
    echo "<div>";
    echo "<div id=img><img src='../images/items/$row[0]'/></div>";
    echo "<p>$row[1]</p>";
    echo "<p>$row[2]</p>";
    echo "<p class='desc-box'>$row[3]</p>";
    echo "<p>$row[4]p</p>";
    echo "</div>";
 }
 $db=null;
 ?>