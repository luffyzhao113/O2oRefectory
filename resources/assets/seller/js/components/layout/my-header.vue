<template>
    <Row>
        <Col :span="12">
            <div class="logo">
                店铺管理后台
            </div>
        </Col>
        <Col :span="12" style="text-align: right;">
            <my-header-icon></my-header-icon>
            <my-header-ownspace></my-header-ownspace>
        </Col>
    </Row>

</template>

<script>
    import MyHeaderOwnspace from "./my-header-ownspace";
    import MyHeaderIcon from "./my-header-icon";

    export default {
        components: {
            MyHeaderIcon,
            MyHeaderOwnspace},
        name: "my-header",
    }
</script>

<style lang="less" scoped>
    .logo{
        color: #fff;
        text-align: center;
        font-size: 16px;
        width: 200px;
        height: 50px;
    }
</style>