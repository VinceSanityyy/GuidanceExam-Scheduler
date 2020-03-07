
require('./bootstrap');

window.Vue = require('vue');
Vue.prototype.$toast = toast
import Vue from 'vue'
import VueRouter from 'vue-router'
import swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'

import datePicker from 'vue-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
// Init plugin

import VueFusionCharts from 'vue-fusioncharts';
// import FusionCharts from 'fusioncharts';




Vue.use(Loading);
Vue.use(VueRouter)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.use(require('vue-moment'));
Vue.use(datePicker);


// Vue.use(VueFusionCharts, FusionCharts);

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
Vue.component('calendar-webview', require('./components/CalendarWebview.vue').default);

const routes = [
    { path: '/calendar', component: require('./components/Calendar.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/schedules', component: require('./components/Schedules.vue').default },
    { path: '/reports', component: require('./components/Reports.vue').default },
    { path: '/results', component: require('./components/Results.vue').default },
    { path: '/home', component: require('./components/Home.vue').default },
  ]

const router = new VueRouter({
    mode: 'history',
    routes
  })

const app = new Vue({
    el: '#app',
    router,
    components: {
      datePicker,
      }
});
