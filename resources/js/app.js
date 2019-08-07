
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/index.css';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.use(require('vue-moment'));
Vue.use(VueToast);

Vue.component('v-datepicker', require('vuejs-datepicker').default);
Vue.component('v-select', require('vue-select').default);
Vue.component('editor-component', require('./components/EditorComponent.vue').default);
Vue.component('table-component', require('./components/TableComponent.vue').default);
Vue.component('item-list', require('./components/_partials/KeyArrayComponent.vue').default);
Vue.component('countries-component', require('./components/_partials/CountriesComponent.vue').default);
Vue.component('type-component', require('./components/_partials/TypeComponent.vue').default);
Vue.component('user-component', require('./components/_partials/UserComponent.vue').default);
Vue.component('address-component', require('./components/_partials/AddressComponent.vue').default);
Vue.component('date-time-component', require('./components/_partials/DateTimePickerComponent.vue').default);

Vue.component('meta-component', require('./components/MetaComponent.vue').default);
Vue.component('input-group', require('./components/bootstrap/InputGroup.vue').default);

Vue.component('offer', require('./components/Offers/OfferComponent.vue').default);
Vue.component('article-component', require('./components/elements/ArticleComponent.vue').default);
Vue.component('message-component', require('./components/elements/MessageComponent.vue').default);

Vue.filter('capitalize', (string) => {
    return _.startCase(_.toLower(string));
});


/**
 * Authentication via Laravel passport
 */
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    methods: {
        redirectFromClick(event) {
            console.log(event);
            window.location.href = '/offers/'+event.id + '/edit';
        }
    }
});
