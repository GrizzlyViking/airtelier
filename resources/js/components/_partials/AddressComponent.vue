<template>
    <div>
        <div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" :readonly="!edit" class="form-control" id="address" rows=3 v-model="address.address" @input="handleInput"></textarea>
            </div>

            <div class="form-group">
                <label for="postcode">Post code</label>
                <input type="text" :readonly="!edit" class="form-control" placeholder="Enter postcode" v-model="address.post_code" @input="handleInput">
            </div>

            <div class="form-group">
                <label for="town">Town or City</label>
                <input type="text" :readonly="!edit" class="form-control" placeholder="Enter town" v-model="address.town" @input="handleInput">
            </div>

            <div class="form-group">
                <label for="type_id">Country</label>
                <countries-component v-model="address.country_code" @input="handleInput" :edit="edit"></countries-component>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddressComponent",
        props: {
            value: {
                type: Object,
                default() {
                    return {
                        country_code: 'DK'
                    };
                }
            },
            edit: {
                type: Boolean,
                default() {
                    return false;
                }
            }
        },
        data() {
            return {
                address: this.value
            }
        },
        methods: {
            handleInput() {
                this.$emit('input', this.address);
            }
        },
        mounted() {
            this.$emit('input', this.address)
        }
    }
</script>
