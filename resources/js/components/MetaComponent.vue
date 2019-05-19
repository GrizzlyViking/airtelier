<template>
    <div>
        <label class="clearfix">Your vanity URL</label>
        <div class="row">
            <input-group
                    class="col-sm-12"
                    v-for="(row, index) in meta_data"
                    :label="row.label"
                    :row_value="row.value"
                    :error="row.error"
                    :tabindex="index"
                    :key="row | serialise"
                    @newValue="changeRow($event, row)"
            ></input-group>
        </div>

        <div class="row">
            <div class="col-sm-12 mb-3">
                <button type="button" class="btn btn-outline-info" v-if="parametersHaveBeenFilledOut"
                        @click="addProperty">
                    <plus-icon></plus-icon>
                </button>
            </div>
        </div>

        <input type="hidden" :name="name" v-model="sanitised">
    </div>
</template>

<script>
    import { PlusIcon } from 'vue-feather-icons'
    export default {
        components: {PlusIcon},
        props: {
            name: {
                type: String,
                default: ''
            },
            id: {
                type: String,
                default: ''
            },
            input_data: {
                type: Array,
                default() {
                    return []
                }
            }

        },
        data() {
            return {
                meta_data: this.input_data
            }
        },
        filters: {
            serialise(obj) {
                return JSON.stringify(obj);
            }
        },
        computed: {
            parametersHaveBeenFilledOut() {
                if (this.meta_data.length === 0) {
                    return true;
                }
                let found = _.filter(this.meta_data, (row) => {
                    return !row.label || !row.value;
                });

                return found.length === 0;
            },
            sanitised() {
                let sanitized = this.meta_data.map(row => {
                    return {
                        label: row.label,
                        value: row.value
                    };
                });

                return JSON.stringify(sanitized);
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
                this.meta_data.push({
                    label: '',
                    value: ''
                });
            },
            changeRow(event, row) {
                row.label = event.assoc_key;
                row.value = event.property_value;

                if (!this.isUnique(this.meta_data, 'label')) {
                    row.error ='The label must be unique.'
                } else {
                    row.error = false;
                }
            }
        }
    }
</script>
