import { createWebHashHistory, createRouter } from 'vue-router'

import RootLayout from '@dashboard/views/layouts/RootLayout.vue';
import DashboardLayout from '@dashboard/views/layouts/DashboardLayout.vue';
import PublicLayout from '@dashboard/views/layouts/PublicLayout.vue';
import AuthLayout from '@dashboard/views/layouts/AuthLayout.vue';

import Login from '@dashboard/views/pages/auth/Login.vue';

import dashboard from '@dashboard/views/pages/dashboard/Dashboard.vue';
import settings from '@dashboard/views/pages/app_management/Settings.vue';

import user_route from '@dashboard/views/pages/user_management/user/setup/routes.js';

const routes = [
    {
        path: '/',
        component: RootLayout,
        children: [
            {
                path: '',
                component: DashboardLayout,
                children: [
                    {
                        path: '',
                        component: dashboard,
                        name: 'Dashboard',
                    },
                    {
                        path: 'settings',
                        component: settings,
                    },
                    user_route,
                ],
            },
            {
                path: '',
                component: PublicLayout,
                children: [
                    {
                        path: '',
                        component: AuthLayout,
                        children: [
                            {
                                path: '/login',
                                component: Login,
                                name: 'Login',
                            },
                        ]
                    },
                ]
            },
        ]
    },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

router.afterEach((to, from) => {
    let public_routes = ['/login'];
    if (!public_routes.includes(to.path) && from.path != '/login') {
        localStorage.setItem('last_route', to.path);
    }
});

export default router
