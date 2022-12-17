
    <select id='import-selection'>
        <?php 
        require_once('./classes/importer.php');
        $files = Importer::ListItems();
        for($i=2;$i<count($files);$i++)
            echo "<option>".$files[$i]."</option>";
        ?>
    </select>
    <button onclick="Import()">Импортировать</button>
    <br>
    <div id="tableholder"> 
    </div>