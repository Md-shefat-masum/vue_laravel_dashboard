import { createWebHashHistory, createRouter } from 'vue-router'

import RootLayout from '@dashboard/views/layouts/RootLayout.vue';
import DashboardLayout from '@dashboard/views/layouts/DashboardLayout.vue';
import PublicLayout from '@dashboard/views/layouts/PublicLayout.vue';
import AuthLayout from '@dashboard/views/layouts/AuthLayout.vue';

import Login from '@dashboard/views/pages/auth/Login.vue';

import dashboard from '@dashboard/views/pages/dashboard/Dashboard.vue';
import PageBuilder from '@dashboard/views/pages/page_builder/PageBuilder.vue';

import user_route from '@dashboard/views/pages/user_management/user/setup/routes.js';
import profile_route from '@dashboard/views/pages/profile/setup/routes.js';

import settings_route from '@dashboard/views/pages/app_management/setup/routes.js';

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
                        path: 'page-builder',
                        component: PageBuilder,
                        name: 'PageBuilder',
                    },

                    user_route,
                    profile_route,
                    settings_route,
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
