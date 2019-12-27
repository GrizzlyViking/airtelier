<template>
    <form>
        <div class="form-group">
            <label for="author_id">Author</label>
            <user-component id="author_id" v-model="review.author_id" :edit="edit"></user-component>
        </div>

        <div class="form-group">
            <label for="reviewed_type">Type</label>
            <v-select
                v-if="edit"
                v-model="reviewed_type"
                style="background-color: white;"
                label="name"
                :options="reviewed_types"
                @input="typeHasChanged"
            ></v-select>
            <input v-if="!edit" readonly="!edit" v-model="reviewed_type.name" class="form-control">
        </div>

        <div class="form-group" v-if="review.reviewed_type">
            <label for="reviewed_id">{{ reviewed_type.name | capitalize }}</label>
            <v-select
                v-if="edit"
                v-model="review.reviewed"
                style="background-color: white;"
                :label="label"
                :key="reload"
                :options="reviewed_options"
                @input="reviewedTypeHasChanged"
            ></v-select>
            <input v-if="!edit" readonly="!edit" v-model="review.reviewed.title" class="form-control">
        </div>

        <div class="form-group">
            <label for="review">Rating</label>
            <star-rating v-model="review.rating" :increment="0.01" :star-size="40" :read-only="!edit"></star-rating>
        </div>

        <div class="form-group">
            <label for="description">Review comment</label>
            <editor-component v-model="review.description" :edit="edit"></editor-component>
        </div>

        <button class="btn btn-success float-right" @click.prevent="submitForm">{{ buttonText | capitalize }}</button>
    </form>
</template>

<script>
    export default {
        name: "ReviewComponent",
        props: {
            value: {
                type: Object,
                default() {
                    return {}
                }
            },
            action: {
                type: String,
                default() {
                    return 'create';
                }
            }
        },
        data() {
            return {
                edit: this.action !== 'show',
                errors: [],
                label: 'name',
                storage_action: this.action,
                reviewed_type: this.reviewedType(),
                reviewed_types: [
                    { id: 'skill', name: 'Skill', label: 'title', type: 'resources', 'model': 'App\\Models\\Resource'},
                    { id: 'resource', name: 'Resource', label: 'title', type: 'resources', 'model': 'App\\Models\\Resource'},
                    { id: 'location', name: 'Location', label: 'title', type: 'resources', 'model': 'App\\Models\\Resource'},
                    { id: 'resource', name: 'Resource', label: 'title', type: 'resources', 'model': 'App\\Models\\Resource'},
                    { id: 'events', name: 'Event', label: 'name', type: 'events', 'model': 'App\\Models\\Event'}
                ],
                review: this.value,
                reviewed_options: [],
                reload: false
            }
        },
        mounted() {
            this.assignReviewed();
        },
        methods: {
            reviewedTypeHasChanged() {
                this.review.reviewed_id = this.review.reviewed.id;
            },
            reviewedType() {
                return this.value.reviewed_type !== undefined ? this.value.reviewed_type : {};
            },
            assignReviewed() {
                if (this.review.reviewed !== undefined) {
                    this.review.reviewed_id = this.review.reviewed.id;
                    this.reviewed_type = _.find(this.reviewed_types, type => {
                        return type.id === this.review.reviewed.type;
                    });
                    this.fetchReviewed();
                }
            },
            typeHasChanged() {
                this.review.reviewed_id = undefined;
                this.fetchReviewed();
            },
            fetchReviewed() {
                if (this.reviewed_type === undefined) {
                    return true;
                }
                this.label = this.reviewed_type.label;
                this.review.reviewed_type = this.reviewed_type.model;
                axios.get('/'+this.reviewed_type.type, { params: {type: this.review.reviewed_type.id }}).then(response => {
                    this.reviewed_options = response.data;
                    this.reload = new Date().getTime();
                });
            },
            validate() {
                this.errors = [];
                if (!this.review.author_id) {
                    this.errors.push({review: 'you must select an author.'});
                }

                if (this.review.reviewed_type === undefined || this.review.reviewed_type.length < 1) {
                    this.errors.push({review: 'Please select the type of item to be reviewed.'});
                }
                if (this.reviewed_type !== undefined && !this.review.reviewed_id) {
                    this.errors.push({review: 'Please select a '+this.reviewed_type.name+' to review'});
                }

                this.errors.forEach(error => {

                    Vue.$toast.open({
                        message: error.review,
                        type: 'error'
                    });
                });

                return this.errors.length === 0;
            },
            updateReview() {
                axios.patch('/reviews/' + this.review.id, this.review)
                    .then(response => {
                        this.showMode();
                    })
                    .catch(error => { console.log(error.response.data)})
            },
            createReview() {
                axios.post('/reviews', this.review)
                    .then(response => {
                        this.showMode();
                    })
                    .catch(error => { console.log(error.response.data)})
            },
            updateMode() {
                this.edit = true;
                this.storage_action = 'update';
                window.history.pushState("object or string", "Title", '/reviews/'+this.review.id+'/edit');
            },
            showMode() {
                this.edit = false;
                this.storage_action = 'show';
                window.history.pushState("object or string", "Title", '/reviews/'+this.review.id);
            },
            submitForm() {
                this.review.reviewed_id = this.review.reviewed.id;

                if (!this.validate()) {
                    return false;
                } else if (this.storage_action === 'create') {
                    this.createReview();
                } else if (this.storage_action === 'update') {
                    this.updateReview();
                } else if (this.storage_action === 'show') {
                    this.updateMode()
                }
            }
        },
        computed: {
            buttonText() {
                if (this.storage_action === 'show') {
                    return 'edit';
                }
                return this.storage_action;
            }
        }
    }
</script>

<style scoped>

</style>
