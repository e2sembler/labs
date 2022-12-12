<?php 
$town="Волгоград";
require_once($root.'classes/user.php');
session_start();
$username = User::GetUserName();
$usermenu = User::GetUserMenu($root);
session_write_close();
?>

<header>
    <div id="header-top">
        <div id="top-menu1" class="container">
            <ul class="common-list">
<li class="common-item">
<div class="pointer">
<span class="geo-ico icon">
</span>
<p><?=$town?></p>
</div>
</li>
<li class="common-item pointer">
<a>Магазины</a>
</li>
<li class="common-item pointer">
<a>Покупателям</a>
<span class="dropdown-ico icon"></span>
</li>
<li class="common-item pointer">
<a>Юридическим лицам</a></li>
<li class="common-item pointer">
<a>Клуб DNS</a>
</li>                
</ul>
<div class="header-number">
<span class="phone-ico icon"></span> 
<b>8-800-77-07-999</b>
 (с 03:00 до 22:00)
</div>
        </div>
    </div>
    <div id="header-bot">
        <div class="container">
            <div class="logo-container">
            <div class="logo"  onclick="window.location='<?=$root?>'"></div>
            <div class="catalog-spoiler orange-btn">
                <b>Каталог</b>
                <b><span class="dropdown-ico icon"></span></b>
            </div>
            </div>
<div id="searcher">
    <input class="input" placeholder="Поиск по сайту" autocomplete="off">
    <span class="search-ico icon"></span>
</div>
    <ul class="buttons">
        <li class="button-item">
            <span class="compare-ico icon"></span>
            <a>Сравнить</a>
        </li>
    <li class="button-item">
        <span class="fav-ico icon"></span>
        <a>Избранное</a>
    </li>
    <li class="button-item">
        <span class="cart-ico icon"></span>
        <a>Корзина</a>
    </li>
    <li id="username" class="button-item">
        <span class="profile-ico icon"></span>
        <a><?=$username?></a> 
        <div id="usermenu">
       <?=$usermenu?>
        </div>
    </li>
    </ul>
        </div>
    </div>

</header>