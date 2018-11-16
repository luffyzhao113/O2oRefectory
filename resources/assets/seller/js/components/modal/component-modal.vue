<template>
    <Modal :title="title" :value="true" @on-visible-change="change" :transfer="false" :mask-closable="false"
           :width="width">
        <div class="modal-body">
            <slot></slot>
        </div>
        <div slot="footer">
            <slot name="footer"></slot>
        </div>
        <Spin size="large" fix v-if="loading"></Spin>
    </Modal>
</template>

<script>
    export default {
        name: "component-modal",
        props: {
            title: {
                type: String,
                default: '弹窗'
            },
            width: {
                type: Number,
                default: 520
            },
            loading: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            change(v) {
                this.$parent.$emit('on-change')
            }
        }
    }
</script>

<style scoped>
    .modal-body {
        max-height: 550px;
        overflow-y: auto;
    }
</style>