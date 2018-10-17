<template>
    <component-modal title="添加商品" :loading="loading" :width="900">
        <Form ref="formCreate" :model="formCreate" :label-width="80" :rules="ruleCreate">
            <Row title="商品属性">
                <Col :span="17">
                    <FormItem label="商品名称">
                        <Input v-model="formCreate.name" placeholder="商品名称"></Input>
                    </FormItem>
                </Col>

                <Col :span="8">
                    <FormItem label="商品条码">
                        <Input v-model="formCreate.bar_code" number placeholder="商品条码"></Input>
                    </FormItem>
                </Col>

                <Col :span="8">
                    <FormItem label="商品价格">
                        <Input v-model="formCreate.price" number placeholder="商品价格"></Input>
                    </FormItem>
                </Col>

                <Col :span="8">
                    <FormItem label="商品库存">
                        <Input v-model="formCreate.stock" number placeholder="商品库存"></Input>
                    </FormItem>
                </Col>

                <Col :span="8">
                    <FormItem label="商品销量">
                        <Input v-model="formCreate.sale" number placeholder="商品销量"></Input>
                    </FormItem>
                </Col>

                <Col :span="8">
                    <FormItem label="上架状态">
                        <true-or-false v-model="formCreate.is_sale" false-value="下架"
                                       true-value="上架"></true-or-false>
                    </FormItem>
                </Col>

                <attribute></attribute>

            </Row>
        </Form>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import Box from "../../../components/box/index";
    import BoxItem from "../../../components/box/box-item";
    import TrueOrFalse from "../../../components/select/true-or-false";
    import Attribute from "./components/attribute";

    export default {
        name: "create",
        components: {Attribute, TrueOrFalse, BoxItem, Box, ComponentModal},
        mixins: [component, form],
        data() {
            return {
                formCreate: {},
                ruleCreate: {}
            }
        }
    }
</script>

<style scoped>

</style>