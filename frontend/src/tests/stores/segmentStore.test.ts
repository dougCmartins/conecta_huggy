import { describe, it, expect, beforeEach, vi } from "vitest";
import { setActivePinia, createPinia } from "pinia";
import { segmentStore } from "@/stores/segmentStore";
import { SegmentModel } from "@/models/segmentModel";
import axios from "axios";

vi.mock("axios");

describe("Segment Store", () => {
    beforeEach(() => {
        setActivePinia(createPinia());
    });

    it("Deve iniciar uma lista vazia de segmentos", () => {
        const store = segmentStore();
        expect(store.segments).toEqual([]);
        expect(store.error).toBe('');
    });

    it("Deve preencher a store ao buscar segmentos com sucesso", async () => {
        const store = segmentStore();

        const mockData = [
            { id: 1, name: "Segmento 1", description: "Descrição 1" },
            { id: 2, name: "Segmento 2", description: "Descrição 2" }
        ];

        (axios.get as any).mockResolvedValue({ data: mockData });

        await store.fetchSegments();

        expect(store.segments).toHaveLength(2);
        expect(store.segments[0]).toBeInstanceOf(SegmentModel);
        expect(store.segments[0].name).toBe("Segmento 1");
        expect(store.error).toBe("");
    });

    it("Deve capturar erro ao falhar na requisição", async () => {
        const store = segmentStore();

        (axios.get as any).mockRejectedValue(new Error("Erro na API"));

        await store.fetchSegments();

        expect(store.error).toBe("Erro na API");
        expect(store.segments).toEqual([]);
    });
});