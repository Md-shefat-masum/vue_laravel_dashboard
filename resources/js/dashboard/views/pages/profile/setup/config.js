const prefix = 'Profile';
const config = {
    prefix,
    module_name: 'profile_management',

    route_prefix: 'profile',
    route_path: 'profile',
    store_prefix: 'profile',

    select_fields: ['id', 'name', 'email', 'photo', 'phone_number', 'slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'name', 'email', 'phone_number', 'created_at', 'status'],

    api_host: location.origin,
    api_version: 'v1',
    api_endpoint: 'profile',
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
