<template>
    <span>
        <a href="#" v-if="isFavorited" @click.prevent="confirmUnFavorite(post)">
            <i  class="fas fa-heart"></i>
        </a>
        <a href="#" v-else @click.prevent="favorite(post)">
            <i  class="far fa-heart"></i>
        </a>
         
         <transition name="slide">
            <div class="favorite-popup-container"  v-if="do_show">
                <i class="fas fa-times" @click.prevent="do_show = false"></i>
                <div class="">
                    <h2 class="thank-you text-center">Are you sure you wish to unfavorite wine?</h2>
                </div>
                <div class="">
                    <span href="#" class="button red-button" @click.prevent="unFavorite(post)" > Yes</span>
                    <span href="#" class="button red-button" @click.prevent="do_show = false" > No</span>
                </div>           
           </div>
        </transition> 
    </span>
</template>

<script>
    export default {
        props: ['post', 'favorited'],

        data: function() {
            return {
                isFavorited: '',
                do_show: false,
            }
        },

        mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(post) {
                axios.post('/favorite/'+post)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            confirmUnFavorite(){
                this.do_show = true;
            },

            unFavorite(post) {
                axios.post('/unfavorite/'+post)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));

                this.$emit('deleted');
                this.do_show = false;
            }
        }
    }
</script>