<template lang="">
    <div>
        <span class="">
            {{ config.all_page_title }}
        </span>
        <div class="my-2">
            <div class="flex flex-wrap gap-2">
                <button-link
                    :route_name="`Create${config.route_prefix}`"
                    :icon="'fa fa-plus'"
                    :text="'Add New'"
                />

                <div>
                    <search-data :store="store" />
                </div>
            </div>
        </div>
        <all-table-body>
            <table-el>
                <table-head :cells="[
                    {key: 'ID', align: 'left'},
                    {key: 'Title', align: 'center'},
                    {key: 'Status', align: 'center'},
                    {key: 'Actions', align: 'center'}
                ]"/>
                <tbody>
                    <tr v-for="item in store.all?.data">
                        <td>
                            {{ item.id }}
                        </td>
                        <td class="text-center">
                            {{ item.title }}
                        </td>
                        <td class="text-center">
                            <span v-if="item.status" class="tag tag-success uppercase">
                                active
                            </span>
                        </td>
                        <td>
                            <table-action
                                :links="config.table_actions(item, store)"
                            />
                        </td>
                    </tr>
                </tbody>
            </table-el>
        </all-table-body>

        <div>
            <pagination :store="store" />
        </div>

    </div>

</template>
<script>
import user_store from './setup/store';
import config from './setup/config';
import debounce from 'debounce';

export default {
    data: () => ({
        store: user_store(),
        config,
    }),
    watch: {

    },
    created: async function () {
        await this.store.fetch_all();
    },
    methods: {
        search_item: debounce(async function (value) {
            this.store.search_item(value)
        },500)
    }
}
</script>
