<template>
    <div>
        <label>Additional properties</label> <plus-circle-icon v-if="edit" height="16" @click="addProperty"></plus-circle-icon>
        <div class="row">
            <input-group
                    :edit="edit"
                    class="col-12"
                    v-for="(row, index) in meta_data"
                    v-model="meta_data[index]"
                    :key="new Date().getTime() + index"
                    @remove="$delete(meta_data, index)"
                    @newValue="changeRow($event, index)"
            ></input-group>
        </div>
    </div>
</template>

<script>
    import { PlusCircleIcon } from 'vue-feather-icons'
    export default {
        components: {PlusCircleIcon},
        props: {
            name: {
                type: String,
                default: ''
            },
            id: {
                type: String,
                default: ''
            },
            value: {
                type: Array|Object,
                default() {
                    return []
                }
            },
            edit: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                meta_data: this.castAsArray(this.value)
            }
        },
        filters: {
            serialise(obj) {
                return JSON.stringify(obj);
            }
        },
        methods: {
            dd(value) {
                console.log(value)
            },
            isUnique(data, column) {
                let extract = _.map(data, (row) => {
                    return row[column];
                });

                return extract.length === _.uniq(extract).length;
            },
            validateData(data) {
                if (this.isUnique(data, 'label')) {
                    this.dd('it is unique');
                } else {
                    this.dd('it is NOT unique');
                }
            },
            addProperty() {
                this.meta_data.push({});
            },
            changeRow(event, row) {
                this.meta_data[row] = event;
                this.$emit('input', this.meta_data);
            },
            castAsArray(value) {
                if (! Array.isArray(value)) {
                    return [value];
                }
                return value;
            }
        }
    }
</script>
