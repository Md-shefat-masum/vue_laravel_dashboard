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
        setting_fields: [],
        setting_values: [],
        setting_group_id: null,
        setting_sub_group_id: null,
    }),
    actions: {
        // ...store_module.actions(),
        get_setting_fileds: async function (payloads = {}) {
            await axios.get(`${this.api_prefix}/fields`)
                .then(res => {
                    this.setting_fields = res.data.data;
                });
        },
        get_setting_values: async function (payloads = {}) {
            await axios.get(`${this.api_prefix}/${payloads.group_id}/${payloads.sub_group_id}/values`)
                .then(res => {
                    this.setting_values = res.data.data;
                });
        },
        update_info: async function (form_el, payloads = {}) {
            let formData = new FormData(form_el);
            for (const key in payloads) {
                formData.append(key, payloads[key]);
            }

            await axios.post(`${this.api_prefix}/update`, formData)
                .then(res => {
                    window.s_alert("data updated successfully.");
                    this.get_setting_values({
                        group_id: this.setting_group_id,
                        sub_group_id: this.setting_sub_group_id,
                    });
                });
        },
    },
    getters: {
        // ...store_module.getters,
    }
});
