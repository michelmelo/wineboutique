<template>
    <div class="info-box shadow-box">
        <div>
            <h2>
                <span>MY ORDERS</span>
            </h2>
             <div class="overflov-x">
                <table class="table table-striped exception" v-if="orders.length">
                    <thead>
                        <tr>
                            <td>Order Id</td>
                            <td>Address</td>
                            <td>Shipping / Status</td>
                            <td>Wines ordered</td>
                            <!--<td>Total price</td>-->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(order, index) in orders" v-bind:key="order.id">
                            <td v-on:click="showDetails(order.id)" class="pointer position-relative">
                                {{order.order_id}}
                                <div v-if="order.id == order_to_show" class="order-info-box">                                   
                                    <b class="mr-2">Order ID:</b> {{ order.order_id }}
                                    <br>
                                    <b class="mr-2">Delivery Address:</b> {{order.address.address_1}}, {{order.address.address_2}}, {{order.address.city}}, {{order.address.postal_code}}
                                    <br>
                                    <b class="mr-2">Delivery Company:</b> FedEx
                                    <br>
                                    <span v-for="ow in order.order_wines" v-bind:key="ow.id">
                                        <b class="mr-2">Order Wine:</b>{{ow.wine.name}} - {{ow.status == 1 ? "Proccesing" : "Tracking number: " + ow.tracking}} <br>
                                    </span>
                                </div>
                            </td>
                            <td>{{order.address.address_1}},<br> {{order.address.address_2}},<br> {{order.address.city}},<br> {{order.address.postal_code}}</td>
                            <td>FedEx <br> {{order.status == 1 ? "Processing" : order.status == 0 ? "Shipped" : "Cancelled"}}</td>
                            <td>
                                <span class="order-details" @click="activePopup = index">Details...</span>
                               <div class="orders-popup is-visible" role="alert" v-if=" activePopup === index" >
                                       <div class="popup-container">
                                        <span class="popup-close img-replace" @click="activePopup = false">Close</span>
                                            <div class="popup-head">
                                              <h2 class="text-center text-uppercase"><strong>Order: {{order.order_id}}</strong></h2>
                                            </div>
                                            <div class="popup-body mb-5">
                                                <div class="mb-2 order-row d-flex justify-content-between " v-for="wine_order in order.order_wines" v-bind:key="wine_order.id">
                                                    <div class="pr-3 d-inline " >
                                                        <span>{{ wine_order.quantity }}x </span>
                                                        <a v-if="wine_order.wine" :href="'/wine/' + wine_order.wine.slug">{{ wine_order.wine.name}}</a>
                                                        <b v-else>{{ wine_order.wine_name}}</b>
                                                        <span> from </span>
                                                        <a :href="'/winery/' + wine_order.winery.slug">{{ wine_order.winery.name }}</a>
                                                    </div>
                                                    <strong>${{ singlePrice(wine_order) }}</strong>
                                                </div>
                                                <div class="border-top p-3">
                                                   <span>TOTAL PRICE:</span><strong class="float-right"> ${{price(order)}}</strong>
                                                </div>
                                            </div>
                                            <div class="text-center py-5">
                                                <span href="#0" class="button red-button" @click="activePopup = false">
                                                    <i class="fas fa-times"></i> CLOSE
                                                </span>
                                            </div>
                                        </div>

                                </div>
                            </td>
                            <!--
                            <td>${{ price(order) }}</td>
                        -->
                        </tr>
                    </tbody>
                </table>

                <p v-else>You have no orders yet.</p>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    const formFields = [
        'order_id',
        'payment_id',
        'address_id',
        'status'
    ];

    export default {
        props: ['userOrders'],
        data: () => ({
            selectedOrders: null,
            orders: [],
            order_to_show: null,
            activePopup: false
        }),
        created: function() {
            const orders = JSON.parse(this.userOrders);
            // console.log(orders);
            this.orders = orders;
        },
        methods: {
            selectOrder(orderId) {
                const selectedOrders = window._.find(this.orders, {
                    id: orderId
                });

                this.selectedOrders = {...selectedOrders};
            },
            showDetails(orderId) {
              if(!this.order_to_show ||  this.order_to_show !== orderId ){
                this.order_to_show = orderId;
               }else{
                this.order_to_show = null;
               } 
            },
            price(order) {
                let retVal = 0;
                order.order_wines.forEach(function(order_wine) {
                    retVal += order_wine.quantity * order_wine.price + order_wine.shipping_price + ((order_wine.quantity - 1) *order_wine.additional_shipping_price);
                });
                return retVal.toFixed(2);
            },
            singlePrice(order_wine){
                // console.log(order_wine);
                let totalPrice = order_wine.quantity * order_wine.price + order_wine.shipping_price + ((order_wine.quantity - 1) *order_wine.additional_shipping_price);
                return totalPrice.toFixed(2);
            }
        },
    }
</script>
