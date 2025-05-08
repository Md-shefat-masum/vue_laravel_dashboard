import StoreModule from "@dashboard/helpers/store/StoreModule";
import { defineStore } from "pinia";
import config from './config';

let store_module = new StoreModule(
    config.store_prefix,
    config.api_url,
    config.route_prefix,
);

export default defineStore(`${config.store_prefix}_store`, {
    state: () => ({
        ...store_module.state(),
        select_fields: config.select_fields,
    }),
    actions: {
        // ...store_module.actions(),
        update_info: async function(form_el, payloads = {}){
            let formData = new FormData(form_el);
            for (const key in payloads) {
                formData.append(key, payloads[key]);
            }

            await axios.post(`${this.api_prefix}/update-info`, formData)
                .then(res => {
                    window.s_alert("profile updated successfully.");
                });
        },
        update_password: async function(form_el, payloads = {}){
            let formData = new FormData(form_el);
            for (const key in payloads) {
                formData.append(key, payloads[key]);
            }

            await axios.post(`${this.api_prefix}/update-password`, formData)
                .then(res => {
                    window.s_alert("password changed successfully.");
                });
        },
    },
    getters: {
        // ...store_module.getters,
    }
});
