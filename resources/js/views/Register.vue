<template>

<div class="login-container">
        <h4>SIGN UP</h4>

        <form action="/api/register" method="post">
            <label >Name </label>
            <input type="text" name="name" v-model="name" class="form-control" placeholder="Name" required>
            
            <label class="mb-2" >Email address</label>
            <input type="email" name="email" v-model="email" class="form-control" placeholder="Enter email" required>
            
            <label class="mb-2">Password</label>
            <input type="password" name="password" v-model="password" class="form-control" placeholder="Password" required>
        
            <button class="w-100">LOGIN </button>

            <div class="mt-3">
                
                <span>Already has an account ? <router-link to="/login">LOGIN</router-link></span>
                
            </div>
        </form>

    </div>

    <!-- <div class="sign-up-form w-50 m-auto mt-5 p-3 ">
        <div class="form-group rounded" >
            <label >Name </label>
            <input type="text" name="name" v-model="name" class="form-control" placeholder="Name" required>
        </div>

        <div class="form-group mt-3">
            <label >Email address</label>
            <input type="email" name="email" v-model="email" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="form-group mt-3">
            <label >Password</label>
            <input type="password" name="password" v-model="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" @click="signUp" class="btn btn-primary mt-3">Signup</button>
    </div> -->
</template>
 <script setup> 
import axios from 'axios';
import {ref, onMounted} from 'vue'

    
    const name = ref('')
    const email = ref('')
    const password = ref('')

    function signUp() {
        axios.post('/api/store', {
            name : name.value,
            email: email.value,
            password: password.value
        })
        .then(function (response) {
            console.log(response);
            
            if(response.status === 200) {
                localStorage.setItem('user', JSON.stringify(email.value))
                alert("Sign up successfully")
                window.location.href = '/'
            }
        })
        .catch(function (error) {
            alert("Email already used" ,error)
        });
    }

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
</style>