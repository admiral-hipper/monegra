<template>
    <div>
        <div class="row">
            <div class="col-12">
                <app-transition name="collapse"
                                appear>
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title"
                                v-t="'rtl-sale'"></h4>

                            <p class="card-text"
                               v-html="cardText"></p>

                            <div style="margin-bottom: 15px; color: #525252;">
                                {{ $t('your-settlement-balance') }}:
                                <strong v-text="newUserBalanceState || userBalanceState"></strong>
                                <br>
                                <span class="hint-block">{{ $t('selling-rate') }}: RTL/XAU <strong v-text="ratesell"></strong> RTL/USD <strong v-text="ratesellusd"></strong></span>
                            </div>

                            <div v-if="userWallets.length"
                                 style="display: flex; flex-direction: column;">
                                <div class="user-wallets">
                                    <div v-for="wallet in userWallets"
                                         :key="wallet.id"
                                         :class="{active: selectedUserWallet.id === wallet.id}"
                                         @click="selectWallet(wallet)">
                                    <span style="margin-right: 5px;"
                                          v-text="wallet.type.name"></span>

                                        <img :src="locationOrigin + '/' + wallet.type['image_path']"
                                             :alt="wallet.type.name"
                                             height="40">
                                    </div>
                                </div>

                                <app-transition name="collapse">
                                    <div v-if="selectedUserWallet.id"
                                         class="form-body mt-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ $t('sale-amount-in') }} {{ selectedCurrencyCode }}</label>

                                                    <amount-input v-model="amount"
                                                                  :suffix="selectedCurrencyCode"
                                                                  :placeholder="selectedCurrencyCode"
                                                                  @input="amountInputHandler('amount')"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ $t('sale-amount-in') }} RTL</label>

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
                                                v-t="'sell-rtl'"
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
        name: 'WithdrawPanel',
        mixins: [AppTableMixin],
        components: {AppTable, AmountInput},
        props: {
            userWallets: {
                type: Array,
                required: true
            },
            userBalanceState: {
                type: String,
                required: true
            },
            quotes: {
                type: Object,
                required: true
            },
            linkToWallets: {
                type: String,
                required: true
            },
            ratesell: {
                type: String,
                required: true
            },
            ratesellusd: {
                type: String,
                required: true
            }
        },
        data: () => ({
            tableQueryURL: '/withdraw/get-transactions',
            loading: false,
            amount: null,
            amountInToken: null,
            newUserBalanceState: null,
            selectedUserWallet: {}
        }),
        computed: {
            locationOrigin() {
                return location.origin;
            },
            cardText() {
                return this.userWallets.length
                    ? this.$t('choosing-payment-system')
                    : `${this.$t('messages.first-create')} <a href="${this.linkToWallets}">${this.$t('wallet').toLowerCase()}</a>`;
            },
            selectedCurrencyCode() {
                return this.selectedUserWallet.type
                    ? this.selectedUserWallet.type.currency.code
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
            selectedUserWallet() {
                if (!this.amount) return;

                this.amountInputHandler('amount');
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
            selectWallet(wallet) {
                if (this.loading) return;

                this.selectedUserWallet = wallet;
            },
            async getInfoForTransaction() {
                if (this.loading
                    || !this.selectedUserWallet.id
                    || !this.amount) {
                    return;
                }

                this.loading = true;

                const selectedUserWallet = JSON.parse(JSON.stringify(this.selectedUserWallet)),
                    amount = this.amount;

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
                    const response = await axios.get('/withdraw/get-info-for-transaction', {
                        params: {
                            'wallet_id': selectedUserWallet.id,
                            amount
                        }
                    });

                    responseData = response.data;
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

                const walletTypeName = selectedUserWallet.type.name;

                const currencyRateString = responseData['currency_rate']
                    ? `<div>${this.$t('currency-rate')}: <strong>${responseData['currency_rate']}</strong></div>`
                    : '';

                const detailsHtml = `<div>${currencyRateString}
                    <div>${this.$t('your-wallet-balance')}: <strong>${responseData['user_balance_state']}</strong></div>
                    <div>${this.$t('withdrawal-amount')}: <strong>${responseData['amount_to_hold']}</strong></div>
                    <div>${this.$t('your-wallet-number-for-withdrawal', {wallet: walletTypeName})}: <strong>${responseData['user_wallet'].number}</strong></div>
                    </div>`;

                const footerHTML = `<div style="display: flex; flex-direction: column;">
                            <small>${this.$t('messages.confirmation-code-sent')}</small>
                            <button type="button" class="btn btn-link p-0 m-0 align-baseline" onclick="resendVerificationCode()">${this.$t('send-new-code')}</button>
                        </div>`;

                const fireSwal = initial => {
                    const queueOptions = [
                        {
                            grow: 'row',
                            html: detailsHtml,
                            footer: this.$t('hints.withdrawal-hold'),
                            confirmButtonText: this.$t('withdraw-amount'),
                            showCancelButton: true
                        },
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

                                await this.createTransaction({
                                    amount,
                                    verificationCode,
                                    userWallet: responseData['user_wallet']
                                });
                            }
                        }
                    ];

                    if (!initial) {
                        queueOptions.shift();
                    }

                    Swal
                        .mixin({
                            title: this.$t('rtl-sale'),
                            focusConfirm: false,
                            showCloseButton: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            cancelButtonText: this.$t('cancel'),
                            progressSteps: [1, 2, 3]
                        })
                        .queue(queueOptions);
                };

                window.resendVerificationCode = () => {
                    fireSwal();
                };

                fireSwal(true);
            },
            async createTransaction(payload) {
                if (this.loading) return;

                this.loading = true;

                const data = {
                    'wallet_id': payload.userWallet.id,
                    'verification_code': payload.verificationCode,
                    amount: payload.amount
                };

                try {
                    const response = await axios.post('/withdraw/create-transaction', data);

                    const {
                        'user_balance_state': userBalanceState,
                        'link_to_transactions': linkToTransactions,
                        'internal_currency_code': internalCurrencyCode,
                        'internal_currency_amount': internalCurrencyAmount
                    } = response.data;

                    this.newUserBalanceState = userBalanceState;

                    const successMessageHtml = `<div>
                        <div>${this.$t('messages.payment-transaction-created')} <strong>${internalCurrencyAmount} ${internalCurrencyCode}</strong></div>
                        <br>
                        <small>${this.$t('hints.monitor-transaction-status')} <a href="${linkToTransactions}">${this.$t('transactions')}</a></small>
                        </div>`;

                    Swal.fire({
                        title: this.$t('transaction-creating'),
                        html: successMessageHtml,
                        icon: 'success'
                    });

                    await this.getTableData();
                } catch ({response}) {
                    const errorText = typeof response.data === 'string'
                        ? response.data
                        : Object.values(response.data.errors).join('<br>');

                    Swal.showValidationMessage(errorText);
                }

                this.selectedUserWallet = {};
                this.amount = this.amountInToken = null;

                this.loading = false;
            },
            async sendVerificationCode() {
                Swal.showLoading();

                try {
                    await axios.get('/withdraw/send-verification-code');

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
            }
        }
    }
</script>

<style lang="scss">
    .user-wallets {
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
