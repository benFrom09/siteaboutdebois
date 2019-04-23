require('./bootstrap');
import './modules/menu';
import Swal from 'sweetalert2';
import DomElement from './modules/DomElement';
import Carousel from './modules/carousel/Carousel';
import 'slick-carousel/slick/slick';
import validator from 'validator';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';
import '../sass/slider.scss';
const App = {
    deleteRequest: {
        method: "DELETE",
        headers: {
            "X-Requested-Width": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        }
    },
    postRequest: {
        method: "POST",
        headers: {
            "X-Requested-Width": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        }
    },
    putRequest: {
        method: "PUT",
        headers: {
            "X-Requested-Width": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Content-Type": "application/json",
        }
    },
    loading() {
        document.body.style.overflowY = 'hidden';
        let timeout = window.setTimeout(() => {
            document.body.style.overflowY = 'auto';
            DomElement.loader.style.display = 'none';
            clearTimeout(timeout);
        }, 500);
    },
    escapeHtml(text) {

        let map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };

        return text.replace(/[&<>"']/g, function (m) { return map[m]; });

    },
    sliderFullscreen: false,
    carousel: null,
    isMobile: /iPhone|iPad|iPod|Android/i.test(navigator.userAgent),
    screenWidth: window.innerWidth,
    slick: null,
    validator: false,
    textarea: false,
    unlockForm(btn) {
        if (this.validator && this.textarea) {
            btn.disabled = false;
        }
        else {
            btn.disabled = true;
        }
    }

}

function initSlider() {
    return $(".slider").slick({
        infinite: false,
        speed: 300,
        centerPadding: "60px",
        slidesToShow: 4,
        arrows: true,
        dots: true,
        touchMove: true,
        responsive: [
            {
                breakpoint: 640,
                settings: 'unslick'
            }

        ]
    });
}

function toggleClassName(element, className) {
    if (element.classList.contains(className)) {
        element.classList.remove(className);
    }
    else {
        element.classList.add(className);
    }
}

function openModalRealisation(e) {
    document.querySelector(".slider-container").style.position = "static";
    DomElement.modalRealisation.style.display = "block";
    DomElement.modalRealisation.style.top = window.scrollY + "px";
}
function closeModalRealisation() {
    DomElement.modalRealisation.style.display = "none";
    DomElement.sectionCover.style.display = "block";
    DomElement.sectionPresentation.style.display = "block";
    DomElement.sectionSAbout.style.display = "block";
    DomElement.sectionSContact.style.display = "block";
}

if (window.location.pathname === '/abdb-admin/categories') {
    //delete a category
    DomElement.categories.deleteBtn.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            //POP UP
            Swal.fire({
                title: 'Vous etes sur le point de supprimer une catégorie',
                showCancelButton: true,
                type: 'warning',
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Oui',
                cancelButtonText: 'Non',
            }).then(result => {
                console.log(result);
                if (result.value) {
                    //request to delete file
                    fetch(item.href, App.deleteRequest).then(response => response.json()).then(data => {
                        //POP UP
                        document.querySelector(`tr[data-id="${item.dataset.id}"]`).remove();
                        document.querySelector(`.dropdown-item[data-id="${item.dataset.id}"]`).remove();
                        Swal.fire(data);
                    });
                }
            });
        });
    });
}

if (window.location.pathname === '/abdb-admin/galerie/create') {
    let files = null;
    let image = null;
    let submit = document.querySelector('.abdb-form-btn');
    submit.disabled = true;
    let config = { attributes: true, childList: true };
    DomElement.fileInput.addEventListener('change', (e) => {
        if (image) return false;
        image = new Image();
        files = e.target.files;
        if (files && files[0]) {
            if (!files[0].name.substr(-4).match(/.jpg|.JPG|.png|.PNG/)) {
                image = null;
                return Swal.fire('L\'extention du fichier n\'est pas valide');
            }
            document.querySelector('.custom-file-label').innerHTML = files[0].name;
            let reader = new FileReader();
            reader.addEventListener('load', (e) => {
                image.id = 'preview';
                image.classList.add('img-fluid');
                image.src = e.target.result;
            });
            reader.readAsDataURL(files[0]);
            DomElement.imagePreview.appendChild(image);
            submit.disabled = false;
        }

    });

    let observer = new MutationObserver((mutations) => {
        for (let mutation of mutations) {
            if (mutation.type == 'childList') {
                if (mutation.addedNodes[0]) {
                    mutation.addedNodes[0].onmouseover = (e) => {
                        e.target.title = 'Cliquer sur l\'image pour annuler';
                    };
                    mutation.addedNodes[0].onclick = (e) => {
                        files = null;
                        DomElement.fileInput.value = '';
                        DomElement.fileInput.nextElementSibling.innerHTML = '';
                        submit.disabled = true;
                        DomElement.imagePreview.innerHTML = '';
                        image = null;
                    }
                }


            }
        }
    });
    observer.observe(DomElement.imagePreview, config);

}

//ADMIN.HOME
if (window.location.pathname === '/abdb-admin/home') {
    //loader
    App.loading();

    DomElement.imageManager.deleteBtn.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            let arr = item.href.split('/');

            //POP UP
            Swal.fire({
                title: 'Vous etes sur le point de supprimer une image de la base de donnée',
                showCancelButton: true,
                type: 'warning',
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Oui',
                cancelButtonText: 'Non',
            }).then(result => {
                console.log(result);
                if (result.value) {
                    //request to delete file
                    fetch(item.href, App.deleteRequest).then(response => response.json()).then(data => {
                        //suprimer le container
                        document.querySelector('#image' + arr[arr.length - 1]).remove();
                        Swal.fire({
                            html: data,
                            timer: 1000,
                            onBeforeOpen: () => {
                                Swal.showLoading()

                            },
                        }).then((result) => {
                            if (
                                // Read more about handling dismissals
                                result.dismiss === Swal.DismissReason.timer
                            ) {
                                console.log('I was closed by the timer')
                            }
                        })
                    });
                }
            });
        });
    });
    DomElement.imageManager.editImgDescriptionBtn.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            fetch('/abdb-admin/galerie/' + item.dataset.id).then(response => response.json()).then(data => {
                console.log(data);
                Swal.fire({
                    title: 'Modifier/ajouter une description',
                    input: 'text',
                    inputValue: data.description,
                    showCancelButton: true
                }).then(result => {
                    //update
                    console.log(result);
                    App.putRequest.body = JSON.stringify({ description: result.value });

                    fetch('/abdb-admin/galerie/update/' + item.dataset.id, App.putRequest).then(response => response.json()).then(data => {
                        Swal.fire({
                            html: 'Le fichier' + data.name + ' a été modifié :) !',
                            timer: 2000,
                            onBeforeOpen: () => {
                                Swal.showLoading()

                            },
                        });
                        document.querySelector(`.card-description[data-id="${item.dataset.id}"]`).children[0].innerHTML = data.description;
                    });
                });
            });
        })
    });
    DomElement.imageManager.imgPublish.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            (item.dataset.publish == 0) ? item.dataset.publish = 1 : item.dataset.publish = 0;
            App.putRequest.body = JSON.stringify({ published: item.dataset.publish });
            fetch('/abdb-admin/galerie/update/' + item.dataset.id, App.putRequest).then(response => response.json()).then(data => {
                let icon = document.querySelector(`i[data-id="${item.dataset.id}"]`);
                icon.nextElementSibling.style.opacity = 0;
                icon.nextElementSibling.style.transform = 'transform:scale(0) rotate(-12deg)';
                icon.nextElementSibling.style.transition = 'all 0.25s';

                if (data.published === '0') {
                    icon.classList.remove('fa-check', 'text-success');
                    icon.classList.add('fa-upload');
                    icon.nextElementSibling.textContent = 'Changer de statut: publier';
                }
                if (data.published === '1') {
                    icon.classList.remove('fa-upload');
                    icon.classList.add('fa-check', 'text-success');
                    icon.nextElementSibling.textContent = 'Changer de statut: retirer du slider'
                }

                item.addEventListener('mouseover', (e) => {
                    icon.nextElementSibling.style.opacity = 1;
                    icon.nextElementSibling.style.transform = 'transform:scale(1) rotate(0deg)';
                });
                item.addEventListener('mouseout', (e) => {
                    icon.nextElementSibling.style.opacity = 0;
                    icon.nextElementSibling.style.transform = 'transform:scale(0) rotate(-12deg)';
                    icon.nextElementSibling.style.transition = 'all 0.25s';
                });


            });
        });
    })

}

if (window.location.pathname.match(/^\/abdb-admin\/galerie\/categorie\/[A-Za-z_0-9\-]+$/g)) {
    //loader
    App.loading();
}

if (window.location.pathname.match(/^(?!abdb-admin\/)[\W]$/)) {
    //front slick slider banners
    App.slick = initSlider();
    let checkIcon = document.querySelector('.fa-times');
    DomElement.contactForm.send.disabled = true;


    window.onscroll = function (e) {
        if (window.innerWidth > 1247) {
            if (document.body.getBoundingClientRect().top < -1) {
                DomElement.frontNav.style.background = "#fff";
                DomElement.frontNav.style.opacity = 1;
                DomElement.frontNav.style.padding = "20px 0 20px 0";
            } else {
                DomElement.frontNav.style.background = "#fff";
                DomElement.frontNav.style.opacity = 0.8;
                DomElement.frontNav.style.padding = "0";
            }
            let winScroll =
                document.body.scrollTop || document.documentElement.scrollTop;
            let height =
                document.documentElement.scrollHeight -
                document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            if (winScroll !== 0) {
                DomElement.scrollBarInc.style.height = 5 + "px";
                DomElement.scrollBarInc.parentNode.style.background = "#fff";

            } else {
                DomElement.scrollBarInc.style.height = 0 + "px";
            }

            DomElement.scrollBarInc.style.width = scrolled + "%";
        }

    };

    App.carousel = new Carousel(document.querySelector('.slideshowContainer'));

    document.querySelectorAll(".slider-item").forEach((item, i) => {

        item.addEventListener("click", e => {
            if (window.innerWidth <= 640) {
                return false;
            }
            if (App.carousel === null) {
                App.carousel = new Carousel(document.querySelector('.slideshowContainer'));
            }
            document.body.style.overflowY = 'hidden';
            openModalRealisation();
            App.sliderFullScreen = true;
            App.carousel.setCurrentSlide(i);
            App.carousel.showSlide();
        });
    });

    window.addEventListener('keyup', (e) => {
        if (e.code === "ArrowRight") {
            (App.carousel !== null) ? App.carousel.next() : false;

        }
        if (e.code === "ArrowLeft") {
            (App.carousel !== null) ? App.carousel.previous() : false;
        }
    })
    document.querySelector(".close-realisation").addEventListener("click", e => {
        closeModalRealisation();
        App.carousel.destroy();
        App.carousel = null;
        document.body.style.overflowY = 'auto';
    });

    window.addEventListener('resize', (e) => {
        closeModalRealisation();
        if (App.carousel) {
            App.carousel.destroy();
            App.carousel = null;
        }
        if (window.innerWidth <= 640) {
            App.slick = null;
        }
        if (window.innerWidth >= 641) {
            if (App.slick == null) {
                App.slick = initSlider();
            }

        }
        App.sliderFullscreen = false;
        document.body.style.overflowY = 'auto';
    });

    //form email validation

    DomElement.contactForm.email.addEventListener('keyup', (e) => {
        App.escapeHtml(e.target.value);
        if (!validator.isEmail(e.target.value)) {
            App.validator = false;
            e.target.style.color = '#8a0000';
        }
        else {
            App.validator = true;
        }
        if (App.validator) {
            checkIcon.classList.remove('fa-times');
            checkIcon.classList.add('fa-check')
            e.target.style.color = '#000000cf';

        }
        else {
            if (checkIcon.classList.contains('fa-check')) {
                checkIcon.classList.remove('fa-check');

            }

            checkIcon.classList.add('fa-times');
        }
        App.unlockForm(DomElement.contactForm.send);

    });

    DomElement.contactForm.message.addEventListener('input', (e) => {
        if (e.target.value != '') {
            App.textarea = true;
        } else {
            App.textarea = false;
        }

        App.unlockForm(DomElement.contactForm.send);
    });

    //navbar

    DomElement.hamburgerBtn.addEventListener('click', (e) => {
        toggleClassName(document.querySelector('nav'), 'opened');
    });

    document.querySelectorAll('#header-menu li').forEach(link => {
        let nav = document.querySelector('nav');
        if (window.innerWidth <= 1246) {
            link.addEventListener('click', (e) => {
                toggleClassName(nav, 'opened');
            });
        }

    })






}
