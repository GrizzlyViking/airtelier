<template>
    <select-component v-model="selected" @input="handleInput" :key="reload" :options="options" input_name="country" label="name" initial-value="DK"></select-component>
</template>

<script>
    export default {
        name: "CountriesComponent",
        props: ['value'],
        data() {
            return {
                selected: this.value,
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
