/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
// import Vue from 'vue';
window.Vue = require('vue').default;
require('./bootstrap');

import Vue from "vue";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";


Vue.use(Toast, {
  transition: "Vue-Toastification__bounce",
  maxToasts: 20,
  newestOnTop: true
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('home-component', require('./components/Home.vue').default);
Vue.component('administrador-component', require('./components/Administrador.vue').default);
Vue.component('permisosroles-component', require('./components/PermisosRoles.vue').default);
Vue.component('jugadores-component', require('./components/Jugadores.vue').default);
Vue.component('torneo-component', require('./components/Torneos.vue').default);
Vue.component('post-component', require('./components/Post.vue').default);
Vue.component('perfil-component', require('./components/Perfil.vue').default);
Vue.component('notificaciones-component', require('./components/Notificaciones.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
