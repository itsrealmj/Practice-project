<template>
  <div class="card-img d-flex border-bottom pb-3 mb-3" v-for="cart in carts " :key="cart.cart_id">
      <div class="d-flex gap-3"> 
        <img src="@/assets/laptop.png" alt="" class="w-25">
        <div class="">
          <div>
              <h5 class="mt-3">{{ cart.cart_product_name }}</h5>
              <br>
              <div class="mt-3 mb-3">
                  <h6>{{ cart.cart_product_desc}}</h6>
                  <span>Quantity : <span @click="qty--">-</span> {{ qty }} <span @click="qty++">+</span></span>
              </div>
              <h5>$ {{ cart.cart_product_price * qty }}</h5>
          </div>
          <div>
              <button class="btn btn-primary d-flex align-items-center mt-3"> 
                  <span class="material-symbols-outlined">favorite</span>
                  <span class="">Save for later</span>
              </button>
          </div>
        </div>
        <div class="">
          <form action="/api/deletecart" method="post">
            <button type="submit" name="id" class="material-symbols-outlined border-0 bg-danger text-white" :value="cart.id">close</button>
          </form>
        </div>
      </div>

      
  </div>

</template>

<script setup>
import { onMounted, ref } from 'vue';

const carts = ref()
const qty = ref(1)



const load = async () => {
    const cartDetails = await window.axios.get(`http://localhost:8000/api/cart`)
    carts.value = cartDetails.data
};
load()


</script>
 <style>
 .card-img {
 }
 </style>