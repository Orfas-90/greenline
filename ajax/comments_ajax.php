<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

$resTr = getStmtResult($link, "START_TRANSACTION");

$res = getStmtResult($link, "INSERT INTO `comments` SET `text` = ?, `author` = ?, `news_id` = ?, `date` = NOW()", [$_POST['message'], $_POST['name'], $_POST['news_id']]);
$id = mysqli_insert_id($link); //получает айди только что вставленной записи

$resN = getStmtResult($link, "SELECT `comments_cnt` FROM `news` WHERE `id` = ?", [$_POST['news_id']]);

$cnt = mysqli_fetch_assoc($resN)['comments_cnt'];

$cnt++;

$resNews = getStmtResult($link, "UPDATE `news` SET `comments_cnt` = ? WHERE `id` = ?", [$cnt, $_POST['news_id']]);

if($id > 0){
    getStmtResult($link, "COMMIT");
    $resComment = getStmtResult($link, "SELECT * FROM `comments` WHERE news_id = ?", [$_POST['news_id']]);
    $arComments = mysqli_fetch_all($resComment, MYSQLI_ASSOC);// получаем комментарии текущей новости

    $comments = renderTemplate('comments', [ //получаем шаблон комментариев
        'arComments' => $arComments //передаем массив в шаблон комментариев
    ]);
    $arrRes = [];
    $arrRes['comments'] = $comments;
    $arrRes['cc'] = count($arComments);
    echo json_encode($arrRes);
}else{
    getStmtResult($link, "ROLLBACK");
    echo 'error';
}