function slideshow() {
    let SLIDESHOW_SIZE = 5;
    let indexBody = document.getElementById("indexBody");
    let k = 2;

    setInterval(function() {
        indexBody.style.backgroundImage = "url(img/slideshow/img" + k + ".webp)";

        console.log(indexBody.style.backgroundImage)

        if (k+1 > SLIDESHOW_SIZE) {
            k = 1;
        } else {
            k++;
        }
    }, 5000);    
}

function printMovieAddForm() {
    document.body.innerHTML += `
    <form id="addMovieForm" method="POST" action="addMovie.php">
        <div class="optionContainer">
            <p>Title of movie</p>
            <input type="text" name="title" id="title" required>
        </div>
        <div class="optionContainer">
            <p>Already watched</p>
            <input type="checkbox" name="alreadyWatched" id="alreadyWatched" required>
        </div>
        <div class="optionContainer">
            <p>Date released</p>
            <input type="date" name="releasedDate" id="releasedDate" required>
        </div>
        <div class="optionContainer">
            <p>Date watched</p>
            <input type="date" name="watchedDate" id="watchedDate" required>
        </div>
        <input type="submit" value="Add Movie" name="submit">
</form>
    `;
}


slideshow();