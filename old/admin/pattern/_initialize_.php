<?php
$auth=new auth(1800,true);
if (!$auth->validAuth('admin')) {
    header ("Location: ".$auth->_SITE_."/admin/login.php");
    exit();
}
$init=new admin();
$antiHack=new antiHack;
if (isset($_REQUEST['idmenu'])) {$idmenu=intval($antiHack->filterAll($_REQUEST['idmenu']));} else {$idmenu=0;}
if (isset($_REQUEST['id'])&&!empty($_REQUEST['id'])) {$id=intval($antiHack->filterAll($_REQUEST['id']));} else {$id=0;}
if (isset($_REQUEST['id_category'])&&(!empty($_REQUEST['id_category']))) {$idCat=intval($antiHack->filterAll($_REQUEST['id_category']));} else {$idCat=0;}
if (isset($_REQUEST['id_manufacturer'])&&(!empty($_REQUEST['id_manufacturer']))) {$idMan=intval($antiHack->filterAll($_REQUEST['id_manufacturer']));} else {$idMan=0;}
$where=null;
if (isset($_REQUEST['navi'])&&!empty($_REQUEST['navi'])) {$navi=intval($antiHack->filterAll($_REQUEST['navi']));} else {$navi=1;}
//----------------------------------------------------------------------------------------------------------------------
$id_Article=array(1,3,5);
$id_categoryTovar=array(21,211,212);
$id_manufacturerTovar=array(23,231,232);
$id_tovar=array(22,221,222,223);
$id_atribute=array(24,241,242);
$id_Discounts=array(25,253,255);
$id_categoryNews=array(41,43,45);
$id_News=array(42,44,46);
$id_Menu=array(51,53,55);
$id_Moduls=array(61,63,65);
$id_Payment=array(122,124,126);
$id_Delivery=array(123,125,127);
$id_Admins=array(111,113,115);
$id_Qanda=array(81,83,85);
$id_OtherPages=array(161,163,165);
$id_Sliders=array(131,133,135);
$id_Slides=array(141,143,145);
$id_Sitemap=array(129);
$id_indexText=array(128);
$id_portfolioCategory=array(171,173,175);
$id_portfolio=array(172,174,176);
$id_counters=array(191);
$id_stat=array(195);
//----------------------------------------------------------------------------------------------------------------------
$idNotSearch=array(111,195,121,128,129,191);
$idNotView=array(61,161,25,191);
$idCopy=array(22=>223);
$add=$edit=0;$vivod=0;$title=$table=$perFolder="";
$ckeEditor=array(3,5,211,212,221,222,223,231,232,43,45,44,46,63,65,83,85,133,135,141,143,145,173,175,174,176,128,181);
$idCatFilter=array(22);
$idPotfolioFilter=array(172);
//----------------------------------------------------------------------------------------------------------------------
switch ($_SERVER['PHP_SELF']) {
    case "/admin/index.php": $title='NVV-CMS';break;
    case "/admin/article.php": $title='Статьи';break;
    case "/admin/catalog.php": $title='Каталог товаров';break;
    case "/admin/news.php": $title='Новости';break;
    case "/admin/menu.php": $title='Меню';break;
    case "/admin/moduls.php": $title='Модули';break;
    case "/admin/faqs.php": $title='Вопрос-Ответ';break;
    case "/admin/admins.php": $title='Администраторы';break;
    case "/admin/setting.php": $title='Настройки';break;
    case "/admin/slider.php": $title='Слайдеры сайта';break;
    case "/admin/global_url.php": $title='Описание дополнительных страниц';break;
    case "/admin/portfolio.php": $title='Портфолио';break;
    default: $title='NVV-CMS';
}
//----------------------------------------------------------------------------------------------------------------------
switch ($idmenu) {
    case 1: $title='Статьи';$add=3;$edit=5;$table="article";$vivod=1;$to_url="article";break;
    case 3: $title='Добавление статьи';break;
    case 5: $title='Редактирование статьи';break;
    case 21: $title='Категории товаров';$add=211;$edit=212;$table="catalog_category";$vivod=1;$to_url="catalog";break;
    case 211: $title='Добавление категории товаров';break;
    case 212: $title='Редактирование категории товаров';break;
    case 22: $title='Товары';$add=221;$edit=222;$table="catalog_product";$vivod=1;$to_url="catalog";break;
    case 221: $title='Добавление товара';break;
    case 222: $title='Редактирование товара';break;
    case 223: $title='Копирование товара';break;
    case 23: $title='Производители';$add=231;$edit=232;$table="catalog_manufacturer";$vivod=1;$to_url="catalog";break;
    case 231: $title='Добавление производителя';break;
    case 232: $title='Редактирование производителя';break;
    case 24: $title='Атрибуты';$add=241;$edit=242;$table="attribute";$vivod=1;$to_url="catalog";break;
    case 241: $title='Добавление атрибута';break;
    case 242: $title='Редактирование атрибута';break;
    case 25: $title='Скидки';$add=253;$edit=255;$table="discounts";$to_url="catalog";$vivod=1;break;
    case 253: $title='Создание скидки';break;
    case 255: $title='Редактирование скидки';break;
    case 41: $title='Категории новостей';$add=43;$edit=45;$table="news_category";$vivod=1;$to_url="news";break;
    case 43: $title='Добавление категории новостей';break;
    case 45: $title='Редактирование категории новостей';break;
    case 42: $title='Новости';$add=44;$edit=46;$table="news";$vivod=1;$to_url="news";break;
    case 44: $title='Добавление новости';break;
    case 46: $title='Редактирование новости';break;
    case 51: $title='Меню сайта';$add=53;$edit=55;$table="menu";$vivod=1;$to_url="menu";break;
    case 53: $title='Добавление пункта меню';break;
    case 55: $title='Редактирование пункта меню';break;
    case 61: $title='Список модулей';$add=63;$edit=65;$table="moduls";$vivod=1;$to_url="moduls";break;
    case 62: $title='Схема расположения модулей';break;
    case 63: $title='Добавление модуля';break;
    case 65: $title='Редактирование модуля';break;
    case 71: $title='Список заказов';$table="orders";$vivod=1;break;
    case 73: $title='Просмотр заказа';break;
    case 81: $title='Список вопросов';$add=83;$edit=85;$table="faqs";$vivod=1;$to_url="faqs";break;
    case 83: $title='Добавление вопроса';break;
    case 85: $title='Редактирование вопроса';break;
    case 91: $title='Зарегистрированные пользователи';$add=93;$edit=95;$table="users";$vivod=1;$to_url="users";break;
    case 111: $title='Список администраторов сайта';$add=113;$edit=115;$table="admin_users";$vivod=1;$to_url="admins";break;
    case 113: $title='Добавление администратора';break;
    case 115: $title='Редактирование администратора';break;
    case 121: $title='Основные настройки сайта';break;
    case 122: $title='Способы оплаты';$add=124;$edit=126;$table="means_of_payment";$to_url="setting";$vivod=1;break;
    case 124: $title='Добавление способа оплаты';break;
    case 126: $title='Редактирование способа оплаты';break;
    case 123: $title='Способы доставки';$add=125;$edit=127;$table="delivery_methods";$to_url="setting";$vivod=1;break;
    case 125: $title='Добавление способа доставки';break;
    case 127: $title='Редактирование способа доставки';break;
    case 128: $title='Текст на главной странице';break;
    case 129: $title='Файл SITEMAP.XML';break;
    case 131: $title='Слайдеры сайта';$add=133;$edit=135;$table="slider";$to_url="slider";$vivod=1;break;
    case 133: $title='Добавление слайдера';break;
    case 135: $title='Редактирование слайдера';break;
    case 141: $title='Изображения слайдера';$add=143;$edit=145;$table="slides";$to_url="slider";$vivod=1;break;
    case 143: $title='Добавление слайда';break;
    case 145: $title='Редактирование слайда';break;
    case 161: $title='Описание дополнительных страниц';$add=163;$edit=165;$table="global_url";$vivod=1;$to_url="global_url";break;
    case 163: $title='Добавление страницы';break;
    case 165: $title='Редактирование страницы';break;
    case 171: $title='Категории портфолио';$add=173;$edit=175;$table="portfolio_category";$vivod=1;$to_url="portfolio";break;
    case 173: $title='Добавление кактегории';break;
    case 175: $title='Редактирование категории';break;
    case 172: $title='Портфолио';$add=174;$edit=176;$table="portfolio";$vivod=1;$to_url="portfolio";break;
    case 174: $title='Добавление единицы порфолио';break;
    case 176: $title='Редактирование единицы порфолио';break;
    case 191: $title='Сторонние счетчики посещаемости | Метрика';break;
    case 195: $title='Статистика посещений сайта';break;
}
//----------------------------------------------------------------------------------------------------------------------
if (isset($_REQUEST['search'])&&!empty($_REQUEST['search'])) {
    $inputSearch=$antiHack->filterAll($_REQUEST['search']);
    $search=' `n`.`name_'.$init->lang.'` LIKE \'%'.$inputSearch.'%\' && `n`.`id_row`=`t`.`id` && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\')';
} else {$search=$inputSearch='';}
//----------------------------------------------------------------------------------------------------------------------
if (isset($_GET['error'])) {
    $kod=intval($antiHack->filterAll($_GET['error']));
    switch ($kod) {
    case 0: $error='Выполнено успешно!';$classError='success';break;
    case 10: $error='У Вас нет соответствующих прав!';$classError='error';break;
    case 202: $error='Удаление невозможно, т.к. данный пункт меню имеет вложенные пункты!';$classError='error';break;
    case 203: $error='Удаление невозможно, т.к. есть пользователи с этим типом!';$classError='error';break;
    case 204: $error='Удаление невозможно, т.к. в этой категории есть товары!';$classError='error';break;
    case 205: $error='Удаление невозможно, т.к. эта категория имеет вложенные подкатегории!';$classError='error';break;
    case 206: $error='Удаление невозможно, т.к. в эта категория содержит статьи!';$classError='error';break;
    case 207: $error='Удаление невозможно, т.к. в эта категория содержит новости!';$classError='error';break;
    case 555: $error='Ошибка создания папки!';$classError='error';break;
    case 666: $error='Отсутствие обязательных данных!';$classError='error';break;
    case 1010: $error='Ошибка добавления в БД!';$classError='error';break;
    case 1020: $error='Ошибка! Превышено количество допустимых символов.';$classError='error';break;
    case 1030: $error='Ошибка! Количество допустимых символов меньше требуемого.';$classError='error';break;
    case 3002: $error='Ошибка загрузки файла! Файл с таким именем уже существует.';$classError='error';break;
    case 3072: $error='Ошибка загрузки файла!';$classError='error';break;
    case 20: $error='Ошибка обновления файла SITEMAP!';$classError='error';break;
    case 30: $error='Введены не существующие данные!';$classError='error';break;
    case 40: $error='Данные уже существуют!';$classError='error';break;
    }
} else {
    $error=null;
}
?>