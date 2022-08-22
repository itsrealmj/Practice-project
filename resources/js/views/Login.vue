<template>
    <div class="login-container">
        <h4>LOGIN</h4>

        <form action="/api/login" method="post">
            <label class="mb-2" >Email address</label>
            <input type="email" name="email" v-model="email" class="form-control" placeholder="Enter email" required>
            <label class="mb-2">Password</label>
            <input type="password" name="password" v-model="password" class="form-control" placeholder="Password" required>
        
            <button class="w-100">LOGIN </button>

            <div class="mt-3">
                
                <span>Need an account ? <router-link to="/register">SIGN UP </router-link></span>
                
            </div>
        </form>

    </div>

    <!-- <div class="sign-up-form w-50 m-auto mt-5 p-3 ">
        <div class="form-group mt-3">
            <label >Email address</label>
            <input type="email" name="email" v-model="email"  placeholder="Enter email" required>
        </div>

        <div class="form-group mt-3">
            <label>Password</label>
            <input type="password" name="password" v-model="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" @click="login" class="btn btn-primary mt-3">Login</button>
    </div> -->
</template>
 <script setup> 
import axios from 'axios'
import {ref, onMounted} from 'vue'

    
    let email = ref('')
    let password = ref('')


    // function login ()  {

    //     fetch(`/api/login/`).then(response => {
    //         return response.json()
    //     }).then(usersData => {
    //        usersData.filter(data => {
    //          if(data.email === email.value && data.password === password.value) {
    //             alert(`You're login`)
    //             localStorage.setItem('user', email.value)
    //             window.location.href = '/'
    //          } 
    //        })
    //     }).catch(err => {
    //         alert("Please sign up")
    //     })
    // }

    onMounted(() => {

        let userLog = localStorage.getItem('user')
        if(userLog) { window.location.href = '/' }

        if(userLog) { alert('You are already sign in')}
    })
    
    

 </script>
<style scope>
    .sign-up-form {
        box-shadow:1px 1px 10px 1px rgba(215, 215, 245, 0.6);
    }
    .login-container {
        background: white;
        width: 40%;
        margin:5rem auto;
        padding: 1rem 2rem;
        border-radius: 5px;

        box-shadow:5px 5px 10px 1px rgb(198, 198, 198);
    }
    .login-container h4 {
        margin-bottom: 2rem;
    }
    .login-container input {
        
        border-radius: 0;
        margin:0 0 1rem 0;
        padding: .5rem .3rem;
        background: none;
        border: none;
        border-bottom: 1px solid gray;
        outline: none;
        
    }
    .login-container button {
        border-radius: 5px;
        margin-top: 1rem;
        padding: .3rem 0;
        border: none;
        transition: .3s ease-in-out;
        background-color: orangered;
        color:white;
    }
    .login-container button:hover {
        transform: scale(1.01);
        color: whitesmoke;
    }
</style>