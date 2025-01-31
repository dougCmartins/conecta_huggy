import { defineStore } from "pinia";
import axios from 'axios';
import { UserModel } from "@/models/userModel.ts";

type PreferencesPayload = {
    name?: string;
    email?: string;
    preference: {
        is_subscribed: number;
        segment_ids?: number[];
    };
};

export const userStore = defineStore('user', {
    state: () => ({
        user: UserModel.fromObject({}),
        error: '' as string,
        isLoaded: false
    }),

    actions: {
        async create(data: any): Promise<void> {
            try {
                const response = await axios.post('http://127.0.0.1:8000/api/user', data);
                this.user = UserModel.fromObject(response.data);
            } catch (error: any) {
                this.error = error.response?.data?.message || "Erro ao cadastrar usuário";
                console.error('Erro ao criar usuário:', error);
                alert('Erro ao criar usuário');
            }
        },
        async fetchUser(): Promise<void> {
            try {
                const token = localStorage.getItem('token');
                const response = await axios.get("http://127.0.0.1:8000/api/user", {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });

                this.user = UserModel.fromObject(response.data);
            } catch (error: any) {
                this.error = error.response?.data?.message || "Erro ao buscar usuário";
                console.error("Erro ao buscar usuário:", error);
            } finally {
                this.isLoaded = true;
            }
        },
        async syncUserPreference(data: PreferencesPayload): Promise<void> {
            try {
                const token = localStorage.getItem('token');
                const response = await axios.put(
                    'http://127.0.0.1:8000/api/user/preference',
                    {
                        name: data.name,
                        email: data.email,
                        preference: {
                            is_subscribed: data.preference.is_subscribed,
                            segment_ids: data.preference.segment_ids
                        },
                    },
                    {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json'
                        },
                    }
                );
            } catch (error: any) {
                this.error = error.response?.data?.message || "Erro ao atualizar preferências";
                console.error('Erro no setPreferences:', error);
                throw error;
            }
        },
    },
});