<template>
    <div class="row padding-row" v-if="showComplete">
        <h1 class="headline-2">CART</h1>
        <div class="col-lg-8 col-md-12">
            <div class="vine-box-style-5"  v-for="wine in wines">
                <div>
                    <div  class="row">
                        <div class="col-3">
                            <img src="/img/vine-style-2-img.PNG">
                        </div>
                        <div class="col-9">
                            <h5 class="name">{{wine.name}}</h5>
                            <h5 class="price">{{ (wine.price || 0) | currency }}</h5>
                            <div class="shipping">
                                <span>Free Shipping</span>
                            </div>
                            <div class="quantity">
                                <p>Quantity</p>
                                <p>
                                    <span class="minus" @click.prevent="decreaseQuantity(wine.slug, wine.pivot.quantity)">-</span>
                                    <span class="amount">{{wine.pivot.quantity}}</span>
                                    <span class="plus" @click.prevent="increaseQuantity(wine.slug, wine.pivot.quantity)">+</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="close"  @click.prevent="removeWine(wine.slug)">X</span>
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
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>Sales Tax:</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>State Tax:</td>
                    <td>$0.00</td>
                </tr>
            </table>
            <table class="cart-table-total">
                <tr>
                    <td>Total:</td>
                    <td>{{ (getTotal() || 0) | currency }}</td>
                </tr>
            </table>
            <div class="row cart-buttons">
                <a href="/checkout" class="button red-button full-width">CHECKOUT</a>
                <a href="/wines" class="button pink-button full-width">CONTINUE SHOPPING</a>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="vine-box-style-5"  v-for="wine in wines">
            <div>
                <div  class="row">
                    <div class="col-3">
                        <img src="/img/vine-style-2-img.PNG">
                    </div>
                    <div class="col-9">
                        <h5 class="name">{{wine.name}}</h5>
                        <h5 class="price">{{ (wine.price || 0) | currency }}</h5>
                        <div class="shipping">
                            <span>Free Shipping</span>
                        </div>
                        <div class="quantity">
                            <p>Quantity</p>
                            <p>
                                <span class="amount">{{wine.pivot.quantity}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="cart-table-total">
            <tr>
                <td>Total:</td>
                <td>{{ (getTotal() || 0) | currency }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            showComplete: {
                default: true
            }
        },
        data: function() {
            return {
                wines: []
            }
        },

        mounted() {
            this.getCart();
        },

        methods: {
            getCart() {
                axios.get('/cart/get')
                    .then(response => {
                       this.wines = response.data.wines;
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
            increaseQuantity(wineSlug, quantity) {
                axios.patch('/cart/'+wineSlug, {
                        quantity: quantity + 1
                    })
                    .then(response => {
                        this.wines = response.data.wines;
                    })
                    .catch(error => console.log(error));
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
            getTotal() {
                return this.wines.reduce((acc, wine) => acc+wine.price*wine.pivot.quantity, 0)
            }
        }
    }
</script>