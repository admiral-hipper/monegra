<template>
    <div class="col-lg-8 col-10">
        <h2 class="mb-3">
            <span class="text-capitalize"
                  v-t="'settings'"></span>
        </h2>

        <div v-if="validationErrors.length"
             class="col-lg-8 col-10 alert alert-error alert-dismissible"
             role="alert">
            <div v-for="error in validationErrors"
                 :key="error"
                 v-text="error"></div>
        </div>

        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">
                                    {{ data['accrual_percent_range']['from'] }}%
                                    -
                                    {{ data['accrual_percent_range']['to'] }}%
                                </h2>
                            </div>

                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"
                                v-t="'interest-rate-range'"></h6>

                            <h6 v-if="data['last_accrual_percent']"
                                class="text-success font-weight-normal mb-0 w-100 text-truncate">
                                {{ $t('last-accrued-interest') }} - {{ data['last_accrual_percent'] }}%
                            </h6>
                        </div>

                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <button type="button"
                                    :class="['btn', showAccrualPercentRangeForm ? 'btn-danger' : 'btn-light']"
                                    v-text="showAccrualPercentRangeForm ? $t('cancel') : $t('change')"
                                    @click="showAccrualPercentRangeForm = !showAccrualPercentRangeForm"></button>
                        </div>
                    </div>

                    <app-transition name="collapse">
                        <div v-if="showAccrualPercentRangeForm">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <h4 class="card-title"
                                        v-t="'interest-accrual-range-change'"></h4>

                                    <form :action="data['update_setting_url']"
                                          method="POST">
                                        <input type="hidden"
                                               name="_token"
                                               :value="token">

                                        <input type="hidden"
                                               name="setting_name"
                                               value="accrual_percent_range">

                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="control-from"
                                                   v-t="'from'"></label>

                                            <input type="number"
                                                   id="control-from"
                                                   :min="data.defaults['accrual_percent_range'][0]"
                                                   :max="data.defaults['accrual_percent_range'][1]"
                                                   :step="data.defaults['accrual_percent_range'][0]"
                                                   name="from"
                                                   :value="oldValues['from'] || data['accrual_percent_range']['from']"
                                                   class="form-control"
                                                   :placeholder="$t('from')">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="control-to"
                                                   v-t="'to'"></label>

                                            <input type="number"
                                                   id="control-to"
                                                   :min="data.defaults['accrual_percent_range'][0]"
                                                   :max="data.defaults['accrual_percent_range'][1]"
                                                   :step="data.defaults['accrual_percent_range'][0]"
                                                   name="to"
                                                   :value="oldValues['to'] || data['accrual_percent_range']['to']"
                                                   class="form-control"
                                                   :placeholder="$t('to')">
                                        </div>

                                        <button type="submit"
                                                class="btn btn-outline-warning"
                                                v-t="'change'"></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </app-transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Settings',
        props: {
            data: {
                type: Object,
                required: true
            },
            token: {
                type: String,
                required: true
            },
            oldValues: {
                type: [Object, Array],
                required: true
            },
            validationErrors: {
                type: Array,
                default: () => ({})
            }
        },
        data: () => ({
            showAccrualPercentRangeForm: false
        })
    }
</script>

<style scoped>
    .form-group {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
</style>
