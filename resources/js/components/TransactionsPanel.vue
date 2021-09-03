<template>
    <app-table v-bind="tableData"
               :title="$t('all-transactions')"
               @load-page="getTableData"/>
</template>

<script>
    import AppTableMixin from '../mixins/AppTableMixin';
    import AppTable from './ui/AppTable';

    export default {
        name: 'TransactionsPanel',
        mixins: [AppTableMixin],
        components: {AppTable},
        data: () => ({
            tableQueryURL: '/transaction/all'
        })
    }
</script>
