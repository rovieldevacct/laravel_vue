import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

const app = createApp({});

import ProductsTable from './products/components/ProductsTable.vue';
import CreateProduct from './products/components/Create.vue';

app.component('products-table', ProductsTable);
app.component('create-product', CreateProduct);

// const router = createRouter({
//     history: createWebHistory(),
//     routes:[
//         {
//             path: "/products/create",
//             component: CreateProduct,
//         },
//         {
//             // path: "/products",
//             component: ProductsTable,
//             name: 'products-table'
//         },
//     ]
// });
// app.use(router);
// app.use(router).mount('#app');
app.mount('#app');