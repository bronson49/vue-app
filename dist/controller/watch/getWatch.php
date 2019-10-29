<?php
error_reporting(E_ALL) ;
//$mysqli = new mysqli('localhost', 'root', '', 'vue_film_app');
$mysqli = new mysqli(
    'bronson4.mysql.tools',
    'bronson4_films',
    '5Kv91t*K*c',
    'bronson4_films');
$mysqli->set_charset("utf8");
if ($mysqli->connect_errno) {
    echo "Номер ошибки: " . $mysqli->connect_errno . "\n";
    echo "Ошибка: " . $mysqli->connect_error . "\n";
    exit;
}

$sql = "SELECT * FROM `towatch_list`";

if (!$result = $mysqli->query($sql)) {
    echo "Запрос: " . $sql . "\n";
    echo "Номер ошибки: " . $mysqli->errno . "\n";
    echo "Ошибка: " . $mysqli->error . "\n";
    exit;
}
if ($result->num_rows === 0) {
    echo "Нет совпадений.";
    exit;
}


$obj = [];

while ($row = $result->fetch_assoc()){
    $obj[] = $row;
}
echo json_encode($obj);

$result->free();
$mysqli->close();
?>