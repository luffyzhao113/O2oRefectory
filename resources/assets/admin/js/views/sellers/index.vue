<template>
    <my-lists v-model="data" :columns="columns" @change="search">
        <Card>
            <p slot="title">
                <span>搜索</span>
            </p>
            <Form ref="searchForm" :model="searchForm" :label-width="80" inline>
                <FormItem prop="name" label="用户名" :label-width="50">
                    <Input type="text" v-model="searchForm.name"></Input>
                </FormItem>
                <FormItem prop="status" label="状态" :label-width="40">
                    <true-or-false v-model="searchForm.status" true-value="开启" false-value="关闭"></true-or-false>
                </FormItem>
                <FormItem prop="verify" label="审核" :label-width="60">
                    <Select v-model="searchForm.verify" clearable style="width:150px">
                        <Option :value="0">未审核</Option>
                        <Option :value="1">通过</Option>
                        <Option :value="2">不通过</Option>
                    </Select>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="showComponent('Create')" type="warning">添加</Button>
                </FormItem>
            </Form>
        </Card>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>

<script>
  import MyLists from "../../components/layout/my-lists";
  import lists from "../../mixins/lists";
  import TrueOrFalse from "../../components/select/true-or-false";
  export default {
    components: {
      TrueOrFalse,
      MyLists},
    mixins: [lists],
    name: "index",
    data() {
      return {
        columns: [{
          title: '商店名称',
          key: 'name'
        }, {
          title: '状态',
          render: (h, {row}) => {
            return <span>{row.status ? '开启' : '关闭'}</span>
          }
        }, {
          title: '审核状态',
          render: (h, {row}) => {
            return <span>{row.verify ? '开启' : '关闭'}</span>
          }
        }, {
          title: '操作',
          render: (h, {row}) => {
            return (<div>
              <i-button size="small">修改</i-button>
              <i-button disabled={row.verify} size="small">审核</i-button>
            </div>);
          }
        }]
      }
    },
    methods: {
      search(page = 1){
        this.$http.get(`seller`, {params: this.request(page)}).then((res) => {
          this.assignmentData(res.data.data);
        }).catch((res) => {
          this.formatErrors(res)
        })
      }
    }
  }
</script>

<style scoped>

</style>