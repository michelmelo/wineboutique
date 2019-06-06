<template>
    <div class="subscription-form forms">
        <div class="error-block" v-if="err.email">{{err.email}}</div>
        <input type="email" v-model.trim="dat.email" :class="{ 'invalid': isInvalid('dat.email') }" name="email" placeholder="Email">
        <div class="error-block" v-if="err.state">{{err.state}}</div>
        <select name="state" id="state" v-model="dat.state" class="w-100">
            <option value="" selected disabled hidden>Select state</option>
            <option v-for="region in regions" v-bind:key="region.id" v-bind:value="region.id">{{region.name}}</option>
        </select>
        <button name="submit" class="button red-button full-width" v-on:click="onSubmit" >SIGN UP</button>
        <transition name="fade">
            <div class="newsletter-popup is-visible" role="alert" v-if="activePopup">
                <div class="popup-container">
                    <div class="popup-head">
                      <h2 class="text-center"><strong>THANK YOU!</strong></h2>
                    </div>
                    <div class="popup-body text-center">
                        <p class="mb-5 h4 mx-auto">Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content.</p>
                        <span class="button red-button mt-5" @click="activePopup = !activePopup"><i class="fas fa-times mr-2"></i> CLOSE</span>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    let processing = false;
    export default {
        data: () => ({
            dat: {
                email: '',
                state: '',
            },
            err: {
                email: false,
                state: false,
            },
            email1: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            activePopup: false,
            regions: null,
        }),
        created() {
            this.fetchRegions();
        },

        methods: {
            onSubmit(event) {
                if(processing) return;
                processing = true;
                this.resetError();
                if(this.dat.email===null||this.dat.email==='') {
                    this.err.email = 'Undefined email.';
                    processing = false;
                    return;
                } else if(!this.validEmail(this.dat.email)) {
                    this.err.email = 'Invalid email address.';
                    processing = false;
                    return;
                } else if(this.dat.state===null||this.dat.state==='') {
                    this.err.state = 'You must select state.';
                    processing = false;
                    return;
                }
                axios.post('/newsletter', this.dat)
                    .then(response => {
                        if(response.status==200) {
                            this.resetFields();
                            this.activePopup = true;
                        }
                        processing = false;
                    })
                    .catch(error => {
                        console.log(error);
                        processing = false;
                        }
                    );
            },
            isInvalid(name) {
                let nam = name.split('.')[1];
                return this.dat[nam].$invalid;
            },
            resetFields() {
                this.dat.email = '';
                this.dat.state = '';
            },
            fetchRegions() {
                this.regions = [];
                axios.get('/states')
                    .then(response => {
                        this.regions = response.data;
                    })
                    .catch(error => {
                        console.log("error", error);
                    });
            },
            validEmail: function (email) {
                const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            resetError() {
                this.err.email = false;
                this.err.state = false;
            }
        },
    }
</script>