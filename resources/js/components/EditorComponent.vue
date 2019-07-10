<template>
    <vue-editor v-model="$attrs.value"></vue-editor>
</template>

<script>
    import { VueEditor } from "vue2-editor";

    export default {
        components: {
            VueEditor
        }
    };
</script>
