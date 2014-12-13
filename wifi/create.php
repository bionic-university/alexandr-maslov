<?php
require_once("src/DatabaseConnector.php");


$json = $_POST['jsonString'];
$students = json_decode($json);

$kkk = new DatabaseConnector();
foreach ($students as $key => $value) {
    $kkk->addStudent($students[$key]);
}



