<template>
    <component-modal title="查看店铺" :width="750">
        <box title="店铺详情">
            <detail title="店铺名称">{{seller.name}}</detail>
            <detail title="商家姓名"><span v-if="seller.certificates">{{seller.certificates.name}}</span></detail>
        </box>
    </component-modal>
</template>

<script>
  import ComponentModal from "../../../components/modal/component-modal";
  import component from "../../../mixins/component";
  import http from "../../../mixins/http";
  import Box from "../../../components/box/index";
  import Detail from "../../../components/detail/index";
  import Reason from "../../../components/reason/index";
  export default {
    name: "show",
    components: {
      Reason,
      Detail,
      Box,
      ComponentModal},
    mixins: [component, http],
    data(){
      return {
        auditingModal: false,
        seller: {},
        columns: [
          {
            title: '序号',
            render: (h, {index}) => {
              return <span>{++index}</span>
            },
            width: 75
          },
          {
            title: '操作内容',
            key: 'remark'
          },
          {
            title: '时间',
            key: 'created_at'
          }
        ]
      }
    },
    mounted(){
      this.$nextTick(() => {
        this.$http.get(`seller/auditing/${this.data.id}`).then((res) => {
          this.seller = res.data.data
        }).catch((err) => {
          this.formatErrors(err)
        })
      })
    }
  }
</script>

<style scoped>
    .tr{
        text-align: right;
    }
</style>