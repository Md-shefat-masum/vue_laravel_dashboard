<template>
    <button class="py-1 text-[14px] cursor-pointer font-light px-2 text-white bg-[#4c6eab] hover:bg-[#3F5C91]">
        <i :class="icon"></i>
        {{ title }}
    </button>
</template>
<script>
export default {
    name: 'ButtonInfo',
    props: {
        icon: {
            type: String,
            default: 'fa fa-save'
        },
        title: {
            type: String,
            default: 'Submit'
        }
    }
}
</script>
