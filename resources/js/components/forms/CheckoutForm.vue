<template>
    <div class="section">
        <div class="row padding-row check">
            <h1 class="headline-2">CHECKOUT</h1>
            <div class="col-md-8">
                <article class="card mb-2">
                    <div class="card-body p-2">
                        <h5 class="card-title">Ship to</h5>
                        <template v-if="selecting">

                        </template>
                        <template v-else>
                            <template v-if="switchAddress">
                                <p>
                                    {{selectedAddress.name}}<br>
                                    {{selectedAddress.address_1}}<br>
                                    {{selectedAddress.city}}<br>
                                    {{selectedAddress.postal_code}}<br>
                                    {{selectedAddress.region.name}}
                                </p>
                            </template>
                            <button type="button" class="btn btn-primary" @click.prevent="selecting = true">Change shipping address</button>
                        </template>
                    </div>
                </article>

                <article class="card mb-2">
                    <div class="card-body p-2">
                        <h5 class="card-title">Payment</h5>
                    </div>
                </article>

                <article class="card mb-2">
                    <div class="card-body p-2">
                        <h5 class="card-title">
                            Shipping
                        </h5>
                        <select class="form-control">
                            <option>
                                Royal Mail 1st Class
                            </option>
                        </select>
                    </div>
                </article>

                <article class="card mb-2">
                    <div class="card-body p-2">
                        <h5 class="card-title">
                            Cart summary
                        </h5>
                        <Cart :showComplete="false" />
                    </div>
                </article>

                <article class="card mb-2">
                    <div class="card-body p-2">
                        <button class="btn btn-primary d-block w-100">
                            Place order
                        </button>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="card">
                    <div class="card-body p-2">
                        <button class="btn btn-primary d-block w-100">
                            Place order
                        </button>
                    </div>
                </article>
            </div>
        </div>
    </div>
</template>

<script>
    import Cart from "../Cart";
    export default {
        props: ['wineId'],
        data() {
            return {
                selecting: false,
                addresses: [],
                selectedAddress: null
            }
        },
        mounted() {
            this.asyncData();
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
                        $('.item-in-cart').text(response.data.wines.length);
                    })
                    .catch(response => console.log(response.data));
            },
            async asyncData() {
                const addresses = await axios.get('addresses');

                this.addresses = addresses.data.data;

                if(this.addresses.length) {
                    this.switchAddress(this.defaultAddress);
                }
            },
            switchAddress(address) {
                this.selectedAddress = address;
            }
        },
        computed: {
            defaultAddress() {
                return this.addresses.find(a => a.default);
            }
        },
        components: {
            Cart
        }
    }
</script>