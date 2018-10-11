<template>
    <my-lists :loading="loading" v-model="data" :columns="columns" @change="search">
        <Button slot="button" size="small" type="success" @click="showComponent('Create')">添加</Button>

        <components v-bind:is="component.current" :componentProps="component.data" @on-change="hideComponent"></components>
    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import Create from './create'

    export default {
        name: "index",
        components: {MyLists, Create},
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
                            value += key === 0 ? val.name : val.name + ','
                        });
                        return (<div>{value}</div>)
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
            }
        }
    }
</script>

<style scoped>

</style>