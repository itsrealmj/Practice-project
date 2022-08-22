<template>
<div class="p-5 d-flex justify-content-around">
    <div class="m-2">
        <Card />
    </div>
    <div class="m-2">
        <Payment />
    </div>

    
</div>



</template>

<script setup>
import Card from './CartComponents/Card.vue';
import {onMounted} from 'vue';
import Payment from './CartComponents/Payment.vue';

components: {Card, Payment }

    onMounted(() => {
        const userLog = localStorage.getItem('user')
        if(!userLog) {
            window.location.href = '/login'
        }
    });
</script>

<style>
    
</style>