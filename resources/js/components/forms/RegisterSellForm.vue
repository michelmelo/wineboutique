<template>
    <form class="form-inline" v-on:submit.prevent="onSubmit" ref="formElement">
        <input type="text" v-model.trim="firstName" :class="{ 'invalid': isInvalid('firstName') }" name="firstName" placeholder="First Name">
        <input type="text" v-model.trim="lastName" :class="{ 'invalid': isInvalid('lastName') }" name="lastName" placeholder="Last Name">
        <input type="text" v-model.trim="wineryName" :class="{ 'invalid': isInvalid('wineryName') }" name="wineryName" placeholder="Winery Name">
        <input type="email" v-model.trim="email" :class="{ 'invalid': isInvalid('email') || validEmail===false, 'valid': validEmail }" name="email" placeholder="Email">
        <input type="password" v-model="password" :class="{ 'invalid': isInvalid('password') }" name="password" placeholder="Password">
        <input type="text" v-model.trim="phone" :class="{ 'invalid': isInvalid('phone') }" name="phone" placeholder="Phone">
        <select class="half-select" :class="{ 'invalid': isInvalid('city') }" name="city" v-model="city" v-bind:disabled="cities.length===0">
            <option value="">City</option>
            <option v-for="city in cities" v-bind:value="city.id">
                {{ city.name }}
            </option>
        </select>
        <select class="half-select" :class="{ 'invalid': isInvalid('location') }" name="location" v-model="location" v-bind:disabled="city==='' || locations.length===0">
            <option value="">Store Location</option>
            <option v-for="location in locations" v-bind:value="location.id">
                {{ location.name }}
            </option>
        </select>
        <div class="form-check">
            <input class="form-check-input" v-model="acceptTerms" type="checkbox" name="acceptTerms" id="defaultCheck1">
            <label class="form-check-label" :class="{ 'invalid': isInvalid('acceptTerms') }" for="defaultCheck1">
                I agree to <a href="#">Terms and Conditions</a> of the Wine Boutique*
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" v-model="acceptAge" type="checkbox" name="acceptAge" id="defaultCheck2">
            <label class="form-check-label" :class="{ 'invalid': isInvalid('acceptAge') }" for="defaultCheck2">
                I am at least 21 years of age.*
            </label>
        </div>
        <input type="submit" name="submit" class="button red-button full-width" value="CREATE A WINERY">
    </form>
</template>

<script>
    import { required, minLength, email, numeric } from 'vuelidate/lib/validators';
    import { isTrue } from "../../customValidators";

    const formFields = [
        'firstName',
        'lastName',
        'wineryName',
        'email',
        'password',
        'phone',
        'city',
        'location',
        'acceptTerms',
        'acceptAge',
        'type'
    ];

    export default {
        data: () => ({
            firstName: '',
            lastName: '',
            wineryName: '',
            email: '',
            password: '',
            phone: '',
            city: '',
            location: '',
            acceptTerms: false,
            acceptAge: false,
            type: 'SELLER',
            cities: [],
            locations: [],
            showErrors: false,
            validEmail: null
        }),
        created() {
            this.fetchCities();
        },
        watch: {
            'city': 'fetchLocations',
            'email': 'checkEmail'
        },
        methods: {
            fetchCities() {
                this.cities = [];
                axios.get('/api/cities')
                    .then(response => {
                        this.cities = response.data;
                    })
                    .catch(error => {
                        console.log("error", error);
                    });
            },
            fetchLocations() {
                this.locations = [];
                this.location = '';
                if(this.city!=='') {
                    axios.get(`/api/locations/${this.city}`)
                        .then(response => {
                            this.locations = response.data;
                        })
                        .catch(error => {
                            console.log("error", error);
                        });
                }
            },
            checkEmail() {
                this.validEmail = null;
                if(this.email.length > 0 && email(this.email)) {
                    axios.post(`/api/auth/check-email`, {email: this.email})
                        .then(() => {
                            this.validEmail = true;
                        })
                        .catch(() => {
                            this.validEmail = false;
                        });
                }
            },
            onSubmit() {
                this.showErrors = true;
                if(this.$v.$invalid) {
                    formFields.some(formField => {
                        if(this.$v[formField].$invalid) {
                            document.querySelector(`[name="${formField}"]`).focus();
                            return true;
                        }
                        return false;
                    });
                    return;
                }
                axios.post('/api/auth/register', _.pick(this._data, formFields))
                    .then(() => {
                        //document.location.href = '/startup';
                    })
                    .catch(error => {
                        console.log("error", error);
                    })
            },
            isInvalid(name) {
                return this.$v[name].$invalid && this.showErrors;
            }
        },
        validations: {
            firstName: {
                required,
                minLength: minLength(4)
            },
            lastName: {
                required,
                minLength: minLength(4)
            },
            wineryName: {
                required,
                minLength: minLength(4)
            },
            email: {
                required,
                email
            },
            password: {
                required,
                minLength: minLength(6)
            },
            phone: {
                required,
                minLength: minLength(6)
            },
            city: {
                required,
                numeric
            },
            location: {
                required,
                numeric
            },
            acceptTerms: {
                isTrue
            },
            acceptAge: {
                isTrue
            }
        }
    }
</script>
