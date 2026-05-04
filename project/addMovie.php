<?php

$_db_host = "db_server";
$_db_username = "web";
$_db_password = "database-password";
$_db_datenbank = "web";

$conn = new mysqli(
    $_db_host,
    $_db_username,
    $_db_password,
    $_db_datenbank
);

if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}

if (!empty($_POST["submit"])) {
    
    $_title = $conn->real_escape_string($_POST["title"]);
    $_alreadyWatched = $conn->real_escape_string($_POST["alreadyWatched"]);

    if ($_alreadyWatched === "on") {
        $_alreadyWatched = 1;
    }

    if ($_alreadyWatched === "off") {
        $_alreadyWatched = 0;
    }

    $request = "SELECT movie_id FROM Movie WHERE movie_id LIKE (
                    SELECT MAX(movie_id) FROM Movie)";
    $result = $conn->query($request);   
    $rows = $result->fetch_assoc();

   // var_dump($rows);
// Programming Languages Tier list

    
    if ($rows["movie_id"] != null) {
            $lastId = $rows["movie_id"];
    } else {
            $lastId = -1;
    }
    


    $currentId = $lastId + 1;
    $_watchedDate = $conn->real_escape_string($_POST["watchedDate"]);
    $_releasedDate = $conn->real_escape_string($_POST["releasedDate"]);

    $insertStatement = "INSERT INTO Movie (movie_id, title, alreadyWatched, isFavourite, watchedDate, releasedDate)
                        VALUES ('$currentId', '$_title', '$_alreadyWatched',  0, '$_watchedDate', '$_releasedDate')";


if ($_res = $conn->query($insertStatement)) {
    include("overview.php");
  //  printMessage("Successfuly added movie!", "success");
} else {
    
    
}

}


function printMessage($message, $type) {

    if ($type === "success") {
        echo "<div class='msg' style='background-color: green'>";
        echo $message;
        echo "</div>";
    } elseif ($type === "error") {
        echo "<div class='msg' style='background-color: red'>";
        echo $message;
        echo "</div>";
    } elseif ($type === "warning") {
        echo "<div class='msg' style='background-color: orange'>";
        echo $message;
        echo "</div>";
    }
 
    

}


?>