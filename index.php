<?php

require "connection.php";
require "header.php";

echo '<div class="jumbotron">
<h1 class="display-4">Welcome Supers!</h1>
<p class="lead">Keep tabs on your most trusted allies, your most feared enemies, and update others on your growing powers.</p>
<hr class="my-4">
</div>';

$sql = "SELECT * FROM heroes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $output = "";
    echo '<div class="container pl-5">';
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) {
        $hero = "hero.php?id=" . $row["id"];
        $output .=
            '<div class="col-md-4 col-sm-12">
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
