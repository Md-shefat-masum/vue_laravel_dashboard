<template lang="">
    <div class="flex justify-center" style="gap: 4px;">
        <div class="table_actions">
            <a href="#" @click.prevent="()=>''" class="btn btn-sm btn-outline-secondary">
                <i class="fa fa-gear"></i>
            </a>
            <ul :style="`--action_elements: ${links.length}px;`">
                <li v-for="(link, index) in links" :key="index">
                    <span v-if="!link.onclick">
                        <router-link :to="link.to">
                            <i :class="link.icon"></i>
                            {{ link.label }}
                        </router-link>
                    </span>
                    <span v-else>
                        <a :href="link.to" @click.prevent="link.onclick">
                            <i :class="link.icon"></i>
                            {{ link.label }}
                        </a>
                    </span>
                </li>
            </ul>
        </div>

    </div>
</template>
<script>

export default {
    props: {
        links: {
            types: Array,
            default: () => []
        }
    }
}
</script>
<style lang="">

</style>
