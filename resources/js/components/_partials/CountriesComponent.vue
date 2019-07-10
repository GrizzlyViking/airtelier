<template>
    <select-component :key="reload" :options="options" input_name="country" label="name" initial-value="DK"></select-component>
</template>

<script>
    export default {
        name: "CountriesComponent",
        data() {
            return {
                'options': [
                    {'code': 'DK', 'name': 'Denmark'}
                ],
                'reload': false
            }
        },
        methods: {
            fetchCountries() {
                axios.get('/api/countries').then(response => {
                    this.options = response.data;
                    this.reload = true;
                });
            }
        },
        mounted() {
            this.fetchCountries();
        }
    }
</script>
