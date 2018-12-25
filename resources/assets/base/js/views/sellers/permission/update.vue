<template>
    <i-drawer title="修改权限" :loading="loading">
        <Form ref="formUpdate" :model="formUpdate" :label-width="80">
            <FormItem label="权限标识" prop="name" :rules="{required: true, message: '权限标识不能为空，并且格式为 a-z.a-z ！', pattern:
             /[a-z]+(\.[a-z]+)?/}">
                <Input v-model="formUpdate.name" placeholder="标识"></Input>
            </FormItem>
            <FormItem label="权限名称" prop="display_name" :rules="{required: true, message: '权限名称不能为空'}">
                <Input v-model="formUpdate.display_name" placeholder="权限名称"></Input>
            </FormItem>
            <FormItem label="上级菜单" prop="parent_id">
                <group-cascader v-model="formUpdate.parent_id" placeholder="顶级菜单可不选择" :data="parents"></group-cascader>
            </FormItem>
            <FormItem label="排序" prop="sort" >
                <Input v-model="formUpdate.sort" placeholder="排序" :rules="{required: true, message: '排序不能为空'}"></Input>
            </FormItem>
            <FormItem label="菜单图标" prop="icon">
                <Input v-model="formUpdate.icon" placeholder="菜单图标"></Input>
            </FormItem>
            <FormItem label="是否菜单" prop="islink">
                <RadioGroup v-model="formUpdate.islink" type="button">
                    <Radio :label="1" :value="1">菜单</Radio>
                    <Radio :label="0" :value="0">权限</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="菜单描述" prop="description" :rules="{max: 200}">
                <Input v-model="formUpdate.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="菜单描述"></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button @click="updateSubmit('formUpdate', `seller_perms/${componentProps.id}`)">更新</Button>
        </div>
    </i-drawer>
</template>

<script>
  import component from "../../../mixins/component";

  import form from "../../../mixins/form";
  import IDrawer from "../../../components/modal/i-drawer";
  import GroupCascader from "../../../components/cascader/index";

  export default {
    components: {GroupCascader, IDrawer},
    name: "update",
    mixins:[component, form],
    data(){
      return {
        formUpdate: {
          islink: 0,
          name: '',
          parent_id: 0,
          icon: '',
          display_name: '',
          description: '',
          sort: 1
        },
        parents: []
      }
    },
    mounted(){
      this.$http.get(`seller_perms/${this.componentProps.id}/edit`).then((res) => {
        this.formUpdate = Object.assign({}, this.formUpdate, res.data.data.row)
        this.parents = res.data.data.parents
      }).catch((err) => {
        this.formatErrors(err)
      })
    }
  }
</script>

<style scoped>

</style>