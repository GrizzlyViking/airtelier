<template>
    <div class="card">
        <div class="card-body">
            <input v-if="edit" type="text" v-model="offer.name" class="card-title h5 form-control-plaintext">
            <h5 v-if="!edit" class="card-title">{{offer.name }}</h5>
            <editor-component v-if="edit" v-model="offer.description"></editor-component>
            <p v-if="!edit" class="card-text">{{ offer.description }}</p>
        </div>
        <div class="card-footer">
            <item-list v-model="offer.meta" :edit="edit"></item-list>
        </div>
    </div>
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
