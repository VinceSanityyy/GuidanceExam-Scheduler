
require('./bootstrap');

window.Vue = require('vue');
Vue.prototype.$toast = toast
import Vue from 'vue'
import VueRouter from 'vue-router'
import swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'
Vue.use(VueRouter)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

window.swal = swal;
window.Form = Form;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    width: 300,
    timer: 3000
  });
window.toast = toast;



Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const routes = [
    { path: '/calendar', component: require('./components/Calendar.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
  ]

const router = new VueRouter({
    mode: 'history',
    routes
  })

const app = new Vue({
    el: '#app',
    router,
});
