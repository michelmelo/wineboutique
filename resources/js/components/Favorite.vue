<template>
    <span>
        <a href="#" v-if="isFavorited" @click.prevent="confirmUnFavorite(post)">
            <i  class="fas fa-heart"></i>
        </a>
        <a href="#" v-else @click.prevent="favorite(post)">
            <i  class="far fa-heart"></i>
        </a>

        <div class="default-popup is-visible popup-holder" role="alert" v-if="do_show">
            <div class="popup-container">
                <div class="popup-head text-center">
                    <h2 class="thank-you">Are you sure you wish to unfavourite wine?</h2>
                </div>
                <div class="popup-body text-center">
                    <span href="#" class="button red-button" @click.prevent="unFavorite(post)" ><i class="fas fa-times"></i> Yes</span>
                    <span href="#" class="button red-button" @click.prevent="do_show = false" ><i class="fas fa-times"></i> No</span>
                </div>
            </div>
        </div>
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