// //import bootstrap from 'bootstrap'
require('./bootstrap');
import * as uiv from 'uiv'
import router from './routes'
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(uiv);
axios.defaults.baseURL = location.protocol + '//' + location.hostname + location.port + '/api';
Vue.router = router
Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});
App.router = Vue.router
new Vue(App).$mount('#app');
