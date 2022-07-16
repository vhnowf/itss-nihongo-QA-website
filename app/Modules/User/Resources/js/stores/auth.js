import { http } from '@core/config/http'; 

export const auth = {
    // namespaced: true,
    state: {
        user: {}
    },
    mutations: {
        setAuthUser (state, authUser) {
            state.user = authUser;
        }
    },
    actions: {
        login({ commit }, data) {
            return new Promise((resolve, reject) => {
                http.post('login', data).then(response => {
                    let resData = response.data;

                    if(resData.status == 200) {
                        commit('setAuthUser', resData.data.user);
                    }
                    resolve(resData);

                }).catch(err => {
                    reject(err);
                })
            })
        },
        forgotPassword({ commit }, data) {
            return new Promise((resolve, reject) => {
                http.post('forgot-password', data).then(response => {
                    let resData = response.data;
                    resolve(resData);
                }).catch(err => {
                    reject(err);
                });
            });
        },
        register({ commit }, data) {
            return new Promise((resolve, reject) => {
                http.post('register', data).then(response => {
                    let resData = response.data;

                    if(resData.status == 200) {
                        commit('setAuthUser', resData.data);
                    }
 
                    resolve(resData);
                }).catch(err => {
                    reject(err);
                });
            });
        }
    },
    getters: {
        isLoggedIn: state => !!state.user.id,
    }
}
