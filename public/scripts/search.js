const search = document.getElementById('search_input');
const contentContainer = document.querySelector(".content-items");

search.addEventListener("keyup", function (event) {
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
            loadPosts(posts)
        });
    }
});

function loadPosts(posts) {
    posts.forEach(post => {
        createPost(post);
    });
}

function createPost(project) {
    const template = document.getElementById('post_template');
    const clone = template.content.cloneNode(true);
    console.log(clone);

    // const div = clone.querySelector("div");
    // div.id = project.id;
    // const image = clone.querySelector("img");
    // image.src = `/public/uploads/${project.image}`;
    // const title = clone.querySelector("h2");
    // title.innerHTML = project.title;
    // const description = clone.querySelector("p");
    // description.innerHTML = project.description;
    // const like = clone.querySelector(".fa-heart");
    // like.innerText = project.like;
    // const dislike = clone.querySelector(".fa-minus-square");
    // dislike.innerText = project.dislike;

    contentContainer.appendChild(clone);
}
