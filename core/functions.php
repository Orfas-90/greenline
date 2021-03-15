<?php

/**
 * Подключает шаблон с параметрами
 */

function renderTemplate($name, $data = []){

    $result = '';

    $name = $_SERVER['DOCUMENT_ROOT'] . '/templates/' . $name . '.php'; // создаем полный путь из параметра name
    if(!file_exists($name)){ // проверяем на существование и если нет то выходим из функции
        return $result;
    }

    ob_start(); // начало буферизации

    extract($data); // создаёт переменную из массива
    require_once $name; // подключаем шаблон
    $result = ob_get_clean(); // выводим данные из буфера

    return $result; // возвращаем результат

}


function pr($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

/**
 * Функция добавления параметров в адресную строку
 */
function setPagePar($param, $value){

    $qParam = $_SERVER['QUERY_STRING'];
    parse_str($qParam, $arr);
    if(!empty($param) && !empty($value)){
       
            $arr[$param] = $value;
        
    }
    return http_build_query($arr);
}





/////////////////// ФУНКЦИЯ ДНЕЙ НЕДЕЛИ////////////////////
function getWeekDay($day){
	$resDay = '';
	if($day >7 || $day < 0){
		return "false";
	}else{
		switch($day){
		case 1:
			$resDay = "Воскресенье";
			break;
		case 2:
			$resDay = "Понедельник";
			break;
		case 3:
			$resDay = "Вторник";
			break;
		case 4:
			$resDay = "Среда";
			break;
		case 5:
			$resDay = "Четверг";
			break;
		case 6:
			$resDay = "Пятница";
			break;
		case 7:
			$resDay = "Суббота";
			break;	
		}
	return $resDay;	
	}
}

/**
 * Функция для подготовленного запроса
 * @param $link
 * @param $query
 * @param array $param
 * @return false|mysqli_result
 */
function getStmtResult($link, $query, $param =[]){


    if(!empty($param)){ // если пришли параметры (массив)
        $stmt = mysqli_prepare($link, $query); //подготавливаем запрос
        $type = ""; //создаем пустую переменную (аргумент с типами данных для функции)
        foreach($param as $item){ //проходим циклом и заполняем тайп
            if(is_int($item)){
                $type .= 'i'; //эта запись добавляет в конец строки
            }elseif (is_string($item)){
                $type .= 's';
            }elseif (is_double($item)){
                $type .= 'd';
            }else{
                $type .= 's';
            }
        }
        $values = array_merge([$stmt, $type], $param); //подготавливаем общий массив для передачи в функцию mysqli_stmt_bind_param
        $func = 'mysqli_stmt_bind_param';
        $func(...$values); //троеточие указывает переменное число аргументов, из массива все придет отдельными значениями сюда.

        mysqli_stmt_execute($stmt); //выполняем подготовленный запрос
        $result = mysqli_stmt_get_result($stmt);// получаем результат
        return $result; //возвращаем результат
    }else{
        $result = mysqli_query($link, $query);
        return $result; //возвращаем результат
    }


}