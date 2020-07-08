<template>
<div>
    <h2>
        <span>MY ADDRESS</span>
    </h2>
    <table>
        <tr>
            <td>Name:</td>
            <td class="edit-text">
                <div class="error-block" v-model="errors.name">{{errors.name}}</div>
                <input name="name" id="name" v-model="selectedAddress.name"  required/>
            </td>
        </tr>
        <tr>
            <td>Address1:</td>
            <td class="edit-text">
                <div class="error-block" v-model="errors.address_1">{{errors.address_1}}</div>
                <input name="address_1" id="address_1" v-model="selectedAddress.address_1"  required/>
            </td>
        </tr>
        <tr>
            <td>Address2:</td>
            <td class="edit-text">
                <input name="address_2" id="address_2" v-model="selectedAddress.address_2"/>
            </td>
        </tr>
        <tr>
            <td>City:</td>
            <td class="edit-text">
                <div class="error-block" v-model="errors.city">{{errors.city}}</div>
                <input name="city" id="city" v-model="selectedAddress.city"  required/>
            </td>
        </tr>
        <tr>
            <td>Zip Code:</td>
            <td class="edit-text">
                <div class="error-block" v-model="errors.postal">{{errors.postal}}</div>
                <input type="number" id="postal-code" name="postal_code" v-model="selectedAddress.postal_code"  required/>
            </td>
        </tr>
        <tr>
            <td>State:</td>
            <td class="edit-text">
                <div class="error-block" v-model="errors.region">{{errors.region}}</div>
                <select name="region_id" id="region" v-model="selectedAddress.region_id" class="w-100" required>
                    <option v-for="region in fetchedRegions" v-bind:key="region.id" v-bind:value="region.id">{{region.name}}</option>
                </select>
            </td>
        </tr>
        <tr>
            <!--<td>Default:</td>-->
            <td class="edit-text">
                <input type="hidden" name="default" id="default" class="css-checkbox shipping-check" v-model="selectedAddress.default"
                       :disabled="true" checked="checked"/>
                <!--<label for="default" class="css-label lite-red-check">Default</label>-->
            </td>
        </tr>
        <tr>
            <td class="full-width" colspan="2">
                <button class="button red-button margin-0-auto d-block margin-t" v-on:click="saveAddress">
                    Save
                </button>
            </td>
        </tr>
    </table>
</div>
</template>

<script>
    import { required, minLength } from 'vuelidate/lib/validators';
    // import moment from 'moment';

    const formFields = [
        'name',
        'address_1',
        'address_2',
        'city',
        'postal_code',
        'region_id',
        'default'
    ];

    export default {
        props: ['userAddresses', 'regions'],
        data: () => ({
            selectedAddress: {
                name: null,
                address_1: null,
                address_2: null,
                city: null,
                postal: null,
                region: null,
                default: true,
            },
            // addresses: [],
            fetchedRegions: [],
            disableSelected: true,
            errors: {
                name: null,
                address_1: null,
                city: null,
                postal: null,
                region: null
            }
        }),
        // created: function() {
        //     const addresses = JSON.parse(this.userAddresses);
        //     const regions = this.regions;
        //     this.addresses = addresses;
        //     this.fetchedRegions = this.regions;
        //     console.log(this.regions)
        // },
        mounted: function() {
            this.asyncData();
        },
        methods: {
            async asyncData() {
                const regions = await axios.get('/api/regions');
                this.fetchedRegions = regions.data;
                // console.log(this.fetchedRegions)
            },
            validate() {
                this.errors= {
                    name: null,
                    address_1:
                        null,
                    city:
                        null,
                    region:
                        null,
                    postal:
                        null,
                }
                if (!this.selectedAddress.name) {
                    this.errors.name = "You must enter a name.";
                    document.getElementById("name").focus();
                    return false;
                }
                if (!this.selectedAddress.address_1) {
                    this.errors.address_1 = "You must enter your address.";
                    document.getElementById("address_1").focus();
                    return false;
                }
                if (!this.selectedAddress.city) {
                    this.errors.city = "You must enter your city.";
                    document.getElementById("city").focus();
                    return false;
                }
                if (!this.selectedAddress.postal_code) {
                    document.getElementById("postal-code").focus();
                    this.errors.postal = "You must enter your postal code.";
                    return false;
                }
                if (!this.selectedAddress.region_id) {
                    document.getElementById("region").focus();
                    this.errors.region = "You must select your region.";
                    return false;
                }
                return true;
            },
            saveAddress() {
                if(!this.validate()) {
                    return false;
                }
                if(this.selectedAddress) {
                    this.showErrors = true;
                    if(this.$v.$invalid) {
                        event.preventDefault();
                        formFields.some(formField => {
                            if(this.$v[formField].$invalid) {
                                document.querySelector(`[name="${formField}"]`).focus();
                                return true;
                            }
                            return false;
                        });
                    }

                    const data = _.pick(this.selectedAddress, formFields);

                    if(data.default===1) {
                        data.default = true;
                    }

                    if(this.selectedAddress.id) {
                        axios.post(`/my-address/${this.selectedAddress.id}`, data)
                            .then(response => {
                                this.selectedAddress = {
                                    name: null,
                                    address_1: null,
                                    address_2: null,
                                    city: null,
                                    postal: null,
                                    region: null,
                                    default: true,
                                };
                            })
                            .catch(error => {
                                console.log("error", error);
                                alert("Error while updating address");
                            });
                    } else {
                        axios.post('/my-address', data)
                            .then(response => {
                                // console.log(response)
                                this.$emit('newAddress', response.data);
                                this.selectedAddress = {
                                    name: null,
                                    address_1: null,
                                    address_2: null,
                                    city: null,
                                    postal: null,
                                    region: null,
                                    default: true,
                                };
                            })
                            .catch(error => {
                                console.log("error", error);
                                alert("Error while creating address");
                            });
                    }
                }
            },
        },
        validations: {
            name: {
                required
            },
            address_1: {
                required
            },
            city: {
                required
            },
            postal_code: {
                required
            },
            region_id: {
                required
            },

        }
    }
</script>