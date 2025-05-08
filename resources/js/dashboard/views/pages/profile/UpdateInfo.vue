<template lang="">
    <div>
        <card>
            <card-header class="flex items-center justify-between">
                <h5 class="text-capitalize text-[18px]!">
                    Update Info
                </h5>
                <div>

                </div>
            </card-header>
            <card-body>
                <form @submit.prevent="store.update_info($event.target, {id: auth_store.auth_user?.id})">
                    <fieldset-el :title="`${config.prefix} Information`">
                        <div class="grid grid-cols-3 gap-3">
                            <input-el
                                type="text"
                                name="name"
                                label="Name"
                                placeholder="Name"
                                :required="true"
                                :value="auth_store.auth_user?.name ?? ''"
                            />

                            <input-el
                                type="email"
                                name="email"
                                label="Email"
                                placeholder="Email"
                                :required="true"
                                :value="auth_store.auth_user?.email ?? ''"
                            />

                            <input-el
                                type="phone"
                                name="phone_number"
                                label="Phone Number"
                                placeholder="Phone Number"
                                :required="true"
                                :value="auth_store.auth_user?.phone_number ?? ''"
                            />

                            <div>
                                <image-upload
                                    label="Photo (100x100)"
                                    name="photo"
                                    :allowMultiple="false"
                                    height="100"
                                    width="100"
                                    :callback="(files)=>''"
                                    :default_files="[`/${auth_store.auth_user?.photo}`]"
                                />
                                <img v-if="auth_store.auth_user?.photo" :src="`/${store.auth_user?.photo}`" class="w-[100px] h-[100px] object-center rounded-xs" />
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
    }),
    created: async function () {

    },
    methods: {},
    beforeUnmount: function(){

    },
}
</script>
<style lang="">

</style>
