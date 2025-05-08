<template lang="">
    <div>
        <card>
            <card-header class="flex items-center justify-between">
                <h5 class="text-capitalize text-[18px]!">
                    {{ config.details_page_title }}
                </h5>
                <div class="flex gap-2">
                    <button-link
                        class="me-3 bg-amber-700"
                        :icon="'fa fa-pencil'"
                        :text="'Edit'"
                        :route_name="`Edit${config.route_prefix}`"
                        :params="{ id: param_id }"
                    />

                    <button-back :to="`All${config.route_prefix}`" />
                </div>
            </card-header>
            <card-body>
                <table class="table">
                    <tbody>
                        <tr v-for="field in show_fields">
                            <th class="w-[120px] text-start py-2 !text-[14px]">
                                {{ field.label }}
                            </th>
                            <th class="w-[5px]">
                                :
                            </th>
                            <td class="px-2 !text-[16px]">
                                {{ store.get_data(field.key) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </card-body>
        </card>
    </div>
</template>
<script>
import config from './setup/config';
import store from './setup/store';
export default {
    data: ()=>({
        config,
        pram_id: null,
        photo: "",
        store: store(),
        show_fields: [
            {
                label: "Title",
                key: "title",
            },
        ]
    }),
    created: async function () {
        this.param_id = this.$route.params.id;

        if (this.param_id) {
            await this.store.fetch_item({
                id: this.param_id
            });
        }
    },
    methods: {
        get_user_image: function(files = []){
            this.photo = files.map(item => item.serverId)[0];
        }
    },
    beforeUnmount: function () {
        this.store.item = {};
    }
}
</script>
<style lang="">

</style>
