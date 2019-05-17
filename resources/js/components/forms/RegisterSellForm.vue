<template>
    <form class="form-inline" v-on:submit="onSubmit" method="post" action="/register">
        <input type="hidden" name="_token" v-model="csrf">
        <input type="hidden" name="type" value="SELLER">
        <input type="text" v-model.trim="firstName" :class="{ 'invalid': isInvalid('firstName') }" name="firstName" placeholder="First Name">
        <span class="help-block" v-if="isInvalid('firstName')">
            <strong>First Name is required.</strong>
        </span>
        <input type="text" v-model.trim="lastName" :class="{ 'invalid': isInvalid('lastName') }" name="lastName" placeholder="Last Name">
        <span class="help-block" v-if="isInvalid('lastName')">
            <strong>Last Name is required.</strong>
        </span>
        <input type="text" v-model.trim="wineryName" :class="{ 'invalid': isInvalid('wineryName') }" name="wineryName" placeholder="Winery Name">
        <span class="help-block" v-if="isInvalid('wineryName')">
            <strong>Winery Name is required.</strong>
        </span>
        <input type="email" v-model.trim="email" :class="{ 'invalid': isInvalid('email') || validEmail===false, 'valid': validEmail }" name="email" placeholder="Email">
        <span class="help-block" v-if="isInvalid('email')">
            <strong>Email is invalid.</strong>
        </span>
        <input type="password" v-model="password" :class="{ 'invalid': isInvalid('password') }" name="password" placeholder="Password">
        <span class="help-block" v-if="isInvalid('password')">
            <strong>Password is invalid.</strong>
        </span>
        <input type="text" v-model.trim="phone" :class="{ 'invalid': isInvalid('phone') }" name="phone" placeholder="Phone">
        <span class="help-block" v-if="isInvalid('phone')">
            <strong>Phone is invalid.</strong>
        </span>
        <div class="form-check">
            <input class="form-check-input" v-model="acceptTerms" type="checkbox" name="acceptTerms" id="defaultCheck1">
            <label class="form-check-label" :class="{ 'invalid': isInvalid('acceptTerms') }" for="defaultCheck1">
                I agree to <a href="#">Terms and Conditions</a> of the Wine Boutique*
            </label>
        </div>
        <span class="help-block" v-if="isInvalid('acceptTerms')">
            <strong>You must accept Terms and Conditions.</strong>
        </span>
        <div class="form-check">
            <input class="form-check-input" v-model="acceptAge" type="checkbox" name="acceptAge" id="defaultCheck2">
            <label class="form-check-label" :class="{ 'invalid': isInvalid('acceptAge') }" for="defaultCheck2">
                I am at least 21 years of age.*
            </label>
        </div>
        <span class="help-block" v-if="isInvalid('acceptAge')">
            <strong>You must be 21 or older.</strong>
        </span>
        <div id="over-21" v-if="acceptAge">
            <input type="date" name="birthday" v-model="birthday"  :max="initialDate()"/>
        </div>
        <input type="submit" name="submit" class="button red-button full-width" value="CREATE A WINERY">
    </form>
</template>

<script>
    import { required, minLength, email, numeric } from 'vuelidate/lib/validators';
    import { isTrue } from "../../customValidators";
    import moment from 'moment';

    const formFields = [
        'firstName',
        'lastName',
        'wineryName',
        'email',
        'password',
        'phone',
        'acceptTerms',
        'acceptAge',
        'birthday'
    ];

    export default {
        data: () => ({
            firstName: '',
            lastName: '',
            wineryName: '',
            email: '',
            password: '',
            phone: '',
            acceptTerms: false,
            acceptAge: false,
            birthday: '',
            csrf: window.Laravel.csrfToken,
            showErrors: false,
            validEmail: null
        }),
        watch: {
            'email': 'checkEmail'
        },
        methods: {
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
            onSubmit(event) {
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
            },
            isInvalid(name) {
                console.log(name, this.$v[name]);
                return this.$v[name].$invalid && this.showErrors;
            },
            initialDate(){
                let date = new Date();
                date.setFullYear(date.getFullYear() - 21);

                return moment(date).format('Y-MM-DD');
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
            acceptTerms: {
                isTrue
            },
            acceptAge: {
                isTrue
            },
            birthday: {
                required
            }
        }
    }
</script>
