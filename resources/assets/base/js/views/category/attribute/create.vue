<template>
    <i-drawer title="添加类目属性" :loading="loading">
        <Form ref="formCreate" :model="formCreate" :label-width="100">
            <FormItem label="属性名称" prop="name" :rules="{required: true, message: '属性名称必须填写'}">
                <Row>
                    <Col span="12">
                        <Input v-model="formCreate.name" placeholder="属性名称"></Input>
                    </Col>
                </Row>
            </FormItem>

            <FormItem v-for="(item, index) in formCreate.values" :key="index" label="类目属性值"
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
            <Button @click="createSubmit('formCreate', 'attribute')">创建</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/modal/i-drawer";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";

    export default {
        name: "create",
        components: {IDrawer},
        mixins: [component, form],
        data() {
            return {
                formCreate: {
                    values: [{
                        name: ''
                    }],
                    category_id: this.$route.query.category_id
                }
            }
        },
        methods: {
            handleAdd() {
                this.formCreate.values.push({
                    name: ''
                });
            },
            handleRemove(index) {
                this.formCreate.values.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>