<?php 
require_once($root."classes/tableworker.php");
class EchoSlam{
    public static function DrawHeader(string $tablename):void{
        echo " <div id='item-header'> ";
        $columns = TableWorker::GetColumnNames($tablename);
        for($i=0;$i<count($columns)-1;$i++)
            echo "<p>".$columns[$i]."</p> ";
        echo "</div> ";
    }
    public static function DrawRows(array $rows):void{
        echo "<div id='item-list'> ";
        foreach($rows as $row){
            array_pop($row);
            echo "<div> ";
            foreach($row as $col)
                echo "<textarea readonly>".$col."</textarea> ";
            echo "</div> <br>";
        }
        echo "</div>";
    }
}
?>