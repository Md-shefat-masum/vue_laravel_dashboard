import axios from "axios";
import initialStates from "./initialStates";
import router from '../../router/router'
import { defineStore } from "pinia";
import debounce from "debounce";

class StoreModule {
    /**
     * @type {String}
     */
    store_prefix;
    api_prefix;
    route_prefix;
    start_page;
    paginate;

    /**
     * @constructor
     * ```js
        let user_module = new StoreModule(
                store_prefix: String,
                api_prefix: String,
                route_prefix: String,
                start_page: Number,
                paginate: Number
            )
        store_prefix = "", // user_module as user, user_role_module as user_role
        api_prefix = "", // /api/user/all as user, /api/user-role/all as user-role
        route_prefix = "",
        start_page = 1,
        paginate = 10
     * ```
     */
    constructor(
        store_prefix = "",
        api_prefix = "",
        route_prefix = ""
    ) {
        this.store_prefix = store_prefix;
        this.api_prefix = api_prefix;
        this.route_prefix = route_prefix;
    }

    state = function () {
        return {
            ...initialStates,
            store_prefix: this.store_prefix,
            api_prefix: this.api_prefix,
            route_prefix: this.route_prefix,
        }
    };

    getters = {};

    actions = function () {
        return {
            fetch_all: async function (payload = {}) {
                let url = new URL(`${this.api_prefix}`);
                if (payload.url) {
                    url = new URL(payload.url);
                } else {
                    url.searchParams.set('page', this.page);
                }

                url.searchParams.set('status', this.status);
                url.searchParams.set('paginate', this.paginate);
                url.searchParams.set('orderByCol', this.orderByCol);
                url.searchParams.set('orderByAsc', this.orderByAsc);
                url.searchParams.set('search', this.search_key);

                for (let index = 0; index < this.select_fields.length; index++) {
                    const element = this.select_fields[index];
                    url.searchParams.append('fields[]', element);
                }

                await axios.get(url.href)
                    .then(res => {
                        this.all = res.data.data;
                        this.page = this.all.current_page;

                        try {
                            document.querySelector('.table_wrapper')?.scrollTo({ top: 0, behavior: 'smooth' });
                        } catch (error) { }
                    });
            },
            search_item: function (search_key) {
                this.search_key = search_key;
                this.page = 1;
                this.fetch_all();
            },
            set_paginate: function (paginate) {
                this.paginate = paginate;
                this.page = 1;
                this.fetch_all();
            },
            store: async function (form_el, payloads = {}) {
                let formData = new FormData(form_el);
                for (const key in payloads) {
                    formData.append(key, payloads[key]);
                }
                await axios.post(`${this.api_prefix}/store`, formData)
                    .then(res => {
                        window.s_alert("Data stored successfully.");
                        form_el.reset();
                        router.replace({ name: `All${this.route_prefix}` });
                    });
            },
            update: async function (form_el, payloads = {}) {
                if (!this.item?.id) {
                    console.error('ID is required.');
                    return;
                }

                let formData = new FormData(form_el);
                for (const key in payloads) {
                    formData.append(key, payloads[key]);
                }
                formData.append('id', this.item.id);

                await axios.post(`${this.api_prefix}/update`, formData)
                    .then(res => {
                        window.s_alert("Data updated successfully.");
                        router.replace({ name: `Details${this.route_prefix}` });
                    });
            },
            fetch_item: async function ({ id }) {
                await axios.get(`${this.api_prefix}/${id}`)
                    .then(res => {
                        this.item = res.data.data;
                    });
            },
            get_data: function (path) {
                return path.split('.')
                    .reduce((acc, key) => {
                        if (acc && acc.hasOwnProperty(key)) {
                            return acc[key];
                        }
                        return '';
                    }, this.item);
            },
            soft_delete: async function ({ id }) {
                let con = await window.s_confirm('Deactive data');
                if (!con) return;

                await axios.post(`${this.api_prefix}/soft-delete`, { id })
                    .then(res => {
                        this.fetch_all();
                    });
            },
            destroy: async function ({ id }) {
                let con = await window.s_confirm('Permenently delete');
                if (!con) return;

                await axios.post(`${this.api_prefix}/destroy`, { id })
                    .then(res => {
                        this.fetch_all();
                    });
            },
        }
    }
}

export default StoreModule;
