"use strict";
/// Establishes the redirect behaviour for the movieCards on the home screen.
//  Makes a click  redirect to the listings page with the active movie as the id of the movie that was clicked on by the user
function initialise() {
    document.querySelectorAll(".movie-card").forEach((item) => item.addEventListener("click", function _() {
        location.href = `index.php?page=listings&movie=${this.getAttribute("id")}`;
    }));
}
document.addEventListener("DOMContentLoaded", initialise);
