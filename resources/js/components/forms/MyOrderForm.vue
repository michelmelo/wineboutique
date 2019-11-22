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
                            <td>Total price</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders" v-bind:key="order.id">
                            <td v-on:click="showDetails(order.id)" class="pointer">{{order.order_id}}</td>
                            <td>{{order.address.address_1}},<br> {{order.address.address_2}},<br> {{order.address.city}},<br> {{order.address.postal_code}}</td>
                            <td>FedEx <br> {{order.status == 1 ? "Processing" : order.status == 2 ? "Shipped" : "Canceled"}}</td>
                            <td>
                                <div v-for="wine_order in order.order_wines" class="mb-2">
                                    <span>{{ wine_order.quantity }}x </span>
                                    <a :href="'/wine/' + wine_order.wine.slug">{{ wine_order.wine.name}}</a>
                                    <span> from </span>
                                    <a :href="'/winery/' + wine_order.wine.winery.slug">{{ wine_order.wine.winery.name }}</a>
                                </div>
                            </td>
                            <td>${{ price(order) }}</td>
                        </tr>
                    </tbody>
                </table>

                <p v-else>You have no orders yet.</p>
            </div>
            <div v-if="order.id == order_to_show" v-for="order in orders" v-bind:key="order.id">
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
            order_to_show: null
        }),
        created: function() {
            const orders = JSON.parse(this.userOrders);
            console.log(orders);
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
                this.order_to_show = orderId;
            },
            price(order) {
                let retVal = 0;
                order.order_wines.forEach(function(order_wine) {
                    retVal += order_wine.price + order_wine.shipping_price;
                });
                return retVal.toFixed(2);
            },
        },
    }
</script>
