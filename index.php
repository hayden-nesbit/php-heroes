<?php
require "connection.php";
require "header.php";
require "footer.php";
?>

<div class="jumbotron">
    <h1 class="display-4">Welcome Supers!</h1>
    <p class="lead">Keep tabs on your most trusted allies, your most feared enemies, and update others on your growing powers.</p>
    <hr class="my-4">
</div>

<div class="container pl-5">
    <div id="herocard" class="row">
        <?php
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

            echo $output;
        } else {
            echo "0 results";
        }
        ?>

    </div>
</div>

</body>

</html>