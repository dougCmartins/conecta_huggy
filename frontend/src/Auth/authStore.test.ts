import { describe, it, expect, beforeEach, vi } from "vitest";
import { setActivePinia, createPinia } from "pinia";
import { authStore } from "@/Auth/authStore.ts";
import localStorageMock from "@/Auth/localStorageMock.ts"
import axios from "axios";

vi.mock("axios");

describe("Auth Store", () => {
    beforeEach(() => {
        localStorageMock.clear();
        setActivePinia(createPinia());
    });

    it("Deve preencher a store ao enviar as credenciais com sucesso", async () => {
        const store = authStore();

        const credentials = { email: 'teste@teste.com', password: '123' };

        (axios.post as any).mockResolvedValue({ data: { token: 'mockToken' } });

        await store.login(credentials);

        expect(store.error).toBe("");
        expect(store.token).toBe('mockToken');
        expect(localStorageMock.getItem('token')).toBe('mockToken');
    });

    it("Deve capturar erro ao falhar na requisição", async () => {
        const store = authStore();

        (axios.post as any).mockRejectedValue(new Error("Erro na API"));

        const credentials = { email: 'teste@teste.com', password: '123' };

        await expect(store.login(credentials)).rejects.toBeTruthy();

        expect(store.error).toBe("Dados incorretos.");
        expect(store.token).toBe('');
        expect(localStorageMock.getItem('token')).toBeNull();
    });

    it("Deve guardar a mensagem de credenciais inválidas", async () => {
        const store = authStore();

        (axios.post as any).mockRejectedValue({
            response: {
                data: {
                    data: null,
                    message: "Invalid credentials.",
                    code: "INVALID_CREDENTIALS",
                    status_code: 401,
                    errors: [],
                },
            },
        });

        await expect(store.login({
            email: "martinsdouglas087@gmail.com",
            password: "123",
        })).rejects.toBeTruthy();

        expect(store.error).toBe("Invalid credentials.");
        expect(store.token).toBe('');
    });
});