<?php

require "connection.php";
require "header.php";

$method = $_GET["method"];
$id = $_GET["id"];


if($method == "deleteAbility"){
    deleteAbility($id);
}

if($method == "addFriend") {
    addFriend($id);
}


function deleteAbility($id) {
   $sql = "DELETE FROM ability_hero WHERE hero_ability_id = $id";
   $result = $GLOBALS["conn"]->query($sql);
   echo $result;

}

function addFriend($id) {
    $sql = "UPDATE relationships SET type_id = '1' WHERE rel_id = $id";
    $result = $GLOBALS["conn"]->query($sql);
    echo $result;
}

$conn->close();

header("Location: /index.php");

?>