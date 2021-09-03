<template>
    <div class="row">
        <div class="col-12">
            <CopyRefLink v-bind:referral-link="referralLink"/>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"
                        v-t="'partners'"></h4>

                    <p class="card-text"
                       v-t="'your-referral-tree'"></p>

                    <app-transition name="fade"
                                    appear
                                    mode="out-in">
                        <div v-if="rows.length"
                             :key="'data-filled'"
                             style="font-size: 15px; line-height: 18px;">
                            <vue-ads-table class="table table-responsive table-bordered table-striped"
                                           :columns="columns"
                                           :rows="rows">
                                <template slot="toggle-children-icon" slot-scope="props">
                                    <i :class="'fa vue-ads-pr-2 vue-ads-cursor-pointer fa-' + (props.expanded ? 'minus' : 'plus') + '-square'" style="cursor: pointer;"></i>&nbsp;
                                </template>
                            </vue-ads-table>
                        </div>

                        <div v-else
                             :key="'empty-data'"
                             v-t="'your-referrals-will-be-here'"></div>
                    </app-transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {VueAdsTable} from 'vue-ads-table-tree';
    import {TextPlugin} from 'gsap/TextPlugin';
    import CopyRefLink from './CopyRefLink';

    gsap.registerPlugin(TextPlugin);

    export default {
        name: 'LinearPartnershipProgram',
        components: {
            VueAdsTable,
            CopyRefLink
        },
        props: {
            referralLink: {
                type: String,
                required: true
            }
        },
        data: () => ({
            rows: [],
            columns: []
        }),
        methods: {
            async getData() {
                const {data} = await axios.get('/partnership-program/linear/get-referrals-for-table');

                this.columns = data.columns;
                this.rows = data.rows;
            }
        },
        created() {
            this.getData();
        }
    }
</script>
