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

<div class="container pl-5 mb-5">
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
    <hr>
    <div class="form">
        <h1 class="text-center mt-5">Make your account today!</h1>
        <form action="newUser.php" method="post">
            <div class="form-group">
                <label for="Input1">Superhero Name</label>
                <input type="text" class="form-control" name="heroname" id="heroname" placeholder="Name">
            </div>
            <div class="ability">
                <label for="exampleFormControlSelect2">What's your greatest power?</label>
                <select multiple class="form-control" name="ability" id="ability">
                    <?php
                    $sql = "SELECT * FROM abilities";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option>$row[ability]</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Tell us about yourself</label>
                <textarea class="form-control" name="biography" id="biography" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Upload Profile</label>
                <input type="file" class="form-control-file" id="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

</body>

</html>