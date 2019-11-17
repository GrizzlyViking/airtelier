<template>
	<div class="card shadow mt-2">
		<div class="row align-items-center">
			<div class="col-2 pl-5">
				<div class="icon-porthole bg-light">
					<codepen-icon v-if="offer.type == 'skill'"></codepen-icon>
					<pen-tool-icon v-if="offer.type == 'resource'"></pen-tool-icon>
					<map-icon v-if="offer.type == 'location'"></map-icon>
				</div>
			</div>
			<div class="col-10">
				<div class="card-header pt-3">
					<div class="h4 font-weight-bold color-blue">{{ offer.title }}</div>
					<div class="card-subtitle text-muted">{{ offer.sub_title }}</div>
				</div>
				<div class="card-body" v-html="offer.description">
				</div>
			</div>
		</div>
		<div class="card-footer d-flex justify-content-around">
			Footer
		</div>
	</div>
</template>

<script>
	import { CodepenIcon, PenToolIcon, MapIcon } from 'vue-feather-icons';

    export default {
        name: "OfferComponent",
		components: {
            CodepenIcon,
            PenToolIcon,
            MapIcon
		},
		props: {
            offer: {
                type: Object,
				default() {
                    return {};
				}
			}
		}
    }
</script>

<style scoped>

</style>
