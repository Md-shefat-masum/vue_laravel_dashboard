import setup from "./config";
import Layout from "../Layout.vue";

import Settings from "../Settings.vue";
import SettingForm from "../SettingForm.vue";

let route_prefix = setup.route_prefix;
let route_path = setup.route_path;

const routes =
{
    path: route_path,
    component: Layout,
    children: [
        {
            path: '',
            name: "Settings",
            component: Settings,
        },
        {
            path: 'update/:group_id/:sub_group_id',
            name: "SettingForm",
            component: SettingForm,
        },
    ]
};


export default routes;
