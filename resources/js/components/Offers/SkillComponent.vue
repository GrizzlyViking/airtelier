<template>
    <form class="container">
        <div class="form-group">
            <label for="owner_id">Owner</label>
            <user-component v-model="offer.owner"></user-component>
        </div>

        <div class="form-group">
            <label for="type_id">Type</label>
            <type-component v-model="offer.offer_type"></type-component>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" v-model="offer.name">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <editor-component name="description" body_class="form-control" rows="5" v-model="offer.description"></editor-component>
        </div>


        <address-component :address="offer.address"></address-component>
        <meta-component name="meta" id="meta" v-model="offer.meta"></meta-component>

        <button type="submit" class="btn btn-outline-primary">Save</button>
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
            edit: {
                type: Boolean,
                default: false
            }
        },
    }
</script>

<style scoped>

</style>
