<template>
    <a class="button red-button full-width" @click.prevent="addToCart()">BUY NOW</a>
</template>

<script>
    export default {
        props: ['wineId'],
        methods: {
            addToCart() {
                axios.post('/cart', {
                    wines: [{
                        id: this.wineId,
                        quantity: window.qnty !== undefined ? window.qnty : 1
                    }]
                })
                .then(response => {
                    $('.item-in-cart').text(response.data.wines.length);
                })
                .catch(response => console.log(response.data));
                window.location.href = '/checkout';
            }
        }
    }
</script>