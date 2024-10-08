
require('./bootstrap');

window.Vue = require('vue');

// Vue Route Support
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Vuex Support
import Vuex from 'vuex'
Vue.use(Vuex)

//Google Charts Support
import VueGoogleCharts from 'vue-google-charts'
Vue.use(VueGoogleCharts)

import storeInfo from './store/store.js';
const store = new Vuex.Store(
    storeInfo
)


// Router.js file Import
import { routes } from './routes.js';
const router = new VueRouter({
    routes,    // short for `routes: routes`
    mode: 'history'
})


// Sweet alert 2 support
import Swal from 'sweetalert2'
window.Swal = Swal; // It is use for globally 

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast; // It is use for globally 




Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('subcategory-product', require('./components/admin/dashboard/subcategory_wise_product.vue').default);
Vue.component('category-subCategory', require('./components/admin/dashboard/category_wise_subCategory.vue').default);



const app = new Vue({
    el: '#app',
    router,
    store
});
