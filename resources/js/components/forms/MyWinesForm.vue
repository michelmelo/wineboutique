<template>
    <div class="col-md-12 col-sm-12">
        <div class="shadow-box row">
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
                                <img v-bind:src="'/storage/images/wines/'+wine.photo">
                                <div class="delete-copy">
                                    <a href="#" v-on:click.stop.prevent="deleteWine(wine.id)"><i class="fas fa-times"></i> <span>DELETE</span></a>
                                    <a href="#" v-on:click.stop.prevent="cloneWine(wine.id)"><i class="far fa-copy"></i> <span>COPY</span></a>
                                </div>
                            </div>
                            <input type="text" v-model="wine.name" v-if='currentlyEditing === wine.id'/>
                            <h5 v-else v-on:click="setEditing(wine.id)">{{wine.name&&wine.name.length?wine.name:'Name Of The Wine'}}</h5>
                            <input type="number" v-model="wine.price" v-if='currentlyEditing === wine.id' min="0"/>
                            <h4 v-else v-on:click="setEditing(wine.id)">{{ (wine.price || 0) | currency }}</h4>
                            <select v-model="wine.varietal_id" v-if='currentlyEditing === wine.id' v-bind:disabled="varietals.length===0">
                                <option disabled hidden>Select varietal</option>
                                <option v-for="varietal in varietals" v-bind:value="varietal.id">
                                    {{ varietal.name }}
                                </option>
                            </select>
                            <h4 v-else v-on:click="setEditing(wine.id)">{{getVarietal(wine.varietal_id).name}}</h4>
                            <select v-if='currentlyEditing === wine.id' v-model="wine.region_id" v-bind:disabled="regions.length===0">
                                <option disabled hidden value="">Select region</option>
                                <option v-for="region in regions" v-bind:value="region.id">
                                    {{ region.name }}
                                </option>
                            </select>
                            <h4 v-else v-on:click="setEditing(wine.id)">{{getRegion(wine.region_id).name}}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['currentWines'],
        data: () => ({
            csrf: window.Laravel.csrfToken,
            currentlyEditing: 0,
            wines: [],
            varietals: [],
            regions: []
        }),
        created() {
            this.wines = this.currentWines;
            this.fetchRegions();
            this.fetchVatietals();
        },
        methods: {
            fetchVatietals() {
                this.varietals = [];
                axios.get('/varietals')
                    .then(response => {
                        this.varietals = response.data;
                    })
                    .catch(error => {
                        console.log("error", error);
                    });
            },
            fetchRegions() {
                this.regions = [];
                axios.get('/api/regions')
                    .then(response => {
                        this.regions = response.data;
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
                                varietal_id: null,
                                region_id: null,
                                id: response.data.id
                            }];
                        })
                        .catch(error => {
                            console.log("error", error);
                        });
                }
            },
            getVarietal(varietalId) {
                const varietal = _.find(this.varietals, {id: varietalId});
                if(varietal) return varietal;
                return {name: "No varietal selected"};
            },
            getRegion(regionId) {
                const region = _.find(this.regions, {id: regionId});
                if(region) return region;
                return {name: "No region selected"};
            }
        }
    }
</script>
