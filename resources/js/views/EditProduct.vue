<template>
<h1 style="text-align:center;"> Edit Section</h1>
<form action="/api/update/" method="post" class="add-product-form mt-5">
  <div>
    <input type="hidden" :value="post.id" name="id">
    <div class="mb-3">
      <label class="form-label">Product Name</label>
      <input type="text" class="form-control" :value="post.name" name="name" >
    </div>
    
    <div class="mb-3">
      <label class="form-label">Upload photo</label>
      <input type="file" class="form-control" name="photo">
    </div>
    <div class="mb-3">
      <label class="form-label">Product Price</label>
      <input type="number" class="form-control" name="price" :value="post.price">
    </div>
    <div class="mb-3">
      <label class="form-label">Products Description</label>
      <input type="text" class="form-control" name="description" rows="3" :value="post.description"/>
    </div>
    
    <button type="submit" class="btn btn-success">Update</button>
  </div>
</form>
</template>

<script>
import { ref } from 'vue'

export default {
    props: ['id'],
    // props.id from productsection params which give the ID of the triggered button EDIT
    setup(props) {
		const post = ref(null)
		const error = ref(null) 

		const load = async () => {
			try {
				const datas = await fetch(`http://localhost:8000/api/data/`)
				if (!datas.ok) {
					throw Error("Can't fetch data")
				}

				const dataItems = await datas.json()
        // this will filter only one item which has the same value as the props.id 
        // and the single data from API endpoint
        dataItems.filter(item => {
          if(item.id == props.id) {
            // item will assign to post.value to store single item from DB
            post.value = item
          }
        })
			}
			catch(err) {
				error.value = err.message
			}
		}
    console.log(post)
		load()
		return { post , error, load}
	}
}
</script>