<template>
        <div class="row">
            <div v-for="(favorite, counter) in favorites" class="col-xs-5 vine-box-style-3 style-3-2" v-if="displaying[counter]">
                <a :href="'/wine/' + favorite.slug">
                    <div class="image-wrap">
                        <figure class="image-container">
                            <img :src="favorite.photo">
                            <div class="overlay"></div>
                            <favorite
                                    :post="favorite.slug"
                                    :favorited="'true'"
                                    :type="'wine'"
                                    v-on:deleted="hide(counter)"
                            ></favorite>

                        <!--    <span class="sale-mark">SALE</span> -->
                        </figure>
                    </div>
                    <div class="product-info">
                        <h5>{{ favorite.name ? favorite.name: 'Name of wine'}}</h5>
                     

                        <div class="star-rating">
                            <h4 class="m-0 p-0">${{favorite.price}}</h4>
                            <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="favorite.rating"></star-rating>
                        </div>
                        <span class="order-q">{{ orders[favorite.id].orderNo }} orders</span>
                    </div>
                </a>
            </div>
    </div>
</template>

<script>
    export default {
        name: "MyFavorites",
        props: ['favorites', 'orders'],
        data: function() {
            return {
                displaying: [],
            }
        },
        mounted() {
            let that = this;
            this.favorites.forEach(function () {
                that.displaying.push(true);
            });
        },
        methods: {
          hide(cnt) {
              this.displaying[cnt]=false;
              this.$forceUpdate();
          },
        },
    }
</script>