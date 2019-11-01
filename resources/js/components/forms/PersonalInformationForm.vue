<template>
    <div class="info-box shadow-box">
        <div>
            <h2>PERSONAL INFORMATION</h2>
            <div class="edit-button" v-on:click="toggleEditing"><i class="far fa-edit"></i>{{editing?'Save':'Edit'}}</div>
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
                    <td class="edit-text">
                        <datepicker id="datepicker" name="birthday" v-if="editing" minimum-view="day" :disabled-dates="disabledDates" :value="birthday" @selected="seletedBirthday" :typeable="true" :open-date="focusedDate"></datepicker>
                        <span v-else>{{birthday?getFormattedDate(birthday):'No birthday selected.'}}</span>
                    </td>
                </tr>
                <tr>
                    <td>Email address:</td>
                    <td class="edit-text">
                        <span>{{email}}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import { required, minLength, email } from 'vuelidate/lib/validators';
    import Datepicker from 'vuejs-datepicker';
    import moment from 'moment';

    const formFields = [
        'firstName',
        'lastName',
        'email',
        'birthday'
    ];

    export default {
        props: ['user'],
        data: () => ({
            firstName: '',
            lastName: '',
            email: '',
            birthday: null,
            editing: false,
            disabledDates: {
                from: new Date(new Date().setFullYear(new Date().getFullYear() - 21))
            },
            focusedDate: null
        }),
        created: function() {
            const user = JSON.parse(this.user);
            this.firstName = user.firstName;
            this.lastName = user.lastName;
            this.email = user.email;
            if(user.birthday) this.birthday = new Date(user.birthday);
            let d = new Date();
            d.setFullYear(d.getFullYear()-22);
            this.focusedDate = d;
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
                            this.editing = !this.editing;
                        })
                        .catch(error => {
                            console.log("error", error);
                        });
                }
                else{
                    this.editing = !this.editing;
                }
            },
            getFormattedDate(date) {
                return moment(date).format('MM/DD/Y');
            },
            seletedBirthday(date) {
                this.birthday = date;
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
        },
        components: {
            Datepicker
        }
    }
</script>
