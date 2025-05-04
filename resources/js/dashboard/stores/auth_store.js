import axios from 'axios'
import { defineStore } from 'pinia'
import router from '../router/router';

export default defineStore('auth_store', {
    state: () => ({
        auth_user: null,
    }),
    actions: {
        check_auth() {
            axios.post('/auth/me')
                .then(response => {
                    this.auth_user = response.data.data.user;
                });
        },
        logout: async function() {
            let con = await window.s_confirm('logout');
            if(!con) return;

            axios.post('/auth/logout')
                .then(response => {
                    this.auth_user = null;
                });
        },
        login: function(form){
            const data = new FormData(form);

            axios.post('/auth/login', data)
                .then(response => {
                    this.auth_user = response.data.data.user;
                    localStorage.setItem('token', response.data.data.token);
                    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');

                    return router.push({ name: 'Dashboard' });
                });
        }
    }
})
