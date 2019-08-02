<template>
    <div>
        <div v-if="edit">
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" class="form-control" id="address" rows=3 v-model="address.address" @input="handleInput"></textarea>
            </div>

            <div class="form-group">
                <label for="postcode">Post code</label>
                <input type="text" class="form-control" placeholder="Enter postcode" v-model="address.post_code" @input="handleInput">
            </div>

            <div class="form-group">
                <label for="town">Town or City</label>
                <input type="text" class="form-control" placeholder="Enter town" v-model="address.town" @input="handleInput">
            </div>

            <div class="form-group">
                <label for="type_id">Country</label>
                <countries-component v-model="address.country_code" @input="handleInput"></countries-component>
            </div>
        </div>
        <div class="card" v-if="!edit">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-12 font-weight-bolder">Address:</div>
                        <div class="col-12">{{address.address}}</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-12 font-weight-bolder">Post Code:</div>
                        <div class="col-12">{{address.post_code}}</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-12 font-weight-bolder">City/Town:</div>
                        <div class="col-12">{{address.town}}</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-12 font-weight-bolder">Country:</div>
                        <div class="col-12">{{address.country.name}}</div>
                    </div>
                </li>
            </ul>
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
