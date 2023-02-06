/* eslint-disable import/no-unresolved */
import Vue from 'vue';
import VueRouter from 'vue-router';
import AdminList from "../components/List.vue";
import AdminDetail from "../components/Detail.vue";



Vue.use(VueRouter);

const routes = [
    {
        path: "/admins",
        component: AdminList
    },
    {
        path: '/admins/details/:id',
        component: AdminDetail
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});

export default router;