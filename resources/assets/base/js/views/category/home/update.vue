<template>
    <i-drawer title="修改类目" :loading="loading">
        <Form ref="formUpdate" :model="formUpdate" :label-width="80">
            <FormItem label="类目名称" prop="name" :rules="{required: true, message: '类目名称必须填写'}">
                <Input v-model="formUpdate.name" placeholder="类目名称"></Input>
            </FormItem>
            <FormItem label="所属上级" prop="parent_id">
                <group-cascader v-model="formUpdate.parent_id" placeholder="顶级类目" :data="parents"
                                label="name"></group-cascader>
            </FormItem>
            <FormItem label="排序" prop="sort" :rules="{required: true, type:'number', message: '排序必须为数值类型'}">
                <Input v-model="formUpdate.sort" placeholder="排序" number></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button @click="updateSubmit('formUpdate', `category/${componentProps.id}`)">更新</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/modal/i-drawer";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import GroupCascader from "../../../components/cascader/index";

    export default {
        name: "update",
        components: {IDrawer, GroupCascader},
        mixins: [component, form],
        data() {
            return {
                formUpdate: {
                    name: '',
                    parent_id: 0,
                    sort: 1
                },
                parents: []
            }
        },
        mounted() {
            this.loading = true
            this.$http.get(`category/${this.componentProps.id}/edit`).then((res) => {
                this.parents = res.data.data.parents
                this.formUpdate = res.data.data.row
            }).finally(() => {
                this.loading = false
            })
        },
        methods: {}
    }
</script>

<style scoped>

</style>