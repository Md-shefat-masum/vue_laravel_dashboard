<template lang="">
    <div class="grid grid-cols-4 gap-[30px]">
        <div v-for="(menu, index) in store.setting_fields" :key="index" class="mb-5 h-[100%] bg-gray-200">
            <div class="text mb-2 bg-blue-400 text-white p-2">
                <i class="fa fa-gears"></i>
                {{ menu.title }}
            </div>
            <ul class="p-3!">
                <li v-for="(submenu, sindex) in menu.sub_group" :key="sindex">
                    <router-link :to="{name: 'SettingForm', params: {group_id: menu.id, sub_group_id: submenu.id }}">
                        <i class="fa fa-gear mr-2"></i>
                        <span class="title">
                            {{ submenu.title }}
                        </span>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import config from './setup/config';
import store from './setup/store';
export default {
    data: () => ({
        config,
        store: store(),
    }),
    methods: {
        has_active_menu: function (menus) {
            return menus.find(menu => {
                const url = `/settings/update/${menu.setting_group_id}/${menu.id}`;
                return this.$route.path == url;
            });
        }
    },
}
</script>
<style lang="">

</style>
