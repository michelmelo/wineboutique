<template>
    <div class="col-md-12 col-sm-12">
        <h1>{{ wineryName }} - edit info</h1>
        <form v-on:submit="onSubmit" method="post" action="my-winery-store">
            <input type="hidden" name="_token" v-model="csrf">
            <input type="hidden" name="wineryId" :value="wineryId">
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
                            <p>{{wineryName}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <button type="submit" class="red-button button float-right">UPDATE</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['wineryName', 'wineryId', 'wineryDesc', 'wineryProfile', 'wineryCover'],
        data: () => ({
            csrf: window.Laravel.csrfToken,
            profile: this.wineryProfile,
            defaultProfilePhoto: '/img/winery-logo-1.jpg',
            cover: this.wineryCover,
            defaultCoverPhoto: '/img/winery-1.jpg',
            description: '',
            publicPath: process.env.BASE_URL,
            errors: {}
        }),
        methods: {
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
