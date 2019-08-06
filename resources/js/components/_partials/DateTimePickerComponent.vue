<template>
    <div class="input-group">
        <v-datepicker
            :id="name"
            :name="name"
            :typeable="edit"
            :disabled="!edit"
            v-model="datepicker_date"
            wrapper-class="col-6 mr-0 pr-0 pl-0"
            input-class="form-control rounded-right-0 text-center"
            @input="handleInput"
        ></v-datepicker>
        <input type="text" :readonly="!edit" class="form-control col-6" v-model="datepicker_time" @input="handleInput">
    </div>
</template>

<script>
    export default {
        name: "DateTimePickerComponent",
        props: {
            name: {
                type: String
            },
            value: {
                type: String|Date,
                default: ''
            },
            edit: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                datepicker_date: this.value.replace(/\s.*$/, ''),
                datepicker_time: this.value.replace(/^.*\s/, '')
            }
        },
        methods: {
            handleInput() {
                if (this.datepicker_date instanceof Date) {
                    this.datepicker_date = Vue.moment(this.datepicker_date).format('YYYY-MM-DD');
                }
                this.$emit('input', this.datepicker_date.replace(/\s.*$/, '')+' '+this.datepicker_time);
            }
        }
    }
</script>

<style scoped>

</style>
