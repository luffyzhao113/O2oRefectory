import Vue from 'vue'
import Vuex from 'vuex'

import App from './modules/layout'
import Auth from './modules/auth'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        App,
        Auth
    }
})

export default store
