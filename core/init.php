<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';







$res = mysqli_query($link, "SELECT * FROM `category` ORDER BY `title` ASC");
$arCategory = mysqli_fetch_all($res, MYSQLI_ASSOC);