<template>
	<li class="nav-item dropdown" @click="fetchCart">
		<a class="nav-link dropdown-toggle" href="#" id="cart" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<shopping-cart-icon></shopping-cart-icon>
		</a>
		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="#" v-for="item in cart">{{ item.slug }} <span class="badge badge-secondary">{{ item.quantity }}</span></a>
		</div>
	</li>
</template>

<script>
	import { ShoppingCartIcon } from 'vue-feather-icons'
    export default {
        name: "ShoppingCart",
		components: {
			ShoppingCartIcon
		},
		data() {
        	return {
        		cart: {}
			}
		},
		methods: {
        	fetchCart() {
        		axios.get('/cart/basket')
					.then(response => {
						this.cart = response.data;
					}).catch(error => {
					     console.log('error');
					     console.log(error);
					});
			}
		}
    }
</script>

<style scoped>

</style>
