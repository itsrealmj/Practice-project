<template>
    <section class="top-deal container">
		<div class="product-section p-2">
			<h1>Product Section</h1>
			<form  class="w-50">
				<input type="search" v-model="search" class="form-control" name="category" placeholder="Search here ...">
			</form>
		</div>
    <div class="container">
		<figure v-for="post in matchProductNames" :key="post.id" >
			<!-- <img :src="post.img" :alt="post.caption"> -->
			<span> {{post.id}}</span>
			<h4>{{post.name}}</h4>
			<strong>$ {{post.price}}</strong><br>
			<span> {{post.description}}</span><br>
			<form action="/api/cart/" method="post">
				<button type="submit" :value="post.id" name="id" class="btn btn-success"> Add to Cart</button>
			</form>
		</figure>
		{{msg}}
    </div>

	<button v-if="showPrevBtn" @click="prev(currentPage, lastPage)" :value="currentPage" class="btn btn-primary" >Prev</button>
	
	<button v-if="showNextBtn"  @click="next(currentPage, lastPage)" :value="lastPage" class=" btn btn-primary">Next</button>
  </section>
</template>

<script setup>
import { ref , computed, onMounted} from 'vue'

	const search = ref('')
	const posts = ref([])
	const error = ref(null) 

	let currentPage = ref('')
	let lastPage = ref('')
	let msg = ref('')

	let showPrevBtn = ref(true)
	let showNextBtn = ref(true)

	const load = async (page) => {
		
		try {
			let datas = await fetch(`http://localhost:8000/api/data?page=${page}`)
			console.log(datas)
			if (!datas.ok) {
				throw Error("Can't fetch data")
			}
			// assign all the fetch data to posts
			posts.value = await datas.json()
			console.log(posts.value.from)

			currentPage.value = posts.value.current_page
			lastPage.value = posts.value.last_page

			posts.value = posts.value.data
		}
		catch(err) {
			error.value = err.message
		}
	}
	load()

	function next(currentPage, lastPage) {
		if(lastPage > currentPage){
			currentPage++
			if(currentPage == lastPage) { showNextBtn.value = !showNextBtn.value }
			load(currentPage)
		}
	}
	function prev(currentPage, lastPage) {
		
		if(currentPage <= lastPage){
			currentPage--
			showNextBtn.value = true
			load(currentPage)
		}
	}


	// matchProductNames is an array which will return filtered clients search input

	const matchProductNames = computed( () => {
		return posts.value.filter((item) => {
			search.value = search.value.toLocaleLowerCase()
			item.name = item.name.toLocaleLowerCase()

			return item.name.includes(search.value)
		})
	});

</script>

<style>
	.top-deal {
		margin-top:1rem;
	}
	.top-deal .product-section {
		display: flex;
		align-items: center;
		justify-content: space-between;
		background : #f1f1f1;
		color:rgba(0,0,0, .7)
	}
	.top-deal div {
		display:flex;
		gap: 1.7rem;
		justify-content:flex-start;
		flex-wrap:wrap;
	}

	.top-deal figure {
		font-size:15px;
		padding: 1rem 1.5rem;
		cursor:pointer;

		transition:.2s ease-in-out;
	}
	.top-deal figure h4, strong {
		color: rgba(0,0,0, .7);
	}
	.top-deal figure span {
		font-weight:600;
	}
	.top-deal figure:hover {
		box-shadow: -5px 7px 10px -5px gray;
		transform:scale(1.01);
	}
	.top-deal div img {
		width:100px;
	}
	
</style>

