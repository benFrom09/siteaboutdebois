const DomElement = {
    loader: document.querySelector('.site-wrapper'),
    nav: document.querySelector('.navbar'),
    frontNav: document.querySelector('nav'),
    scrollBarInc: document.getElementById("bar"),
    pageContainer: document.querySelector(".page-container"),
    sectionCover: document.getElementById("cover"),
    sectionPresentation: document.getElementById("presentation"),
    sectionRealisation: document.getElementById("realisations"),
    modalRealisation: document.querySelector(".modal-realisation"),
    sectionSAbout: document.getElementById("s-about"),
    sectionSContact: document.getElementById("s-contact"),
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