import Lazyload from 'vue-lazyload';
Vue.use(Lazyload, {
	preLoad: 1.3,
	error: '/images/404.png',
	loading: '/images/loading.gif',
	attempt: 1,
	listenEvents: [ 'scroll' ]
});
