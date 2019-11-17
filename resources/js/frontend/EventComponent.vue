<template>
	<div class="card shadow mt-2">
		<div class="row align-items-center" v-if="compact === false">
			<div class="col-2 pl-5">
				<div class="icon-porthole bg-light">
					<calendar-icon></calendar-icon>
				</div>
			</div>
			<div class="col-10">
				<div class="card-header pt-3">
					<div class="h4 font-weight-bold color-blue">{{ event.title }}</div>
					<div class="card-subtitle text-muted">{{ event.sub_title }}</div>
				</div>
				<div class="card-body" v-html="event.description"></div>
			</div>
		</div>
		<img class="card-img-top" src="/storage/images/ameE4uuhtWMxodBofdsVMwF7DehZ0pIxRR1stpiQ.png">
		<div class="card-header" v-if="compact">
			<div class="h5">{{ event.title }}</div>
		</div>
		<div v-if="compact" class="card-body text-truncate">{{ event.description | removeHTMLTags }}</div>
		<div class="card-footer d-flex justify-content-around">
			<div v-if="event.start && !compact" class="text-muted">Starts on {{ event.start }}</div>
			<div class="text-muted">{{ event.frequency | frequency }}</div>
			<div v-if="event.end && !compact" class="text-muted">Ends on {{ event.end }}</div>
		</div>
	</div>
</template>

<script>
    import {CalendarIcon} from 'vue-feather-icons'

    export default {
        name: "EventComponent",
        props: {
            event: {
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
			}
		}
    }
</script>

<style scoped>

</style>
