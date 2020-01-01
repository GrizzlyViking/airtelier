<template>
    <form class="container" @submit.prevent="saveForm">
        <div>
            <div class="form-group">
                <label for="owner_id">Owner</label>
                <user-component id="owner_id" v-model="resource.owner_id" :errors="errors.owner_id" :edit="edit"></user-component>
            </div>

            <div class="form-group">
                <label>Type</label>
                <type-component v-model="resource.type_id" @types="setTypes" :errors="errors.type_id" :edit="edit"></type-component>
            </div>

            <div class="form-group">
                <label for="title" class="title">Title</label>
                <input id="title" type="text" :readonly="!edit" :class="{'is-invalid': !isValid, 'form-control': true}" placeholder="Enter title" v-model="resource.title">
                <div class="invalid-feedback">You must provide a title.</div>
            </div>

            <div class="form-group">
                <label for="sub_title">Sub Title</label>
                <input id="sub_title" type="text" :readonly="!edit" :class="{'form-control': true}" placeholder="Enter sub title" v-model="resource.sub_title">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <editor-component id="description" rows="5" v-model="resource.description" :edit="edit"></editor-component>
            </div>
        </div>

        <hr>

        <address-component v-model="resource.address" :edit="edit"></address-component>

        <hr>

        <meta-component name="meta" id="meta" v-model="resource.meta" :edit="edit"></meta-component>

        <button v-if="edit" type="submit" class="btn btn-outline-primary" :disabled="!isValid">Save</button>
        <button v-if="!edit" type="button" class="btn btn-outline-primary" @click.prevent="editMode">Edit</button>
    </form>
</template>

<script>
    export default {
        name: 'resource',
        props: {
            initial: {
                type: Object,
                default: () => {
                    return {};
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
                resource: this.initial,
                edit: this.action !== 'show',
                storage_action: this.action,
                types: [],
                errors: []
            }
        },
        methods: {
            updateresource() {
                axios
                    .patch('/resources/' + this.resource.id, this.resource, ['country'])
                    .then(response => {
                        window.location.href = '/resources/' + this.resource.id;
                    })
                    .catch(error => {
                        if (error.response.status === 403) {
                            Vue.$toast.open({
                                message: error.response.data.message,
                                type: 'error',
                            });

                            this.resource = this.initial;

                            this.readOnlyMode();
                        }
                    })
            },
            createresource(){
                axios.post('/resources', this.resource)
                    .then(response => {
                        this.resource = response.data;
                        this.storage_action = 'update';
                    })
                    .catch(error => {
                        this.errors = _.map(error.response.data.errors, (value, assoc) => {
                            return {
                                field: assoc,
                                message: value
                            };
                        }).filter(err => {
                            return _.endsWith(err.field, '_id');
                        });

                        this.errors = _.mapKeys(this.errors, err => { return err.field });
                    });
            },
            saveForm() {
                if (this.storage_action === 'update') {
                    this.updateresource();
                } else if (this.storage_action === 'create') {
                    this.createresource();
                } else {

                    console.log('something weird is going on: ' + this.storage_action );
                }
            },
            setTypes(types) {
                this.types = types;
            },
            editMode() {
                this.edit = true;
                this.storage_action = 'update';
                window.history.pushState("object or string", "Title", '/resources/'+this.resource.id+'/edit');
            },
            readOnlyMode() {
                this.edit = false;
                this.storage_action = 'show';
                window.history.pushState("object or string", "Title", '/resources/'+this.resource.id);
            }
        },
        computed: {
            isValid() {
                return this.resource !== undefined && this.resource.title !== undefined && this.resource.title.length > 2;
            },
            type_name() {
                if (this.types[this.resource.type_id - 1] === undefined) {
                    return this.resource.type;
                }

                return this.types[this.resource.type_id - 1].type;
            }
        }
    }
</script>
