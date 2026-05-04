
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

        $request = "SELECT * FROM Movie";
        $result = $conn->query($request);   
        
        while ($row = $result->fetch_assoc()) {
            echo '<div class="ovBox">';
            echo '<h3>' . $row["title"] . '</h3>';
            echo '</div>';
        }


        
        ?>
    </div>
</body>
</html>