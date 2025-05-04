import axios from "axios";
import initialStates from "./initialStates";
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
            [`fetch_${this.store_prefix}s`]: async function (payload = {}) {
                let url = new URL(`${this.api_prefix}`);
                if(payload.url){
                    url = new URL(payload.url);
                }else{
                    url.searchParams.set('page', this.page);
                }

                url.searchParams.set('status', this.status);
                url.searchParams.set('paginate', this.paginate);
                url.searchParams.set('orderByCol', this.orderByCol);
                url.searchParams.set('orderByAsc', this.orderByAsc);
                url.searchParams.set('search', this.search_key);

                await axios.get(url.href)
                    .then(res=>{
                        this.all = res.data.data;
                        this.page = this.all.current_page;

                        try {
                            document.querySelector('.table_wrapper')?.scrollTo({ top: 0, behavior: 'smooth' });
                        } catch (error) {}
                    });
            },
            [`search_${this.store_prefix}`]: function(search_key){
                this.search_key = search_key;
                this.page = 1;
                this[`fetch_${this.store_prefix}s`]();
            },
            [`set_paginate_${this.store_prefix}`]: function(paginate){
                this.paginate = paginate;
                this.page = 1;
                this[`fetch_${this.store_prefix}s`]();
            },
        }
    }
}

export default StoreModule;
