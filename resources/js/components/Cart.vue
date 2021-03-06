<template>
    <div v-if="fetchedFirst && wines.length>0">
        <div class="row padding-row cart">
            <h1 class="headline-2" v-if="showComplete">CART</h1>

            <div class="col-lg-8 col-md-12">
                <div class="vine-box-style-5 order-product"  v-for="wine in wines">
                    <div>
                        <div class="row">
                            <div class="col-4 image-wrap">
                                <img :src="wine.photo" class="wine-cart-image" />
                            </div>
                            <div class="col-8 py-3">
                                <div class="row">
                                    <div class="product-name">
                                        <h5 class="name">{{wine.name}}</h5>
                                        <h5 class="price"><strong>{{ (wine.price.toFixed(2) || 0.00) | currency }}</strong></h5>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end w-100">
                                        <div class="product-shipping">
                                            <div class="shipping">
                                                <span v-if="wine.shipping">Shipping:<br> {{wine.shipping_price + (wine.shipping_additional * (wine.pivot.quantity - 1)) | currency}}</span>
                                                <span v-else>
                                                    Winery is not shipping to your state, please remove wine or
                                                    <a href="/my-address" class="text-red font-weight-bold">change shipping state</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="order-quantity">
                                            <div class="quantity">
                                                <p>Quantity</p>
                                                <p>
                                                    <span class="minus" @click.prevent="decreaseQuantity(wine.slug, wine.pivot.quantity)" v-if="showComplete">-</span>
                                                    <span class="amount">{{wine.pivot.quantity}}</span>
                                                    <span class="plus" @click.prevent="increaseQuantity(wine.slug, wine.pivot.quantity, wine.quantity)" v-if="showComplete">+</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="close" @click.prevent="removeWine(wine.slug)" v-if="showComplete">X</span>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <table class="cart-table">
                    <tr>
                        <th><b>Summary</b><span> ({{wines.length}} {{wines.length | pluralize('item')}})</span></th>
                    </tr>
                    <tr>
                        <td>Subtotal:</td>
                        <td>{{ (getTotal() || 0) | currency }}</td>
                    </tr>
                    <tr>
                        <td>Shipping:</td>
                        <td>{{ (getShippingTotal() || 0) | currency }}</td>
                    </tr>
                </table>
                <table class="cart-table-total">
                    <tr>
                        <td>Total:</td>
                        <td>{{ (getTotal() || 0) + (getShippingTotal() || 0) | currency }}</td>
                    </tr>
                </table>
                <div class="row cart-buttons">
                    <a href="/checkout" class="button red-button full-width" v-if="showComplete && hasShippingAddress(wines)">CHECKOUT</a>
                    <a href="/wines" class="button pink-button full-width">CONTINUE SHOPPING</a>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <p class="empty-cart">Cart is empty.</p>
    </div>
</template>

<script>
    export default {
        props: [
            'showComplete',
            'canPay'
        ],
        data: function() {
            return {
                wines: [],
                fetchedFirst: false,
                photo: '',
                userAddress_: null
            }
        },
        created() {
            //
        },
        async asyncData() {
            const addresses = await axios.get('addresses');

            this.userAddress_ = addresses.data.data;
        },
        mounted() {
            this.getCart();
        },
        methods: {
            hasShippingAddress(wines) {
                // use this
                return wines.filter(({shipping}) => !shipping).length === 0

                // not this
                // var status = true;
                //
                // this.wines.forEach(function(item, index){
                //     if(!item.shipping){
                //         status = false;
                //         return false;
                //     }
                // });
                //
                // return status;


            },
            getCart() {
                axios.get('/cart/get')
                    .then(response => {
                       this.wines = response.data.wines;
                       if(this.canPay) {
                           this.canPay(this.hasShippingAddress(this.wines))
                       }

                       this.fetchedFirst = true;
                    })
                    .catch(error => console.log(error));
            },
            removeWine(wineSlug) {
                axios.delete('/cart/'+wineSlug)
                    .then(response => {
                        this.wines = response.data.wines;
                        $('.item-in-cart').text(response.data.wines.length);
                    })
                    .catch(error => console.log(error));
            },
            increaseQuantity(wineSlug, quantity, maxQ) {
                if(quantity<maxQ) {
                    axios.patch('/cart/' + wineSlug, {
                        quantity: quantity + 1
                    })
                        .then(response => {
                            this.wines = response.data.wines;
                        })
                        .catch(error => console.log(error));
                }
            },
            decreaseQuantity(wineSlug, quantity) {
                if(quantity===1) return;
                axios.patch('/cart/'+wineSlug, {
                        quantity: quantity - 1
                    })
                    .then(response => {
                        this.wines = response.data.wines;
                    })
                    .catch(error => console.log(error));
            },
            getShippingTotal() {
                return this.wines.reduce((acc, wine) => acc+wine.shipping_price + (wine.shipping_additional*(wine.pivot.quantity-1)), 0)
            },
            getTotal() {
                return this.wines.reduce((acc, wine) => acc+wine.price*wine.pivot.quantity, 0)
            }
        }
    }
</script>
