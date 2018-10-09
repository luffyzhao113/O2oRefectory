<template>
    <Layout class="layout">
        <Header class="layout-header">
            <my-header></my-header>
        </Header>
        <Layout>
            <Sider hide-trigger>
                <my-menu></my-menu>
            </Sider>
            <Layout>
                <Content class="layout-content">
                    <my-router-scroll></my-router-scroll>
                    <div class="layout-content-main">
                        <router-view></router-view>
                    </div>
                </Content>
                <Footer class="layout-footer-center">2011-2016 © luffyzhao@vip.126.com</Footer>
            </Layout>
        </Layout>
    </Layout>
</template>

<script>
    import MyHeader from "../../components/layout/my-header";
    import MyRouterScroll from "../../components/layout/my-router-scroll";
    import MyMenu from "../../components/layout/my-menu";

    export default {
        components: {
            MyMenu,
            MyRouterScroll,
            MyHeader
        },
        name: "admin",
        mounted() {
            this.$nextTick(function () {
                this.$http.get(`auth`).then((res) => {
                    this.$store.commit('setAuthData', res.data.data.auth);
                    this.$store.commit('setAuthPerms', res.data.data.perms);
                    this.$store.commit('setMessageTotal', res.data.data.messageTotal)
                    this.$store.dispatch('getMessageNotReadTotal')
                })
            })
        }
    }
</script>

<style lang="less" scoped>
    .layout {
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        .layout-header{
            height: 50px;
            line-height: 50px;
            padding: 0px;
            background-color: #09C;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 2px 3px 2px
        }
        .layout-content{
            display: flex;
            flex-direction: column;
            .layout-content-main {
                padding: 15px;
                position: relative;
                flex: auto;
                -webkit-box-flex: 1;
                -ms-flex: auto;
                & > div {
                    position: absolute;
                    top: 15px;
                    left: 15px;
                    bottom: 15px;
                    right: 15px;
                    overflow-y: auto;
                    .ivu-card {
                        margin-bottom: 15px;
                    }
                }
            }
        }
        .layout-footer-center {
            text-align: center;
        }
    }
</style>