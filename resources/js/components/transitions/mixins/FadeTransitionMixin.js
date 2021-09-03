export default {
    inheritAttrs: false,
    methods: {
        fade(hookName) {
            return {
                enter: (el, done) => {
                    this.handler.fromTo(el, {
                        autoAlpha: 0
                    }, {
                        autoAlpha: 1,
                        ...this.config.enter,
                        onComplete: () => this.onComplete(el, done)
                    }, this.chainPosition);
                },
                leave: (el, done) => {
                    this.handler.to(el, {
                        autoAlpha: 0,
                        ...this.config.leave,
                        onComplete: () => this.onComplete(el, done)
                    }, this.chainPosition);
                }
            }[hookName];
        }
    }
};
