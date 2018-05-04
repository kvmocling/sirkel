// import Vue from 'vue';

// import VueRouter from 'vue-router';
// Vue.use(VueRouter);

// import VueAxios from 'vue-axios';
// import axios from 'axios';
// Vue.use(VueAxios, axios);

// import App from './App.vue';
// import Example from './components/ExampleComponent.vue';

// const routes = [
//   {
//       name: 'Example',
//       path: '/',
//       component: Example
//   }
// ];

// const router = new VueRouter({ mode: 'history', routes: routes});
// new Vue(Vue.util.extend({ router }, App)).$mount('#app');


// import Vue from 'vue/dist/vue.js'
// import Buefy from 'buefy'
// import 'buefy/lib/buefy.css'
// Vue.use(Buefy)

require('./bootstrap');


const app = new Vue({
	el: '#app',
	data: {

		msg: 'Hello:',
	}
});