<template>
    <component-modal title="查看店铺">
        <Row>
            <Col span="4" class="tr">
                   店铺名称：
            </Col>
            <Col span="8">
                {{seller.name}}
            </Col>
            <Col span="4" class="tr">
                    商家姓名：
            </Col>
            <Col span="8">
                {{seller.certificates.name}}
            </Col>
        </Row>
        <Row>
            <Col span="24">
                日志
            </Col>
        </Row>
        <Table :columns="columns" :data="seller.logs" size="small"></Table>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../components/modal/component-modal";
    import component from "../../mixins/component";
    import http from "../../mixins/http";
    export default {
        name: "show",
        components: {ComponentModal},
        mixins: [component, http],
        data(){
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
        mounted(){
            this.$nextTick(() => {
                this.$http.get(`seller/${this.data.id}`).then((res) => {
                    this.seller = res.data.data
                }).catch((err) => {
                    this.formatErrors(err)
                })
            })
        }
    }
</script>

<style scoped>
    .tr{
        text-align: right;
    }
</style>