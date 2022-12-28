import { createRouter, createWebHistory } from "vue-router"
import HomePage from '../pages/HomePage.vue'
import UsersPage from '../pages/UsersPage.vue'
import AdminPage from '../pages/AdminPage.vue'
import UserPage from '../pages/UserPage.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage,
    },
    {
        path: '/users',
        name: 'users',
        component: UsersPage,
    },
    {
        path: '/admin',
        name: 'admin',
        component: AdminPage,
    },
    {
        path: '/users/:id',
        name: 'user',
        component: UserPage,
    },
];

const router = createRouter( {
    history: createWebHistory(),
    routes,
} )

export default router
