<template>
    <my-lists  v-model="data" :columns="columns" @change="search">
        <Card>
            <p slot="title">
                <span>搜索</span>
            </p>
            <Form ref="searchForm" :model="searchForm" :label-width="80" inline>
                <FormItem prop="name" label="店铺名称">
                    <seller-select></seller-select>
                </FormItem>
                <FormItem prop="status" label="资料状态">
                    <Select v-model="searchForm.status" clearable  style="width:150px">
                        <Option :value="0">不通过</Option>
                        <Option :value="1">通过</Option>
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
            title: '店铺名称',
            render: (h, {row}) => {
                return <span>{row.seller.name}</span>
            }
        },{
          title: '店铺法人',
          key: 'name'
        },{
          title: '资料状态',
          render: (h, {row}) => {
            switch (row.status){
              case 0:
                return (<span>不通过</span>)
                break;
              case 1:
                return (<span>通过</span>)
                break;
            }
          }
        }, {
          title: '操作',
          render: (h, {row}) => {
            return (<div>
              <i-button v-show={row.status === 0} size="small" on-click={() => {this.showComponent('Auditing', row)}}>审核</i-button>
              <i-button v-show={row.status === 2} size="small" on-click={() => {this.showComponent('Show', row)}}>查看</i-button>
            </div>);
          }
        }]
      }
    },
    methods: {
      search(page = 1){
        this.$http.get(`seller/materials`, {params: this.request(page)}).then((res) => {
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