<?php

$id = $_GET["id"];

$sql = "SELECT * FROM heroes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $output = "";
    while ($row = $result->fetch_assoc()) {
        $heroImg = $row["id"];
        $hero = "hero.php?id=" . $row["id"];
        $output .=
            '<div class="col-md-4 col-sm-12">
                <div class="card mb-3 bg-light" style="width: 18rem;">
                <img class="card-img-top" src="./img/hero' . $heroImg . '.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">' . $row["name"] . '</h5>
                        <p class="card-text">' . $row["about_me"] . '</p>
                        <a href=' . $hero . ' class="btn btn-primary">About me</a>
                    </div>
                    </div>
                </div>';
    }
    
    return $output;
   
} else {
    echo "0 results";
}

$conn->close();
?>