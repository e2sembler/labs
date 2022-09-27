
<div class="container">
<div id="search-box">
<form>   
        <p class="label">Цена:</p>
 
    <div id="price-row"> 
        <input type=text id="fmin" placeholder="от">
        <input type=text id="fmax" placeholder="до">
</div>
<p>Бренд:</p>
<select id="brands"><option></option>
<?php
 $db = $db = new PDO("sqlite:../laba2.db");  
 $res = $db->query("SELECT name from brands");
 foreach($res as $row)
 echo "<option>$row[0]</option>";
 $res=null;?>
</select>
<p>Содержит в описание:</p>
<input type="text" id="desc">
<p>Название:</p>
<input type="text" id="fname"><br>
        <button id="reset" type="reset" >Очистить фильтр</button>
</form>
<button id="send" type="sumbit" onclick="GetData()">Поиск</button>
</div>
<div>
<div id='item-header'>
    <p>Изображение</p>
    <p>Наименование</p>
    <p>Бренд</p>
    <p>Описание</p>
    <p>Стоимость</p>
</div>
<div id="item-list"> 
</div>
</div>
</div> 
</div>