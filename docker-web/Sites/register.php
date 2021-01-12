<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css" type="text/css">
    <link rel="stylesheet" href="Assets/css/register.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <a href="index.php" style="border-radius: 15px;">Go Back</a>
    <form action=" register.php" method="post" id="register-form">
        <h3 style="margin-bottom:15px;font-size:20px; font-weight: bold;">Personal Data</h3>
        <label for="getfirstname">Firstname</label>
        <input placeholder="Firstname" name="firstname" autocomplete="off" type="text" id="getfirstname" style="border-radius: 15px;"><br>
        <label for=" getlastname">Lastname</label>
        <input placeholder="Lastname" name="lastname" autocomplete="off" type="text" id="getlastname" style="border-radius: 15px;"><br>
        <h3 style="margin-bottom:15px;font-size:20px;font-weight: bold;">Coordinates</h3>
        <label for="getlatitude">Longitude</label>
        <input placeholder="Longitude" name="latitude" autocomplete="off" type="text" id="getlatitude" style="border-radius: 15px;"><br>
        <label for=" getlongitude">Latitude</label>
        <input placeholder="Latitude" name="longitude" autocomplete="off" type="text" id="getlongitude" style="border-radius: 15px;"><br>
        <input type="color" name="color" id="colorpicker" value="#0000ff" style="border-radius: 15px;">
        <button type=" submit" name="submit" class="registerbtn" style="border-radius: 15px;">Register</button>
    </form>
    <?php
    session_start();
    $servername = "mysql27j08.db.hostpoint.internal";
    $username = "pifigese_Nothin";
    $password = "spedy=1Ar";
    $dbname = "pifigese_happyplacepj";
    $errors = array();
    // $queryString = http_build_query([
    //     'access_key' => '9b0d4ce6c220fed4874b61140ec1c163',
    //     'query' => '1600 Pennsylvania Ave NW',
    //     'region' => 'Washington',
    //     'output' => 'json',
    //     'limit' => 1,
    // ]);

    // $ch = curl_init(sprintf('%s?%s', 'https://api.positionstack.com/v1/forward', $queryString));
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // $json = curl_exec($ch);

    // curl_close($ch);

    // $apiResult = json_decode($json, true);

    // print_r($apiResult);​
    // connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $color = $_POST['color'];
        if (empty($firstname)) {
            array_push($errors, "Firstname missing");
        }
        if (empty($lastname)) {
            array_push($errors, "Lastname missing");
        }
        if (empty($latitude)) {
            array_push($errors, "Latitude missing");
        }
        if (empty($longitude)) {
            array_push($errors, "Longitude missing");
        }
        if (empty($color)) {
            array_push($errors, "Color missing");
        }

        $sql_count = "SELECT COUNT(id) FROM apprentices";
        $result_count = $conn->query($sql_count);
        $count = $result_count->fetch_array(MYSQLI_BOTH);
        $newid = $count[0] + 1;
        $sql_check = "SELECT prename, lastname FROM apprentices WHERE prename='$firstname';";
        $result_check = $conn->query($sql_check);
        $check = $result_check->fetch_array(MYSQLI_BOTH);
        if ($check[0] === $firstname && $check[1] === $lastname) {
            array_push($errors, "Person '$firstname $lastname' does already exists");
        }
        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $sql_set_place = "INSERT INTO places (id, latitude, longitude) VALUES($newid, '$latitude', '$longitude')";
            $result_set = $conn->query($sql_set_place);
            $sql_set_mark = "INSERT INTO markers (id, color) VALUES($newid, '$color')";
            $result_set = $conn->query($sql_set_mark);
            $sql_set_appr = "INSERT INTO apprentices (prename, lastname, place_id, markers_id) VALUES('$firstname', '$lastname', $newid, $newid)";
            $result_set = $conn->query($sql_set_appr);
            header('Location:index.php');
        } else {
            echo "<div id='error-container'>";
            for ($a = 0; $a < count($errors); $a++) {
                echo "<p class='error'>" . $errors[$a] . "</p><br>";
            }
            echo "</div>";
        }
    }
    ?>
</body>

</html>