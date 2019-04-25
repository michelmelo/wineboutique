<template>
    <div class="col-md-12 col-sm-12">
        <form v-on:submit="onSubmit" method="post" action="/startup">
            <input type="hidden" name="_token" v-model="csrf">
            <div class="shadow-box row" v-show="step===1">
                <h2>NAME YOUR WINERY</h2>
                <div class="col-lg-3 col-sm-12"></div>
                <div class="col-lg-6 col-sm-12 enter-name">
                    <input type="text" placeholder="Enter your winery name" v-model.trim="wineryName" name="wineryName" :class="{ 'invalid': isInvalid('wineryName') }">
                    <div class="name-check"><i class="fas fa-check"></i></div>
                </div>
                <div class="col-lg-3 col-sm-12"></div>
            </div>

            <div class="shadow-box row" v-show="step===1">
                <h2>WINERY PREFERENCES</h2>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12 winery-preferences">
                    <table>
                        <tr>
                            <td>Winery state *</td>
                            <td>
                                <select class="half-select" v-model="regions" v-bind:disabled="fetchedRegions.length===0" name="regions[]" :class="{ 'invalid': isInvalid('regions') }" multiple>
                                    <option disabled hidden value="">Select</option>
                                    <option v-for="region in fetchedRegions" v-bind:value="region.id" v-bind:key="region.id">
                                        {{ region.name }}
                                    </option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>
            <div class="shadow-box row" v-show="step===1">
                <h2>WINERY DESCRIPTION</h2>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12">
                    <textarea style="width: 100%; min-height: 150px;" name="description" v-model.trim="description"></textarea>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <div class="shadow-box row" v-show="step===1">
                <h2>WINERY APPEARANCE</h2>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12">
                    <div class="col-lg-12 wineries-box">
                        <div>
                            <div class="wineries-brand">
                                <label class="winery-header uploader" v-bind:style="'background-image: url('+getCoverPhoto()+')'">
                                    <input type="file" @change="handlePhotoChange" accept="image/*" data-type="cover" />
                                </label>
                                <label class="winery-logo uploader" v-bind:style="'background-image: url('+getProfilePhoto()+')'">
                                    <input type="file" @change="handlePhotoChange" accept="image/*" data-type="profile" />
                                </label>
                            </div>
                            <p>{{wineryName}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <button type="button" class="red-button button float-right" v-on:click.stop.prevent="setStep(2)" v-show="step===1">NEXT STEP</button>

            <button type="button" class="red-button button float-left" v-on:click.stop.prevent="setStep(1)" v-show="step===2">PREVIOUS STEP</button>
            <button type="submit" class="red-button button float-right" v-show="step===2">FINISH</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['wineryName'],
        data: () => ({
            csrf: window.Laravel.csrfToken,
            fetchedRegions: [],
            regions: [],
            wines: [],
            currentlyEditing: 0,
            step: 1,
            profile: null,
            defaultProfilePhoto: '/img/winery-logo-1.jpg',
            cover: null,
            defaultCoverPhoto: '/img/winery-1.jpg',
            description: "",
            errors: {}
        }),
        created() {
            this.fetchRegions();
        },
        methods: {
            fetchRegions() {
                this.fetchedRegions = [];
                axios.get('/api/regions')
                    .then(response => {
                        this.fetchedRegions = response.data;
                    })
                    .catch(error => {
                        console.log("error", error);
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
            cloneWine(wineId) {
                axios.post(`/wine/clone/${wineId}`)
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

                    const type = e.target.dataset.type;

                    axios.post(`/winery/${type}`, data)
                        .then(response => {
                            this[type] = response.data.photo;
                        })
                        .catch(error => {
                            console.log("error", error);
                        });
                }
            },
            setStep(step) {
                this.errors = {};
                if(this.step===1 && step===2) {
                    if(this.wineryName.length<3) this.errors['wineryName'] = 'You must enter winery name.';
                    if(this.regions.length===0) this.errors['regions'] = 'You must select at least 1 region.';

                    if(Object.keys(this.errors).length > 0) return;
                }

                this.step = step;
                window.scrollTo(0,0);
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
                return this.profile?`/storage/images/wineries/profile/${this.profile}`:this.defaultProfilePhoto;
            },
            getCoverPhoto() {
                return this.cover?`/storage/images/wineries/cover/${this.cover}`:this.defaultCoverPhoto;
            }
        }
    }
</script>
