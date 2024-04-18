const search = document.getElementById('search_input');
const contentContainer = document.querySelector(".content-items");

search.addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const searchQuery = search.value.trim();
        window.location.href = "/search/" + encodeURIComponent(searchQuery);
    }
});