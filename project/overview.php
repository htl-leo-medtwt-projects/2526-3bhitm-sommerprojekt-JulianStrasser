<?php

$conn = new mysqli("db_server", "root", "rootpassword", "MovieNote");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $release_date = $_POST['releaseDate'];
    $already_watched = isset($_POST['alreadyWatched']) ? 1 : 0;
    $watched_date = $_POST['watchedDate'];
    
    // Generate a unique movie_id
    $max_id_result = $conn->query("SELECT MAX(movie_id) FROM Movie");
    $max_id = $max_id_result->fetch_row()[0] ?? 0;
    $movie_id = $max_id + 1;
    
    $stmt = $conn->prepare("INSERT INTO Movie (movie_id, title, release_date, already_watched, watched_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issis", $movie_id, $title, $release_date, $already_watched, $watched_date);
    $stmt->execute();
    $stmt->close();
    // Redirect to avoid resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$result = $conn->query("SELECT * FROM Movie"); 

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieNote - Overview</title>
    <link rel="stylesheet" href="style.css">
    <script src="Javascript/script.js" defer></script>
    <script src="Javascript/script.js" defer></script>
</head>
<body id="overviewBody">
    <div id="header">
        <h1>MovieNote</h1>
    </div>
    
    <div id="navigation">
        <a href="index.php"><div>Start</div></a>
        <a href="overview.php"><div>Overview</div></a>
        <a href="calendar.php"><div>Calendar</div></a>
        <a href="notes.php"><div>Notes</div></a> 
    </div>

    <div id="overview">
        <div id="addBox" class="ovBox" onclick="printMovieAddForm()">
            <img src="img/plus.png" alt="plus.png">
            <p>Add movie</p>
        </div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='ovBox movieBox'>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<p>Release Date: " . htmlspecialchars($row['release_date']) . "</p>";
                echo "<p>Already Watched: " . ($row['already_watched'] ? 'Yes' : 'No') . "</p>";
                if ($row['already_watched'] && $row['watched_date']) {
                    echo "<p>Watched Date: " . htmlspecialchars($row['watched_date']) . "</p>";
                }
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>