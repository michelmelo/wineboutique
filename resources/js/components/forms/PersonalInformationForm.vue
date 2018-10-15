<template>
    <div class="info-box shadow-box">
        <h2>PERSONAL INFORMATION <div class="edit-button" v-on:click="toggleEditing"><i class="far fa-edit"></i>{{editing?'Save':'Edit'}}</div></h2>
        <table>
            <tr>
                <td>First Name:</td>
                <td class="edit-text">
                    <input name="firstName" v-model="firstName" v-if="editing" />
                    <span v-else>{{firstName}}</span>
                </td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td class="edit-text">
                    <input name="lastName" v-model="lastName" v-if="editing" />
                    <span v-else>{{lastName}}</span>
                </td>
            </tr>
            <tr>
                <td>Date of birth:</td>
                <td class="edit-text">09/18/1990 /</td>
            </tr>
            <tr>
                <td>Email address:</td>
                <td class="edit-text">
                    <input name="email" v-model="email" v-if="editing" />
                    <span v-else>{{email}}</span>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    import { required, minLength, email } from 'vuelidate/lib/validators';

    const formFields = [
        'firstName',
        'lastName',
        'email'
    ];

    export default {
        props: ['user'],
        data: () => ({
            firstName: '',
            lastName: '',
            email: '',
            editing: false
        }),
        created: function() {
            const user = JSON.parse(this.user);
            this.firstName = user.firstName;
            this.lastName = user.lastName;
            this.email = user.email;
        },
        methods: {
            toggleEditing() {
                if(this.editing) {
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

                    const data = _.pick(this, formFields);

                    axios.post('/profile/update', data)
                        .then(response => {

                        })
                        .catch(error => {
                            console.log("error", error);
                        });
                }

                this.editing = !this.editing;
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
            email: {
                required,
                email
            }
        }
    }
</script>
