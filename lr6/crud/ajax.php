
<?php  
require_once ('./classes/items.php'); 
require_once ('./classes/brands.php');

if(!empty($_GET['table_items'])){
    $res = Items::GetData();
    foreach($res as $row){
        echo "<div>";
        echo "<p>$row[0]</p>";
        echo "<div id=img><img src='../images/items/$row[1]'/></div>";
        echo "<p>$row[2]</p>";
        echo "<p>$row[3]</p>";
        echo "<p class='desc-box'>$row[4]</p>";
        echo "<p>$row[5]p</p>";
        echo "</div>";
    }
    die();
} 
 if(!empty($_POST['name'])&&!empty($_POST['brand'])&&!empty($_POST['desc'])&&!empty($_POST['price'])&&!empty($_FILES['img'])){
    if(Items::IsDuplicate($_POST['name'])){
        echo "Такое имя уже существует";
        die();
    }
    $fullfilename = $_FILES['img']['name'];
    $filename = preg_replace('/(\.\w{3,4}$)/ui','',$fullfilename);
    $arr = preg_split('/\./ui',$fullfilename);
    $filext = array_pop($arr);   
    if(file_exists('../images/items/'.$_FILES['img']['name'])){
        for($i=1;;$i++)
            if(!file_exists('../images/items/'.$filename.'('.$i.').'.$filext)){
                $fullfilename = $filename.'('.$i.').'.$filext;
                break;
            }
    }
    $brand_id = Brands::GetId($_POST['brand']);
    if(Items::AddElement($fullfilename,htmlspecialchars($_POST['name']),$brand_id,htmlspecialchars($_POST['desc']),
    htmlspecialchars($_POST['price'])))
        move_uploaded_file($_FILES['img']['tmp_name'],'../images/items/'.$fullfilename); 
    die();    
 }

 ?>