<?php
include_once("src/DatabaseConnector.php");
$connection = new DatabaseConnector();

$id = isset($_POST['checkedIdList']) ? $_POST['checkedIdList'] : 'Wrong Data';

foreach ($id as $value) {
    $connection->deleteStudent($value);
}

