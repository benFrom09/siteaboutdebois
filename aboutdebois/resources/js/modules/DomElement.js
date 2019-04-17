const DomElement = {
    loader: document.querySelector('.site-wrapper'),
    nav: document.querySelector('.navbar'),
    categories: {
        deleteBtn: document.querySelectorAll('.btn[data-name="delete-category"]'),
    },
    fileInput: document.querySelector('input[type="file"]'),
    imagePreview: document.querySelector('#preview'),
    imageManagers: document.querySelectorAll('.toggleIcons'),
};

export default DomElement;