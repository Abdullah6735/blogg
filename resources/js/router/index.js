import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/views/Home.vue';
import Posts from '@/views/Posts.vue';
import AdminDashboard from '@/views/AdminDashboard.vue';
import Login from '@/views/Login.vue';

const routes = [
    { path: '/', name: 'home', component: Home },
    // { path: '/posts', name: 'posts', component: Posts },
    // { path: '/admin/dashboard', name: 'admin-dashboard', component: AdminDashboard, meta: { requiresAuth: true, isAdmin: true } },
    // { path: '/login', name: 'login', component: Login },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('auth');
    const userRole = localStorage.getItem('role');

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!isAuthenticated) {
            next({ name: 'login' });
        } else if (to.matched.some(record => record.meta.isAdmin) && userRole !== 'admin') {
            next({ name: 'posts' });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
