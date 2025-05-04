<template lang="">
    <div>
        from {{ $route.params.id }} <br>
        <router-link to="/user/edit/1/1">e1</router-link> <br>
        <router-link to="/user/edit/1/2">e2</router-link> <br>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="">

</style>
