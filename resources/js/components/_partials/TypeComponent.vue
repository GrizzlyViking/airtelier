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
            :reduce="option => option.id"
            required
        ></v-select>
        <input v-if="!edit" readonly v-model="showType" class="form-control">
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
                label: 'type',
                selected: this.value,
                options: [],
                reload: false
            }
        },
        methods: {
            fetchTypes() {
                axios.get('/api/types').then(response => {
                    console.log(response.data);
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
            },
            showType() {
                if (this.selected && this.options.length > 0) {
                    return _.find(this.options, option => {
                        return option.id === this.selected;
                    }).type;
                }

                return 'Type';
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
