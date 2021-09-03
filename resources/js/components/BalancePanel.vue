<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"
                            v-t="'exchange'"></h4>

                        <p class="card-text"
                           v-t="'transfer-between-balances'"></p>

                        <app-transition name="collapse">
                            <div v-if="isTransferFromDepositBalanceBlocked"
                                 class="alert alert-primary"
                                 role="alert"
                                 v-t="'hints.deposit-withdrawal-limit'"></div>
                        </app-transition>

                        <div style="display: flex; justify-content: flex-start; margin-bottom: 15px; color: #525252;">
                            <div style="text-align: left;">
                                <div>
                                    {{ $t('settlement-balance') }}: <strong v-text="actualUserBalanceState"></strong>
                                </div>

                                <div>
                                    {{ $t('deposit-balance') }}:
                                    <strong v-text="actualUserDepositBalanceState"></strong>
                                </div>
                            </div>
                        </div>

                        <div class="row"
                             style="flex-direction: column;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select v-model="balanceTypes.from"
                                            class="custom-select">
                                        <option value=""
                                                selected
                                                v-t="'select-balance-type'"></option>

                                        <option v-if="!isTransferFromDepositBalanceBlocked"
                                                value="balance_token_deposit"
                                                v-t="'from-deposit-balance'"></option>

                                        <option value="balance_token"
                                                v-t="'from-settlement-balance'"></option>
                                    </select>

                                    <app-transition name="collapse">
                                        <div v-if="isTransferFromDepositBalance"
                                             style="margin-left: 2px; font-size: 12px;"
                                             v-t="'hints.deposit-withdrawal-restriction'"></div>
                                    </app-transition>
                                </div>
                            </div>

                            <div v-if="balanceTypes.from"
                                 class="col-md-12">
                                <div class="form-group">
                                    <select v-model="balanceTypes.to"
                                            class="custom-select"
                                            @change="amount = null">
                                        <option value=""
                                                selected
                                                v-t="'select-balance-type'"></option>

                                        <option v-for="{text, value} in balanceTypeToOptions"
                                                :key="value"
                                                :value="value"
                                                v-text="text"></option>
                                    </select>
                                </div>
                            </div>

                            <div v-if="balanceTypes.to"
                                 class="col-md-12">
                                <div class="form-group">
                                    <amount-input v-model="amount"
                                                  :max="maxValue"
                                                  suffix="RTL"
                                                  :placeholder="$t('transfer-amount')"/>

                                    <app-transition name="collapse"
                                                    appear>
                                        <div v-if="isTransferFromDepositBalance"
                                             style="margin-left: 2px; font-size: 12px;">
                                            {{ $t('hints.deposit-withdrawal-available-amount') }} -
                                            <strong v-text="maxDepositWithdrawAmount"></strong> <strong>RTL</strong>
                                        </div>
                                    </app-transition>
                                </div>
                            </div>

                            <div v-if="amount"
                                 class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-primary"
                                            style="max-width: 45%;"
                                            type="button"
                                            v-t="'to-transfer'"
                                            @click="transfer()"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        name: 'BalancePanel',
        mixins: [AppTableMixin],
        components: {AppTable, AmountInput},
        props: {
            userBalanceState: {
                type: String,
                required: true
            },
            userDepositBalanceState: {
                type: String,
                required: true
            },
            canUserWithdrawDeposit: {
                type: Boolean,
                required: true
            },
            maxDepositWithdrawAmount: {
                type: Number,
                required: true
            }
        },
        data: () => ({
            tableQueryURL: '/balance/get-transactions',
            loading: false,
            amount: null,
            balanceTypes: {
                from: '',
                to: ''
            },
            newUserBalanceState: null,
            newUserDepositBalanceState: null,
            newCanUserWithdrawDeposit: true
        }),
        computed: {
            actualUserBalanceState() {
                return this.newUserBalanceState || this.userBalanceState;
            },
            actualUserDepositBalanceState() {
                return this.newUserDepositBalanceState || this.userDepositBalanceState;
            },
            userBalanceAmount() {
                return parseFloat(this.actualUserBalanceState);
            },
            userDepositBalanceAmount() {
                return parseFloat(this.actualUserDepositBalanceState);
            },
            maxValue() {
                if (!this.balanceTypes.to) return 0;

                return this.isTransferFromDepositBalance
                    ? this.maxDepositWithdrawAmount
                    : this.userBalanceAmount;
            },
            balanceTypeToOptions() {
                return [
                    this.isTransferFromDepositBalance
                        ? {text: this.$t('to-settlement-balance'), value: 'balance_token'}
                        : {text: this.$t('to-deposit-balance'), value: 'balance_token_deposit'}
                ];
            },
            isTransferFromDepositBalanceBlocked() {
                return !this.canUserWithdrawDeposit || !this.newCanUserWithdrawDeposit;
            },
            isTransferFromDepositBalance() {
                return this.balanceTypes.from === 'balance_token_deposit';
            }
        },
        watch: {
            'balanceTypes.from'() {
                this.balanceTypes.to = '';
                this.amount = null;
            }
        },
        methods: {
            async transfer() {
                if (this.loading
                    || !this.amount
                    || !this.balanceTypes.to) {
                    return;
                }

                this.loading = true;

                Swal.fire({
                    title: this.$t('transfer'),
                    text: this.$t('transfer-transaction-creating'),
                    timer: 0,
                    timerProgressBar: true,
                    onBeforeOpen: () => Swal.showLoading()
                });

                try {
                    const {data} = await axios.post('/balance/transfer-between-balances', {
                        amount: String(this.amount),
                        ['balance_type']: this.balanceTypes.to
                    });

                    this.balanceTypes.from = this.balanceTypes.to = '';
                    this.amount = null;

                    this.newUserBalanceState = data['user_balance_state'];
                    this.newUserDepositBalanceState = data['user_deposit_balance_state'];
                    this.newCanUserWithdrawDeposit = data['can_user_withdraw_deposit'];

                    Swal.fire(
                        this.$t('transfer'),
                        this.$t('transfer-completed-successfully'),
                        'success'
                    );

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

                this.loading = false;
            }
        }
    }
</script>
