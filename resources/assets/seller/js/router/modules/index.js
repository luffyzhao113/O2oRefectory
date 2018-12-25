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
        path: 'role.role',
        name: 'role.role.index',
        meta: {title: '角色管理'},
        component: resolve => {
            require(['../../views/role/role/index.vue'], resolve)
        }
    },
    {
        path: 'role.admin',
        name: 'role.admin.index',
        meta: {title: '用户管理'},
        component: resolve => {
            require(['../../views/role/admin/index.vue'], resolve)
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
    }, {
        path: 'goods.recycle.index',
        name: 'goods.recycle.index',
        meta: {title: '回收站'},
        component: resolve => {
            require(['../../views/goods/recycle/index.vue'], resolve)
        }
    }, {
        path: 'sysconfig.banner',
        name: 'sysconfig.banner',
        meta: {title: '横幅设置'},
        component: resolve => {
            require(['../../views/sysconfig/banner/index.vue'], resolve)
        }
    }
]
