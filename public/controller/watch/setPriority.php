<?php

$film_id = $_POST['film_id'];
$priority = $_POST['priority'];

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

$sql = "UPDATE `towatch_list` SET `priority`='$priority' WHERE `film_id`='$film_id'";

if (mysqli_query($mysqli, $sql)) {
    echo "UPDATE successfully";
} else {
    echo "Error: " . $sql . "" . mysqli_error($mysqli);
}

$mysqli->close();
?>