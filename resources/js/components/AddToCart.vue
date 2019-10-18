<template>
    <div class="full-width">
        <select v-model="qnty" name="quantity" id="quantity" style="width: 100%; margin-top: 10px; padding: 5px 10px;">
            <option :value="i" v-for="i in 10">{{i}}</option>
        </select>
        <a href="#" class="button pink-button full-width d-block" @click.prevent="addToCart()">ADD TO CART</a>
        <div v-if="popup" class="popup text-center">
            <h2>
                <strong>Item added to cart successfully</strong>
            </h2>
            <span class="button red-button d-inline-block" @click="popup = false">OK</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['wineId'],
        data(){
            return{
                popup: false,
                qnty: 1
            }
        },
        methods: {
            addToCart() {
                axios.post('/cart', {
                    wines: [{
                        id: this.wineId,
                        quantity: this.qnty
                    }]
                })
                .then(response => {                    
                    axios.get('/cart/get')
                        .then(response => {
                            $('.item-in-cart').text(response.data.wines.length);
                            this.popup = true;
                        })
                        .catch(response => console.log(response.data));
                })
                .catch(response => console.log(response.data));
            }
        }
    }
</script>