<template lang="">
    <app-body>
        <div class="app_content bg-[transparent]!">

            <h5 class="mb-[20px]!">
                Page Builder
            </h5>

            <div class="page-builder">
                <div id="myGrid"></div>
            </div>

        </div>
    </app-body>
</template>
<script>

export default {
    data: () => ({
        
    }),
    mounted: function () {
        // this.$nextTick(() => {
        //     console.log(this.$refs.message.textContent); // logs: 'Updated!'
        // });
        $('#myGrid').gridEditor({
            new_row_layouts: [
                [12],
                [4, 4, 4],
                [3, 3, 3, 3],
                [2, 2, 2, 2, 2, 2],
                [6, 6],
                [4, 8],
                [8, 4],
                [9, 3],
                [6, 3, 3]
            ],
            content_types: ['ckeditor'],
            ckeditor: {
                config: {
                    on: {
                        instanceReady: function (evt) {
                            var instance = this;
                        }
                    }
                }
            }
        });
    }
}
</script>
<style lang="">

</style>
