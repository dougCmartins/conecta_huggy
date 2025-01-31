import {createRouter, createWebHistory} from 'vue-router';
import Login from '@/components/Login.vue';
import Home from '@/components/Home.vue';
import HelloWorld from '@/components/HelloWorld.vue';
import Preferences from "@/components/Preferences.vue";
import { authStore } from "@/stores/authStore";
import { userStore } from "@/stores/userStore";
import Forum from "@/components/Forum.vue";
import Articles from "@/components/Articles.vue";
import Content from "@/components/Content.vue";
import { initializeHuggy, subscribeLead } from "@/widget/huggy.js";
import { trackEvent } from "@/goggle/tagManager.js";
import Register from "@/components/Register.vue";
import { ActionRoute } from '@/enums/ActionRoute.ts'

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
        path: '/hello-word',
        name: 'hello-word',
        component: HelloWorld,
    },
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: { requiredAuth: true },
    },
    {
        path: '/preference',
        name: 'preference',
        component: Preferences,
        meta: { requiredAuth: true },
    },
    {
        path: '/forum',
        name: 'forum',
        component: Forum,
        meta: { requiredAuth: true },
    },
    {
        path: '/articles',
        name: 'articles',
        component: Articles,
        meta: { requiredAuth: true },
    },
    {
        path: '/content',
        name: 'content',
        component: Content,
        meta: { requiredAuth: true },
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: HelloWorld,
    },
];

const hasRouteUserForm = ((nameRoute) => {
    console.log(nameRoute);
    return [ActionRoute.register, ActionRoute.access].includes(nameRoute);
})

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const auth = authStore();
    const useUserStore = userStore();

    try {
        if (auth.isAuthenticated() && !useUserStore.isLoaded) {
            await useUserStore.fetchUser();
        }

        if (to.meta.requiredAuth) {
            if (!auth.isAuthenticated()) {
                return next({ name: 'hello-word' });
            }

            console.log(useUserStore.user?.preference?.is_subscribed)
            if(to.name !== 'preference' && !useUserStore.user?.preference?.is_subscribed) {
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
            return next({ name: 'hello-word' });
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
        next({ name: 'hello-word' })
    }
});

export default router;