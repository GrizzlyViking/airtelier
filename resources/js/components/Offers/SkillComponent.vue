<template>
    <form class="container" @submit.prevent="saveForm">
        <div v-if="edit">
            <div class="form-group">
                <label for="owner_id">Owner</label>
                <user-component id="owner_id" v-model="offer.owner_id" :errors="errors.owner_id"></user-component>
            </div>

            <div class="form-group">
                <label>Type</label>
                <type-component v-model="offer.type_id" @types="setTypes" :errors="errors.type_id"></type-component>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" :class="{'is-invalid': offer.name !== undefined && offer.name.length <= 3}" placeholder="Enter name" v-model="offer.name">
                <div class="invalid-feedback">You must provide a title.</div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <editor-component id="description" name="description" body_class="form-control" rows="5"
                                  v-model="offer.description"></editor-component>
            </div>
        </div>

        <div v-if="!edit">
            <div class="card">


                <div class="card-text">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-12 font-weight-bolder">Name:</div>
                                <div class="col-12">
                                    {{offer.name}}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-12 font-weight-bolder">Type:</div>
                                <div class="col-12">
                                    {{offer.type}}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-12 font-weight-bolder">Owner:</div>
                                <div class="col-12">
                                    {{offer.owner.name}}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-12 font-weight-bolder">Description:</div>
                                <div class="col-12" v-html="offer.description"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <hr>

        <address-component v-model="offer.address" :edit="edit"></address-component>

        <hr>

        <meta-component name="meta" id="meta" v-model="offer.meta" :edit="edit"></meta-component>

        <button v-if="edit" type="submit" class="btn btn-outline-primary" :disabled="!isValid">Save</button>
        <button v-if="!edit" type="submit" class="btn btn-outline-primary" @click="edit = !edit">Edit</button>
    </form>
</template>

<script>
    export default {
        name: 'skill',
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
                offer: this.initial,
                edit: this.action !== 'show',
                storage_action: this.action,
                types: [],
                errors: []
            }
        },
        methods: {
            updateOffer() {
                axios
                    .patch('/offers/' + this.offer.id, this.offer, ['country'])
                    .then(response => {
                        window.location.href = '/offers/' + this.offer.id;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            createOffer(){
                axios.post('/offers', this.offer)
                    .then(response => {
                        this.offer = response.data;
                        this.storage_action = 'update';
                    })
                    .catch(error => {
                        console.log('error');
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
                    this.updateOffer();
                } else if (this.storage_action === 'create') {
                    this.createOffer();
                }
            },
            setTypes(types) {
                this.types = types;
            }
        },
        computed: {
            isValid() {
                return this.offer.name !== undefined && this.offer.name.length > 2;
            },
            type_name() {
                if (this.types[this.offer.type_id - 1] === undefined) {
                    return this.offer.type;
                }

                return this.types[this.offer.type_id - 1].type;
            }
        }
    }
</script>

<style scoped>

</style>
