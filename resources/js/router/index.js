import { createRouter, createWebHistory } from "vue-router";
import home from '../components/HomePage.vue';
import productTable from '../products/components/ProductsTable.vue';
import productCreate from '../products/components/Create.vue';
import productEdit from '../products/components/Edit.vue';

const routes = [
    {
        path: '/',
        component: productTable
    },
    {
        path: '/home',
        component: productTable
    },    
    {
        path: '/products',
        component: productTable,
    },
    {
        path: '/products/create',
        component: productCreate
    },
    {
        path: '/products/:id/edit',
        component: productEdit
    },
]

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes
})

export default router