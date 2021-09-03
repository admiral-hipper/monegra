export default {
    inheritAttrs: false,
    methods: {
        zoom(hookName) {
            const getElementStyles = el => {
                    const elComputedStyle = getComputedStyle(el);

                    return {
                        overflow: {established: el.style.overflow || null},
                        width: {established: el.style.width || null, real: elComputedStyle.width},
                        margin: {established: el.style.margin || null, real: elComputedStyle.margin},
                        marginTop: {established: el.style.marginTop || null},
                        marginLeft: {established: el.style.marginLeft || null},
                        marginRight: {established: el.style.marginRight || null},
                        marginBottom: {established: el.style.marginBottom || null},
                        padding: {established: el.style.padding || null, real: elComputedStyle.padding},
                        paddingTop: {established: el.style.paddingTop || null},
                        paddingLeft: {established: el.style.paddingLeft || null},
                        paddingRight: {established: el.style.paddingRight || null},
                        paddingBottom: {established: el.style.paddingBottom || null}
                    };
                },
                onComplete = ({el, done, styles}) => {
                    el.style.overflow = styles.overflow.established;
                    el.style.width = styles.width.established;
                    el.style.margin = styles.margin.established;
                    el.style.marginTop = styles.marginTop.established;
                    el.style.marginLeft = styles.marginLeft.established;
                    el.style.marginRight = styles.marginRight.established;
                    el.style.marginBottom = styles.marginBottom.established;
                    el.style.padding = styles.padding.established;
                    el.style.paddingTop = styles.paddingTop.established;
                    el.style.paddingLeft = styles.paddingLeft.established;
                    el.style.paddingRight = styles.paddingRight.established;
                    el.style.paddingBottom = styles.paddingBottom.established;

                    this.onComplete(el, done);
                };

            return {
                enter: (el, done) => {
                    const elComputedStyles = getElementStyles(el);

                    el.style.overflow = 'hidden';

                    this.handler.fromTo(el, {
                        autoAlpha: 0,
                        width: 0,
                        margin: 0,
                        padding: 0
                    }, {
                        autoAlpha: 1,
                        width: elComputedStyles.width.real,
                        margin: elComputedStyles.margin.real,
                        padding: elComputedStyles.padding.real,
                        ...this.config.enter,
                        onComplete: () => onComplete({
                            el,
                            done,
                            styles: elComputedStyles
                        })
                    }, this.chainPosition);
                },
                leave: (el, done) => {
                    const elComputedStyles = getElementStyles(el);

                    el.style.overflow = 'hidden';

                    this.handler.to(el, {
                        autoAlpha: 0,
                        width: 0,
                        margin: 0,
                        padding: 0,
                        ...this.config.leave,
                        onComplete: () => onComplete({
                            el,
                            done,
                            styles: elComputedStyles
                        })
                    }, this.chainPosition);
                }
            }[hookName];
        }
    }
};
