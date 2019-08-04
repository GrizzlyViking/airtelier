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
            :reduce="option => option.code"
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
                this.$emit('input', this.selected);
            }
        },
        computed: {
            countryName() {
                if (this.selected && this.options.length > 0) {
                    return _.find(this.options, option => { return this.selected === option.code; }).name;
                }
            }
        },
        mounted() {
            this.fetchTypes();
        }
    }
</script>
