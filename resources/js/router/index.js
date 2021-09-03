import Vue from 'vue';
import VueRouter from 'vue-router';
import {Routes as routes} from './routes';
import {routeMiddleware, setPageTitle} from './utils';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    return routeMiddleware({router, to, next});
});

router.beforeResolve((to, from, next) => {
    return setPageTitle(to, next);
});

export default router;
