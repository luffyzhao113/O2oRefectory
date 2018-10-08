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
    },
]
