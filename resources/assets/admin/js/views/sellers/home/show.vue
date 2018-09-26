<template>
    <component-modal title="查看店铺" :width="750" :loading="loading">
        <box title="店铺详情">
            <detail title="店铺名称">{{seller.name}}</detail>
            <detail title="店铺状态">
                <span v-if="seller.status === 0">关闭</span>
                <span v-else>开启</span>
            </detail>
            <detail title="店铺二级域名">{{seller.domain}}</detail>
        </box>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import component from "../../../mixins/component";
    import http from "../../../mixins/http";
    import Box from "../../../components/box/index";
    import Detail from "../../../components/detail/index";

    export default {
        name: "show",
        components: {
            Detail,
            Box,
            ComponentModal
        },
        mixins: [component, http],
        data() {
            return {
                seller: {
                    name: '',
                    certificates: {
                        name: ''
                    },
                    logs: []
                },
                columns: [
                    {
                        title: '序号',
                        render: (h, {index}) => {
                            return <span>{++index}</span>
                        },
                        width: 75
                    },
                    {
                        title: '操作内容',
                        key: 'remark'
                    },
                    {
                        title: '时间',
                        key: 'created_at'
                    }
                ]
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.loading = true
                this.$http.get(`seller/${this.data.id}`).then((res) => {
                    this.seller = res.data.data
                }).catch((err) => {
                    this.formatErrors(err)
                }).finally(() => {
                    this.loading = false
                })
            })
        }
    }
</script>

<style scoped>
    .tr {
        text-align: right;
    }
</style>