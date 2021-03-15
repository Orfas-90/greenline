<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$arResult = [];
$search = $_GET['search'];
if($search != ''){

    $query = "SELECT n.`id`, n.`title`, n.`detail_text`, DATE_FORMAT(n.`date`, '%d.%m.%Y %H:%i') AS date, n.`image`, n.`comments_cnt`, c.`title` AS news_cat ".
        "FROM `news` n JOIN `category` c ON c.`id` = n.`category_id` WHERE MATCH(`detail_text`) AGAINST(?)";
    $res = getStmtResult($link, $query, [$search]);
    while ($arRes = mysqli_fetch_assoc($res)){
        $text = substr($arRes['detail_text'], 0, 200);
        $arRes['detail_text'] = $text;

        $arResult[] = $arRes;
    }

}

$page_content = renderTemplate('search', ['arResult' => $arResult]);

$result = renderTemplate('layout', [ // получаем хтмл код основы и передаем ему новости с навигацией и категории
    'content' => $page_content,
    'title' => 'поиск по сайту',
    'arCategory' => $arCategory,
    'menuActive' => ''
]);


echo $result; // выводим на экран готовую страницу