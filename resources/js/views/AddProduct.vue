<template>
<form action="/api/addProduct" method="post" class="add-product-form mt-5 w-50">
      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" class="form-control" name="name" placeholder="Product name">
      </div>
      
      <div class="mb-3">
        <label class="form-label">Upload photo</label>
        <input type="file" class="form-control" name="file">
      </div>
      <div class="mb-3">
        <label class="form-label">Product Price</label>
        <input type="number" class="form-control" name="price" >
      </div>
      <div class="mb-3">
        <label class="form-label">Products Description</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
      </div>
      
      <button type="submit" class="btn btn-success">Add product</button>
    </form>
</template>
<script setup>

import {onMounted} from 'vue'

    onMounted(() => {
        const userLog = localStorage.getItem('user')
        if(!userLog) {
            window.location.href = '/login'
        }
    });
    
</script>
<style>
.add-product-form {
    margin: 0 auto;
}
</style>
