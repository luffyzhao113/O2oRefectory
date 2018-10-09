<template>
    <div class="base64">
        <label class="photo" :for="uuid">
            <template>
                <img :src="publicValue">
            </template>
        </label>
        <div class="input">
            <input type="file" :id="uuid" @change="change"></input>
        </div>
    </div>
</template>

<script>
    import uuid from "../../mixins/uuid";

    export default {
        name: "base64",
        mixins: [uuid],
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
        .photo {
            height: 100%;
            width: 100%;
            img{
                max-width: 100%;
                max-height: 100%;
            }
        }
        .input{
            width: 0;
            height: 0;
            input[type="file"] {
                opacity: 0;
                width: 0;
                height: 0;
            }
        }
    }
</style>