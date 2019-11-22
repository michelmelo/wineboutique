<template>
    <div class="col-md-12 col-sm-12">
        <form method="post" action="/startup" id="startup-form">
            <input type="hidden" name="_token" v-model="csrf">
            <div class="shadow-box row">
                <h2>NAME YOUR WINERY <i class="fas fa-info-circle popup-info-trigers" ></i></h2>
                <span class="popup-info d-none">This is your brand name that will be visible to all users on Wine Boutique.</span>
                <div class="col-lg-3 col-sm-12"></div>
                <div class="col-lg-6 col-sm-12 enter-name">
                    <input type="text" placeholder="Enter your winery name" v-model.trim="name" name="wineryName" :class="{ 'invalid': isInvalid('name') }" min="4">
                    <div class="name-check"><i class="fas fa-check"></i></div>
                </div>
                <div class="col-lg-3 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>WINERY PREFERENCES <i class="fas fa-info-circle popup-info-trigers" ></i></h2>
                <span class="popup-info d-none">Please select your winery state where your winery is located.</span>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12 winery-preferences">
                    <table>
                        <tr>
                            <td>Winery state *</td>
                            <td>
                                <select class="half-select" v-model="regions" v-bind:disabled="fetchedRegions_.length===0" name="regions[]" :class="{ 'invalid': isInvalid('regions') }" multiple>
                                    <option disabled hidden value="">Select</option>
                                    <option v-for="region in fetchedRegions_" v-bind:value="region.id" v-bind:key="region.id">
                                        {{ region.name }}
                                    </option>
                                </select>
                                <span class="help-block error-block" v-if="isInvalid('regions')">
                                    <strong>Winery state is required.</strong>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>WINERY DESCRIPTION <i class="fas fa-info-circle popup-info-trigers" ></i></h2>
                <span class="popup-info d-none"> Please provide a detailed description of your winery. This description will be visible on your wine pages, your winery page and anywhere that has information regarding your winery.</span>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12">
                    <textarea style="width: 100%; min-height: 150px;" name="description" v-model.trim="description" minlength="10" :class="{ 'invalid': isInvalid('description') }"></textarea>
                    <span class="help-block error-block" v-if="isInvalid('description')">
                        <strong>Winery description is required.</strong>
                    </span>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>WINERY OWNER LAST 4 SSN NUMBERS <i class="fas fa-info-circle popup-info-trigers" ></i></h2>
                <span class="popup-info d-none">This information is required for billing. Please ensure to provide the last 4 SSN numbers from the winery owner and billing account holder.</span>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12 enter-name">
                    <input type="text" name="ssn" maxlength="4" v-model="ssn"  :class="{ 'invalid': isInvalid('ssn') }">
                    <span class="help-block error-block" v-if="isInvalid('ssn')">
                        <strong>Winery ssn number is required.</strong>
                    </span>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>WINERY OWNER CREDIT CARD <i class="fas fa-info-circle popup-info-trigers" ></i></h2>
                <span class="popup-info d-none">This is the credit card that will receive payments and purchases from customers. Please ensure that you provide the correct credit card number as Wine Boutique will not be responsible for incorrect details.</span>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12 enter-name">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>
                <div class="col-lg-2 col-sm-12"></div>

                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12 enter-name">
                    <input type="text" name="alias" class="StripeElement" placeholder="Card alias" required>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>WINERY APPEARANCE <i class="fas fa-info-circle popup-info-trigers" ></i></h2>
                <span class="popup-info d-none">Please upload a cover photo and a profil picture for your winery. This will be visible anywhere where a user can see your winery.</span>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12">
                    <div class="col-lg-12 wineries-box">
                        <div>
                            <div class="wineries-brand"  :class="{ 'invalid': isInvalid('cover') }"
                            v-bind:style="'background-image: url(' + getCoverPhoto() + ')'">
                                <div class="cover-info">
                                    <p v-if="!getCoverPhoto()">Chose cover image</p>
                                </div>
                                <label class="winery-header uploader" v-model="cover" >
                                    <input type="file" @change="handlePhotoChange" accept="image/*" data-type="cover" />
                                </label>
                            </div>
                            <div class="wineries-brand">
                                <label class="winery-logo uploader" v-bind:style="'background-image: url(' + getProfilePhoto() + ')'">
                                    <input type="file" @change="handlePhotoChange" accept="image/*" data-type="profile" />
                                </label>
                            </div>
                            <p class="winery-title">{{wineryName}}</p>
                            <span class="help-block error-block" v-if="isInvalid('cover')">
                                <strong>Winery cover and logo are required.</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>SHIPPING  <i class="fas fa-info-circle popup-info-trigers" ></i></h2>
                <span class="popup-info d-none">Please select the states that you wish to ship your wine products to. You have the availability to set specific shipping prices depending on what states you are shipping to.</span>

                <div class="row form-inputs shipping-item-wrapper" v-for="(item, index) in shippings">
                    <div class="col-lg-3 col-sm-12">
                        <p>Shipping origin *</p>
                    </div>
                    <div class="col-lg-9 col-sm-12">
                        <select id="location" :name="'shipping[' + index + '][ship_from]'" class="location" v-model="item.ship_from">
                            <option value="0" disabled selected>Select location</option>
                            <option v-for="region in fetchedRegions_" v-bind:value="region.id" v-bind:key="region.id" v-if="region.name == 'California'">
                                {{ region.name }}
                            </option>
                        </select>
                          <span class="help-block error-block" v-if="isInvalid('shipping')">
                                    <strong>You must select shipping origin .</strong>
                                </span>
                    </div>


<!--                    <input type="hidden" :name="'shipping[' + index + '][days_from]'" v-model="item.days_from">-->
<!--                    <input type="hidden" :name="'shipping[' + index + '][days_to]'" v-model="item.days_to">-->

                    <div class="col-lg-3 col-sm-12">
                        <p>Fixed shipping costs *</p>
                    </div>

                    <div class="col-lg-3 col-sm-12">
                       <multiselect v-if="!chacked" v-model="item.ship_to" :options="fetchedRegions_.map(person => ({ value: person.id, text: person.name }))"
                                     label="text"
                                     track-by="value"
                                     :hideSelected="true"
                                     :multiple="true"
                                     :close-on-select="false"
                                     :clear-on-select="false"
                                     :preserve-search="true"

                                     @input="refineValues"
                        ></multiselect>
                        <select v-else disabled  placeholder="disabled">
                            <option value="disabled" selected>Free shipping</option>
                        </select>

                        <input v-for="item in ship_to_values" type="hidden" :name="'shipping[' + index + '][ship_to][]'" :value="item">

                        <span class="help-block error-block" v-if="isInvalid('shipping_cost')">
                                    <strong>You must fill in shipping costs.</strong>
                                </span>
                    </div>

                    <div class="col-lg-3 col-sm-12 show_hide">
                        <input :disabled="chacked" type="number" min="0"  :name="'shipping[' + index + '][price]'" class="usd-input price" placeholder="One item" v-model="item.price" >
                        <div class="usd">USD</div>

                        <span class="help-block error-block" v-if="isInvalid('shipping_price')">
                                    <strong>You must enter shipping price.</strong>
                                </span>
                    </div>

                    <div class="col-lg-3 col-sm-12 show_hide">
                        <input :disabled="chacked" type="number" min="0"  :name="'shipping[' + index + '][additional]'" class="usd-input additional" placeholder="Each additional" v-model="item.additional">
                        <div class="usd" >USD</div>
                    </div>

                    <div class="col-lg-9 col-lg-push-3 col-sm-12">
                        <input v-model="chacked" type="checkbox" :name="'shipping[' + index + '][shipping_free]'" :id="'shipping_free' + index" class="css-checkbox shipping-check" v-on:click="toggle_free_shipping(item)"/>
                        <label :for="'shipping_free' + index" class="css-label lite-red-check">Free shipping</label>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <hr>
                    </div>
                </div>
            </div>

            <input type="hidden" name="stripeToken" v-model="stripe">
            <button type="button" class="red-button button float-left" v-on:click="addMoreShippings" >ADD STATES</button>
            <button id="submitForm" type="submit" v-on:click.prevent="onSubmit" class="red-button button float-right">FINISH</button>
        </form>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    Vue.component('multiselect', Multiselect)

    let stripe = Stripe(`pk_test_bWZc4BcEaCNAKbJbhv6u91ZJ00zZEQ2RIQ`),
        elements = stripe.elements(),
        card = undefined;

    export default {
        components: { Multiselect },
        props: ['wineryName', 'wineryId', "wineryDesc", "wineryProfile", "wineryCover", "selectedRegions", "fetchedRegions"],
        data: () => ({
            chacked: false,
            csrf: window.Laravel.csrfToken,
            fetchedRegions_: [],
            ship_to_values: [],
            regions: [],
            shippings: [],
            wines: [],
            currentlyEditing: 0,
            defaultProfilePhoto: '/img/winery-logo-1.jpg',
            defaultCoverPhoto: '/img/winery-1.jpg',
            errors: {},
            profile: null,
            cover: null,
            name: null,
            description: null,
            ssn: null,
            stripe: null,
            is_free_shipping: false
        }),
        created() {
            this.fetchedRegions_ = JSON.parse(this.fetchedRegions);
            this.description = this.wineryDesc;
            this.profile = this.wineryProfile;
            this.cover = this.wineryCover;
            this.ssn = "";
            this.stripe = "";
            this.regions = JSON.parse(this.selectedRegions);
            this.name = this.wineryName;
            this.addMoreShippings();
        },
        mounted: function () {
            card = elements.create('card');
            card.mount("#card-element");
            console.log(this.shippings.length)
        
        },
        methods: {
            refineValues(value){
                var that = this;

                that.ship_to_values = [];

                value.forEach(function(item, index){
                    that.ship_to_values.push(item.value);
                });
            },
            addMoreShippings(){
                this.shippings.push({
                    ship_from: 0,
                    // days_from: "",
                    // days_to: "",
                    ship_to: [],
                    price: ""
                });
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
            handlePhotoChange(e) {
                if(e.target.files && e.target.files.length) {
                    const file = e.target.files[0];

                    if(file.type.indexOf('image/')!==0) {
                        return console.log('Selected file must be an image!');
                    }

                    let data = new FormData();
                    data.append('photo', file);
                    data.append('wid', this.wineryId);

                    const type = e.target.dataset.type;

                    axios.post(`/winery/${type}`, data)
                        .then(response => {
                            if(e.target.dataset.type==='cover') {
                                this.cover = response.data.photo;
                            } else {
                                this.profile = response.data.photo;
                            }
                            vm.$forceUpdate();
                        })
                        .catch(error => {
                            console.log("error", error);
                        });
                }
            },
            toggle_free_shipping(i){
                i.price = 0;
                i.additional = 0;
            },
            onSubmit(e) {
                e.preventDefault();

                var that = this;


                this.errors = {};

                if(this.name.length<3) this.errors['name'] = 'You must enter winery name.';
                if(this.regions.length===0) this.errors['regions'] = 'You must select at least 1 region.';
                if(this.description.length < 10) this.errors['description'] = 'You must enter at least 10 characters.';
                if(this.ssn.length < 4) this.errors['ssn'] = 'You must enter at least 4 digits.';
                if(!this.cover) this.errors['cover'] = 'You must upload cover.';
                this.shippings.forEach((item)=>{
                    if(item.ship_from == 0){
                        this.errors['shipping'] = 'You must select shipping origin .'
                    }
                     if(item.ship_to.length == 0){
                        this.errors['shipping_cost'] = 'You must fill in shipping costs.'
                    }
                    if(!item.price){
                        this.errors['shipping_price'] = 'You must enter shipping price.'
                    }
                });

                if(Object.keys(this.errors).length == 0){
                    stripe.createToken(card).then(function(result) {
                        console.log(result);
                        if (result.error) {
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            that.stripe = result.token.id;

                            that.$el.querySelector("#startup-form").submit();
                        }
                    });
                }else{

                   this.$nextTick(() => {
                        let error = document.querySelectorAll('.error-block');
                 
                 
                
                       if(error.length > 0){
                         error[0].scrollIntoView({behavior: "smooth", block: "end"});
                       }
                    
                   });
               
                }
            },
            isInvalid(name) {
                return this.errors[name];
            },
            getProfilePhoto() {
                return this.profile?`/images/winery/profile/${this.profile}`:this.defaultProfilePhoto;
            },
            getCoverPhoto() {


                return this.cover ? `/images/winery/cover/${this.cover}`: this.defaultCoverPhoto;
            }
        },
    
       
   
    }
</script>
