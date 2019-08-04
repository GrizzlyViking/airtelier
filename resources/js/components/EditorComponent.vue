<template>
    <div>
        <vue-editor
            v-if="edit"
            v-model="content"
            @input="handleInput"
            :customModules="customModulesForEditor"
            :editorOptions="editorSettings"
            style="background-color: white;"
        ></vue-editor>
        <div v-if="!edit" class="form-control-readonly" v-html="content"></div>
    </div>
</template>

<script>
    import { VueEditor, Quill } from 'vue2-editor';
    import ImageResize from 'quill-image-resize';

    export default {
        props: ['value', 'edit'],
        data() {
            return {
                content: this.value,
                customModulesForEditor: [
                    { alias: "imageResize", module: ImageResize }
                ],
                editorSettings: {
                    modules: {
                        imageResize: {}
                    }
                }
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

<style>
    .form-control-readonly {
        background-color: #e9ecef;
        opacity: 1;
        padding: 0.375rem 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>
