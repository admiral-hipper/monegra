import Vue from 'vue';
import VueI18n from 'vue-i18n';

Vue.use(VueI18n);

function loadLocaleMessages() {
    const locales = require.context('../locales', true, /[A-Za-z0-9-_,\s]+\.json$/i),
        messages = {};
    locales.keys().forEach(key => {
        let matched = key.match(/([A-Za-z0-9-_]+)\./i);
        if (matched && matched.length > 1) {
            let locale = matched[1];
            messages[locale] = locales(key);
        }
    });
    return messages;
}

export default new VueI18n({
    locale: 'ru',
    fallbackLocale: 'en',
    preserveDirectiveContent: true,
    messages: loadLocaleMessages(),
    pluralizationRules: {
        ru: function (choice, choicesLength) {
            if (choice === 0) return 0;

            let teen = (choice > 10 && choice < 20),
                endsWithOne = (choice % 10 === 1);

            if (!teen && endsWithOne) return 1;
            if (!teen && choice % 10 >= 2 && choice % 10 <= 4) return 2;

            return (choicesLength < 4) ? 2 : 3;
        }
    }
})
