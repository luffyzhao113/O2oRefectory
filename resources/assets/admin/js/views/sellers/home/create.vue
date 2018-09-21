<template>
    <component-modal title="添加店铺" :loading="loading" :width="750">
        <Form ref="formCreate" :model="formCreate" :label-width="80" :rules="ruleCreate">
            <Box title="基本信息">
                <box-item :span="8">
                    <FormItem label="店铺名称" prop="name" >
                        <Input v-model="formCreate.name" placeholder="店铺名称"></Input>
                    </FormItem>
                </box-item>

                <box-item :span="8">
                    <FormItem label="二级域名" prop="domain" >
                        <Input v-model="formCreate.domain" placeholder="二级域名"></Input>
                    </FormItem>
                </box-item>
            </Box>
        </Form>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import lists from "../../../mixins/lists";
    import {Validator} from "../../../async-validator/sellers/home/create";
    import Box from "../../../components/box/index";
    import BoxItem from "../../../components/box/box-item";
    export default {
        name: "create",
        components: {BoxItem, Box, ComponentModal},
        mixins: [lists],
        data() {
            let $this = this
            return {
                formCreate: {
                    name: ''
                },
                ruleCreate: Validator($this)
            }
        }
    }
</script>

<style scoped>

</style>