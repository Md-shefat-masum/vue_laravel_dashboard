<template>
    <router-link :to="{name: to}" class="py-1 px-4 text-white/90 text-[14px] hover:bg-[var(--brand_deep)] hover:text-white bg-[var(--brand)]">
        <i class="fa fa-arrow-left"></i>
        {{ text }}
    </router-link>
</template>
<script>
export default {
    props: {
        to: {
            type: String,
        },
        text: {
            type: String,
            default: 'Back'
        }
    }
}
</script>
