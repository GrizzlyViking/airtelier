<template>
    <div class="form-group mb-4">
        <div class="input-group">
            <input type="text"
                   class="input-group-text rounded-right-0 border-right-0"
                   v-model="key_pair.assoc_key"
                   @blur="updateParent"
                   @keyup.tab="setFocus"
            >
            <input type="text"
                   ref="key_value"
                   v-model="key_pair.property_value"
                   class="form-control"
                   id="basic-url"
                   :tabindex="tabindex"
                   aria-describedby="basic-addon3"
                   @blur="updateParent"
            >
        </div>
            <small v-if="error" id="emailHelp" class="form-text text-danger">{{ error }}</small>
    </div>
</template>

<script>
    export default {
        props: {
            label: {
                type: String,
                default: ''
            },
            row_value: {
                type: String,
                default: ''
            },
            error: {
                type: String|Boolean,
                default: false
            },
            tabindex: {
                type: Number
            }
        },
        data() {
            return {
                key_pair: {
                    assoc_key: this.label,
                    property_value: this.row_value
                }
            }
        },
        methods: {
            updateParent() {
                this.$emit('newValue', this.key_pair);
            },
            setFocus() {
                this.$refs.key_value.$el.focus()
            }
        }
    }
</script>
