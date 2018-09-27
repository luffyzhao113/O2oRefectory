<template>
    <my-lists v-model="data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title">
                <span>搜索</span>
            </p>
            <Form ref="searchForm" :model="searchForm" :label-width="80" inline>
                <FormItem prop="name" label="店铺名称">
                    <Input type="text" v-model="searchForm.name"></Input>
                </FormItem>
                <FormItem prop="domain" label="二级域名">
                    <Input type="text" v-model="searchForm.domain"></Input>
                </FormItem>
                <FormItem prop="status" label="店铺状态">
                    <true-or-false v-model="searchForm.status" true-value="开通" false-value="关闭"></true-or-false>
                </FormItem>
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
    import TrueOrFalse from "../../../components/select/true-or-false";
    import Show from "./show"
    import Create from "./create"
    import Update from "./update"

    export default {
        components: {
            TrueOrFalse,
            MyLists,
            Show,
            Create,
            Update
        },
        mixins: [lists],
        name: "sellers-index",
        data() {
            return {
                columns: [{
                    title: '商店名称',
                    key: 'name'
                }, {
                    title: '商店二级域名',
                    key: 'domain'
                }, {
                    title: '状态',
                    render: (h, {row}) => {
                        switch (row.status) {
                            case 0:
                                return (<span>关闭</span>)
                                break;
                            case 1:
                                return (<span>开启</span>)
                                break;
                        }
                    }
                }, {
                    title: '操作',
                    render: (h, {row}) => {
                        return (<button-group>
                            <i-button on-click={() => {
                                this.showComponent('Show', row)
                            }} size="small">查看
                            </i-button>
                            <i-button on-click={() => {
                                this.showComponent('Update', row)
                            }} size="small">修改
                            </i-button>
                        </button-group>);
                    }
                }]
            }
        },
        methods: {
            search(page = 1) {
                this.loading = true
                this.$http.get(`seller`, {params: this.request(page)}).then((res) => {
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