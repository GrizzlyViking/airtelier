<template>
    <v-select
            v-model="selected"
            style="background-color: white;"
            @input="handleInput"
            :label="label"
            :key="reload"
            :options="options"
    ></v-select>
</template>

<script>
    export default {
        name: "CountriesComponent",
        props: {
            value: {
                type: Object,
                default() {
                    return {'code': 'DK', 'name': 'Denmark'}
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
            fetchCountries() {
                axios.get('/api/countries').then(response => {
                    this.options = response.data;
                    this.reload = new Date().getTime();
                });
            },
            handleInput() {
                this.$emit('input', this.selected);
            }
        },
        mounted() {
            this.fetchCountries();
        }
    }
</script>
