<template>
<!-- <Message class="w-50 m-auto fixed-top" severity="success" v-if="showMessage">Successfully deleted</Message> -->
<div class="p-5 d-flex justify-content-around">
    <div class="m-2">
    <div class="card-img d-flex border-bottom pb-3 mb-3" v-for="cart in carts " :key="cart.id">
      {{ cart.id }}
      <div class=" d-flex justify-content-between gap-3"> 
        <div class="card-details">
          <img class=" product-img" :src="`../storage/images/${cart.cart_product_path.substring(14)}`">
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
            <ConfirmPopup></ConfirmPopup>
            <ConfirmPopup group="demo">
              <template #message="slotProps">
                <div class="flex p-4">
                  <i :class="slotProps.message.icon" style="font-size: 1.5rem"></i>
                  <p class="pl-2">{{slotProps.message.message}}</p>
                </div>
              </template>
            </ConfirmPopup>
            <Toast />
            <Button @click="confirm2($event,cart.id )" icon="pi pi-times" class="p-button-danger p-button-outlined px-0 py-0"></Button>
          
          <!-- <form @submit.prevent="deleteCart(cart.id)">
            <button type="submit" name="id" class="material-symbols-outlined border-0 bg-danger text-white" :value="cart.id">close</button>
          </form> -->
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
import Payment from './CartComponents/Payment.vue';
import Card from './CartComponents/Card.vue';

import {onMounted, ref} from 'vue';
import Message from 'primevue/message'; //Flash deleted product
// components: {Card, Payment }

import ConfirmPopup from 'primevue/confirmpopup';
import Button from 'primevue/button';
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';



// name: "MainSection"

	const confirm = useConfirm();
	const toast = useToast();

	const confirm2 = (event,id) => {
		confirm.require({
			target: event.currentTarget,
			message: 'Do you want to delete this item?',
			icon: 'pi pi-info-circle',
			acceptClass: 'p-button-danger',
			accept: () => {
        deleteItem(id)
				toast.add({severity:'info', summary:'Confirmed', detail:'Item deleted', life: 3000});
			},
			reject: () => {
				toast.add({severity:'error', summary:'Rejected', detail:'You have rejected', life: 3000});
			}
		});
	}

	async function deleteItem(id) {
		const data = await axios.post(`/api/deletecart/`, {id: id})
    
		displayedProducts()
	}




    // DELETED SINGLE ITEM IN CART
    // let showMessage = ref(false)
    // async function deleteCart(id) {
    //   if(confirm('delete ? ')){
    //     const deleteItem = await axios.post(`/api/deletecart`, {id:id})

    //     if(deleteItem.status === 200) {
    //       showMessage.value = true
    //         setTimeout(() => {
    //           showMessage.value = false
    //         },2000)
    //         const cartDetails = await window.axios.get(`http://localhost:8000/api/cart`)
    //         carts.value = cartDetails.data
    //     }
    //   }
    // }


    // ALL PPRODUCT IN CART DISPLAY
    const carts = ref([])

    const displayedProducts = async () => {
        const cartDetails = await window.axios.get(`http://localhost:8000/api/cart`)
        carts.value = cartDetails.data
    };
    displayedProducts()


    onMounted(() => {
        const userLog = localStorage.getItem('user')
        if(!userLog) {
            window.location.href = '/login'
        }
    });
</script>

<style>
  .card-img {
    width: 500px;
  }
   .card-img .card-details .product-img {
      width: 200px;
    }
</style>