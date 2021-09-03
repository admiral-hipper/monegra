<template>
    <div class="dashboard-stats card">
        <div class="card-body">
            <h4 class="card-title mb-3"
                v-t="'statistics'"></h4>

            <div class="card-body pt-0 pb-0">
                <fieldset>
                    <legend v-t="'period'"></legend>

                    <date-picker mode="range"
                                 :popover="{visibility: 'click'}"
                                 :value="createdAtRange"
                                 :min-date="new Date('2020-09-01')"
                                 :max-date="new Date"
                                 :columns="$screens({lg: 2}, 1)"
                                 :is-expanded="$screens({default: true, lg: false})"
                                 :input-debounce="500"
                                 :disabled="loading"
                                 @input="getStats"/>

                    <app-transition name="collapse">
                        <div v-if="loading"
                             class="text-center mt-2">
                            <div class="spinner-border text-warning"
                                 role="status"
                                 style="width: 22px; height: 22px;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </app-transition>
                </fieldset>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs">
                    <li v-for="({title}, index) in groupedStats"
                        :key="title"
                        class="nav-item">
                        <a :href="'#' + title"
                           data-toggle="tab"
                           aria-expanded="false"
                           :class="['nav-link', {active: !index}]">
                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                            <span class="d-none d-lg-block">{{ title }}</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div v-for="({title, items}, index) in groupedStats"
                         :key="index + title"
                         :id="title"
                         :class="['tab-pane', {active: !index}]">
                        <ul class="list-group">
                            <li v-for="{label, value, period_dependent: periodDependent} in items"
                                :class="['list-group-item', {orange: periodDependent}]">
                                <span v-text="label"></span>

                                <span class="item-value"
                                      v-html="value"></span>
                            </li>
                        </ul>
                    </div>
                </div>

                <small class="ml-1 mr-1"
                       style="color: var(--stats-dark-orange);">
                    * {{ $t('hints.dashboard-statistics-orange-hint') }}
                </small>
            </div>
        </div>
    </div>
</template>

<script>
    import DatePicker from 'v-calendar/lib/components/date-picker.umd';

    export default {
        name: 'DashboardStats',
        components: {DatePicker},
        data: () => ({
            loading: false,
            groupedStats: {},
            createdAtRange: {}
        }),
        methods: {
            async getStats({start, end} = {start: new Date, end: new Date}) {
                if (this.loading) return;

                this.loading = true;

                const dateRange = start && end
                    ? [moment(start).format('YYYY-MM-DD'), moment(end).format('YYYY-MM-DD')]
                    : [moment().format('YYYY-MM-DD'), moment().format('YYYY-MM-DD')];

                this.createdAtRange = {start, end};

                const {data: groupedStats} = await axios.get('/admin/dashboard/get_stats', {
                    params: {date_range: dateRange}
                });

                this.groupedStats = groupedStats;

                this.loading = false;
            }
        },
        created() {
            this.getStats();
        }
    }
</script>

<style lang="sass"
       scoped>
    .dashboard-stats
        --stats-orange: #ffab12
        --stats-light-orange: #fdf8ee
        --stats-dark-orange: #e69a0d

        fieldset
            display: flex
            flex-direction: column
            padding: 10px
            border: 1px solid #e0e5ed
            border-radius: 5px

            legend
                width: auto
                margin: 0 0px -5px 0px
                padding: 0 6px
                font-size: 15px
                color: inherit

        .list-group-item
            padding: 5px 10px
            border-left: 4px solid #eee
            border-right: 4px solid #eee

            &.orange
                background-color: var(--stats-light-orange)
                border-left-color: var(--stats-orange)
                border-right-color: var(--stats-orange)

                .item-value
                    color: var(--stats-dark-orange)

            .item-value
                margin-left: 2px
                font-weight: 700
                color: #7c6aef
</style>
