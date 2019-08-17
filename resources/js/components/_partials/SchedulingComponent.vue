<template>
    <div @input="handleInput">
        <div class="form-group">
            <label for="start">Frequency</label>
            <v-select
                v-model="schedule.frequency"
                :options="frequencies"
                label="name"
            ></v-select>
        </div>

        <div class="form-group">
            <label for="start_date">First date</label>
            <v-datepicker
                :typeable="edit"
                :disabled="!edit"
                v-model="schedule.start_date"
                input-class="form-control"
                @input="handleInput"
            ></v-datepicker>
        </div>

        <div class="form-group">
            <label>Times <plus-circle-icon v-if="edit" height="16" @click="addTimeSlot"></plus-circle-icon></label>
            <div class="row" v-for="(row, index) in schedule.times">
                <input-group-dropdown
                    :edit="edit"
                    class="col-7 mb-3"
                    v-model="schedule.times[index]"
                    :key="new Date().getTime() + index"
                    @remove="$delete(testData, index)"
                ></input-group-dropdown>
            </div>
        </div>
    </div>
</template>

<script>
    import { PlusCircleIcon } from 'vue-feather-icons';
    export default {
        name: "SchedulingComponent",
        components: {PlusCircleIcon},
        props: {
            value: {
                type: Object,
                default() {
                    return {
                        times: []
                    }
                }
            },
            edit: {
                type: Boolean,
                default() {
                    return true;
                }
            }
        },
        data() {
            return {
                schedule: this.value,
                frequencies: [
                    {id: 'daily', template: 'repeat', name: 'Daily'},
                    {id: 'weekly', template: 'repeat', name: 'Weekly'},
                    {id: 'monthly', template: 'repeat', name: 'Monthly'},
                    {id: 'once', template: 'single', name: 'Once only'}
                ]
            }
        },
        methods: {
            handleInput() {
                this.$emit('input', this.schedule);
            },
            addTimeSlot() {
                this.schedule.times.push({
                    label: '',
                    start_time: '',
                    end_time: ''
                });
            }
        }
    }
</script>

<style scoped>

</style>
