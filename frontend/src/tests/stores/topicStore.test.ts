import { describe, it, expect, beforeEach, vi } from "vitest";
import { setActivePinia, createPinia } from "pinia";
import { topicStore } from "@/stores/topicStore.ts";
import axios from "axios";
import {TopicModel} from "@/models/topicModel.ts";
import {UserModel} from "@/models/userModel.ts";
import {CategoryModel} from "@/models/categoryModel.ts";

vi.mock("axios");

describe("Topic Store", () => {
    beforeEach(() => {
        setActivePinia(createPinia());
    });

    it("Deve iniciar uma lista vazia de topicos", () => {
        const store = topicStore();
        expect(store.topics).toEqual([]);
        expect(store.error).toBe('');
    });

    it("Deve preencher a store ao buscar topicos com sucesso", async () => {
        const store = topicStore();

        const mockData = [{
                user: { name: 'Test', email: 'teste@teste.com' },
                title: 'Construindo Relacionamentos Duradouros',
                subtitle: 'O papel do Customer Success no sucesso do cliente.',
                content: '<h1>Customer Success</h1><p>Customer Success é essencial para criar laços entre empresas e seus clientes...</p>',
                image: 'topic-1.jpg',
                is_closed: false,
                category: { id: 1, name: 'Category 1', active: true, description: 'Test'},
            }];

        (axios.get as any).mockResolvedValue({ data: { data: mockData } });

        await store.fetchTopics();

        expect(store.topics).toHaveLength(1);
        expect(store.topics[0]).toBeInstanceOf(TopicModel);
        expect(store.topics[0].category).toBeInstanceOf(CategoryModel);
        expect(store.topics[0].user).toBeInstanceOf(UserModel);
        expect(store.topics[0].image).toBe("topic-1.jpg");
        expect(store.error).toBe("");
    });

    it("Deve capturar erro ao falhar na requisição", async () => {
        const store = topicStore();

        (axios.get as any).mockRejectedValue(new Error("Erro na API"));

        await store.fetchTopics();

        expect(store.error).toBe("Erro na API");
        expect(store.topics).toEqual([]);
    });
});