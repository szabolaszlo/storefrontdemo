/* eslint-disable import/no-unresolved */
import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: '/subscribers',
    routes: [
        {
            path: '/',
            component: () => import('@/components/Lists'),
            children: [],
        },
        {
            path: '/details/:id',
            component: () => import('@/components/Details'),
            children: [],
        },
    ],
});