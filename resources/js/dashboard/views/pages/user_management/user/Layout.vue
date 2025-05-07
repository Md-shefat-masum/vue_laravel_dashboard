<template lang="">
    <app-body>
        <div class="content_nav">
            <div v-for="(menu, index) in menus" :key="index" class="content_nav_group">
                <label :for="`menu_${index}`" class="content_nav_heading">
                    <div class="text">
                        {{ menu.title }}
                    </div>
                    <div class="has_more">
                        <i class="fa fa-angle-down"></i>
                    </div>
                </label>
                <ul class="content_nav_menu">
                    <input :id="`menu_${index}`" :checked="has_active_menu(menu.submenus) ? true : false" type="checkbox" class="content_nav_toggle" />
                    <li v-for="(submenu, sindex) in menu.submenus" :key="sindex">
                        <router-link :to="{name: submenu.route_name}">
                            <i class=""></i>
                            <span class="title">
                                {{ submenu.title }}
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
import config from './setup/config';

const menus = [
    {
        title: 'User Management',
        submenus: [
            {
                title: 'All User',
                route_name: `Alluser`,
                icon: '',
                count: 0
            },
            {
                title: 'Create User',
                route_name: `Createuser`,
                icon: '',
                count: 0
            },
        ]
    },
    {
        title: 'Role Management',
        submenus: [
            {
                title: 'All Role',
                route_name: `Alluser_role`,
                icon: '',
                count: 0
            },
            {
                title: 'Create Role',
                route_name: `Createuser_role`,
                icon: '',
                count: 0
            },
        ]
    },
];

export default {
    data: () => ({
        config,
        menus,
    }),
    created: function(){
        console.log(this.$route.name);
        
    },
    methods: {
        has_active_menu: function (menus) {
            return menus.find(menu => this.$route.name == menu.route_name);
        }
    }
}
</script>
<style lang="">

</style>
