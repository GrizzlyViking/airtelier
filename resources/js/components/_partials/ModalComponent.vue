<template>
	<div class="modal" tabindex="-1" role="dialog" v-show="show">
		<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" v-show="item.title">{{ item.title }}</h5>
					<button type="button" class="close" @click="closeModal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div is="frontend-event" :item="item"></div>
				</div>
				<div class="modal-footer">
					<buy-item-button v-model="item">Buy</buy-item-button>
					<button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        name: "ModalComponent",
		props: {
        	show: {
        		type: Boolean,
				default: false
			},
			item: {
        		type: Object,
				default() {
        			return {}
				}
			}
		},
		methods: {
        	closeModal() {
        		this.$emit('closeModal', false)
			}
		}
    }
</script>

<style scoped>
 .modal {
	 display: block;
 }
</style>
