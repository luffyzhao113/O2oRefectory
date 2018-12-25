<template>
    <i-drawer title="添加模型" :loading="loading" :width="900" class="seller-model">
        <Form ref="formUpdate" :model="formUpdate" :label-width="100" :rules="ruleUpdate">
            <Row>
                <Col span="12">
                    <FormItem label="模型名称" prop="name">
                        <Input v-model="formUpdate.name" placeholder="模型名称"></Input>
                    </FormItem>
                </Col>
                <Col span="16">
                    <FormItem label="模型说明">
                        <Input type="textarea" v-model="formUpdate.description" placeholder="模型说明"></Input>
                    </FormItem>
                </Col>
                <Col span="24">
                    <FormItem label="模型规格" prop="specs">
                        <FormTags v-model="formUpdate.specs" placeholder="规格"></FormTags>
                    </FormItem>
                </Col>
                <Col offset="3" span="21">
                    <box title="关联属性">
                        <template v-for="(item, index) in formUpdate.attributes">
                            <box-item :span="1" class="delete">
                                <Icon :size="18" color="red" type="md-close-circle" @click="handleRemove"/>
                            </box-item>
                            <box-item :span="5">
                                <FormItem label="名称" :label-width="55" class="form-item" :prop="'attributes.' +
                                index + '.name'" :rules="{required: true, message: '关联属性必须填写', trigger: 'blur'}">
                                    <Input placeholder="名称" v-model="item.name" size="small"></Input>
                                </FormItem>
                            </box-item>
                            <box-item :span="18">
                                <FormItem label="值" :label-width="55" class="form-item" :prop="'attributes.' + index
                                + '.values'"
                                          :rules="{required: true, type: 'array', message: '关联值必须填写', trigger: 'blur'}">
                                    <FormTags placeholder="值" v-model="item.values"></FormTags>
                                </FormItem>
                            </box-item>
                        </template>

                        <box-item offset="1" span="6">
                            <Button long type="dashed" size="small" @click="handleAdd">添加属性</Button>
                        </box-item>
                    </box>
                </Col>
            </Row>
        </Form>
        <div slot="footer">
            <Button @click="updateSubmit('formUpdate', `model/${data.id}`)">更新</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/modal/i-drawer";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import {Validator} from "../../../async-validator/goods/model/update";
    import Box from "../../../components/box/index";
    import BoxItem from "../../../components/box/box-item";
    import FormTags from "../../../components/form/tags";

    export default {
        name: "create",
        components: {FormTags, BoxItem, Box, IDrawer},
        mixins: [component, form],
        data() {
            return {
                formUpdate: {
                    attributes: [{
                        name: '',
                        values: []
                    }],
                    specs: []
                },
                ruleUpdate: Validator(this)
            }
        },
        mounted(){
            this.loading = true
            this.$http.get(`model/${this.data.id}/edit`).then((res) => {
                this.formUpdate = Object.assign({}, this.formUpdate, res.data.data)
            }).catch((err) => {
                this.formatErrors(err)
            }).finally(() => {
                this.loading = false;
            })
        },
        methods: {
            handleAdd() {
                this.formUpdate.attributes.push({
                    name: '',
                    values: []
                })
            },
            handleRemove(index) {
                this.formUpdate.attributes.splice(index, 1);
            }
        }
    }
</script>

<style lang="less">
    .seller-model {
        .form-item {
            margin-bottom: 19px
        }
        .delete {
            text-align: center;
            line-height: 30px;
            cursor: pointer
        }
        .form-item {
            .ivu-form-item-error-tip {
                padding-top: 0;
            }
        }
    }
</style>