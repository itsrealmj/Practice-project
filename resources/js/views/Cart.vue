<template>
<Message class="w-50 m-auto fixed-top" severity="success" v-if="showMessage">Successfully deleted</Message>
<div class="p-5 d-flex justify-content-around">
    <div class="m-2">
    <div class="card-img d-flex border-bottom pb-3 mb-3" v-for="cart in carts " :key="cart.id">
      <div class=" d-flex justify-content-between gap-3"> 
        <div class="card-details">
          <img class="w-25" :src="`../storage/images/${cart.cart_product_path.substring(14)}`">
          <div class="m-3">
            <div>
                <h5 class="mt-3">{{ cart.cart_product_name }}</h5>
                <br>

                <div class="">
                    <h6>{{ cart.cart_product_desc}}</h6>
                    <span>Quantity : 
                      <span @click="cart.cart_product_qty--">-</span> 
                        {{ cart.cart_product_qty }} 
                      <span @click="cart.cart_product_qty++">+</span>
                    </span>
                </div>

                <h5>$ {{ cart.cart_product_price * cart.cart_product_qty }}</h5>
            </div>
            <div>
                <button class="btn btn-primary d-flex align-items-center mt-3"> 
                    <span class="material-symbols-outlined">favorite</span>
                    <span class="">Save for later</span>
                </button>
            </div>
          </div>
        </div>
        <div class="closed-btn">
          <form @submit.prevent="deleteCart(cart.id)">
          <!-- <form action="/api/deletecart" method="post"> -->
            <button type="submit" name="id" class="material-symbols-outlined border-0 bg-danger text-white" :value="cart.id">close</button>
          </form>
        </div>
      </div>
  </div>
    </div>
    <!-- left payment -->
    <div class="m-2">
        <!-- start here -->
        <div class="payment-container border rounded  p-2">
        <h4 class="border-bottom">Total</h4>

        <div class="">
            <div class="d-flex justify-content-between" >
                <strong>Sub-total</strong><strong>{{ }}</strong>
            </div>
            <div class="d-flex justify-content-between ">
                <strong>Delivery</strong><strong>$ 2</strong>
            </div>
        </div>

        <hr>
            
        <button class="font-weight-bold btn btn-success w-100 mb-4">Checkout</button>

        <strong >WE ACCEPT : </strong>
        <div class="payment-method d-flex justify-content-between">
            <img src="@/assets/paypal.png" alt="" width="100px">
            <img src="@/assets/mastercard.png" alt="" width="100px">
            <img src="@/assets/gcash.png" alt="" width="100px">
        </div>
    </div>
    </div>

    
</div>



</template>

<script setup>
import Card from './CartComponents/Card.vue';
import {onMounted, ref} from 'vue';
import Payment from './CartComponents/Payment.vue';
import Message from 'primevue/message';

// components: {Card, Payment }
const carts = ref([])
let showMessage = ref(false)

async function deleteCart(id) {
  const deleteItem = await axios.post(`/api/deletecart`, {
      id:id
  })
  if(deleteItem.status === 200) {
    showMessage.value = true
      setTimeout(() => {
        showMessage.value = false
      },2000)
      const cartDetails = await window.axios.get(`http://localhost:8000/api/cart`)
      carts.value = cartDetails.data
      // window.location.href = '/'
  }
}


const load = async () => {
    const cartDetails = await window.axios.get(`http://localhost:8000/api/cart`)
    carts.value = cartDetails.data
};
load()


    onMounted(() => {
        const userLog = localStorage.getItem('user')
        if(!userLog) {
            window.location.href = '/login'
        }
    });
</script>

<style>
    
</style>