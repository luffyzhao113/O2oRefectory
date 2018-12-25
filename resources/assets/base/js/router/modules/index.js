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
        path: 'role.permission',
        name: 'role.permission.index',
        meta: {title: '权限&菜单'},
        component: resolve => {
            require(['../../views/role/permission/index.vue'], resolve)
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
    },
    {
        path: 'common.message',
        name: 'common.message',
        meta: {title: '消息管理'},
        component: resolve => {
            require(['../../views/common/message/messages.vue'], resolve)
        }
    },
    {
        path: 'admin.sellers',
        name: 'admin.sellers',
        meta: {title: '店铺列表'},
        component: resolve => {
            require(['../../views/sellers/home/index.vue'], resolve)
        }
    },
    {
        path: 'sellers.permission',
        name: 'sellers.permission',
        meta: {title: '商铺权限&菜单'},
        component: resolve => {
            require(['../../views/sellers/permission/index.vue'], resolve)
        }
    },
    {
        path: 'category.home',
        name: 'category.home',
        meta: {title: '类目列表'},
        component: resolve => {
            require(['../../views/category/home/index.vue'], resolve)
        }
    },
    {
        path: 'category.attribute',
        name: 'category.attribute',
        meta: {title: '类目属性'},
        component: resolve => {
            require(['../../views/category/attribute/index.vue'], resolve)
        }
    }
]
