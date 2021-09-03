<template>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"
                v-t="'create-wallet'"></h4>

            <form class="mt-4">
                <div class="input-group">
                    <select v-model="wallet.typeId"
                            class="custom-select">
                        <option :key="'empty'"
                                selected
                                value=""
                                v-t="'select-wallet-type'"></option>

                        <option v-for="walletType in typesForWalletAdding"
                                :key="walletType.id + '-type'"
                                :value="walletType.id"
                                v-text="walletType.name"></option>
                    </select>
                </div>

                <div class="input-group">
                    <app-transition name="collapse">
                        <div v-if="wallet.typeId"
                             class="mt-4"
                             style="width: 100%;">
                            <div class="form-group">
                                <input v-model="wallet.number"
                                       type="text"
                                       :placeholder="$t('enter-wallet-number')"
                                       class="form-control">
                            </div>
                        </div>
                    </app-transition>
                </div>

                <div class="input-group">
                    <app-transition name="collapse">
                        <div v-if="wallet.typeId && wallet.number"
                             class="mt-4 col"
                             style="display: flex; justify-content: center;">
                            <button class="btn btn-block btn-primary"
                                    style="max-width: 45%;"
                                    type="button"
                                    v-t="'create'"
                                    @click="create()"></button>

                            <button class="btn btn-block btn-dark"
                                    style="max-width: 45%; margin-top: 0; margin-left: 5%;"
                                    type="button"
                                    v-t="'cancel'"
                                    @click="clear()"></button>
                        </div>
                    </app-transition>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import {clone} from '../util/helpers';

    export default {
        name: 'WalletsPanelCreateForm',
        props: {
            typesForWalletAdding: {
                type: Array,
                required: true
            },
            loading: {
                type: Boolean,
                required: true
            }
        },
        data: () => ({
            wallet: {
                typeId: '',
                number: null
            }
        }),
        methods: {
            async create() {
                if (this.loading
                    || !this.wallet.typeId
                    || !this.wallet.number) {
                    return;
                }

                const wallet = clone(this.wallet);

                this.$emit('create', wallet, this.clear);
            },
            clear() {
                this.wallet = {
                    typeId: '',
                    number: null
                };
            }
        }
    }
</script>
