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
  }
]
