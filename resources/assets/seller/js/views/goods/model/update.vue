<template>
    <component-modal title="修改商品属性&规格" :loading="loading">
        <Form ref="formUpdate" :model="formUpdate" :label-width="90" :rules="ruleUpdate">
            <Row>
                <Col span="16">
                    <FormItem label="名称" prop="name">
                        <Input v-model="formUpdate.name" placeholder="名称"></Input>
                    </FormItem>
                </Col>
            </Row>
            <Row>
                <Col span="10">
                    <FormItem label="类型" prop="type">
                        <i-select v-model="formUpdate.type" transfer @on-change="typeChange">
                            <i-option :value="1">属性</i-option>
                            <i-option :value="2">规格</i-option>
                        </i-select>
                    </FormItem>
                </Col>

                <Col span="10" v-if="formUpdate.type === 1">
                    <FormItem label="输入框类型" prop="input">
                        <i-select v-model="formUpdate.input" transfer @on-change="inputChange">
                            <i-option value="text">文本框</i-option>
                            <i-option value="select">选择框</i-option>
                        </i-select>
                    </FormItem>
                </Col>
            </Row>

            <FormItem v-if="formUpdate.input === 'select'" v-for="(item, index) in formUpdate.values" :key="index"
                      label="属性&规格值"
                      :prop="'values.' + index + '.name'" :rules="{required: true,message:'属性&规格值必须填写'}">
                <Row>
                    <Col span="18">
                        <Input v-model="item.name" placeholder="属性&规格值"></Input>
                    </Col>
                    <Col span="4" offset="1">
                        <Button @click="handleRemove(index)">删除</Button>
                    </Col>
                </Row>
            </FormItem>

            <FormItem v-if="formUpdate.input === 'select'">
                <Row>
                    <Col span="12">
                        <Button type="dashed" long @click="handleAdd" icon="md-add">添加值</Button>
                    </Col>
                </Row>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button @click="updateSubmit('formUpdate', `attribute/${data.id}`)">修改</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import {Validator} from "../../../async-validator/goods/goods/update";

    export default {
        name: "update",
        components: {ComponentModal},
        mixins: [component, form],
        data() {
            return {
                formUpdate: {
                    values: [{
                        name: ''
                    }],
                    type: 1,
                    input: 'select'
                },
                ruleUpdate: Validator(this)
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.loading = true;
                this.$http.get(`attribute/${this.data.id}/edit`).then((res) => {
                    this.formUpdate = Object.assign({}, this.formUpdate, res.data.data)
                }).catch((err) => {
                    this.formatErrors(err)
                }).finally(() => {
                    this.loading = false;
                })
            })
        },
        methods: {
            handleAdd() {
                this.formUpdate.values.push({
                    name: ''
                });
            },
            handleRemove(index) {
                this.formUpdate.values.splice(index, 1);
            },
            typeChange(val) {
                this.formUpdate.input = 'select'
            },
            inputChange(val) {
                if (val === 'text')
                    this.formUpdate.values = [{name: ''}]
            }
        }
    }
</script>

<style scoped>

</style>