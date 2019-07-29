<template>
    <select-component v-model="selected" :key="reload" :options="options" input_name="type_id" label="type" @input="handleInput"></select-component>
</template>

<script>
    export default {
        name: "TypeComponent",
        props: ['value'],
        data() {
            return {
                selected: this.value,
                'options': [],
                'reload': false
            }
        },
        methods: {
            fetchCountries() {
                axios.get('/api/types').then(response => {
                    this.options = response.data;
                    this.reload = true;
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
