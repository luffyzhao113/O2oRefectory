<template>
    <component-modal title="添加商品" :loading="loading" :width="1200">
        <Form ref="formCreate" :model="formCreate" :label-width="80" :rules="ruleCreate">
            <Row>
                <Col :span="19">
                    <Row>
                        <Col :span="18">
                            <FormItem label="商品名称" prop="name">
                                <Input v-model="formCreate.name" placeholder="商品名称"></Input>
                            </FormItem>
                        </Col>
                        <Col :span="24">
                            <Row>
                                <Col :span="6">
                                    <FormItem label="商品条码" prop="bar_code">
                                        <Input v-model="formCreate.bar_code" placeholder="商品条码"></Input>
                                    </FormItem>
                                </Col>

                                <Col :span="6">
                                    <FormItem label="商品价格" prop="price">
                                        <Input v-model="formCreate.price" number placeholder="商品价格"></Input>
                                    </FormItem>
                                </Col>

                                <Col :span="6">
                                    <FormItem label="商品库存" prop="stock">
                                        <Input v-model="formCreate.stock" number placeholder="商品库存"></Input>
                                    </FormItem>
                                </Col>

                                <Col :span="6">
                                    <FormItem label="商品销量" prop="sale">
                                        <Input v-model="formCreate.sale" number placeholder="商品销量"></Input>
                                    </FormItem>
                                </Col>

                                <Col :span="8">
                                    <FormItem label="上架状态" prop="is_sale">
                                        <true-or-false v-model="formCreate.is_sale" false-value="下架" true-value="上架"
                                                       style="width: 100%"></true-or-false>
                                    </FormItem>
                                </Col>

                                <Col :span="8">
                                    <FormItem label="商品分类" prop="category_id">
                                        <group-cascader :change-on-select="false" label="name"
                                                        v-model="formCreate.category_id" placeholder="商品分类"
                                                        :data="categories"></group-cascader>
                                    </FormItem>
                                </Col>

                                <Col :span="8">
                                    <FormItem label="商品模型" prop="model_id">
                                        <i-select v-model="formCreate.model_id" transfer clearable
                                                  @on-change="modelChange">
                                            <i-option v-for="(item, index) in models" :key="index" :value="item.id">
                                                {{item.name}}
                                            </i-option>
                                        </i-select>
                                    </FormItem>
                                </Col>
                            </Row>
                        </Col>
                    </Row>
                </Col>


                <Col :span="4" :offset="1">
                    <div class="base64-image">
                        <FormItem :label-width="0" prop="image">
                            <base64 v-model="formCreate.image"></base64>
                        </FormItem>
                    </div>
                </Col>

                <Col :span="10" :offset="1">
                    <FormItem :label-width="0" prop="images">
                        <images v-model="formCreate.images"></images>
                    </FormItem>
                </Col>

                <Col :span="12">
                    <Row class="scrollbar attributes">
                        <Col :span="22" :offset="2">
                            <box title="商品属性" v-if="model.attributes.length">
                                <box-item v-for="(item, index) in model.attributes" :key="index" span="8">
                                    <FormItem :label="item.name" class="form-item" :prop="`attribute.${item.name}`"
                                              :rules="{required: true,message: '商品属性['+item.name+']不能为空', trigger: 'change'}">
                                        <i-select transfer v-model="formCreate.attribute[item.name]" size="small">
                                            <i-option v-for="(value, key) in item.values" :key="key" :value="value">
                                                {{value}}
                                            </i-option>
                                        </i-select>
                                    </FormItem>
                                </box-item>
                            </box>
                            <box title="商品规格" v-if="model.specs.length">
                                <box-item v-for="(item, index) in model.specs" :key="index" :span="specsSpan"
                                          style="text-align: center">
                                    {{item}} <span class="required">*</span>
                                </box-item>
                                <box-item :span="specsSpan" style="text-align: center">库存 <span
                                        class="required">*</span></box-item>
                                <box-item :span="specsSpan" style="text-align: center">价格 <span
                                        class="required">*</span></box-item>
                                <box-item :span="specsSpan + specsOffset">操作</box-item>

                                <template v-for="(item, index) in formCreate.specs">
                                    <box-item v-for="(name, key) in model.specs" :key="`${index}-${key}`"
                                              :span="specsSpan" style="text-align: center">
                                        <FormItem :label-width="1" class="form-item" required
                                                  :prop="`specs.${index}.specs.${name}`"
                                                  :rules="{required:true, message: `规格[${name}]不能为空`, trigger: 'blur'}">
                                            <Input size="small" v-model="item.specs[name]"></Input>
                                        </FormItem>
                                    </box-item>
                                    <box-item :span="specsSpan" style="text-align: center">
                                        <FormItem :label-width="1" class="form-item" required
                                                  :prop="`specs.${index}.stock`"
                                                  :rules="{required:true, type: 'number', message: `库存不能为空`, trigger: 'blur'}">
                                            <Input size="small" v-model="item.stock" number
                                                   @input="stockChange"></Input>
                                        </FormItem>
                                    </box-item>
                                    <box-item :span="specsSpan" style="text-align: center">
                                        <FormItem :label-width="1" class="form-item" required
                                                  :prop="`specs.${index}.price`"
                                                  :rules="{required:true, type: 'number', message: `价格不能为空`, trigger: 'blur'}">
                                            <Input size="small" number v-model="item.price"></Input>
                                        </FormItem>
                                    </box-item>
                                    <box-item :span="specsSpan + specsOffset">
                                        <FormItem :label-width="10" class="form-item">
                                            <Button size="small" @click="handleRemove(index)">删除</Button>
                                        </FormItem>
                                    </box-item>
                                </template>

                                <box-item offset="1" span="6">
                                    <Button long type="dashed" size="small" @click="handleAdd" style="margin-top: 15px">
                                        添加规格
                                    </Button>
                                </box-item>
                            </box>
                        </Col>
                    </Row>
                </Col>

                <Col span="22" offset="1">
                    <FormItem :label-width="0" prop="content">
                        <ueditor v-model="formCreate.details.content"></ueditor>
                    </FormItem>
                </Col>
            </Row>
        </Form>
        <div slot="footer">
            <Button @click="createSubmit('formCreate', 'goods')">创建</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import Box from "../../../components/box/index";
    import BoxItem from "../../../components/box/box-item";
    import TrueOrFalse from "../../../components/select/true-or-false";
    import Base64 from "../../../components/upload/base64";
    import Images from "./components/images";
    import Ueditor from "../../../components/editor/ueditor";
    import {Validator} from "../../../async-validator/goods/goods/create";
    import GroupCascader from "../../../../../base/js/components/cascader/index";

    export default {
        name: "create",
        components: {GroupCascader, Ueditor, Images, Base64, TrueOrFalse, BoxItem, Box, ComponentModal},
        mixins: [component, form],
        data() {
            return {
                formCreate: {specs: [], attribute: {}, images: [], details: {}},
                ruleCreate: Validator(this),
                models: [],
                categories: [],
                model: {attributes: [], specs: []},
            }
        },
        mounted() {
            this.loading = true;
            this.$http.get(`goods/create`).then((res) => {
                this.models = res.data.data.models;
                this.categories = res.data.data.categories
            }).finally(() => {
                this.loading = false
            });
        },
        computed: {
            specsSpan() {
                return parseInt(24 / (this.model.specs.length + 3))
            },
            specsOffset() {
                return (24 % (this.model.specs.length + 3))
            }
        },
        methods: {
            modelChange(val) {
                let model = this.models.find((v) => v.id === val);
                if (model === undefined) {
                    this.model = {attributes: [], specs: []}
                    this.formCreate.attribute = {}
                } else {
                    this.model = model
                    model.attributes.forEach((item) => {
                        this.formCreate.attribute[item.name] = ''
                    })
                }
            },
            handleAdd() {
                this.formCreate.specs.push({
                    specs: {},
                    price: 0,
                    stock: 0
                })
            },
            handleRemove(index) {
                this.formCreate.specs.splice(index, 1);
            },
            stockChange() {
                this.formCreate.stock = 0;
                this.formCreate.specs.forEach((item) => {
                    this.formCreate.stock += item.stock || 0
                })
            }
        }
    }
</script>

<style scoped lang="less">
    .form-item {
        margin-bottom: 0px;
    }

    .base64-image {
        width: 145px;
        height: 145px;
        border: 1px dashed #dcdee2;
        border-radius: 3px;
    }

    .attributes {
        overflow-y: auto;
        height: 350px;
        .required {
            color: #ed4014;
        }
    }


</style>

<style lang="less">
    .base64-image {
        .ivu-form-item {
            height: 100%;
            .ivu-form-item-content {
                height: 100%;
            }
        }
    }
</style>