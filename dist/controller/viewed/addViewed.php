<?php

$title = $_POST['title'];
$film_id = $_POST['film_id'];
$date = date('Y-m-d H:i:s');
$poster_path = $_POST['poster_path'];

$mysqli = new mysqli('bronson4.mysql.tools', 'bronson4_films', '5Kv91t*K*c', 'bronson4_films');
$mysqli->set_charset("utf8");
if ($mysqli->connect_errno) {
    echo "Ошибка: Не удалась создать соединение с базой MySQL : \n";
    echo "Номер ошибки: " . $mysqli->connect_errno . "\n";
    echo "Ошибка: " . $mysqli->connect_error . "\n";
    exit;
}

$sql = "INSERT INTO `viewed_list`( `title`, `film_id`, `date`, `poster_path`) VALUES ('$title','$film_id','$date','$poster_path')";

if (mysqli_query($mysqli, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "" . mysqli_error($mysqli);
}

$mysqli->close();
?>