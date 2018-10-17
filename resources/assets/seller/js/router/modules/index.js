export const IndexRouter = [
    {
        path: 'home',
        name: 'common.home',
        meta: {title: '首页'},
        component: resolve => {
            require(['../../views/common/home.vue'], resolve)
        }
    },
    {
        path: 'profile',
        name: 'common.profile',
        meta: {title: '个人中心'},
        component: resolve => {
            require(['../../views/common/profile.vue'], resolve)
        }
    },
    {
        path: 'sysconfig.role',
        name: 'sysconfig.role.index',
        meta: {title: '角色管理'},
        component: resolve => {
            require(['../../views/sysconfig/role/index.vue'], resolve)
        }
    },
    {
        path: 'sysconfig.admin',
        name: 'sysconfig.admin.index',
        meta: {title: '用户管理'},
        component: resolve => {
            require(['../../views/sysconfig/admin/index.vue'], resolve)
        }
    }, {
        path: 'goods.model',
        name: 'goods.model',
        meta: {title: '商品属性'},
        component: resolve => {
            require(['../../views/goods/model/index.vue'], resolve)
        }
    }, {
        path: 'goods.goods',
        name: 'goods.goods',
        meta: {title: '商品列表'},
        component: resolve => {
            require(['../../views/goods/goods/index.vue'], resolve)
        }
    }
]
