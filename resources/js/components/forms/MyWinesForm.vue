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
                            <input type="number" v-model="wine.price" v-if='currentlyEditing === wine.id'/>
                            <h4 v-else v-on:click="setEditing(wine.id)">{{ (wine.price || 0) | currency }}</h4>
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
            wines: []
        }),
        created() {
            console.log(this.currentWines);
            this.wines = this.currentWines;
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
            }
        }
    }
</script>
