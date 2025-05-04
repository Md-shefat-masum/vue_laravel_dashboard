<template lang="">
    <div class="bread_cumb">
        <ul>
            <li>
                <router-link to="/">
                    <i class="fa fa-home"></i>
                    <span>dashboard</span>
                </router-link>
            </li>
            <li v-for="(route, index) in paths" :key="index">
                <!-- <a :href="route" @click.prevent="()=>''">
                    {{ route }}
                </a> -->
                <!-- <router-link :to="`${route.path}`" v-if="paths[index]">
                    <span>{{paths[index]}}</span>
                </router-link> -->
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    data: ()=>({
        routes: [],
        paths: [],
    }),
    watch:{
        "$route": {
            handler(){
                // this.routes = this.$route.matched;
                // this.paths = this.$route.path.split('/');
                // this.routes.shift();
                // this.paths.shift();
                // console.log(this.$route);
            },
            deep: true,
        }
    },
}
</script>
<style lang="">

</style>
