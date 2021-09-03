<template>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"
                v-t="'your-referral-link'"></h4>

            <div class="align-items-md-baseline row">
                <p class="col-auto card-text"
                   style="margin-right: -10px; margin-bottom: 0;"
                   v-text="referralLink"></p>

                <button class="col-auto btn btn-sm waves-effect waves-light btn-rounded btn-primary"
                        type="button"
                        style="margin-left: 10px;"
                        v-t="'copy'"
                        @click="copy"></button>
            </div>
        </div>
    </div>
</template>

<script>
import {TextPlugin} from 'gsap/TextPlugin';
import {copyToClipboard} from '../util/helpers';

gsap.registerPlugin(TextPlugin);

export default {
    name: 'CopyRefLink',
    props: {
        referralLink: {
            type: String,
            required: true
        }
    },
    methods: {
        copy: throttle(function ({target}) {
            const timeline = gsap.to(target, {
                delay: 0,
                duration: 0.2,
                scale: 1.05,
                backgroundColor: '#22ca80',
                text: this.$t('copied'),
                ease: 'none'
            });

            copyToClipboard(this.referralLink);

            setTimeout(() => {
                timeline.reverse();
            }, 550);
        }, 1000)
    }
}
</script>
