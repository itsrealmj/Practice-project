<template>
	<header>
      <nav  class="position-relative">
        <img src="./assets/images/logo.svg" alt="logo" />
		
        <ul>
          <router-link v-if="isLogIn" to="/">Home</router-link>
          <router-link v-if="isLogIn" to="/add">Add</router-link>
          <router-link v-if="isLogIn" to="/productManagement">Management</router-link>
		  <router-link v-if="isLogIn" to="/cart">Cart</router-link>
          <router-link v-if="isLogOut" to="/login">Login</router-link>
          <router-link v-if="isLogOut" to="/register">Signup</router-link>
          

          <div v-if="isLogIn" class="user-img mt-3  " >
			<img @click="setting" src="./assets/images/avatar-richard.png" alt="user-image">
		 	<div  v-if="logOutBtn" class="log-out-section position-absolute ">
				<strong class="btn btn-danger float-end" @click="closedBtn">X</strong>
				<div class="p-5">
					
					<span >
						{{email}}
					</span>
					<br>
					<button class=" rounded px-1 btn btn-danger" @click="logout" >Logout</button>
				</div>
			</div> 
		  </div>
		  
		</ul>

		
      </nav>
    </header>
	
    <router-view />

</template>
<script setup>
import { onMounted, ref } from "vue";

	let logOutBtn = ref(false)
	function setting() {
		logOutBtn.value = true

	}
	function closedBtn() {
		logOutBtn.value = !logOutBtn
	}

	function logout() {
		alert('You just logout')
		localStorage.clear()
		window.location.href = '/login'
	}
	
	let isLogIn = ref(true)
	let isLogOut = ref(true)
	const email = ref('')
	onMounted(() => {
		email.value = localStorage.getItem('user')
		if(email.value){
			isLogOut.value = !isLogOut

		}else {
			isLogIn.value = !isLogIn
		}
	})
</script>

<style>

	header {
		background-color : #f1f1f1;
		position:sticky;
		top:0;
		z-index:2;
	}
	header nav {
		display:flex;
		justify-content:space-between;
		align-items:center;
		padding:.5rem 5rem;

	}
	header nav ul {
		display:flex;
		gap:1rem;
		list-style:none;
	}
	header nav ul a {
        margin-top: 1rem;
        font-size: 1.1rem;
		text-decoration:none;
		position:relative;
		color:rgba(0,0,0, .7);
		font-weight:600;

	}
	header nav ul a::after {
		content: "";
	    position: absolute;
	    bottom: -.5rem;
	    left: 0;
	    height: 3px;
	    width: 0;
	    background-color: red;
	    transition: .3s ease-in-out;
	}
	header nav ul a:hover::after {
		width: 100%;
	}

	header .user-img img{
		width: 35px;
		cursor: pointer;
	}

	header nav .log-out-section {
		background-color: rgb(233, 231, 231);
		transition: 1s ;
		border-radius: 10px;
		right: 0%;
		top:70%;
		padding: 0;
	}
	
</style>