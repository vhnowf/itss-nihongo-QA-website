import Vue from 'vue';
import Vuex from 'vuex'
Vue.use(Vuex)
import { http } from '@core/config/http';

const storeProduct = new Vuex.Store({
    state: {
    },
    mutations: {
    },
    actions: {
        search({ commit }, params) {
            return new Promise((resolve, reject) => {
                http.get('/products/search', {
                    params: params
                }).then(function (response) {
                    let resData = response.data;

                    resolve(resData);
                }).catch(function (error) {
                    reject(error);
                });
            });
        },
    }
})

export default storeProduct;
