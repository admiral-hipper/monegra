<template>
    <div class="row">
        <div class="col-12">
            <app-transition name="collapse"
                            appear>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"
                            v-t="'exchange-rates'"></h4>

                        <p class="card-text"
                           v-t="'actual-data'"></p>

                        <div class="row">
                            <div v-for="item in exchangeRates"
                                 :key="item.name"
                                 class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ item.value }}</h4>

                                        <div>
                                            {{ item.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </app-transition>
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
