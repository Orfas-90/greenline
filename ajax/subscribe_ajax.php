<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

    //pr($_POST);
$res = getStmtResult($link, "INSERT INTO `subscribe` SET `email` = ?", [$_POST['s_email']]);
$id = mysqli_insert_id($link);
if($id > 0){

    echo pr($_POST);
}else {
    echo 'error';
}
