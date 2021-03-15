<?php

require_once 'core/init.php';

$title = 'Главная страница';
$num = 3; // количество новостей на странице
/**
 * Фильрация по категориям
 */
$where = '';
if(isset($_GET['category'])){
    $c = intval($_GET['category']);
    if($c > 0){
        $where = 'WHERE `category_id` = ?';
    }
}
// Если есть условие и выбрана категория
if($where != '' && isset($c)){
    $resTotal = getStmtResult($link, "SELECT * FROM `news` $where", [$c]);
}else{
    $resTotal = getStmtResult($link, "SELECT * FROM `news`");
}



$total = mysqli_num_rows($resTotal);

$totalStr = ceil($total / $num); //общее число страниц

$page = intval($_GET['page']); //Получение номера страницы из адресной строки
if($page <=0){
    $page =1; // если номер страницы не существует, ео выводим первую
}elseif ($page > $totalStr){
    $page = $totalStr; // если номер страницы больше чем надо выводим последнюю
}


$offset = $page * $num -$num;// определяем с какой новости начинать




/**
 * $arCategory - список категорий для layout (init.php)
 */
//pr($total);
$query = "SELECT n.`id`, n.`title`, n.`preview_text`, DATE_FORMAT(n.`date`, '%d.%m.%Y %H:%i') AS date, n.`image`, n.`comments_cnt`, c.`title` AS news_cat ".
    "FROM `news` n JOIN `category` c ON c.`id` = n.`category_id` $where ORDER BY n.`id` LIMIT ?, ?";
// В зависимости от наличия условий подгатавливаем параметры
if($where != '' && isset($c)){
    $par = [$c, $offset, $num];
}else{
    $par = [$offset, $num];
}


$res = getStmtResult($link, $query, $par);
$arNews = mysqli_fetch_all($res, MYSQLI_ASSOC);
// лимит ВСЕГДА пишется последним
//pr($arNews);

$arPage = range(1, $totalStr); //массив со страницами

$prevPage = '';
if($page > 1){
    $prevPage = $page - 1;
}
$nextPage = '';

if($page < $totalStr){
    $nextPage = $page + 1;
}

$is_nav = ($totalStr > 1) ? true : false;
/////////////////////////////////////////////////////////////////////////////////////

$pageNavigation = renderTemplate('navigation', [
                                        //'arPage' => $arPage,  // получаем html навигации и передаем ему массив со страницами
                                        'totalPage' => $totalStr,
                                        'curPage' => $page,
                                        'nextPage' => $nextPage,
                                        'prevPage' => $prevPage,
                                        'show' => $is_nav

]);

$page_content = renderTemplate("main", [ // получаем шаблон новостей и передаем ему шаблон навигации
    'arNews' => $arNews,
    'navigation' => $pageNavigation

]);
$result = renderTemplate('layout', [ // получаем хтмл код основы и передаем ему новости с навигацией и категории
    'content' => $page_content,
    'title' => $title,
    'arCategory' => $arCategory,
	'menuActive' => 'main'
]);


echo $result; // выводим на экран готовую страницу



