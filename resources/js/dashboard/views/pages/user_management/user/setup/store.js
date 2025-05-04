import StoreModule from "../../../../../helpers/store/StoreModule";
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
    }),
    actions: {
        ...store_module.actions(),
    },
    getters: {
        ...store_module.getters,
    }
});
