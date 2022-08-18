<template>
	<section class="feature-section">
      <ul>
        <li v-for="product in products" :key="product.id">
          <img :src="product.img" />
        </li>
      </ul>
    </section>
    
</template>
<script>
export default {
    data() {
      return {
        products: [
          {img: '/img/speaker.png', caption : 'Product One', price : 99 , id: 1},
          {img: './img/phone.png', caption : 'Product Two', price : 100, id: 2},
          {img: './img/laptop.png', caption : 'Product Three', price : 101, id: 3},
          {img: './img/speaker.png', caption : 'Product Four', price : 102, id: 4},
          {img: './img/speaker.png', caption : 'Product Four', price : 102, id: 4},
          {img: './img/speaker.png', caption : 'Product Four', price : 102, id: 4},
          {img: './img/speaker.png', caption : 'Product Four', price : 102, id: 4},
          {img: './img/speaker.png', caption : 'Product Four', price : 102, id: 4},
          {img: './img/speaker.png', caption : 'Product Four', price : 102, id: 4},
          {img: './img/speaker.png', caption : 'Product Four', price : 102, id: 4}
        ]
      }      
    }
}
</script>

<style>
	.feature-section ul {
		display:flex;
		text-align:center;
		align-items:center;
		list-style:none;
		justify-content:center;
	}
	.feature-section ul li {
		padding:5px 10px;
		margin:5px;
		cursor:pointer;
	}
	.feature-section ul li:hover {
		transition:.3s;
		transform:scale(1.05);
		box-shadow:1px 1px 10px 1px gray; 
	}
  .feature-section img {
    width: 50px;
  }
  .add-product-form {
    width: 50%;
    margin: 0 auto;
  }
</style>