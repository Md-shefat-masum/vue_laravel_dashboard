<template lang="">
    <div>
        <card>
            <card-header class="flex items-center justify-between">
                <h5 class="text-capitalize text-[18px]!">
                    Change Password
                </h5>
                <div>
                    <!-- <button-back :to="`All${config.route_prefix}`" /> -->
                </div>
            </card-header>
            <card-body>
                <form @submit.prevent="store.update_password($event.target, {id: auth_store.auth_user?.id})">
                    <fieldset-el :title="`${config.prefix} Information`">
                        <div class="grid grid-cols-3 gap-3">

                            <input-el
                                type="password"
                                name="old_password"
                                label="Old Password"
                                placeholder="Old password"
                                :required="true"
                                :value="''"
                            />

                            <input-el
                                type="password"
                                name="password"
                                label="Password"
                                placeholder="Password"
                                :required="true"
                            />

                            <input-el
                                type="password"
                                name="password_confirmation"
                                label="Re Password"
                                placeholder="Re type password"
                                :required="true"
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
