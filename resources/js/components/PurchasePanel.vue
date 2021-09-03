<template>
    <div>
        <div class="row">
            <div class="col-12">
                <app-transition name="collapse"
                                appear>
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title"
                                v-t="'rtl-buy'"></h4>

                            <p class="card-text"
                               v-t="'choosing-payment-system'"></p>

                            <div style="display: flex; flex-direction: column;">
                                <div class="wallet-types">
                                    <div v-for="walletType in walletTypes"
                                         :key="walletType.id"
                                         :class="{active: selectedWalletType.id === walletType.id}"
                                         @click="selectWalletType(walletType)">
                                    <span style="margin-right: 5px;"
                                          v-text="walletType.name"></span>

                                        <img :src="locationOrigin + '/' + walletType['image_path']"
                                             :alt="walletType.name"
                                             height="40">
                                    </div>
                                </div>

                                <app-transition name="collapse">
                                    <div v-if="selectedWalletType.id"
                                         class="form-body mt-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ $t('purchase-amount-in') }} {{ selectedCurrencyCode }}</label>

                                                    <amount-input v-model="amount"
                                                                  :suffix="selectedCurrencyCode"
                                                                  :placeholder="selectedCurrencyCode"
                                                                  @input="amountInputHandler('amount')"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ $t('purchase-amount-in') }} RTL</label>

                                                    <amount-input v-model="amountInToken"
                                                                  suffix="RTL"
                                                                  placeholder="RTL"
                                                                  @input="amountInputHandler('amountInToken')"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </app-transition>

                                <app-transition name="collapse">
                                    <div v-if="amount">
                                        <button type="button"
                                                class="btn btn-primary"
                                                style="max-width: 50%;"
                                                v-t="'buy-rtl'"
                                                @click="getInfoForTransaction()"></button>
                                    </div>
                                </app-transition>
                            </div>
                        </div>
                    </div>
                </app-transition>
            </div>
        </div>

        <app-table v-if="isTableFilled"
                   v-bind="tableData"
                   :title="$t('transactions')"
                   @load-page="getTableData"/>
    </div>
</template>

<script>
    import AppTableMixin from '../mixins/AppTableMixin';
    import AppTable from './ui/AppTable';
    import AmountInput from './ui/AmountInput';
    import Swal from 'sweetalert2/dist/sweetalert2.js';
    import 'sweetalert2/src/sweetalert2.scss';

    export default {
        name: 'PurchasePanel',
        mixins: [AppTableMixin],
        components: {AppTable, AmountInput},
        props: {
            walletTypes: {
                type: Array,
                required: true
            },
            quotes: {
                type: Object,
                required: true
            }
        },
        data: () => ({
            tableQueryURL: '/purchase/get-transactions',
            loading: false,
            amount: null,
            amountInToken: null,
            selectedWalletType: {}
        }),
        computed: {
            locationOrigin() {
                return location.origin;
            },
            selectedCurrencyCode() {
                return this.selectedWalletType.currency
                    ? this.selectedWalletType.currency.code
                    : null;
            },
            selectedCurrencyQuote() {
                const defaultValue = 1;

                return this.selectedCurrencyCode
                    ? this.quotes[this.selectedCurrencyCode + '/RTL'] || defaultValue
                    : defaultValue;
            }
        },
        watch: {
            selectedWalletType() {
                if (!this.amount) return;

                this.amountInputHandler('amountInToken');
            }
        },
        methods: {
            amountInputHandler(modelName) {
                if (modelName === 'amount') {
                    this.amountInToken = this.amount * this.selectedCurrencyQuote;
                } else {
                    this.amount = this.amountInToken / this.selectedCurrencyQuote;
                }
            },
            selectWalletType(type) {
                if (this.loading) return;

                this.selectedWalletType = type;
            },
            async getInfoForTransaction() {
                if (this.loading
                    || !this.selectedWalletType
                    || !this.amount) {
                    return;
                }

                this.loading = true;

                const selectedWalletType = JSON.parse(JSON.stringify(this.selectedWalletType));

                let amount = this.amount;

                Swal.fire({
                    title: this.$t('loading'),
                    text: this.$t('receiving-data'),
                    timer: 0,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onBeforeOpen: () => Swal.showLoading()
                });

                let responseData;

                try {
                    const response = await axios.get('/purchase/get-info-for-transaction', {
                        params: {
                            'wallet_type_id': selectedWalletType.id,
                            amount
                        }
                    });

                    responseData = response.data;

                    this.amount = amount = responseData.amount;

                    this.amountInputHandler('amount');
                } catch ({response}) {
                    const errorText = typeof response.data === 'string'
                        ? response.data
                        : Object.values(response.data.errors).join('<br>');

                    Swal.fire(
                        this.$t('error'),
                        errorText,
                        'error'
                    );

                    this.loading = false;

                    return;
                }

                this.loading = false;

                if (!responseData['user_wallet']) {
                    const infoMessageString = `<div>
                        <div>${this.$t('messages.wallet-for-payment-system-is-required', {paymentSystem: selectedWalletType.name})}</div>
                        <br>
                        <small>${this.$t('hints.you-can-create-it-in-the-section')} <a href="${responseData['link_to_wallets']}">${this.$t('wallets')}</a></small>
                        </div>`;

                    Swal.fire({
                        title: this.$t('replenishment'),
                        html: infoMessageString,
                        icon: 'info'
                    });

                    return;
                }

                const currencyRateString = responseData['currency_rate']
                    ? `<div>${this.$t('currency-rate')}: <strong>${responseData['currency_rate']}</strong></div>`
                    : '';

                const systemWalletString = responseData['system_wallet']
                    ? `<div>${this.$t('number-of-wallet', {wallet: selectedWalletType.name})}: <strong>${responseData['system_wallet'].number}</strong></div>
                       ${responseData['system_wallet']['public_key'] ? `<div>${this.$t('public-key-of-wallet', {wallet: selectedWalletType.name})}: <strong>${responseData['system_wallet']['public_key']}</strong></div>` : ''}`
                    : '';

                const detailsString = `<div>${currencyRateString}
                    <div>${this.$t('transfer-amount')}: <strong>${responseData['amount_to_transfer']}</strong></div>
                    ${systemWalletString}
                    <div style="margin-top: 20px;">${this.$t('balance-will-be-replenished-in-the-amount')}: <strong>${responseData['internal_currency_amount']}</strong></div>
                    </div>`;

                const instructionHtml = '<div>'
                    + '<strong>' + this.$t('instruction') + '</strong><br>'
                    + '<ul style="padding: 8px 12px; list-style-type: decimal;">'
                    + '<li>' + this.$t('instructions-for-replenishment.first') + '</li>'
                    + '<li>' + this.$t('instructions-for-replenishment.second') + '</li>'
                    + '<li>' + this.$t('instructions-for-replenishment.third') + '</li>'
                    + '<li>' + this.$t('instructions-for-replenishment.fourth') + '</li>'
                    + '<li>' + this.$t('instructions-for-replenishment.fifth') + '</li>'
                    + '</ul></div>';

                const infoMessageString = `<div>
                    <div>${this.$t('we-found-your-wallet', {wallet: selectedWalletType.name})}</div>
                    <div style="margin-top: 10px;"><input type="text" class="form-control" readonly value="${responseData['user_wallet'].number}" style="background-color:#fff;"/></div>
                    </div>`;

                if (responseData['auto_payment']) {
                    Swal
                        .mixin({
                            focusConfirm: false,
                            showCloseButton: true,
                            showCancelButton: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            cancelButtonText: this.$t('cancel'),
                            progressSteps: [1, 2, 3]
                        })
                        .queue([
                            {
                                grow: 'column',
                                title: this.$t('replenishment-step', {step: 1}),
                                html: infoMessageString,
                                footer: `<small>${this.$t('hints.wallet-details-change')} <a href="${responseData['link_to_wallets']}">${this.$t('wallets')}</a></small>`,
                                confirmButtonText: this.$t('further') + ' &rarr;'
                            },
                            {
                                grow: 'row',
                                title: this.$t('replenishment-step', {step: 2}),
                                html: detailsString,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                confirmButtonText: this.$t('further') + ' &rarr;'
                            }
                        ])
                        .then(({dismiss}) => {
                            if (dismiss) return;

                            this.createTransaction({
                                amount,
                                userWallet: responseData['user_wallet'],
                                autoPayment: responseData['auto_payment']
                            });
                        });
                } else {
                    Swal
                        .mixin({
                            focusConfirm: false,
                            showCloseButton: true,
                            showCancelButton: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            cancelButtonText: this.$t('cancel'),
                            progressSteps: [1, 2]
                        })
                        .queue([
                            {
                                grow: 'column',
                                title: this.$t('replenishment-step', {step: 1}),
                                html: infoMessageString,
                                footer: `<small>${this.$t('hints.wallet-details-change')} <a href="${responseData['link_to_wallets']}">${this.$t('wallets')}</a></small>`,
                                confirmButtonText: this.$t('pay') + ' &rarr;'
                            },
                            {
                                grow: 'row',
                                title: this.$t('replenishment-step', {step: 2}),
                                html: detailsString,
                                footer: instructionHtml,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                confirmButtonText: this.$t('i-paid'),
                                confirmButtonColor: '#2cce6d'
                            }
                        ])
                        .then(({dismiss}) => {
                            if (dismiss) return;

                            this.createTransaction({
                                amount,
                                userWallet: responseData['user_wallet']
                            });
                        });
                }
            },
            async createTransaction(payload) {
                if (this.loading) return;

                this.loading = true;

                const data = {
                    'wallet_id': payload.userWallet.id,
                    amount: payload.amount
                };

                Swal.fire({
                    title: this.$t('payment'),
                    text: this.$t('transaction-creating'),
                    timer: 0,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onBeforeOpen: () => Swal.showLoading()
                });

                try {
                    const response = await axios.post('/purchase/create-transaction', data);

                    const {
                        'link_for_payment': linkForPayment,
                        'form_for_payment': formForPayment,
                        'link_to_transactions': linkToTransactions,
                        'internal_currency_code': internalCurrencyCode,
                        'internal_currency_amount': internalCurrencyAmount
                    } = response.data;

                    if (payload.autoPayment) {
                        Swal.fire({
                            title: this.$t('payment'),
                            html: `<div>${this.$t('messages.payment-transaction-created-without-payment')} <strong>${internalCurrencyAmount} ${internalCurrencyCode}</strong></div>${formForPayment ? formForPayment : ''}`,
                            footer: '<small>' + this.$t('hints.payment-redirect') + '</small>',
                            confirmButtonText: this.$t('go-to-payment'),
                            confirmButtonColor: '#2cce6d',
                            showConfirmButton: Boolean(linkForPayment),
                            showCancelButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            preConfirm: linkForPayment ? () => window.open(linkForPayment, '_blank') : Function
                        });

                        if (formForPayment) {
                            const submitEl = document.querySelector('button[name=PAYMENT_METHOD]');

                            const closePopup = () => {
                                if (Swal.isVisible()) {
                                    Swal.close();
                                }

                                submitEl.removeEventListener('click', closePopup, false);
                            };

                            submitEl.addEventListener('click', closePopup, false);
                        }
                    } else {
                        Swal.fire({
                            title: this.$t('transaction-creating'),
                            html: `<div>
                            <div>${this.$t('messages.payment-transaction-created')} <strong>${internalCurrencyAmount} ${internalCurrencyCode}</strong></div>
                            <br>
                            <small>${this.$t('hints.monitor-transaction-status')} <a href="${linkToTransactions}">${this.$t('transactions')}</a></small>
                            </div>`,
                            icon: 'success'
                        });
                    }

                    await this.getTableData();
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

                this.selectedWalletType = {};
                this.amount = this.amountInToken = null;

                this.loading = false;
            }
        }
    }
</script>

<style lang="scss">
    .wallet-types {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        > div {
            white-space: nowrap;
            margin: 5px 10px 5px 0;
            padding: 10px 15px;
            border: 3px solid transparent;
            color: #424242;
            border-radius: 10px;
            box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.04), 0 1px 5px 0 rgba(0, 0, 0, 0.1);
            transition: border-color 200ms ease-in-out, box-shadow 200ms ease-in-out;
            will-change: border-color, box-shadow;
            user-select: none;
            cursor: pointer;

            &.active {
                border-color: #6976e9;
            }

            &:hover:not(:active) {
                box-shadow: 0 3px 5px -2px rgba(0, 0, 0, 0.3), 0 2px 2px 0 rgba(0, 0, 0, 0.07), 0 1px 5px 0 rgba(0, 0, 0, 0.15);
            }
        }
    }
</style>
