<template lang="">
    <div>
        <card>
            <card-header class="flex items-center justify-between">
                <h5 class="text-capitalize text-[18px]!">
                    {{ param_id ? config.edit_page_title : config.create_page_title }}
                </h5>
                <div>
                    <button-back :to="`All${config.route_prefix}`" />
                </div>
            </card-header>
            <card-body>
                <form @submit.prevent="store[`${param_id ? 'update' : 'store'}`]($event.target, {})">
                    <fieldset-el :title="`${config.prefix} Information`">
                        <div class="grid grid-cols-3 gap-3">
                            <input-el
                                type="text"
                                name="name"
                                label="Name"
                                placeholder="Name"
                                :required="true"
                                :value="store.item?.name ?? ''"
                            />

                            <input-el
                                type="email"
                                name="email"
                                label="Email"
                                placeholder="Email"
                                :required="true"
                                :value="store.item?.email ?? ''"
                            />

                            <input-el
                                type="password"
                                name="password"
                                label="Password"
                                placeholder="Password"
                                :required="param_id ? false : true"
                            />

                            <input-el
                                type="password"
                                name="password_confirmation"
                                label="Re Password"
                                placeholder="Re type password"
                                :required="param_id ? false : true"
                            />

                            <div>
                                <image-upload
                                    label="Photo (100x100)"
                                    name="photo"
                                    :allowMultiple="false"
                                    height="100"
                                    width="100"
                                    :callback="(files)=>''"
                                    :default_files="[`/${store.item?.photo}`]"
                                />
                                <img v-if="store.item?.photo" :src="`/${store.item?.photo}`" class="w-[100px] h-[100px] object-center rounded-xs" />
                            </div>

                        </div>

                        <div class="mt-4 flex justify-end gap-3 text-end">
                            <button-info />
                            <button-danger />
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
export default {
    data: () => ({
        config,
        pram_id: null,
        store: store(),
    }),
    created: async function () {
        this.param_id = this.$route.params.id;

        if (this.param_id) {
            await this.store.fetch_item({
                id: this.param_id
            });
        }
    },
    methods: {},
    beforeUnmount: function(){
        this.store.item = {};
    },
}
</script>
<style lang="">

</style>
