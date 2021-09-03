<template>
    <app-transition name="collapse"
                    appear>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">{{ title }}</h4>

                        <div class="table-wrapper">
                            <table class="table table-responsive table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th v-for="column in columns"
                                            :key="column + '-thead'"
                                            v-text="column"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(row, rowIndex) in rows"
                                        :key="rowIndex + '-row'">
                                        <td v-for="(cellData, cellIndex) in row"
                                            v-if="!cellData.hidden"
                                            :key="rowIndex + '-' + cellIndex + '-row-cell'"
                                            v-html="cellData.value"></td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th v-for="column in columns"
                                            :key="column + '-tfoot'"
                                            v-text="column"></th>
                                    </tr>
                                </tfoot>
                            </table>

                            <nav style="display: flex; justify-content: space-between;">
                                <select class="custom-select"
                                        style="width: 70px;"
                                        @change="selectPerPage">
                                    <option v-for="(value, index) in perPageOptions"
                                            :key="'per-page-option-' + index"
                                            :value="value"
                                            :selected="perPage === value"
                                            v-text="value"></option>
                                </select>

                                <pagination v-if="pagination"
                                            :data="pagination"
                                            :limit="2"
                                            @pagination-change-page="selectPage"></pagination>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-transition>
</template>

<script>
    import Pagination from 'laravel-vue-pagination';

    export default {
        name: 'AppTable',
        components: {Pagination},
        props: {
            pagination: {
                type: Object,
                default: null
            },
            title: {
                type: String,
                required: true
            },
            columns: {
                type: Array,
                required: true
            },
            rows: {
                type: Array,
                required: true,
                validator(data) {
                    if (!data.length) {
                        return true;
                    }

                    return Array.isArray(data[0]);
                }
            },
            currentPage: {
                type: Number,
                required: true
            },
            nextPage: {
                type: Number,
                default: null
            },
            lastPage: {
                type: Number,
                default: null
            },
            perPage: {
                type: Number,
                default: 10
            },
            perPageOptions: {
                type: Array,
                default: () => [5, 10, 25, 50],
                validator(value) {
                    for (let item of value) {
                        if (typeof item !== 'number') {
                            return false;
                        }
                    }

                    return true;
                }
            },
            disabled: {
                type: Boolean,
                default: false
            }
        },
        data: () => ({
            loading: false,
            pendingEmitCompletion: false
        }),
        computed: {
            previousPage() {
                if (this.currentPage <= 1) {
                    return 0;
                } else {
                    return this.currentPage - 1;
                }
            },
            isDisabled() {
                return this.disabled || this.loading || this.pendingEmitCompletion;
            }
        },
        methods: {
            makeEmit() {
                return new Promise(resolve => {
                    if (this.isDisabled) {
                        return resolve();
                    }

                    this.loading = true;
                    this.pendingEmitCompletion = true;

                    this.$emit(...arguments, async () => {
                        this.loading = false;
                        this.pendingEmitCompletion = false;

                        await this.$nextTick();

                        resolve();
                    });
                });
            },
            selectPage(page) {
                if (this.isDisabled || this.currentPage === page) {
                    return;
                }

                this.showPageList = false;

                this.makeEmit('load-page', {
                    page,
                    perPage: this.perPage,
                    pageSelection: true,
                    realCurrentPage: this.currentPage
                });
            },
            selectPerPage({target}) {
                const perPage = Number(target.value);

                if (this.isDisabled || this.perPage === perPage) {
                    return;
                }

                this.makeEmit('load-page', {
                    page: 1,
                    perPage,
                    perPageSelection: true,
                    realCurrentPage: this.currentPage
                });
            }
        }
    }
</script>
