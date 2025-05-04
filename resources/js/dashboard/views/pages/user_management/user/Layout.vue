<template lang="">
    <app-body>
        <div class="content_nav">
            <div class="content_nav_group">
                <label :for="`menu_${1}`" class="content_nav_heading">
                    <div class="text">
                        User Management
                    </div>
                    <div class="has_more">
                        <i class="fa fa-angle-down"></i>
                    </div>
                </label>
                <ul class="content_nav_menu">
                    <input :id="`menu_${1}`" :checked="true" type="checkbox" class="content_nav_toggle" />
                    <li>
                        <router-link :to="{name: 'Alluser'}">
                            <i class=""></i>
                            <span class="title">
                                All User
                            </span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name: 'Createuser'}">
                            <i class=""></i>
                            <span class="title">
                                Create User
                            </span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name: 'Edituser', params: {id: 1}}">
                            <i class=""></i>
                            <span class="title">
                                Edit User
                            </span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
        <div class="app_content transparent">
            <router-view></router-view>
        </div>
    </app-body>
</template>
<script>
export default {

}
</script>
<style lang="">

</style>
