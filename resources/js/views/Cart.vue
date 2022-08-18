<template>
<div class="row ">
    <div class="col-8">
        <div class="p-5">
            <div class="d-flex justify-conten-between">
                <h2>My BAG</h2>
                <p class="">Items reserve</p>
            </div>
            <div>
                <Card />
                <Card />
                <Card />
            </div>
            
        </div>
    </div>


    <div class="col border rounded m-4">
        <h4 class="pt-4 border-bottom">Total</h4>

        <div class="mt-3 mb-5">
            <div class="d-flex justify-content-between mb-3" >
                <strong>Sub-total</strong><strong>$ 90</strong>
            </div>
            <div class="d-flex justify-content-between ">
                <strong>Delivery</strong><strong>$ 2</strong>
            </div>
        </div>

        <hr>
            
        <button class="font-weight-bold btn btn-success w-100 mb-4">Checkout</button>

        <strong >WE ACCEPT : </strong>
        <div class="payment-method d-flex justify-content-between ">
            <img src="../assets/paypal.png" alt="" width="100px">
            <img src="../assets/mastercard.png" alt="" width="100px">
            <img src="../assets/gcash.png" alt="" width="100px">
        </div>
    </div>
</div>


</template>

<script setup>
import Card from './CartComponents/Card.vue';
import {onMounted} from 'vue';

components: {Card }

    onMounted(() => {
        const userLog = localStorage.getItem('user')
        if(!userLog) {
            window.location.href = '/login'
        }
    });
</script>

<style>
    .cart-img img {
        width: 200px;
    }
    .payment-method img {
        object-fit: contain;
        transition:.3s ease-in-out;
        cursor: pointer;
    }
    .payment-method img:hover {
        transform:scale(1.05);
        
    }
</style>