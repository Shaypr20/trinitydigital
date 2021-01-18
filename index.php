<?php

header('Content-Type: text/html; charset=utf-8');

// Подгружаю функцию аккуратного вывода массива и класс curl запросов
require_once("pri.php");
require_once("curlQuery.php");

$curl = new curlQuery;

// URL вебхука для получения списка задач
$link = "https://vosmedia.bitrix24.ru/rest/1/vu91ejw3lj5i42ir/task.item.list.json";

// Дергаю вебхук и получаю массив задач (все поля)
$mass = $curl->get($link);
$mass = json_decode($mass, true);
$mass = $mass['result'];

// Перебором получаю массив просроченных задач
foreach ($mass as $val) {
	if ($val['STATUS'] < 0) {
		$result[] = $val;
	}
}

// Вывожу массив на экран
pri($result);