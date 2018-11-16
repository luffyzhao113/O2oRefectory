<template>
    <my-lists :columns="columns" v-model="data">

    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    export default {
        name: "index",
        components: {MyLists},
        mixins:[lists],
        data(){
            return {
                columns: [{
                    title: '商品名称',
                    key: 'name',
                    tooltip: true
                }, {
                    title: '分类',
                    maxWidth: 150,
                    render: (h, {row}) => {
                        return <span>{row.categories.name}</span>
                    }
                }, {
                    title: '条码',
                    maxWidth: 150,
                    key: 'bar_code'
                }, {
                    title: '价格',
                    maxWidth: 150,
                    key: 'price'
                }, {
                    title: '库存',
                    maxWidth: 150,
                    key: 'stock'
                }, {
                    title: '销量',
                    maxWidth: 150,
                    key: 'sale'
                }, {
                    title: '操作',
                    maxWith: 100,
                    render: (h, {row}) => {
                        return (<poptip
                            confirm
                            transfer
                            title="确定要恢复吗？"
                            on-on-ok={() => this.restore(row.id)}
                        ><i-button size="small">恢复</i-button>
                        </poptip>)
                    }
                }]
            }
        },
        methods: {
            search(page = 1) {
                this.$http.get(`goods/recycle`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data);
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.loading = false
                });
            },
            restore(id){
                this.$http.put(`goods/${id}/restore`).then(() => {
                    this.search()
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.loading = false
                });
            }
        }
    }
</script>

<style scoped>

</style>