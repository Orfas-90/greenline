<?php

require_once 'core/init.php';

$title = 'О нас';
$query = "SELECT * FROM `about`";
$res = getStmtResult($link, $query);
$arSupp = mysqli_fetch_all($res, MYSQLI_ASSOC);



$page_content = renderTemplate("about", ['arSupp' => $arSupp]);

/**
 * $arCategory - список категорий для layout (init.php)
 */

$result = renderTemplate('layout', [
                                'content' => $page_content,
                                'title' => $title,
                                'arCategory' => $arCategory,
	                            'menuActive' => 'about'
                                ]);


echo $result;
