<template lang="">
    <thead class="bg-white sticky top-0 left-0 z-[999]">
        <tr>
            <th v-for="cell in cells" :key="cell.key"
                :align="cell.align"
                class="font-medium text-[rgb(76, 110, 171)] px-4 py-2 relative before:absolute before:w-[1px] before:h-[60%] before:bg-gray-200 before:left-0 before:top-1/2 before:-translate-y-1/2 first:before:hidden"
            >
                {{cell.key}}
            </th>
        </tr>
    </thead>
</template>
<script>
export default {
    props: {
        cells: {
            type: Array,
            required: true
        }
    }
}
</script>
<style lang="">

</style>
