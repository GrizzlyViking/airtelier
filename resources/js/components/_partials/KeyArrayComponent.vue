<template>
    <ul class="list-group list-group-flush">
        <li class="list-group-item bg-light" v-for="(item, index) in $attrs.value">
            <div class="input-group" v-if="!edit">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ index | capitalize }}</span>
                </div>
                <input type="text" class="form-control" v-model="$attrs.value[index]">
            </div>

            <div class="input-group" v-if="edit">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ index | capitalize }}</span>
                </div>
                <input type="text" class="form-control" aria-label="With textarea" v-model="$attrs.value[index]">
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "KeyArrayComponent",
        props: {
            edit: {
                type: Boolean,
                default: false
            }
        }
    }
</script>
