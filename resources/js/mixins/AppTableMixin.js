const isUndefined = payload => typeof payload === 'undefined';

export default {
    data: () => ({
        tableData: {
            pagination: undefined,
            columns: [],
            rows: [],
            currentPage: 1,
            nextPage: null,
            lastPage: null,
            perPage: 10,
            perPageOptions: [5, 10, 25, 50]
        }
    }),
    computed: {
        isTableFilled() {
            return Boolean(this.tableData.rows.length);
        }
    },
    methods: {
        async getTableData(payload = {}, done = Function) {
            const params = {
                page: payload.page || this.tableData.currentPage,
                per_page: payload.perPage || this.tableData.perPage
            };

            const {data} = await axios.get(this.tableQueryURL, {params});

            this.updateTableData(data, {
                previousPage: 'previous_page',
                currentPage: 'current_page',
                nextPage: 'next_page',
                lastPage: 'last_page',
                perPage: 'per_page'
            });

            done();
        },
        updateTableData(tableData, {
            currentPage = 'currentPage',
            nextPage = 'nextPage',
            lastPage = 'lastPage',
            perPage = 'perPage',
            perPageOptions = 'perPageOptions'
        } = {}) {
            if (!isUndefined(tableData.pagination)) {
                this.$set(this.tableData, 'pagination', tableData.pagination);
            }

            if (!isUndefined(tableData.columns)) {
                this.$set(this.tableData, 'columns', tableData.columns);
            }

            if (!isUndefined(tableData.rows)) {
                this.$set(this.tableData, 'rows', tableData.rows);
            }

            if (!isUndefined(tableData[currentPage])) {
                this.$set(this.tableData, 'currentPage', tableData[currentPage]);
            }

            if (!isUndefined(tableData[nextPage])) {
                this.$set(this.tableData, 'nextPage', tableData[nextPage]);
            }

            if (!isUndefined(tableData[lastPage])) {
                this.$set(this.tableData, 'lastPage', tableData[lastPage]);
            }

            if (!isUndefined(tableData[perPageOptions])) {
                this.$set(this.tableData, 'perPageOptions', tableData[perPageOptions]);
            }

            if (!isUndefined(tableData[perPage])) {
                this.$set(this.tableData, 'perPage', tableData[perPage]);
            }
        }
    },
    async created() {
        if (!this.tableQueryURL) {
            throw new Error('"tableQueryURL" is empty');
        }

        await this.getTableData();
    }
}
