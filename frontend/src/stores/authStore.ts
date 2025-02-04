import { defineStore } from "pinia";
import axios from 'axios';
import client from "@/router/client.ts";

export const authStore = defineStore('auth', {
    state: () => ({
        token: localStorage.getItem('token') || '',
        error: '' as string,
        subscribed: localStorage.getItem('subscribed') || '',
    }),

    actions: {
        setToken(accessToken: string): void {
            this.clearToken()
            this.token = accessToken;
            localStorage.setItem('token', accessToken);
        },
        setSubscribed(): void {
            localStorage.setItem('subscribed', '1')
        },
        clearToken(): void {
            this.token = '';
            this.subscribed = ''
            localStorage.removeItem('token');
            localStorage.removeItem('subscribed')
        },
        isEmptyValue(item: string|null): boolean {
            return !!(
                item
                && item !== 'undefined'
                && item.trim() !== ''
            );
        },
        isAuthenticated(): boolean {
            const accessToken = localStorage.getItem('token');
            return this.isEmptyValue(accessToken);
        },
        isSubscribed(): boolean {
            const subscribed = localStorage.getItem('subscribed');
            return this.isEmptyValue(subscribed);
        },
        async login(credentials: { email: string; password: string }): Promise<void> {
            this.clearToken();

            try {
                const response = await axios.post(client("login"), credentials);
                this.setToken(response.data.token || '');
            } catch (error: any) {
                this.error = error.response?.data?.message || "Erro ao realizar login";
                console.error('Erro durante o login:', error);
            }
        },
    },
});