<template>
    <i-drawer title="修改角色" :loading="loading" :width="700">
        <Form ref="formUpdate" :model="formUpdate" :label-width="80">
            <box title="角色管理">
                <FormItem label="角色名称" prop="name" :rules="{required: true, message: '角色名称不能为空'}">
                    <Input v-model="formUpdate.name" placeholder="角色名称"></Input>
                </FormItem>
                <FormItem label="是否开启" prop="status">
                    <RadioGroup v-model="formUpdate.status" type="button">
                        <Radio :label="1" :value="1">开启</Radio>
                        <Radio :label="0" :value="0">关闭</Radio>
                    </RadioGroup>
                </FormItem>
                <FormItem label="角色描述" prop="description">
                    <Input v-model="formUpdate.description" type="textarea" placeholder="角色描述"></Input>
                </FormItem>
            </box>

            <box title="权限管理">
                <tree :data="treePermissions" show-checkbox></tree>
            </box>
        </Form>
        <div slot="footer">
            <Button @click="updateSubmit('formUpdate', `role/${data.id}`)">更新</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/modal/i-drawer";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import Box from "../../../../../base/js/components/box/index";
    import tools from "../../../mixins/tools";

    export default {
        name: "update",
        components: {Box, IDrawer},
        mixins: [form, component, tools],
        data() {
            return {
                formUpdate: {
                    name: '',
                    status: 1,
                    description: ''
                },
               permissions: []
            }
        },
        computed: {
            treePermissions() {
                let data = [];
                JSON.parse(JSON.stringify(this.permissions)).forEach((item) => {
                    data.push({
                        id: item.id,
                        parent_id: item.parent_id,
                        title: item.title,
                        expand: true,
                        indeterminate: this.indeterminate(item),
                        checked: this.checked(item)
                    })
                });
                return this.toTree(data)
            },
            checkedPermissions() {
                return this.toChecked(JSON.parse(JSON.stringify(this.treePermissions)))
            }
        },
        mounted() {
            this.loading = true
            this.$http.get(`role/${this.data.id}/edit`).then((res) => {
                this.formUpdate = res.data.data.row
                this.permissions = res.data.data.permissions
            }).catch((err) => {
                this.formatErrors(err)
            }).finally(() => {
                this.loading = false
            })
        },
        methods:{
            updateSubmit(name, url){
                this.$refs[name].validate((valid) => {
                    if (valid) {
                        this.loading = true
                        let  data = Object.assign({} , this._data[name], {
                            permissions: this.checkedPermissions
                        });

                        this.$http.put(url, data).then((res) => {
                            this.$Message.success('Success!');
                            this.change(false)
                        }).catch((res) => {
                            this.formatErrors(res)
                        }).finally(() => {
                            this.loading = false
                        })
                    } else {
                        this.$Message.error('验证不通过!');
                    }
                })
            },
            child(parent) {
                return this.permissions.filter(val => val.parent_id == parent)
            },
            indeterminate(item) {
                let hasChild = this.child(item.id).length > 0
                if (!hasChild) {
                    return false
                }
                let has = typeof this.formUpdate.perms.find(val => val.id === item.id) !== 'undefined'
                if (has) {
                    return true
                }
                return false;
            },
            checked(item) {
                let hasChild = this.child(item.id).length > 0
                if (hasChild) {
                    return false
                }
                let has = typeof this.formUpdate.perms.find(val => val.id === item.id) !== 'undefined'
                if (has) {
                    return true
                }
                return false;
            },
            toChecked(data) {
                let arr = [];
                data.forEach((item) => {
                    if(item.indeterminate === true || item.checked === true ){
                        arr.push(item.id)
                        if (item.children && item.children.length > 0) {
                            arr = arr.concat(this.toChecked(item.children));
                        }
                    }

                });
                return arr
            }
        }
    }
</script>

<style scoped>

</style>