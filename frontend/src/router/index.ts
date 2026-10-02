import { createRouter, createWebHistory, type RouteRecordName } from 'vue-router';
import Login from '@/Auth/Login.vue';
import Home from '@/Content/Home.vue';
import Guest from '@/Auth/Guest.vue';
import Preferences from "@/User/Preferences.vue";
import { authStore } from "@/Auth/authStore";
import { userStore } from "@/User/userStore";
import Forum from "@/Content/Forum.vue";
import Articles from "@/Content/Articles.vue";
import Trail from "@/Content/Trail.vue";
import { initializeHuggy, subscribeLead } from "@/Auth/huggy";
import { trackEvent } from "@/router/tagManager";
import Register from "@/User/Register.vue";
import { ActionRoute } from '@/router/ActionRoute.ts'
import VTemplate from "@/ui/VTemplate.vue";

const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/guest',
        name: 'guest',
        component: Guest,
    },
    {
        path: '/',
        component: VTemplate,
        meta: { requiredAuth: true },
        children: [
            {
                path: '',
                name: 'home',
                component: Home,
            },
            {
                path: 'preference',
                name: 'preference',
                component: Preferences,
            },
            {
                path: 'forum',
                name: 'forum',
                component: Forum,
            },
            {
                path: 'articles',
                name: 'articles',
                component: Articles,
            },
            {
                path: 'content',
                name: 'content',
                component: Trail,
            },
        ],
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: Guest,
    },
];

const hasRouteUserForm = (nameRoute: RouteRecordName | null | undefined): boolean => {
    if (typeof nameRoute !== "string") {
        return false;
    }

    return (Object.values(ActionRoute) as string[]).includes(nameRoute);
}

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, _from, next) => {
    const auth = authStore();
    const useUserStore = userStore();

    try {
        if (auth.isAuthenticated() && !useUserStore.isLoaded) {
            await useUserStore.fetchUser();
        }

        if (to.meta.requiredAuth) {
            if (!auth.isAuthenticated()) {
                return next({ name: 'guest' });
            }

            if (to.name !== 'preference' && !useUserStore.user?.is_subscribed) {
                return next({ name: 'preference' })
            }
        }

        if (hasRouteUserForm(to.name) && auth.isAuthenticated()) {
            return next({ name: 'home' });
        }

        if (to.name === 'not-found' && auth.isAuthenticated()) {
            return next({ name: 'home' });
        }

        if (to.name === 'not-found' && !auth.isAuthenticated()) {
            return next({ name: 'guest' });
        }

        if (auth.isAuthenticated() && !auth.isSubscribed()) {
            initializeHuggy();
            auth.setSubscribed();
            await subscribeLead(useUserStore.user, auth.token);

            trackEvent("PageView", {
                page_path: to.fullPath,
                user: useUserStore.user
            });
        }
        next();
    } catch (e) {
        console.error('error:', e);
        auth.clearToken();
        next({ name: 'guest' })
    }
});

export default router;
