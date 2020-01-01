<template>
    <div>
        <v-select
            v-if="edit"
            v-model="selected"
            style="background-color: white;"
            @input="handleInput"
            :label="label"
            :key="reload"
            :options="options"
        ></v-select>
		<input v-if="!edit" readonly class="form-control" v-model="countryName">
    </div>
</template>

<script>
    export default {
        name: "CountriesComponent",
        props: {
            value: {
                type: Object|String,
                default() {
                    return {'code': 'DK', 'name': 'Denmark'}
                }
            },
            edit: {
                type: Boolean,
                default() {
                    return false;
                }
            }
        },
        data() {
            return {
                label:    'name',
                selected: this.value,
                options:  [],
                reload:   false
            }
        },
        methods: {
            fetchTypes() {
                axios.get('/api/countries').then(response => {
                    this.options = response.data;
                    this.reload = new Date().getTime();
                });
            },
            handleInput() {
            	console.log('emit should take place');
                this.$emit('input', this.selected);
            }
        },
        computed: {
            countryName() {
                if (this.selected && this.options.length > 0) {
                    return _.find(this.options, option => { return this.selected.country_code === option.country_code; }).name;
                } else {
                    return this.selected.name;
                }
            }
        },
        mounted() {
            this.fetchTypes();
        }
    }
</script>
