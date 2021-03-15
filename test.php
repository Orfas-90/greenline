<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
pr($_FILES);
//ob_start(); // включаем буферизацию

//echo 'Hello!';


//$str = ob_get_contents(); //возвращает данные из буфера
//ob_end_clean(); // очищает буфер

//$str = ob_get_clean(); //возвращает данные и очищает буфер

//echo $str;


//////////////////////////////////////

//1. по сколько выводить на страницу (пагинация - постраничный вывод данных)
//2. сколько всего записей в базе
//3. сколько всего будет страниц
//4. на какой сейчас странице находится пользователь (определить текущую страницу ($_GET['page']))




// лимит ВСЕГДА пишется последним
// LIMIT n, m
// n - с какой записи начинать
// m - сколько выводить


/////////////////////////////////////

//в категориях сформировать правильные ссылки с гет параметрами
//Проверяем наличие параметров в массиве ГЕТ
//Добавляем фильтрацию в запрос на выборку новостей

/*$title = "Технологии";

$res = getStmtResult($link, "SELECT * FROM `category` WHERE `title` = ?", array($title));

while($arRes = mysqli_fetch_assoc($res)){
    pr($arRes);
}*/


//pr(getWeekDay(5));
/*if($_FILES['user_file']['error'] == 0) {
    $upload = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
    $arName = explode('.', $_FILES['user_file']['name']);// разбиваем имя файла по точке чтобы между ними запихнуть тайм
    $name = $arName[0] . '_' . time() . '.' . $arName[1]; //составляем новое имя для файла с использованием метки времени
    move_uploaded_file($_FILES['user_file']['tmp_name'], $upload . $name);
}
*/


foreach ($_FILES['user_file']['error'] as $k => $val){
    if($val == 0){
        $upload = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
        $arName = explode('.', $_FILES['user_file']['name'][$k]);
        $name = $arName[0] . '_' . time() . '.' . $arName[1];
        move_uploaded_file($_FILES['user_file']['tmp_name'][$k], $upload . $name);
    }
}
?>


<form method="post" enctype="multipart/form-data">
    <input type="file" name="user_file[]"/><br>
    <input type="file" name="user_file[]"/><br>
    <input type="file" name="user_file[]"/><br>
    <input type="file" name="user_file[]"/><br>
    <input type="submit" value="Загрузить"/>

</form>

<?php
// CREATE FULLTEXT INDEX название индекса ON таблица(поле, поле, ...)
// это создание полноценного индекса для полей текст варчар и чар


// SELECT * FROM `table` WHERE MATCH(`поле`) AGAINST('текст')

// MATCH - где ищем
// AGAINST - что ищем

// SELECT `id`, `detail_text`, MATCH(`detail_text`) AGAINST('текст') FROM `table` WHERE MATCH(`поле`) AGAINST('текст')
// выводим значение релевантности

?>