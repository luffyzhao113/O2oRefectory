<template>
    <component-modal title="修改类目属性" :loading="loading">
        <Form ref="formUpdate" :model="formUpdate" :label-width="100">
            <FormItem label="属性名称" prop="name" :rules="{required: true, message: '属性名称必须填写'}">
                <Row>
                    <Col span="12">
                        <Input v-model="formUpdate.name" placeholder="属性名称"></Input>
                    </Col>
                </Row>
            </FormItem>
            <FormItem v-for="(item, index) in formUpdate.values" :key="index" label="类目属性值"
                      :prop="'values.' + index + '.name'" :rules="{required: true,message:'类目属性值必须填写'}">
                <Row>
                    <Col span="18">
                        <Input v-model="item.name" placeholder="类目属性值"></Input>
                    </Col>
                    <Col span="4" offset="1"><Button @click="handleRemove(index)">删除</Button></Col>
                </Row>
            </FormItem>

            <FormItem>
                <Row>
                    <Col span="12">
                        <Button type="dashed" long @click="handleAdd" icon="md-add">添加属性值</Button>
                    </Col>
                </Row>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button @click="updateSubmit('formUpdate', `attribute/${componentProps.id}`)">创建</Button>
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
        mixins: [component, form],
        mounted() {
            this.$nextTick(() => {
                this.loading = true
                this.$http.get(`attribute/${this.componentProps.id}/edit`).then((res) => {
                    this.formUpdate = res.data.data
                }).finally(() => {
                    this.loading = false
                })
            })
        },
        data() {
            return {
                formUpdate: {
                    values: []
                }
            }
        },
        methods: {
            handleAdd() {
                this.formUpdate.values.push({
                    name: ''
                });
            },
            handleRemove(index) {
                this.formUpdate.values.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>