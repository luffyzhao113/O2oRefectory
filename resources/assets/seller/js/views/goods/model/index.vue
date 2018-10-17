<template>
    <my-lists v-model="data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title">
                <span>搜索</span>
            </p>
            <Form ref="searchForm" :model="searchForm" :label-width="80" inline>
                <FormItem prop="role_id" label="类型" :label-width="60">
                    <i-select v-model="searchForm.type" clearable>
                        <i-option :value="1">属性</i-option>
                        <i-option :value="2">规格</i-option>
                    </i-select>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="showComponent('Create')" type="warning">添加</Button>
                </FormItem>
            </Form>
        </Card>

        <components v-bind:is="component.current" :data="component.data"
                    @on-change="hideComponent"></components>
    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import Create from "./create"
    import Update from './update'

    export default {
        name: "index",
        components: {MyLists, Create, Update},
        mixins: [lists],
        data() {
            return {
                columns: [{
                    title: '模型名称',
                    key: 'name'
                },  {
                    title: '操作',
                    render: (h, {row}) => {
                        return (<button-group>
                            <i-button size="small" on-click={() => this.showComponent('Update', row)}>修改</i-button>
                            <poptip confirm transfer title="确定要删除吗？"
                                    on-on-ok={() => this.destroyItem(row, `model/${row.id}`)}>
                                <i-button size="small">删除</i-button>
                            </poptip>
                        </button-group>);
                    }
                }]
            }
        },
        methods: {
            search(page = 1) {
                this.$http.get(`model`, {params: this.request(page)}).then((res) => {
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