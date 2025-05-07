<template>
    <router-link
        v-bind="$attrs"
        :to="{name: route_name, params: params}"
        :class="[
            '!flex gap-2 items-center',
            'py-1 px-4 text-white text-[14px] hover:bg-[var(--brand_deep)] hover:text-white bg-[var(--brand)]'
            , $attrs.class
        ]"
    >

        <i v-if="icon" :class="icon"></i>

        {{ text }}

        <slot></slot>

    </router-link>
</template>
<script>
export default {
    props: {
        icon: {
            type: String,
            default: null,
        },
        route_name: {
            type: String,
            required: true,
        },
        params: {
            type: Object,
            default: () => {}
        },
        text: {
            type: String,
            default: ''
        }
    },
    defineOptions: {
        inheritAttrs: false
    },
}
</script>

