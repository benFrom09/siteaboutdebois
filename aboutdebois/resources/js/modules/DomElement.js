const DomElement = {
    loader: document.querySelector('.site-wrapper'),
    nav: document.querySelector('.navbar'),
    categories: {
        deleteBtn: document.querySelectorAll('.btn[data-name="delete-category"]'),
    },
    fileInput: document.querySelector('input[type="file"]'),
    imagePreview: document.querySelector('#preview'),
    imageManager: {
        deleteBtn: document.querySelectorAll('.image-delete'),
        editImgDescriptionBtn: document.querySelectorAll('.description-edit'),
        editImgCategoryBtn: document.querySelectorAll('.category-edit'),
        imgPublish: document.querySelectorAll('.img-publish'),
    },
};

export default DomElement;