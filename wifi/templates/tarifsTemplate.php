<?php
include_once("src/DatabaseConnector.php");
$connection = new DatabaseConnector();
$tarif = $connection->getTarifs();
foreach ($tarif as $key=>$value) {
    echo '<option>' . $value . '</option>';
}

