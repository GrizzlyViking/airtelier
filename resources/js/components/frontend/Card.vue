<template>
		<div class="card">
			<div class="card-header"><h1>Card details</h1></div>
			<div class="card-body">
				<div class="form-group">
					<label>Amount:</label>
					<div class="form-control">DKK {{ cart.total }}</div>
				</div>
				<div class="form-group">
				    <label for="card-holder-name">Name:</label>
				    <input
						type="text"
						id="card-holder-name"
						class="form-control"
						name="card-holder-name"
						v-model="cardHolderName"
						placeholder="Enter Name"
					>
				</div>

				<!-- Stripe Elements Placeholder -->
				<div class="form-group">
					<label for="card-holder-name">Card details:</label>
					<div id="card-element"></div>
				</div>

				<div class="form-group float-right mt-4">
					<button class="btn btn-success" id="card-button" @click="contactStripe">
						Pay
					</button>
				</div>
			</div>
		</div>
</template>

<script>
    export default {
        name: "Card",
		props: ['intent', 'user', 'cart'],
		data() {
        	return {
				cardHolderName: this.user.name,
        		stripe: {},
				cardElement: {},
				clientSecret: ''
			}
		},
		methods: {
        	contactStripe() {

				this.stripe.confirmCardPayment(this.intent.client_secret, {
						payment_method: {
							card: this.cardElement,
							billing_details: {
								name: this.cardHolderName,
							}
						}
					})
					.then((result, error) => {
						console.log('success');
						console.log(result);
					});
			}
		},
		mounted() {
        	this.stripe = Stripe(process.env.MIX_STRIPE_KEY);
        	let elements = this.stripe.elements();
			this.cardElement = elements.create('card');
			this.cardElement.mount('#card-element');
			this.clientSecret = this.intent.client_secret;
		}
	}
</script>
