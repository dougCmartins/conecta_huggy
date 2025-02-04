import { describe, it, expect, beforeEach, vi } from "vitest";
import { setActivePinia, createPinia } from "pinia";
import { authStore } from "@/stores/authStore.ts";
import localStorageMock from "@/tests/localStorageMock.ts"
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

        await store.login(credentials);

        expect(store.error).toBe("Erro ao realizar login");
        expect(store.token).toBe('');
        expect(localStorageMock.getItem('token')).toBeNull();
    });
});