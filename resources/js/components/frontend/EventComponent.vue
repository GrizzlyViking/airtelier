<template>
	<div class="card shadow mt-2" @click="displayModal(item)">
		<img class="card-img-top" :src="compactFunction">
		<div class="row align-items-center" v-if="compact === false">
			<div class="col-10">
				<div class="card-header pt-3">
					<div class="h4 font-weight-bold color-blue">{{ item.title }}</div>
					<div class="card-subtitle text-muted">{{ item.sub_title }}</div>
				</div>
				<div class="card-body" v-html="item.description"></div>
			</div>
		</div>
		<div class="card-header" v-if="compact">
			<div class="h5">{{ item.title }}</div>
		</div>
		<div v-if="compact" class="card-body text-truncate">{{ item.description | removeHTMLTags }}</div>
		<div class="card-footer d-flex justify-content-around">
			<div v-if="item.start && !compact" class="text-muted">Starts on {{ item.start }}</div>
			<div class="text-muted"></div>
			<div v-if="item.end && !compact" class="text-muted">Ends on {{ item.end }}</div>
		</div>
	</div>
</template>

<script>
    import {CalendarIcon} from 'vue-feather-icons'

    export default {
        name: "EventComponent",
        props: {
            item: {
                type: Object,
                default() {
                    return {}
                }
            },
			compact: {
                type: Boolean,
				default() {
                    return false;
                }
            }
        },
        components: {
            CalendarIcon
        },
		data() {
            return {
                src: ''
			}
		},
		methods: {
            displayModal(item) {
            	this.$emit('modal', item);
			}
		},
		filters: {
            frequency(frq) {
                let unit = _.keys(frq)[0];
                switch (unit) {
					default:
					case 'monthly':
					  return unit + ' on the ' + frq[unit];
					case 'weekly':
					  return unit + ' on ' + frq[unit];
					case 'weekdays':
					    return unit + ' from ' + frq[unit];
                }
			},
            removeHTMLTags(string) {
                return string.replace(/<.+?>/g, '');
			},
			compactImage(gallery) {
                return gallery[0].file
			}
		},
		computed: {
            compactFunction() {
            	if (!this.item.gallery) {
            		return '';
				}
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
