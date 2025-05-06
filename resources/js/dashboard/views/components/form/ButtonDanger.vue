<template>
    <button class="
        py-1 text-[14px] cursor-pointer font-light px-2 text-white
        bg-[#ff4d4f] hover:bg-[#ff7875]">

        <i :class="icon"></i>

        {{ title }}

        <slot></slot>

    </button>
</template>
<script>
export default {
    name: 'ButtonInfo',
    props: {
        icon: {
            type: String,
            default: 'fa fa-cancel'
        },
        title: {
            type: String,
            default: 'Close'
        }
    }
}
</script>
