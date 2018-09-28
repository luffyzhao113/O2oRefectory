<template>
    <component-modal title="查看店铺管理员" :width="800">
        111
    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import component from "../../../mixins/component";
    export default {
        name: "manager",
        components: {ComponentModal},
        mixins: [component]
    }
</script>

<style scoped>

</style>