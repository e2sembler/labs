
<?php  
require_once ('funcs.php');
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