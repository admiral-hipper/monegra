export default {
    inheritAttrs: false,
    methods: {
        collapse(hookName) {
            return {
                enter: (el, done) => {
                    const elOverflowStyle = el.style.overflow || null,
                        elHeightStyle = el.style.height || null;

                    el.style.overflow = 'hidden';

                    this.handler.fromTo(el, {
                        height: 0
                    }, {
                        height: el.clientHeight,
                        ...this.config.enter,
                        onComplete: () => {
                            el.style.height = elHeightStyle;
                            el.style.overflow = elOverflowStyle;

                            this.onComplete(el, done);
                        }
                    }, this.chainPosition);
                },
                leave: (el, done) => {
                    const elOverflowStyle = el.style.overflow || null,
                        elHeightStyle = el.style.height || null;

                    el.style.overflow = 'hidden';

                    this.handler.to(el, {
                        height: 0,
                        ...this.config.leave,
                        onComplete: () => {
                            el.style.height = elHeightStyle;
                            el.style.overflow = elOverflowStyle;

                            this.onComplete(el, done);
                        }
                    }, this.chainPosition);
                }
            }[hookName];
        }
    }
};
