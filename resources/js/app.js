import './bootstrap';

import '~resources/scss/app.scss';

import.meta.glob([
    '../img/**'
]);

import * as bootstrap from 'bootstrap';

const confirmDelete = document.querySelector('#confirm-delete');
if (confirmDelete) {
    document.querySelectorAll('.js-delete').forEach(button => {
        button.addEventListener('click', function () {
            confirmDelete.action = confirmDelete.dataset.template.replace('*****', this.dataset.id);
        });
    })
}

const confirmDeleteType = document.querySelector('#confirm-delete-type');
if (confirmDeleteType) {
    document.querySelectorAll('.js-delete').forEach(button => {
        button.addEventListener('click', function () {
            confirmDeleteType.action = confirmDeleteType.dataset.template.replace('*****', this.dataset.id);
        });
    })
}    

const confirmDeleteTechnology = document.querySelector('#confirm-delete-technology');
if (confirmDeleteTechnology) {
    document.querySelectorAll('.js-delete').forEach(button => {
        button.addEventListener('click', function () {
            confirmDeleteTechnology.action = confirmDeleteTechnology.dataset.template.replace('*****', this.dataset.id);
        });
    })
}
