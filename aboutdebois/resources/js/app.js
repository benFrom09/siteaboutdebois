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

    DomElement.imageManagers.forEach(item => {
        item.addEventListener('click', (e) => {
            document.querySelector('.menuIcons').style.display = 'block';
        });
    });

}

if (window.location.pathname.match(/^\/abdb-admin\/galerie\/categorie\/[A-Za-z_0-9\-]+$/g)) {
    //loader
    App.loading();
}
