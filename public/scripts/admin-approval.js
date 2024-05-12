async function handlePostAction(event, action) {
    const button = event.currentTarget;
    const container = button.parentElement.parentElement;
    try {
        const id = container.getAttribute("id");
        const lastUpdated = container.getAttribute('data-last-updated');
        const requestData = {
            id: id,
            lastUpdated: lastUpdated
        };

        console.log(requestData);
        const response = await fetch(`/${action}Post`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestData)
        });

        if (response.status === 200) {
            container.innerHTML = '';
        }

        const data = await response.json();

        if (data.hasOwnProperty('message')) {
            alert(data.message);
        }

    } catch (error) {
        alert('Error!');
        console.error('Error:', error);
    }
}

function initializeButtons(selector, actionFunction) {
    const buttons = document.querySelectorAll(selector);
    try {
        for (const button of buttons) {
            button.addEventListener("click", event => handlePostAction(event, actionFunction));
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

initializeButtons(".approve-post", "approve");
initializeButtons(".reject-post", "reject");
