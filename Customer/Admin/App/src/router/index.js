/* eslint-disable import/no-unresolved */
import Vue from 'vue';
import VueRouter from 'vue-router';
import CustomerList from "../components/List.vue";
import CustomerDetail from "../components/Detail.vue";



Vue.use(VueRouter);

const routes = [
    {
        path: "/customers",
        component: CustomerList
    },
    {
        path: '/customers/details/:id',
        component: CustomerDetail
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});

export default router;