<template>
    <form @submit.prevent="submitForm">
        <div class="form-group">
            <label for="author_id">Author</label>
            <user-component id="author_id" v-model="article.author_id" :edit="edit"></user-component>
        </div>


        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" v-model="article.title" :readonly="!edit" placeholder="Enter title">
        </div>

        <div class="form-group">
            <label for="sub_title">Sub Title</label>
            <input type="text" class="form-control" id="sub_title" v-model="article.sub_title" :readonly="!edit" placeholder="Enter sub title">
        </div>

        <div class="form-group">
            <label for="resume">Short description</label>
            <editor-component id="resume" :edit="edit" v-model="article.resume"></editor-component>
        </div>

        <div class="form-group">
            <label for="content">Long description</label>
            <editor-component id="content" v-model="article.content" :edit="edit"></editor-component>
        </div>

        <div class="form-group">
            <label for="publish">When to publish Article</label>
            <date-time-component id="publish" v-model="article.publish" :edit="edit"></date-time-component>
        </div>

        <button type="button" class="btn btn-success float-right" @click.prevent="submitForm">Save</button>
    </form>
</template>

<script>
    export default {
        name: "ArticleComponent",
        props: {
            value: {
                type: Object,
                default() {
                    return {
                        publish: new Date()
                    }
                }
            },
            action: {
                type: String,
                default: 'create'
            }
        },
        methods: {
            createArticle() {
                axios.post('/articles', this.article)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => { console.log(error.response.data);});
            },
            updateArticle() {
                axios.patch('/articles/'+this.article.id, this.article)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => { console.log(error.response.data);});
            },
            submitForm() {
                if (this.action === 'create') {
                    this.createArticle();
                } else {
                    this.updateArticle();
                }
            }
        },
        data() {
            return {
                article: this.value,
                edit: this.action !== 'show'
            }
        }
    }
</script>

<style scoped>
    .form-control-input > input {
        background-color: red !important;
    }
</style>
