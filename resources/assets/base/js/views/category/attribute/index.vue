<template>
    <my-lists :loading="loading" v-model="data" :columns="columns" @change="search">
        <template slot="button">
            <button-group>
                <Button size="small" type="success" @click="showComponent('Create')">添加</Button>
                <Button size="small" type="success" @click="back()">返回</Button>
            </button-group>
        </template>
        <components v-bind:is="component.current" :componentProps="component.data"
                    @on-change="hideComponent"></components>
    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import Create from './create'
    import Update from './update'

    export default {
        name: "index",
        components: {MyLists, Create, Update},
        mixins: [lists],
        data() {
            return {
                searchForm: {
                    category_id: this.$route.query.category_id
                },
                columns: [{
                    title: '属性名',
                    key: 'name'
                }, {
                    title: '属性值',
                    render: (h, {row}) => {
                        let value = '';
                        row.values.forEach((val, key) => {
                            value += key === 0 ? (val.name) : (',' + val.name)
                        });
                        return (<div>{value}</div>)
                    }
                }, {
                    title: '操作',
                    render: (h, {row}) => {
                        return (<button-group>
                            <i-button size="small" on-click={() => this.showComponent('Update', row)}>修改</i-button>
                            <i-button size="small" on-click={() => this.destroyItem(row, `attribute/${row.id}`)}>删除
                            </i-button>
                        </button-group>);
                    }
                }]
            }
        },
        methods: {
            search(page = 1) {
                this.loading = true;
                this.$http.get(`attribute`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data);
                }).finally(() => {
                    this.loading = false
                });
            },
            back() {
                this.$store.dispatch('closeCurrent');
            }
        }
    }
</script>

<style scoped>

</style>