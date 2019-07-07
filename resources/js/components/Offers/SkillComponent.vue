<template>
    <div class="card">
        <div class="card-body">
            <input v-if="this.edit" type="text" v-model="offer.name" class="card-title h5 form-control-plaintext">
            <h5 v-if="!this.edit" class="card-title">{{offer.name }}</h5>
            <textarea v-if="this.edit" class="form-control-plaintext">{{ offer.description }}</textarea>
            <p v-if="!this.edit" class="card-text">{{ offer.description }}</p>
        </div>
        <div class="card-footer">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-light" v-for="(item, index) in offer.meta">
                    <span class="font-weight-bolder">{{ index | capitalize }}</span> : {{ item }}
                </li>
            </ul>
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
