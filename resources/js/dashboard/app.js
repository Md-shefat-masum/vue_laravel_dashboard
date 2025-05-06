import 'bootstrap';
import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.baseURL = location.origin + '/api';

if (localStorage.getItem('token')) {
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
}

const clear_form_error = () => {
    document.querySelectorAll('.form_error').forEach(el => {
        el.remove();
    });
}

window.axios.interceptors.request.use(function (config) {
    clear_form_error();
    return config;
}, function (error) {
    return Promise.reject(error);
});

window.axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    const status = error.response.status;
    if (status == 422) {
        const errors = error.response.data.data;
        for (const [key, value] of Object.entries(errors)) {
            const el = document.querySelector(`[name="${key}"]`);
            if (el) {
                el.closest('div').insertAdjacentHTML('beforeend',`<div class="form_error text-danger">${value[0]}</div>`);
            }
        }
    }
    return Promise.reject(error);
});

/** vue setup */
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './router/router';

const pinia = createPinia()
const app = createApp({});

import RootLayout from './views/layouts/RootLayout.vue';
import AppBody from './views/components/layouts/AppBody.vue';

import Card from './views/components/card/Card.vue';
import CardHeader from './views/components/card/CardHeader.vue';
import CardBody from './views/components/card/CardBody.vue';

import InputEl from './views/components/form/InputEl.vue';
import FieldsetEl from './views/components/form/FieldsetEl.vue';
import ButtonInfo from './views/components/form/ButtonInfo.vue';
import ButtonDanger from './views/components/form/ButtonDanger.vue';
import ButtonBack from './views/components/form/ButtonBack.vue';
import ImageUpload from './views/components/form/ImageUpload.vue';
import ButtonLink from './views/components/buttons/ButtonLink.vue';

app.component('dashboard', RootLayout);
// app.component('dashboard', App);
app.component('app-body', AppBody);

app.component('card', Card);
app.component('card-header', CardHeader);
app.component('card-body', CardBody);

app.component('input-el', InputEl);
app.component('fieldset-el', FieldsetEl);
app.component('button-info', ButtonInfo);
app.component('button-danger', ButtonDanger);
app.component('button-back', ButtonBack);
app.component('button-link', ButtonLink);
app.component('image-upload', ImageUpload);

app.use(pinia);
app.use(router);
app.mount('#app');
