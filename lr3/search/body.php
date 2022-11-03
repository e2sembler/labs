
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
 require_once('funcs.php');
 $res = GetBrands();
 foreach($res as $row)
 echo "<option>$row[0]</option>";
?>
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