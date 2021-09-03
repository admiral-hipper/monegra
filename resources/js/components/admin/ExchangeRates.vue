<template>
    <div class="container-fluid animated fadeIn">
        <h2 class="mb-3">
            <span class="text-capitalize"
                  v-t="'exchange-rates'"></span>
        </h2>

        <div class="card-group">
            <div v-for="item in exchangeRates"
                 :key="item.name"
                 class="card">
                <div class="card-body">
                    <div class="d-inline-flex align-items-center">
                        <h2 class="text-dark mb-1 font-weight-medium">{{ item.value }}</h2>
                    </div>

                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">{{ item.name }}</h6>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ExchangeRates',
        props: {
            exchangeRates: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style lang="sass">
    .card
        flex: 0 !important
        min-width: 200px
</style>
