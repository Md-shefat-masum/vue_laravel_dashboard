<template lang="">
    <app-body>
        <div class="content_nav">
            <div v-for="(menu, index) in store.setting_fields" :key="index" class="content_nav_group">
                <label :for="`menu_${index}`" class="content_nav_heading">
                    <div class="text">
                        {{ menu.title }}
                    </div>
                    <div class="has_more">
                        <i class="fa fa-angle-down"></i>
                    </div>
                </label>
                <ul class="content_nav_menu">
                    <input :id="`menu_${index}`" :checked="has_active_menu(menu.sub_group) ? true : false" type="checkbox" class="content_nav_toggle" />
                    <li v-for="(submenu, sindex) in menu.sub_group" :key="sindex">
                        <router-link :to="{name: 'SettingForm', params: {group_id: menu.id, sub_group_id: submenu.id }}">
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
import store from './setup/store';

export default {
    data: () => ({
        config,
        store: store(),
    }),
    created: async function(){
        await this.store.get_setting_fileds()
    },
    methods: {
        has_active_menu: function (menus) {
            return menus.find(menu => {
                const url = `/settings/update/${menu.setting_group_id}/${menu.id}`;
                return this.$route.path == url;
            });
        }
    }
}
</script>
<style lang="">

</style>
