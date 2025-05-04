const prefix = 'User';
const config = {
    prefix,
    module_name: 'user_management',

    route_prefix: 'user',
    route_path: 'user',
    store_prefix: 'user',

    select_fields: ['id', 'name', 'email', 'photo', 'phone_number', 'slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'name', 'email', 'phone_number', 'created_at', 'status'],

    api_host: location.origin,
    api_version: 'v1',
    api_endpoint: 'users',
    api_url: "",

    default_fields: 'name',

    layout_title: prefix + ' Management',
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

config.api_url = config.api_host + '/api/' + config.api_version + '/' + config.api_endpoint;

export default config;
