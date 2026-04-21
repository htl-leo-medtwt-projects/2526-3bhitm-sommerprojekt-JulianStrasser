function slideshow() {
    let SLIDESHOW_SIZE = 3;
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
            <div id="addMovieFormContainer">
                <form method="post" id="addMovieForm">
                    <h2>Add information about the movie/series</h2>
                    <p>Title: </p>
                    <input type="text" name="title" id="title" required>
                    <p>Release Date: </p>
                    <input type="date" name="releaseDate" id="releaseDate" required>
                    <p>Already Watched: </p>
                    <input type="checkbox" name="alreadyWatched" id="alreadyWatched">
                    <p>Watch Date: </p>
                    <input type="date" name="watchedDate" id="watchedDate">
                    <br><br>
                    <input type="submit" value="Add Movie">
                </form>
            </div>
    `
}

slideshow();