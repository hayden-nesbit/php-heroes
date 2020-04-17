<?php
require "connection.php";
require "header.php";
?>

<div class="jumbotron">
    <h1 class="display-4">Welcome Supers!</h1>
    <p class="lead">Keep tabs on your most trusted allies, your most feared enemies, and update others on your growing powers.</p>
    <hr class="my-4">
</div>

<div class="container pl-1 mb-5">
    <div class="row">
        <div style="overflow: scroll; max-height: 800px;" class="col-md-3">
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
                            '<div class="card mb-3 bg-white" style="width: 18rem;">
                                <img class="card-img-top" src="./img/hero' . $heroImg . '.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">' . $row["name"] . '</h5>
                                <p class="card-text">' . $row["about_me"] . '</p>
                                <a href=' . $hero . ' class="btn btn-primary">About me</a>
                          
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
        <div class="col">
            <div class="row">
                <div class="col-md-8">
                    <form action="newPost.php" method="post">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mb-3 float-right">Post</button>
                            <h2 for="exampleFormControlTextarea1">What's on your mind?</h2>
                            <textarea class="form-control" name="post" id="post" rows="3"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div style="overflow: scroll; max-height: 650px;" class="col-md-8">
                <?php
                $sql = "SELECT * FROM posts ORDER BY id DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $posts = "";
                    while ($row = $result->fetch_assoc()) {
                        $posts .= '<div class="card mb-3">
                        <h5 class="card-header bg-white">'
                            . $row['name'] .
                            '</h5>
                        <div class="card-body">
                            <p>' . $row['post'] . '</p>
                            <footer class="text-muted"><i class="far fa-thumbs-up">  Like</i><i class="far fa-comment-alt float-right">  Comment</i></footer>
                        </div>
                      </div>';
                    }
                    echo $posts;
                }
                ?>
            </div>
        </div>
    </div>

    <!-- --------------------------- FORM SECTION ----------------------------- -->

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
                <select multiple class="form-control" name="ability[]" id="ability">
                    <?php
                    $sql = "SELECT * FROM abilities";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='$row[id]'>$row[ability]</option>";
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
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

</body>
<?php
require "footer.php";
?>

</html>