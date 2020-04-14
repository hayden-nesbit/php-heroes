<?php

require "connection.php";
require "header.php";

echo "<h1 class='text-center mt-5 mb-4'>Hello Supers!</h1>";

$sql = "SELECT * FROM heroes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $output = "";
    echo '<div class="container pl-5">';
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) {
        $hero = "hero.php?id=" . $row["id"];
        $output .=
            '<div class="col-4">
                <div class="card mb-3 bg-light" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">' . $row["name"] . '</h5>
                        <p class="card-text">' . $row["about_me"] . '</p>
                        <a href=' . $hero . ' class="btn btn-primary">About me</a>
                    </div>
                    </div>
                </div>';
    }

    echo $output;
    echo '</div>';
   
} else {
    echo "0 results";
}

$conn->close();
?>

</body>

</html>
