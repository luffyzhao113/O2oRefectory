<template>
    <Col :span="span" :offset="offset" :order="order" :push="push" :pull="pull" :className="className" :xs="xs" :sm="sm" :md="md" :lg="lg" >
        <slot></slot>
    </Col>
</template>

<script>
    export default {
        name: "box-item",
        props: {
            span: [Number, String],
            order: [Number, String],
            offset: [Number, String],
            push: [Number, String],
            pull: [Number, String],
            className: String,
            xs: [Number, Object],
            sm: [Number, Object],
            md: [Number, Object],
            lg: [Number, Object]
        }
    }
</script>

<style scoped>

</style>