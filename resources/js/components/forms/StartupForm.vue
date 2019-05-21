<template>
    <div class="col-md-12 col-sm-12">
        <form v-on:submit="onSubmit" method="post" action="/startup">
            <input type="hidden" name="_token" v-model="csrf">
            <div class="shadow-box row">
                <h2>NAME YOUR WINERY</h2>
                <div class="col-lg-3 col-sm-12"></div>
                <div class="col-lg-6 col-sm-12 enter-name">
                    <input type="text" placeholder="Enter your winery name" v-model.trim="name" name="wineryName" :class="{ 'invalid': isInvalid('name') }" min="4" required>
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
                            <td>Winery state *</td>
                            <td>
                                <select class="half-select" v-model="regions" v-bind:disabled="fetchedRegions_.length===0" name="regions[]" :class="{ 'invalid': isInvalid('regions') }" multiple required>
                                    <option disabled hidden value="">Select</option>
                                    <option v-for="region in fetchedRegions_" v-bind:value="region.id" v-bind:key="region.id">
                                        {{ region.name }}
                                    </option>
                                </select>
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
                    <textarea style="width: 100%; min-height: 150px;" name="description" v-model.trim="description" minlength="10" required></textarea>
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

            <button type="submit" class="red-button button float-right">FINISH</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['wineryName', 'wineryId', "wineryDesc", "wineryProfile", "wineryCover", "selectedRegions", "fetchedRegions"],
        data: () => ({
            csrf: window.Laravel.csrfToken,
            fetchedRegions_: [],
            regions: [],
            wines: [],
            currentlyEditing: 0,
            defaultProfilePhoto: '/img/winery-logo-1.jpg',
            defaultCoverPhoto: '/img/winery-1.jpg',
            errors: {},
            profile: null,
            cover: null,
            name: null,
            description: null
        }),
        created() {
            this.fetchedRegions_ = JSON.parse(this.fetchedRegions);
            this.description = this.wineryDesc;
            this.profile = this.wineryProfile;
            this.cover = this.wineryCover;
            this.regions = JSON.parse(this.selectedRegions);
            this.name = this.wineryName;
        },
        methods: {
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
            onSubmit() {
                this.errors = {};
                if(this.name.length<3) this.errors['name'] = 'You must enter winery name.';
                if(this.regions.length===0) this.errors['regions'] = 'You must select at least 1 region.';

                if(this.description.length < 10) this.errors['description'] = 'You must enter at least 10 characters.';
                if(Object.keys(this.errors).length > 0) return false;
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
