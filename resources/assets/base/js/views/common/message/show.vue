<template>
    <i-drawer title="查看通知">
        <h3>{{componentProps.data.title}}</h3>
        {{componentProps.data.content}}
    </i-drawer>
</template>

<script>
  import component from "../../../mixins/component";
  import IDrawer from "../../../components/modal/i-drawer";

  export default {
    components: {IDrawer},
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