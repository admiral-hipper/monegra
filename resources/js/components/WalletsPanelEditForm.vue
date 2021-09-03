<template>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"
                v-t="'edit-wallet'"></h4>

            <form class="mt-4">
                <div class="input-group">
                    <select v-model="walletTypeId"
                            class="custom-select">
                        <option :key="'empty'"
                                selected
                                value=""
                                v-t="'select-wallet-type'"></option>

                        <option v-for="(walletType, index) in typesForWalletAddingWithSelectedType"
                                :key="walletType.id + '-type-' + index"
                                :value="walletType.id"
                                v-text="walletType.name"></option>
                    </select>
                </div>

                <div class="input-group">
                    <app-transition name="collapse">
                        <div v-if="walletTypeId"
                             class="mt-4"
                             style="width: 100%;">
                            <div class="form-group">
                                <input v-model="walletTypeNumber"
                                       type="text"
                                       :placeholder="$t('enter-wallet-number')"
                                       class="form-control">
                            </div>
                        </div>
                    </app-transition>
                </div>

                <div class="input-group">
                    <app-transition name="collapse">
                        <div v-if="walletTypeId && walletTypeNumber"
                             class="mt-4 col"
                             style="display: flex; justify-content: center;">
                            <button class="btn btn-block btn-primary"
                                    style="max-width: 45%;"
                                    type="button"
                                    v-t="'change'"
                                    @click="edit()"></button>

                            <button class="btn btn-block btn-dark"
                                    style="max-width: 45%; margin-top: 0; margin-left: 5%;"
                                    type="button"
                                    v-t="'cancel'"
                                    @click="$emit('cancel')"></button>
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
        name: 'WalletsPanelEditForm',
        props: {
            wallet: {
                type: Object,
                required: true
            },
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
            walletTypeId: '',
            walletTypeNumber: null
        }),
        computed: {
            typesForWalletAddingWithSelectedType() {
                const types = clone(this.typesForWalletAdding);

                types.push({
                    id: this.wallet.typeId,
                    name: this.wallet.typeName
                });

                return types;
            }
        },
        methods: {
            async edit() {
                if (this.loading
                    || !this.walletTypeId
                    || !this.walletTypeNumber) {
                    return;
                }

                this.$emit('update', {
                    id: this.wallet.id,
                    typeId: this.walletTypeId,
                    number: this.walletTypeNumber
                });
            }
        },
        created() {
            this.walletTypeId = this.wallet.typeId;
            this.walletTypeNumber = this.wallet.number;
        }
    }
</script>
