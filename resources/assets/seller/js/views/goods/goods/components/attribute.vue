<template>
    <Col :span="18" :offset="2">
        <box>
            <div slot="title" class="head">
                <span class="title">商品属性</span>
            </div>
            <box-item :span="6">
                <FormItem v-for="(item, index) in lists" :key="index" class="form-item" :label-width="1">
                    <Input v-model="item.value" size="small" >
                        <Input slot="prepend" size="small" v-model="item.name"> </Input>
                        <Button slot="append" icon="md-close" size="small" ></Button>
                    </Input>
                </FormItem>
            </box-item>
            <box-item :span="6">
                <Button class="add" size="small" @click="addItem">添加属性</Button>
            </box-item>
        </box>

    </Col>
</template>

<script>
    import Box from "../../../../components/box/index";
    import BoxItem from "../../../../components/box/box-item";

    export default {
        name: "attribute",
        components: {BoxItem, Box},
        data() {
            return {
                lists: [],
                formCreate: {}
            }
        },
        methods: {
            addItem() {
                this.lists.push({
                    name: '',
                    value: ''
                })
            }
        }
    }
</script>

<style scoped lang="less">
    .form-item {
        margin-bottom: 5px;
    }
</style>