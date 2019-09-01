<?php
$mysqli = new mysqli('localhost', 'root', '', 'vue_film_app');
if ($mysqli->connect_errno) {
    echo "Извините, возникла проблема на сайте";
    echo "Ошибка: Не удалась создать соединение с базой MySQL и вот почему: \n";
    echo "Номер ошибки: " . $mysqli->connect_errno . "\n";
    echo "Ошибка: " . $mysqli->connect_error . "\n";
    exit;
}

$sql = "SELECT * FROM `towatch_list`";

if (!$result = $mysqli->query($sql)) {
    echo "Извините, возникла проблема в работе сайта.";
    echo "Ошибка: Наш запрос не удался и вот почему: \n";
    echo "Запрос: " . $sql . "\n";
    echo "Номер ошибки: " . $mysqli->errno . "\n";
    echo "Ошибка: " . $mysqli->error . "\n";
    exit;
}
if ($result->num_rows === 0) {
    echo "Мы не смогли найти совпадение для $aid, простите. Пожалуйста, попробуйте еще раз.";
    exit;
}


$obj = [];

while ($row = mysqli_fetch_assoc($result)){
    $obj[] = $row;
}
echo json_encode($obj);

$result->free();
$mysqli->close();
?>