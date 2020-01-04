<template>
	<li class="nav-item dropdown" @click="fetchCart">
		<a class="nav-link dropdown-toggle" href="#" id="cart" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<shopping-cart-icon></shopping-cart-icon>
		</a>
		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="#" v-for="item in cart.basket">{{ item.slug }} <span class="badge badge-secondary">{{ item.quantity }}</span></a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item d-flex justify-content-around">
				<div class="btn btn-primary">Count: {{ cart.count }}</div>
				<div class="btn btn-primary">Total: {{ cart.total }}</div>
				<button
					type="button"
					class="btn btn-success"
					:class="checkout_class"
					@click="proceedToCheckout"
				>Checkout</button>
			</a>
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
        		cart: {},
				checkout_class: {
        			disabled: true
				}
			}
		},
		methods: {
        	proceedToCheckout() {
				window.location.href = '/checkout'
			},
        	fetchCart() {
        		axios.get('/cart/basket')
					.then(response => {
						this.cart = response.data;
						this.checkout_class.disabled = this.cart.count <= 0;
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
