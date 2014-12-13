<?php
include_once('src/DatabaseConnector.php');

$connection = new DatabaseConnector();
$groups = $connection->getGroups();

foreach ($groups as $group) {
    echo '<details><summary class="checkbox"><label><input type="checkbox" class="groupCheckbox ' . $group . 'Checkbox"> ' . $group . '</label></summary><table class="table col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">';
    $users = $connection->getStudents($group);
    echo '<thead>';
    echo '<tr>';
    echo '<th></th>';
    echo '<th>ID</th>';
    echo '<th>USERNAME</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    for ($i = 0; $i < sizeof($users); $i++) {
        echo '<tr id="' . $users[$i]["id"] . '">';
        echo '<td><input type="checkbox" value="' . $users[$i]["id"] . '" class="groupChildCheckbox ' . $group . 'CheckboxChild"></td>';
        echo '<td>' . $users[$i]["id"] . '</td>';
        echo '<td>' . $users[$i]["username"] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table></details>';
}

