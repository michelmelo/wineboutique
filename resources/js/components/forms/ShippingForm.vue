<template>
    <div class="info-box shadow-box">
        <h2>{{ wineryName }} - shipping</h2>
        <form v-on:submit="onSubmit" id="updateForm" method="post" :action="methodAction">
            <input type="hidden" name="_token" v-model="csrf">
            <input type="hidden" name="wineryId" :value="wineryId">

            <div class="row">
                <div class="row form-inputs shipping-item-wrapper" v-for="(item, index) in existingShippings_" v-bind:key="item.id">
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
                          <span class="help-block error-block" v-if="isInvalid('shipping') && item.ship_from == 0">
                                    <strong>You must select shipping origin .</strong>
                                </span>
                    </div>

<!--                    <input type="hidden" :name="'shipping[' + index + '][days_from]'" v-model="item.days_from">-->
<!--                    <input type="hidden" :name="'shipping[' + index + '][days_to]'" v-model="item.days_to">-->

                    <div class="col-12">
                        <p>Fixed shipping costs *</p>
                    </div>
           
                    <div class="col-lg-4 col-sm-12" v-if="!item.is_template">
                        <select :name="'shipping[' + index + '][ship_to]'" class="destination" v-model="item.ship_to">
                            <option value="0" disabled selected>Add a destination</option> 
                            <option v-for="region in fetchedRegions_" v-bind:value="region.id" v-bind:key="region.id"
                                    v-if="item.ship_to == region.id || !duplicateCheck[item.ship_from].includes(region.id) " >
                                {{ region.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-12" v-else>
                        <multiselect  v-model="item.ship_to" :options="duplicateOptions"
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

                        <span class="help-block error-block" v-if="isInvalid('shipping_cost') && item.ship_to.length == 0">
                                    <strong>You must fill in shipping costs.</strong>
                                </span>
                    </div>

                    <div class="col-lg-4 col-sm-12 show_hide">
                        <input  type="number" min="0"  :name="'shipping[' + index + '][price]'" class="usd-input price" placeholder="One item"  v-model="item.price" >
                        <div class="usd">USD</div>

                       
                    </div>

                    <div class="col-lg-4 col-sm-12 show_hide">
                        <input   type="number" min="0"  :name="'shipping[' + index + '][additional]'" class="usd-input additional" placeholder="Each additional" v-model="item.additional" >
                        <div class="usd" >USD</div>
                    </div>

                    <div class="col-12">
                        <input @click="item.price == 0" :checked="item.price == 0" type="checkbox" :name="'shipping[' + index + '][shipping_free]'" :id="'shipping_free' + index" class="css-checkbox shipping-check" v-on:click="toggle_free_shipping(item)"/>
                        <label :for="'shipping_free' + index" class="css-label lite-red-check">Free shipping</label>

                        <a :href="'/my-winery-shipping/delete/' + item.id" v-if="!item.is_template" style="float: right" class="text-red">
                            <i class="fa fa-trash"></i>
                        </a>
                        <a @click="removeState(index , $event)" href="#" v-else style="float: right">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <input type="hidden" :name="'shipping[' + index + '][id]'" v-model="item.id">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="button" class="red-button button float-left" v-on:click="addMoreShippings" >ADD STATES</button>

                    <button type="submit" class="red-button button float-right">UPDATE</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    Vue.component('multiselect', Multiselect);

    export default {
        components: { Multiselect },
        props: ['wineryName', 'wineryId', 'wineryDesc', 'wineryProfile', 'wineryCover', 'fetchedRegions', 'existingShippings', 'selectedRegions', 'methodAction'],
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
        computed: {
         duplicateOptions(){

           let shipOr = this.duplicateCheck[this.existingShippings_[this.existingShippings_.length - 1].ship_from];
            
         
           
          function myFilter(value) {

               if(!shipOr.includes(value.id)){
                 return value;
               }
             }

           

           let options = this.fetchedRegions_.filter(myFilter);
           let newOptions = options.map(person => ({ value: person.id, text: person.name }));
          
          
            return newOptions;
            

          },   
         duplicateCheck(){
           
            let id = { };
            

                this.existingShippings_.forEach((item, index)=>{ 
                 
                 
                    if(id[item.ship_from]){  
                      
                      if(item.ship_to.length){
                         item.ship_to.forEach((value)=>{
                             id[item.ship_from].push(value.value);
                         })
                      }else{                    
                                      

                        id[item.ship_from].push(item.ship_to);
                      }   
                       

                    }else{

                        id[item.ship_from] = [];

                        if(item.ship_to.length){
                         item.ship_to.forEach((value)=>{
                             id[item.ship_from].push(value.value);
                         })
                      }else{                    
                                      

                        id[item.ship_from].push(item.ship_to);
                      }   


                        id[item.ship_from].push(item.ship_to);
                       
                    }
                  
                });

            return id;
           },
         
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
                    ship_to: [],
                    price: 0,
                    additional: 0,
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
            removeState(index, e){
                 e.preventDefault();
              
                this.existingShippings_.splice(index, 1);

            },
            onSubmit(e) {
                e.preventDefault();

                var that = this;


                this.errors = {};

                if(this.name.length<3) this.errors['name'] = 'You must enter winery name.';
                if(this.regions.length===0) this.errors['regions'] = 'You must select at least 1 region.';
                if(this.description.length < 10) this.errors['description'] = 'You must enter at least 10 characters.';                
                this.existingShippings_.forEach((item)=>{
                    if(item.ship_from == 0){
                        this.errors['shipping'] = 'You must select shipping origin .'
                    }
                     if(item.ship_to.length == 0){
                        this.errors['shipping_cost'] = 'You must fill in shipping costs.'
                    }
                    
                });

                if(Object.keys(this.errors).length > 0){

                   this.$nextTick(() => {
                        let error = document.querySelectorAll('.error-block');
                 
                 
                
                       if(error.length > 0){
                         error[0].scrollIntoView({behavior: "smooth", block: "end"});
                       }
                    
                   });
               
                }else{
                    that.$el.querySelector("#updateForm").submit();
                }
            
            },
            isInvalid(name) {
                return this.errors[name];
            },
            getProfilePhoto() {
                return this.profile?`/images/winery/profile/${this.profile}`:this.defaultProfilePhoto;
            },
            getCoverPhoto() {
                return this.cover?`/images/winery/cover/${this.cover}`: this.defaultCoverPhoto;
            }
        }
    }
</script>
