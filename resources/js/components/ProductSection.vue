<template>
    <section class="top-deal container">
		<div class="product-section p-2">
			<h1 class="px-3">TOP DEALS</h1>
			<form  class="w-50">
				<input type="search" v-model="search" class="form-control" name="category" placeholder="Search here ...">
			</form>

		</div>
		<div class="row d-flex justify-content-around">
			<figure class="col-xs-12 col-sm-6 col-md-4 col-lg-3 each-product " v-for="post in matchProductNames" :key="post.id" >
				<img src="../assets/laptop.png"/>
				<!-- <span> {{post.id}}</span> -->
				<h4>{{post.name}}</h4>
				<!-- <h5> {{post.description}}</h5> -->
				<strong class="text-danger">$ {{post.price}}</strong><br>

				<form action="/api/addcart/" method="post">
					<button type="submit" :value="post.id" name="id" class="add-to-cart-btn"> Add to Cart</button>
				</form>
			</figure>
		</div>
 </section>	
 <div class="paginated-section ">
	<div class="showing">Showing {{ itemShowed }} Items of {{ totalItem }} -> </div>

	<button v-if="showPrevBtn" @click="prev(currentPage, lastPage)" :value="currentPage" class="" >Previous</button>
	<button v-if="showNextBtn"  @click="next(currentPage, lastPage)" :value="lastPage" class=" ">Next</button>
	<!-- <input type="number" class="change mx-2" v-model="change" />  -->
	<!-- ({{item}})  -->
 </div>
</template>

<script setup>
import { ref , computed, onMounted, watch} from 'vue'

	let change = ref(8)
	let item = ref(null)
	let totalItem = ref(null)
	let itemShowed = ref(null)

	watch(change,() => {
		load()
	})

	const search = ref('')
	const posts = ref([])
	const error = ref(null) 

	let currentPage = ref('')
	let lastPage = ref('')

	let showPrevBtn = ref(true)
	let showNextBtn = ref(true)

	watch(search,() => {
		load()
	})

	const load = async (page=1) => {
		let datas = await window.axios.get(`http://localhost:8000/api/data`,{
			params: {
				page: page,
				itemPerPage:change.value
			}
		})

		item.value = datas.data.data.length
		totalItem.value = datas.data.total

		currentPage.value = datas.data.current_page
		lastPage.value = datas.data.last_page

		itemShowed.value = datas.data.to

		posts.value = datas.data.data

		
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
		text-align: center;
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
	.top-deal .change {
		text-align: center;
		width: 40px;
	}
	.top-deal .each-product {
		width: 250px;
	}
	.top-deal .each-product img {
		width: 100%;
	}
	.top-deal .each-product .add-to-cart-btn {
		color: orangered;
		background-color: transparent;
		padding: .3rem .5rem;
		font-weight: bold;
		border-radius: 5px;
		border:none;
		box-shadow: 5px 5px 20px 1px rgb(221, 219, 219);
	}
	.paginated-section {
		margin: 3rem 0;
		display: flex;
		align-items: center;
		justify-content: center;

		gap:1rem;
	}
	.paginated-section .showing {
		background:rgb(1, 1, 23);
		color: whitesmoke;
		padding: .6rem 1rem;
	}
	.paginated-section button {
		background: white;
		border: 1px solid rgb(1, 1, 23);;
		font-weight: bold;
		padding: .5rem 1rem;
	}
</style>

