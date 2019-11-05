<template>
    <div class="col-md-12 col-sm-12">
        <h1>{{ wineryName }} - edit info</h1>
        <form v-on:submit="onSubmit" method="post" action="my-winery-store">
            <input type="hidden" name="_token" v-model="csrf">
            <input type="hidden" name="wineryId" :value="wineryId">

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
                <h2>WINERY DESCRIPTION</h2>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12">
                    <textarea style="width: 100%; min-height: 150px;" name="description" >{{ wineryDesc }}</textarea>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>WINERY APPEARANCE</h2>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12">
                    <div class="col-lg-12 wineries-box">
                        <div>
                            <div class="wineries-brand">
                                <label class="winery-header uploader" v-bind:style="'background-image: url(' + getCoverPhoto() + ')'">
                                    <input type="file" @change="handlePhotoChange" accept="image/*" data-type="cover" />
                                </label>
                            </div>
                            <div class="wineries-brand">
                                <label class="winery-logo uploader" v-bind:style="'background-image: url(' + getProfilePhoto() + ')'">
                                    <input type="file" @change="handlePhotoChange" accept="image/*" data-type="profile" />
                                </label>
                            </div>
                            <p class="winery-title">{{wineryName}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>SHIPPING</h2>

                <div class="row form-inputs shipping-item-wrapper" v-for="(item, index) in existingShippings_" v-bind:key="item.id">
                    <div class="col-lg-3 col-sm-12">
                        <p>Shipping origin *</p>
                    </div>
                    <div class="col-lg-9 col-sm-12">
                        <select id="location" :name="'shipping[' + index + '][ship_from]'" class="location" v-model="item.ship_from">
                            <option value="0" disabled selected>Select location</option>
                            <option v-for="region in fetchedRegions_" v-bind:value="region.id" v-bind:key="region.id">
                                {{ region.name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-lg-3 col-sm-12">
                        <p>Processing time *</p>
                    </div>

                    <div class="col-6 col-lg-4 shipping-time">
                        <input type="number" min="0" :name="'shipping[' + index + '][days_from]'" placeholder="From" class="from" v-model="item.days_from">
                    </div>

                    <div class="col-6 col-lg-4 shipping-time">
                        <input type="number" min="0" :name="'shipping[' + index + '][days_to]'" placeholder="To" class="to" v-model="item.days_to">
                    </div>

                    <div class="col-lg-3 col-sm-12">
                        <p>Fixed shipping costs *</p>
                    </div>

                    <div class="col-lg-3 col-sm-12" v-if="!item.is_template">
                        <select :name="'shipping[' + index + '][ship_to]'" class="destination" v-model="item.ship_to">
                            <option value="0" disabled selected>Add a destination</option>
                            <option v-for="region in fetchedRegions_" v-bind:value="region.id" v-bind:key="region.id">
                                {{ region.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-sm-12" v-else>
                        <multiselect v-model="item.ship_to" :options="fetchedRegions_.map(person => ({ value: person.id, text: person.name }))"
                                     label="text"
                                     track-by="value"
                                     :hideSelected="true"
                                     :multiple="true"
                                     :close-on-select="false"
                                     :clear-on-select="false"
                                     :preserve-search="true"
                                     @input="refineValues"
                        ></multiselect>

                        <input v-for="item in ship_to_values" type="hidden" :name="'shipping[' + index + '][ship_to][]'" :value="item">
                    </div>

                    <div class="col-lg-3 col-sm-12 show_hide">
                        <input type="number" min="0"  :name="'shipping[' + index + '][price]'" class="usd-input price" placeholder="One item"  v-model="item.price" >
                        <div class="usd">USD</div>
                    </div>

                    <div class="col-lg-3 col-sm-12 show_hide">
                        <input type="number" min="0"  :name="'shipping[' + index + '][additional]'" class="usd-input additional" placeholder="Each additional" v-model="item.additional" >
                        <div class="usd" >USD</div>
                    </div>

                    <div class="col-lg-9 col-lg-push-3 col-sm-12">
                        <input type="checkbox" :name="'shipping[' + index + '][shipping_free]'" :id="'shipping_free' + index" class="css-checkbox shipping-check" v-on:click="toggle_free_shipping(item)"/>
                        <label :for="'shipping_free' + index" class="css-label lite-red-check">Free shipping</label>

                        <a :href="'/my-winery-shipping/delete/' + item.id" v-if="!item.is_template" style="float: right">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <input type="hidden" :name="'shipping[' + index + '][id]'" v-model="item.id">
                        <hr>
                    </div>
                </div>
            </div>

            <button type="button" class="red-button button float-left" v-on:click="addMoreShippings" >ADD STATES</button>
            <button type="submit" class="red-button button float-right">UPDATE</button>
        </form>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    Vue.component('multiselect', Multiselect);

    export default {
        components: { Multiselect },
        props: ['wineryName', 'wineryId', 'wineryDesc', 'wineryProfile', 'wineryCover', 'fetchedRegions', 'existingShippings', 'selectedRegions'],
        data: () => ({
            csrf: window.Laravel.csrfToken,
            profile: null,
            fetchedRegions_: [],
            existingShippings_: [],
            defaultProfilePhoto: '/img/winery-logo-1.jpg',
            cover: null,
            defaultCoverPhoto: '/img/winery-1.jpg',
            description: null,
            publicPath: process.env.BASE_URL,
            errors: {},
            name: null,
            regions: [],
            ship_to_values: []
        }),created() {
            this.description = this.wineryDesc;
            this.profile = this.wineryProfile;
            this.cover = this.wineryCover;
            this.fetchedRegions_ = JSON.parse(this.fetchedRegions);
            this.existingShippings_ = JSON.parse(this.existingShippings);
            this.regions = JSON.parse(this.selectedRegions);
            this.name = this.wineryName;

            if(this.existingShippings_.length == 0){
                this.addMoreShippings();
            }
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
                this.existingShippings_.push({
                    ship_from: 0,
                    days_from: "",
                    days_to: "",
                    ship_to: [],
                    price: "",
                    is_free_shipping: false,
                    is_template: true
                });
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
                                photo: response.data.photo,
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
            onSubmit() {
                this.errors = {};
                if(this.description.length < 10) {
                    this.errors['description'] = 'You must enter at least 10 characters.';
                    return false;
                }
            },
            isInvalid(name) {
                return this.errors[name];
            },
            getProfilePhoto() {
                return this.profile?`/images/winery/profile/${this.profile}`:this.defaultProfilePhoto;
            },
            getCoverPhoto() {
                return this.cover?`/images/winery/cover/${this.cover}`:this.defaultCoverPhoto;
            }
        }
    }
</script>
