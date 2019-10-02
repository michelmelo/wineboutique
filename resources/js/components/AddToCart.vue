<template>
    <div class="full-width">
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
               popup: false
            }
        },
        methods: {
            addToCart() {
                axios.post('/cart', {
                    wines: [{
                        id: this.wineId,
                        quantity: 1
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