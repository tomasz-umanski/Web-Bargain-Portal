const dropdownIds = ["categories", "account", "subnav"];
const dropdowns = dropdownIds.reduce((acc, id) => {
    let element = document.getElementById(`${id}_dropdown`);
    if (element != null) {
        acc[id] = element
    }
    return acc;
}, {});
const searchButton = document.getElementById('search_button');

const navbar = document.getElementById("navbar");
let prevScrollPos = window.scrollY;
let ticking = false;

function closeDropdowns() {
    Object.values(dropdowns).forEach(dropdown => {
        dropdown.classList.remove("dropdown-content-visible");
    });
}

function closeDropdowns(id) {
    Object.values(dropdowns).forEach(dropdown => {
        if (dropdown.id != id) {
            dropdown.classList.remove("dropdown-content-visible");
        }
    });
}

function handleScroll() {
    const currentScrollPos = window.scrollY;
    closeDropdowns();
    let shouldToggle = currentScrollPos > 35
    let isScrollingUp = prevScrollPos > currentScrollPos 
    navbar.style.top = shouldToggle ? `${isScrollingUp ? "0" : "-10vh"}` : "0";
    navbar.style.boxShadow = shouldToggle ? `${isScrollingUp ? "rgba(77, 71, 195, 0.45) 0px 5px 30px 0px" : "none"}` : "rgba(77, 71, 195, 0.45) 0px 5px 30px 0px";
    prevScrollPos = currentScrollPos;
}

function toggleDropdown(name) {
    closeDropdowns(dropdowns[name].id);
    dropdowns[name].classList.toggle("dropdown-content-visible");
}

function toggleSearchBar() {
    searchButton.classList.add("search-button-visible");
}

function handleClick(event) {
    const isClickInsideDropdown = event.target.closest('.dropdown');
    if (!isClickInsideDropdown) {
        closeDropdowns();
    }
    const isClickInsideSearch = event.target.closest('.search-button');
    if(!isClickInsideSearch) {
        searchButton.classList.remove("search-button-visible");
    }
}

window.addEventListener("scroll", handleScroll);
document.body.addEventListener("click", handleClick);