<?php

$film_id = $_POST['film_id'];

//$mysqli = new mysqli('localhost', 'root', '', 'vue_film_app');
$mysqli = new mysqli('bronson4.mysql.tools', 'bronson4_films', '5Kv91t*K*c', 'bronson4_films');
$mysqli->set_charset("utf8");
if ($mysqli->connect_errno) {
    echo "Извините, возникла проблема на сайте";
    echo "Ошибка: Не удалась создать соединение с базой MySQL : \n";
    echo "Номер ошибки: " . $mysqli->connect_errno . "\n";
    echo "Ошибка: " . $mysqli->connect_error . "\n";
    exit;
}

$sql = "DELETE FROM `towatch_list` WHERE `film_id` = '$film_id'";

if (mysqli_query($mysqli, $sql)) {
    echo "Delete successfully";
} else {
    echo "Error: " . $sql . "" . mysqli_error($mysqli);
}

$mysqli->close();
?>