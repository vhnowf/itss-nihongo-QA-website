
import Vue from 'vue';
import Vuex from 'vuex'
Vue.use(Vuex)

import { auth } from "./auth";

const store = new Vuex.Store({
    modules: {
        auth
    },
    state: {
        globalData: {
            setting: {}
        },
    },
    getters: {
    },
    mutations: {
        setGlobalData (state, data) {
            state.globalData = data;
        }
    },
    actions: {}
})

export default store;
