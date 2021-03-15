<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$admin_login = 'admin';
$admin_pass = 'pass';
if($_POST['login'] != '' && $_POST['pass'] != ''){
    if($_POST['login'] == $admin_login && $_POST['pass'] == $admin_pass){
        $_SESSION['is_admin'] = '1';
    }
}
$resAdd = getStmtResult($link, "SELECT * FROM `news` ORDER BY `date` DESC LIMIT 3");
$arAdd = mysqli_fetch_all($resAdd, MYSQLI_ASSOC);

$page_add = renderTemplate('Add', ['arAdd' => $arAdd]);
$page_content = renderTemplate('admin', ['contAdd' => $page_add]);
$result = renderTemplate('admin_layout', [ // получаем хтмл код основы и передаем ему новости с навигацией и категории

    'content' => $page_content,
    'title' => 'Админка',
    'menuActive' => 'main'

]);
echo $result; // выводим на экран готовую страницу