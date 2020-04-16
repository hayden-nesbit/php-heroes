<?php
require "connection.php";
require "header.php";
require "footer.php";
$id = $_GET["id"];

function getInfo($data, $table, $occasion)
{
    $sql = "SELECT $data FROM $table WHERE $occasion";
    $result = $GLOBALS["conn"]->query($sql);
    return $result;
}

function getRelationship($type_id)
{
    $sql = "SELECT * FROM relationships 
            INNER JOIN heroes on relationships.hero2_id=heroes.id 
            WHERE (hero1_id = " . $GLOBALS["id"] . ") AND (type_id = " . $type_id . ")";
    $result = $GLOBALS["conn"]->query($sql);
    return $result;
}

?>

<div class="jumbotron">
    <?php
    $count = 0;
    echo "<img src='./img/hero" . $id . ".pg.png'/>
    <hr class='my-1'>
    <p class='lead'><i class='fas fa-thumbs-up'></i>  " . $count . "</p>"
    ?>
</div>

<div class="container p-3 mb-5">
    <div class="pl-4">
        <?php
        $sql = "SELECT * FROM heroes WHERE id = " . $id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $output = "";
            while ($row = $result->fetch_assoc()) {
                $output .= "<h3> $row[name]</h3></a>" . $row["biography"] . "<br>" . "<br>";
                "<br";
            }
            echo $output;
        }
        ?>
    </div>


    <div class="pl-4">
        <h5>Allies</h5>

        <?php
        $result = getRelationship(1);
        if ($result->num_rows > 0) {
            $output = "";;
            while ($row = $result->fetch_assoc()) {
                $output .= "<li class='pl-3'>$row[name]</li>";
            }
            echo $output;
        } else {
            echo "<p class='pl-5'>0 Allies</p>";
        }
        ?>
    </div>

    <div class="pl-4 mt-3">
        <h5>Enemies</h5>
        <?php
        $result = getRelationship(2);
        if ($result->num_rows > 0) {
            $output = "";
            while ($row = $result->fetch_assoc()) {
                $output .= "<li class='pl-3'>$row[name] <a href='data.php?method=addFriend&type_id=2'>Friend Request</a> </li>";
            }

            echo $output;
            echo "<br>";
        } else {
            echo "<p class='pl-5'>No Enemies...yet</p>";
        }
        ?>
    </div>


    <div class="pl-4 mt-3">
        <h5>Super Powers</h5>

        <?php
        $sql = "SELECT * FROM ability_hero
                    INNER JOIN abilities on abilities.id=ability_hero.ability_id
                    INNER JOIN heroes on heroes.id=ability_hero.hero_id
                    WHERE (ability_hero.hero_id = $id)";
        $result = $GLOBALS["conn"]->query($sql);
        if ($result->num_rows > 0) {
            $output = "";
            while ($row = $result->fetch_assoc()) {
                $pwr = $row["hero_ability_id"];
                $output .= "<li class='pl-3'>$row[ability] <a href='data.php?method=deleteAbility&id=$pwr'>Delete power</a> </li>";
            }
            echo $output;
        } else {
        }
        ?>
    </div>

</div>


<?php
$conn->close();
?>