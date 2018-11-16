<template>
    <my-lists :columns="columns" v-model="data">
        <Card>
            <p slot="title">
                <span>搜索</span>
            </p>
            <Form ref="searchForm" :model="searchForm" :label-width="80" inline>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="showComponent('Create')" type="warning">添加</Button>
                </FormItem>
            </Form>
        </Card>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import Create from './create';
    import Update from './update'

    export default {
        name: "index",
        components: {MyLists, Create, Update},
        mixins: [lists],
        data() {
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
                    title: '上架状态',
                    maxWidth: 150,
                    render: (h, {row}) => {
                        return  <tag on-on-change={() => this.isSaleChange(row)} checkable color={row.is_sale ? 'primary' : 'error'}>{row.is_sale ? '上架' : '下架'}</tag>
                    }
                }, {
                    title: '审核状态',
                    maxWidth: 150,
                    render: (h, {row}) => {
                        if(row.status === 0){
                            return  <tag color="warning">未审核</tag>
                        }else if(row.status === 1){
                            return  <tag color="success">已审核</tag>
                        }else{
                            return  <tag color="error">禁售</tag>
                        }
                    }
                }, {
                    title: '操作',
                    width: 200,
                    render: (h, {row}) => {
                        return (<button-group>
                            <i-button size="small" on-click={() => this.showComponent('Update', row)}>修改</i-button>
                            <poptip
                                confirm
                                transfer
                                title="确定要放入回收站吗？"
                                on-on-ok={() => this.destroyItem(row, `goods/${row.id}`)}
                            >
                                <i-button size="small">放入回收站</i-button>
                            </poptip>
                        </button-group>);
                    }
                }]
            }
        },
        methods: {
            search(page = 1) {
                this.$http.get(`goods`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data);
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.loading = false
                });
            },
            isSaleChange(row){
                let sale = Number(!Boolean(row.is_sale));
                console.log(sale)
            }
        }
    }
</script>

<style scoped>

</style>