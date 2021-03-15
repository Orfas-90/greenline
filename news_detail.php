<?php

require_once 'core/init.php';
$title = 'Новость';
$id = intval($_GET['id']);
$query = "SELECT n.`id`, n.`title`, n.`detail_text`, DATE_FORMAT(n.`date`, '%d.%m.%Y %H:%i') AS date, n.`image`, n.`comments_cnt`, c.`title` AS news_cat ".
    "FROM `news` n JOIN `category` c ON c.`id` = n.`category_id` WHERE n.`id` = ? LIMIT ?";
$res = getStmtResult($link, $query, [$id, 1]);

$arNewsDetail = mysqli_fetch_assoc($res);

$resComment = getStmtResult($link, "SELECT * FROM `comments` WHERE news_id = ?", [$id]);
$arComments = mysqli_fetch_all($resComment, MYSQLI_ASSOC);// получаем комментарии текущей новости

$resTags = getStmtResult($link, "SELECT * FROM `tags` WHERE `news_id` = ?", [$id]);
$arTags = mysqli_fetch_all($resTags, MYSQLI_ASSOC);

$comments = renderTemplate('comments', [ //получаем шаблон комментариев
    'arComments' => $arComments //передаем массив в шаблон комментариев
]);

$page_content = renderTemplate("news_detail", [ // получаем шаблон новостей и передаем ему шаблон навигации
    'arNews' => $arNewsDetail,
    'comments' => $comments, //передаем готовый хтмл комментариев
    'arTags' => $arTags
]);
$result = renderTemplate('layout', [ // получаем хтмл код основы и передаем ему новости с навигацией и категории
    'content' => $page_content,
    'title' => $title,
    'arCategory' => $arCategory,
    'menuActive' => 'main'
]);


echo $result; // выводим на экран готовую страницу