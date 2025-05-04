export default {
    /** loading status */
    is_loading: false,
    loading_text: 'loading..',

    /* data store */
    all: {},
    item: {},
    url: '',

    /*_______________*/
    /* data filters */

    select_fields: [],
    sort_by_cols: [],
    sort_by_col: 'id',
    sort_type: 'DESC',

    filter_criteria: {},
    all_data_count: 0, // total data in database
    active_data_count: 0,
    inactive_data_count: 0,
    page: 1,
    paginate: 10,
    search_key: ``,

    orderByCol: 'id',
    orderByAsc: 0,


    status: 1, // active | inactive

    /*_______________*/

    /* selected data */
    selected: [], // selected data using checkbox

    /* trigger showing data modal */
    show_filter_canvas: false,
    show_quick_view_canvas: false,
    show_management_modal: false,
    modal_selected_qty: 1, // how much will checked from management modal

    /* trigger showing data form canvas */
    show_create_canvas: false,
    show_edit_canvas: false,
    show_details_canvas: false,

    /*_______________*/
    cached: 0,
    only_latest_data: true,
}
