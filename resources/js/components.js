/**
 * Global components registration
 */

import AppTransition from './components/transitions/AppTransition';

Vue.component('app-transition', AppTransition);
Vue.component('copy-ref-link', () => import('./components/CopyRefLink'));
Vue.component('linear-partnership-program', () => import('./components/LinearPartnershipProgram'));
Vue.component('ranked-partnership-program', () => import('./components/RankedPartnershipProgram'));
Vue.component('wallets-panel', () => import('./components/WalletsPanel'));
Vue.component('transactions-panel', () => import('./components/TransactionsPanel'));
Vue.component('purchase-panel', () => import('./components/PurchasePanel'));
Vue.component('withdraw-panel', () => import('./components/WithdrawPanel'));
Vue.component('balance-panel', () => import('./components/BalancePanel'));
Vue.component('notifications', () => import('./components/Notifications'));
Vue.component('admin-dashboard', () => import('./components/admin/Dashboard'));
Vue.component('admin-exchange-rates', () => import('./components/admin/ExchangeRates.vue'));
Vue.component('admin-settings', () => import('./components/admin/Settings.vue'));
Vue.component('exchange-rates', () => import('./components/ExchangeRates.vue'));
