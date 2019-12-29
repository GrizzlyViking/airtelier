<template>
    <div class="bg-dark-transparent justify-content-center shadow-lg">
        <div class="container">
            <div class="row justify-content-center">
                <ul class="nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle active" href="#" id="resourceDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Explore
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Articles</a>
							<a class="dropdown-item" href="/events">Events</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" v-for="resource in resources" :href="resource.type">{{ resource.type | capitalize}}</a>
						</div>
					</li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register" v-if="!loggedIn">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login" v-if="!loggedIn">Log In</a>
                    </li>
					<li class="nav-item dropdown" v-if="loggedIn">
						<a class="nav-link dropdown-toggle" :class="{ 'disabled': !loggedIn }" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Account
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Account</a>
							<a class="dropdown-item" @click="logout">Logout</a>
						</div>
					</li>
					<shopping-cart ref="cart" @click="refreshCart"></shopping-cart>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "HeaderComponent",
		props: {
        	loggedIn: {
        		type: Boolean,
				default: 0
			},
        	resources: {
        		type: Array,
				default() {
        			return [];
				}
			}
		},
		methods: {
			refreshCart() {
				console.log('header component level clicked');
				this.$refs.cart.fetchCart();
			},
			logout() {
				axios.post('/logout', {})
					.then(response => {
						console.log(response.data);
						window.location.href = '/login';
					})
					.catch(error => {
					console.log('error');
					console.log(error);
				});
			}
		}
    }
</script>

<style scoped>

</style>
