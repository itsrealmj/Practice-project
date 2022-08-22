
<template>
  <section class="product-mgt container-fluid">
    <h1>Product Management Section</h1>
	<table class="container ">
		<thead class=" ">
		<tr >
			<th><h5>ID</h5></th>
			<th><h5>Name</h5></th>
			<th><h5>Description</h5></th>
			<th><h5>Price</h5></th>
			<th><h5>Action</h5></th>
		</tr>
		</thead>
		<tbody>
		<tr v-for="post in posts" :key="post.id">
			<td>{{post.id}}</td>
			<td>{{post.name}}</td>
			<td class="desc w-50">{{post.description}}</td>
			<td>{{post.price}}</td>
			
			<td class="d-flex gap-2">
				<router-link class="btn btn-success" :to="{ name: 'EditProduct', params: {id:post.id} }">edit</router-link>
				<!-- this will go to routes/api with the delete post request -->
				<form action="/api/delete/" method="post">
					<button type="submit" :value="post.id" name="id" class="btn btn-danger"> delete</button>
				</form>
			</td>
		</tr>
		</tbody>
	</table>
  </section>
</template>
<script setup>	
import { ref, onMounted } from 'vue'

name: "MainSection"

		const posts = ref([])
		const error = ref(null) 

		const loadAllProduct = async () => {
			try {
				let datas = await axios.get('http://localhost:8000/api/manage')
				posts.value = datas.data
			}
			catch(err) {
				error.value = err.message
			}
		}

		loadAllProduct()

    onMounted(() => {
        const userLog = localStorage.getItem('user')
        if(!userLog) {
            window.location.href = '/login'
        }
    });	

</script>
<style>
	.product-mgt {
		margin-top:1rem;
	}
	.product-mgt h1 {
		color: rgba(0, 0, 0, .7);
		background : #f1f1f1;
		margin:1rem 4rem;
		padding:1rem;
	}
	.product-mgt table {
		margin:1rem 4rem;
		padding:1rem;
	}
	table td {
		margin-bottom: 1rem;
	}

</style>