const fileInput = document.getElementById('photo');
const fileInputLabel = fileInput.previousElementSibling;

fileInput.addEventListener('change', e => {
    const fileName = e.target.value.split( '\\' ).pop();
    if (fileName)
        fileInputLabel.querySelector('span').innerHTML = fileName;
});