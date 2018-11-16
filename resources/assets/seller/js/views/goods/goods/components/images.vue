<template>
    <div class="images">
        <div class="box-image">
            <img :src="bigFirstImage"/>
        </div>
        <div class="list-image scrollbar">
            <div class="item" v-for="(item, index) in images" :key="index">
                <div class="base64">
                    <div class="input">
                        <input type="file" :id="uuid + ':' + index" @change="fileChange" :data-id="index"/>
                    </div>
                    <label class="photo" :for="uuid + ':' + index">
                        <template>
                            <img v-if="item.path" :src="item.path" />
                            <img v-else src="/images/seller/default.png" />
                        </template>
                    </label>
                </div>
                <div class="op" v-if="item.path">
                    <a @click="handleTop(index)" v-if="index !== 0">上移</a>
                    <a @click="handleBottom(index)" v-if="index !== images.length - 1">下移</a>
                    <a @click="handleRemove(index)">删除</a>
                </div>
            </div>
            <div class="item">
                <div class="base64">
                    <div class="input">
                        <input type="file" :id="uuid" @change="fileChange" multiple="multiple"/>
                    </div>
                    <label class="photo" :for="uuid">
                        <Icon type="md-add-circle" size="48"/>
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Base64 from "../../../../components/upload/base64";
    import uuid from "../../../../mixins/uuid";
    import Emitter from 'iview/src/mixins/emitter'

    export default {
        name: "images",
        components: {Base64},
        mixins: [uuid, Emitter],
        props:{
            value: {
                type: Array,
                default: () => []
            }
        },
        data() {
            return {
                images: this.value,
                index: 0
            }
        },
        computed: {
            bigFirstImage() {
                return this.images.length > 0 ? this.images[this.index].path : '/images/seller/default.png';
            }
        },
        methods: {
            handleAdd() {
                this.images.push({path: ''})
            },
            handleRemove(index) {
                this.images.splice(index, 1);
            },
            handleTop(x) {
                let y = x - 1;
                if (y < 0) {
                    return false;
                }
                this.images.splice(x, 1, ...this.images.splice(y, 1, this.images[x]))
            },
            handleBottom(x) {
                let y = x + 1;
                if (this.images.length <= y) {
                    return false;
                }
                this.images.splice(y, 1, ...this.images.splice(x, 1, this.images[y]))
            },
            fileChange({target}) {
                for (let i = 0; i<target.files.length; i++){
                    let file = target.files[i];
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
                    reader.onload = (tar) => {
                        if(target.dataset.id !== undefined){
                            this.images.splice(Number(target.dataset.id), 1, {
                                path:tar.target.result
                            });
                        }else{
                            this.images.push({
                                path:tar.target.result
                            });
                        }
                        this.$emit('input', this.images)
                        this.dispatch('FormItem', 'on-form-change', this.images);
                    }
                    reader.onerror = () => {
                        this.$Message.error({
                            content: '图片上传失败！'
                        });
                    }
                }
            }
        },
        watch:{
            value(val, old){
                if(val !== old){
                    this.images = val
                }
            }
        }
    }
</script>

<style scoped lang="less">
    .images {
        height: 350px;
        color: #ccc;
        .box-image {
            width: 350px;
            height: 350px;
            border: 1px dashed #dcdee2;
            float: left;
            position: relative;
            img {
                max-width: 90%;
                max-height: 90%;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                border-radius: 5px;
            }
        }
        .list-image {
            float: left;
            width: 120px;
            border: 1px dashed #dcdee2;
            border-left: none;
            height: 350px;
            overflow-y: auto;
            border-bottom-right-radius: 5px;
            border-top-right-radius: 5px;
            box-sizing: border-box;
            padding: 10px 0;
            .item {
                height: 90px;
                width: 90px;
                padding: 20px;
                box-sizing: border-box;
                margin-left: 15px;
                color: #ccc;
                border: 1px dashed #dcdee2;
                position: relative;
                margin-bottom: 5px;
                .op {
                    position: absolute;
                    left: 0px;
                    bottom: -6px;
                    text-align: center;
                    width: 100%;
                }
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
                        text-align: center;
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
            }
        }
    }
</style>