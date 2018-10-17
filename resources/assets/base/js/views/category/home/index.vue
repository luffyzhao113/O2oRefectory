<template>
    <div>
        <div class="box-flex-list">
            <Card>
                <p slot="title">
                    <span>列表</span>
                    <Button size="small" type="success" @click="showComponent('Create')">添加</Button>
                </p>
                <TabelExpandTree class="permission-role" :columns="columns" :data="lists"
                                 :loading="loading"></TabelExpandTree>
            </Card>
        </div>
        <components v-bind:is="component.current" @on-change="hideComponent"
                    :componentProps="component.data"></components>
    </div>
</template>

<script>
    import Create from './create'
    import Update from './update'
    import TabelExpandTree from "../../../components/table/tabel-expand-tree";
    import lists from "../../../mixins/lists";

    export default {
        name: "index",
        mixins: [lists],
        components: {TabelExpandTree, Create, Update},
        data() {
            return {
                columns: [{
                    title: '类目名称',
                    key: 'name',
                    render: (h, {row}) => {
                        return <span class="table-col-title">{row.name}</span>
                    }
                },{
                    title: '属性',
                    render: (h, {row}) => {
                        let value = '';
                        row.attributes.forEach((val, key) => {
                            value += key === 0 ? (val.name) : (',' + val.name)
                        });
                        return (<div>{value}</div>)
                    }
                }, {
                    title: '排序',
                    key: 'sort'
                }, {
                    title: '操作',
                    render: (h, {row}) => {
                        return (<button-group>
                            <i-button size="small" on-click={() => this.showComponent('Update', row)}>修改</i-button>
                            <i-button size="small" on-click={() => this.attributes(row)}>分类属性</i-button>
                            <i-button disabled={(this.child(row.id).length > 0)}
                                      size="small"
                                      on-click={() => this.destroyItem(row, `category/${row.id}`)}>删除
                            </i-button>
                        </button-group>);
                    }
                }],
                lists: [],
                loading: false
            }
        },
        methods: {
            search() {
                this.loading = true
                this.$http.get(`category`).then((res) => {
                    this.lists = res.data.data
                }).finally(() => {
                    this.loading = false
                });
            },
            child(parent) {
                return this.lists.filter(val => val.parent_id == parent)
            },
            attributes(row) {
                this.$router.push({
                    name: 'category.attribute',
                    query: {category_id: row.id}
                })
            }
        }
    }
</script>

<style scoped>

</style>