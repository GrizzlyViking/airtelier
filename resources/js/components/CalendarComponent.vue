<template>
	<div>
    <FunctionalCalendar
		v-model="calendarData"
		:configs="calendarConfigs"
		@choseDay="selectedDate"
	></FunctionalCalendar>
		<div class="card mt-2" v-if="dateSelected">
			<div class="card-body">
				<h4 class="card-title">{{ dateSelected.getDate() }} {{ monthNames[dateSelected.getMonth()] }} {{ dateSelected.getFullYear() }}</h4>
				<h5 class="card-subtitle text-muted">{{ weekdayNames[dateSelected.getDay()] }}</h5>
				<hr />
				<ul class="list-group list-group-flush">
					<li class="list-group-item" v-for="bucket in buckets">
						<div class="row">
							<div class="col-1">{{ bucket.from.getHours() }}:00</div>
							<div class="col-11">
								<button type="button" @click="requestSchedule(bucket)" :key="bucket.id" :class="buttonClasses(bucket)" v-if="isAvailable(bucket)">{{ bucket.slots | firstElementName }}</button>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</template>

<script>
	import { FunctionalCalendar } from 'vue-functional-calendar';

    export default {
        name: "CalendarComponent",
		components: {
			FunctionalCalendar
		},
		props: ['resource'],
		data() {
        	return {
				monthNames: ["January", "February", "March", "April", "May", "June",
					"July", "August", "September", "October", "November", "December"
				],
				weekdayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        		dateSelected: false,
        		buckets: [],
				available: [],
				testBucket: false,
				calendarData: this.value,
				calendarConfigs: {
        			sundayStart: false,
					dateFormat: 'yyyy-mm-dd',
					isDatePicker: true
				}
			}
		},
		filters: {
        	firstElementName(slots) {
				return _.head(slots).name;
			}
		},
		methods: {
        	generateTimeBuckets(from, till) {
				this.buckets = [];
				for (let i = from; i < till; i++) {
					let d = _.clone(this.dateSelected);
					d.setHours(i);
					d.setMinutes(0);
					d.setSeconds(0);
					d.setMilliseconds(0);
					let till = _.clone(d);
					till.setHours(i+1);
					till.setMinutes(0);
					till.setSeconds(0);
					till.setMilliseconds(0);
					this.buckets.push({
						from: d,
						till: till,
						available: false,
						bought: false,
						slots: []
					});
				}
			},
			fillBuckets(data) {
        		_.each(this.buckets, function (bucket) {
        			bucket.slots = _.filter(data, function (availableTimeSlot) {
        				return (availableTimeSlot.starts_at < bucket.till) && (availableTimeSlot.starts_at >= bucket.from)
					});
				});
			},
        	buttonClasses (bucket) {
        		return {
					'btn': true,
					'btn-outline-secondary': bucket.status !== 'available',
					'btn-primary': bucket.status === 'available',
					'btn-block': true
				}
			},
			requestSchedule(bucket) {
        		let schedule = _.first(bucket.slots, function(slot) {
        			return slot.status === 'available';
				});
        		console.log(schedule);
        		axios.post(this.resource.slug + '/request', schedule).then(response => {
        			console.log(response);
				});
			},
			selectedDate (clicked) {
        		let self = this;
				this.dateSelected = this.createDate(clicked.date);
				this.generateTimeBuckets(8,18);
        		axios.get('/api/' + this.resource.slug + '/calendar/' + clicked.date)
				.then(function (response) {
					self.available = _.map(response.data, function (slot) {
						slot.starts_at = new Date(slot.starts_at);
						slot.starts_at.setMilliseconds(0);
						slot.ends_at = new Date(slot.ends_at);
						return slot;
					})
					self.fillBuckets(response.data);
				});
			},
			createDate (date) {
				let exploded = date.split('-');
        		let d = new Date();
        		d.setFullYear(exploded[0]);
        		d.setMonth(exploded[1]-1);
        		d.setDate(exploded[2]);
        		d.setMinutes(0);
        		d.setSeconds(0);

        		return d;
			},
			isAvailable (bucket) {
        		let available = _.filter(bucket.slots, function (slot) {
        			return slot.status === 'available';
				});

        		return available.length > 0;
			},
			changeStatus (schedule) {
        		let starts_at = new Date(schedule.starts_at);
        		_.each(this.buckets, function(bucket) {
        			if (starts_at >= bucket.from && starts_at < bucket.till) {
						_.map(bucket.slots, function (slot) {
							if (slot.id === schedule.id) {
								slot.status = schedule.status;
							}
							return slot;
						})
					}
				});
			}
		},
		mounted() {
        	let self = this;
        	let channel = Echo.channel('airtelier-channel');
			channel.listen('.resource-' + this.resource.id, function(data) {
				self.changeStatus(data.schedule);
			});
		}
	}
</script>
