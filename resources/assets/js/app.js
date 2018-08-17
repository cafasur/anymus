
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('form-ssf', require('./components/FormSsf.vue'));
Vue.component('form-assign-role', require('./components/FormAssignRole.vue'));
Vue.component('loader-pacman', require('./components/LoaderPacman.vue'));
Vue.component('button-inactive', require('./components/ButtonInactive.vue'));
Vue.component('button-approve', require('./components/ButtonApprove.vue'));
Vue.component('button-check-arrival', require('./components/ButtonCheckArrival.vue'));


const app = new Vue({
    el: '#app'
});
