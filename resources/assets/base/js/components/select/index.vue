<template>
    <Select
            v-model="publicValue"
            :filterable="filterable"
            :loading="loading"
            :remote="remote"
            :multiple="multiple"
            :remote-method="remoteMethod"
            clearable
            @on-change="onChange"
    >
        <Option v-for="(option, index) in publicOptions" :value="option.id" :key="index">{{option.name}}</Option>
    </Select>
</template>

<script>
    import http from "../../mixins/http";

    export default {
        name: "m-select",
        mixins: [http],
        props: {
            value: {
                type: [Number, String],
                default: '',
            },
            options: {
                type: Array,
                default: () => []
            },
            multiple: {
                type: Boolean,
                default: false
            },
            remoteUrl: {
                type: String,
                default: ''
            },
            filterable: {
                type: Boolean,
                default: false
            },
            params: {
                type: Object,
                default: () => {}
            },
            remoteKey: {
                type: String,
                default: 'title'
            }
        },
        data() {
            return {
                publicValue: this.value,
                publicOptions: this.options
            }
        },
        computed: {
            remote() {
                return this.remoteUrl !== ''
            }
        },
        methods: {
            remoteMethod(query) {
                if (query === '' && this.remote) {
                    this.publicOptions = [];
                }else{
                    this.$http.get(this.remoteUrl, {
                        params: this.getParams(query)
                    }).then((res) => {
                        this.publicOptions = res.data.data
                    })
                }
            },
            getParams(query){
                let data = {}
                data[this.remoteKey] = query
                return Object.assign({}, data, this.params)
            },
            onChange(val){
                this.$emit('input', val)
                this.$emit('on-change', val)
            }
        },
        watch: {
            value(val) {
                this.publicValue = val
            },
            options(val) {
                this.publicOptions = val
            }
        }
    }
</script>

<style scoped>

</style>