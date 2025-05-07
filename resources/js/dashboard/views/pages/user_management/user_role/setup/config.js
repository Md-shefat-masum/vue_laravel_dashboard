const prefix = 'User Role';
const config = {
    prefix,
    module_name: 'user_role_management',

    route_prefix: 'user_role',
    route_path: 'user-role',
    store_prefix: 'user_role',

    select_fields: ['id', 'title', 'status', 'slug', 'created_at'],
    sort_by_cols: ['id', 'title', 'status', 'created_at'],

    api_host: location.origin,
    api_version: 'v1',
    api_endpoint: 'user-roles',
    api_url: "",

    layout_title: prefix + ' Management',
    all_page_title: 'All ' + prefix,
    details_page_title: prefix + ' Details',
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

config.api_url = config.api_host + '/api/' + config.api_version + '/' + config.api_endpoint;

config.table_actions = function (item, store) {
    return [
        {
            label: 'Details',
            icon: 'fa fa-eye',
            to: {
                name: `Details${config.route_prefix}`,
                params: { id: item.id }
            },
        },
        {
            label: 'Edit',
            icon: 'fa fa-pencil',
            to: {
                name: `Edit${config.route_prefix}`,
                params: { id: item.id }
            },
        },
        {
            label: 'Deactive',
            icon: 'fa fa-ban',
            to: `/#/${config.route_prefix}/${item.id}/deactive`,
            onclick: function () {
                store.soft_delete({id: item.id});
            },
        },
        {
            label: 'Destroy',
            icon: 'fa fa-trash',
            to: `/#/${config.route_prefix}/${item.id}/destroy`,
            onclick: function () {
                store.destroy({id: item.id});
            },
        },
    ];
}

export default config;
