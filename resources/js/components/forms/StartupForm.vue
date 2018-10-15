<template>
    <div class="col-md-12 col-sm-12">
        <form v-on:submit="onSubmit" method="post" action="/startup">
            <input type="hidden" name="_token" v-model="csrf">
            <div class="shadow-box row">
                <h2>NAME YOUR WINERY</h2>
                <div class="col-lg-3 col-sm-12"></div>
                <div class="col-lg-6 col-sm-12 enter-name">
                    <input type="text" placeholder="Enter your winery name" v-model="wineryName" name="wineryName" :class="{ 'invalid': isInvalid('wineryName') }">
                    <div class="name-check"><i class="fas fa-check"></i></div>
                </div>
                <div class="col-lg-3 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>WINERY PREFERENCES</h2>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12 winery-preferences">
                    <table>
                        <tr>
                            <td>Winery language *</td>
                            <td>
                                <select class="half-select" v-model="language" v-bind:disabled="languages.length===0" name="language" :class="{ 'invalid': isInvalid('language') }">
                                    <option disabled hidden value="">Select</option>
                                    <option v-for="language in languages" v-bind:value="language.id">
                                        {{ language.name }}
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Winery country *</td>
                            <td>
                                <select class="half-select" v-model="country" v-bind:disabled="countries.length===0" name="country" :class="{ 'invalid': isInvalid('country') }">
                                    <option disabled hidden value="">Select</option>
                                    <option v-for="country in countries" v-bind:value="country.id">
                                        {{ country.name }}
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Winery currecy *</td>
                            <td>
                                <select class="half-select" v-model="currency" v-bind:disabled="currencies.length===0" name="currency" :class="{ 'invalid': isInvalid('currency') }">
                                    <option disabled hidden value="">Select</option>
                                    <option v-for="currency in currencies" v-bind:value="currency.id">
                                        {{ currency.name }}
                                    </option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>INVENTORY UPLOAD</h2>
                <div class="col-lg-12 col-sm-12 inventory">
                    <div class="row">

                        <label class="col-xs-5 vine-box-style-3 style-3-2 add-wine">
                            <input type="file" @change="handleFileChange" accept="image/*" />
                            <a>
                                <div class="image-container">
                                    <img src="/img/add-wine.jpg">
                                </div>
                            </a>
                        </label>

                        <div class="col-xs-5 vine-box-style-3 style-3-2" v-for="wine in wines" v-click-outside="disableEditing(wine.id)">
                            <div class="inv-container">
                                <div class="image-container">
                                    <img v-bind:src="wine.photo">
                                    <div class="delete-copy">
                                        <a href="#" v-on:click.stop.prevent="deleteWine(wine.id)"><i class="fas fa-times"></i> <span>DELETE</span></a>
                                        <a href="#" v-on:click.stop.prevent="cloneWine(wine.id)"><i class="far fa-copy"></i> <span>COPY</span></a>
                                    </div>
                                </div>
                                <input type="text" v-model="wine.name" v-if='currentlyEditing === wine.id'/>
                                <h5 v-else v-on:click="setEditing(wine.id)">{{wine.name.length?wine.name:'Name Of The Wine'}}</h5>
                                <input type="number" v-model="wine.price" v-if='currentlyEditing === wine.id'/>
                                <h4 v-else v-on:click="setEditing(wine.id)">{{ (wine.price || 0) | currency(getCurrencySymbol()) }}</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <button type="submit" class="red-button button float-right">NEXT STEP</button>
        </form>
    </div>
</template>

<script>
    import { required, minLength, numeric } from 'vuelidate/lib/validators';

    const formFields = [
        'wineryName',
        'language',
        'country',
        'currency'
    ];

    export default {
        props: ['wineryName'],
        data: () => ({
            csrf: window.Laravel.csrfToken,
            countries: [],
            languages: [],
            currencies: [],
            country: "",
            language: "",
            currency: "",
            wines: [],
            currentlyEditing: 0,
            showErrors: false,
            csrf: window.Laravel.csrfToken
        }),
        created() {
            this.fetchCountries();
            this.fetchLanguages();
            this.fetchCurrencies();
        },
        methods: {
            fetchCountries() {
                this.cities = [];
                axios.get('/api/countries')
                    .then(response => {
                        this.countries = response.data;
                    })
                    .catch(error => {
                        console.log("error", error);
                    });
            },
            fetchLanguages() {
                this.cities = [];
                axios.get('/api/languages')
                    .then(response => {
                        this.languages = response.data;
                    })
                    .catch(error => {
                        console.log("error", error);
                    });
            },
            fetchCurrencies() {
                this.cities = [];
                axios.get('/api/currencies')
                    .then(response => {
                        this.currencies = response.data;
                    })
                    .catch(error => {
                        console.log("error", error);
                    });
            },
            getCurrencySymbol() {
                if(this.currency.length === 0) {
                    return '$';
                }

                const selectedCurrency = _.find(this.currencies, {id: this.currency});

                return selectedCurrency.symbol || selectedCurrency.acronym;
            },
            setEditing(wineId) {
                this.currentlyEditing = wineId;
            },
            disableEditing(wineId) {
                return (event) => {
                    if(this.currentlyEditing===wineId) {
                        this.currentlyEditing = 0;
                        const wine = _.find(this.wines, {id: wineId});
                        axios.post(`/wine/update/${wineId}`, wine)
                            .then(response => {
                            })
                            .catch(error => {
                                console.log("error", error);
                            });
                    }
                }
            },
            deleteWine(wineId) {
                axios.delete(`/wine/delete/${wineId}`)
                    .then(response => {
                        this.wines = this.wines.filter(wine => wine.id!==wineId);
                    })
                    .catch(error => {
                        console.log("error", error);
                    });
            },
            cloneWine(wineId) {
                axios.post(`/wine/clone/${wineId}`)
                    .then(response => {
                        this.wines = [...this.wines, {
                            photo: '/'+response.data.photo.replace('public', 'storage'),
                            name: '',
                            price: 0,
                            id: response.data.id
                        }];
                    })
                    .catch(error => {
                        console.log("error", error);
                    })
            },
            handleFileChange(e) {
                if(e.target.files && e.target.files.length) {
                    const file = e.target.files[0];

                    if(file.type.indexOf('image/')!==0) {
                        return console.log('Selected file must be an image!');
                    }

                    let data = new FormData();
                    data.append('photo', file);

                    axios.post('/wine/store', data)
                        .then(response => {
                            this.wines = [...this.wines, {
                                photo: '/'+response.data.photo.replace('public', 'storage'),
                                name: '',
                                price: 0,
                                id: response.data.id
                            }];
                        })
                        .catch(error => {
                            console.log("error", error);
                        });
                }
            },
            onSubmit() {
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
                return this.$v[name].$invalid && this.showErrors;
            }
        },
        validations: {
            wineryName: {
                required,
                minLength: minLength(4)
            },
            language: {
                required,
                numeric
            },
            country: {
                required,
                numeric
            },
            currency: {
                required,
                numeric
            }
        }
    }
</script>
