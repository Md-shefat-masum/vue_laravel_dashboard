<template lang="">
    <div>
        <card>
            <card-header class="flex items-center sticky top-[-10px] z-9 justify-between">
                <h5 class="text-capitalize text-[18px]!">
                    {{ store.setting_values[0]?.setting_sub_group_title ?? '' }}
                </h5>
                <div>

                </div>
            </card-header>
            <card-body>
                <form @submit.prevent="store.update_info($event.target, {id: auth_store.auth_user?.id})">
                    <fieldset-el :title="`${config.prefix} Information`">

                        <div class="mb-4" v-for="(item, index) in store.setting_values" :key="index">
                            <input-el
                                v-if="item.type == 'text'"
                                :type="`textarea`"
                                :name="`fields[${item.id}][value]`"
                                :label="item.title"
                                :placeholder="item.title"
                                :required="false"
                                :value="item.value"
                            />
                            <div v-if="item.type == 'file'" class="max-w-[250px]">
                                <image-upload
                                    :label="item.title"
                                    :name="`fields[${item.id}][value]`"
                                    :allowMultiple="false"
                                    height=""
                                    width=""
                                    :callback="(files)=>''"
                                    :default_files="[`${item?.value}`]"
                                />
                                <img v-if="item?.value" :src="`/${item?.value}`" class="w-[100px] h-[100px] bg-gray-100 object-contain! rounded-xs" />
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end gap-3 text-end">
                            <button-info />
                        </div>
                    </fieldset-el>
                </form>
            </card-body>
        </card>
    </div>
</template>
<script>
import config from './setup/config';
import store from './setup/store';
import auth_store from '@dashboard/stores/auth_store';
export default {
    data: () => ({
        config,
        pram_id: null,
        store: store(),
        auth_store: auth_store(),
        group_id: null,
        sub_group_id: null,
    }),
    watch: {
        "$route.params": {
            handler: function () {
                this.group_id = this.$route.params.group_id;
                this.sub_group_id = this.$route.params.sub_group_id;
                this.get_data();
            },
            deep: true,
        }
    },
    created: async function () {
        this.group_id = this.store.setting_group_id = this.$route.params.group_id;
        this.sub_group_id = this.store.setting_sub_group_id = this.$route.params.sub_group_id;
        this.get_data();
    },
    methods: {
        get_data: async function () {
            await this.store.get_setting_values({
                group_id: this.group_id,
                sub_group_id: this.sub_group_id,
            });
        }
    },
    beforeUnmount: function () {

    },
}
</script>
<style lang="">

</style>
