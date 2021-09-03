<template>
    <component :is="componentType"
               :tag="tag"
               :css="false"
               v-bind="$attrs"
               @enter="enter"
               @leave="leave">
        <slot/>
    </component>
</template>

<script>
    /**
     * To add new transition, you must edit:
     *
     * - TRANSITION_NAMES
     * - mixins
     * - transitionAliases
     */

    import FadeTransitionMixin from './mixins/FadeTransitionMixin';
    import ZoomXTransitionMixin from './mixins/ZoomXTransitionMixin';
    import ZoomYTransitionMixin from './mixins/ZoomYTransitionMixin';
    import ZoomTransitionMixin from './mixins/ZoomTransitionMixin';
    import ScaleTransitionMixin from './mixins/ScaleTransitionMixin';
    import ScaleYTransitionMixin from './mixins/ScaleYTransitionMixin';
    import ScaleXTransitionMixin from './mixins/ScaleXTransitionMixin';
    import SlideUpTransitionMixin from './mixins/SlideUpTransitionMixin';
    import SlideDownTransitionMixin from './mixins/SlideDownTransitionMixin';
    import SlideLeftTransitionMixin from './mixins/SlideLeftTransitionMixin';
    import SlideRightTransitionMixin from './mixins/SlideRightTransitionMixin';
    import CollapseTransitionMixin from './mixins/CollapseTransitionMixin';

    const DEFAULT_DURATION = 0.3,
        DEFAULT_DELAY = 0,
        DEFAULT_EASE = 'power1',
        DEFAULT_ORIGIN = '',
        TRANSITION_NAMES = [
            'fade',
            'zoom',
            'zoom-x',
            'zoom-y',
            'scale',
            'scale-y',
            'scale-x',
            'slide-up',
            'slide-down',
            'slide-left',
            'slide-right',
            'collapse'
        ];

    export default {
        name: 'AppTransition',
        mixins: [
            FadeTransitionMixin,
            ZoomTransitionMixin,
            ZoomXTransitionMixin,
            ZoomYTransitionMixin,
            ScaleTransitionMixin,
            ScaleYTransitionMixin,
            ScaleXTransitionMixin,
            SlideUpTransitionMixin,
            SlideDownTransitionMixin,
            SlideLeftTransitionMixin,
            SlideRightTransitionMixin,
            CollapseTransitionMixin
        ],
        props: {
            /**
             * Transition name.
             */
            name: {
                type: String,
                required: true,
                validator(transitionName) {
                    if (TRANSITION_NAMES.includes(transitionName)) {
                        return true;
                    }

                    throw new Error(`Unregistered transition name: "${transitionName}"`);
                }
            },
            /**
             * Transition tag, in case the component is a `transition-group`.
             */
            tag: {
                type: String,
                default: 'span'
            },
            /**
             * Whether the component should be a `transition-group` component.
             */
            group: Boolean,
            /**
             * Transition duration. Number for specifying the same duration for enter/leave transitions.
             * Object style {enter: DEFAULT_DURATION, leave: DEFAULT_DURATION} for specifying explicit durations for enter/leave.
             */
            duration: {
                type: [Number, String, Object],
                default: DEFAULT_DURATION
            },
            /**
             * Transition delay. Number for specifying the same delay for enter/leave transitions.
             * Object style {enter: 300, leave: 300} for specifying explicit durations for enter/leave.
             */
            delay: {
                type: [Number, String, Object],
                default: DEFAULT_DELAY
            },
            /**
             *  Transform origin property https://tympanus.net/codrops/css_reference/transform-origin/.
             *  Object style {enter: undefined, leave: undefined} for specifying explicit origins for enter/leave.
             */
            origin: {
                type: [String, Object],
                default: DEFAULT_ORIGIN
            },
            /**
             * Transition ease https://greensock.com/ease-visualizer/.
             * Object style {enter: DEFAULT_EASE, leave: DEFAULT_EASE} for specifying explicit eases for enter/leave.
             */
            ease: {
                type: [String, Object],
                default: DEFAULT_EASE
            },
            /**
             * Whether the elements be animated in chain.
             */
            chain: Boolean,
            /**
             * Chain position for elements in chain.
             */
            chainPosition: {
                type: [Number, String],
                default: undefined
            },
            /**
             * Gsap timeline.
             */
            timeline: {
                type: Object,
                default: undefined
            },
            /**
             * Whether transform styles will be cleared after enter transition.
             */
            pureTransform: Boolean
        },
        data() {
            return {
                transitionAliases: {
                    'fade': 'fade',
                    'zoom': 'zoom',
                    'zoom-x': 'zoomX',
                    'zoom-y': 'zoomY',
                    'scale': 'scale',
                    'scale-y': 'scaleY',
                    'scale-x': 'scaleX',
                    'slide-up': 'slideUp',
                    'slide-down': 'slideDown',
                    'slide-left': 'slideLeft',
                    'slide-right': 'slideRight',
                    'collapse': 'collapse'
                }
            };
        },
        computed: {
            componentType() {
                return this.group ? 'transition-group' : 'transition';
            },
            handler() {
                if (this.timeline) {
                    return this.timeline;
                }

                if (this.chain && this.group) {
                    return gsap.timeline();
                }

                return gsap;
            },
            transitionAlias() {
                return this.transitionAliases[this.name];
            },
            isTransitionNameValid() {
                return this.hasOwnProperty(this.transitionAlias);
            },
            config() {
                return {
                    enter: this.getConfig('enter'),
                    leave: this.getConfig('leave')
                };
            }
        },
        methods: {
            getConfig(hookName) {
                const getStringValue = (configName, defaultValue) => {
                        const configValue = this[configName];

                        let value;

                        if (configValue && typeof configValue === 'object') {
                            value = configValue[hookName];

                            if (typeof value !== 'string') value = defaultValue;
                        } else {
                            value = configValue;
                        }

                        return typeof value !== 'string' ? defaultValue : value.trim() || defaultValue;
                    },
                    getNumericValue = (configName, defaultValue) => {
                        const configValue = this[configName];

                        let value;

                        if (configValue && typeof configValue === 'object') {
                            value = parseFloat(configValue[hookName]);

                            if (isNaN(value)) value = defaultValue;
                        } else {
                            value = parseFloat(configValue);
                        }

                        return isNaN(value) ? defaultValue : value;
                    };

                const config = {
                        duration: getNumericValue('duration', DEFAULT_DURATION),
                        delay: getNumericValue('delay', DEFAULT_DELAY),
                        ease: getStringValue('ease', DEFAULT_EASE)
                    },
                    origin = getStringValue('origin', DEFAULT_ORIGIN);

                if (origin) {
                    config.transformOrigin = origin;
                }

                return config;
            },
            enter(el, done) {
                if (!this.isTransitionNameValid) return;

                this[this.transitionAlias]('enter')(el, done);
            },
            leave(el, done) {
                if (!this.isTransitionNameValid) return;

                this[this.transitionAlias]('leave')(el, done);
            },
            onComplete(el, done) {
                if (this.pureTransform) {
                    el.style.transform = null;
                    el.style.transformOrigin = null;
                }

                if (this.$listeners.done) {
                    this.$listeners.done(el, done);
                } else {
                    done();
                }
            }
        }
    }
</script>
