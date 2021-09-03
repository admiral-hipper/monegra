import router from './router/index';
import i18n from './plugins/i18n';

document.documentElement.lang = i18n.locale = (Object.keys(i18n.messages).includes(window.locale) ? window.locale : 'ru');

require('./bootstrap');
require('./components');

/**
 * Предотвратить прод совет при запуске
 *
 * @type {boolean}
 */
Vue.config.productionTip = false;

/** Создание экземпляра Vue для отдельных DOM-контейнеров */

const roots = [
    {selector: '#copy-ref-link', options: {i18n}},
    {selector: '#linear-partnership-program', options: {i18n}},
    {selector: '#ranked-partnership-program', options: {i18n}},
    {selector: '#wallets-panel', options: {i18n}},
    {selector: '#transactions-panel', options: {i18n}},
    {selector: '#purchase-panel', options: {i18n}},
    {selector: '#withdraw-panel', options: {i18n}},
    {selector: '#balance-panel', options: {i18n}},
    {selector: '#notifications', options: {i18n}},
    {selector: '#admin-dashboard', options: {i18n}},
    {selector: '#admin-exchange-rates', options: {i18n}},
    {selector: '#admin-settings', options: {i18n}},
    {selector: '#exchange-rates', options: {i18n}},
    {selector: '#keep', options: {router}}
];

for (const root of roots) {
    const nodeElement = document.querySelector(root.selector);

    if (!nodeElement
        || !nodeElement.nodeType
        || !nodeElement.childElementCount) {
        continue;
    }

    new Vue(root.options || {})
        .$mount(root.selector);
}
