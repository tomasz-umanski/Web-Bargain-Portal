const search = document.getElementById('search_input');
const contentContainer = document.querySelector(".content");
const subnavContainer = document.querySelector(".subnav");
const headerContainer = document.querySelector(".favourites-header");
const postTemplate = document.querySelector("#post_template");

search.addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        const data = {search: this.value};
        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (posts) {
            contentContainer.innerHTML = "";
            if (!!subnavContainer) {
                subnavContainer.innerHTML = "";
                subnavContainer.style.display = "none";
            }
            if (!!headerContainer) {
                headerContainer.innerHTML = "";
                headerContainer.style.display = "none";
            }
            loadPosts(posts);
        });
    }
});

function loadPosts(posts) {

    posts.forEach(post => {
        createPost(post);
    });
    contentContainer.classList.add('navbar-margin');
    initializeLikeButtons();
    initializeFavouriteButtons();
}

function createPost(post) {
    const clone = postTemplate.content.cloneNode(true);

    const contentItem = clone.querySelector('.content-item');
    contentItem.id = post.id;

    const image = clone.querySelector(".content-image img");
    image.src = image.src + post.imageUrl;

    const username = clone.querySelector(".content-user-data-username");
    username.textContent = post.userName;

    const uploadDate = clone.querySelector(".content-user-data-upload-date");
    uploadDate.textContent = post.creationDateDiff;

    const endDate = clone.querySelector(".content-user-data-end-date");
    endDate.textContent = post.endDateDiff;

    const title = clone.querySelector(".content-item-title");
    title.textContent = post.title;

    const description = clone.querySelector(".content-item-description");
    description.textContent = post.description;

    const currentPrice = clone.querySelector(".content-current-price");
    currentPrice.textContent = post.newPrice;

    const oldPrice = clone.querySelector(".content-old-price");
    oldPrice.textContent = post.oldPrice;

    const deliveryPrice = clone.querySelector(".content-item-delivery-price span:last-child");
    deliveryPrice.textContent = post.deliveryPrice;

    const likes = clone.querySelector(".content-like p");
    likes.textContent = post.likesCount;

    const catchDealLink = clone.querySelector(".content-catchdeal");
    catchDealLink.href = post.offerUrl;

    contentContainer.appendChild(clone);
}