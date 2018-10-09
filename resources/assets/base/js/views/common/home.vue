<template lang="html">
    <div>
        <home-remark></home-remark>
    </div>
</template>

<script>
    import HomeRemark from "./components/home/remark";

    export default {
        name: 'admin-home',
        components: {
            HomeRemark,
        },
        data() {
            return {
                data: []
            }
        },
    }
</script>

<style lang="scss">

</style>
