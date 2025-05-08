<template lang="">
    <app-body>
        <div class="app_content bg-[transparent]!">

            <h5 class="mb-[20px]!">
                Overview
            </h5>
            <div class="flex flex-wrap gap-2">

                <div v-for="(item, index) in analytics" :key="index" class="p-3 bg-[white] rounded-sm text-[#195f74]  shadow-sm min-w-[170px]">
                    <div class=" font-regular text-[25px] ">
                        {{ item.value }}
                    </div>
                    <div class="text-[12px]">
                        {{ item.label }}
                    </div>
                </div>

            </div>

        </div>
    </app-body>
</template>
<script>

export default {
    data: () => ({
        analytics: [
            {
                label: "Total Visitors",
                value: Intl.NumberFormat().format(15000),
            },
            {
                label: "Total Page Views",
                value: Intl.NumberFormat().format(1200),
            },
            {
                label: "Total Posts",
                value: Intl.NumberFormat().format(19630),
            },
            {
                label: "Average Time On Site",
                value: Intl.NumberFormat().format(10)+' mins',
            },
            {
                label: "Subscriber Count",
                value: Intl.NumberFormat().format(1742),
            },
        ]
    }),
    created: function () {

    }
}
</script>
<style lang="">

</style>
