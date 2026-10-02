import { defineStore } from "pinia";
import axios from 'axios';
import { UserModel } from "@/User/userModel.ts";
import client from "@/router/client.ts";
import { readApiError, type ApiFieldErrors } from "@/ui/apiError.ts";

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
        fieldErrors: {} as ApiFieldErrors,
        isLoaded: false
    }),

    actions: {
        async create(data: any): Promise<void> {
            this.error = '';
            this.fieldErrors = {};

            try {
                const response = await axios.post(client("user"), data);
                this.user = UserModel.fromObject(response.data);
            } catch (error: unknown) {
                const parsed = readApiError(error, "Erro ao cadastrar usuário");
                this.error = parsed.message;
                this.fieldErrors = parsed.fields;
                console.error('Erro ao criar usuário:', error);
                throw error;
            }
        },
        async fetchUser(): Promise<void> {
            try {
                const token = localStorage.getItem('token');
                const response = await axios.get(client("user"), {
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
            this.error = '';
            this.fieldErrors = {};

            try {
                const token = localStorage.getItem('token');
                await axios.put(
                    `${client("user")}/preference`,
                    {
                        name: data.name,
                        email: data.email,
                        is_subscribed: Boolean(data.preference.is_subscribed),
                        segment_ids: data.preference.segment_ids ?? [],
                    },
                    {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json'
                        },
                    }
                );
            } catch (error: unknown) {
                const parsed = readApiError(error, "Erro ao atualizar preferências");
                this.error = parsed.message;
                this.fieldErrors = parsed.fields;
                console.error('Erro no setPreferences:', error);
                throw error;
            }
        },
    },
});