<template>
    <component-modal title="修改角色" :loading="loading">
        <Form ref="formUpdate" :model="formUpdate" :label-width="80">
            <FormItem label="角色名称" prop="name" :rules="{required: true, message: '角色名称不能为空'}">
                <Input v-model="formUpdate.name" placeholder="角色名称"></Input>
            </FormItem>
            <FormItem label="是否开启" prop="status">
                <RadioGroup v-model="formUpdate.status" type="button">
                    <Radio :label="1" :value="1">开启</Radio>
                    <Radio :label="0" :value="0">关闭</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="角色描述" prop="description">
                <Input v-model="formUpdate.description" type="textarea" placeholder="角色描述"></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button @click="updateSubmit('formUpdate', `role/${componentProps.id}`)">更新</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    export default {
        name: "update",
        components: {ComponentModal},
        mixins: [form, component],
        data(){
            return {
                formUpdate:{
                    name: '',
                    status: 1,
                    description: ''
                }
            }
        },
        mounted(){
            this.$http.get(`role/${this.componentProps.id}`).then((res) => {
                this.formUpdate = res.data.data
            }).catch((err) => {
                this.formatErrors(err)
            })
        }
    }
</script>

<style scoped>

</style>