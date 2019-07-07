<template>
    <div class="container">
        <table class="table table-striped table-hover table-bordered">
            <thead>
            <tr>
                <th
                    class="text-center text-nowrap"
                    v-for="header in columnHeaders"
                    scope="col"
                >{{ header | capitalize }}
                <chevrons-down-icon
                    width="12"
                    stroke="red"
                    @click="sort(header)"
                    v-if="isSortable(header)"
                ></chevrons-down-icon>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in tableData" @click="clickRow(row)">
                <td v-for="cell in row" v-html="reformatObject(cell)"></td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="15" class="text-center">
                    <div class="btn-group" role="group" aria-label="pagination">
                        <button type="button" class="btn btn-outline-info" v-if="presentPage > 1" @click="prevPage">Prev</button>
                        <button type="button"
                                class="btn btn-outline-info"
                                v-for="page in pages"
                                @click="gotoPage(page)"
                                v-bind:class="{ active: page === presentPage}"
                        >{{page}}</button>
                        <button type="button" class="btn btn-outline-info" v-if="presentPage < pages" @click="nextPage">Next</button>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
    import {ChevronsDownIcon} from "vue-feather-icons";

    export default {
        name: 'table-component',
        components: {ChevronsDownIcon},
        props: {
            'content': {
                type: Array,
                required: true
            },
            'columnHeaders': {
                type: Array,
                default() {
                    return _.keys(_.first(this.content))
                }
            },
            'sortable': {
                type: Array,
                default() {
                    return _.keys(_.first(this.content))
                }
            }
        },
        data() {
            return {
                itemsPerPage: 10,
                presentPage: 1,
                pages: Math.ceil(_.size(this.content) / 10),
                tableContent: this.content
            }
        },
        computed: {
            tableData() {
                return _.slice(this.tableContent, ((this.presentPage - 1) * this.itemsPerPage), (this.presentPage * this.itemsPerPage))
            }
        },
        methods: {
            nextPage() {
                this.presentPage += 1;
                console.log(this.presentPage);
                if (this.presentPage > this.pages) {
                    this.presentPage = this.pages;
                    console.log(this.presentPage);
                }
            },
            prevPage() {
                this.presentPage -= 1;
                console.log(this.presentPage);
                if (this.presentPage < 1) {
                    this.presentPage = 1;
                }
            },
            gotoPage(page_number) {
                this.presentPage = page_number
            },
            sort(column) {
                this.tableContent = _.sortBy(this.tableContent, [column]);
            },
            isSortable(column) {
                return _.indexOf(this.sortable, column) > -1;
            },
            clickRow(data) {
                this.$emit('click-row', data)
            },
            reformatObject(collection) {
                if (typeof collection === 'object') {
                    return _.map(collection, (value, key) => {
                        if (typeof value === 'object') {
                            return;
                        }
                        return "<b>" + _.startCase(_.toLower(key)) + "</b>:<br />" + value + "<br />";
                    }).join('');
                }
                return collection;
            }
        },
        filters: {
            count(collection) {
                return _.size(collection)
            }
        }
    }
</script>
