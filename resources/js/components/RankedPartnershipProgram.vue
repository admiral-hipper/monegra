<template>
    <div class="row">
        <app-transition name="collapse"
                        tag="div"
                        appear
                        group
                        chain
                        class="col-12">
            <div :key="'user-coin'"
                 class="card col-12">
                <div class="card-body">
                    <h4 class="card-title"
                        v-t="'your-coins'"></h4>

                    <div>
                        {{ $t('current-coins-balance') }}: <strong v-text="balanceCoin"></strong><br>
                        {{ $t('total-coins-received') }}: <strong v-text="balanceCoinTotal"></strong>
                    </div>
                </div>
            </div>

            <div v-if="balanceCoin"
                 :key="'coin-order'"
                 class="card col-12">
                <div class="card-body">
                    <h4 class="card-title"
                        v-t="'order-for-coin'"></h4>

                    <form action="#"
                          class="mt-1">
                        <div v-for="(item, key) in coinOrderForm"
                             :key="key"
                             class="form-body">
                            <label v-text="$t(item.translationKey)"></label>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input v-model.trim="item.value"
                                               :type="item.type"
                                               class="form-control"
                                               :placeholder="$t(item.translationKey)"
                                               @input="filterInputValue(key, item)">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <app-transition name="collapse">
                            <div v-if="showCoinOrderFormSubmit"
                                 class="form-actions">
                                <div class="text-left">
                                    <button type="button"
                                            class="btn btn-info"
                                            v-t="'to-order'"
                                            @click="makeCoinOrder()"></button>
                                </div>
                            </div>
                        </app-transition>
                    </form>
                </div>
            </div>

            <div :key="'rank-table'"
                 class="card">
                <div class="card-body">
                    <h4 class="card-title"
                        v-t="'ranked-program'"></h4>

                    <div class="table-wrapper">
                        <table class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        v-t="'rank'"></th>

                                    <th scope="col"
                                        v-t="'coin'"></th>

                                    <th scope="col"
                                        v-t="'token'"></th>

                                    <th scope="col"
                                        v-t="'my-deposit'"></th>

                                    <th scope="col"
                                        v-t="'first-line-turnover'"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in rankConditions"
                                    :key="index">
                                    <td>{{ row.rank }} <span v-if="row.rank === userRank">({{ $t('you-here') }})</span>
                                    </td>
                                    <td v-text="row.coin"></td>
                                    <td v-text="row.token"></td>
                                    <td v-text="row['my_deposit']"></td>
                                    <td v-text="row['referrals_deposit']"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div :key="'coin-order-table'"
                 class="card">
                <div class="card-body">
                    <h4 class="card-title"
                        v-t="'orders-for-coins'"></h4>

                    <app-transition name="fade"
                                    appear
                                    mode="out-in">
                        <div v-if="coinOrdersTable.rows.length"
                             :key="'data-filled'"
                             class="table-wrapper">
                            <table class="table table-responsive table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th v-for="column in coinOrdersTable.columns"
                                            :key="column + '-thead'"
                                            v-text="column"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(row, rowIndex) in coinOrdersTable.rows"
                                        :key="rowIndex + '-row'">
                                        <td v-for="(cellData, cellIndex) in row"
                                            v-if="!cellData.hidden"
                                            :key="rowIndex + '-' + cellIndex + '-row-cell'"
                                            v-text="cellData.value"></td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th v-for="column in coinOrdersTable.columns"
                                            :key="column + '-tfoot'"
                                            v-text="column"></th>
                                    </tr>
                                </tfoot>
                            </table>

                            <nav style="display: flex; justify-content: space-between;">
                                <select v-model="coinOrdersTable.perPage"
                                        class="custom-select"
                                        style="width: 70px;"
                                        @change="selectCoinOrderTablePerPage()">
                                    <option v-for="(value, index) in coinOrdersTable.perPageOptions"
                                            :key="'per-page-option-' + index"
                                            :value="value"
                                            :selected="coinOrdersTable.perPage === value"
                                            v-text="value"></option>
                                </select>

                                <ul class="pagination">
                                    <li :class="['page-item', {disabled: !coinOrdersTable.previousPage}]">
                                        <a class="page-link"
                                           href="#"
                                           aria-label="Previous"
                                           @click.prevent="selectCoinOrderTablePage(coinOrdersTable.previousPage)">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <li v-for="value in coinOrdersTable.lastPage"
                                        :key="'page-item-' + value"
                                        :class="['page-item', {active: coinOrdersTable.currentPage === value}]">
                                        <a class="page-link"
                                           v-text="value"
                                           @click.prevent="selectCoinOrderTablePage(value)"></a>
                                    </li>

                                    <li :class="['page-item', {disabled: !coinOrdersTable.nextPage}]">
                                        <a class="page-link"
                                           href="#"
                                           aria-label="Next"
                                           @click.prevent="selectCoinOrderTablePage(coinOrdersTable.nextPage)">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <div v-else
                             class="card-text"
                             :key="'empty-data'"
                             v-t="'your-orders-will-be-here'"></div>
                    </app-transition>
                </div>
            </div>
        </app-transition>
    </div>
</template>

<script>
    import Swal from 'sweetalert2/dist/sweetalert2.js';
    import 'sweetalert2/src/sweetalert2.scss';

    export default {
        name: 'RankedPartnershipProgram',
        props: {
            userBalanceCoin: {
                type: Number,
                required: true
            },
            userBalanceCoinTotal: {
                type: Number,
                required: true
            },
            userRank: {
                type: Number,
                required: true
            },
            rankConditions: {
                type: [Array, Object],
                required: true
            }
        },
        data: () => ({
            loading: false,
            balanceCoin: 0,
            balanceCoinTotal: 0,
            coinOrdersTable: {
                previousPage: 0,
                currentPage: 1,
                nextPage: 0,
                lastPage: 0,
                perPage: 10,
                perPageOptions: [5, 10, 25, 50],
                columns: [],
                rows: []
            },
            coinOrderForm: {
                full_name: {translationKey: 'full-name', type: 'text', value: null},
                phone: {translationKey: 'phone', type: 'number', value: null},
                address: {translationKey: 'address', type: 'text', value: null},
                coin_amount: {translationKey: 'number-of-coins', type: 'number', value: null}
            }
        }),
        computed: {
            showCoinOrderFormSubmit() {
                return this.coinOrderForm.full_name.value
                    && this.coinOrderForm.phone.value
                    && this.coinOrderForm.address.value
                    && this.coinOrderForm.coin_amount.value;
            }
        },
        methods: {
            async getCoinOrders(page = this.coinOrdersTable.currentPage) {
                if (this.loading) return;

                this.loading = true;

                const params = {
                    page,
                    'per_page': this.coinOrdersTable.perPage
                };

                const {data} = await axios.get('/partnership-program/ranked/get-coin-orders-for-table', {params});

                this.coinOrdersTable.columns = data.columns;
                this.coinOrdersTable.rows = data.rows;
                this.coinOrdersTable.previousPage = data['previous_page'];
                this.coinOrdersTable.currentPage = data['current_page'];
                this.coinOrdersTable.nextPage = data['next_page'];
                this.coinOrdersTable.lastPage = data['last_page'];
                this.coinOrdersTable.perPage = data['per_page'];

                this.loading = false;
            },
            selectCoinOrderTablePage(page) {
                if (this.loading || this.coinOrdersTable.currentPage === page) {
                    return;
                }

                this.getCoinOrders(page);
            },
            selectCoinOrderTablePerPage() {
                if (this.loading) {
                    return;
                }

                this.$nextTick(this.getCoinOrders);
            },
            async sendVerificationCode() {
                Swal.showLoading();

                try {
                    await axios.get('/partnership-program/ranked/send-verification-code');

                    Swal.hideLoading();
                    Swal.clickConfirm();
                } catch (error) {
                    console.error(error);

                    Swal.fire({
                        title: this.$t('rtl-sale'),
                        text: this.$t('error-while-generating-code'),
                        icon: 'error'
                    });
                }
            },
            makeCoinOrder() {
                if (this.loading
                    || !this.showCoinOrderFormSubmit) {
                    return;
                }

                const footerHTML = `<div style="display: flex; flex-direction: column;">
                            <small>${this.$t('messages.confirmation-code-sent')}</small>
                            <button type="button" class="btn btn-link p-0 m-0 align-baseline" onclick="resendVerificationCode()">${this.$t('send-new-code')}</button>
                        </div>`;

                const fireSwal = initial => {
                    const queueOptions = [
                        {
                            text: this.$t('confirmation-code-generating'),
                            timer: 0,
                            timerProgressBar: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            onBeforeOpen: this.sendVerificationCode
                        },
                        {
                            grow: 'column',
                            text: initial ? this.$t('enter-confirmation-code') : this.$t('messages.confirmation-code-sent'),
                            confirmButtonText: this.$t('confirm'),
                            footer: footerHTML,
                            input: 'text',
                            showCancelButton: false,
                            inputPlaceholder: this.$t('confirmation-code'),
                            inputValidator: value => {
                                if (!value) {
                                    return this.$t('enter-confirmation-code');
                                }

                                if (value.length !== 5) {
                                    return this.$t('code-must-be-5-digits');
                                }
                            },
                            preConfirm: async verificationCode => {
                                Swal.showLoading();

                                await this.createCoinOrder(verificationCode);
                            }
                        }
                    ];

                    Swal
                        .mixin({
                            title: this.$t('coin-order-creating'),
                            focusConfirm: false,
                            showCloseButton: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            cancelButtonText: this.$t('cancel'),
                            progressSteps: [1, 2]
                        })
                        .queue(queueOptions);
                };

                window.resendVerificationCode = () => {
                    fireSwal();
                };

                fireSwal(true);
            },
            async createCoinOrder(verificationCode) {
                if (this.loading
                    || !this.showCoinOrderFormSubmit) {
                    return;
                }

                this.loading = true;

                const data = {
                    'verification_code': verificationCode
                };

                for (const key in this.coinOrderForm) {
                    if (this.coinOrderForm.hasOwnProperty(key)) {
                        data[key] = this.coinOrderForm[key].value;
                    }
                }

                try {
                    const response = await axios.post('/partnership-program/ranked/create-coin-order', data);

                    Swal.fire(
                        this.$t('coin-order-creating'),
                        this.$t('coin-order-created-successfully'),
                        'success'
                    );

                    this.balanceCoin = response.data['user_balance_coin'];

                    for (const key in this.coinOrderForm) {
                        if (this.coinOrderForm.hasOwnProperty(key)) {
                            this.coinOrderForm[key].value = null;
                        }
                    }
                } catch ({response}) {
                    const errorText = typeof response.data === 'string'
                        ? response.data
                        : Object.values(response.data.errors).join('<br>');

                    Swal.showValidationMessage(errorText);
                }

                this.loading = false;

                this.getCoinOrders(1);
            },
            filterInputValue(key, {value}) {
                if (key !== 'coin_amount') {
                    return;
                }

                const minCoinAmountValue = 0,
                    maxCoinAmountValue = this.balanceCoin;

                if (value < minCoinAmountValue) {
                    this.coinOrderForm.coin_amount.value = 0;
                } else if (value > maxCoinAmountValue) {
                    this.coinOrderForm.coin_amount.value = maxCoinAmountValue;
                }
            }
        },
        created() {
            this.balanceCoin = this.userBalanceCoin;
            this.balanceCoinTotal = this.userBalanceCoinTotal;

            this.getCoinOrders();
        }
    }
</script>
