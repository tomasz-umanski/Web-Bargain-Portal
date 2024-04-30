const fileInput = document.getElementById('photo');
const fileInputLabel = fileInput.previousElementSibling;

const maxSize = 2 * 1024 * 1024;

fileInput.addEventListener('change', e => {
    const file = e.target.files[0];
    if (!file) {
        resetFileInput();
        return;
    }
    
    const fileName = file.name;
    const fileSize = file.size;

    if (fileSize > maxSize) {
        resetFileInput();
        alert('File size exceeds the maximum limit (2 MB). Please select a smaller file.');
        return;
    }

    updateFileInputLabel(fileName);
});

function resetFileInput() {
    fileInput.value = '';
    updateFileInputLabel('Upload photo');
}

function updateFileInputLabel(text) {
    fileInputLabel.querySelector('span').innerHTML = text;
}
