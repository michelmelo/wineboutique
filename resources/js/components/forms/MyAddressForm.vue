<template>
    <div class="info-box shadow-box address">
        <div v-if="selectedAddress === null">
            <button v-on:click="addAddress" class="button red-button">Add address</button>
            <table class="address-table">
                <thead>
                    <tr>
                        <th>Address name</th>
                        <th>Default</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="address in addresses" v-bind:key="address.id">
                        <td>{{address.name}}</td>
                        <td><i v-bind:class="'fas fa-'+(address.default?'check':'times')"></i></td>
                        <td>
                            <button v-on:click="selectAddress(address.id)" class="btn d-inline-block"><i class="far fa-edit"></i> Edit</button>
                            <button v-on:click="deleteAddress(address.id)" v-if="!address.default" class="btn d-inline-block"><i class="fas fa-trash-alt"></i> Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-if="addresses.length == 0">
                <br>
                <h3 class="text-center">No saved addresses</h3>
            </div>
        </div>
        <div v-else>
            <h2>
                <span>MY ADDRESS</span>
            </h2>
            <div class="edit-button save-button" v-on:click="saveAddress">
                <i class="fas fa-save"></i>
            </div>
            <div class="edit-button" v-on:click="cancelEditing">
                <i class="fas fa-times"></i>
            </div>
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
                    <td>Default:</td>
                    <td class="edit-text">
                        <input type="checkbox" name="default" id="default" class="css-checkbox shipping-check" v-model="selectedAddress.default"
                               :disabled="disableSelected"/>
                        <label for="default" class="css-label lite-red-check">Default</label>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import { required, minLength } from 'vuelidate/lib/validators';
    import moment from 'moment';

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
            selectedAddress: null,
            addresses: [],
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
        created: function() {
            const addresses = JSON.parse(this.userAddresses);
            const regions = JSON.parse(this.regions);
            this.addresses = addresses;
            this.fetchedRegions = regions;
        },
        methods: {
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
                                if(data.default) {
                                    this.addresses.forEach(function (address) {
                                        address.default = false;
                                    });
                                }
                                const updatedAddress = response.data;
                                this.addresses = this.addresses.map(address => {
                                    if(updatedAddress.id !== address.id) return address;
                                    return updatedAddress;
                                })

                                this.selectedAddress = null;
                            })
                            .catch(error => {
                                console.log("error", error);
                                alert("Error while updating address");
                            });
                    } else {
                        axios.post('/my-address', data)
                        .then(response => {
                            if(data.default) {
                                this.addresses.forEach(function (address) {
                                    address.default = false;
                                });
                            }
                            this.addresses.push(response.data);

                            this.selectedAddress = null;
                        })
                        .catch(error => {
                            console.log("error", error);
                            alert("Error while creating address");
                        });
                    }
                }
            },
            cancelEditing() {
                this.selectedAddress = null;
            },
            selectAddress(addressId) {
                this.errors = {
                    name: null,
                    address_1: null,
                    city: null,
                    postal: null,
                    region: null
                }
                const selectedAddress = window._.find(this.addresses, {
                    id: addressId
                });

                this.selectedAddress = {...selectedAddress};
                this.disableSelected = this.selectedAddress.default===1||this.selectedAddress.default===true;
                this.default();
            },
            addAddress: function (e) {
                this.errors = {
                    name: null,
                    address_1: null,
                    city: null,
                    postal: null,
                    region: null
                }
                e.preventDefault();
                
                this.selectedAddress = {
                    name: "",
                    address_1: "",
                    address_2: "",
                    city: "",
                    postal_cod: "",
                    region_id: "",
                    default: true
                };
                this.default();
            },
            deleteAddress(id) {
                axios.delete(`/my-address/${id}`)
                    .then(response => {
                        var removable;
                        this.addresses.forEach(function (address) {
                            if(address.id===id) {
                                removable = address;
                            }
                        });
                        this.addresses.splice(this.addresses.indexOf(removable), 1);
                    })
            },
            default: function () {
                axios.post('/addresses/default').then(
                    response => {
                    }
                ).catch(error => {
                    console.log("error", error);
                });
            }
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
