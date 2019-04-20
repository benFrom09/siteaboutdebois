require('./bootstrap');
import './modules/menu';
import Swal from 'sweetalert2';
import DomElement from './modules/DomElement';
import Carousel from './modules/carousel/Carousel';
import Slick from 'slick-carousel/slick/slick';
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
        let timeout = window.setTimeout(() => {
            DomElement.loader.style.display = 'none';
            clearTimeout(timeout);
        }, 500);
    },
    sliderFullscreen: false,
    carousel: null,
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
    DomElement.fileInput.addEventListener('change', (e) => {
        let files = e.target.files;
        if (files && files[0]) {
            document.querySelector('.custom-file-label').innerHTML = files[0].name;
            let reader = new FileReader();
            reader.addEventListener('load', (e) => {
                DomElement.imagePreview.src = e.target.result;
            });
            reader.readAsDataURL(files[0]);
        }

    });
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
                    con.nextElementSibling.style.transform = 'transform:scale(0) rotate(-12deg)';
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

    $(".slider").slick({
        infinite: false,
        speed: 300,
        centerPadding: "60px",
        slidesToShow: 4,
        arrows: true,
        dots: true
    });




    window.onscroll = function (e) {
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
    };

    App.carousel = new Carousel(document.querySelector('.slideshowContainer'));

    document.querySelectorAll(".slider-item").forEach((item, i) => {
        item.addEventListener("click", e => {
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
        document.body.style.overflowY = 'auto';
    });

    window.addEventListener('resize', (e) => {
        closeModalRealisation();
        App.carousel = null;
        App.sliderFullscreen = false;
        document.body.style.overflowY = 'auto';
    })
}
