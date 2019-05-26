<template>
    <div class="col-lg-10 col-sm-12 row row-eq-height">
        <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2" v-for="myFavorite in myFavorites" :id="myFavorite.id">
            <a :href="'/wine/' + myFavorite.slug">
                <div class="image-container">
                    <img :src="myFavorite.photo">
                    <div class="overlay"></div>
                    <span>
                        <a href="#" v-if="isFavorited" @click.prevent="unFavorite(post)">
                            <i  class="fas fa-heart"></i>
                        </a>
                        <a href="#" v-else @click.prevent="favorite(post)">
                            <i  class="far fa-heart"></i>
                        </a>
                    </span>
                    <span class="sale-mark">SALE</span>
                </div>
                <h5>{{ myFavorite.name ? myFavorite.name : 'Name of wine' }}</h5>
                <h4>${{ myFavorite.price }}</h4>

                <div class="star-rating">
                    <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="myFavorite.rating"></star-rating>
                </div>
                <span class="order-q">{{ orderNo[myFavorite.id].orderNo }} orders</span>
            </a>
        </div>
    </div>
    <!--
    <div class="col-lg-10 col-sm-12 row row-eq-height">
        @foreach ($myFavorites as $myFavorite)
            <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2" v-for="myFavorite in myFavorites">
                <a :href="route('wine.show', ['wine' => $myFavorite.slug])">
                    <div class="image-container">
                        <img :src="$myFavorite.getPhotoLink()">
                        <div class="overlay"></div>
                        <span>
                            <a href="#" v-if="isFavorited" @click.prevent="unFavorite(post)">
                                <i  class="fas fa-heart"></i>
                            </a>
                            <a href="#" v-else @click.prevent="favorite(post)">
                                <i  class="far fa-heart"></i>
                            </a>
                        </span>
                        <span class="sale-mark">SALE</span>
                    </div>
                    <h5>{{$myFavorite.name?$myFavorite->name:'Name of wine'}}</h5>
                    <h4>${{$myFavorite.price}}</h4>

                    <div class="star-rating">
                        <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$myFavorite.rating()}}"></star-rating>
                    </div>
                    <span class="order-q">{{ $orderNo[$myFavorite.id]->orderNo }} orders</span>
                </a>
            </div>
        @endforeach
    </div>
    -->
    
</template>

<script>
    export default {
        props: ['myFavorites', 'orderNo'],

        data: function() {
            return {
                isFavorited: '',
                hidden: ''
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

            unFavorite(post) {
                axios.post('/unfavorite/'+post)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
                var fav = document.getElementById("myFavorite.id");
                element.classList.add("hidden");
            }
        }
    }
</script>