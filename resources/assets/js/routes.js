import VueRouter from 'vue-router'
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Dashboard from './components/Dashboard.vue';

let routes = [
    {
        path: '/',
        component: Home,
        name: 'home'
    },
    {
        path: '/register',
        component: Register,
        name: 'register',
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta: {
            auth: false
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    }
];

export default new VueRouter({
    routes
});