<template>
	<div class="card-columns p-4">
		<div v-for="item in items"
			 :is="componentType(item)"
			 @modal="displayItem(item)"
			 :key="item.id + item.created_at"
			 :item="item"
			 :compact="true"
		></div>
		<modal-component :show="showModal" :item="clickedItem" @closeModal="closeModal"></modal-component>
	</div>
</template>

<script>
    export default {
        name: "ListComponent",
		props: {
        	items: {
        		type: Array,
				default() {
        			return []
				}
			}
		},
		data() {
        	return {
        		showModal: false,
				clickedItem: {}
			}
		},
		methods: {
			displayItem(item) {
				this.showModal = true;
				this.clickedItem = item;
			},
			componentType (item) {
				if (item.component_type === 'Event') {
					return 'frontend-event';
				}

				return 'frontend-offer';
			},
			closeModal() {
				this.showModal = false;
			}
		},
		computed: {

		}
    }
</script>

<style scoped>

</style>
