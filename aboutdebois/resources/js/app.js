require('./bootstrap');
import './modules/menu';
import Swal from 'sweetalert2';
import DomElement from './modules/DomElement';
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
    }
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
                console.log(data);
                if (data.published == 0) {
                    document.querySelector('.fa-check').style.display = 'none';
                    document.querySelector('.fa-upload').style.display = 'block';
                }
                else {
                    document.querySelector('.fa-check').style.display = 'block';
                    document.querySelector('.fa-upload').style.display = 'none';
                }
            });
        });
    })

}

if (window.location.pathname.match(/^\/abdb-admin\/galerie\/categorie\/[A-Za-z_0-9\-]+$/g)) {
    //loader
    App.loading();
}
