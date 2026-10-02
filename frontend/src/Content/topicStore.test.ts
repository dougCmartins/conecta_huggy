import { describe, it, expect, beforeEach, vi } from "vitest";
import { setActivePinia, createPinia } from "pinia";
import { topicStore } from "@/Content/topicStore.ts";
import axios from "axios";
import { TopicModel } from "@/Content/topicModel.ts";

vi.mock("axios");

describe("Topic Store", () => {
    beforeEach(() => {
        setActivePinia(createPinia());
    });

    it("Deve iniciar uma lista vazia de topicos", () => {
        const store = topicStore();
        expect(store.topics).toEqual([]);
        expect(store.error).toBe('');
        expect(store.loading).toBe(false);
    });

    it("Deve marcar loading enquanto a lista está vazia", async () => {
        const store = topicStore();
        let resolveRequest: (value: { data: never[] }) => void = () => {};
        const pending = new Promise<{ data: never[] }>((resolve) => {
            resolveRequest = resolve;
        });

        (axios.get as any).mockReturnValue(pending);

        const request = store.fetchTopics();
        expect(store.loading).toBe(true);

        resolveRequest({ data: [] });
        await request;

        expect(store.loading).toBe(false);
    });

    it("Deve manter loading falso quando a lista já tem tópicos", async () => {
        const store = topicStore();
        store.topics = [TopicModel.fromObject({ id: 1, title: 'Já carregado' })];

        (axios.get as any).mockResolvedValue({
            data: [{ id: 2, title: 'Atualizado', author_name: 'Test' }],
        });

        const request = store.fetchTopics();
        expect(store.loading).toBe(false);
        expect(store.topics).toHaveLength(1);

        await request;

        expect(store.loading).toBe(false);
        expect(store.topics).toHaveLength(1);
        expect(store.topics[0].title).toBe('Atualizado');
    });

    it("Deve preencher a store ao buscar topicos com sucesso", async () => {
        const store = topicStore();

        const mockData = [{
                id: 1,
                author_name: 'Test',
                title: 'Construindo Relacionamentos Duradouros',
                subtitle: 'O papel do Customer Success no sucesso do cliente.',
                content: '<h1>Customer Success</h1><p>Customer Success é essencial para criar laços entre empresas e seus clientes...</p>',
                image: 'topic-1.jpg',
                is_closed: false,
                category_name: 'Category 1',
                created_at: '2026-01-01',
            }];

        (axios.get as any).mockResolvedValue({ data: mockData });

        await store.fetchTopics();

        expect(store.topics).toHaveLength(1);
        expect(store.topics[0]).toBeInstanceOf(TopicModel);
        expect(store.topics[0].categoryName).toBe('Category 1');
        expect(store.topics[0].authorName).toBe('Test');
        expect(store.topics[0].image).toBe("topic-1.jpg");
        expect(store.error).toBe("");
        expect(store.loading).toBe(false);
    });

    it("Deve capturar erro ao falhar na requisição", async () => {
        const store = topicStore();

        (axios.get as any).mockRejectedValue(new Error("Erro na API"));

        await store.fetchTopics();

        expect(store.error).toBe("Erro na API");
        expect(store.topics).toEqual([]);
        expect(store.loading).toBe(false);
    });
});
