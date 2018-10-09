<template>
    <component-modal title="查看通知">
        <h3>{{componentProps.data.title}}</h3>
        {{componentProps.data.content}}
    </component-modal>
</template>

<script>
  import component from "../../../mixins/component";
  import ComponentModal from "../../../components/modal/component-modal";

  export default {
    components: {ComponentModal},
    name: "update",
    mixins: [component],
    mounted(){
      if(!this.componentProps.read_at) {
        this.$http.put(`message/${this.componentProps.id}`).then((res) => {
          this.$store.commit('decrement')
        })
      }
    }
  }
</script>

<style scoped>
h3{
    text-align: center;
    margin: 10px 0;
}
</style>