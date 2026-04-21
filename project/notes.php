

<?php

$conn = new mysqli("db_server", "root", "rootpassword", "MovieNote");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM Movie");
$movies = [];
while ($row = $result->fetch_assoc()) {
    $movies[] = $row;
}

if (isset($_GET['movie'])) {
    $current = (int)$_GET['movie'];
} else {
    $current = 0;
}

if ($current < 0) $current = 0;
if ($current >= count($movies)) $current = count($movies) - 1;
if (isset($movies[$current])) {
    $movie = $movies[$current];
} else {
    $movie = null;
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieNote - Notes</title>
    <link rel="stylesheet" href="style.css">
    <script src="Javascript/script.js" defer></script>
</head>
<body id="notesBody">
    <div id="header">
        <h1>MovieNote</h1>
    </div>
    
    <div id="navigation">
        <a href="index.php"><div>Start</div></a>
        <a href="overview.php"><div>Overview</div></a>
        <a href="calendar.php"><div>Calendar</div></a>
        <a href="notes.php"><div>Notes</div></a> 
    </div>

    <div id="movieBox">
        <?php if ($movie): ?>
            <h1><?php echo htmlspecialchars($movie['title']); ?></h1>
            <p>Release Date: <?php echo htmlspecialchars($movie['release_date']); ?></p>
            <p>Already Watched: <?php echo $movie['already_watched'] ? 'Yes' : 'No'; ?></p>
            <?php if ($movie['already_watched'] && $movie['watched_date']): ?>
                <p>Watched Date: <?php echo htmlspecialchars($movie['watched_date']); ?></p>
            <?php endif; ?>
            <div class="slider-controls">
                <?php if ($current > 0): ?>
                    <a href="?movie=<?php echo $current - 1; ?>" class="slider-btn">Previous</a>
                <?php endif; ?>
                <span class="slider-indicator"><?php echo $current + 1; ?> / <?php echo count($movies); ?></span>
                <?php if ($current < count($movies) - 1): ?>
                    <a href="?movie=<?php echo $current + 1; ?>" class="slider-btn">Next</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <h1>No movies available</h1>
        <?php endif; ?>
    </div>


</body>
</html>