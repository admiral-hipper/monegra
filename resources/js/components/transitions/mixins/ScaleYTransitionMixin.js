export default {
    inheritAttrs: false,
    methods: {
        scaleY(hookName) {
            return {
                enter: (el, done) => {
                    const elOverflowStyle = el.style.overflow || null;

                    el.style.overflow = 'hidden';

                    this.handler.fromTo(el, {
                        autoAlpha: 0,
                        scaleY: 0
                    }, {
                        autoAlpha: 1,
                        scaleY: 1,
                        ...this.config.enter,
                        onComplete: () => {
                            el.style.overflow = elOverflowStyle;

                            this.onComplete(el, done);
                        }
                    }, this.chainPosition);
                },
                leave: (el, done) => {
                    const elOverflowStyle = el.style.overflow || null;

                    el.style.overflow = 'hidden';

                    this.handler.to(el, {
                        autoAlpha: 0,
                        scaleY: 0,
                        ...this.config.leave,
                        onComplete: () => {
                            el.style.overflow = elOverflowStyle;

                            this.onComplete(el, done);
                        }
                    }, this.chainPosition);
                }
            }[hookName];
        }
    }
};
