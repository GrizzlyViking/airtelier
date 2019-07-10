<template>
    <select-component :key="reload" :options="options" input_name="type_id" label="type" ></select-component>
</template>

<script>
    export default {
        name: "TypeComponent",
        data() {
            return {
                'options': [
                ],
                'reload': false
            }
        },
        methods: {
            fetchCountries() {
                axios.get('/api/types').then(response => {
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
