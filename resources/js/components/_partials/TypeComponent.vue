<template>
    <div>
        <v-select
            v-model="selected"
            style="background-color: white;"
            @input="handleInput"
            :label="label"
            :key="reload"
            :options="options"
            :reduce="option => option.id"
            required
        ></v-select>
        <span v-if="showErrors" class="is-invalid">{{ errors.message.join(', ') }}.</span>
    </div>
</template>

<script>
    export default {
        name: "TypeComponent",
        props: {
            value: {
                type: Number
            },
            errors: {
                type: Object,
                default() {
                    return {}
                }
            }
        },
        data() {
            return {
                label: 'type',
                selected: this.value,
                options: [],
                reload: false
            }
        },
        methods: {
            fetchTypes() {
                axios.get('/api/types').then(response => {
                    this.$emit('types', response.data);
                    this.options = response.data.map(option => {
                        option.type = _.startCase(_.toLower(option.type));

                        return option;
                    });
                    this.reload = true;
                });
            },
            handleInput() {
                this.$emit('input', this.selected);
            }
        },
        computed: {
            showErrors() {
                return this.errors.message !== undefined
            }
        },
        mounted() {
            this.fetchTypes();
        }
    }
</script>

<style>
    .is-invalid {
        color: red;
    }
</style>
