/**
 * Поиск и применение мидлевара для роутера
 *
 * @param router
 * @param to
 * @param next
 * @return {*}
 */
export function routeMiddleware({router, to, next}) {
    if (!to.meta || !to.meta.middleware) return next();

    const middleware = Array.isArray(to.meta.middleware)
        ? to.meta.middleware
        : [to.meta.middleware];

    const context = {
        next,
        router
    };

    for (let index in middleware) {
        if (middleware.hasOwnProperty(index)) {
            middleware[index](context);
        }
    }
}

/**
 * Установ названия страницы
 *
 * @param to
 * @param next
 * @return {*}
 */
export function setPageTitle(to, next) {
    const APP_NAME = 'Ritofos',
        DEFAULT_TITLE = 'Контент';

    let title = (to.meta && to.meta.title) ? to.meta.title : null;

    if (document.title === DEFAULT_TITLE) {
        title = location.pathname.split('/').pop().split('_').join(' ');
        title = title.charAt(0).toUpperCase() + title.slice(1);
    }

    if (title && typeof title === 'string') {
        document.title = APP_NAME + (title ? (' - ' + title) : '');
    }

    return next();
}
