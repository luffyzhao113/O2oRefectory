<template>
    <component-modal title="修改店铺" :width="780">
        <Form ref="formUpdate" :model="formUpdate" :label-width="80" :rules="ruleUpdate">
            <Box title="基本信息">
                <box-item :span="8">
                    <FormItem label="店铺名称" prop="name" >
                        <Input v-model="formUpdate.name" placeholder="店铺名称"></Input>
                    </FormItem>
                </box-item>

                <box-item :span="8">
                    <FormItem label="二级域名" prop="domain" >
                        <Input v-model="formUpdate.domain" placeholder="二级域名"></Input>
                    </FormItem>
                </box-item>

                <box-item :span="8">
                    <FormItem label="店铺状态" prop="status" >
                        <true-or-false  v-model="formUpdate.status" true-value="开启" false-value="关闭"></true-or-false>
                    </FormItem>
                </box-item>

            </Box>
        </Form>

        <div slot="footer">
            <Button @click="updateSubmit('formUpdate', `seller/${componentProps.id}`)">提交</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import {Validator} from "../../../async-validator/sellers/home/update";
    import Box from "../../../components/box/index";
    import BoxItem from "../../../components/box/box-item";
    import TrueOrFalse from "../../../components/select/true-or-false";


    export default {
        name: "Update",
        components: {TrueOrFalse, BoxItem, Box, ComponentModal},
        mixins: [component, form],
        data() {
            let $this = this;
            return {
                formUpdate: {
                    name: ''
                },
                ruleUpdate: Validator($this)
            }
        },
        mounted(){
            this.$nextTick(() => {
                this.$http.get(`seller/${this.componentProps.id}`).then((res) => {
                    this.formUpdate = Object.assign(this.unObserver(this.formUpdate), res.data.data)
                }).catch((err) => {
                    this.formatErrors(err)
                })
            })
        }
    }
</script>

<style scoped>

</style>