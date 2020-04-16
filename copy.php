<?php

$userName = $_POST["heroname"]; 
$userBio = $_POST["biography"];
$userPower = $_POST["ability"];
$userPic = $_POST["image"];

$sql = "INSERT INTO heroes (name, biography, image_url) VALUES ('$userName', '$userBio', '$userPic')";
$result = $conn->query($sql);

if ($result === TRUE) {
    $last_id = $conn->insert_id;
    echo $last_id;
}

?>

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
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>