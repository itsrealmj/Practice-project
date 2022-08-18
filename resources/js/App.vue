<template>
	<header>
      <nav >
        <img src="./assets/images/logo.svg" alt="logo" />
		
        <ul>
          <router-link to="/">Home</router-link>
          <router-link to="/add">Add</router-link>
          <router-link to="/productManagement">Management</router-link>
          <router-link to="/login">Login</router-link>
          <router-link to="/register">Signup</router-link>

		  <button @click="logout">Logout</button>
		  
          <router-link to="/cart">Cart</router-link>
          <div class="user-img mt-3 ml-2 ">
			
			<img src="./assets/images/avatar-richard.png" alt="user-image" >
			{{email}}
		  </div>
		</ul>
		
      </nav>
    </header>
	
    <router-view />

</template>
<script setup>
import { onMounted, ref } from "vue"

	const email = ref('')

	function logout() {
		alert('You were logout')
		localStorage.clear()
		window.location.href = '/login'
	}
	
	onMounted(() => {
		email.value = localStorage.getItem('user')
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
	}
</style>