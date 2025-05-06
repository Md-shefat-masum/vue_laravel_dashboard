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
                <form @submit.prevent="store[`store_${config.store_prefix}`]($event.target, {})">
                    <fieldset-el title="User Information">
                        <div class="grid grid-cols-3 gap-3">
                            <input-el
                                type="text"
                                name="name"
                                label="Name"
                                placeholder="Name"
                                :required="true"
                            />

                            <input-el
                                type="email"
                                name="email"
                                label="Email"
                                placeholder="Email"
                                :required="true"
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

                            <div>
                                <image-upload
                                    label="Photo (100x100)"
                                    name="photo"
                                    :allowMultiple="false"
                                    height="100"
                                    width="100"
                                    :callback="(files)=>''" />
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
    data: ()=>({
        config,
        pram_id: null,
        photo: "",
        store: store(),
    }),
    created: function () {
        this.param_id = this.$route.params.id;
    },
    methods: {
        get_user_image: function(files = []){
            this.photo = files.map(item => item.serverId)[0];
        }
    }
}
</script>
<style lang="">

</style>
