export default {
    props: {
      componentProps: {}
    },
    data(){
        return {
            loading: false,
        }
    },
    methods: {
      change(visible) {
            if (visible === false) {
                this.$emit('on-change')
            }
        }
    }
}