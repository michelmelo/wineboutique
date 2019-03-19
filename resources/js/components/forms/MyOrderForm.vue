<template>
    <div class="info-box shadow-box">
        <div>
            <h2>
                <span>MY ORDERS</span>
            </h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Address</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders" v-bind:key="order.id"> 
                        <td>{{order.address.address_1}}</td>
                        <td>{{order.status}}</td>
                    </tr>
                </tbody>
            </table>
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
            orders: []
        }),
        created: function() {
            const orders = JSON.parse(this.userOrders);
            this.orders = orders;
        },
        methods: {
            selectOrder(orderId) {
                const selectedOrders = window._.find(this.orders, {
                    id: orderId
                });

                this.selectedOrders = {...selectedOrders};
            },
        }
    }
</script>
