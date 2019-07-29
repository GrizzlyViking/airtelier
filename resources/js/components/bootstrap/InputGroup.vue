<template>
    <div class="form-group mb-4">
        <div class="input-group">
            <input type="text"
                   class="input-group-text rounded-right-0 border-right-0"
                   v-model="assoc_key"
                   @keyup="updateParent"
                   @keyup.tab="setFocus"
                   :disabled="!edit"
            >
            <input type="text"
                   v-model="obj_value"
                   class="form-control"
                   aria-describedby="basic-addon3"
                   @keyup="updateParent"
                   :disabled="!edit"
            >
            <div class="input-group-append" v-if="edit" @click="remove">
                <span class="input-group-text"><trash-2-icon height="16" class="custom-class"></trash-2-icon></span>
            </div>
        </div>
            <small v-if="error" id="emailHelp" class="form-text text-danger">{{ error }}</small>
    </div>
</template>

<script>
    import { Trash2Icon } from 'vue-feather-icons';
    export default {
        components: {Trash2Icon},
        props: {
            error: {
                type: String|Boolean,
                default: false
            },
            value: {
                default: () => {
                    return {};
                }
            },
            edit: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                assoc_key: Object.keys(this.value)[0],
                obj_value: this.value[Object.keys(this.value)[0]]
            }
        },
        methods: {
            updateParent() {
                let obj = {};
                obj[this.assoc_key] = this.obj_value;
                this.$emit('newValue', obj);
            },
            setFocus() {
                this.$refs.key_value.$el.focus();
            },
            remove() {
                this.$emit('remove', this.assoc_key);
            }
        }
    }
</script>
