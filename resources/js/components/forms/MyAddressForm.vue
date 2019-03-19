<template>
    <div class="info-box shadow-box">
        <div v-if="selectedAddress === null">
            <button v-on:click="addAddress">Add address</button>
            <table>
                <thead>
                    <tr>
                        <td>Address name</td>
                        <td>Default</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="address in addresses" v-bind:key="address.id">
                        <td>{{address.name}}</td>
                        <td><i v-bind:class="'fas fa-'+(address.default?'check':'times')"></i></td>
                        <td>
                            <button v-on:click="selectAddress(address.id)">edit</button>
                            <button v-on:click="deleteAddress(address.id)">delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-else>
            <h2>
                <span>MY ADDRESS</span>
                <div class="edit-button" v-on:click="saveAddress">
                    <i class="fas fa-save"></i>Save
                </div>
                <div class="edit-button" v-on:click="cancelEditing">
                    <i class="fas fa-times"></i>Cancel
                </div>
                
            </h2>
            <table>
                <tr>
                    <td>Name:</td>
                    <td class="edit-text">
                        <input name="name" v-model="selectedAddress.name" class="w-100"/>
                    </td>
                </tr>
                <tr>
                    <td>Address1:</td>
                    <td class="edit-text">
                        <input name="address_1" v-model="selectedAddress.address_1" class="w-100"/>
                    </td>
                </tr>
                <tr>
                    <td>Address2:</td>
                    <td class="edit-text">
                        <input name="address_2" v-model="selectedAddress.address_2" class="w-100"/>
                    </td>
                </tr>
                <tr>
                    <td>City:</td>
                    <td class="edit-text">
                        <input name="city" v-model="selectedAddress.city" class="w-100"/>
                    </td>
                </tr>
                <tr>
                    <td>Postal Code:</td>
                    <td class="edit-text">
                        <input name="postal_code" v-model="selectedAddress.postal_code" class="w-100"/>
                    </td>
                </tr>
                <tr>
                    <td>Region:</td>
                    <td class="edit-text">
                        <select name="region_id" v-model="selectedAddress.region_id" class="w-100">
                            <option v-for="region in fetchedRegions" v-bind:key="region.id" v-bind:value="region.id">{{region.name}}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Default:</td>
                    <td class="edit-text">
                        <input type="checkbox" name="default" id="default" class="css-checkbox shipping-check" v-model="selectedAddress.default"/>
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
            fetchedRegions: []
        }),
        created: function() {
            const addresses = JSON.parse(this.userAddresses);
            const regions = JSON.parse(this.regions);
            this.addresses = addresses;
            this.fetchedRegions = regions;
        },
        methods: {
            saveAddress() {
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
                    
                    if(this.selectedAddress.id) {
                        axios.post(`/my-address/${this.selectedAddress.id}`, data)
                            .then(response => {
                                const updatedAddress = response.data;
                                this.addresses = this.addresses.map(address => {
                                    if(updatedAddress.id !== address.id) return address;
                                    return updatedAddress;
                                })
                            })
                            .catch(error => {
                                console.log("error", error);
                            });
                    } else {
                        axios.post('/my-address', data)
                        .then(response => {
                            this.addresses.push(response.data);
                        })

                    }
                }

                this.selectedAddress = null;
            },
            cancelEditing() {
                this.selectedAddress = null;
            },
            selectAddress(addressId) {
                const selectedAddress = window._.find(this.addresses, {
                    id: addressId
                });

                this.selectedAddress = {...selectedAddress};
            },
            addAddress: function (e) {
                e.preventDefault();
                
                this.selectedAddress = {
                    name: "",
                    address_1: "",
                    address_2: "",
                    city: "",
                    postal_cod: "",
                    region_id: ""
                };
            },
            deleteAddress(id) {
                axios.delete(`/my-address/${id}`)
                    .then(response => {
                        this.addresses.splice(this.addresses.indexOf(id), 1)
                    })
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
