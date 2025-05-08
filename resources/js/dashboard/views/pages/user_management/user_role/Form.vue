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
                                name="title"
                                label="Title"
                                placeholder="Title"
                                :required="true"
                                :value="store.item?.title ?? ''"
                            />
                        </div>

                        <div class="mt-4 flex justify-end gap-3 text-end">
                            <button-info />
                            <!-- <button-danger /> -->
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
        console.log(this.store);

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
