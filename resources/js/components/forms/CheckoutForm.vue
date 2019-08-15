<template>
    <div class="section">
        <form action="https://testpayments.nuvei.com/merchant/paymentpage" method="post" target="hidden_iframe">
            <div class="row padding-row check">
                <h1 class="headline-2">CHECKOUT</h1>
                <div class="col-md-12">
                    <article class="card mb-2">
                        <div class="card-body p-2">
                            <h5 class="card-title">Ship to</h5>
                            <template v-if="selecting">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    <tr v-for="address in addresses" :key="address.id">
                                        <td>
                                            <p :class="{'font-weight-bold': address.id === selectedAddress.id}">
                                                {{address.name}}<br>
                                                {{address.address_1}}<br>
                                                {{address.address_2}}<br>
                                                {{address.city}}<br>
                                                {{address.postal_code}}<br>
                                                {{address.region.name}}
                                            </p>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary" @click.prevent="switchAddress(address)">Ship
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
                                    <p>
                                        {{selectedAddress.name}}<br>
                                        {{selectedAddress.address_1}}<br>
                                        <!-- {{selectedAddress.address_2}}<br> -->
                                        {{selectedAddress.city}}<br>
                                        {{selectedAddress.postal_code}}<br>
                                        {{selectedAddress.region.name}}
                                    </p>
                                </template>

                                <button type="button" class="btn btn-primary" @click.prevent="selecting = true"
                                        v-if="addresses.length>1">Change shipping address
                                </button>
                                <a href="/my-address" class="btn btn-primary">Add an address</a>
                            </template>
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
                            <Cart :showComplete="false"/>
                        </div>
                    </article>

                    <article class="card mb-2">
                        <div class="card-body p-2">
                            <button class="btn btn-primary d-block w-100" type="submit">
                                Place order
                            </button>
                        </div>
                    </article>
                </div>
                <input type="hidden" name="TERMINALID" v-model="terminalId"/>
                <input type="hidden" name="ORDERID" v-model="orderId"/>
                <input type="hidden" name="CURRENCY" v-model="currency"/>
                <input type="hidden" name="AMOUNT" v-model="amount"/>
                <input type="hidden" name="DATETIME" v-model="dateTime"/>
                <input type="hidden" name="VALIDATIONURL" v-model="validationUrl"/>
                <input type="hidden" name="RECEIPTPAGEURL" v-model="receipturl"/>
                <input type="hidden" name="HASH" v-model="authHash"/>
                <input type="hidden" name="INIFRAME" value="Y"/>
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
            'orderId',
            'amount',
            'dateTime',
            'requestURL',
            'validationUrl',
            'receipturl'
        ],
        data() {
            return {
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