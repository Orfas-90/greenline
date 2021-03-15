<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

if($_POST['title'] != '' && $_POST['prev'] != '' && $_POST['det'] != '' && $_POST['kat'] != '' && $_FILES['user_file']['error'] == 0){
    $res = getStmtResult($link, "INSERT INTO `news` SET `title` = ?, `preview_text` = ?, `detail_text` = ?, `date` = NOW(), `category_id` = ?, `image` = ?", [$_POST['title'], $_POST['prev'], $_POST['det'], $_POST['kat'], $_FILES['user_file']['name']]);
    //pr($_POST);
    //pr($_FILES['user_file']['name']);
    $upload = $_SERVER['DOCUMENT_ROOT'] . '/upload/news_image/';
    $name = $_FILES['user_file']['name'];
    move_uploaded_file($_FILES['user_file']['tmp_name'], $upload . $name);
}
$id = mysqli_insert_id($link);
if($id > 0){

    $resAdd = getStmtResult($link, "SELECT * FROM `news` ORDER BY `date` DESC LIMIT 3");
    $arAdd = mysqli_fetch_all($resAdd, MYSQLI_ASSOC);

    $Add = renderTemplate('Add', [ //получаем шаблон
        'arAdd' => $arAdd //передаем массив в шаблон
    ]);
    $arrRes = [];
    $arrRes['Add'] = $Add;
    echo json_encode($arrRes);
}else {
    echo 'error';
}