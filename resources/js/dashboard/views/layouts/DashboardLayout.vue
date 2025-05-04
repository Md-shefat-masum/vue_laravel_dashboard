<template lang="">
    <div id="dashboard_app" v-if="auth_store.auth_user">
        <Header></Header>
        <main class="main">
            <LeftNav />
            <router-view/>
            <!-- <footer class="footer"></footer> -->
        </main>
    </div>
</template>
<script>
import Header from '../components/layouts/Header.vue';
import LeftNav from '../components/layouts/LeftNav.vue';
import auth_store from '@dashboard/stores/auth_store';
export default {
    components: {
        Header,
        LeftNav,
    },
    data: ()=>({
       auth_store: auth_store(),
    }),
    watch: {
        "auth_store.auth_user": function(){
            if(!this.auth_store.auth_user){
                this.$router.push({ name: 'Login' });
            }
        }
    },
    created: async function(){
        await this.auth_store.check_auth();
        if(!this.auth_store.auth_user){
            return this.$router.push({ name: 'Login' });
        }

        if(localStorage.getItem('last_route')){
            return this.$router.push(localStorage.getItem('last_route'));
        }
    },
}
</script>
<style lang="">

</style>
