<?php

$film_id = $_POST['film_id'];
$title = $_POST['title'];
$poster_path = $_POST['poster_path'];

$mysqli = new mysqli('localhost', 'root', '', 'vue_film_app');
if ($mysqli->connect_errno) {
    echo "Ошибка: Не удалась создать соединение с базой MySQL : \n";
    echo "Номер ошибки: " . $mysqli->connect_errno . "\n";
    echo "Ошибка: " . $mysqli->connect_error . "\n";
    exit;
}

$sql = "INSERT INTO `favorite_list`(`title`, `film_id`, `poster_path`) VALUES ('$title','$film_id','$poster_path')";

if (mysqli_query($mysqli, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "" . mysqli_error($mysqli);
}

$mysqli->close();
?>