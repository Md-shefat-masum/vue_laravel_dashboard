<template lang="">
    <div class="login-form-body" v-if="checked_auth && !auth_store.auth_user">
        <router-view></router-view>
    </div>
</template>
<script>
import { mapState } from 'pinia';
import auth_store from '../../stores/auth_store';
export default {
    data: ()=>({
        auth_store: auth_store(),
        checked_auth: false,
    }),
    watch: {
        "auth_user" : function(){
            if(this.auth_user){
                this.$router.push({ name: 'Dashboard' });
            }
        }
    },
    created: async function() {
        await this.auth_store.check_auth();
        setTimeout(() => {
            this.checked_auth = true;
        }, 500);
    },
    computed: {
        ...mapState(auth_store, [
            'auth_user',
        ]),
    }
}
</script>
<style lang="">

</style>
