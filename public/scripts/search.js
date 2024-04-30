const search = document.getElementById('search_input');
const contentContainer = document.querySelector(".content-items");

search.addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();

        if(!isSearchPage()) {
            const searchQuery = search.value.trim();
            window.location.href = "/search/" + encodeURIComponent(searchQuery);
        } else {
            //fetch api
        }
    }
});

function isSearchPage() {
    return window.location.pathname.startsWith("/search/");
}