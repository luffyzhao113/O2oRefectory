<template>
    <my-lists  v-model="data" :columns="columns" @change="search">
        <Card>
            <p slot="title">
                <span>搜索</span>
            </p>
            <Form ref="searchForm" :model="searchForm" :label-width="80" inline>
                <FormItem prop="name" label="店铺名称">
                    <seller-select :auditing="0"></seller-select>
                </FormItem>
                <FormItem prop="auditing_status" label="审核状态">
                    <Select v-model="searchForm.auditing_status" clearable  style="width:150px">
                        <Option :value="0">待审核</Option>
                        <Option :value="2">审核不通过</Option>
                    </Select>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                </FormItem>
            </Form>
        </Card>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>

<script>

  import MyLists from "../../../components/layout/my-lists";
  import lists from "../../../mixins/lists";
  import TrueOrFalse from "../../../components/select/true-or-false";
  import Show from "./show"
  import Auditing from "./auditing"
  import SellerSelect from "../../components/seller/select";

  export default {
    components: {
      SellerSelect,
      MyLists, TrueOrFalse, Show, Auditing},
    name: "index",
    mixins: [lists],
    data() {
      return {
        columns: [{
          title: '商店名称',
          key: 'name'
        },{
          title: '审核状态',
          render: (h, {row}) => {
            switch (row.auditing_status){
              case 0:
                return (<span>待审核</span>)
                break;
              case 1:
                return (<span>已审核</span>)
                break;
              case 2:
                return (<span>审核不通过</span>)
                break;
            }
          }
        }, {
          title: '操作',
          render: (h, {row}) => {
            return (<div>
              <i-button v-show={row.auditing_status === 0} size="small" on-click={() => {this.showComponent('Auditing', row)}}>审核</i-button>
              <i-button v-show={row.auditing_status === 2} size="small" on-click={() => {this.showComponent('Show', row)}}>查看</i-button>
            </div>);
          }
        }]
      }
    },
    methods: {
      search(page = 1){
        this.$http.get(`seller/auditing`, {params: this.request(page)}).then((res) => {
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