<template>
    <a href="#" class="button pink-button full-width" @click.prevent="addToCart()">ADD TO CART</a>
</template>

<script>
    export default {
        props: ['wineId'],
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
                        })
                        .catch(response => console.log(response.data));
                })
                .catch(response => console.log(response.data));
                alert("Item added to cart successfully");
            }
        }
    }
</script>