/* eslint-disable import/no-unresolved */
import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: '/customers',
    routes: [
        {
            path: '/',
            component: () => import('@/components/List'),
            children: [],
        },
        {
            path: '/detail/:id',
            component: () => import('@/components/Detail'),
            children: [],
        },
    ],
});