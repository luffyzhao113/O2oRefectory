<template>
    <Select
            v-model="model"
            filterable
            clearable
            remote
            :remote-method="remoteMethod"
            :loading="loading" style="width:150px">
        <Option v-for="(option, index) in options" :value="option.id" :key="index">{{option.name}}</Option>
    </Select>
</template>

<script>
  import http from "../../../mixins/http";

  export default {
    name: "seller-select",
    mixins: [http],
    props: {
      value: {},
      auditing: {
        type: Number,
        default: null
      },
      status: {
        type: Number,
        default: null
      },
    },
    data(){
      return {
        options: []
      }
    },
    computed: {
      model: {
        get(){
          return this.value;
        },
        set(v){
          this.$emit('input', v)
        }
      }
    },
    methods: {
      remoteMethod(query){
        if(query !== ''){
          this.loading = true;
          this.$http.get(`seller/select`, {params: {
            "name": query,
              "auditing_status": this.auditing,
              "status": this.status
          }}).then(({data}) => {
            this.options = data.data.data;
          }).finally(() => {
              this.loading = false
          });
        }
      }
    }
  }
</script>

<style scoped>

</style>