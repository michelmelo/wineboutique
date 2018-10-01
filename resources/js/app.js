require('./bootstrap');
require('./main');
window.Vue = require('vue');
window.Vuelidate = require('vuelidate').default;

Vue.use(Vuelidate);

Vue.component('register-sell-form', require('./components/forms/RegisterSellForm.vue'));

const app = new Vue({
    el: '#app'
});
