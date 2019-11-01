<template>
    <div class="full-width add-to-cart">
      <div class="row align-items-center px-0">
         <div class="col-3 pl-0">
            <select v-model="qnty" @change="qntyChanged" name="quantity" id="quantity" style="width: 100%; margin-top: 10px; padding: 5px 10px;">
                <option :value="i" v-for="i in 10">{{i}}</option>
            </select>
         </div> 
        <div class="col-9 pr-0">
            <a href="#" class="button pink-button full-width d-block" @click.prevent="addToCart()">ADD TO CART</a>
          </div>  
        </div> 
         <transition name="slide">   
            <div v-if="popup" class="favorite-popup-container"> 
                <h2 class="text-center w-100">
                    <strong>Item added to cart successfully</strong>
                </h2>
                 <p class="button red-button d-inline-block" @click="popup = false">OK</p>
            </div>

         </transition>   
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
            qntyChanged: function() {
                window.qnty = this.qnty;
            },
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