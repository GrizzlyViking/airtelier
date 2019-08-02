<template>
    <vue-editor v-model="content" @input="handleInput" style="background-color: white;"></vue-editor>
</template>

<script>
    import { VueEditor } from "vue2-editor";

    export default {
        props: ['value'],
        data() {
            return {
                content: this.value
            }
        },
        methods: {
            handleInput() {
                this.$emit('input', this.content);
            }
        },
        components: {
            VueEditor
        }
    };
</script>
