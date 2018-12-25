<template>
    <i-drawer title="更新用户" :loading="loading">
        <Form ref="formUpdate" :model="formUpdate" :label-width="80" :rules="ruleUpdate">
            <FormItem label="用户姓名" prop="name">
                <Input v-model="formUpdate.name" placeholder="用户邮箱"></Input>
            </FormItem>
            <FormItem label="用户邮箱" prop="email">
                <Input v-model="formUpdate.email" placeholder="用户邮箱"></Input>
            </FormItem>
            <FormItem label="用户角色" prop="role_id">
                <i-select v-model="formUpdate.role_id">
                    <i-option v-for="(item, index) in roles" :key="index" :value="item.id"
                              :label="item.name"></i-option>
                </i-select>
            </FormItem>
            <FormItem label="用户密码" prop="password">
                <Input v-model="formUpdate.password" placeholder="用户密码"/>
            </FormItem>
            <FormItem label="确认密码" prop="password_confirmation">
                <Input v-model="formUpdate.password_confirmation" placeholder="确认密码"/>
            </FormItem>
            <FormItem label="是否开启" prop="status">
                <RadioGroup v-model="formUpdate.status" type="button">
                    <Radio :label="1" :value="1">开启</Radio>
                    <Radio :label="0" :value="0">关闭</Radio>
                </RadioGroup>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button @click="updateSubmit('formUpdate', `admin/${componentProps.id}`)">修改</Button>
        </div>
    </i-drawer>
</template>

<script>
    import {Validator} from "../../../async-validator/sysconfig/admin/update"
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import IDrawer from "../../../components/modal/i-drawer";

    export default {
        name: "update",
        components: {
            IDrawer
        },
        mixins: [component, form],
        data() {
            return {
                formUpdate: {
                    name: '',
                    password: '',
                    password_confirmation: '',
                    status: 1,
                    role_id: '',
                    email: ''
                },
                ruleUpdate: Validator(this),
                roles: []
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.$http.get(`admin/${this.componentProps.id}/edit`).then((res) => {
                    this.formUpdate = Object.assign({}, this.formUpdate, res.data.data.row)
                    this.roles = res.data.data.roles
                }).catch((err) => {
                    this.formatErrors(err)
                })
            })
        }
    }
</script>

<style scoped>

</style>