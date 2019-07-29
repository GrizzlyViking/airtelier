<template>
    <div>
        <v-select
                v-model="selected"
                style="background-color: white;"
                @input="handleInput"
                :label="label"
                :options="select_options"
        ></v-select>
        <input type="hidden" :name="input_name" v-model="selected">
    </div>
</template>

<script>
    export default {
        name: "SelectComponent",
        props: {
            value: {
                type: Object|Number
            },
            options: {
                type: Array,
            },
            label: {
                type: String,
                default: 'name'
            },
            input_name: {
                type: String,
                default() {
                    return this.label;
                }
            },
            'initial-value': {
                type: String|Number|Object
            }
        },
        methods: {
            handleInput() {
                this.$emit('input', this.selected);
            }
        },
        data() {
            return {
                selected: this.value,
                select_options: this.options
            }
        }
    }
</script>

<style scoped>

</style>
