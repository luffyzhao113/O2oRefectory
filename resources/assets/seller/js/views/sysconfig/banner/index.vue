<template>
    <my-lists v-model="data" :columns="columns" @change="search" :loading="loading">
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
    import Create from "./create"
    import Update from "./update"

    export default {
        name: "index",
        components: {MyLists, Create, Update},
        mixins: [lists],
        data() {
            return {
                columns: [{
                    'title': '名称',
                    'key': 'name'
                }, {
                    title: '位置',
                    key: 'position'
                }, {
                    title: '横幅状态',
                    key: 'status',
                    render: (h, {row}) => {
                        return <span>{row.status === 1 ? "开启" :"关闭"}</span>
                    }
                }, {
                    title: '操作',
                    key: 'status',
                    render: (h, {row}) => {
                        return (<button-group>
                            <i-button size="small" on-click={() => this.showComponent('Update', row)}>修改</i-button>
                            <poptip
                                confirm
                                transfer
                                title="确定要放入删除吗？"
                                on-on-ok={() => this.destroyItem(row, `banner/${row.id}`)}
                            >
                                <i-button size="small">删除</i-button>
                            </poptip>
                        </button-group>);
                    }
                }]
            }
        },
        methods: {
            search(page = 1) {
                this.loading = true
                this.$http.get(`banner`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data);
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.loading = false
                })
            }
        }
    }
</script>

<style scoped>

</style>