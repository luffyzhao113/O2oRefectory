<template>
    <div class="base64">
        <div class="input">
            <input type="file" :id="uuid" @change="change"></input>
        </div>
        <label class="photo" :for="uuid">
            <template>
                <img v-if="publicValue" :src="publicValue" />
                <img v-else src="/images/seller/default.png" />
            </template>
        </label>
    </div>
</template>

<script>
    import uuid from "../../mixins/uuid";
    import Emitter from 'iview/src/mixins/emitter'

    export default {
        name: "base64",
        mixins: [uuid, Emitter],
        props: {
            value: {
                type: String,
                default: ''
            }
        },
        data() {
            return {
                publicValue: this.value
            }
        },
        methods: {
            change({target}) {
                let file = target.files[0];
                if(file === undefined){
                    return false;
                }
                if (!/image\/\w+/.test(file.type)) {
                    this.$Message.error({
                        content: '请确保文件为图像类型'
                    });
                    return false;
                }
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = ({target}) => {
                    this.$emit('input',target.result)
                    this.$emit('on-change',target.result)
                    this.dispatch('FormItem', 'on-form-change', target.result);
                }
                reader.onerror = () => {
                    this.$Message.error({
                        content: '图片上传失败！'
                    });
                }
            }
        },
        watch:{
            value(val){
                this.publicValue = val
            }
        }
    }
</script>

<style scoped lang="less">
    .base64 {
        display: block;
        overflow: hidden;
        height: 100%;
        width: 100%;
        line-height: normal;
        position: relative;
        .photo {
            cursor: pointer;
            height: 100%;
            width: 100%;
            vertical-align: middle;
            display: inline-block;
            position: relative;
            img{
                max-width: 100%;
                max-height: 100%;
                display: block;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        }
        .input{
            width: 0;
            height: 0;
            position: absolute;
            input[type="file"] {
                opacity: 0;
                width: 0;
                height: 0;
            }
        }
    }
</style>