<template>
    <fieldset class="border border-gray-300 rounded p-3 ">
        <legend class="text-md text-[12px] font-semibold text-gray-500 px-2">
            {{ title }}:
        </legend>

        <slot></slot>

    </fieldset>
</template>
<script>
export default {
    props: {
        title: String,
    }
}
</script>
