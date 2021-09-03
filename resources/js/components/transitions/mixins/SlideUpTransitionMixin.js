export default {
    inheritAttrs: false,
    methods: {
        slideUp(hookName) {
            return {
                enter: (el, done) => {
                    this.handler.fromTo(el, {
                        autoAlpha: 0,
                        y: el.clientHeight / 2
                    }, {
                        autoAlpha: 1,
                        y: 0,
                        ...this.config.enter,
                        onComplete: () => this.onComplete(el, done)
                    }, this.chainPosition);
                },
                leave: (el, done) => {
                    this.handler.to(el, {
                        autoAlpha: 0,
                        y: el.clientHeight / 2,
                        ...this.config.leave,
                        onComplete: () => this.onComplete(el, done)
                    }, this.chainPosition);
                }
            }[hookName];
        }
    }
};
