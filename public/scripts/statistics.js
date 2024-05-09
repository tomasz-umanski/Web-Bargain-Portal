async function togglePostLike(event) {
    const button = this;
    const container = button.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");
    
    try {
        const response = await fetch(`/togglePostLike/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        });
        
        if (response.redirected) {
            window.location.href = response.url;
            return;
        }

        const data = await response.json();
        if (data) {
            const likeCountElement = button.querySelector('p');
            const { action } = data;
            const likeCount = parseInt(likeCountElement.textContent);
            if (action === 'liked') {
                likeCountElement.textContent = likeCount + 1;
                button.classList.add('liked');
            } else if (action === 'disliked') {
                likeCountElement.textContent = likeCount - 1;
                button.classList.remove('liked');
            }
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

async function togglePostfavourite(event) {
    const button = this;
    const container = button.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");
    
    try {
        const response = await fetch(`/togglePostFavourite/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        });
        
        if (response.redirected) {
            window.location.href = response.url;
            return;
        }

        const data = await response.json();
        if (data) {
            if (data.action === 'favourited') {
                button.classList.add('favourited');
            } else if (data.action === 'unfavourited') {
                button.classList.remove('favourited');
            }
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

async function initializeLikeButtons() {
    const buttons = document.querySelectorAll(".content-like");
    try {
        for (const button of buttons) {
            const container = button.parentElement.parentElement.parentElement;
            const id = container.getAttribute("id");
            const response = await fetch(`/getPostLikeStatus/${id}`);
            const data = await response.json();
            if (data && data.isLiked) {
                button.classList.add('liked');
            }
            button.addEventListener("click", togglePostLike);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

async function initializeFavouriteButtons() {
    const buttons = document.querySelectorAll(".content-favourite");
    try {
        for (const button of buttons) {
            const container = button.parentElement.parentElement.parentElement;
            const id = container.getAttribute("id");
            const response = await fetch(`/getPostFavouriteStatus/${id}`);
            const data = await response.json();
            if (data && data.isFavourite) {
                button.classList.add('favourited');
            }
            button.addEventListener("click", togglePostfavourite);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

initializeLikeButtons();
initializeFavouriteButtons();