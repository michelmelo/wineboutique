require('./bootstrap');
require('./main');
require('./cropper');
require('./add-wine');
require('jquery-ui');
require('./vendor/jquery.cookie/jquery.cookie');
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
Vue.component('register-form', require('./components/forms/RegisterForm.vue'));
Vue.component('startup-form', require('./components/forms/StartupForm.vue'));
Vue.component('personal-information-form', require('./components/forms/PersonalInformationForm.vue'));
Vue.component('password-update-form', require('./components/forms/PasswordUpdateForm.vue'));
Vue.component('my-wines-form', require('./components/forms/MyWinesForm.vue'));
Vue.component('checkout-form', require('./components/forms/CheckoutForm.vue'));
Vue.component('my-address-form', require('./components/forms/MyAddressForm.vue'));
Vue.component('my-order-form', require('./components/forms/MyOrderForm.vue'));
Vue.component('favorite', require('./components/Favorite.vue'));
Vue.component('rating', require('./components/Rating.vue'));
Vue.component('star-rating', StarRating.default);
Vue.component('cart', require('./components/Cart.vue'));
Vue.component('add-to-cart', require('./components/AddToCart.vue'));
Vue.component('buy-now', require('./components/BuyNow.vue'));
Vue.component('winery-edit-form', require('./components/forms/WineryEditForm.vue'));
Vue.component('newsletter-form', require('./components/forms/NewsletterForm'));
Vue.component('my-favorites', require('./components/forms/MyFavorites.vue'));

const app = new Vue({
    el: '#app'
});


