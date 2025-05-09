import setup from "./config";
import All from "../All.vue";
import Form from "../Form.vue";
import Details from "../Details.vue";
import Layout from "../Layout.vue";

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
            component: All,
        },
        {
            path: "create",
            name: "Create" + route_prefix,
            component: Form,
        },
        {
            path: "edit/:id",
            name: "Edit" + route_prefix,
            component: Form
        },
        {
            path: ":id",
            name: "Details" + route_prefix,
            component: Details,
        },
    ]
};


export default routes;
