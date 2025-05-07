<template lang="">
    <input type="search"
        @keyup="search_item($event.target.value)"
        :value="store.search_key"
        placeholder="searh.."
        class="bg-white border border-gray-700 text-gray-900 text-sm rounded-e-xs focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-1"
    />
</template>
<script>
export default {
    props: {
        store: {
            type: Object,
            required: true
        }
    }
}
</script>
<style lang="">

</style>
