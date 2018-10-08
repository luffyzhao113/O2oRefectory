<template>
    <Modal :title="title" v-model="show" :width="400"  :mask-closable="false" >
        <Row>
            <Col :span="20">
            <Form ref="reason" :model="reason" :label-width="80">
                <FormItem :label="label"  :rules="{required: true, message: '必须填写', trigger: 'blur'}" prop="remark">
                    <Input v-model="reason.remark" type="textarea" :autosize="{minRows: 5,maxRows: 5}"
                           placeholder="Enter something..."/>
                </FormItem>
            </Form>
            </Col>
        </Row>
        <div slot="footer">
            <Button type="primary" @click="submit('reason')" size="large">确定</Button>
        </div>
    </Modal>
</template>

<script>
  import http from "../../mixins/http";

  export default {
    name: "reason",
    mixins: [http],
    props: {
      title: {
        type: String,
        default: '标题'
      },
      value: {
        type: Boolean,
        default: false
      },
      label: {
        type: String,
        default: '说明'
      }
    },
    data(){
      return {
        reason: {}
      }
    },
    computed: {
      show: {
        get(){
          return this.value;
        },
        set(v){
          this.$emit('input', v);
        }
      }
    },
    methods: {
      submit(name){
        this.$refs[name].validate((valid) => {
          if(valid){
            this.$emit('on-submit', this.unObserver(this.$refs[name].model));
          }
        })
      }
    }
  }
</script>

<style scoped>

</style>