<template>
    <i-drawer title="添加类目" :loading="loading">
        <Form ref="formCreate" :model="formCreate" :label-width="80">
            <FormItem label="类目名称" prop="name" :rules="{required: true, message: '类目名称必须填写'}">
                <Input v-model="formCreate.name" placeholder="类目名称"></Input>
            </FormItem>
            <FormItem label="所属上级" prop="parent_id">
                <group-cascader v-model="formCreate.parent_id" placeholder="顶级类目" :data="parents"
                                label="name"></group-cascader>
            </FormItem>
            <FormItem label="排序" prop="sort" :rules="{required: true, type:'number', message: '排序必须为数值类型'}">
                <Input v-model="formCreate.sort" placeholder="排序" number></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button @click="createSubmit('formCreate', 'category')">创建</Button>
        </div>
    </i-drawer>
</template>

<script>
    import component from "../../../mixins/component";
    import IDrawer from "../../../components/modal/i-drawer";
    import form from "../../../mixins/form";
    import GroupCascader from "../../../components/cascader/index";

    export default {
        name: "create",
        components: {GroupCascader, IDrawer},
        mixins: [component, form],
        data() {
            return {
                formCreate: {
                    parent_id: 0,
                    sort: 1
                },
                parents: []
            }
        },
        mounted() {
            this.loading = true
            this.$http.get(`category/create`).then((res) => {
                this.parents = res.data.data
            }).finally(() => {
                this.loading = false
            });
        }
    }
</script>

<style scoped>

</style>