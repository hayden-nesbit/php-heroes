<?php

require "connection.php";
require "header.php";

$method = $_GET["method"];
$id = $_GET["id"];
$heroId = $_GET["hero"];


if($method == "deleteAbility"){
    deleteAbility($id);
}

if($method == "addFriend") {
    addFriend($id);
}

if($method == "unFriend") {
    unFriend($id);
}

if($method == "getAbility") {
    getAbility($id, $heroId);
}

function unFriend($id) {
    $sql = "UPDATE relationships SET type_id = '2' WHERE rel_id = $id";
    $result = $GLOBALS["conn"]->query($sql);
 }

function deleteAbility($id) {
   $sql = "DELETE FROM ability_hero WHERE hero_ability_id = $id";
   $result = $GLOBALS["conn"]->query($sql);
}

function addFriend($id) {
    $sql = "UPDATE relationships SET type_id = '1' WHERE rel_id = $id";
    $result = $GLOBALS["conn"]->query($sql);
}

function getAbility($id, $heroId) {
    $sql = "INSERT INTO ability_hero (ability_id, hero_id) VALUES ($id, $heroId)";
    $result = $GLOBALS["conn"]->query($sql);
}

$conn->close();

header("Location: /hero.php?id=" . $heroId);

?>