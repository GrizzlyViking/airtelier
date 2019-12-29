<template>
	<button type="button" class="btn btn-primary" @click="intoCart"><slot></slot></button>
</template>

<script>
    export default {
        name: "BuyButton",
		props: {
        	value: {
        		type: Object,
				default() {
        			return {}
				}
			}
		},
		methods: {
        	intoCart() {
        		axios.post('cart/add', {
        			item_type: this.value.class,
					item_id: this.value.id,
					quantity: 1
				});
			}
		}
    }
</script>

<style scoped>

</style>
