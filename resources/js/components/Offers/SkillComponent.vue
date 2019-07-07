<template>
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">{{offer.name }}</h5>
        <p class="card-text">{{ offer.description }}</p>
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
                type: Boolean
            }
        },
    }
</script>

<style scoped>

</style>
