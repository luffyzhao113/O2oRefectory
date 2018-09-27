<template>
        <Col :span="span">
            {{title}} : <slot></slot>
        </Col>
</template>

<script>
  export default {
    name: "detail",
    props: {
      title: {
        type: String,
        default: '标题'
      },
      span: {
        type: Number,
        default: 8
      }
    }
  }
</script>

<style scoped>

</style>