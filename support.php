<?php

require_once 'core/init.php';

$title = 'Поддержка';

$num = 5;

$resTotal = getStmtResult($link, "SELECT * FROM `support`");
$total = mysqli_num_rows($resTotal);

$totalStr = ceil($total / $num); //общее число страниц

$page = intval($_GET['page']); //Получение номера страницы из адресной строки
if($page <=0){
    $page =1; // если номер страницы не существует, ео выводим первую
}elseif ($page > $totalStr){
    $page = $totalStr; // если номер страницы больше чем надо выводим последнюю
}

$offset = $page * $num -$num;// определяем с какой новости начинать

////////////////////////ПОДГОТОВЛЕННЫЙ ЗАПРОС//////////////////////////////////
//$stmt = mysqli_prepare($link, "SELECT * FROM `support` LIMIT ?, ?");// подготавливаем запрос с указателями
//mysqli_stmt_bind_param($stmt, ii, $offset, $num);// привязывает переменные к указателям
//mysqli_stmt_execute($stmt); //выполняет подготовленный запрос
//$res = mysqli_stmt_get_result($stmt);// получает результат
///////////////////////////////////////////////////////////////////////////////

$query = "SELECT * FROM `support` LIMIT ?, ?";
$par = [$offset, $num];
$res = getStmtResult($link, $query, $par);
//$res = mysqli_query($link, "SELECT * FROM `support` LIMIT $offset, $num");
$arSupp = mysqli_fetch_all($res, MYSQLI_ASSOC);

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

$page_content = renderTemplate("support", ['arSupp' => $arSupp, 'navigation' => $pageNavigation]);
//pr($arSupp);


$result = renderTemplate('layout', [
    'content' => $page_content,
    'title' => $title,
    'arCategory' => $arCategory,
	'menuActive' => 'support'
    ]);


echo $result;