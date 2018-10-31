<template>
    <span>
        <star-rating :star-size="20" active-color="#991D3F" :show-rating="false" v-model="rating"></star-rating>
    </span>
</template>

<script>
    export default {
        props: ['post', 'rating'],
        watch: {
            rating: function () {
                axios.post('/rate-wine/'+this.post, {rating: this.rating})
                    .then(response => console.log(response.data))
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>