<?php
require "connection.php";
require "header.php";
$id = $_GET["id"];


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
    <hr class='my-1'>"
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

    <div class="row">
        <div class="col-6">
            <div class="pl-4">
                <h5>Allies</h5>

                <?php
                $result = getRelationship(1);
                if ($result->num_rows > 0) {
                    $output = "";;
                    while ($row = $result->fetch_assoc()) {
                        $output .= "<li class='pl-3'>" . $row['name'] . "<a style='font-size: 70%' href='data.php?method=unFriend&hero=" . $id . "&id=" . $row['rel_id'] . "'> Unfriend</a> </li>";
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
                        $output .= "<li class='pl-3'>" . $row['name'] . "<a style='font-size: 70%' href='data.php?method=addFriend&hero=" . $id . "&id=" . $row['rel_id'] . "'> Friend Request</a> </li>";
                    }

                    echo $output;
                } else {
                    echo "<p class='pl-3'>No Enemies...yet</p>";
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
                        $output .= "<li class='pl-3'>" . $row['ability'] . "<a style='font-size: 70%' href='data.php?method=deleteAbility&hero=" . $id . "&id=" . $pwr . "'> Delete power</a> </li>";
                    }
                    echo $output;
                } else {
                    echo "<p class='pl-3'>No Powers... WEAK SAUCE!!!</p>";
                }
                ?>
            </div>
        </div>
        <div class="col-4 offset-2">
            <div class="border border-dark rounded bg-light p-3">
                <h5 class="p-2">Pick up powers</h5>
                <?php
                $sql = "SELECT * FROM ability_hero
                INNER JOIN abilities on abilities.id=ability_hero.ability_id
                INNER JOIN heroes on heroes.id=ability_hero.hero_id
                WHERE (ability_hero.hero_id <> $id)";
                $result = $GLOBALS["conn"]->query($sql);
                if ($result->num_rows > 0) {
                    $output = "";
                    while ($row = $result->fetch_assoc()) {
                        $pwr = $row["ability_id"];
                        $output .= "<p class='pl-3'>$row[ability] <a style='font-size: 70%' href='data.php?method=getAbility&hero=" . $id . "&id=" . $pwr . "'> Get power</a> </p>";
                    }
                    echo $output;
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
$conn->close();
?>
<?php
require "footer.php";
?>