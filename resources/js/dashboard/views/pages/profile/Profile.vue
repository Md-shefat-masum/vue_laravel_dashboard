<template lang="">
    <div>
        <card>
            <card-header class="flex items-center justify-between">
                <h5 class="text-capitalize text-[18px]!">
                    Profile
                </h5>
                <div class="flex gap-2">
                </div>
            </card-header>
            <card-body>
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="3">
                                <img
                                    :src="'/'+auth_store.get_data('photo')"
                                    alt=""
                                    class="w-[40px] h-[40px] object-center rounded-full"
                                />
                            </td>
                        </tr>
                        <tr v-for="field in show_fields">
                            <th class="w-[120px] text-start py-2 !text-[14px]">
                                {{ field.label }}
                            </th>
                            <th class="w-[5px]">
                                :
                            </th>
                            <td class="px-2 !text-[16px]">
                                {{ auth_store.get_data(field.key) }}
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
import auth_store from '@dashboard/stores/auth_store';

export default {
    data: ()=>({
        config,
        pram_id: null,
        photo: "",
        store: store(),
        auth_store: auth_store(),
        show_fields: [
            {
                label: "Name",
                key: "name",
            },
            {
                label: "Email",
                key: "email",
            },
            {
                label: "Phone Number",
                key: "phone_number",
            },
        ]
    }),
    created: async function () {
        await this.auth_store.check_auth({
            id: this.auth_store.auth_user?.id
        });
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
