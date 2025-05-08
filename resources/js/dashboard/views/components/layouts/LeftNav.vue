<template lang="">
    <nav class="left_nav">
        <ul class="main_menu">
            <li>
                <router-link to="/">
                    <i class="fa fa-home"></i>
                    <span class="menu_label">
                        dashboard
                    </span>
                </router-link>
            </li>

            <li>
                <router-link to="/user">
                    <i class="fa fa-users"></i>
                    <span class="menu_label">
                        users
                    </span>
                </router-link>
            </li>
        </ul>

        <ul class="main_menu_bottom">
            <li>
                <router-link to="/settings">
                    <i class="fa fa-gears"></i>
                    <span class="menu_label">
                        Settings
                    </span>
                </router-link>
            </li>
            <li>
                <router-link to="/profile">
                    <i class="far fa-user-circle"></i>
                    <span class="menu_label">
                        Profile
                    </span>
                </router-link>
            </li>
            <li>
                <a href="#" @click.prevent="auth_store.logout();">
                    <i class="fa fa-power-off"></i>
                </a>
            </li>
        </ul>
    </nav>
</template>
<script>
import auth_store from '../../../stores/auth_store';
export default {
    data: ()=>({
        auth_store: auth_store(),
    })
}
</script>
<style lang="">

</style>
