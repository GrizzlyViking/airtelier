<template>
	<div class="card shadow mt-2">
		<img class="card-img-top" :src="compactFunction">
		<div class="card-header">
			<h3>{{ item.title }}</h3>
			<div class="card-subtitle pb-3">{{ item.sub_title }}</div>
		</div>
		<div class="card-footer d-flex justify-content-around">
			Footer
		</div>
	</div>
</template>

<script>
	import { CodepenIcon, PenToolIcon, MapIcon } from 'vue-feather-icons';

    export default {
        name: "ResourceComponent",
		components: {
            CodepenIcon,
            PenToolIcon,
            MapIcon
		},
		props: {
            item: {
                type: Object,
				default() {
                    return {};
				}
			},
			compact: {
                type: Boolean,
				default() {
                    return false;
                }
            }
		},
		methods: {
            redirectToresource() {
                console.log('/' + this.item.type + '/' + this.item.slug);
                window.location.href = '/' + this.item.type + '/' + this.item.slug;
			}
		},
        computed: {
            compactFunction() {
                let images = this.item.gallery.filter(image => {
                    return image.pivot.purpose === 'compact';
                });

                return _.head(images).file;
            }
        }
    }
</script>

<style scoped>

</style>
