/* eslint-disable import/no-unresolved */
import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/subscribers',
            component: () => import('@/components/Lists'),
            children: [],
        },
        {
            path: '/subscribers/details/:id',
            component: () => import('@/components/Details'),
            children: [],
        },
    ],
});