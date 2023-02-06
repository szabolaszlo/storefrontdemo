import './set-public-path';
import Vue from 'vue';
import singleSpaVue from 'single-spa-vue';

import App from './App.vue';
import router from './router';

Vue.config.productionTip = false;

import { axiosApiInstance} from 'admin-shared';

Vue.prototype.$http = axiosApiInstance;

const vueLifecycles = singleSpaVue({
    Vue,
    appOptions: {
        render: (h) => h(App),
        router
    },
});

export const bootstrap = vueLifecycles.bootstrap;
export const mount = vueLifecycles.mount;
export const unmount = vueLifecycles.unmount;