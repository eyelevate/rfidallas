
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

// Wrappers
window.Event = new class {
	constructor() {
		this.vue = new Vue();
	}

	fire(event, data = null) { // $emit
		this.vue.$emit(event,data);
	}

	listen(event, callback) { // $on
		this.vue.$on(event,callback);
	}
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

// Bootsrap components
Vue.component('bootstrap-card',require('./components/bootstrap/Card.vue'));
Vue.component('bootstrap-input',require('./components/bootstrap/Input.vue'));
Vue.component('bootstrap-table',require('./components/bootstrap/Table.vue'));

// Now-ui-kit Components
Vue.component('now-input',require('./components/now-ui-kit/FormInput.vue'));

// Passport Components
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens',require('./components/passport/PersonalAccessTokens.vue'));

