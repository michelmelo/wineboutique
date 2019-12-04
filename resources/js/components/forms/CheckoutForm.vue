<template>
    <div class="section">
        <form action="/checkout/complete" method="post">
            <slot>

            </slot>
            <div class="row padding-row check">
                <h1 class="headline-2">CHECKOUT</h1>
                <div class="col-md-12">
                    <article class="card mb-2">
                        <div class="card-body p-3">
                            <p class="card-title"><b>Ship to</b></p>
                            <template v-if="selecting">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    <tr v-for="address in addresses" :key="address.id">
                                        <td>
                                            <p :class="{'font-weight-bold': address.id === selectedAddress.id}">
                                                {{address.name}}&nbsp; - &nbsp;
                                                {{address.address_1}},&nbsp;
                                                {{address.address_2}},&nbsp;
                                                {{address.city}},&nbsp;
                                                {{address.postal_code}},&nbsp;
                                                {{address.region.name}}
                                            </p>
                                        </td>
                                        <td>
                                            <a href="#" class="button red-button button-small d-inline-block" @click.prevent="switchAddress(address)">Ship
                                                here</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </template>
                            <template v-else-if="creating">
                                <div>
                                    <div class="field">
                                        <label class="label">Name</label>
                                        <div>
                                            <input type="text" class="form-control"
                                                   :class="{'invalid': hasError('name')}"
                                                   v-model.trim="newAddress.name">
                                            <span class="error-block"
                                                  v-if="hasError('name')">{{getError('name')}}</span>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Address line 1</label>
                                        <div>
                                            <input class="form-control" :class="{'invalid': hasError('address_1')}"
                                                   type="text" v-model.trim="newAddress.address_1">
                                            <span class="error-block" v-if="hasError('address_1')">{{getError('address_1')}}</span>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Address line 2</label>
                                        <div>
                                            <input class="form-control" :class="{'invalid': hasError('address_2')}"
                                                   type="text" v-model.trim="newAddress.address_2">
                                            <span class="error-block" v-if="hasError('address_2')">{{getError('address_2')}}</span>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">City</label>
                                        <div>
                                            <input class="form-control" :class="{'invalid': hasError('city')}"
                                                   type="text" v-model.trim="newAddress.city">
                                            <span class="error-block"
                                                  v-if="hasError('city')">{{getError('city')}}</span>
                                        </div>
                                    </div>

                                    <div class="columns mb-2">
                                        <div class="column is-6">
                                            <div class="field">
                                                <label class="label">Postal code</label>
                                                <div>
                                                    <input class="form-control"
                                                           :class="{'invalid': hasError('postal_code')}" type="text"
                                                           v-model.trim="newAddress.postal_code">
                                                    <span class="error-block" v-if="hasError('postal_code')">{{getError('postal_code')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column is-6">
                                            <div class="field">
                                                <label class="label">Region</label>
                                                <div>
                                                    <select class="form-control"
                                                            :class="{'invalid': hasError('region_id')}"
                                                            v-model="newAddress.region_id">
                                                        <option v-for="region in regions" :value="region.id"
                                                                v-bind:key="region.id">{{region.name}}
                                                        </option>
                                                    </select>
                                                    <span class="error-block" v-if="hasError('region_id')">{{getError('region_id')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <p class="control">
                                            <button class="btn btn-primary" @click.prevent="addShipingAddress()">
                                                Add address
                                            </button>
                                            <a class="btn btn-danger" @click.prevent="creating = false">Cancel</a>
                                        </p>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <template v-if="selectedAddress">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{selectedAddress.name}},&nbsp;
                                                    {{selectedAddress.address_1}},&nbsp;
                                                    <!-- {{selectedAddress.address_2}}<br> -->
                                                    {{selectedAddress.city}},&nbsp;
                                                    {{selectedAddress.postal_code}},&nbsp;
                                                    {{selectedAddress.region.name}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </template>

                                <span class="button red-button button-small mx-2 d-inline-block" @click.prevent="selecting = true"
                                        v-if="addresses.length>1">Change shipping address
                                </span>
                                <a href="/my-address" class="button red-button button-small d-inline-block">Add an address</a>
                            </template>
                        </div>
                    </article>

                    <article class="card mb-2">
                        <div class="card-body p-3">
                            <p class="card-title">
                                <b>Shipping</b>
                            </p>
                            <select class="form-control">
                                <option>
                                    FedEx
                                </option>
                            </select>
                        </div>
                    </article>

                    <article class="card mb-2">
                        <div class="card-body p-2">

                            <Cart :showComplete="false" :canPay="checkIfCanPay"/>
                        </div>
                    </article>

                    <article class="card mb-2">
                        <div class="card-body p-2">
                            <button class="button red-button full-width d-block w-100 payment-submit" type="submit" v-if="hasPayment && canMakePayment">
                                Place order
                            </button>
                            <a href="/my-payments" class="text-red font-weight-bold" v-if="!hasPayment">Add payment methodS please</a>
                        </div>
                    </article>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Cart from "../Cart";
    import {required, minLength, numeric} from 'vuelidate/lib/validators';

    export default {
        props: [
            'gateway',
            'terminalId',
            'currency',
            'secret',
            'testAccount',
            'authHash',
            'hasPayment',
            'amount',
            'dateTime',
            'requestURL',
            'validationUrl',
            'receipturl'
        ],
        data() {
            return {
                canMakePayment: false,
                selecting: false,
                creating: false,
                addresses: [],
                selectedAddress: null,
                regions: [],
                newAddress: {
                    name: '',
                    address_1: '',
                    address_2: '',
                    city: '',
                    postal_code: '',
                    region_id: '',
                    default: true
                },
                showErrors: false
            }
        },
        mounted() {
            this.asyncData();
        },
        methods: {
            checkIfCanPay: function(v) {
                this.canMakePayment = v
            },
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
                const regions = await axios.get('/api/regions');

                this.addresses = addresses.data.data;
                this.regions = regions.data;

                if (this.addresses.length) {
                    this.switchAddress(this.defaultAddress);
                }
            },
            switchAddress(address) {
                this.selectedAddress = address;
                this.selecting = false;

                if (!address.default) {
                    axios.get('/addresses/default/' + address.id)
                        .then(response => {
                            location.reload();
                        })
                        .catch(error => console.log(error));
                }
            },
            addShipingAddress() {
                this.showErrors = true;
                if (this.$v.$invalid) {
                    return false;
                }

                axios.post('/addresses', this.newAddress)
                    .then(response => {
                        this.addresses.push(response.data.data);
                        this.showErrors = false;
                        this.creating = false;
                        this.newAddress = {
                            name: '',
                            address_1: '',
                            address_2: '',
                            city: '',
                            postal_code: '',
                            region_id: '',
                            default: true
                        };
                    })
                    .catch(error => console.log(error));
            },
            hasError(name) {
                return (this.$v.newAddress[name].$invalid) && this.showErrors;
            },
            getError(name) {
                const model = this.$v.newAddress[name];

                if (!!model.$params.required && !model.required) {
                    return 'This field is required';
                }

                if (!!model.$params.minLength && !model.minLength) {
                    return `This field must have at least ${model.$params.minLength.min} characters.`;
                }
            },
            onSubmit(event) {
                this.showErrors = true;
                if (this.$v.$anyError || this.addresses.length === 0) {
                    event.preventDefault();
                }

                if (addresses.length === 0) {
                    alert("You must enter address to place order.");
                }
            },
        },
        computed: {
            defaultAddress() {
                return this.addresses.find(a => a.default);
            }
        },
        validations: {
            newAddress: {
                name: {
                    required,
                    minLength: minLength(3)
                },
                address_1: {
                    required,
                    minLength: minLength(3)
                },
                city: {
                    required,
                    minLength: minLength(2)
                },
                postal_code: {
                    required,
                    minLength: minLength(3)
                },
                region_id: {
                    required,
                    numeric
                }
            },
        },
        components: {
            Cart
        }
    }
</script>
