<template>
    <i-drawer title="修改店铺" :width="900">
        <Form ref="formUpdate" :model="formUpdate" :label-width="90" :rules="ruleUpdate">
            <Box title="基本信息">
                <box-item :span="8">
                    <FormItem label="店铺名称" prop="name" >
                        <Input v-model="formUpdate.name" placeholder="店铺名称"></Input>
                    </FormItem>
                </box-item>

                <box-item :span="8">
                    <FormItem label="店铺状态" prop="status" >
                        <true-or-false  v-model="formUpdate.status" true-value="开启" false-value="关闭"></true-or-false>
                    </FormItem>
                </box-item>

            </Box>

            <Box title="管理员">
                <box-item :span="8">
                    <FormItem label="登录账号" prop="admin.email">
                        <Input v-model="formUpdate.admin.email" placeholder="登录账号"></Input>
                    </FormItem>
                </box-item>

                <box-item :span="8">
                    <FormItem label="管理员姓名" prop="admin.name">
                        <Input v-model="formUpdate.admin.name" placeholder="管理员姓名"></Input>
                    </FormItem>
                </box-item>

                <box-item :span="8">
                    <FormItem label="登录密码" prop="admin.password">
                        <Input v-model="formUpdate.admin.password" type="password" placeholder="登录密码"></Input>
                    </FormItem>
                </box-item>

                <box-item :span="8">
                    <FormItem label="确认密码" prop="admin.password_confirmation">
                        <Input v-model="formUpdate.admin.password_confirmation" type="password" placeholder="确认密码"></Input>
                    </FormItem>
                </box-item>
            </Box>
        </Form>

        <div slot="footer">
            <Button @click="updateSubmit('formUpdate', `seller/${componentProps.id}`)">提交</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/modal/i-drawer";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import {Validator} from "../../../async-validator/sellers/home/update";
    import Box from "../../../components/box/index";
    import BoxItem from "../../../components/box/box-item";
    import TrueOrFalse from "../../../components/select/true-or-false";


    export default {
        name: "Update",
        components: {TrueOrFalse, BoxItem, Box, IDrawer},
        mixins: [component, form],
        data() {
            let $this = this;
            return {
                formUpdate: {
                    name: '',
                    admin: {}
                },
                ruleUpdate: Validator($this)
            }
        },
        mounted(){
            this.$nextTick(() => {
                this.$http.get(`seller/${this.componentProps.id}/edit`).then((res) => {
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