import setup from "./config";
import Layout from "../Layout.vue";

import UpdateInfo from "../UpdateInfo.vue";
import UpdatePassword from "../UpdatePassword.vue";
import Profile from "../Profile.vue";

let route_prefix = setup.route_prefix;
let route_path = setup.route_path;

const routes =
{
    path: route_path,
    component: Layout,
    children: [
        {
            path: '',
            name: "All" + route_prefix,
            component: Profile,
        },
        {
            path: "update-info",
            name: "Edit" + route_prefix,
            component: UpdateInfo
        },
        {
            path: "update-password",
            name: "EditPassword" + route_prefix,
            component: UpdatePassword
        },
    ]
};


export default routes;
