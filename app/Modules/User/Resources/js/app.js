/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
import store from './stores';
require('@core/config/lazyload');
require('./config/mixin');

import VueLoading from 'vuejs-loading-plugin';
Vue.use(VueLoading);
import VueI18n from 'vue-i18n';
import messages from '../locales/i18n';

Vue.use(VueI18n);

const i18n = new VueI18n({
    locale: 'vi',
	fallbackLocale: 'vi',
    messages,
});


Vue.component('SetGlobalData', require('./components/layouts/SetGlobalData.vue').default);
Vue.component('LHeader', require('./components/layouts/LHeader.vue').default);
Vue.component('home-page', require('./views/HomePage.vue').default);
Vue.component('pagination', require('./components/Pagination.vue').default);
Vue.component('ask-question', require('./views/AskQuestion.vue').default);
Vue.component('question-detail', require('./views/QuestionDetail.vue').default);
const app = new Vue({
	i18n,
	el: '#app',
	store
});
