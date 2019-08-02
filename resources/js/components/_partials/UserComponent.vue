<template>
    <div>
        <v-select
            v-model="selected"
            style="background-color: white;"
            :class="{'is-invalid': true}"
            @input="handleInput"
            :label="label"
            :key="reload"
            :options="options"
            :reduce="option => option.id"
        ></v-select>
        <span v-if="showErrors" class="is-invalid">{{ errors.message.join(', ') }}.</span>
    </div>
</template>

<script>
    export default {
        name: "UserComponent",
        props: {
            value: {
                type: Number,
                default: null
            },
            errors: {
                type: Object,
                default() {
                    return {};
                }
            }
        },
        data() {
            return {
                selected: this.value,
                label: "name",
                options: [],
                reload: false
            }
        },
        methods: {
            handleInput() {
                this.showErrors = false;
                this.$emit('input', this.selected);
            },
            fetchUsers() {
                axios.get('/api/users')
                    .then(response => {
                        this.options = response.data;
                        this.reload = new Date().getTime();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        computed: {
            showErrors() {
                return this.errors.message !== undefined
            }
        },
        mounted() {
            this.fetchUsers();
        }
    }
</script>

<style>
    .is-invalid {
        color: red !important;
    }
</style>
