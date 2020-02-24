import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueTreeList from 'vue-tree-list';
import Vuetable from 'vuetable-2';
import App from './App.vue';
import Dashboard from './components/Dashboard.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import List from './components/employees_table/List.vue';
import FilterBar from './components/employees_table/FilterBar';
import VueEvents from 'vue-events';
import EmployeeUpdate from './components/employee/EmployeeUpdate';
import EmployeeCreate from './components/employee/EmployeeCreate';


Vue.use(VueRouter);
Vue.use(VueAxios, axios);
axios.defaults.baseURL = 'http://localhost:8000/api';
const router = new VueRouter({
    routes: [{
        path: '/',
        name: 'home',
        component: Home
    },{
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },{
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },{
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    },{
        path: '/list',
        name: 'list',
        component: List,
        meta: {
            auth: true
        }
    },{
        path: '/employee/:employeeId/edit',
        name: 'employeeUpdate',
        component: EmployeeUpdate,
        meta: {
            auth: true
        }
    },{
        path: '/employee/create',
        name: 'employeeCreate',
        component: EmployeeCreate,
        meta: {
            auth: true
        }
    }]
});
Vue.router = router
Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});
Vue.use(VueTreeList); // tree 3rd party component
Vue.use(Vuetable); // table 3rd party component
Vue.use(VueEvents);
Vue.component('filter-bar', FilterBar)
App.router = Vue.router
new Vue(App).$mount('#app');