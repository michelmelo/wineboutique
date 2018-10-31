require('./bootstrap');
require('./main');
require('jquery-ui');
window.Vue = require('vue');
window.Vuelidate = require('vuelidate').default;
window.Vue2Filters = require('vue2-filters');

Vue.use(Vuelidate);
Vue.use(Vue2Filters);

Vue.directive('click-outside', {
    bind: function (el, binding, vnode) {
        this.event = function (event) {
            if (!(el == event.target || el.contains(event.target))) {
                binding.value(event);
            }
        };
        document.body.addEventListener('click', this.event)
    },
    unbind: function (el) {
        document.body.removeEventListener('click', this.event)
    },
});

var StarRating = require('vue-star-rating');

Vue.component('register-sell-form', require('./components/forms/RegisterSellForm.vue'));
Vue.component('startup-form', require('./components/forms/StartupForm.vue'));
Vue.component('personal-information-form', require('./components/forms/PersonalInformationForm.vue'));
Vue.component('password-update-form', require('./components/forms/PasswordUpdateForm.vue'));
Vue.component('my-wines-form', require('./components/forms/MyWinesForm.vue'));
Vue.component('favorite', require('./components/Favorite.vue'));
Vue.component('rating', require('./components/Rating.vue'));
Vue.component('star-rating', StarRating.default);

const app = new Vue({
    el: '#app'
});
