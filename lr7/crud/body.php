
<div class="container">
<div>
<div id='item-header'>
    <p>Id</p>
    <p>Изображение</p>
    <p>Наименование</p>
    <p>Бренд</p>
    <p>Описание</p>
    <p>Стоимость</p>
</div>
<div id="item-list"> 
</div>
<div id='item-header'>
    <p>Действие</p>
    <p>Изображение</p>
    <p>Наименование</p>
    <p>Бренд</p>
    <p>Описание</p>
    <p>Стоимость</p>
</div>
<div id='addeditem'>
    <div><button id='add' type='button' onclick='AddItem()'>Добавить</button>
        <button id='clear' type='button' onclick='ClearFields()'>Очистить</button></div>
    <p><input id='upload' type='file' accept='image/*'></input></p>
    <p><input type='text' id='col_name'></input></p>
    <p><select id="brands">
            <option></option>
            <?php
                require_once('./classes/brands.php');
                $res = Brands::GetData();
                foreach($res as $row)
                    echo "<option>$row[0]</option>";
            ?>
        </select></p>
    <p><input type='text' id='col_desc'></input></p>
    <p><input type='text' id='col_price'></input></p>
</div>
</div>
</div> 
</div>