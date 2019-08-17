<template>
    <div class="input-group row">
        <div class="col-6">
        <div class="input-group-prepend">
            <div v-if="Array.isArray(options.first) && options.first.length > 0">
                <button
                    class="btn btn-outline-secondary dropdown-toggle"
                    type="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >{{ input_group.label }}</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" v-for="item in options.first" @click="selectIt('first', item)">{{ item | capitalize }}</a>
                </div>
            </div>
        </div>
        </div>
        <input type="text" class="form-control col-3" v-model="input_group.start_time" aria-label="Text input with dropdown button">
        <input type="text" class="form-control col-3" v-model="input_group.end_time" aria-label="Text input with dropdown button">
    </div>
</template>

<script>
    export default {
        name: "InputGroupDropdownComponent",
        props: {
            value: {
                type: Object,
                default() {
                    return {}
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
                input_group: this.value,
                options: {
                    first: [
                        'Monday',
                        'Tuesday',
                        'Wednesday',
                        'Thursday',
                        'Friday',
                        'Saturday',
                        'Sunday',
                    ]
                }
            }
        },
        methods:
            {
                selectIt(section, itemSelected) {
                    this.input_group.label = itemSelected;
                },
                handleInput() {
                    this.$emit('input', this.input_group);
                }
            }
    }
</script>
