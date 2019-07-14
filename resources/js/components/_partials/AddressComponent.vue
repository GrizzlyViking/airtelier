<template>
    <div>
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea name="address" class="form-control" id="address" rows=3 v-model="address.address"></textarea>
        </div>

        <div class="form-group">
            <label for="postcode">Post code</label>
            <input type="text" class="form-control" placeholder="Enter postcode" v-model="address.post_code">
        </div>

        <div class="form-group">
            <label for="town">Town or City</label>
            <input type="text" class="form-control" placeholder="Enter town" v-model="address.town">
        </div>

        <div class="form-group">
            <label for="type_id">Country</label>
            <countries-component v-model="address.country"></countries-component>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddressComponent",
        props: ['address']
    }
</script>
