<template>
    <form class="container" @submit.prevent="saveForm">
        <div v-if="edit">
            <div class="form-group">
                <label for="owner_id">Owner</label>
                <user-component id="owner_id" v-model="offer.owner"></user-component>
            </div>

            <div class="form-group">
                <label>Type</label>
                <type-component v-model="offer.offer_type"></type-component>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                       v-model="offer.name">
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
                                    {{offer.offer_type.type}}
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

        <address-component :address="offer.address" :edit="edit"></address-component>

        <hr>

        <meta-component name="meta" id="meta" v-model="offer.meta" :edit="edit"></meta-component>

        <button v-if="edit" type="submit" class="btn btn-outline-primary">Save</button>
        <button v-if="!edit" type="submit" class="btn btn-outline-primary" @click="edit = !edit">Edit</button>
    </form>
</template>

<script>
    export default {
        name: 'skill',
        props: {
            offer: {
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
                edit: this.action !== 'show'
            }
        },
        methods: {
            updateOffer() {
                axios
                    .patch('/offers/' + this.offer.id, this.offer, ['country'])
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            saveForm() {
                this.updateOffer();
            }
        }
    }
</script>

<style scoped>

</style>
