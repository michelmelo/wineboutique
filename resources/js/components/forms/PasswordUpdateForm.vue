<template>
    <div class="info-box shadow-box">
        <h2>PASSWORD </h2>
        <div class="edit-button" v-on:click="toggleEditing"><i class="far fa-edit"></i>{{editing?'Save':'Edit'}}</div>
        <table>
            <tr v-if="!editing">
                <td>Password:</td>
                <td class="edit-text">*******</td>
            </tr>
            <tr v-if="editing">
                <td>Current password:</td>
                <td class="edit-text">
                    <input name="current_password" v-model="current_password" type="password" :class="{ 'invalid': hasError('current_password') }" />
                    <span class="error-block" v-if="hasError('current_password')">{{getError('current_password')}}</span>
                </td>
            </tr>
            <tr v-if="editing">
                <td>New password:</td>
                <td class="edit-text">
                    <input name="password" v-model="password" type="password" :class="{ 'invalid': hasError('password') }" />
                    <span class="error-block" v-if="hasError('password')">{{getError('password')}}</span>
                </td>
            </tr>
            <tr v-if="editing">
                <td>New password again:</td>
                <td class="edit-text">
                    <input name="password_confirmation" v-model="password_confirmation" type="password" :class="{ 'invalid': hasError('password_confirmation') }" />
                    <span class="error-block" v-if="hasError('password_confirmation')">{{getError('password_confirmation')}}</span>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    import { required, minLength, sameAs } from 'vuelidate/lib/validators';

    const formFields = [
        'current_password',
        'password',
        'password_confirmation'
    ];

    export default {
        data: () => ({
            editing: false,
            current_password: '',
            password: '',
            password_confirmation: '',
            showErrors: false,
            errors: {}
        }),
        created: function() {
        },
        methods: {
            toggleEditing() {
                if(this.editing) {
                    this.showErrors = true;
                    this.errors = {};
                    if(this.$v.$invalid) {
                        formFields.some(formField => {
                            if(this.$v[formField].$invalid) {
                                document.querySelector(`[name="${formField}"]`).focus();
                                return true;
                            }
                            return false;
                        });
                        return false;
                    }

                    const data = _.pick(this, formFields);

                    axios.post('/profile/password', data)
                        .then(response => {
                            this.showErrors = false;
                            this.editing = false;
                        })
                        .catch(error => {
                            if(error.response && error.response.data && error.response.data.errors) {
                                this.errors = error.response.data.errors;
                            }
                        });
                } else {
                    this.editing = true;
                }
            },
            hasError(name) {
                return (this.$v[name].$invalid || this.errors[name]) && this.showErrors;
            },
            getError(name) {
                if(this.errors[name]) {
                    return this.errors[name][0];
                } else {
                    const model = this.$v[name];

                    if(!!model.$params.required && !model.required) {
                        return 'This field is required';
                    }

                    if(!!model.$params.minLength && !model.minLength) {
                        return `This field must have at least ${model.$params.minLength.min} characters.`;
                    }

                    if(!!model.$params.sameAs && !model.sameAs) {
                        return `This field and ${model.$params.sameAs.eq} must be identical.`;
                    }
                }
            }
        },
        validations: {
            current_password: {
                required
            },
            password: {
                required,
                minLength: minLength(6)
            },
            password_confirmation: {
                sameAs: sameAs('password')
            }
        }
    }
</script>
