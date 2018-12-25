<template>
    <i-drawer title="添加横幅" :loading="loading" :width="1200">
        <Form ref="formCreate" :model="formCreate" :label-width="100" :rules="ruleCreate">
            <Row>
                <Col span="20" >
                    <FormItem label="横幅名称" prop="name">
                        <Input v-model="formCreate.name" placeholder="横幅名称"></Input>
                    </FormItem>
                </Col>
            </Row>
            <Row>
                <Col span="12">
                    <FormItem label="横幅位置" prop="position">
                        <Input v-model="formCreate.position" placeholder="横幅位置"></Input>
                    </FormItem>
                </Col>
                <Col span="12">
                    <FormItem label="横幅状态" prop="status">
                        <true-or-false true-value="开启" false-value="关闭" v-model="formCreate.status"></true-or-false>
                    </FormItem>
                </Col>
            </Row>
            <Row v-for="(item, index) in formCreate.banners" :key="index">
                <Col span="9">
                    <FormItem :label="`图片 ${index+1}`" :prop="`banners.${index}.path`" :rules="[{required: true, type: 'string', message: '图片不能为空', trigger: 'change'}]">
                    <div class="banner-item">
                        <base64 v-model="item.path"></base64>
                    </div>
                    </FormItem>
                </Col>
                <Col span="10">
                    <FormItem label="图片标题" :prop="`banners.${index}.title`" :rules="[{required: true, type: 'string', message: '图片标题不能为空', trigger: 'blur'}]">
                        <Input v-model="item.title" placeholder="图片标题"></Input>
                    </FormItem>
                    <FormItem label="图片链接" :prop="`banners.${index}.link`" :rules="[{required: true, type: 'string', message: '图片链接不能为空', trigger: 'blur'}]">
                        <Input v-model="item.link" placeholder="图片链接"></Input>
                    </FormItem>
                </Col>
                <Col span="3" offset="1">
                    <ButtonGroup vertical class="banner-item">
                        <Button icon="ios-add-circle-outline" @click="handleAdd" size="small" v-if="index === 0">添加</Button>
                        <Button icon="ios-trash-outline" @click="handleRemove(index)" size="small" v-else>删除</Button>
                        <Button icon="ios-arrow-dropup" @click="handleTop(index)" size="small" v-if="index !== 0">上移</Button>
                        <Button icon="ios-arrow-dropdown" @click="handleBottom(index)" size="small" v-if="index !== formCreate.banners.length - 1">下移</Button>
                    </ButtonGroup>
                </Col>
            </Row>
        </Form>
        <div slot="footer">
            <Button style="margin-right: 8px" @click="change(false)">取消</Button>
            <Button type="primary" @click="createSubmit('formCreate', 'banner')">创建</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/modal/i-drawer";
    import component from "../../../mixins/component";
    import form from "../../../mixins/form";
    import Box from "../../../components/box/index";
    import BoxItem from "../../../components/box/box-item";
    import Base64 from "../../../../../base/js/components/upload/base64";
    import {Validator} from "../../../async-validator/sysconfig/banner/create";
    import TrueOrFalse from "../../../../../base/js/components/select/true-or-false";

    export default {
        name: "create",
        components: {TrueOrFalse, Base64, BoxItem, Box, IDrawer},
        mixins: [component, form],
        data() {
            return {
                formCreate: {
                    banners: [{}],
                    status: 0
                },
                ruleCreate: Validator(this)
            }
        },
        methods: {
            handleAdd(){
                this.formCreate.banners.push({})
            },
            handleRemove(index) {
                this.formCreate.banners.splice(index, 1);
            },
            handleTop(x) {
                let y = x - 1;
                if (y < 0) {
                    return false;
                }
                this.formCreate.banners.splice(x, 1, ...this.formCreate.banners.splice(y, 1, this.formCreate.banners[x]))
            },
            handleBottom(x) {
                let y = x + 1;
                if (this.formCreate.banners.length <= y) {
                    return false;
                }
                this.formCreate.banners.splice(y, 1, ...this.formCreate.banners.splice(x, 1, this.formCreate.banners[y]))
            },
        }
    }
</script>

<style lang="less">
    .banner-item{
        height: 94px;
        border-radius: 5px;
        padding: 10px;
        border: 1px dashed #dcdee2;
        line-height: 94px;
        cursor: pointer;
    }
</style>