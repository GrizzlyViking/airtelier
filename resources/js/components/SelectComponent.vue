<template>
    <div>
        <v-select
                v-model="selected"
                :label="label"
                :options="select_options"
                :reduce="option => option.id"
        ></v-select>
        <input type="hidden" :name="input_name" v-model="selected">
    </div>
</template>

<script>
    import vSelect from 'vue-select'
    export default {
        name: "SelectComponent",
        components: {vSelect},
        props: {
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
                type: String|Number
            }
        },
        data() {
            return {
                selected: {
                    _value: this.InitialValue
                },
                select_options: this.options
            }
        }
    }
</script>

<style scoped>

</style>
