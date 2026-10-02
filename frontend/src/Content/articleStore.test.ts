import { describe, it, expect, beforeEach, vi } from "vitest";
import { setActivePinia, createPinia } from "pinia";
import { articleStore } from "@/Content/articleStore.ts";
import { ArticleModel } from "@/Content/articleModel.ts";
import axios from "axios";

vi.mock("axios");

describe("Article Store", () => {
    beforeEach(() => {
        setActivePinia(createPinia());
    });

    it("Deve iniciar uma lista vazia de artigos", () => {
        const store = articleStore();
        expect(store.articles).toEqual([]);
        expect(store.error).toBe('');
        expect(store.loading).toBe(false);
    });

    it("Deve marcar loading enquanto a lista está vazia", async () => {
        const store = articleStore();
        let resolveRequest: (value: { data: never[] }) => void = () => {};
        const pending = new Promise<{ data: never[] }>((resolve) => {
            resolveRequest = resolve;
        });

        (axios.get as any).mockReturnValue(pending);

        const request = store.fetchArticles();
        expect(store.loading).toBe(true);

        resolveRequest({ data: [] });
        await request;

        expect(store.loading).toBe(false);
    });

    it("Deve manter loading falso quando a lista já tem artigos", async () => {
        const store = articleStore();
        store.articles = [ArticleModel.fromObject({ id: 1, title: 'Já carregado' })];

        (axios.get as any).mockResolvedValue({
            data: [{ id: 2, title: 'Atualizado', author_name: 'Test' }],
        });

        const request = store.fetchArticles();
        expect(store.loading).toBe(false);
        expect(store.articles).toHaveLength(1);

        await request;

        expect(store.loading).toBe(false);
        expect(store.articles).toHaveLength(1);
        expect(store.articles[0].title).toBe('Atualizado');
    });

    it("Deve preencher a store ao buscar artigos com sucesso", async () => {
        const store = articleStore();

        const mockData = [{
                id: 1,
                author_name: 'Test',
                title: 'Construindo Relacionamentos Duradouros',
                subtitle: 'O papel do Customer Success no sucesso do cliente.',
                content: '<h1>Customer Success</h1><p>Customer Success é essencial para criar laços entre empresas e seus clientes...</p>',
                image: 'topic-1.jpg',
                published: true,
                created_at: '2026-01-01',
            }];

        (axios.get as any).mockResolvedValue({ data: mockData });

        await store.fetchArticles();

        expect(store.articles).toHaveLength(1);
        expect(store.articles[0]).toBeInstanceOf(ArticleModel);
        expect(store.articles[0].authorName).toBe('Test');
        expect(store.articles[0].image).toBe("topic-1.jpg");
        expect(store.error).toBe("");
        expect(store.loading).toBe(false);
    });

    it("Deve capturar erro ao falhar na requisição", async () => {
        const store = articleStore();

        (axios.get as any).mockRejectedValue(new Error("Erro na API"));

        await store.fetchArticles();

        expect(store.error).toBe("Erro na API");
        expect(store.articles).toEqual([]);
        expect(store.loading).toBe(false);
    });
});
