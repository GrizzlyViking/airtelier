<template>
    <wysiwyg-editor height="480" :name="name" :class="body_class" :api-key="apiKey" :init="config" v-model="content"></wysiwyg-editor>
</template>

<script>
    export default {
        props: {
            content: {
                type: String,
                default: 'default text'
            },
            name: {
                type: String,
                default: 'default_name'
            },
            body_class: {
                type: String,
                default: 'form-control'
            },
            rows: {
                type: Number|String,
                default: 3
            },
            inline: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                apiKey: process.env.MIX_TINYMCE_API_KEY,
                lineHeight: 14,
                config: {
                    plugins: 'image',
                    inline: this.inline,
                    height: 480,
                    toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignjustify alignright | image',
                    automatic_uploads: true,
                    images_upload_base_path: 'img',
                    images_upload_url: 'images',
                    images_upload_handler: (blobInfo, success, failure) => {
                        let xhr, formData;
                        xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', '/images');
                        let token = $('meta[name="csrf-token"]').attr('content');
                        xhr.setRequestHeader("X-CSRF-Token", token);
                        xhr.onload = function() {
                            let json;
                            if (xhr.status !== 200) {
                                failure('HTTP Error: ' + xhr.status);
                                return;
                            }
                            json = JSON.parse(xhr.responseText);

                            if (!json || typeof json.location != 'string') {
                                failure('Invalid JSON: ' + xhr.responseText);
                                return;
                            }
                            success(json.location);
                        };
                        formData = new FormData();
                        formData.append('uploaded_file', blobInfo.blob(), blobInfo.filename());
                        xhr.send(formData);
                    }
                }
            }
        }
    }
</script>
