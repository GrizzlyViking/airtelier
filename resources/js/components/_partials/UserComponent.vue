<template>
    <select-component :key="reload" :options="options" v-model="selected" @input="handleInput" input_name="owner_id" label="name"></select-component>
</template>

<script>
    export default {
        name: "UserComponent",
        props: ['value'],
        data() {
            return {
                selected: this.value,
                options: [],
                reload: false
            }
        },
        methods: {
            handleInput() {
                this.$emit('input', this.selected)
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
        mounted() {
            this.fetchUsers();
        }
    }
</script>
