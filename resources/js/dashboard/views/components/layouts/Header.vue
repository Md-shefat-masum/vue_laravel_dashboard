<template lang="">
    <header class="header">
        <div class="logo">
            <img src="https://apps.sematext.com/ui/asset_3fe914b7c3f82cf2a5be.svg" alt="">
        </div>
        <Breadcumb></Breadcumb>
        <div class="header_right">
            <ul>
                <li>
                    <a href="/">
                        <i class="fa fa-envelope"></i>
                    </a>
                </li>
                <li>
                    <a href="/">
                        <i class="fa fa-expand"></i>
                    </a>
                </li>
            </ul>
        </div>
    </header>
</template>
<script>
import Breadcumb from './Breadcumb.vue';
export default {
    components: {
        Breadcumb,
    }
}
</script>
<style lang="">

</style>
