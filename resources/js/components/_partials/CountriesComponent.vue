<template>
    <v-select
            v-model="selected"
            style="background-color: white;"
            @input="handleInput"
            :label="label"
            :key="reload"
            :options="options"
            :reduce="option => option.code"
    ></v-select>
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
                this.$emit('input', this.selected);
            }
        },
        mounted() {
            this.fetchTypes();
        }
    }
</script>
