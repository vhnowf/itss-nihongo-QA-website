
import Vue from 'vue';
import Vuex from 'vuex'
Vue.use(Vuex)

import { http } from '@core/config/http';

const httpStore = new Vuex.Store({
    actions: {
        get({}, {url, data}) {
            return new Promise((resolve, reject) => {
                http.get(url, {
                    params: data
                }).then(function (response) {
                    let resData = response.data;
                    resolve(resData);
                }).catch(function (error) {
                    reject(error);
                });
            });
        },
        post({}, {url, data}) {
            return new Promise((resolve, reject) => {
                http({
                    method: 'POST',
                    url: url,
                    data: data
                }).then(function (response) {
                    let resData = response.data;
                    
                    resolve(resData);
                }).catch(function (error) {
                    reject(error);
                });
            });
        },
        put({}, {url, data}) {
            return new Promise((resolve, reject) => {
                http({
                    method: 'PUT',
                    url: url,
                    data: data
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

export default httpStore;
