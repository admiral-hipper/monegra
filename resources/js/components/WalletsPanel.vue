<template>
    <div class="row">
        <app-transition name="collapse"
                        tag="div"
                        appear
                        group
                        class="col-12">
            <div v-if="typesForWalletAdding.length && !walletEditing"
                 :key="'creation-form'">
                <create-form :types-for-wallet-adding="typesForWalletAdding"
                             :loading="loading"
                             @create="storeWallet"/>
            </div>

            <div v-if="walletEditing"
                 :key="'update-form'">
                <edit-form :types-for-wallet-adding="typesForWalletAdding"
                           :wallet="walletToEdit"
                           :loading="loading"
                           @update="updateWallet"
                           @cancel="cancelWalletEditing()"/>
            </div>

            <div :key="'table'">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"
                            v-t="'existing-wallets'"></h4>

                        <app-transition name="fade"
                                        appear
                                        mode="out-in">
                            <div v-if="rows.length"
                                 :key="'data-filled'"
                                 class="table-wrapper">
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
                                                v-text="cellData.value"></td>

                                            <td :key="'actions-row-cell'"
                                                class="td-actions"
                                                style="text-align: center;">
                                                <button type="button"
                                                        class="btn waves-effect waves-light btn-rounded btn-warning"
                                                        style="border-radius: 2em 0.5em 0.5em 2em;"
                                                        :disabled="walletEditing"
                                                        v-t="'change'"
                                                        @click="editWallet(row)"></button>

                                                <button type="button"
                                                        class="btn waves-effect waves-light btn-rounded btn-danger"
                                                        style="border-radius: 0.5em 2em 2em 0.5em;"
                                                        :disabled="walletEditing"
                                                        v-t="'delete'"
                                                        @click="deleteWallet(row)"></button>
                                            </td>
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
                            </div>

                            <div v-else
                                 :key="'empty-data'"
                                 v-t="'your-wallets-will-be-here'"></div>
                        </app-transition>
                    </div>
                </div>
            </div>
        </app-transition>
    </div>
</template>

<script>
    import Swal from 'sweetalert2/dist/sweetalert2.js';
    import 'sweetalert2/src/sweetalert2.scss';

    export default {
        name: 'WalletsPanel',
        components: {
            CreateForm: () => import('./WalletsPanelCreateForm'),
            EditForm: () => import('./WalletsPanelEditForm')
        },
        data: () => ({
            loading: false,
            columns: [],
            rows: [],
            typesForWalletAdding: [],
            walletToEdit: {}
        }),
        computed: {
            walletEditing() {
                return Boolean(this.walletToEdit.id);
            }
        },
        methods: {
            async getData() {
                if (this.loading) return;

                this.loading = true;

                const {data} = await axios.get('/wallet/all');

                this.fillData(data);

                this.loading = false;
            },
            async storeWallet({typeId, number}, done) {
                this.loading = true;

                Swal.fire({
                    title: this.$t('creating'),
                    text: this.$t('new-wallet-creating'),
                    timer: 0,
                    timerProgressBar: true,
                    onBeforeOpen: () => Swal.showLoading()
                });

                try {
                    const {data} = await axios.post('/wallet/store', {['type_id']: typeId, number});

                    this.fillData(data);

                    done();

                    Swal.fire(
                        this.$t('creating'),
                        this.$t('wallet-has-been-successfully-created'),
                        'success'
                    );
                } catch ({response}) {
                    const errorText = typeof response.data === 'string'
                        ? response.data
                        : Object.values(response.data.errors).join('<br>');

                    Swal.fire(
                        this.$t('error'),
                        errorText,
                        'error'
                    );
                }

                this.loading = false;
            },
            editWallet(row) {
                const id = row[0].value,
                    typeId = row[0]['type_id'],
                    typeName = row[1].value,
                    number = row[2].value;

                this.walletToEdit = {id, typeId, typeName, number};
            },
            async updateWallet({id, typeId, number}) {
                this.loading = true;

                Swal.fire({
                    title: this.$t('editing'),
                    html: this.$t('wallet-editing'),
                    timer: 0,
                    timerProgressBar: true,
                    onBeforeOpen: () => Swal.showLoading()
                });

                try {
                    const {data} = await axios.post('/wallet/update', {
                        id, ['type_id']: typeId, number
                    });

                    this.fillData(data);

                    Swal.fire(
                        this.$t('editing'),
                        this.$t('wallet-has-been-successfully-changed'),
                        'success'
                    );

                    this.walletToEdit = {};
                } catch ({response}) {
                    const errorText = typeof response.data === 'string'
                        ? response.data
                        : Object.values(response.data.errors).join('<br>');

                    Swal.fire(
                        this.$t('error'),
                        errorText,
                        'error'
                    );

                    return;
                }

                this.loading = false;
            },
            cancelWalletEditing() {
                if (this.loading) return;

                this.walletToEdit = {};
            },
            deleteWallet(row) {
                if (this.loading || this.walletEditing) return;

                const id = row[0].value,
                    typeName = row[1].value;

                Swal.fire({
                    title: this.$t('deleting'),
                    text: `${this.$t('messages.wallet-deleting')} "${typeName}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: this.$t('yes'),
                    cancelButtonText: this.$t('cancel'),
                    preConfirm: () => new Promise(async resolve => {
                        Swal.showLoading();

                        this.loading = true;

                        const {data} = await axios.delete(`/wallet/delete/${id}`);

                        this.fillData(data);

                        resolve();

                        Swal.fire(
                            this.$t('deleting'),
                            this.$t('your-wallet-has-been-deleted'),
                            'success'
                        );

                        this.loading = false;
                    })
                });
            },
            fillData(data) {
                this.columns = data.columns;
                this.rows = data.rows;
                this.typesForWalletAdding = data['types_for_wallet_adding'];
            }
        },
        created() {
            this.getData();
        }
    }
</script>

<style>
    @media only screen and (max-width: 768px) {
        .td-actions > button {
            border-radius: 4px !important;
        }

        .td-actions > button:first-of-type {
            margin-bottom: 4px;
        }
    }
</style>
