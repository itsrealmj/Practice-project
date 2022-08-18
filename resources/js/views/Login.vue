<template>
    <div class="sign-up-form w-50 m-auto mt-5 p-3 ">
        <div class="form-group mt-3">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" v-model="email" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="form-group mt-3">
            <label>Password</label>
            <input type="password" name="password" v-model="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" @click="login" class="btn btn-primary mt-3">Login</button>
    </div>
</template>
 <script setup> 
import axios from 'axios';
import {ref, onMounted} from 'vue'

    
    let email = ref('')
    let password = ref('')

    function login() {

        fetch(`/api/store/`).then(response => {
            return response.json()
        }).then(usersData => {
           usersData.filter(data => {
             if(data.email === email.value && data.password === password.value) {
                alert(`You're login`)
                localStorage.setItem('user', email.value)
                window.location.href = '/'
             } 
           })
        }).catch(err => {
            alert("Please sign up")
        })

        // axios.get(`/api/store/`)
        // .then(function (response) {
        //     const datas = response.data
            
        //     datas.filter(data => {
                
        //         if(data.email == email.value && data.password == password.value) {
        //            alert(`You're login`)
        //            localStorage.setItem('user', email.value)
        //            window.location.href = '/'
        //         }
                
        //     })
            
        // })
        // .catch(function (error) {
            
        // });
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