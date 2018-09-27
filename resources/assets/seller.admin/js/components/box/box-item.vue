<template>
    <Col :span="span">
        <slot></slot>
    </Col>
</template>

<script>
    export default {
        name: "box-item",
        props: {
            span: [Number]
        }
    }
</script>

<style scoped>

</style>